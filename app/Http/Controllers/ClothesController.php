<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Clothe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClothesController extends Controller
{
    public function index()
    {
        $clothes = Clothe::with('category')->OrderByDesc('id')->paginate(5);
        return view('admin.index', compact('clothes'));
    }
    //Hiển thị form create
    public function create()
    {
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }
    
    //Lưu dữ liệu được thêm vào database
    public function store(Request $request)
    {
        $data = $request->except('thumbnail');
        $data['thumbnail'] = "";
        //Kiểm tra file
        if ($request->hasFile('thumbnail')) {
            $path_thumbnail = $request->file('thumbnail')->store('thumbnails');
            $data['thumbnail'] = $path_thumbnail;
        }
        //Lưu data vào databse
        Clothe::query()->create($data);
        return redirect()->route('clothe.index')->with('message', 'Thêm dữ liệu thành công');
    }

    //Xóa bài viết
    public function destroy(Clothe $clothe)
    {
        $clothe->delete();
        return redirect()->route('clothe.index')->with('message', 'Xóa dữ liệu thành công');
    }

    //Hiển thị form edit
    public function edit(Clothe $clothe)
    {
        $categories = Category::all();
        return view('admin.edit', compact('categories', 'clothe'));
    }
    
    //Hiển thị form detail
    public function detail(Clothe $clothe)
    {
        $categories = Category::all();
        return view('admin.detail', compact('categories', 'clothe'));
    }
    //Cập nhật dữ liệu
    public function update(Request $request, Clothe $clothe)
    {
        $data = $request->except('thumbnail');
        $old_thumbnail = $clothe->thumbnail;
        //Người dùng không upload ảnh mới
        $data['thumbnail'] = $old_thumbnail;
        //Người dùng upload ảnh
        if ($request->hasFile('thumbnail')) {
            $path_thumbnail = $request->file('thumbnail')->store('thumbnails');
            $data['thumbnail'] = $path_thumbnail;
        }

        //update data
        $clothe->update($data);
        //Xóa ảnh
        if ($request->hasFile('thumbnail')) {
            if (file_exists('storage/' . $old_thumbnail)) {
                unlink('storage/' . $old_thumbnail);
            }
        }

        return redirect()->back()->with('message', 'Cập nhật dữ liệu thành công');
    }

    //tìm kiếm
    public function search(Request $request) {
        $query = $request->input('query');

        // Tìm kiếm phim theo tên
        $clothes = DB::table('clothes')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->select('clothes.*', 'categories.name as category_name')
            ->where('title', 'LIKE', "%{$query}%")
            ->orderByDesc('clothes.id')
            ->get();

        return view('admin.search_results', compact('clothes'));
    }
}
