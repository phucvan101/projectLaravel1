<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')
<!-- load file admin roi dua vao phan content -->

@section('title')
<title>Slider add</title>
@endsection

@section('css')
<link rel="styleSheet" href="{{asset('admins/slider/add/add.css')}}">
@endsection


@section('content')
<div class=" content-wrapper">
    @include('partials.content-header', ['name' => 'Slider', 'key' => 'Add'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{route('sliders.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Slider Name</label>
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                placeholder="Enter menu name"
                                value="{{old('name')}}">
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
                                class="form-control @error('description') is-invalid @enderror"> {{old('description')}}
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
                                name="image_path" value="{{old('image_path')}}">
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