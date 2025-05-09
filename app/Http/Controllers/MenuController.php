<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    //Giao diện menu 
    public function index()
    {
        // dd('Menu index');
        return view('menus.index');
    }

    //Giao diện tạo menu
    public function create()
    {
        // dd('Menu create');
        return view('menus.add');
    }

    public function store()
    {
        dd('Menu create');
        // return view('menus.create');
    }
}
