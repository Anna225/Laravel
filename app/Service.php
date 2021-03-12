<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table   = 'services';

    protected $fillable = [
        'name', 'description','image','price', 'price_without_tax', 'tax', 'tax_percentage'
    ];

    protected $appends = [
        'image_url'
    ];

    // Get associated schedule slots data
    public function schedule_slots()
    {
        return $this->hasMany('App\ScheduleSlot', 'service_id');
    }

    /**
     * return full service image url
     *
     * @return string
    */
    public function getImageUrlAttribute()
    {
        if ( $this->image ) {
            $service_image = $this->image;
        } else {
            $service_image = 'service-default.png';
        }
        return asset('storage/images/'.$service_image);
    }
}
