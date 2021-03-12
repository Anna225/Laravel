<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizReport extends Model
{
    protected $table   = 'quiz_reports';

    protected $fillable = [
        'user_id','chapter_id','ended_at','questions','questions_allocated','total_questions','total_correct','status', 'is_final'
    ];

    protected $casts = [
        'questions'           => 'array',
        'questions_allocated' => 'array'
    ];

    public function chapter()
    {
        return $this->belongsTo('App\TrainingChapter', 'chapter_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get quiz report for logged in user
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->whereUserId(auth()->user()->id);
    }

    /**
     * Get completed quiz report
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->whereStatus('complete');
    }

    /**
     * Get passed quiz report
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePassed($query)
    {
        return $query->whereResultStatus('passed');
    }

    /**
     * Get final quiz report 
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFinal($query)
    {
        return $query->whereIsFinal('1');
    }

    /**
     * Get regular quiz report 
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRegular($query)
    {
        return $query->whereIsFinal('0');
    }
}
