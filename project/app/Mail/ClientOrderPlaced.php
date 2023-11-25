<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientOrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $usertoken;
    public $button;




    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$usertoken)
    {
        $this->name = $name;
        $this->usertoken = $usertoken;
        $this->button = "<a href='" . url('/client_user_activate').'/'.$usertoken. "' target='_blank'>Click Here</a>";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Your Order Placed Successfully!")
            ->view('emails.orders.Clientplaced');
    }
}
