<?php

namespace App\Components; // khai báo không gian trong php -> tránh bị xung đột tên khi có nhiều lớp class trùng tên
use App\Models\Menu; // sử dụng model Menu để lấy dữ liệu từ bảng menu trong database

class MenuRecursive
{
    private $html;
    public function __construct()
    {
        $this->html = '';
    }
    public function menuRecursiveAdd($parentId = 0, $subMark = '')
    {
        $data = Menu::where('parent_id', $parentId)->get();
        foreach ($data as $item) {
            $this->html .= '<option value="' . $item->id . '">' . $subMark . $item->name . '</option>';
            $this->menuRecursiveAdd($item->id, $subMark . '--');
        }
        return $this->html;
    }
}
