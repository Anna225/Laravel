<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorialSlide extends Model
{
    protected $table = 'tutorial_slides';

    protected $fillable = [
        'title','training_chapter_id','content','order',
    ];

    public function chapter()
    {
        return $this->belongsTo('App\TrainingChapter', 'training_chapter_id');
    }

}
