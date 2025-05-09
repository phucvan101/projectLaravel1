<?php

namespace App\Http\Controllers;

use App\Components\MenuRecursive; // sử dụng class MenuRecursive để lấy danh sách menu
use App\Models\Menu; // sử dụng class Menu để tương tác với bảng menu
use Illuminate\Http\Request;

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
            'parent_id' => request()->parent_id,
        ]);
        return redirect()->route('menus.index');
    }
}
