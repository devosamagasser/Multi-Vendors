<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DeductProductQuantity
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
        foreach ($order->products as $order):
            $order->decrement('stock',$order->pivot->quantity);
        endforeach;

//            Product::find($cart->product->id)->update([
//                'stock' => DB::raw("stock - {$cart->quantity}")
//            ]);
    }
}
