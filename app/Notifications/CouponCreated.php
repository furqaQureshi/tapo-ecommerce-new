<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Coupon;

class CouponCreated extends Notification
{
    use Queueable;

    protected $coupon;

    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Coupon Available!')
            ->view('emails.coupon_created', [
                'coupon' => $this->coupon,
                'user' => $notifiable->name,
                'logo' => url('admin/assets/images/logo-light.png'),
            ]);
    }
}
