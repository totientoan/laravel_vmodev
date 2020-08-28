<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    public function getDanhSach(){
        $theloai = TheLoai::all();
        return view('admin.TheLoai.danhsach',['theloai'=>$theloai]);
    }

    public function getSua(){
        return view('admin.TheLoai.sua');
    }
    public function getThem(){
        return view('admin.TheLoai.them');
    }
}
