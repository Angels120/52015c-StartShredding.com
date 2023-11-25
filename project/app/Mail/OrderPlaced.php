<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $name;
    public $subject;
    public $template;
    public $button;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$order, $subject, $template)
    {
        $this->name = $name;
        $this->order = $order;
        $this->subject = $subject;
        $this->template = $template;
        $this->button = "<a href='" . url('user-dashboard') . "' target='_blank'>Click to track status of your order</a>";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.orders.placed');
    }
}
