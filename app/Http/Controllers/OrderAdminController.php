<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderAdminController extends Controller
{
    //
    public function index()
    {
        $orders = Order::latest()->paginate(7);
        return view('admin.order.index', compact('orders'));
    }

    // public function search()
    // {
    //     $query = request()->input('query');
    //     $orders = Order::search('order_code', $query)->paginate(5);
    //     // return view('admin.order.search', compact(['query', 'orders']));
    // }
}
