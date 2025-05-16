<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
<title>Role add</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/main.css') }}">
<style>
    .card-header {
        background-color: #00e765;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'Role', 'key' => 'Add'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Role Name</label>
                                <input
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name"
                                    placeholder="Enter role name"
                                    value="{{ old('name') }}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Display Name</label>
                                <textarea
                                    class="form-control @error('display_name') is-invalid @enderror"
                                    name="display_name"
                                    placeholder="Enter role display name"
                                    rows="3">{{ old('display_name') }}</textarea>
                                @error('display_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="card text-white bg-primary mb-3 col-md-12">
                                    <div class="card-header">
                                        <label>
                                            <input type="checkbox" name="">
                                            Module product
                                        </label>
                                    </div>

                                    <div class="row">
                                        @for($i = 1; $i <= 4; $i++)
                                            <div class="card-body col-md-3">
                                            <h5 class="card-title">
                                                <label>
                                                    <input type="checkbox" name="">
                                                    Add product
                                                </label>
                                            </h5>
                                    </div>
                                    @endfor
                                </div>
                            </div>
                        </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection