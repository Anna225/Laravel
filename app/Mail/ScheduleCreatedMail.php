<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ScheduleCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $user, $type)
    {
        $this->data = $data;
        $this->user = $user;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('First Aid CPR Appointment Created')
                    ->markdown('emails.schedules.created')
                    ->with(['data' => $this->data, 
                            'user' => $this->user,
                            'type' => $this->type,
                    ]);
    }
}
