<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;
use App\Models\Slider;
use App\Traits\StorageImageTrait;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Traits\DeleteModelTrait;

class SliderAdminController extends Controller
{
    use DeleteModelTrait;
    use StorageImageTrait;
    private $slider;
    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }
    public function index()
    {
        $sliders = $this->slider->latest()->paginate(5);
        return view('admin.slider.index', compact('sliders'));
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

    // chỉnh sửa slider
    public function edit($id)
    {
        $slider = $this->slider->find($id);
        return view('admin.slider.edit', compact('slider'));
    }
    public function update($id)
    {
        try {
            $dataUpdate = [
                'name' => request()->name,
                'description' => request()->description,

            ];
            $dataImageSlider = $this->storageTraitUpload('image_path', 'slider');
            if (!empty($dataImageSlider)) {
                $dataUpdate['image_name'] = $dataImageSlider['file_name'];
                $dataUpdate['image_path'] = $dataImageSlider['file_path'];
            };
            $this->slider->find($id)->update($dataUpdate);
            return redirect()->route('sliders.index');
        } catch (Exception $exception) {
            Log::error('Error: ' . $exception->getMessage() . ' ---line' . $exception->getLine());
        }
    }

    // xóa slider
    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->slider);
    }

    public function search()
    {

        $query = request()->input('query');
        $sliders = Slider::search('name', $query)->paginate(5)->appends(['query' => $query]);
        return view('admin.slider.search', compact(['query', 'sliders']));
    }
}
