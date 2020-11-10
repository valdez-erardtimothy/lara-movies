<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ContactUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public $parameters; // contains the user ID and the message

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($parameters)
    {
        //
        $this->parameters = $parameters;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.contact_user')->with([
            'user' => User::find($this->parameters['user']),
            'message_content' => $this->parameters['message']
        ]);
    }
}
