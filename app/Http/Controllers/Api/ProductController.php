<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductAddRequest;
use App\Traits\HttpResponses;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    //
    use HttpResponses;
    use StorageImageTrait;
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

        $dataCreate = [
            'name' => $request->name,
            'price' => $request->price,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
        ];
        $dataImageProduct = $this->storageTraitUpload('feature_image_path', 'product');
        if (!empty($dataImageProduct)) {
            $dataCreate['feature_image_name'] = $dataImageProduct['file_name'];
            $dataCreate['feature_image_path'] = $dataImageProduct['file_path'];
        } else {
            return response()->json([
                'message' => 'Feature image is required.'
            ], 422);
        }

        $product = Product::create($dataCreate);

        return new ProductResource($product);
    }

    public function update($id, ProductAddRequest $request)
    {
        $product = Product::findOrFail($id); // tự động throw exception nếu không tìm thấy 
        $dataUpdate = [];
        if ($request->has('name')) {
            $dataUpdate['name'] = $request->name;
        }
        if ($request->has('price')) {
            $dataUpdate['price'] = $request->price;
        }
        if ($request->has('content')) {
            $dataUpdate['content'] = $request->content;
        }
        if ($request->has('category_id')) {
            $dataUpdate['category_id'] = $request->category_id;
        }

        // Check if the user is authorized to update the product
        if (Auth::id() !== $product->user_id) {
            return response()->json([
                'message' => 'You are not authorized to update this product.'
            ], 403);
        }

        $dataImageProduct = $this->storageTraitUpload('feature_image_path', 'product');
        if (!empty($dataImageProduct)) {
            $dataUpdate['feature_image_name'] = $dataImageProduct['file_name'];
            $dataUpdate['feature_image_path'] = $dataImageProduct['file_path'];
        }
        $product->update($dataUpdate);

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
