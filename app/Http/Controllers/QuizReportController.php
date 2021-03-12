<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendQuizResult;
use App\Mail\CertificateMail;
use App\Mail\SendFinalQuizReminder;
use App\TrainingChapter;
use App\QuizReport;
use App\Question;
use App\StudyLog;

class QuizReportController extends Controller
{
    public function index($id)
    {
        $result   = null;
        $is_final = 0;

        // check if it's Final quiz or regular
        if ( $id == 'final' ) {
            // Check if user is allowed to take final exam
            $isAllowed = isFinalQuizAllowed();
            if ( ! $isAllowed ) {
                return abort(404);
            }
            // Check if user has already taken the Quiz
            $quiz   = QuizReport::mine()->completed()->final()->passed()->latest()->first();
            if ($quiz) {
                $result = array(
                    'total_questions' => $quiz->total_questions,
                    'correct_answers' => $quiz->total_correct,
                    'time_spent'      => $quiz->time_spent	,
                    'percentage'      => $quiz->percentage.'%',
                    'result_status'   => $quiz->result_status,
                    'result_data'     => $quiz->result_html,
                );
            }

            $is_final = 1; // Mark this quiz as final
            $chapter  = null; // Null chapter ID for final quiz (Obviously!)
        } else {
            // Check if user is allowed to take exam
            $isAllowed = isQuizAllowed($id);
            if ( ! $isAllowed ) {
                return abort(404);
            }

            $chapter = TrainingChapter::findOrFail($id);

            // Check if user has already taken the Quiz ans passed
            $quiz   = QuizReport::where('chapter_id', $id)
                                ->mine()
                                ->completed()
                                ->passed()
                                ->latest()->first();

            if ($quiz) {
                $result = array(
                    'total_questions' => $quiz->total_questions,
                    'correct_answers' => $quiz->total_correct,
                    'time_spent'      => $quiz->time_spent	,
                    'percentage'      => $quiz->percentage.'%',
                    'result_status'   => $quiz->result_status,
                    'result_data'     => $quiz->result_html,
                );
            }
        }

        return view('quiz', compact('chapter', 'result', 'is_final'));
    }

