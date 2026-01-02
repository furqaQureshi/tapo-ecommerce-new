<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionPlanCancelMail;
use Carbon\Carbon;

class SendCancellationReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Example usage: php artisan subscription:reminder
     */
    protected $signature = 'subscription:reminder';

    /**
     * The console command description.
     */
    protected $description = 'Send cancellation reminder email to users whose subscription was cancelled 2 days ago';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::now()->subDays(2);

        // Find users with subscription_status = 2 and updated_at = 2 days ago
        $users = User::where('subscription_status', 2)
            ->whereDate('updated_at', $date->toDateString())
            ->get();

        foreach ($users as $user) {
            try {
                Mail::to($user->email)->send(new SubscriptionPlanCancelMail($user));
                $this->info("Reminder sent to: {$user->email}");
            } catch (\Exception $e) {
                $this->error("Failed to send to {$user->email}: " . $e->getMessage());
            }
        }

        return Command::SUCCESS;
    }
}
