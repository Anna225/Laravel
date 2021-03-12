<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table   = 'clients';

    protected $fillable = [
        'name','image','link'
    ];

    protected $appends = [
        'image_url'
    ];

    /**
     * return full service image url
     *
     * @return string
    */
    public function getImageUrlAttribute()
    {
        if ( $this->image ) {
            $client_image = $this->image;
        } else {
            $client_image = 'client-default.png';
        }
        return asset('storage/images/'.$client_image);
    }
}
