<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')
<!-- load file admin roi dua vao phan content -->

@section('title')
<title>Slider add</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('vendor/select2/select2.min.css')}}">
<link rel="styleSheet" href="{{asset('admins/main.css')}}">
@endsection

@section('js')
<script src="{{asset('vendor/select2/select2.min.js')}}"></script>
<script src="{{asset('admins/user/add.js')}}"></script>
@endsection


@section('content')
<div class=" content-wrapper">
    @include('partials.content-header', ['name' => 'User', 'key' => 'Edit'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{route('users.update', ['id'=>$user->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>User Name</label>
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                placeholder="Enter user name"
                                value="{{$user->name}}">
                            @error('name')
                            <div class=" alert alert-danger">{{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input
                                type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                placeholder="Enter email"
                                value="{{$user->email}}">
                            @error('email')
                            <div class=" alert alert-danger">{{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input
                                type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                placeholder="Enter password">
                            @error('password')
                            <div class=" alert alert-danger">{{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <select name="role_id[]" class="form-control select2_init" multiple>
                                <option value="">Admin</option>
                                @foreach($roles as $role)
                                <option
                                    {{$rolesOfUser->contains('id', $role->id) ? 'selected' : ''}}
                                    value="{{$role->id}}">{{$role->name}}
                                </option>
                                @endforeach
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