<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')
<!-- load file admin roi dua vao phan content -->

@section('title')
<title>Add product</title>
@endsection

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection



@section('content')
<div class="content-wrapper">
    @include('partials.content-header', ['name' => 'Product', 'key' => 'Add'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter product name">

                        </div>

                        <div class="form-group">
                            <label>Product Price</label>
                            <input type="text" class="form-control" name="price" placeholder="Enter product price">

                        </div>

                        <div class="form-group">
                            <label>Product Feature Image</label>
                            <input type="file" class="form-control" name="feature_image_path">

                        </div>

                        <div class="form-group">
                            <label>Image Detail</label>
                            <input type="file" multiple class="form-control" name="image_path[]">

                        </div>


                        <div class="form-group">
                            <label>Select category</label>

                            <select class="form-control select2_init" name="parent_id">
                                <option value="">Select Category</option>
                                <!--view dữ liệu ra -->
                                {!!$htmlOption!!}
                            </select>
                        </div>
                        <div>
                            <label>Enter tags for product</label>
                            <select class="form-control tags_select_choose" multiple="multiple">

                            </select>
                        </div>


                        <div class="form-group">
                            <label>Content</label>
                            <textarea name="content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function() {
        $(".tags_select_choose").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })
        $(".select2_init").select2({
            placeholder: "Select a category",
            allowClear: true,
        })
    })
</script>
@endsection