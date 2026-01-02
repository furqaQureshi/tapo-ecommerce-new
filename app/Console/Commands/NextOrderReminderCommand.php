<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\User;
use App\Notifications\NextOrderReminder;
use Carbon\Carbon;

class NextOrderReminderCommand extends Command
{
    protected $signature = 'orders:reminder';
    protected $description = 'Send reminders to users 5 days before their next subscription order is due';

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            $lastSubscription = Order::where('type', 1) // 1 = subscription
                ->where('on_hold', 0)
                ->where('user_id', $user->id)
                ->latest('created_at')
                ->first();

            if ($lastSubscription) {
                $daysSince = Carbon::parse($lastSubscription->created_at)
                    ->diffInDays(Carbon::now());

                if ($daysSince === 25) {
                    // if ($daysSince >= 0) {
                    $user->notify(new NextOrderReminder(
                        "Psst, {$user->name} time to pick next month’s goodies! 🎁 We’ll auto-pick for you if you don’t choose before (insert renewal date)"
                    ));

                    $this->info("Reminder stored for User {$user->id}");
                }
            }
        }

        return Command::SUCCESS;
    }
}
