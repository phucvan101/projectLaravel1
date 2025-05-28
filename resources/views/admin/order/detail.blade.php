<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')
<!-- load file admin roi dua vao phan content -->

@section('title')
<title>Cart</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('admins/setting/index/index.css')}}">
@endsection

@section('js')
<script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
<script src="{{asset('admins/main.js')}}"></script>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Order Details</h4>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>Order Code:</strong> #{{ $order->order_code }}</p>
                        <p><strong>Recipient Name:</strong> {{ $order->customer_name }}</p>
                        <p><strong>Phone Number:</strong> {{ $order->customer_phone }}</p>
                        <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                        <p><strong>Delivery Address:</strong> {{ $order->customer_address }}</p>
                    </div>
                </div>

                <h5 class="mb-3">Ordered Products</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Product Name</th>
                                <th class="text-end">Price</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderDetails as $orderDetailItem)
                            <tr>
                                <td>{{ $orderDetailItem->product_name }}</td>
                                <td class="text-end">${{ number_format($orderDetailItem->product_price, 2) }}</td>
                                <td class="text-center">
                                    <img src="{{ asset($orderDetailItem->product_image) }}" alt="{{ $orderDetailItem->product_name }}" class="img-fluid" style="max-width: 100px;">
                                </td>
                                <td class="text-center">{{ $orderDetailItem->quantity }}</td>
                                <td class="text-end">${{ number_format($orderDetailItem->product_price * $orderDetailItem->quantity, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <h4><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</h4>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <a class="btn btn-primary" href="{{route('orders.index')}}" role="button">Finish Review</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection