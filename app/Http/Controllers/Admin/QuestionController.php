<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;
use DataTables;

class QuestionController extends Controller
{
    /**
     * Display a listing of the Question.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $chapter_id = $id;
        //$questions  = Question::where('training_chapter_id', $chapter_id)->with('training_chapter')->paginate(4);

        return view('admin.questions.index', compact('chapter_id'));
    }

    /**
     * Load the question data for Datatables
     *
     * @return \Illuminate\Http\Response
     */
    public function loadQuestions($id)
    {
        $questions = Question::whereTrainingChapterId($id);
        return Datatables::of($questions)
                ->addColumn('action', function (Question $question) {
                    return '<a class="btn btn-secondary btn-sm" href="'.route('admin.questions.edit', $question->id).'"><i class="fas fa-list-ol fa-fw"></i>Options</a>
                    <a class="btn btn-info btn-sm" href="'.route('admin.questions.edit', $question->id).'"> <i class="fas fa-pencil-alt"></i> Edit </a>
                    <button class="btn btn-danger btn-sm delete-question" data-remote="/admin/questions/'.$question->id.'"> <i class="fas fa-trash-alt"></i> Delete </button>';
                })
                ->rawColumns(['action'])
                ->make(true);
    }

    /**
     * Show the form for creating a new Question.
     *
     * @param  Training Chapter Id $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('admin.questions.create',['chapter_id' => $id]);
    }

    /**
     * Store a newly created Question in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question'  => 'required',
        ]);

        $service = Question::create($request->all());

        if ( $request->submit == 'Save' ) {
            return redirect()->route('admin.questions',$request->training_chapter_id)->with('success','Question Successfully Added');
        } else {
            return redirect()->route('admin.questions.create',$request->training_chapter_id)->with('success','Question Successfully Added');
        }
    }

    /**
     * Show the form for editing the specified Question.
     *
     * @param  \App\Question  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::with('options')->findOrFail($id);
        return view('admin.questions.edit', compact('question'));
    }

    /**
     * Update the specified Question in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'question'  => 'required',
        ]);

        $question = Question::findOrFail($request->id);
        $question->question = $request->question;
        $question->save();
        
        //Go back Question listing page
        return redirect()->route('admin.questions',$request->training_chapter_id)
                         ->with('success', 'Question successfully updated'); 
    }

    /**
     * Remove the specified Question from storage.
     *
     * @param  question id $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);

        if ( $question->delete() ) {
            return Response(['status'=>'success','message'=>'Question deleted']);  
        } else {
            return Response(['status'=>'error', 'message'=>'Something went wrong']);
        }
    }
}
