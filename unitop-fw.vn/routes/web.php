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