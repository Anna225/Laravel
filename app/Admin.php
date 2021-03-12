<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MailResetPasswordNotification;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar'
    ];

    protected $appends = [
        'avatar_url'
    ];

    /**
     * return full avatar url
     *
     * @param  string  $value
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
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordNotification($token,'admin'));
    }
}
