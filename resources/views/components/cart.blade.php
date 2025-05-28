<div class="content-wrapper">
    <form action="{{route('orders.updateOrder', ['id' => $order->id])}}" method="POST">
        @csrf
        <div class="container py-5">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Edit Order #{{ $order->order_code }}</h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label"><strong>Recipient Name:</strong></label>
                            <input type="text" class="form-control @error('customer_name') is-invalid @enderror" name="customer_name" value="{{ $order->customer_name }}">
                            @error('customer_name')
                            <div class="btn btn-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Phone Number:</strong></label>
                            <input type="text" class="form-control @error('customer_phone') is-invalid @enderror" name="customer_phone" value="{{ $order->customer_phone }}">
                            @error('customer_phone')
                            <div class="btn btn-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Email:</strong></label>
                            <input type="email" class="form-control @error('customer_email') is-invalid @enderror" name="customer_email" value="{{ $order->customer_email }}">
                            @error('customer_email')
                            <div class="btn btn-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Delivery Address:</strong></label>
                            <input type="text" class="form-control @error('customer_address') is-invalid @enderror" name="customer_address" value="{{ $order->customer_address }}">
                            @error('customer_address')
                            <div class="btn btn-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>
                </div>

                <h5 class="mb-3">Ordered Products</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped update_cart_url" data-url="{{route('orders.updateCart', ['idOrder' =>$order->id])}}">
                        <thead class=" thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th class="text-end">Price</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Subtotal</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalAmount = 0;
                            @endphp
                            @foreach($order->orderDetails as $id => $orderDetailItem)
                            @php
                            $totalAmount += $orderDetailItem->product_price * $orderDetailItem->quantity;
                            @endphp
                            <tr>
                                <td>{{ $id + 1 }}</td>
                                <td>{{ $orderDetailItem->product_name }}</td>
                                <td class="text-end">${{ number_format($orderDetailItem->product_price, 2) }}</td>
                                <td class="text-center">
                                    <img src="{{ asset($orderDetailItem->product_image) }}" alt="{{ $orderDetailItem->product_name }}" class="img-fluid" style="max-width: 100px;">
                                </td>
                                <td class="text-center">
                                    <input type="text" class="input-quantity" name="quantity" value="{{ $orderDetailItem->quantity }}" style="width: 50px; text-align: center;">

                                </td>

                                <td class="text-end">${{ number_format($orderDetailItem->product_price * $orderDetailItem->quantity, 2) }}</td>
                                <td class="text-center">
                                    <a href="" data-id="{{$orderDetailItem->id}}" class="btn btn-primary btn-sm cart_update">Update</a>
                                    <a href="" data-url="{{route('orders.deleteCart', ['idOrder' => $order->id, 'idOrderDetail' => $orderDetailItem->id])}}" class="btn btn-danger btn-sm delete_item_cart">Remove</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <h4><strong>Total Amount:</strong> ${{ number_format($totalAmount) }}</h4>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <button class="btn btn-primary" type="submit">Update Order</button>
                </div>
            </div>
        </div>
    </form>
</div>