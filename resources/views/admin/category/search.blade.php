<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')
<!-- load file admin roi dua vao phan content -->

@section('title')
<title>Category</title>
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
    @include('partials.content-header', ['name' => 'Category', 'key' => 'Search'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Search -->
                @include('Components.search', [
                'route' => 'categories.search',
                'placeholder' => 'Search categories...'
                ])
                <!--End Search -->
                <div class="col-md-12">
                    @can('category_add')
                    <a href="{{route('categories.create')}}" class="btn btn-success float-right m-2">Add</a>
                    @endcan
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{$category->id}}</th>
                                <td>{{ $category->name }}</td>
                                <td>
                                    @can('category_edit')
                                    <a href="{{route('categories.edit', ['id' => $category->id]) }}" class="btn btn-default">
                                        Edit
                                    </a>
                                    @endcan

                                    @can('category_delete')
                                    <a href="" data-url="{{route('categories.delete',['id' => $category->id]) }}" class="btn btn-danger action_delete">Delete</a>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{$categories->links(("pagination::bootstrap-4"))}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection