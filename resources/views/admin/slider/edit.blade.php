@extends('layouts.admin')
<!-- load file admin roi dua vao phan content -->

@section('title')
<title>Slider Edit</title>
@endsection

@section('css')
<link rel="styleSheet" href="{{asset('admins/slider/add/add.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'Slider', 'key' => 'Edit'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{route('sliders.update', ['id' =>$slider->id])}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Slider Name</label>
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                placeholder="Enter menu name"
                                value="{{$slider->name}}">
                            @error('name')
                            <div class=" alert alert-danger">{{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea
                                name="description"
                                rows="8"
                                class="form-control @error('description') is-invalid @enderror"> {{$slider->description}}
                            </textarea>
                            @error('description')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Image</label>
                            <input
                                type="file"
                                class="form-control-file @error('image_path') is-invalid @enderror"
                                name="image_path">
                            <div class="col-md-4">
                                <div class="row">
                                    <img class="image_slider" src="{{$slider->image_path}}" alt="">
                                </div>
                            </div>
                            @error('image_path')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection