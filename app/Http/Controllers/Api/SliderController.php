<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderAddRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    //
    use HttpResponses;
    use StorageImageTrait;
    public function index()
    {
        $sliders = Slider::all();
        return $this->success($sliders, 'List of sliders retrieved successfully');
    }
    public function show($id)
    {
        $slider = Slider::find($id);
        if (!$slider) {
            return $this->error(null, 'Slider not found', 404);
        }
        return $this->success($slider, 'Slider retrieved successfully');
    }

    public function store(SliderAddRequest $request)
    {
        $dataInsert = [
            'name' => $request->name,
            'description' => $request->description,

        ];
        $dataImageSlider = $this->storageTraitUpload('image_path', 'slider');
        if (empty($dataImageSlider)) {
            return $this->error(null, 'Image is required', 422);
        } else {
            $dataInsert['image_name'] = $dataImageSlider['file_name'];
            $dataInsert['image_path'] = $dataImageSlider['file_path'];
        }
        // Log::info('hasFile', [$request->hasFile('image_path')]);
        // Log::info('request all', [$request->all()]);
        $slider = Slider::create($dataInsert);
        return $this->success($slider, 'Slider created successfully', 201);
    }


    public function update(SliderUpdateRequest $request, $id)
    {
        $slider = Slider::find($id);
        if (!$slider) {
            return $this->error(null, 'Slider not found', 404);
        }

        $dataUpdate = [];

        // kiểm tra và cập nhật các trường dữ liệu -> khi update các trường không điền sẽ không bị null 
        if ($request->has('name')) {
            $dataUpdate['name'] = $request->name;
        }
        if ($request->has('description')) {
            $dataUpdate['description'] = $request->description;
        }

        $dataImageSlider = $this->storageTraitUpload('image_path', 'slider');
        // nếu có ảnh mới thì cập nhật ảnh mới, nếu không có thì giữ nguyên ảnh cũ
        Log::info('dataImageSlider', [$dataImageSlider]);
        if (!empty($dataImageSlider)) {
            $dataUpdate['image_name'] = $dataImageSlider['file_name'];
            $dataUpdate['image_path'] = $dataImageSlider['file_path'];
        }
        // Log::info('request all', [$request->all()]);
        // Log::info('hasFile', [$request->hasFile('image_path')]);
        if (empty($dataUpdate)) {
            return $this->error(null, 'No data to update', 422);
        }

        $slider->update($dataUpdate);
        return $this->success($slider, 'Slider updated successfully', 200);
    }



    public function destroy($id)
    {
        $slider = Slider::find($id);
        if (!$slider) {
            return $this->error(null, 'Slider not found', 404);
        }
        $slider->delete();
        return $this->success(null, 'Slider deleted successfully', 200);
    }
}
