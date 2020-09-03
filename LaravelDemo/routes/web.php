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

Route::get('admin/dangnhap','UserController@getDangnhapAdmin');
Route::post('admin/dangnhap','UserController@postDangnhapAdmin');
Route::get('admin/logout','UserController@getDangXuatAdmin');


Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){
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

    Route::group(['prefix'=>'comment'],function(){
        Route::get('xoa/{id}/{idTinTuc}','CommentController@xoa');
    });

    Route::group(['prefix'=>'slide'],function(){

        Route::get('danhsach','SlideController@getDanhSach');

        Route::get('sua/{id}','SlideController@getSua');
        Route::post('sua/{id}','SlideController@postSua');
        
        Route::get('them','SlideController@getThem');
        Route::POST('them','SlideController@postThem');

        Route::get('xoa/{id}','SlideController@xoa');
    });

    Route::group(['prefix'=>'user'],function(){

        Route::get('danhsach','UserController@getDanhSach');

        Route::get('sua/{id}','UserController@getSua');
        Route::post('sua/{id}','UserController@postSua');
        
        Route::get('them','UserController@getThem');
        Route::POST('them','UserController@postThem');

        Route::get('xoa/{id}','UserController@xoa');
    });

    Route::group(['prefix'=>'ajax'],function(){
        Route::get('loaitin/{idTheLoai}','AjaxController@getLoaiTin');
    });
});

Route::get('trangchu','PagesController@trangchu');
Route::get('lienhe','PagesController@lienhe');
Route::get('loaitin/{id}/{TenKhongGiau}.html','PagesController@loaitin');
