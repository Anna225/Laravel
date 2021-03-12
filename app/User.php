<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password','avatar' ,'birth_date', 'mobile_number', 'referral_code', 'status','customer_id','address_line_1','address_line_2','city','state','country','postal_code','referred_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'avatar_url','name'
    ];

    public function referrer()
    {
        return $this->belongsTo('App\User', 'referred_by');
    }

    public function referrals()
    {
        return $this->hasMany('App\User', 'referred_by');
    }

    public function invites()
    {
        return $this->hasMany('App\ReferralReport', 'user_id');
    }

    public function securityTraining()
    {
        return $this->hasOne('App\Subscription', 'user_id');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription', 'user_id');
    }

    public function consent_document()
    {
        return $this->hasOne('App\ConsentDocument', 'user_id');
    }

    public function cpr_certificate()
    {
        return $this->hasOne('App\CprCertificate', 'user_id');
    }

    public function booked_schedule()
    {
        return $this->hasOne('App\UserSchedule', 'user_id');
    }

    public function quiz()
    {
        return $this->hasMany('App\QuizReport', 'user_id');
    }

    public function final_quiz() {
        return $this->quiz()->where('is_final', '1')->where('status','complete');
    }

    /**
     * return full avatar url
     *
     * @return string
    */
    public function getAvatarUrlAttribute()
    {
        if ( $this->avatar ) {
            $avatar = $this->avatar;
        } else {
            $avatar = 'avatar-default.png';
        }
        return asset('storage/avatars/'.$avatar);
    }

    /**
     * return Full Name
     *
     * @return string
    */
    public function getNameAttribute()
    {
       return $this->first_name.' '.$this->last_name;
    }
}
