<?php

namespace App\Http\Controllers;

class SliderAdminController extends Controller
{
    public function index()
    {
        return view('admin.slider.index');
    }

    public function create()
    {
        return view('admin.slider.add');
    }
}
