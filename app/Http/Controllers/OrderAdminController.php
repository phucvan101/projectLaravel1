<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Log;
use App\Traits\DeleteModelTrait;
use \Exception;

class OrderAdminController extends Controller
{
    use DeleteModelTrait;
    protected $orderDetail;
    protected $order;
    public function __construct(OrderDetail $orderDetail, Order $order)
    {
        $this->orderDetail = $orderDetail;
        $this->order = $order;
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


    // filter orders by status
    public function filterByStatus(Request $request)
    {
        try {
            // Log::info('FilterByStatus method called');

            $status = $request->input('status');
            $page = $request->input('page', 1); // Lấy page number, default là 1

            // Log::info('FilterByStatus called with status: ' . $status . ', page: ' . $page); 

            // Nếu status rỗng, lấy tất cả orders
            if (empty($status)) {
                $orders = Order::latest()->paginate(7, ['*'], 'page', $page); // 'page': tên tham số phân trang trong URL (ví dụ ?page=2), $page: giá trị trang hiện tại (thường là một biến được lấy từ request).
                // Log::info('No status provided, fetching all orders');
            } else {
                $orders = Order::where('status', $status)->latest()->paginate(7, ['*'], 'page', $page);
                // Log::info('Fetching orders with status: ' . $status);
            }

            // Log::info('Found ' . $orders->count() . ' orders');

            // Tạo HTML cho tbody
            $tableRows = '';
            foreach ($orders as $order) {
                $statusBadge = $this->getStatusBadge($order->status);

                $tableRows .= '<tr>';
                $tableRows .= '<th scope="row">' . $order->order_code . '</th>';
                $tableRows .= '<td>' . $order->customer_name . '</td>';
                $tableRows .= '<td>' . $order->customer_phone . '</td>';
                $tableRows .= '<td>' . $order->customer_address . '</td>';
                $tableRows .= '<td>' . $order->total_amount . '</td>';
                $tableRows .= '<td>' . $statusBadge . '</td>';
                $tableRows .= '<td>';
                $tableRows .= '<a href="' . route('orders.detail', $order->id) . '" class="btn btn-primary">Detail</a> ';
                $tableRows .= '<a href="' . route('orders.edit', ['id' => $order->id]) . '" class="btn btn-default">Edit</a> ';
                $tableRows .= '<a href="" data-url="' . route('orders.delete', ['id' => $order->id]) . '" class="btn btn-danger action_delete">Delete</a>';
                $tableRows .= '</td>';
                $tableRows .= '</tr>';
            }

            // Nếu không có orders
            if ($orders->count() == 0) {
                $tableRows = '<tr><td colspan="7" class="text-center">No orders found</td></tr>';
            }

            // Tạo pagination HTML với parameters
            $paginationHtml = $orders->appends(['status' => $status])->links('pagination::bootstrap-4')->toHtml(); //giữ lại các giá trị lọc (filter) khi người dùng chuyển trang.

            // Log::info('Response prepared successfully');

            return response()->json([
                'tableRows' => $tableRows,
                'pagination' => $paginationHtml,
                'total' => $orders->total(),
                'currentPage' => $orders->currentPage(),
                'lastPage' => $orders->lastPage(),
                'code' => 200,
                'message' => 'Success'
            ], 200);
        } catch (\Exception $e) {
            Log::error('FilterByStatus Exception: ' . $e->getMessage());

            return response()->json([
                'code' => 500,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    // Helper method để tạo status badge
    private function getStatusBadge($status)
    {
        switch ($status) {
            case 'pending':
                return '<span class="badge badge-warning">Pending</span>';
            case 'confirmed':
                return '<span class="badge badge-primary">Confirmed</span>';
            case 'shipping':
                return '<span class="badge badge-info">Shipping</span>';
            case 'delivered':
                return '<span class="badge badge-success">Delivered</span>';
            case 'cancelled':
                return '<span class="badge badge-danger">Cancelled</span>';
            default:
                return '<span class="badge badge-secondary">' . ucfirst($status) . '</span>';
        }
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
                'status' => $request->status,
            ]);
            return redirect()->route('orders.index')->with('success', 'Order updated successfully');
        } catch (\Exception $e) {
            Log::error('Update order error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to update order: ' . $e->getMessage());
        }
    }

    // delete order 
    public function delete($id)
    {
        try {
            // xoa order
            $this->order->find($id)->delete();
            // Xóa tất cả order details liên quan
            $this->orderDetail->where('order_id', $id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);
        } catch (Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . '...Line :' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'False'
            ], 500);
        };
    }
}
