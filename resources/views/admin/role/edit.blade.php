<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')

@section('title')
<title>Role edit</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/main.css') }}">
<link rel="stylesheet" href="{{ asset('admins/role/add/add.css') }}">

@endsection


@section('js')
<script src="{{ asset('admins/role/add/add.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'Role', 'key' => 'Edit'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{route('roles.update', ['id' =>$role->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Role Name</label>
                                <input
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name"
                                    placeholder="Enter role name"
                                    value="{{$role->name}}">
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
                                    rows="3">{{$role->display_name}}</textarea>
                                @error('display_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>
                                        <input type="checkbox" class="checkAll">
                                        Check All
                                    </label>
                                </div>
                                @foreach($permissionsParent as $permissionItem)
                                <div class="card border-light mb-3 col-md-12">
                                    <div class="card-header">
                                        <label>
                                            <input type="checkbox" value="" class="checkbox_wrapper">
                                            Module {{ $permissionItem->name }}
                                        </label>
                                    </div>

                                    <div class="row">
                                        @foreach($permissionItem->permissionChildren as $permissionChildrenItem)
                                        <div class="card-body col-md-3">
                                            <h5 class="card-title">
                                                <label>
                                                    <input
                                                        type="checkbox"
                                                        {{$permissionChecked->contains('id', $permissionChildrenItem->id) ? 'checked' : ''}}
                                                        name="permission_id[]"
                                                        value="{{$permissionChildrenItem->id}}"
                                                        class="checkbox_children">
                                                </label>
                                                {{$permissionChildrenItem->name}}
                                            </h5>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div> <!-- /.col-md-6 -->
            </div> <!-- /.row -->
        </div> <!-- /.container-fluid -->
    </div> <!-- /.content -->
</div> <!-- /.content-wrapper -->
@endsection