<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactAdminMail extends Mailable
{
    use Queueable, SerializesModels;
    public $parameters; // contains: name, email, message
    /**
     * Create a new message instance.
     *
     * @param array $variables contains the name, email, and message of the user
     * @return void
     */
    public function __construct($variables)
    {
        //
        $this->parameters = $variables;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.contact_admin')->with(['variables'=>$this->parameters]);
    }
}
