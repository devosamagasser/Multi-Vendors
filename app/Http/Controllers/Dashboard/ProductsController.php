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

    private $interface;

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
    public function show(Product $category)
    {
        return $this->interface->show($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $category)
    {
        return $this->interface->edit($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductsRequest $request, Product $category)
    {
        return $this->interface->update($request,$category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $category)
    {
        return $this->interface->destroy($category);
    }


    public function trash()
    {
        return $this->interface->trash();
    }

    public function restore(Request $request, $category)
    {
        return $this->interface->restore($request,$category);
    }

    public function kill(Request $request, $category)
    {
        return $this->interface->kill($request,$category);
    }
}
