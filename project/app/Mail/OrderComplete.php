<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderComplete extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject;
    public $name;
    public $template;
    public $button;
    public function __construct($name, $subject, $template)
    {
        $this->subject = $subject;
        $this->template = $template;
        $this->name = $name;
        $this->button = "<a href='#' target='_blank'>Go to survey page</a>";
    }


    public function build()
    {
        return $this->subject( $this->subject)
            ->view('emails.orders.order_complete');
    }
}
