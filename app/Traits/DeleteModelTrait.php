<?php

namespace App\Traits;
// Khi bạn có nhiều class cần dùng chung một số phương thức, nhưng không muốn dùng kế thừa.
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;
use Exception;
use Illuminate\Support\Facades\Log;

trait DeleteModelTrait
{
    public function deleteModelTrait($id, $model)
    {
        try {
            $model->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success',
            ], 200);
        } catch (Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . '...Line :' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'False'
            ], 500);
        };
    }
}
