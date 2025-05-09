<?php

namespace App\Http\Controllers;

use App\Components\MenuRecursive; // sử dụng class MenuRecursive để lấy danh sách menu
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $menuRecursive;
    public function __construct(MenuRecursive $menuRecursive)
    {
        $this->menuRecursive = $menuRecursive;
    }


    //Giao diện menu 
    public function index()
    {
        // dd('Menu index');
        return view('menus.index');
    }

    //Giao diện tạo menu
    public function create()
    {
        $optionSelect = $this->menuRecursive->menuRecursiveAdd();
        return view('menus.add', compact('optionSelect'));
    }

    public function store()
    {
        $this->Menu
    }
}
