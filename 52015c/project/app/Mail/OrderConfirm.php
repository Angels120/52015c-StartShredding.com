<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderConfirm extends Mailable
{
    use Queueable, SerializesModels;


    public $button;
    public $user_data;
    public $order_details;
    public $order;
    public $token;
    public $ord_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_data,$order_details,$order,$token,$ord_id)
    {
        $this->user_data = $user_data;
        $this->order_details = $order_details;
        $this->order = $order;
        $this->token = $token;
        $this->ord_id = $ord_id;

        $this->button = "<a href='" . url('user_activated').'/'.$token.'/'.$ord_id. "' target='_blank'>Please confirm your order</a>";
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Please confirm your order")
            ->view('emails.orders.orderconfirm');
    }
}
