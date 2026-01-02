<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AbandonedCartMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $cartItems;

    public function __construct($user, $cartItems)
    {
        $this->user = $user;
        $this->cartItems = $cartItems;
    }

    public function build()
    {
        return $this->subject("You’re one step closer {$this->user->name}, complete your cart now! 🛒")
                    ->markdown('emails.carts.abandoned');
    }
}
