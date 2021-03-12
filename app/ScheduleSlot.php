<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScheduleSlot extends Model
{
    use SoftDeletes;

    protected $table   = 'schedule_slots';

    protected $fillable = [
        'event', 'venue','start_date','start_time','end_date','total_slots','status', 'service_id'
    ];

    public function user_schedules()
    {
        return $this->hasMany('App\UserSchedule', 'slot_id');
    }

    // Get associated service data of schedule slot
    public function service()
    {
        return $this->belongsTo('App\Service', 'service_id');
    }
}
