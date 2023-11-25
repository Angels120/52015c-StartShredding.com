<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GiftCardMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $template;
    protected $baseurl;
    protected $settings;
    protected $auth_code;
    protected $Clients;
    protected $boughtgiftcard;
    protected $button;
    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($template, $baseurl, $message, $settings, $Clients, $boughtgiftcard, $auth_code)
    {
        $this->subject = $template['subject'];
        $this->template = $template;
        $this->baseurl = $baseurl;
        $this->message = $message;
        $this->settings = $settings;
        $this->auth_code = $auth_code;
        $this->Clients = $Clients;
        $this->boughtgiftcard = $boughtgiftcard;
        $this->button = url($baseurl . '/user/gift-cards/validate/' . $boughtgiftcard->id . '/' . $auth_code);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.giftcard')
            ->with([
                'template' => $this->template,
                'baseurl' => $this->baseurl,
                'settings' => $this->settings,
                'auth_code' => $this->auth_code,
                'Clients' => $this->Clients,
                'boughtgiftcard' => $this->boughtgiftcard,
                'message' => $this->message,
                'button' => $this->button
            ]);
    }
}
