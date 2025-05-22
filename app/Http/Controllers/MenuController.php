<?php

namespace App\Http\Controllers;

use App\Components\MenuRecursive; // sử dụng class MenuRecursive để lấy danh sách menu
use App\Models\Menu; // sử dụng class Menu để tương tác với bảng menu
use App\Traits\DeleteModelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // thư viện hỗ trợ các hàm xử lý chuỗi trong laravel

class MenuController extends Controller
{
    use DeleteModelTrait;
    private $menuRecursive;
    private $menu;
    public function __construct(MenuRecursive $menuRecursive, Menu $menu)
    {
        $this->menuRecursive = $menuRecursive;
        $this->menu = $menu;
    }


    //Giao diện menu 
    public function index()
    {
        $menus = $this->menu->paginate(5);
        return view('admin.menus.index', compact('menus'));
    }

    //Giao diện tạo menu
    public function create()
    {
        $optionSelect = $this->menuRecursive->menuRecursiveAdd();
        return view('admin.menus.add', compact('optionSelect'));
    }

    public function store()
    {
        $this->menu->create([
            'name' => request()->name,
            'parent_id' => request()->parent_id, // tạo parent_id từ tên menu
            'slug' => Str::slug(request()->name), // tạo slug từ tên menu
        ]);
        return redirect()->route('menus.index');
    }

    // update menu 
    public function edit($id)
    {
        $menuFollowEdit = $this->menu->find($id);
        $optionSelect = $this->menuRecursive->menuRecursiveEdit($menuFollowEdit->parent_id);
        return view('admin.menus.edit', compact(['menuFollowEdit', 'optionSelect']));
        // dd($optionSelect);
    }

    public function update($id)
    {
        $this->menu->find($id)->update([
            'name' => request()->name,
            'parent_id' => request()->parent_id,
            'slug' => Str::slug(request()->name),
        ]);
        return redirect()->route('menus.index');
    }

    // Xóa menu
    public function delete($id)
    {
        return $this->deleteModelTrait(
            $id,
            $this->menu
        );
    }

    public function search()
    {
        $query = request()->input('query');
        $menus = Menu::search('config_key', $query)->paginate(5);
        return view('admin.menu.search', compact(['query', 'menus']));
    }
}
