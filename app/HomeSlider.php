<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    protected $table   = 'home_slider';

    protected $fillable = [
        'heading', 'subheading', 'image', 'cta_label', 'cta_link','cta_target'
    ];

    protected $appends = [
        'image_url'
    ];

    /**
     * return full slider image url
     *
     * @return string
    */
    public function getImageUrlAttribute()
    {
        if ( $this->image ) {
            $slide_image = $this->image;
        } else {
            $slide_image = 'slide-default.png';
        }
        return asset('storage/images/'.$slide_image);
    }
}
