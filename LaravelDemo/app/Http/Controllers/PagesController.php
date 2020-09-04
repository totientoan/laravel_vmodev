<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;
use App\User;
use Illuminate\Support\Facades\Auth;

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

    function tintuc($id){
        $tintuc = TinTuc::find($id);
        $tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
        $tinlienquan = TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }

    function getDangnhap(){
        return view('pages.dangnhap');
    }
    function postDangnhap(Request $request){
        $this->validate($request,[
            'email'=>'required',
            'password'=>'required|min:3|max:32',

        ],[
            'email.required'=>'Bạn chưa nhập email',
            'password.required'=>'Bạn chưa nhập password',
            'password.min'=>'password phải lớn hơn ba kí tự',
            'password.max'=>'password phải nhỏ hơn 32 kí tự'

        ]);
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('trangchu');
        }else{
            return redirect('dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
    }

    function postDangxuat(){
        Auth::logout();
        return redirect('trangchu');
    }

    function postComment(Request $request, $idTinTuc){
        $this->validate($request,
       [
           'NoiDung'=>'required'
        ], 
       [
            'NoiDung.required'=>'Bạn phải nhập nội dung'
       ]);

       $tintuc = TinTuc::find($idTinTuc);

       $comment = new Comment();
       $comment->idTinTuc = $idTinTuc;
       $comment->idUser = Auth::user()->id;
       $comment->NoiDung = $request->NoiDung;
       $comment->save();

        return redirect("tintuc/$idTinTuc/".$tintuc->TieuDeKhongDau.".html");
    }

    function getNguoidung(){
        return view('pages.nguoidung');
    }

    function postNguoidung(Request $request){
        $this->validate($request,[
            'name' => 'required|min:3'
            
        ],[
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'name.min' => 'Tên người dùng phải nhiều hơn ba kí tự'

        ]);

        $au = Auth::user();

        $user = User::find($au->id);
        $user->name = $request->name;
        if($request->changePassword == 'on'){
            $this->validate($request,[
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password'
            ],[
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất ba kí tự',
                'password.max' => 'Mật khẩu chỉ được nhất 32 kí tự',
                'passwordAgain.required' => 'Bạn chưa nhập lại mật khấu',
    
                'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
            ]);
            $user->password = bcrypt($request->password);
        }

        //$user->update(['name'=>$request->name,'password'=> bcrypt($request->password)]);
        //Auth::setUser($user);

        $user->save();

        return redirect('nguoidung')->with('suathanhcong','sửa user thành công');
    }
}
