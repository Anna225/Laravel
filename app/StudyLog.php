<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyLog extends Model
{
    protected $table   = 'study_logs';

    protected $fillable = [
        'user_id', 'training_chapter_id','time_spent','last_visited_slide'
    ];

    protected $appends = [
        'percentage'
    ];

    public function last_slide()
    {
        return $this->belongsTo('App\TutorialSlide', 'last_visited_slide');
    }

    public function training_chapter()
    {
        return $this->belongsTo('App\TrainingChapter', 'training_chapter_id');
    }

    /**
     * return percentage of study progress
     *
     * @return string
    */
    public function getPercentageAttribute()
    {
        // Current slide order + 1 due to starting index from 0
        $current      = $this->last_slide->order + 1;

        // Get total slides from training chapter relationship
        $total_slides = $this->training_chapter->slides->count();

        // Calculate the percentage
        $percentage = round( ($current * 100 ) / $total_slides , 2 );

        return $percentage;
    }

    /**
     * Get my projects
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->whereUserId(auth()->user()->id);
    }
}