<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')
<!-- load file admin roi dua vao phan content -->

@section('title')
<title>Setting Add</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('admins/setting/add/add.css')}}">
@endsection



@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'Setting', 'key' => 'Add'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{route('settings.store')}}" method="POST">
                        @csrf
                        <!--csrf tự động chèn một csrf token vào form html -->
                        <div class="form-group">
                            <label>Config key</label>
                            <input type="text" class="form-control @error('config_key') is-invalid @enderror" name="config_key" placeholder="Enter config key" value="{{old('config_key')}}">
                            @error('config_key')
                            <div class=" alert alert-danger">{{$message}}
                            </div>
                            @enderror

                        </div>
                        @if(request()->type === 'Text')
                        <div class="form-group">
                            <label>Config Value</label>
                            <input type="text" class="form-control @error('config_value') is-invalid @enderror" name="config_value" placeholder="Enter config value" value="{{old('config_value')}}">
                            @error('config_value')
                            <div class=" alert alert-danger">{{$message}}
                            </div>
                            @enderror

                        </div>
                        @elseif(request()->type === 'Textarea')
                        <div class="form-group">
                            <label>Config Value</label>
                            <textarea class="form-control @error('config_value') is-invalid @enderror" name="config_value" row="10">
                            {{old('config_value')}}
                            </textarea>
                            @error('config_value')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        @endif

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection