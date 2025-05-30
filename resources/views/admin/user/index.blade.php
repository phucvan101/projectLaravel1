<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')
<!-- load file admin roi dua vao phan content -->

@section('title')
<title>User</title>
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
    @include('partials.content-header', ['name' => 'User', 'key' => 'List'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Search -->
                @include('Components.search', [
                'route' => 'users.search',
                'placeholder' => 'Search users...'
                ])
                <!-- End Search -->

                <div class="col-md-12">
                    <a href="{{route('users.create')}}" class="btn btn-success float-right m-2">Add</a>
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>

                                <td>
                                    <a href="{{route('users.edit', ['id' => $user->id])}}" class=" btn btn-default">Edit</a>
                                    <a href=""
                                        data-url="{{route('users.delete', ['id' =>$user->id])}}"
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