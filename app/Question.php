<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table   = 'questions';

    protected $fillable = [
        'question', 'training_chapter_id'
    ];

    public function training_chapter()
    {
        return $this->belongsTo('App\TrainingChapter', 'training_chapter_id');
    }

    public function options()
    {
        return $this->hasMany('App\QuestionOption', 'question_id');
    }

}
