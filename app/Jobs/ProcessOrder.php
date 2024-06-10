<?php

namespace App\Jobs;

use App\Mail\OrderProcessed;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ProcessOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Order $order;

    /**
     * Create a new job instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $price = $this->order->quantity * $this->order->product->price;
        $this->order->update([
            'price' => $price,
            'status' => 'in progress'
        ]);

        $user = $this->order->user;
        Mail::to($user->email)->send(new OrderProcessed($this->order));
    }
}
