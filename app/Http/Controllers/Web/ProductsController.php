<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {

    }

    public function show(Product $product)
    {
        if($product->status != 'active')
            abort(404);
        return view('web.products.single-product',compact('product'));
    }

}
