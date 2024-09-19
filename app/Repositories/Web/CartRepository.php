<?php

namespace App\Repositories\Web;
use App\Interfaces\Web\CartInterface;
use App\Models\Cart;
use App\Rules\ProductStockRules;
use Illuminate\Support\Facades\Auth;

class CartRepository implements CartInterface
{
    public $items;

    public function __construct()
    {
        $this->items = collect([]);
    }

    public function getItems()
    {
        if (!$this->items->count())
            $this->items = Cart::with('product')->get();
        return $this->items;
    }

    // Define your repository methods here
    public function index()
    {
        $carts = $this->getItems();
        $total = $this->total();
        $totalBefore = $this->totalBefore();
        return view('web.cart.index',compact('carts','total','totalBefore'));
    }

    public function store($request)
    {
        $validated_data = $request->validate([
            'product_id' => 'required|int|exists:products,id',
            'quantity' => ['required','int','min:1',new ProductStockRules($request->product_id)],
        ]);

        if(Cart::where('product_id' , $validated_data['product_id'])->exists())
            return $this->update($request,$validated_data['product_id']);

        Cart::create([
            'product_id' => $validated_data['product_id'],
            'quantity' => $validated_data['quantity']
        ]);

        return redirect()->back();
    }

    public function update($request, $product)
    {
        $validated_data = $request->validate([
            'quantity' => ['required','int','min:1',new ProductStockRules($product)],
        ]);

        Cart::where('product_id',$product)->update([
            'quantity' => $validated_data['quantity']
        ]);

        return redirect()->back();
    }

    public function destroy($product)
    {
        Cart::where('product',$product)->desrtoy();
        return redirect()->back();
    }

    public function empty()
    {
        Cart::query()->delete();
    }

    public function total()
    {
        $cart = $this->getItems();
        return $cart->sum(function ($item){
            return $item->quantity * $item->product->price;
        });
    }

    public function totalBefore()
    {
        $cart = $this->getItems();
        return $cart->sum(function ($item){
            return $item->quantity * $item->product->compare_price;
        });
    }

}
