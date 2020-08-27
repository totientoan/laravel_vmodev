<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('KhoaHoc',function(){
    return 'Xin chao cac ban';
});

//truyền tham số

route::get('HoTen/{ten}',function($ten){
    echo "Tên của bạn là : ".$ten;
});

Route::get('\Laravel/{nam}',function($nam){
    echo "năm nhập vào là : ".$nam;
})->where(['ngay'=>'[0-9]+']);

//định danh

Route::get('Route1',['as'=>'MyRoute',function(){
    echo "Xin chào các bạn";
}]);

Route::get('Route2',function(){
    echo "đây là route 2";
})->name('MyRoute2');

Route::get('GoiTen',function(){
    return redirect()->route('MyRoute2');
});

//Route Group

Route::group(['prefix'=>'MyGroup'],function(){
    Route::get('User1',function(){
        echo "User1";
    });
    Route::get("User2",function(){
        echo "User2";
    });
    Route::get("User3",function(){
        echo "User3";
    });
});

//goi controller

Route::get('GoiController','MyController@XinChao');

Route::get('ThamSo/{ten}','MyController@KhoaHoc');

//URl

Route::get('MyRequest','MyController@getURL');

//gưi nhận dữ liệu với request

Route::get('getForm',function(){
    return view('postForm');
});

Route::post('postForm',['as'=>'postForm','uses'=>'MyController@postForm']); 

//cookie

Route::get('setCookie','MyController@setCookie');
Route::get('getCookie','MyController@getCookie');

//upload File

Route::get('uploadFile',function(){
    return view('postFile');
});

Route::post('postFile',['as'=>'postFile','uses'=>'MyController@postFile']);

 //json

 Route::get('getJson','MyController@getJson');

 //View

 Route::get('myView','MyController@myView');

 //truyền dữ liệu trong View

 Route::get('Time/{t}','MyController@Time');
 View::share('name','to tien toan');

//blade Template

Route::get('blade',function(){
    return view('layouts.master');
});

//
Route::get('blade/{str}','MyController@blade');

//database

Route::get('database',function(){
    // Schema::create('chitietsp',function($table){
    //     // $table->increments('id');    //autu tăng
    //     // $table->string('ten',200);   //200 kí tự

    //     $table->increments('id');
    //     $table->integer('gia')->nullable();
    //     $table->string('mota',300)->default('con hang');
    // });

     Schema::create('sanpham',function($table){
        $table->increments('id');
        $table->string('ten');
        $table->float('gia');
        $table->integer('soluong')->default(0);
        $table->integer('id_loaisanpham')->unsigned();
        $table->foreign('id_loaisanpham')->references('id')->on('loaisanpham');
     });
    echo "da thuc hien lenh tao bang";
});

Route::get('suabang',function(){
    Schema::table('sanpham',function($table){
        $table->dropColumn('ten');
    });
});

Route::get('themcot',function(){
    Schema::table('sanpham',function($table){
        $table->dropColumn('tennsx');
    });
});

Route::get('doiten',function(){
    Schema::rename('sanpham',function($table){
        $table->rename('tennsx','Email');
    });
});

//xoas bangr

Route::get('xoabang',function(){
    //Schema::drop('users');          //xoa bangr
    Schema::dropIfExists('users');   //xoas neu ton tai
    echo "da xoa cot";
});

//queryBuilder(truy vấn dữ liệu với builder)
Route::get('qb/get',function(){
    $data = DB::table('users')->get();
    foreach($data as $item){
        print_r($item);
        echo '<br>';
    }
});

//query thêm điều kiện where
Route::get('qb/where',function(){
    $data = DB::table('users')->where('name','Toan')->get();
    foreach($data as $item){
        foreach($item as $key=>$value){
            echo $key." : ".$value."<br>";
        }
        echo "<hr>";
    }
});

//select id,name,email....
Route::get('qb/select',function(){
    $data = DB::table('users')->where('id',1)->select('id','name','email')->get();
    foreach($data as $item){
        foreach($item as $key=>$value){
            echo $key." : ".$value."<br>";
        }
        echo "<hr>";
    }
});

//select name as hoten form....
Route::get('qb/raw',function(){
    $data = DB::table('users')->where('id',1)->select(DB::raw('id as maso,name as hoten,email'))->get();
    foreach($data as $item){
        foreach($item as $key=>$value){
            echo $key." : ".$value."<br>";
        }
        echo "<hr>";
    }
});

