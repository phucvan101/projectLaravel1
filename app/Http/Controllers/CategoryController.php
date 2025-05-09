<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Components\Recursive;
use Illuminate\Support\Str; // thư viện hỗ trợ các hàm xử lý chuỗi trong laravel

class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category) // Sử dụng Dependency Injection để khởi tạo model Category.  
    {
        $this->category = $category;
    }

    public function create()
    {
        $data = $this->category->all(); // lấy tất cả dữ liệu từ bảng category

        $recursive = new Recursive($data); // tạo đối tượng để sử dụng hàm đệ quy
        $htmlOption = $recursive->categoryRecursive();
        return view('category.add', compact('htmlOption'));
    }



    public function index()
    {
        return view('category.index');
    }

    public function store(Request $request)
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('categories.index');
    }
}
