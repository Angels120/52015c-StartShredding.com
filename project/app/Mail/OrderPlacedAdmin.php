<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlacedAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public $template;
    public $subject;
    public $button;
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $subject, $template)
    {
        $this->template = $template;
        $this->subject = $subject;
        $this->order = $order;
        $this->button = "<a href='" . route('admin.dashboard') . "' target='_blank'>Dashboard</a>";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.orders.placedToAdmin');
    }
}
