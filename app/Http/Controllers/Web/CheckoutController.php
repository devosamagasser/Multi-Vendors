<?php

namespace App\Http\Controllers\Web;

use App\Events\OrderCreated;
use App\Facades\Cart;
use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Timer\Exception;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $billdata = Cart::getitems();
        $total = Cart::total();
        return view('web.cart.checkout',compact('billdata','total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate

        $request->merge([
            'total' => Cart::total(),
            'name' => $request->f_name.' '.$request->l_name
        ]);
        DB::transaction(function () use($request){
            $bill = Bill::create($request->all());
            $orders = Cart::getItems();
            foreach ($orders as $cart){
                BillProduct::create([
                    'bill_id' => $bill->id,
                    'product_id' => $cart->product->id,
                    'product_name' => $cart->product->name,
                    'product_price' => $cart->product->price,
                    'product_compare_price' => $cart->product->compare_price,
                    'quantity' => $cart->quantity,
                    'product_store_id' => $cart->product->store_id
                ]);
            }
//          event('DedicateStock',$cart);
            event(new OrderCreated($bill));

        });


//        DB::beginTransaction();
//        try {
//
//            // queries
//
//            DB::commit();
//        }
//        catch(\Throwable $e){
//            DB::rollBack();
//            throw $e;
//        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Bill $bill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bill $bill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bill $bill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        //
    }
}
