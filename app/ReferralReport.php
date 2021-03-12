<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralReport extends Model
{
    protected $table   = 'referral_reports';

    protected $fillable = [
        'user_id', 'invite_email','is_registered'
    ];

    public function referrer()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get referal users list of current user
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->whereUserId(auth()->user()->id);
    }
}
