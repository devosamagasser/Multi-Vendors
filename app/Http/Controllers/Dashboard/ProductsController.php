<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Products\StoreProductsRequest;
use App\Http\Requests\Dashboard\Products\UpdateProductsRequest;
use App\Interfaces\Dashboard\ProductsInterface;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function __construct(ProductsInterface $interface)
    {
        $this->interface = $interface;
        $this->middleware(['auth','verified']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->interface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->interface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductsRequest $request)
    {
        return $this->interface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->interface->show($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return $this->interface->edit($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductsRequest $request, Product $product)
    {
        return $this->interface->update($request,$product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        return $this->interface->destroy($product);
    }


    public function trash()
    {
        return $this->interface->trash();
    }

    public function restore(Request $request, $product)
    {
        return $this->interface->restore($request,$product);
    }

    public function kill(Request $request, $product)
    {
        return $this->interface->kill($request,$product);
    }
}
