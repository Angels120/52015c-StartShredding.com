<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PromoRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $promo_link;
    public $email_subject;
    public $template;
    public $first_name;
    public $last_name;
    public function __construct($promo_link, $email_subject, $template, $first_name, $last_name)
    {
        $this->promo_link = $promo_link;
        $this->email_subject = $email_subject;
        $this->template = $template;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject( $this->email_subject)
            ->view('emails.registration.promo_registration');
    }
}
