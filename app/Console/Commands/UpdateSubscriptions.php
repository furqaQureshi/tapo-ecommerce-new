<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Razorpay\Api\Api;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SubscriptionUpdated;
use App\Mail\SubscriptionFailed;

class UpdateSubscriptions extends Command
{
    protected $signature = 'subscriptions:update';
    protected $description = 'Daily job to check and update subscription statuses, send emails on success/failure';

    public function handle()
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        // Fetch active subscription orders where current date is between start_at and expire_at (if set)
        $today = now();
        $orders = Order::whereNotNull('razorpay_subscription_id')
            ->where('payment_method', 'subscription')
            ->where('status', 'completed') // Assuming 'completed' means active; adjust if needed
            ->where(function ($query) use ($today) {
                $query->whereNull('subscription_expire_at')
                    ->orWhere('subscription_expire_at', '>=', $today->timestamp);
            })
            ->where('subscription_start_at', '<=', $today->timestamp)
            ->get();

        foreach ($orders as $order) {
            try {
                $subscription = $api->subscription->fetch($order->razorpay_subscription_id);

                $updated = false;
                $failed = false;

                // Check if a new payment was successful (paid_count increased)
                if ($subscription['paid_count'] > $order->paid_count) {
                    $order->paid_count = $subscription['paid_count'];
                    $updated = true;
                }

                // Update other fields
                $order->remaining_count = $subscription['remaining_count'] ?? null;
                $order->subscription_status = $subscription['status'];
                $order->next_charge_at = $subscription['charge_at'] ? date('Y-m-d H:i:s', $subscription['charge_at']) : null;

                // Check for failure statuses
                if (in_array($subscription['status'], ['halted', 'cancelled', 'expired'])) {
                    $order->status = 'failed'; // Or 'cancelled' based on status
                    $failed = true;
                }

                $order->save();

                // Send emails if applicable
                // Only send if there was a change today (e.g., billing day or failure)
                // To determine if it's "us din ki subscription" (billing day), check if charge_at was in the last 24 hours or paid_count changed
                if ($updated || ($subscription['charge_at'] <= time() && $subscription['charge_at'] >= (time() - 86400))) {
                    if ($updated) {
                        Mail::to($order->email)->send(new SubscriptionUpdated($order));
                    } elseif ($failed) {
                        Mail::to($order->email)->send(new SubscriptionFailed($order));
                    }
                }
            } catch (\Exception $e) {
                Log::error('Failed to fetch/update subscription', [
                    'order_id' => $order->id,
                    'subscription_id' => $order->razorpay_subscription_id,
                    'error' => $e->getMessage(),
                ]);
                // Send failure email on exception
                Mail::to($order->email)->send(new SubscriptionFailed($order));
            }
        }

        $this->info('Subscriptions updated successfully.');
    }
}
