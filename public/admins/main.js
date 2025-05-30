
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
                            text: "Your product has been deleted.",
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

function filterByStatus() {
    let status = $(this).val();
    let urlRequest = $(this).data('url');

    loadOrders(urlRequest, { status: status });
}

function loadOrders(url, params = {}) {
    // Show loading
    $('tbody').html('<tr><td colspan="7" class="text-center">Loading...</td></tr>');

    $.ajax({
        type: 'GET',
        url: url,
        data: params,
        success: function (data) {
            console.log('AJAX Success:', data);

            if (data.code == 200) {
                // Update table body
                $('tbody').html(data.tableRows);

                // Update pagination
                $('.pagination').parent().html(data.pagination);

                // Show result count (optional)
                console.log('Total orders found:', data.total);
            } else {
                $('tbody').html('<tr><td colspan="7" class="text-center text-danger">Error loading data</td></tr>');
            }
        },
        error: function (xhr, status, error) {
            console.log('Error:', error);
            $('tbody').html('<tr><td colspan="7" class="text-center text-danger">Error loading data</td></tr>');
        }
    });
}

function handlePaginationClick(event) {
    event.preventDefault();

    let url = $(this).attr('href');
    let currentStatus = $('#status-filter').val();

    // Convert pagination URL to filter URL with current status
    let filterUrl = $('#status-filter').data('url');

    // Extract page number from pagination URL
    let urlParams = new URLSearchParams(url.split('?')[1]);
    let page = urlParams.get('page');

    // Load orders with current status and page
    loadOrders(filterUrl, {
        status: currentStatus,
        page: page
    });
}

$(function () {
    $(document).on('click', '.action_delete', actionDelete);
    $(document).on('change', '#status-filter', filterByStatus);
    $(document).on('click', '.pagination a', handlePaginationClick);
})