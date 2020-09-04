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