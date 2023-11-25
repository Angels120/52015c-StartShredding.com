<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserPassResetShopMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $button;
    public $subject;
    public $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $subject, $template)
    {
        $this->subject = $subject;
        $this->template = $template;
        $this->button = url('/home/shop-resetPassword', $token);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.registration.reset-password')
            ->with('link',  $this->button);
    }
}
