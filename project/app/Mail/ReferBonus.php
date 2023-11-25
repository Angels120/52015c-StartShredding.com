<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReferBonus extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $provider_name;
    public $template;
    public $bonus;
    public $name;
    public $email;
    public $button;

    public function __construct($subject, $template,$provider_name, $bonus, $name, $email)
    {
        $this->subject = $subject;
        $this->template = $template;
        $this->provider_name = $provider_name;
        $this->bonus = $bonus;
        $this->name = $name;  
        $this->email = $email;
        $this->button = url('user/refer-friend');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject( $this->subject)
            ->view('emails.registration.refer_bonus');
    }
}
