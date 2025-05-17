$(function () {
    // click vào từng role
    $('.checkbox_wrapper').on('click', function () {
        $(this).parents('.card').find('.checkbox_children').prop('checked', $(this).prop('checked'));
    })

    // click all 
    $('.checkAll').on('click', function () {
        $(this).parents().find('.checkbox_children').prop('checked', $(this).prop('checked'));
        $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));
    })
});



//  Khi người dùng click vào checkbox có class checkbox_wrapper (checkbox cha của từng module).

// $(this)
// Đại diện cho checkbox cha vừa được click.

// $(this).parents('.card')
// Tìm thẻ cha gần nhất có class .card (bao quanh cả module).

// .find('.checkbox_children')
// Tìm tất cả các checkbox con bên trong module đó.

// .prop('checked', $(this).prop('checked'))
// Đặt trạng thái checked của tất cả checkbox con giống với checkbox cha (nếu cha được chọn thì con cũng được chọn, nếu cha bỏ chọn thì con cũng bỏ chọn).


