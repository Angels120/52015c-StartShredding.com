<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuoteRequestMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $order_id;
    public $data;
    public $subject;
    public $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$order_id, $subject, $template)
    {
        $this->order_id =$order_id;
        $this->data = $data;
        $this->subject = $subject; 
        $this->template = $template; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("ORDER#".$this->order_id.": ".$this->subject)
            ->view('emails.quoterequest')
            ->with('template',  $this->template)
            ->with('info', $this->data);
    }
}
