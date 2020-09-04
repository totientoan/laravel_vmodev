<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;

class LoaiTinController extends Controller
{
    public function getLoaiTin(){
        $loaitin = LoaiTin::all();
        $theloai = TheLoai::all();
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin],['theloai'=>$theloai]);
    }

    public function getSua($id){ 
        $theloai = TheLoai::All();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }

    public function postSua(Request $request,$id){
        //$loaitin = LoaiTin::find($id);
        $this->validate($request,
        [
            'Ten' => 'required|unique:LoaiTin,Ten|min:3|max:100'
        ],
        [
            'Ten.required' => 'bạn chưa nhập tên loại tin',
            'Ten.min' => 'tên loại tin phải từ 3 cho tới 100 kí tự',
            'Ten.max' => 'tên loại tin phải từ 3 cho tới 100 kí tự',
            'Ten.unique' => 'tên đã tồn tại'
        ]);
        
        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->Ten;
        $loaitin->idTheLoai = $request->theloai;
        $loaitin->TenKhongDau = changeTitle($request->Ten);

        $loaitin->save();

         return redirect('admin/loaitin/sua/'.$id)->with('thongbao','sửa thành công');

    }

    public function getThem(){
        $theloai = TheLoai::all();
        return view('admin.LoaiTin.them',['theloai'=>$theloai]);
    }

    public function postThem(REQUEST $request){
        $this->validate($request,
            [
                'Ten' => 'required|min:3|max:250|unique:LoaiTin,Ten'
            ],
            [
                'Ten.required' => 'bạn chưa nhập tên loại tin',
                'Ten.min' => 'tên loại tin phải từ 3 cho tới 100 kí tự',
                'Ten.max' => 'tên loại tin phải từ 3 cho tới 100 kí tự',
                'Ten.unique' => 'tên đã tồn tại'
            ]
        );

        $loaitin = new LoaiTin();
        $loaitin->idTheLoai = $request->theloai;
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);

        $loaitin->save();

         return redirect('admin/loaitin/them')->with('thongbao','Thêm thành công');
        //return redirect('admin/theloai/them',['thongbao'=>'Thêm thành công']);
        //echo changeTitle($request->txtCateName);
    

    }

    public function xoa($id){
        $loaitin = LoaiTin::find($id);
        if(count($loaitin->tintuc) == 0){
            $loaitin->delete();
            return redirect('admin/loaitin/danhsach')->with('success','đã xóa loại tin');
        }
        else{
            return redirect('admin/loaitin/danhsach')->with('loi','Xóa thất bại');
        }
    }
}
