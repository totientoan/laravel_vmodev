<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\Conmment;

class TinTucController extends Controller
{
    public function getDanhSach(){
        $tintuc = TinTuc::orderBy('id','DESC')->get();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);
    }

    public function getSua($id){ 
        
        $tintuc = TinTuc::find($id);
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postSua(Request $request,$id){
        $this->validate($request,
       [
           'loaitin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required'], 
       [
            'loaitin.required'=>'Bạn chưa chọn loại tin',
            'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
            'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 kí tự',
            'TieuDe.unique'=>'Tieu đề đã tồn tại',
            'TomTat.required'=>'Bạn chưa nhập tóm tắt',
            'NoiDung.required'=>'Bạn chưa nhập nội dung'
       ]);

        $tintuc = TinTuc::find($id);
        $tintuc->Tieude = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->loaitin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->Noibat = $request->NoiBat;

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');

            $duoifile = $file->getClientOriginalExtension();
            if($duoifile != 'jpg' && $duoifile != 'png' && $duoifile != 'jpeg'){
                return redirect('admin/tintuc/them')->with('thongbao','bạn chỉ được chọn file jpg,png,jpeg');
            }
            $name = $file->getClientOriginalName();
            //$Hinh = time()."_".$name;
            $Hinh = random_int(1,10000000)."_".$name;
            while(file_exists("upload/tintuc".$Hinh)){
                $Hinh = random_int(1,10000000)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            unlink('upload/tintuc/'.$tintuc->Hinh);
            $tintuc->Hinh = $Hinh;
        }
        $tintuc->save(); 
        return redirect('admin/tintuc/them')->with('thongbao','sửa thông tin thành công');
   
    }

    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.them',['theloai' => $theloai,'loaitin' => $loaitin]);
    }

    public function postThem(REQUEST $request){
       $this->validate($request,
       [
           'loaitin'=>'required',
            'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
            'TomTat'=>'required',
            'NoiDung'=>'required'], 
       [
            'loaitin.required'=>'Bạn chưa chọn loại tin',
            'TieuDe.required'=>'Bạn chưa nhập tiêu đề',
            'TieuDe.min'=>'Tiêu đề phải có ít nhất 3 kí tự',
            'TieuDe.unique'=>'Tieu đề đã tồn tại',
            'TomTat.required'=>'Bạn chưa nhập tóm tắt',
            'NoiDung.required'=>'Bạn chưa nhập nội dung'
       ]);

        $tintuc = new TinTuc;
        $tintuc->Tieude = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->idLoaiTin = $request->loaitin;
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->SoLuotXem = 0;
        $tintuc->Noibat = $request->NoiBat;

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');

            $duoifile = $file->getClientOriginalExtension();
            if($duoifile != 'jpg' && $duoifile != 'png' && $duoifile != 'jpeg'){
                return redirect('admin/tintuc/them')->with('thongbao','bạn chỉ được chọn file jpg,png,jpeg');
            }
            $name = $file->getClientOriginalName();
            //$Hinh = time()."_".$name;
            $Hinh = random_int(1,10000000)."_".$name;
            while(file_exists("upload/tintuc".$Hinh)){
                $Hinh = random_int(1,10000000)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            $tintuc->Hinh = $Hinh;
        }else{
            $tintuc->Hinh = "";
        }

        $tintuc->save(); 
        return redirect('admin/tintuc/them')->with('thongbao','thêm thông tin thành công');
    }

    public function xoa($id){
        $tintuc = TinTuc::find($id);
        if(count($tintuc->comment) == 0){
            $tintuc->delete();
            return redirect('admin/tintuc/danhsach')->with('success','đã xóa tin tức');
        }
        else{
            return redirect('admin/tintuc/danhsach')->with('loi','Xóa thất bại');
        }
    }
}
