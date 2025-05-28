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

    function cartDelete(event) {
        event.preventDefault();
        let url = $(this).data('url');

        if (confirm('Are you sure you want to remove this item?')) {
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    if (data.code === 200) {
                        $('.cart-wrapper').html(data.cartComponent);

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Item removed successfully',
                            timer: 1500
                        });
                    } else {
                        alert('Error: ' + data.message);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Error deleting item');
                }
            });
        }

    }
    $(function() {
        $(document).on('click', '.cart_update', cartUpdate);
        $(document).on('click', '.delete_item_cart', cartDelete);
    })
</script>
@endsection

@section('content')
<div class="cart-wrapper">
    @include('components.cart')
</div>
@endsection