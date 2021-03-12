<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingChapter extends Model
{
    protected $table = 'training_chapters';

    protected $fillable = [
        'name', 'description','image','quiz_questions','min_pass_marks','study_time'
    ];

    protected $appends = [
        'image_url',
    ];

    public function questions()
    {
        return $this->hasMany('App\Question', 'training_chapter_id');
    }

    public function slides()
    {
        return $this->hasMany('App\TutorialSlide', 'training_chapter_id');
    }

    public function study_log()
    {
        return $this->hasMany('App\StudyLog', 'training_chapter_id');
    }

    public function quiz_reports()
    {
        return $this->hasMany('App\QuizReport', 'chapter_id');
    }

    /**
     * return full Chapter url
     *
     * @param  string  $value
     * @return string
    */
    public function getImageUrlAttribute()
    {
        if ( $this->image ) {
            $chapter_image = $this->image;
        } else {
            $chapter_image = 'chapter-default.png';
        }
        return asset('storage/images/'.$chapter_image);
    }
}
