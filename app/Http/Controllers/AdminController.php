<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PharIo\Manifest\RequiresElement;
use Auth;

class AdminController extends Controller
{
    //
    public function loginAdmin()
    {
        if (auth()->check()) {
            return redirect()->to('home');
        }
        return view('login');
    }

    public function postLoginAdmin()
    {
        $remember = request()->has(key: 'remember-me') ? true : false;
        // dd($remember);
        if (auth()->attempt([
            'email' => request()->email,
            'password' => request()->password,
        ], $remember)) {
            return redirect()->to('home');
        } else {
            dd("error");
        }
    }
}
