<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\ProductTag;
use Illuminate\Http\Request;
use App\Components\Recursive;
use App\Models\ProductImage;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Str;
use Storage;

class AdminProductController extends Controller
{
    //
    use StorageImageTrait;
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;
    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }


    public function index()
    {
        return view('admin.product.index');
    }

    // Trang tao sp
    public function create()
    {
        $htmlOption = $this->getCategory($parentId = ''); // lấy danh sách category cha
        return view('admin.product.add', compact('htmlOption'));
    }

    public function getCategory($parentId)
    {

        $data = $this->category->all(); // lấy tất cả dữ liệu từ bảng category

        $recursive = new Recursive($data); // tạo đối tượng để sử dụng hàm đệ quy
        $htmlOption = $recursive->categoryRecursive($parentId);
        return $htmlOption;
    }

    // lưu vào database
    public function store()
    {
        $dataProductCreate = [
            'name' => request()->name,
            'price' => request()->price,
            'content' => request()->content,
            'user_id' => auth()->id(), // lấy được id của user đang log hệ thống
            'category_id' => request()->category_id,

        ];
        $dataUploadFeatureImage = $this->storageTraitUpload('feature_image_path', 'product');
        if (!empty($dataUploadFeatureImage)) {
            $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
        }
        $product = $this->product->create($dataProductCreate);
        // inter data to product_images
        if (request()->hasFile('image_path')) {
            foreach (request()->image_path as $fileItem) {
                $dataProductImageDetail = $this->storageTraitUploadMultiple($fileItem, 'product');
                $product->images()->create([
                    'image_path' => $dataProductImageDetail['file_path'],
                    'image_name' => $dataProductImageDetail['file_name'],
                ]); // Sử dụng quan hệ images() đã định nghĩa trong model Product (kiểu hasMany) để tạo mới bản ghi trong bảng product_images và tự động gán 
            }
        }
        // Insert tags for product
        foreach (request()->tags as $tagItem) {
            // inter to tags 
            $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem]); // tìm tag có tên $tagItem trong bảng tags -> tồn tại thì trả về -> chưa tồn tại thì tạo mới tag với tên $tagItem rồi trả về. 
            $tagIds[] = $tagInstance->id;
        }
        $product->tags()->attach($tagIds); // Gắn tất cả các tag (theo danh sách id trong $tagIds) vào sản phẩm vừa tạo, Laravel sẽ tự động thêm các bản ghi vào bảng trung gian product_tags (giả sử bạn đặt tên bảng trung gian là như vậy).
    }
}
