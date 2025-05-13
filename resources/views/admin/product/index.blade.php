<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')
<!-- load file admin roi dua vao phan content -->

@section('title')
<title>Product</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('admins/product/index/list.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'Product', 'key' => 'List'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
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
                                <td>{{$productItem -> price}}</td>
                                <td>
                                    <img class="product_image_150_100" src="{{$productItem->feature_image_path}}" alt="">
                                </td>
                                <td>{{$productItem->category->name}}</td>
                                <td>
                                    <a href="" class="btn btn-default">
                                        Edit
                                    </a>
                                    <a href="" class="btn btn-danger">Delete</a>
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