//oderBy
//select name as hoten form....
Route::get('qb/orderBy',function(){
    $data = DB::table('users')->where('id','>',1)->select(DB::raw('id as maso,name as hote
    n,email'))->orderBy('id','desc')->take(3)->get();
    foreach($data as $item){
        foreach($item as $key=>$value){
            echo $key." : ".$value."<br>";
        }
        echo "<hr>";
    }
});

//update data bằng builder
Route::get('qb/update',function(){
    $data = DB::table('users')->where('id',1)->update(['name'=>'Toan shinoda','email'=>'toanshinoda@gmail.com']);
    echo "da update";
});

//delete(xoas du lieu)
Route::get('qb/delete',function(){
    $data = DB::table('users')->where('id',1)->delete();
    echo "da xa";
});

//truncate(xoa het du lieu trong bang va reset chi so tu tang ve 0)
Route::get('qb/truncate',function(){
    $data = DB::table('users')->truncate();
    echo "da truncate";
});

//Model app/User.php
Route::get('model/save',function(){
    $user = new App\User();

    $user->name = 'Huyen';
    $user->email = 'huyen@gmail.com';
    $user->password = 'mat khau';

    $user->save();

    echo "da thu hien save()";
});

//Model function find('khoa chinh')
Route::get('model/query',function(){
    $user = App\User::find(4);
    echo $user->name;
});

//tu tao model SanPham
Route::get('model/sanpham/save/{ten}/{soluong}',function($ten,$soluong){
    $sanpham = new App\SanPham();

    $sanpham->ten = $ten;
    $sanpham->soluong = $soluong;

    $sanpham->save();
});

//model laays toanf booj duwx lieeuj trong bangr
Route::get('model/sanpham/all',function(){
    $sanpham = App\SanPham::all()->toArray();
    // foreach($sanpham as $item){
    //     forearch($item as $key=>$value){
    //         echo $key." : ".$item.'<br>';
    //     }
    // }
    var_dump($sanpham);
});

//tạo bảng loaisanpham
//bai:35 liên kết dữ liệu trong Model
Route::get('taobang',function(){
    Schema::create('LoaiSanPham',function($table){
        $table->increments('id');
        $table->string('ten');
    });
});
//them khóa phụ cho bang sanpham
Route::get('taocot',function(){
    Schema::table('sanpham',function($table){
        $table->integer('id_loaisanpham')->unsigned;
    });
});
//đã tạo liên kết sanpham->loaisanpham trong model SamPham ta sẽ chạy thử
Route::get('lienket',function(){
    //gọi hàm 'loaisanpham' ở model SanPham
    $data = App\SanPham::find(3)->loaisanpham->toArray();
    var_dump($data);
});
//đã tạo liên kết sanpham<-loaisanpham
Route::get('lienketloaisanpham',function(){
    //gọi hàm 'loaisanpham' ở model SanPham
    $data = App\LoaiSanPham::find(1)->sanpham->toArray();
    var_dump($data);
});

//bảo mật với middleware
Route::get('diem',function(){
    echo "Bạn đã qua môn";
})->middleware('Mymiddle')->name('diem');
Route::get('loi',function(){
    echo "Bạn đã tạch môn";
})->name('loi');
Route::get('nhapdiem',function(){
    return view('nhapdiem');
})->name('nhapdiem');

//tìm hiểu Auth
Route::get('dangnhap',function(){
    return view('formdangnhap');
});
Route::get('thu',function(){
    return view('thanhcong');
});
Route::post('login','AuthController@login')->name('login');
//truyền url nên k cần đặt tên
Route::get('logout','AuthController@logout');

//làm việc với Session
Route::group(['middleware'=>['web']],function(){
    Route::get('Session',function(){
        //tạo session
        //Session::put('khoahoc','laravel');
        echo "đã đặt session";
        echo "<br>";
        echo Session::get('mess');

        //echo Session::get('khoahoc');
        if(Session::has('khoahoc')){
            //forget('ten') xóa ,flush() xóa hết
            //Session::forget('khoahoc');
            echo 'đã xóa session khóa học';
        }else{
            echo "không tồn tại khóa học";
        }
    });

    Route::get('Session/flash',function(){
        //Session::flash('mess','hello');
        echo "đã đặt session";
        echo "<br>";
        echo Session::get('mess');
    });
});

//phân trang dùng Pagination
Route::get('Pagination/sanpham','phanTrangPagination@phantrang');