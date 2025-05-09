<?php

namespace App\Http\Controllers;

use App\Components\MenuRecursive; // sử dụng class MenuRecursive để lấy danh sách menu
use App\Models\Menu; // sử dụng class Menu để tương tác với bảng menu

use Illuminate\Http\Request;
use Illuminate\Support\Str; // thư viện hỗ trợ các hàm xử lý chuỗi trong laravel

class MenuController extends Controller
{
    private $menuRecursive;
    private $menu;
    public function __construct(MenuRecursive $menuRecursive, Menu $menu)
    {
        $this->menuRecursive = $menuRecursive;
        $this->menu = $menu;
    }


    //Giao diện menu 
    public function index()
    {
        $menus = $this->menu->paginate(5);
        return view('menus.index', compact('menus'));
    }

    //Giao diện tạo menu
    public function create()
    {
        $optionSelect = $this->menuRecursive->menuRecursiveAdd();
        return view('menus.add', compact('optionSelect'));
    }

    public function store()
    {
        $this->menu->create([
            'name' => request()->name,
            'slug' => Str::slug(request()->name), // tạo slug từ tên menu
            'slug' => Str::slug(request()->name), // tạo slug từ tên menu
        ]);
        return redirect()->route('menus.index');
    }
}
