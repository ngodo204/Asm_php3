<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function trangchu()
    {
        // Lấy danh sách các danh mục và số lượng sản phẩm tương ứng
        $statistics = Category::withCount('clothes')->get();

        // Trả dữ liệu về view
        return view('admin.trangchu', compact('statistics'));
    }
}
