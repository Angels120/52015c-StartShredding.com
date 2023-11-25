<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegisterVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $subject;
    public $token;
    public $template;
    public $button;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $token, $subject, $template)
    {
        $this->name = $name;
        $this->subject = $subject;
        $this->template = $template;
        $this->button = url('user/activation', $token);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.registration.user-register-verification');
        //->with('button',  $this->button);
    }
}
