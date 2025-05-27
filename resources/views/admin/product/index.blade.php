<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')
<!-- load file admin roi dua vao phan content -->

@section('title')
<title>Product</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('admins/product/index/list.css')}}">
@endsection

@section('js')
<script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
<script src="{{asset('admins/main.js')}}"></script>

@endsection

@if (session('error'))
<div id="flash-message" class="alert alert-danger custom-alert">
    {{ session('error') }}
</div>

<script>
    setTimeout(function() {
        const msg = document.getElementById('flash-message');
        if (msg) {
            msg.style.display = 'none';
        }
    }, 5000); // 5000ms = 5s
</script>
@endif

@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'Product', 'key' => 'List'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <!-- Search -->
                @include('Components.search', [
                'route' => 'products.search',
                'placeholder' => 'Search products...'
                ])
                <!--End Search -->

                <div class="col-md-12">
                    <a href="{{route('products.create')}}" class="btn btn-success float-right m-2">Add</a>
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Image</th>
                                <th scope="col">Category</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $productItem)
                            <tr>
                                <th scope="row">{{$productItem -> id}}</th>
                                <td>{{$productItem -> name}}</td>
                                <td>{{number_format($productItem -> price)}}</td>
                                <td>
                                    <img class="product_image_150_100" src="{{$productItem->feature_image_path}}" alt="">
                                </td>
                                <td>{{optional($productItem->category)->name}}</td>
                                <td>
                                    <a href="{{route('products.edit', ['id' =>$productItem->id])}}" class="btn btn-default">
                                        Edit
                                    </a>
                                    <a href=""
                                        data-url="{{route('products.delete', ['id' => $productItem->id])}}"
                                        class="btn btn-danger action_delete">Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{$product->links(("pagination::bootstrap-4"))}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection