<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Traits\ApiResponseTrait;
use Dotenv\Validator;
use http\Env\Response;
use Illuminate\Http\Request;

class ProducrController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::filter($request->query())->with('store:id,name','category:id,name','tags:id,name')->paginate();
        return $this->apiResponse(ProductResource::collection($products));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category_id' => 'required|int|exists:categories,id',
            'status' => 'in:Active,Inactive',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'required|numeric|gt:price',
        ]);

        $product = Product::create($request->all());

        return Response::json($product,201 );

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->apiResponse(new ProductResource($product));
//        return $product->load('store:id,name','category:id,name','tags:id,name');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Product $product)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|int|exists:categories,id',
            'status' => 'in:Active,Inactive',
            'price' => 'sometimes|required|numeric|min:0',
            'compare_price' => 'sometimes|required|numeric|gt:price',
        ]);

        $product->update($request->all());

        return Response::json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'message' => 'product deleted successfully'
        ],200);
    }
}
