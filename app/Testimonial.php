<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonials';

    protected $fillable = [
        'name', 'text','avatar'
    ];

    protected $appends = [
        'avatar_url'
    ];

    /**
     * return full User avatar url
     *
     * @param  string  $value
     * @return string
    */
    public function getAvatarUrlAttribute()
    {
        if ( $this->avatar ) {
            $testimonial_avatar = $this->avatar;
        } else {
            $testimonial_avatar = 'testimonial-default.png';
        }
        return asset('storage/images/'.$testimonial_avatar);
    }
}
