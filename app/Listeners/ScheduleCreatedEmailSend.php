<?php

namespace App\Listeners;

use App\Events\ScheduleCreated;
use App\Mail\ScheduleCreatedMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScheduleCreatedEmailSend
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ScheduleCreated  $event
     * @return void
     */
    public function handle(ScheduleCreated $event)
    {
        // Send email to user
        \Mail::to($event->user->email)->send(new ScheduleCreatedMail($event->data, $event->user, 'user' ));

        // Send email to Admin
        //$admin_email = env('ADMIN_EMAIL');
        $admin_email = getMetaValue('admin_email');
        \Mail::to($admin_email)->send(new ScheduleCreatedMail($event->data, $event->user, 'admin' ));
    }
}
