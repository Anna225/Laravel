<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudyLog;
use App\TutorialSlide;
use App\TrainingChapter;

class TrainingController extends Controller
{
    /**
     * Display Tutorial Slides.
     *
     * @param  int  $chapter_id
     * @return \Illuminate\Http\Response
     */
    public function showSlides( $chapter_id )
    {
        // Check if user is allowed to study
        $isAllowed = isStudyAllowed($chapter_id);
        if ( ! $isAllowed ) {
            return abort(404);
        }

        $chapter = TrainingChapter::whereHas('slides')->withCount('slides')->findOrFail( $chapter_id );
        $user    = auth()->user();

        // Get the last timer value
        $studyLog = StudyLog::mine()
                            ->where('training_chapter_id', $chapter_id)
                            ->latest()->first();

        $lastLog    = ( $studyLog ) ? $studyLog->time_spent : 0;
        $lastSlide  = ( $studyLog ) ? $studyLog->last_visited_slide : 'none';
        $isFinished = ( $studyLog ) ? $studyLog->is_finished : 0;
        $actionBtn  = ( $studyLog ) ? 'Resume Study' : 'Start Study';

        // Create object containing last study log data 
        $log                = new \stdClass();
        $log->last_time_log = $lastLog;
        $log->last_slide    = $lastSlide;
        $log->is_finished   = $isFinished;
        $log->action_btn    = $actionBtn;

        return view('study', compact('log', 'user', 'chapter'));
    }

    /**
     * load the tutorial slides
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loadSlides(Request  $request)
    {
        if( $request->ajax() ){ //Check if request is ajax
            $chapter_id  = $request->chapter;
            $lastLog     = $request->last_log;
            $totalSlide  = $request->total_slides;
            $isFinished  = $request->is_finished;

            $slideQuery = TutorialSlide::query();
            $slideQuery = $slideQuery->where('training_chapter_id', $request->chapter);

            if ( ! isset( $request->slide ) ) {
                $slideIdToLoad = $request->last_slide;
                if ( $slideIdToLoad !== 'none' ) {
                    $slideQuery = $slideQuery->where('id', $slideIdToLoad);
                }
            } else {
                $slideIdToLoad = $request->slide;
                $slideQuery    = $slideQuery->where('id', $slideIdToLoad);
            }

            $slideQuery = $slideQuery->orderBy('order');
            $slide      = $slideQuery->first();
            if ( $slide ) {
                if ( ! isset( $request->slide ) && !$isFinished ) { //Start now action

                    $studyLog = StudyLog::create([
                        'user_id'             => auth()->user()->id,
                        'training_chapter_id' => $chapter_id,
                        'time_spent'          => $lastLog,
                        'last_visited_slide'  => $slide->id,
                    ]);

                    $logId = $studyLog->id;
                }

                $prevSlide = TutorialSlide::where('training_chapter_id', $request->chapter)
                                                ->where('order', '<', $slide->order)
                                                ->orderBy('order','desc')
                                                ->first('id');
                $prevId  = ( $prevSlide ) ? $prevSlide->id : 'none';

                // If it's last slide
                $current_order = $slide->order;
                if ( $totalSlide - $current_order > 1 ) {
                    $nextSlide = TutorialSlide::where('training_chapter_id', $request->chapter)
                                                ->where('order', '>', $slide->order)
                                                ->orderBy('order')
                                                ->first('id');
                    $nextId    = $nextSlide->id;
                } else {
                    $nextId = 'finish';
                }

                $content    = html_entity_decode($slide->content);
                $message    = 'Slide successfully loaded';
                $status     = 'success';
                $currentId  = $slide->id;
            } else {
                $content    = '<div class="alert alert-danger" role="alert">
                                   No Slide Found.Please Contact Administrator.
                                </div>';
                $status     = 'error';
                $prevId     = 'none';
                $nextId     = 'none';
                $currentId  = 'none';
                $isFinished = 'none';
                $message    = 'Error while fetching the slide content';
            }

            // Get log Id
            $studyLog = StudyLog::where('training_chapter_id', $request->chapter)
                            ->mine()
                            ->latest()->first();

            $response = array(
                'status'        => $status,
                'msg'           => $message,
                'content'       => $content,
                'prev_slide'    => $prevId,
                'next_slide'    => $nextId,
                'current_slide' => $currentId,
                'is_finished'   => $isFinished,
                'log_id'        => ( $studyLog ) ? $studyLog->id : null,
            );

            return \Response::json( $response );
        }
        return response()->json(['status'=>'error', 'msg' => 'Invalid request']);
    }

    /**
     * Display all the training chapters
     *
     * @return \Illuminate\Http\Response
     */
    public function showTrainingChapters()
    {
        $trainingChapters = TrainingChapter::withCount('slides')->with('slides')->orderBy('order')->get();

        return view('training_chapters', compact('trainingChapters'));
    }
}