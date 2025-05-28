<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class OrderAdminController extends Controller
{
    //view orders
    public function index()
    {
        $orders = Order::latest()->paginate(7);
        return view('admin.order.index', compact('orders'));
    }
    //search orders
    public function search()
    {
        $query = request()->input('query');
        $orders = Order::search('order_code', $query)->paginate(5)->appends(['query' => $query]);
        return view('admin.order.search', compact(['query', 'orders']));
    }
    //view order detail
    public function detail($id)
    {
        $order = Order::find($id);
        return view('admin.order.detail', compact('order'));
    }

    // view order edit 
    public function edit($id)
    {
        $order = Order::find($id);
        return view('admin.order.edit', compact('order'));
    }

    // update cart 
    public function updateCart($idOrder)  // khi sử dụng call ajax k được sử dụng dd()
    {

        try {
            // Debug: Log tất cả request data
            // Log::info('UpdateCart called', [
            //     'idOrder' => $idOrder,
            //     'request_data' => request()->all()
            // ]);

            // Kiểm tra input
            if (!request()->id || !request()->quantity) {
                Log::error('Missing required data', [
                    'id' => request()->id,
                    'quantity' => request()->quantity
                ]);
                return response()->json(['message' => 'Missing required data', 'code' => 400], 400);
            }

            // Tìm order
            $order = Order::find($idOrder);
            if (!$order) {
                Log::error('Order not found', ['idOrder' => $idOrder]);
                return response()->json(['message' => 'Order not found', 'code' => 404], 404);
            }

            // Log::info('Order found', ['order_id' => $order->id]);

            // Tìm cart item
            $cartItem = $order->orderDetails()->where('id', request()->id)->first();
            if (!$cartItem) {
                Log::error('Cart item not found', [
                    'order_id' => $order->id,
                    'cart_item_id' => request()->id
                ]);
                return response()->json(['message' => 'Cart item not found', 'code' => 404], 404);
            }

            // Log::info('Cart item found', ['cart_item_id' => $cartItem->id]);

            // Cập nhật quantity
            $cartItem->quantity = request()->quantity;
            $cartItem->save();

            // Log::info('Cart item updated', ['new_quantity' => $cartItem->quantity]);

            // Cập nhật total - SỬA LẠI CÁCH TÍNH
            $newTotal = 0;
            foreach ($order->orderDetails as $item) {
                $newTotal += $item->product_price * $item->quantity;
            }
            $order->total_amount = $newTotal;
            $order->save();

            // Log::info('Order total updated', ['new_total' => $order->total]);

            // Lấy updated cart items
            $cartItems = $order->fresh()->orderDetails;

            // Log::info('About to render view');

            // Render cart component
            $cartComponent = view('components.cart', compact('order'))->render();

            // Log::info('View rendered successfully');

            return response()->json([
                'cartComponent' => $cartComponent,
                'cartItems' => $cartItems,
                'newTotal' => $order->total_amount,
                'code' => 200,
                'message' => 'Success'
            ], 200);
        } catch (\Exception $e) {
            Log::error('UpdateCart Exception', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => 'Server error: ' . $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    // delete order 
    public function delete($id) {}
}
