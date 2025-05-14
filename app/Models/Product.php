<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $guarded = []; // tất cả trường đều có thể gián giá trị 
    public function images()
    {
        // quan hệ 1:n 
        return $this->hasMany(ProductImage::class, 'product_id');  // Lấy tất cả các bản ghi trong bảng product_images mà có product_id bằng với id của sản phẩm hiện tại 
    }

    public function tags()
    {
        // quan hệ n:n 
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id')->withTimestamps(); // withTimestamps(): Tự động cập nhật các cột created_at và updated_at trong bảng trung gian khi thêm/sửa quan hệ.
        // cách hoạt động: Sử dụng bảng trung gian product_tags để liên kết sản phẩm và tag, product_id: khóa ngoại trỏ đến bảng products, tag_id: khóa ngoại trỏ đến bảng tags.
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
