<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.admin')
<!-- load file admin roi dua vao phan content -->

@section('title')
<title>Cart</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('admins/setting/index/index.css')}}">
@endsection

@section('js')
<script src="{{asset('vendor/sweetAlert2/sweetalert2@11.js')}}"></script>
<script src="{{asset('admins/main.js')}}"></script>

<script>
    function cartUpdate(event) {
        event.preventDefault();
        let urlUpdateCart = $('.update_cart_url').data('url');
        let id = $(this).data('id');
        let quantity = $(this).parents('tr').find('input.input-quantity').val(); // Get the quantity from the input field
        $.ajax({
            type: "POST",
            url: urlUpdateCart,
            data: {
                id: id,
                quantity: quantity,
                _token: "{{ csrf_token() }}"

            },
            success: function(data) {
                if (data.code === 200) {
                    $('.cart-wrapper').html(data.cartComponent)
                }
            },
            error: function() {
                alert('Error updating cart');
            }
        })
    }
    $(function() {
        $(document).on('click', '.cart_update', cartUpdate);
    })
</script>
@endsection

@section('content')
<div class="cart-wrapper">
    @include('components.cart')
</div>
@endsection