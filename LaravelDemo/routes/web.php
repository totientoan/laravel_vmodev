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

        Route::get('sua','TheLoaiController@getSua');

        Route::get('them','ThemLoaiController@getThem');
    });

    Route::group(['prefix'=>'loaitin'],function(){
        //admin/loaitin/them
        Route::get('danhsach','LoaiTinController@getDanhSach');

        Route::get('sua','LoaiTinController@getSua');
        
        Route::get('them','LoaiTinController@getThem');
    });

    Route::group(['prefix'=>'tintuc'],function(){
        //admin/tintuc/them
        Route::get('danhsach','TinTucController@getDanhSach');

        Route::get('sua','TinTucController@getSua');
        
        Route::get('them','TinTucController@getThem');
    });
});


