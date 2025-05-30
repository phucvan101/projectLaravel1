<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')
<!-- load file admin roi dua vao phan content -->

@section('title')
<title>Home</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('admins/slider/index/list.css')}}">
@endsection

@section('js')
<script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
<script src="{{asset('admins/main.js')}}"></script>

@endsection


@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'Slider', 'key' => 'List'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Search -->
                @include('Components.search', [
                'route' => 'sliders.search',
                'placeholder' => 'Search sliders...'
                ])
                <!--End Search -->
                <div class="col-md-12">
                    <a href="{{route('sliders.create')}}" class="btn btn-success float-right m-2">Add</a>
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $slider)
                            <tr>
                                <th scope="row">{{$slider->id}}</th>
                                <td>{{$slider->name}}</td>
                                <td>{{$slider->description}}</td>
                                <td>
                                    <img class="image_slider_150_100" src=" {{$slider->image_path}}" alt="">
                                </td>
                                <td>
                                    <a href="{{route('sliders.edit', ['id' => $slider->id])}}" class="btn btn-default">Edit</a>
                                    <a href=""
                                        data-url="{{route('sliders.delete', ['id' => $slider->id])}}"
                                        class="btn btn-danger action_delete">Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection