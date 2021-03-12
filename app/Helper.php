<?php 

/**
 * Custom global helper functions 
 */

use App\TrainingChapter;
use App\StudyLog;
use App\Subscription;
use App\GeneralOption;
use App\Service;
use App\QuizReport;

/**
 * Check if user is allowed to study chapter
 *
 * @param  int $chapter_id
 * @return boolean 
 */
function isStudyAllowed($chapter_id)
{
    // Check details of previous chapter
    $prevChapter = TrainingChapter::where('id','<',$chapter_id)
                                ->orderBy('order','desc')
                                ->first('id'); //dd($prevChapter->toArray());

    // return true if it's first chapter
    if ( ! $prevChapter ) {
        return true;
    }

    // Commented on 28-3-2020: multiple quiz attempt functionality request
    /* $studyLog = StudyLog::where('training_chapter_id', $prevChapter->id)
                        ->mine()->latest()->first();

    // Return true if previous study was finished
    if ( isset( $studyLog->is_finished ) && $studyLog->is_finished == '1' ) {
        return true;
    } */

    // Check quiz result of previous completed and passed quiz
    $prevQuiz = QuizReport::where('chapter_id', $prevChapter->id)
                            ->mine() //for logged in user
                            ->completed() //status = completed
                            ->passed() // result_status = passed
                            ->latest()->first(); //dd($prevQuiz->toArray());

    if( $prevQuiz ) {
        return true;
    }
    return false;
}


/**
 * Check if user is allowed to take a quiz
 *
 * @param  int $chapter_id
 * @return boolean 
 */
function isQuizAllowed($chapter_id)
{
    // check if current chapter is finished or not
    $studyLog = StudyLog::where('training_chapter_id', $chapter_id)
                        ->mine()->latest()->first();

    if ( ! $studyLog ) {
        return false;
    } elseif ( isset( $studyLog->is_finished ) && $studyLog->is_finished == '1' ) {
        return true;
    }
    return false;
}

/**
 * Check if user is allowed to take final quiz
 *
 * @return boolean 
 */
function isFinalQuizAllowed()
{
    $currentUserId = auth()->user()->id;

    // Get the last chapter id from training chapter table
    $lastChapter = TrainingChapter::latest()->first();

    // Get the quiz report of current user and compare chapter id from last entry with $lastChapter->id
    $studyLog = QuizReport::mine()->completed()->regular()->passed()->latest()->first(); //dd($studyLog->toArray());

    if ( ! $studyLog ) {
        return false;
    } elseif ( $lastChapter->id !== $studyLog->chapter_id ) {
        return false;
    } else {
        return true;
    }

   /*  // Check if user has already given the final quiz and passed
    $isGiven = QuizReport::mine()->completed()->final()->passed()->latest()->first(); dd($isGiven->toArray());
    if ( $isGiven ) {
        return false;
    } */

}

/**
 * Check if user is subscribed to a service
 *
 * @param  int $serviceId
 * @return boolean
 */
function isSubscribed($serviceId){
    $activeSubscriptions = Subscription::ServiceOf($serviceId)->mine()->latest()->first();
    return $activeSubscriptions;
}

/**
 * Check if user is subscribed to a service
 *
 * @param  int $serviceId
 * @return boolean
 */
function isSubscribedUser($serviceId, $userId){
    $activeSubscriptions = Subscription::ServiceOf($serviceId)->where('user_id', $userId)->latest()->first();
    return $activeSubscriptions;
}

/**
* Get hours and minutes formatted string.
*
* @param integer $seconds
* @return string
*/
function secondsToTime($inputSeconds) {
    $secondsInAMinute = 60;
    $secondsInAnHour = 60 * $secondsInAMinute;
    $secondsInADay = 24 * $secondsInAnHour;

    // Extract days
    $days = floor($inputSeconds / $secondsInADay);

    // Extract hours
    $hourSeconds = $inputSeconds % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);

    // Extract minutes
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);

    // Extract the remaining seconds
    $remainingSeconds = $minuteSeconds % $secondsInAMinute;
    $seconds = ceil($remainingSeconds);

    // Format and return
    $timeParts = [];
    $sections = [
        'day' => (int)$days,
        'hour' => (int)$hours,
        'minute' => (int)$minutes,
        'second' => (int)$seconds,
    ];

    foreach ($sections as $name => $value){
        if ($value > 0){
            $timeParts[] = $value. ' '.$name.($value == 1 ? '' : 's');
        }
    }

    return implode(', ', $timeParts);
}

function getMetaValue($meta_key)
{
    $meta_data = GeneralOption::where('option_key', $meta_key)->first();
    return ($meta_data) ? $meta_data->option_value : '';
}

function getServiceDetail($serviceId, $field){
    $serviceDetails = Service::findOrfail($serviceId);
    
    return $serviceDetails->$field;
}

/**
 * HTML content to ready for storing in DB
 * 
 * @param $content  
 */
function getDataDbReady($content)
{
    $content = trim($content);
    $content = stripslashes($content);
    $content = htmlspecialchars($content);
    return $content;
}