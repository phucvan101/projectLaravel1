<?php

namespace App\Traits;

trait SearchableTrait
{
    //
    public function scopeSearch($query, $field, $keyword)
    {
        request()->validate([
            'query' => 'required'
        ], [
            'query.required' => 'Bạn phải nhập từ khóa tìm kiếm!'
        ]);
        if (!empty($keyword)) {
            return $query->where($field, 'like', "%{$keyword}%");
        }
        return $query;
    }
}
