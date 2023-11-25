<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $subject;
    public $template;
    public $gift_card_value;
    public $sign_up_bonus;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $subject, $template, $gift_card_value, $sign_up_bonus)
    {
        $this->name = $name;
        $this->subject = $subject;
        $this->template = $template;
        $this->gift_card_value = $gift_card_value;
        $this->sign_up_bonus = $sign_up_bonus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.registration.wellcome_user');
    }
}
