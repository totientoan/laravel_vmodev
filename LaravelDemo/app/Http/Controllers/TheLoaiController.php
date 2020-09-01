<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;

class TheLoaiController extends Controller
{
    public function getDanhSach(){
        $theloai = TheLoai::all();
        return view('admin.TheLoai.danhsach',['theloai'=>$theloai]);
    }

    public function getSua($id){ 
        $theloai = TheLoai::find($id);
        return view('admin.TheLoai.sua',['theloai'=>$theloai]);
    }

    public function postSua(Request $request,$id){
        $theloai = TheLoai::find($id);
        $this->validate($request,
        [
            'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'
        ],
        [
            'Ten.required' => 'bạn chưa nhập tên thể loại',
            'Ten.min' => 'tên thể loại phải từ 3 cho tới 100 kí tự',
            'Ten.max' => 'tên thể loại phải từ 3 cho tới 100 kí tự',
            'Ten.unique' => 'tên đã tồn tại'
        ]);
        
        $theloai = TheLoai::find($id);
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);

        $theloai->save();

         return redirect('admin/theloai/sua/'.$id)->with('thongbao','sửa thành công');

    }

    public function getThem(){
        return view('admin.TheLoai.them');
    }

    public function postThem(REQUEST $request){
        $this->validate($request,
            [
                'txtCateName' => 'required|min:3|max:250|unique:TheLoai,Ten'
            ],
            [
                'txtCateName.required' => 'bạn chưa nhập tên thể loại',
                'txtCateName.min' => 'tên thể loại phải từ 3 cho tới 100 kí tự',
                'txtCateName.max' => 'tên thể loại phải từ 3 cho tới 100 kí tự',
                'txtCateName.unique' => 'tên đã tồn tại'
            ]
        );

        $theloai = new TheLoai;
        $theloai->Ten = $request->txtCateName;
        $theloai->TenKhongDau = changeTitle($request->txtCateName);

        $theloai->save();

         return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
        //return redirect('admin/theloai/them',['thongbao'=>'Thêm thành công']);
        //echo changeTitle($request->txtCateName);
    

    }

    public function xoa($id){
        $theloai = TheLoai::find($id);
        if(count($theloai->loaitin) == 0){
            $theloai->delete();
            return redirect('admin/theloai/danhsach')->with('success','đã xóa thể loại');
        }
        else{
            return redirect('admin/theloai/danhsach')->with('loi','Xóa thất bại');
        }
    }
}