    /**
     * Start the quiz 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function startQuiz(Request  $request)
    {
        $is_final   = $request->is_final;
        $chapter_id = $request->chapter_id;
        if ( $is_final ) {
            $max_questions  = getMetaValue('total_final_questions');

            // Get the random questions from all the chapters
            $questions = Question::has('options')  //Only load the questions if it has options
                                ->with('options')
                                ->inRandomOrder()
                                ->limit($max_questions)
                                ->get()
                                ->each(function ($text) {
                                    $text->options->makeHidden(['is_correct']); // make this field hidded so it won't appear on Ajax response
                                });

        } else {
            $chapter        = TrainingChapter::findOrFail($chapter_id);
            $max_questions  = $chapter->quiz_questions;

            // Get the random questions for chapter id
            $questions = Question::whereTrainingChapterId($chapter_id)
                                ->has('options')  //Only load the questions if it has options
                                ->with('options')
                                ->inRandomOrder()
                                ->limit($max_questions)
                                ->get()
                                ->each(function ($text) {
                                    $text->options->makeHidden(['is_correct']); // make this field hidded so it won't appear on Ajax response
                                });

        }

        // Don't load the quiz if it doesn't have enough questions ready.
        if ( (int)$questions->count() !== (int)$max_questions ) {
            return Response([
                'status' => 'error',
                'msg'    => 'Quiz is not ready yet. Please contact administrator', 
                'quiz'   => null, 
                'data'   => null, 
                'next'   => null
            ]);
        }

        $questions_allocated = $questions->pluck('id');

        $quizReport = QuizReport::create([
            'user_id'             => auth()->user()->id,
            'chapter_id'          => ($chapter_id) ? $chapter_id : null,
            'questions'           => $questions,
            'questions_allocated' => $questions_allocated,
            'total_questions'     => $max_questions,
            'is_final'            => $is_final
        ]);

        // Store the current quiz ID in session to validate question-answer later
        $quiz_progress = array();
        \Session::put('quiz-'.$quizReport->id, $quiz_progress);

        $first_question = $questions->first();
        return Response([
            'status' => 'success',
            'msg'    => 'Quiz Loaded Successfully', 
            'quiz'   => $quizReport->id, 
            'data'   => $first_question, 
            'next'   => 1
        ]);
    }

    /**
     * Load next question 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loadQuestion(Request  $request)
    {
        $nextIndex         = $request->next;
        $quizId            = $request->quiz;
        $currentQuestionId = $request->question;
        $selectedOption    = explode('=', $request->answer)[1];

        // Get the correct answer
        $questionData = Question::with('options')
                        ->findOrFail($currentQuestionId);

        $question_response = array(
                                'question'        => $questionData->question,
                                'options'         => $questionData->options,
                                'selected_option' => (int)$selectedOption,
                            );

        // Store the answered question data to session
        \Session::push('quiz-'.$quizId, $question_response);

        // Get the data of current quiz
        $quizData          = QuizReport::findOrFail($quizId);
        $quizQuestions     = $quizData->questions;
        $questionAllocated = $quizData->questions_allocated;
        $total_questions   = $quizData->total_questions;

        // return the next question
        $data = [
            'status' => 'success',
            'data'   => $quizQuestions[$nextIndex],
            'next'   => ( $nextIndex + 1 < $total_questions ) ? $nextIndex + 1 : 'last',
            'quiz'   => $quizId,
        ];
        return response()->json($data, 200);
    }

    /**
     * Finish the quiz and return the result
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function finishQuiz(Request  $request)
    {
        $quizId            = $request->quiz;
        $currentQuestionId = $request->question;
        $latestTime        = $request->latest_time;
        $selectedOption    = explode('=', $request->answer)[1];
        $is_final          = $request->is_final;

        // Get the correct answer
        $questionData = Question::with('options')
                        ->findOrFail($currentQuestionId);

        //prepare the array to store in session
        $answeredQuestion = array(
                                'question'        => $questionData->question,
                                'options'         => $questionData->options,
                                'selected_option' => (int)$selectedOption, // ID of the selected option
                            );

        // Store the answered question data to session
        \Session::push('quiz-'.$quizId, $answeredQuestion);

        //Generate the result
        $quizServerLog   = \Session::get('quiz-'.$quizId); // get all the stored ans from session
                    
        $total_correct = 0;
        $resultHtml    = '';
        $answersIndex   = array('A)', 'B)', 'C)', 'D)');
        // Prepare result HTML
        foreach ($quizServerLog as $key => $log) {
            $selectedOption = $log['selected_option']; // we get the id of the selected option here
            $question       = $log['question']; // Question as string

            $resultHtml .= '<div class="chap-question"><h5 class="disflex">
                                <dt class="mr-1 que-index">Q'.($key + 1).'</dt>
                                    <dd class="mb-0 que-title">'.$question.'</dd>
                                </h5>
                                <div class="que-options">';

            // Loop through all the options
            foreach ($log['options'] as $optionKey => $option) {
                // print all the options and highligh the selected options
                $optionIndex     = $key +1;
                if ( $option->id == $selectedOption ) {
                    $answerClass     = ( $option->is_correct ) ? 'correct-option' : 'wrong-option';
                    $total_correct   = ( $option->is_correct ) ? $total_correct + 1 : $total_correct;
                    $resultHtml .= '<p class="'.$answerClass.'">
                                        <input checked type="radio" class="option-'.$optionIndex.'" id="option'.$optionIndex.'">
                                        <label for="option1">
                                            <span class="mr-2"></span>
                                            <span class="option_'.$optionIndex.'">'.$option->option.'</span>
                                        </label>
                                    </p>';
                } else {
                    $resultHtml .= '<p class="">
                                        <input checked type="radio" class="option-'.$optionIndex.'" id="option'.$optionIndex.'">
                                        <label for="option1">
                                            <span class="mr-2"></span>
                                            <span class="option_'.$optionIndex.'">'.$option->option.'</span>
                                        </label>
                                    </p>';
                }

                if (  $option->is_correct ) {
                    $correctAnswer = $option->option;
                    $correctKey    = $optionKey;
                }
            }
            //show correct answer if selected option is wrong
            if ( $answerClass == 'wrong-option' ) {
                $resultHtml .= '<p class="correct-ans"><strong>Correct Answer: </strong>'.$answersIndex[$correctKey].' '.$correctAnswer.'</p>';    
            }
            $resultHtml .= '</div></div><br />';
        }

        $quizData                = QuizReport::findOrFail($quizId);
        $quizData->total_correct = $total_correct;
        $quizData->time_spent    = $latestTime;
        $quizData->status        = 'complete';
        $quizData->ended_at      = now();
        $quizData->result        = json_encode($quizServerLog);
        
        $total_questions         = $quizData->total_questions;
        $percentage              = round( $total_correct / $total_questions * 100, 2 );
        $quizData->percentage    = $percentage;

        // Get chapter details for quiz result email ( if it's not final quiz)
        $chapterDetails  = ($is_final) ? null : TrainingChapter::find($request->chapter_id);

        // Check if user has passed the quiz
        $minPassingMarks = ($chapterDetails) ? $chapterDetails->min_pass_marks : getMetaValue('final_pass_marks');
        $resultStatus    = ( $total_correct >= $minPassingMarks ) ? 'Passed' : 'Failed'; 
        $quizData->result_status = $resultStatus; //Update the quiz report table
        $quizData->result_html = getDataDbReady($resultHtml);
        $quizData->save();

        $data = [
            'status'        => 'success',
            'correct'       => $total_correct,
            'total'         => $total_questions,
            'time_spent'    => $quizData->time_spent,
            'percentage'    => $percentage.'%',
            'result'        => $resultHtml,
            'result_status' => $resultStatus
        ];  

        // Send email to user with quiz result data
        $email_payload                  = new \stdClass();
        $email_payload->total_correct   = $total_correct;
        $email_payload->total_questions = $total_questions;
        $email_payload->time_spent      = $quizData->time_spent;
        $email_payload->percentage      = $percentage.'%';
        $email_payload->user            = auth()->user();
        $email_payload->chapter         = $chapterDetails;
        $email_payload->result_status   = $resultStatus;
        $email_payload->is_final        = $is_final;

        Mail::to(auth()->user()->email)->send(new SendQuizResult($email_payload));

        // Check if user is eligible for final exam
        if ( ! $is_final && isFinalQuizAllowed() ) {
            Mail::to(auth()->user()->email)->send(new SendFinalQuizReminder(auth()->user()));
        }
        
        if($is_final && $resultStatus == 'Passed'){
            Mail::to(auth()->user()->email)->bcc('info@securtac.ca')->send(new CertificateMail(auth()->user())); 
        }

        return response()->json($data, 200);
    }

    /**
     * Update the on going quiz timer
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateQuizTimer(Request  $request)
    {
        if( $request->ajax() ){
            $quizId       = $request->quiz_id;
            $current_time = $request->current_time;
            $quizData     = QuizReport::findOrFail($quizId);
            $quizData->time_spent = $current_time;

            if ( $quizData->save() ) {
                $status  = "success";
                $message = "Timer Updated"; 
            }else{
                $status  = "error";
                $message = "Something went wrong";
            }

            return \Response::json([
                "status"  => $status,
                "msg"     => $message,
                "quiz_id" => $quizId
            ]);
        }
    }

    /**
     * Check if user is allowed to take quiz
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkQuizAvaibility(Request  $request)
    {
        $is_final   = $request->is_final;
        $chapter_id = $request->chapter_id;

        // check if it's Final quiz or regular
        if ( $is_final == '1' ) {
            // Check if user has already taken the Quiz
            $quiz   = QuizReport::mine()
                                ->completed()
                                ->final()
                                ->passed()
                                ->latest()->first();
        } else {
            // Check if user has already taken the Quiz ans passed
            $quiz   = QuizReport::where('chapter_id', $chapter_id)
                                ->mine()
                                ->completed()
                                ->passed()
                                ->latest()->first();
        }

        if ( $quiz ) {
            return Response([
                'status' => 'error',
                'msg'    => 'You have already passed this quiz', 
            ]);
        } else {
            return Response([
                'status' => 'success',
                'msg'    => 'User are allowed to take quiz', 
            ]);
        }

    }
}
