<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    //
    public function index()
    {

        $order = Order::all();
        return OrderResource::collection($order);
    }

    public function show($id)
    {
        $order = Order::find($id);
        return new OrderResource($order);
    }

    public function update(OrderRequest $request, $id)
    {
        $order = Order::findOrFail($id);
        // cập nhật thông tin đơn hàng trừ total_amount       
        $data = $request->validated();
        unset($data['total_amount']); // loại bỏ trường total_amount khỏi dữ liệu cập nhật
        $order->update($data);
        // tính lại total_amount từ order details 
        $newTotal = $order->orderDetails->sum(function ($item) {
            return $item->quantity * $item->product_price;
        });
        $order->total_amount = $newTotal;

        $order->save();
        return new OrderResource($order);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->orderDetails()->delete(); // Xóa tất cả các chi tiết đơn hàng liên quan đến đơn hàng này
        // Xóa đơn hàng
        $order->delete();

        return response()->json([
            'message' => 'Order deleted successfully.'
        ], 200);
    }

    public function updateCart($idOrder, $idCart, Request $request)
    {
        if (!$request->has('quantity')) {
            return response()->json(['message' => 'Missing quantity'], 400);
        }
        $order = Order::findOrFail($idOrder);
        $cartItem = $order->orderDetails->where('id', $idCart)->first();
        // kiểm tra xem có cartItem tồn tại không 
        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
        $cartItem->quantity = $request->quantity;
        $cartItem->total_price = $cartItem->product_price * $request->quantity; // Cập nhật giá sản phẩm nếu cần
        $cartItem->save();

        // Cập nhật lại tổng tiền
        $order->total_amount = $order->orderDetails->sum(function ($item) {
            return $item->product_price * $item->quantity;
        });
        $order->save();

        return response()->json([
            'cartItems' => $order->orderDetails,
            'newTotal' => $order->total_amount,
        ]);
    }

    public function deleteCart($idOrder, $idCart)
    {
        $order = Order::findOrFail($idOrder);
        $itemInCart = $order->orderDetails;
        $cartItem = $itemInCart->where('id', $idCart)->first();
        // kiểm tra xem có cartItem tồn tại không 
        if (!$cartItem) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
        // Kiểm tra nếu chỉ còn 1 sản phẩm thì không cho xóa
        if ($itemInCart->count() <= 1) {
            return response()->json(['message' => 'Cannot delete the last item in the cart'], 400);
        }

        // Xóa item
        $cartItem->delete();

        // cập nhật total_amount 
        $order->total_amount = $itemInCart->sum(function ($item) {
            return $item->product_price * $item->quantity;
        });
        $order->save();
        return response()->json([
            'cartItems' => $order->orderDetails,
            'newTotal' => $order->total_amount,
        ]);
    }

    public function search(Request $request)
    {
        $query = request()->input('query');
        $orders = Order::search('order_code', $query)->paginate(5)->appends(['query' => $query]); // append sẽ giữa lại tham số khi sang page khác 
        return OrderResource::collection($orders);
    }
    public function filter(Request $request)
    {
        $status = $request->input('status');
        $page = $request->input('page', 1); // Lấy trang hiện tại, mặc định là 1
        if (empty($status)) {
            $orders = Order::paginate(5, ['*'], 'page', $page);
        } else {
            $orders = Order::where('status', $status)->paginate(5, ['*'], 'page', $page);
        }

        return OrderResource::collection($orders);
    }
}
