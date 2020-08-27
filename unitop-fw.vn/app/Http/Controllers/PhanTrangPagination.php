<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SanPham;

class PhanTrangPagination extends Controller
{
    public function phantrang(){
        $sanpham = SanPham::paginate(3);
        return view('phantrang',['sanpham'=>$sanpham]);
    }
}
