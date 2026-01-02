<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SubscriptionRenewMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $checkout;

    /**
     * Create a new message instance.
     */
    public function __construct($user,$checkout)
    {
        $this->user = $user;
        $this->checkout = $checkout;
    }

    public function build()
    {
        return $this->subject('Welcome to ZÉRA Mom Club, '.$this->user->name.'!🌸')
                    ->markdown('emails.subscribers.welcome');
    }

    
}
