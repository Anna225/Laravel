<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSchedule extends Model
{
    protected $table   = 'user_schedules';

    protected $fillable = [
        'user_id', 'slot_id', 'status'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function schedule_slot()
    {
        return $this->belongsTo('App\ScheduleSlot', 'slot_id');
    }

    /**
     * Get my appointment
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->whereUserId(auth()->user()->id);
    }
}
