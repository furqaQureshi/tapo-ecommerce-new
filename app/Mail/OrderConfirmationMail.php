<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $orderDetails;
    public $orderItems;

    /**
     * Create a new message instance.
     */
    public function __construct($order, $orderDetails, $orderItems)
    {
        $this->order = $order;
        $this->orderDetails = $orderDetails;
        $this->orderItems = $orderItems;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject("Your order #{$this->order->order_number} is confirmed 🛍✨")
                    ->markdown('emails.orders.confirmation');
    }
}
