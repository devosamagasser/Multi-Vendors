<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Interfaces\Web\CartInterface;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(CartInterface $interface)
    {
        $this->interface = $interface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->interface->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->interface->store($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        return $this->interface->update($request, $product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        return $this->interface->destroy($product);
    }

    public function empty($product)
    {
        Cart::where('cookie_id',$this->cookie_id)->delete();
    }

    public function total()
    {
        $cart = Cart::with('product')->where('cookie_id',$this->cookie_id)->get();
        return $cart->sum(function ($item){
            return $item->quantity * $item->product->price;
        });
    }

}
