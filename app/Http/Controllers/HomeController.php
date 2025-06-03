<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function home()
    {
        $info = Auth::user();
        return view('home', compact('info'));
    }
}
