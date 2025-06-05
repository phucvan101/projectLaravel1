<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductAddRequest;

class ProductController extends Controller
{
    //
    public function index()
    {
        // return new ProductResource(
        //     Product::all()
        // );
        return ProductResource::collection(
            Product::all()
        );
    }

    public function show($id)
    {
        return new ProductResource(
            Product::findOrFail($id)
        );
    }

    public function store(ProductAddRequest $request)
    {

        $product = Product::create($request->all());

        return new ProductResource($product);
    }

    public function update($id, ProductAddRequest $request)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());

        return new ProductResource($product);
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully.'
        ], 200);
    }
}
