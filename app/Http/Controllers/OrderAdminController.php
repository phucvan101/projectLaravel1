<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Log;
use App\Traits\DeleteModelTrait;

class OrderAdminController extends Controller
{
    use DeleteModelTrait;
    protected $orderDetail;
    public function __construct(OrderDetail $orderDetail)
    {
        $this->orderDetail = $orderDetail;
    }

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

    // delete cart item
    public function deleteCart($idOrder, $idOrderDetail)
    {
        try {
            // Tìm order detail item
            $orderDetail = OrderDetail::find($idOrderDetail);

            if (!$orderDetail) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Order detail not found'
                ], 404);
            }

            // Xóa item
            $orderDetail->delete();

            // Cập nhật lại total amount của order
            $order = Order::find($idOrder);
            if ($order) {
                $newTotal = 0;
                foreach ($order->orderDetails as $item) {
                    $newTotal += $item->product_price * $item->quantity;
                }
                $order->total_amount = $newTotal;
                $order->save();
            }
            // Trả về thông tin ra html 
            $cartComponent = view('components.cart', compact('order'))->render();

            return response()->json([
                'code' => 200,
                'message' => 'Item deleted successfully',
                'cartComponent' => $cartComponent, // Trả về component cart đã cập nhật
            ], 200);
        } catch (\Exception $e) {
            Log::error('Delete cart error: ' . $e->getMessage());
            return response()->json([
                'code' => 500,
                'message' => 'Server error: ' . $e->getMessage()
            ], 500);
        }
    }

    // update order
    public function updateOrder(OrderRequest $request, $id)
    {
        try {
            Order::find($id)->update([
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'customer_email' => $request->customer_email,
            ]);
            return redirect()->route('orders.index')->with('success', 'Order updated successfully');
        } catch (\Exception $e) {
            Log::error('Update order error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update order: ' . $e->getMessage());
        }
    }

    // delete order 
    public function delete($id) {}
}
