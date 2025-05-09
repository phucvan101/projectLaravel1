<?php

namespace App\Components; // khai báo không gian trong php -> tránh bị xung đột tên khi có nhiều lớp class trùng tên 



class Recursive
{
    private $data;
    private $htmlSelect = '';
    public function __construct($data)
    {
        $this->data = $data; // gắn biến data vào đối tượng đã khởi tạo 
    }
    public function categoryRecursive($parentId, $id = 0, $text = '')
    {

        foreach ($this->data as $value) {
            if ($value['parent_id'] == $id) {
                // // Nếu phân cấp tới đúng category đang chỉnh sửa thì thêm thuộc tính selected
                if (!empty($parentId) && $parentId == $value['id']) {
                    $this->htmlSelect .= "<option selected value='{$value['id']}'>" . $text . $value['name'] . "</option>"; // selected là thuộc tính được sử dụng để chỉ định một mục trong danh sách đã chọn là mục mặc định được chọn khi trang được tải.
                } else {
                    $this->htmlSelect .= "<option value='{$value['id']}'>" . $text . $value['name'] . "</option>";
                }
                $this->categoryRecursive($parentId, $value['id'], text: $text . '-');
            }
        }
        return $this->htmlSelect;
    }
}
