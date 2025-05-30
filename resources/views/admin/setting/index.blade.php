<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')
<!-- load file admin roi dua vao phan content -->

@section('title')
<title>Settings</title>
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
    @include('partials.content-header', ['name' => 'Setting', 'key' => 'List'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Search -->
                @include('Components.search', [
                'route' => 'settings.search',
                'placeholder' => 'Search settings...'
                ])
                <!--End Search -->
                <div class="col-md-12">
                    <div class="btn-group float-right">
                        <a href="" class="btn dropdown-toggle" data-toggle="dropdown">
                            Add setting
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('settings.create') . '?type=Text'}}">Text</a></li>
                            <li><a href="{{route('settings.create') . '?type=Textarea'}}">Textarea</a></li>
                        </ul>
                    </div>
                    <!-- <a href="{{route('settings.create')}} " class="btn btn-success float-right m-2">Add</a> -->
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Config key</th>
                                <th scope="col">Config value</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($settings as $setting)
                            <tr>
                                <th scope="row">{{$setting->id}}</th>
                                <td>{{$setting->config_key}}</td>
                                <td>{{$setting->config_value}}</td>
                                <td>
                                    <a href="{{route('settings.edit', ['id' => $setting->id, '?type=' . $setting->type])}}" class="btn btn-default">Edit</a>
                                    <a href="" data-url="{{route('settings.delete', ['id' => $setting->id])}}" class="btn btn-danger action_delete">Delete</a>
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