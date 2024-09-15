<?php

namespace App\Facades;

use App\Interfaces\Web\CartInterface;
use Illuminate\Support\Facades\Facade;

class Cart extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return CartInterface::class;
    }
}
