<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $subject;
    public $template;
    public $status;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $subject,$template,$status)
    {
        $this->name = $name;
        $this->subject = $subject;
        $this->template = $template;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
            ->view('emails.orders.adminStatusUpdate')
            ->with('name',  $this->name)
            ->with('status', $this->status);
    }
}
