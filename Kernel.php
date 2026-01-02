<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\ScrapeCoupons::class,
                \App\Console\Commands\FetchBlogsCommand::class,
                        \App\Console\Commands\ImportCoupons::class,


    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Schedule the scrape:coupons command to run daily at midnight
        $schedule->command('scrape:coupons')->hourly();
                $schedule->command('blogs:fetch')->hourly();
        $schedule->command('coupons:import')
                 ->hourly()
                 ->withoutOverlapping()
                 ->appendOutputTo(storage_path('logs/coupons-import.log'));


// $schedule->command('dummy:create-categories')->everyMinute();

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
?>