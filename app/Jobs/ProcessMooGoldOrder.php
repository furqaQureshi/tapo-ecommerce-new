<?php

namespace App\Jobs;

use App\Mail\OrderMail;
use App\Models\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\MooGoldService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ProcessMooGoldOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $order;
    protected $orderItem;
    protected $item;

    public function __construct(Order $order, OrderItem $orderItem, $item)
    {
        $this->order = $order;
        $this->orderItem = $orderItem;
        $this->item = $item;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $mooGold = new MooGoldService();

        $dataForApi = [
            'category'    => 1,
            'product-id'  => $this->orderItem->variant->source_id,
            'quantity'    => $this->orderItem->quantity ?? 1,
        ];
        Log::info(['game_user_id:-' => $this->item]);
        Log::info(['order:-' => $this->order]);
        $carts = $this->item;

        if (!empty($this->item['game_user_id'])) {
            $dataForApi['User ID'] = $this->item['game_user_id'];
        } elseif (!empty($this->item['game_user_name'])) {
            $dataForApi['Player ID'] = $this->item['game_user_name'];
        }

        if (!empty($this->item['game_server_id'])) {
            $dataForApi['Server'] = $this->item['game_server_id'];
        }

        if (!empty($this->item['game_email'])) {
            $dataForApi['Player Email'] = $this->item['game_email'];
        }

        $response = $mooGold->createOrder($dataForApi, $this->order->order_number);

        if (isset($response['err_code'])) {
            $this->order->update([
                'status'         => 'pending',
                'failed_message' => $response['err_message'],
            ]);

            $this->orderItem->update([
                'delivery_status' => 'pending',
            ]);

            $mailData = [
                'status' => 'Pending',
                'short_msg' => 'Your order has been pending.',
                'user' =>  Auth::check() ? auth()->user()->name : 'Customer',
                'long_msg' => 'Update! Your order has been sent on pending please wait till our approval. Here are your order details',
                'product' => $this->orderItem->product->name,
                'order_no' => $this->order->order_number,
                'order_date' => $this->order->created_at->format('Y-m-d'),
                'logo' => url('admin/assets/images/logo-light.png')
            ];
            $email = null;
            if (Auth::check()) {
                $email = auth()->user()->email;
            } else if ($this->order->guest_email) {
                $email = $this->order->guest_email;
            }
            Mail::to($email)->queue(new OrderMail($mailData));
        }

        if (isset($response['status']) && $response['status']) {
            $this->order->update([
                'status' => 'completed',
            ]);
            $this->orderItem->update([
                'source' => 'M',
                'source_order_id' => $response['order_id']
            ]);

            $mailData = [
                'status' => 'Completed',
                'short_msg' => 'Your order has been completed.',
                'user' =>  Auth::check() ? auth()->user()->name : 'Customer',
                'long_msg' => 'Great News! Your order has been completed. Here are your order details',
                'product' => $this->orderItem->product->name,
                'order_no' => $this->order->order_number,
                'order_date' => $this->order->created_at->format('Y-m-d'),
                'logo' => url('admin/assets/images/logo-light.png')
            ];
            $email = null;
            if (Auth::check()) {
                $email = auth()->user()->email;
            } else if ($this->order->guest_email) {
                $email = $this->order->guest_email;
            }
            Mail::to($email)->queue(new OrderMail($mailData));
        }
    }
}
