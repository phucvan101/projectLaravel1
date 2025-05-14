<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;

class SliderAdminController extends Controller
{
    public function index()
    {
        return view('admin.slider.index');
    }

    // Tạo silder
    public function create()
    {
        return view('admin.slider.add');
    }
    public function store(SliderAddRequest $request)
    {
        dd('view');
    }
}
