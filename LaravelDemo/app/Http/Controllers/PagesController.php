<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;

class PagesController extends Controller
{
    function trangchu(){
        //$theloai = TheLoai::all();
        return view('pages.trangchu');
    }

    function lienhe(){
        //$theloai = TheLoai::all();
        return view('pages.lienhe');
    }

    function loaitin($id){
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }
}
