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
    @include('partials.content-header', ['name' => 'Cart', 'key' => 'List'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Search -->

                <!--End Search -->

                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Order Code</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Customer email</th>
                                <th scope="col">Customer Phone</th>
                                <th scope="col">Customer Address</th>
                                <th scope="col">Total Amount</th>
                                <th scope="col">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <th scope="row">{{$order->order_code}}</th>
                                <td>{{$order->customer_name}}</td>
                                <td>{{$order->customer_email}}</td>
                                <td>{{$order->customer_phone}}</td>
                                <td>{{$order->customer_address}}</td>
                                <td>{{$order->total_amount}}</td>
                                <td>
                                    <a href="" class="btn btn-default">Edit</a>
                                    <a href="" data-url="" class="btn btn-danger action_delete">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{$orders->links(("pagination::bootstrap-4"))}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection