 <?php

use Illuminate\Support\Facades\Route;
use App\TheLoai;
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

Route::group(['prefix'=>'admin'],function(){
    Route::group(['prefix'=>'theloai'],function(){
        //admin/theloai/them
        Route::get('danhsach','TheLoaiController@getDanhSach');

        Route::get('sua/{id}','TheLoaiController@getSua');
        Route::post('sua/{id}','TheLoaiController@postSua');

        Route::get('them','TheLoaiController@getThem');
        Route::POST('them','TheLoaiController@postThem');

        Route::get('xoa/{id}','TheLoaiController@xoa');
    });

    Route::group(['prefix'=>'loaitin'],function(){
        //admin/loaitin/them
        Route::get('danhsach','LoaiTinController@getLoaiTin');

        Route::get('sua/{id}','LoaiTinController@getSua');
        Route::post('sua/{id}','LoaiTinController@postSua');
        
        Route::get('them','LoaiTinController@getThem');
        Route::POST('them','LoaiTinController@postThem');

        Route::get('xoa/{id}','LoaiTinController@xoa');
    });

    Route::group(['prefix'=>'tintuc'],function(){
        //admin/tintuc/them
        Route::get('danhsach','TinTucController@getDanhSach');

        Route::get('sua/{id}','TinTucController@getSua');
        Route::post('sua/{id}','TinTucController@postSua');
        
        Route::get('them','TinTucController@getThem');
        Route::POST('them','TinTucController@postThem');
        Route::get('xoa/{id}','TinTucController@xoa');
    });

    Route::group(['prefix'=>'ajax'],function(){
        Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
    });
});


