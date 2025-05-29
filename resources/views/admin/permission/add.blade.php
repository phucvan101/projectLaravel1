<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')
<!-- load file admin roi dua vao phan content -->

@section('title')
<title>Permission add</title>
@endsection

@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'Permission', 'key' => 'Add'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <form action="{{route('permissions.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Select module</label>
                            <select class="form-control" name="module_parent">
                                <option value="Select module">Select module</option>
                                @foreach(config('permissions.table_module') as $moduleItem)
                                <option value="{{$moduleItem}}">{{$moduleItem}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                @foreach(config('permissions.module_children') as $moduleChildrenItem)
                                <div class="col-md-3">
                                    <label for="">
                                        <input type="checkbox" name="module_children[]" id="" value="{{$moduleChildrenItem}}">
                                        {{$moduleChildrenItem}}
                                    </label>
                                </div>
                                @endforeach

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