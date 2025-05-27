<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSettingRequest;
use Illuminate\Http\Request;
use App\Models\Setting;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Traits\DeleteModelTrait;

class AdminSettingController extends Controller
{
    use DeleteModelTrait;
    protected $setting;
    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }
    public function index()
    {
        $settings = $this->setting->latest()->paginate(5);
        return view('admin.setting.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.setting.add');
    }

    public function store(AddSettingRequest $request)
    {
        $this->setting->create([
            'config_key' => request()->config_key,
            'config_value' => request()->config_value,
            'type' => request()->type,
        ]);
        return redirect()->route('settings.index');
    }
    public function edit($id)
    {

        $setting = $this->setting->find($id);
        return view('admin.setting.edit', compact('setting'));
    }

    public function update(AddSettingRequest $request, $id)
    {
        $this->setting->find($id)->update([
            'config_key' => request()->config_key,
            'config_value' => request()->config_value,
        ]);
        return redirect()->route('settings.index');
    }

    public function delete($id)
    {

        return $this->deleteModelTrait($id, $this->setting);
    }

    public function search()
    {
        $query = request()->input('query');
        $settings = Setting::search('config_key', $query)->paginate(5)->appends(['query' => $query]);
        return view('admin.setting.search', compact(['query', 'settings']));
    }
}
