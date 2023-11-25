<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GiftCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $subject;
    public $template;
    public $button;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $subject, $template)
    {
        $this->data = $data;
        $this->subject = $subject;
        $this->template = $template;
        $this->button = url('user/registration') . "?giftcode=" . $data["code"];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('A Gift for You!')
            ->from('sales@ubeclean.com', $this->data['first_name'] . ' ' . $this->data['last_name'])
            ->view('emails.giftcode');
        //->with('button',  $this->button);
    }
}
