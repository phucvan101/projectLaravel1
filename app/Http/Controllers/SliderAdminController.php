<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;
use App\Models\Slider;
use App\Traits\StorageImageTrait;
use Exception;
use Illuminate\Support\Facades\Log;

class SliderAdminController extends Controller
{
    use StorageImageTrait;
    private $slider;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }
    public function index()
    {
        return view('admin.slider.index');
    }

    // Tạo silder
    public function create()
    {
        return view('admin.slider.add');
    }
    public function store(SliderAddRequest $request)
    {
        try {
            $dataInsert = [
                'name' => request()->name,
                'description' => request()->description,

            ];
            $dataImageSlider = $this->storageTraitUpload('image_path', 'slider');
            if (!empty($dataImageSlider)) {
                $dataInsert['image_name'] = $dataImageSlider['file_name'];
                $dataInsert['image_path'] = $dataImageSlider['file_path'];
            };
            $this->slider->create($dataInsert);
            return redirect()->route('sliders.index');
        } catch (Exception $exception) {
            Log::error('Error: ' . $exception->getMessage() . ' ---line' . $exception->getLine());
        }
    }
}
