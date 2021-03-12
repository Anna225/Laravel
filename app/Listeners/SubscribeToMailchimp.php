<?php

namespace App\Listeners;

use \DrewM\MailChimp\MailChimp;
use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubscribeToMailchimp
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $api_key = env('MAILCHIMP_APIKEY');
        $this->mailchimp = new MailChimp($api_key);
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $list_id = env('MAILCHIMP_LIST_ID');
        $this->mailchimp->post("lists/".$list_id."/members", [
            'email_address' => $event->user->email,
            'merge_fields'  => ['FNAME' => $event->user->first_name, 'LNAME' => $event->user->last_name ],
            'status'        => 'subscribed',
        ]);
    }
}
