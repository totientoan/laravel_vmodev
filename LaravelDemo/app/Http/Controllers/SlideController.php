<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
use App\Slide;

class SlideController extends Controller
{
    public function getDanhSach(){
        $slide = Slide::all();
        return view('admin.slide.danhsach',['slide'=>$slide]);
    }

    public function getSua($id){ 
            $slide = Slide::find($id);
            return view('admin.slide.sua',['slide'=>$slide]);
    }

    public function postSua(Request $request,$id){
        $this->validate($request,[
            'Ten'=>'required',
            'NoiDung'=>'required',

        ],[
            'Ten.required'=>'bạn chưa nhập tên',
            'NoiDung.required'=>'bạn chưa nhập nội dung'
        ]);
        $slide = Slide::find($id);
        $slide->Ten = $request->Ten;
        $slide->link = $request->link;
        $slide->NoiDung = $request->NoiDung;
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');

            $duoifile = $file->getClientOriginalExtension();
            if($duoifile != 'jpg' && $duoifile != 'png' && $duoifile != 'jpeg'){
                return redirect('admin/slide/them')->with('thongbao','bạn chỉ được chọn file jpg,png,jpeg');
            }
            $name = $file->getClientOriginalName();
            //$Hinh = time()."_".$name;
            $Hinh = random_int(1,10000000)."_".$name;
            while(file_exists("upload/slide".$Hinh)){
                $Hinh = random_int(1,10000000)."_".$name;
            }
            $file->move("upload/slide",$Hinh);
            unlink('upload/slide/'.$slide->Hinh);
            $slide->Hinh = $Hinh;
        }
    
        $slide->save();

        return redirect('admin/slide/sua/'.$id)->with('thanhcong','sua slide thành công');
  
    }

    public function getThem(){
        return view('admin.slide.them');
    }

    public function postThem(REQUEST $request){
        $this->validate($request,[
            'Ten'=>'required',
            'NoiDung'=>'required',

        ],[
            'Ten.required'=>'bạn chưa nhập tên',
            'NoiDung.required'=>'bạn chưa nhập nội dung'
        ]);
        $slide = new Slide;
        $slide->Ten = $request->Ten;
        $slide->link = $request->link;
        $slide->NoiDung = $request->NoiDung;
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');

            $duoifile = $file->getClientOriginalExtension();
            if($duoifile != 'jpg' && $duoifile != 'png' && $duoifile != 'jpeg'){
                return redirect('admin/slide/them')->with('thongbao','bạn chỉ được chọn file jpg,png,jpeg');
            }
            $name = $file->getClientOriginalName();
            //$Hinh = time()."_".$name;
            $Hinh = random_int(1,10000000)."_".$name;
            while(file_exists("upload/slide".$Hinh)){
                $Hinh = random_int(1,10000000)."_".$name;
            }
            $file->move("upload/slide",$Hinh);
            //unlink('upload//'.$tintuc->Hinh);
            $slide->Hinh = $Hinh;
        }
        else{
            $slide->Hinh = "";
        }
        $slide->save();

        return redirect('admin/slide/them')->with('thanhcong','thêm slide thành công');
    }

    public function xoa($id){
        $slide = Slide::find($id);
        $slide->delete();
        return redirect('admin/slide/danhsach')->with('xoaslide','đã xóa slide');
    }
}
