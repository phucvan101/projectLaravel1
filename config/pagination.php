<?php
return [
    /*
    |--------------------------------------------------------------------------
    | Default Pagination View
    |--------------------------------------------------------------------------
    |
    | This option controls the default pagination view that will be used to
    | render pagination links. You may set it to any view provided by
    | Laravel or your own views. By default, Laravel uses Bootstrap.
    |
    */

    'view' => 'pagination::bootstrap-4', // Sử dụng giao diện Bootstrap 4

    /*
    |--------------------------------------------------------------------------
    | Pagination View for Simple Pagination
    |--------------------------------------------------------------------------
    |
    | This option controls the pagination view that is used to render simple
    | pagination links. Like "view", you may set this to any view provided
    | by Laravel or your own views.
    |
    */

    'simple_view' => 'pagination::simple-bootstrap-4', // Giao diện cho phân trang đơn giản

    /*
    |--------------------------------------------------------------------------
    | Pagination Items Per Page
    |--------------------------------------------------------------------------
    |
    | This value controls the default number of items to be shown per page
    | when using the pagination library. You are free to set this value
    | to any number you wish to pick as the default for your application.
    |
    */

    'per_page' => 15, // Số lượng item mặc định trên mỗi trang
];
