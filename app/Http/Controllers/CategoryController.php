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

    // hàm này sẽ được gọi khi người dùng truy cập vào đường dẫn categories/create
    public function create()
    {
        $htmlOption = $this->getCategory($parentId = ''); // lấy danh sách category cha
        return view('admin.category.add', compact('htmlOption'));
    }


    // hàm này sẽ được gọi khi người dùng truy cập vào đường dẫn categories
    public function index()
    {
        $categories = $this->category->paginate(5);
        // dd($categories);

        return view('admin.category.index', compact('categories'));
    }

    // hàm này sẽ được gọi khi người dùng gửi dữ liệu từ form tạo mới category
    public function store(Request $request)
    {
        $this->category->create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => Str::slug($request->name)
        ]);
        return redirect()->route('categories.index');
    }

    // hàm create mới
    public function getCategory($parentId)
    {
        $data = $this->category->all(); // lấy tất cả dữ liệu từ bảng category

        $recursive = new Recursive($data); // tạo đối tượng để sử dụng hàm đệ quy
        $htmlOption = $recursive->categoryRecursive($parentId);
        return $htmlOption;
    }

    // hàm này sẽ được gọi khi người dùng gửi dữ liệu từ form sửa category
    public function edit($id)
    {
        $category = $this->category->find($id); // tìm category theo id
        $htmlOption = $this->getCategory($category->parent_id); // lấy danh sách category cha
        return view('admin.category.edit', compact(['htmlOption', 'category']));
    }

    // hàm này sẽ được gọi khi người dùng gửi dữ liệu từ form sửa category
    public function update($id)
    {
        $this->category->find($id)->update([
            'name' => request()->name,
            'parent_id' => request()->parent_id,
            'slug' => Str::slug(request()->name)
        ]);
        return redirect()->route('categories.index');
    }

    // hàm này sẽ được gọi khi người dùng gửi dữ liệu từ form xóa category
    public function delete($id)
    {
        $this->category->find($id)->delete();
        return redirect()->route('categories.index');
    }
}
