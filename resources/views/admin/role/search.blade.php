<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')
<!-- load file admin roi dua vao phan content -->

@section('title')
<title>Roles</title>
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
    @include('partials.content-header', ['name' => 'Roles', 'key' => 'Search'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Search -->
                @include('Components.search', [
                'route' => 'roles.search',
                'placeholder' => 'Search roles...'
                ])
                <!--End Search -->
                <div class="col-md-12">
                    <a href="{{route('roles.create')}}" class="btn btn-success float-right m-2">Add</a>
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Display Name</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <th scope="row">{{$role->id}}</th>
                                <td>{{$role->name}}</td>
                                <td>{{$role->display_name}}</td>

                                <td>
                                    <a href="{{route('roles.edit', ['id' =>$role->id])}}" class="btn btn-default">Edit</a>
                                    <a href=""
                                        data-url="{{route('roles.delete', ['id' =>$role->id])}}"
                                        class="btn btn-danger action_delete">Delete
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection