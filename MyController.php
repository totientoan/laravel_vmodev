<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MyController extends Controller
{
    public function Xinchao(){
        //echo "Chao cac ban , day la controller";
        return redirect()->route('MyRoute2');
    }

    public function KhoaHoc($ten){
        echo "Khoa hoc : ".$ten;
        //return redirect()->route('Route2')
    }

    public function getURL(Request $request){
        //path() trả về những route đã kết nối
        //return $request->path();
        //return $request->url();

        if($request->isMethod('post')){
            echo 'post';
        }else{
            echo 'get';
        }
    }

    public function postForm(Request $request){
        //echo $request->HoTen;
        //kiểm tra có tham số hay không nhé
        if($request -> has('HoTen')){
            echo 'co tham so HoTen';
        }else{
            echo 'khong co tham so ho ten';
        }
    }

    public function setCookie(){
        //tạo cookie
        $response = new Response();
        //tên,giá trị,thời gian tồn tại
        $response->withCookie('KhoaHoc','Laravel_khoapham',1);
    
        return $response;
    }

    public function getCookie(Request $request){
        return $request->cookie('KhoaHoc');
        // $toan = $request->all();
        // print_r($toan);
    }

    public function postFile(Request $request){
        if($request->hasFile('myFile')){
            $file = $request->file('myFile');
            if($file->getClientOriginalExtension('myFile') == 'jpg'){
                $filename = $file->getClientOriginalName('myFile');
                $file->move('img',$filename);
            }else{
                echo "không đúng định dạng";
            }
        }else{
            echo "chưa co file";
        }
    }

    public function getJson(){
        $array = ['toAN','TO','TIEN'];
        return response()->json($array);
    }
}

