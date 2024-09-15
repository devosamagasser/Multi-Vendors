<?php

namespace App\Observers;

use App\Models\cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartObserver
{
    /**
     * Handle the cart "creating" event.
     */
    public function creating(cart $cart): void
    {
        $cart->id = Str::uuid();
        $cart->cookie_id = Cart::getCookieId();
        $cart->user_id = Auth::id();
    }

    /**
     * Handle the cart "updated" event.
     */
    public function updated(cart $cart): void
    {
        //
    }

    /**
     * Handle the cart "deleted" event.
     */
    public function deleted(cart $cart): void
    {
        //
    }

    /**
     * Handle the cart "restored" event.
     */
    public function restored(cart $cart): void
    {
        //
    }

    /**
     * Handle the cart "force deleted" event.
     */
    public function forceDeleted(cart $cart): void
    {
        //
    }
}
