<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    protected $table   = 'question_options';

    protected $fillable = [
       'question_id','option','is_correct'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //'is_correct'
    ];

    public function question()
    {
        return $this->belongsTo('App\Question', 'question_id');
    }

    /**
     * get correct answer
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCorrect($query)
    {
        return $query->whereIsCorrect('1');
    }
}
