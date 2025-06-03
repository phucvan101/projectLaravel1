<?php

namespace App\Traits;
// Khi bạn có nhiều class cần dùng chung một số phương thức, nhưng không muốn dùng kế thừa.
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;

trait StorageImageTrait
{
    public function storageTraitUpload($fieldName, $folderName)
    {
        // kiểm tra xem có file hay không 
        if (request()->hasFile($fieldName)) {

            $file = request()->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName(); // tên ảnh gốc
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension(); // Mục đích là để tránh trùng tên và bảo mật.
            $filePath = request()->file($fieldName)->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameHash); // up ảnh dựa vào đường dẫn củ filesystems.php, Lưu file vào đúng thư mục theo user ID.
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath),
            ];
            return $dataUploadTrait;
        } else {
            return null;
        };
    }

    public function storageTraitUploadMultiple($file, $folderName)
    {
        // kiểm tra xem có file hay không 
        $fileNameOrigin = $file->getClientOriginalName(); // tên ảnh gốc
        $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameHash); // up ảnh dựa vào đường dẫn củ filesystems.php 
        $dataUploadTrait = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath),
        ];
        return $dataUploadTrait;
    }
}
