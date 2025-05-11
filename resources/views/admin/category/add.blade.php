<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')
<!-- load file admin roi dua vao phan content -->

@section('title')
<title>Home</title>
@endsection

@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'Category', 'key' => 'Add'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{route('categories.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter category name">

                        </div>

                        <div class="form-group">
                            <label>Select category</label>

                            <select class="form-control" name="parent_id">
                                <option value="0">Select Parent Category</option>
                                <!--view dữ liệu ra -->
                                {!!$htmlOption!!}
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection