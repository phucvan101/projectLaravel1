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
    public function categoryRecursive($id = 0, $text = '')
    {

        foreach ($this->data as $value) {
            if ($value['parent_id'] == $id) {
                $this->htmlSelect .= "<option value='{$value['id']}'>" . $text . $value['name'] . "</option>";
                $this->categoryRecursive($value['id'], text: $text . '-');
            }
        }
        return $this->htmlSelect;
    }
}
