<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    
    public function index(Request $request)
    {
        $query = DB::table('san_pham')
            ->select('id', 'tieu_de', 'gia', 'hinh_anh');

        // thêm sort
        if ($request->sort == 'asc') {
            $query->orderBy('gia', 'asc');
        } elseif ($request->sort == 'desc') {
            $query->orderBy('gia', 'desc');
        } else {
            $query->orderBy('created_at');
        }

        $laptops = $query->limit(20)
        ->get();

        $categories = DB::table('danh_muc_laptop')->get();

        return view('laptop.index', [
            'laptops' => $laptops,
            'categories' => $categories,
            'title' => 'Trang chủ'
        ]);
    }

    public function theoDanhMuc(Request $request, $id)
    {
        $query = DB::table('san_pham')
            ->where('id_danh_muc', $id);

        //  xử lý sort theo giá
        if ($request->sort == 'asc') {
            $query->orderBy('gia', 'asc');
        } elseif ($request->sort == 'desc') {
            $query->orderBy('gia', 'desc');
        }

        $laptops = $query->get();

        $categories = DB::table('danh_muc_laptop')->get();

        $category = DB::table('danh_muc_laptop')
            ->where('id', $id)
            ->first();

        return view('laptop.index', [
            'laptops' => $laptops,
            'categories' => $categories,
            'title' => $category ? $category->ten_danh_muc : 'Danh mục'
        ]);
    }


        public function timKiem(Request $request)
    {
        $keyword = $request->keyword;

        $query = DB::table('san_pham')
            ->where('tieu_de', 'like', '%' . $keyword . '%');
        if ($request->sort == 'asc') {
            $query->orderBy('gia', 'asc');
        } elseif ($request->sort == 'desc') {
            $query->orderBy('gia', 'desc');
        } else {
            $query->orderBy('created_at');
        }

        $laptops = $query->get();

        $categories = DB::table('danh_muc_laptop')->get();

        return view('laptop.index', [
            'laptops' => $laptops,
            'categories' => $categories,
            'title' => 'Kết quả tìm kiếm: ' . $keyword
        ]);
    }
        
}

