<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Comment;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getDanhSach(){
        $user = User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }

    public function getSua($id){ 
        $user = User::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }

    public function postSua(Request $request,$id){
        $this->validate($request,[
            'name' => 'required|min:3'
            
        ],[
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'name.min' => 'Tên người dùng phải nhiều hơn ba kí tự'

        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->quyen = $request->quyen;
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

        $user->save();

        return redirect('admin/user/sua/'.$id)->with('suathanhcong','sửa user thành công');
    }

    public function getThem(){
        return view('admin.user.them');
    }

    public function postThem(REQUEST $request){
        $this->validate($request,[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3|max:32',
            'passwordAgain' => 'required|same:password'
        ],[
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'name.min' => 'Tên người dùng phải nhiều hơn ba kí tự',
            
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Bạn chưa nhập đúng định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất ba kí tự',
            'password.max' => 'Mật khẩu chỉ được nhất 32 kí tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khấu',

            'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = $request->quyen;

        $user->save();

        return redirect('admin/user/them')->with('themthanhcong','thêm user thành công');
    }

    public function xoa($id){
        $user = User::where('id',$id)->get();
        $user->delete();
        return redirect('admin/user/danhsach')->with('success','đã xóa tin tức');
        // if(count($user->comment) == 0){
        //     $user->delete();
        //     return redirect('admin/user/danhsach')->with('success','đã xóa tin tức');
        // }
        // else{
        //     return redirect('admin/user/danhsach')->with('loi','Xóa thất bại');
        // }
    }

    public function getDangnhapAdmin(){
        return view('admin.login');
    }

    public function postDangnhapAdmin(Request $request){
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
            return redirect('admin/theloai/danhsach');
        }else{
            return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
    }

    public function getDangXuatAdmin(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
