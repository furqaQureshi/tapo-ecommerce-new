<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        \App\Console\Commands\NextOrderReminderCommand::class,
    ];
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('giftcard:send-emails')->everyMinute();
        $schedule->command('giftcarddelay:send-emails')->everyMinute();
        $schedule->command('product:process-payouts')->everyTenMinutes();
        $schedule->command('synn:update-transactions')->everyFiveMinutes();
        $schedule->command('reminders:send')->dailyAt('9:00');
        $schedule->command('orders:reminder')->dailyAt('09:00');
        $schedule->command('subscription:reminder')->daily();
        $schedule->command('subscriptions:update')->dailyAt('00:00');
        $schedule->command('token:fetch')->everySixHours();
        $schedule->command('tracking:fetch')->everyTenMinutes();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
