<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudyLog;

class StudyLogController extends Controller
{
    /**
     * Update the study timer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateTimer(Request  $request)
    {
        if( $request->ajax() ){

            $logId      = $request->log_id;
            $studyLog   = StudyLog::findOrFail($logId);
            if ( isset( $request->current_time ) ) {
                $studyLog->time_spent = $request->current_time;
            }
            $studyLog->last_visited_slide = $request->last_slide;

            if ( $studyLog->save() ) {
                $status  = 'success';
                $message = 'Timer Updated'; 
            } else {
                $status  = 'error';
                $message = 'Something went wrong';
            }

            return \Response::json([
                'status' => $status,
                'msg'    => $message,
                'log_id' => $logId
            ]);
        }
    }

    /**
     * Finish the chapter study
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function finishStudy(Request  $request)
    {
        if( $request->ajax() ){
            $logId    = $request->log_id;
            $studyLog = StudyLog::findOrFail($logId);
            $studyLog->is_finished = 1;
            $studyLog->save();

            return \Response::json([
                'status' => 'success',
                'msg'    => 'Study finished',
                'log_id' => $logId
            ]);
        }
    }
}
