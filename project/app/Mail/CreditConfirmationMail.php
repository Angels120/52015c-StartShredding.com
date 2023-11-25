<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreditConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $subject;
    public $template;
    public $Cbalance;
    public $transaction;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $subject,$template,$Cbalance, $transaction)
    {
        $this->name = $name;
        $this->subject = $subject;
        $this->template = $template;
        $this->Cbalance = $Cbalance;
        $this->transaction = $transaction->reference_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
        ->view('emails.orders.creditConfirmation')
        ->with('name',  $this->name)
        ->with('Cbalance', $this->Cbalance);
    }
}
