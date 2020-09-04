<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //khi gọi bất kỳ controller nào thì controller này sẽ chạy
    function __construct()
    {
        //$this->DangNhap();
    }

    function DangNhap()
    {
        // if(Auth::check()){
        //     //gửi 'user' tới tất cả các view
        //     view()->share('userdangnhap', Auth::user());
        // }
    }
}
