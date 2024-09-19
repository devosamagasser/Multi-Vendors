<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class OrderCreatedNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $order = $event->order;
        $user = $order->products->first()->store->user;
        $user->notify(new \App\Notifications\OrderCreatedNotification($order));

//        $user->notifyNow(new OrderCreatedNotification($order));
//        Notification::send($users,new \App\Notifications\OrderCreatedNotification());
    }
}
