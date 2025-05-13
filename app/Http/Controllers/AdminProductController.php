<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Components\Recursive;

class AdminProductController extends Controller
{
    //
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
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
        $fileName = request()->feature_image_path->getClientOriginalName(); // tên gốc ảnh từ file trên máy tính
        $path = request()->file('feature_image_path')->storeAs('public/product', $fileName); // up ảnh 
    }
}
