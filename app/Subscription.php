<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table   = 'subscriptions';

    protected $fillable = [
        'user_id', 'service_name','service_id','transaction_id','status','payment_response','ends_at'
    ];

    protected $casts = [
        'payment_response' => 'array',
    ];

    public function service()
    {
        return $this->belongsTo('App\Service', 'service_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get my subscriptions
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMine($query)
    {
        return $query->whereUserId(auth()->user()->id);
    }

    /**
     * Get subscription by service Id
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  (int) $serviceId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeServiceOf($query, $serviceId)
    {
        return $query->whereServiceId($serviceId); // Pass static service Id
    }

    /**
     * Get active subscriptions
     *
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->whereStatus('subscribed');
    }

}
