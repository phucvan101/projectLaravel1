
function actionDelete(event) {
    event.preventDefault();// khi kích vào delete web không bị load lại 
    let urlRequest = $(this).data('url'); // this là button mk đang click vào
    let that = $(this);
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function (data) {
                    console.log(data);
                    if (data.code == 200) {
                        that.parent().parent().remove();
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your slider has been deleted.",
                            icon: "success"
                        });
                    }
                },
                error: function () {

                }
            })

        }
    });
}

$(function () {
    $(document).on('click', '.action_delete', actionDelete);
})