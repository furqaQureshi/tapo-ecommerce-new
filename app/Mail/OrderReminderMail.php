<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $order;
    public $selectionDeadline;

    public function __construct($user, $order, $selectionDeadline)
    {
        $this->user = $user;
        $this->order = $order;
        $this->selectionDeadline = $selectionDeadline;
    }

    public function build()
    {
        return $this->subject('Order Reminder')
                    ->view('emails.order_reminder')
                    ->with([
                        'user' => $this->user,
                        'order' => $this->order,
                        'selectionDeadline' => $this->selectionDeadline,
                    ]);
    }
}

