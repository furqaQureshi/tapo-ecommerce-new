<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderReminderMail;

class SendMonthlyReminders extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send monthly order reminder emails to users with subscriptions';

    public function handle()
    {
        $users = User::whereHas('subscription_detail')->get();

        foreach ($users as $user) {
            $order = Order::where('user_id', $user->id)->latest()->first();

            if (!$order) {
                continue;
            }

            // Check if order is exactly 30 days old
            if (Carbon::parse($order->created_at)->addDays(30)->isToday()) {
                $selectionDeadline = Carbon::parse($order->created_at)
                    ->addDays(30)
                    ->format('F j, Y');

                Mail::to($user->email)->send(new OrderReminderMail($user, $order, $selectionDeadline));

                $this->info("Reminder sent to {$user->email}");
            }
        }

        return Command::SUCCESS;
    }

}
