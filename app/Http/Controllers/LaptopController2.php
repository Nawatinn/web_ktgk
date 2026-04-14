<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaptopController2 extends Controller
{

    public function index(){
        return view("laptop.index");
    }

    // Danh sách phim
    public function laptoplist(){
    $data = DB::table('san_pham')
                ->where('status',1)
                ->get();

    return view('laptop.list', compact('data'));
}

    // Xóa mềm
   public function laptopdelete(Request $request){
    DB::table('san_pham')
        ->where('id',$request->id)
        ->update(['status'=>0]);

    return redirect()->route('laptoplist')->with('status','Xóa thành công');
}




}


