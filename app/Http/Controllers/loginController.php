<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
session_start();
class loginController extends Controller
{
     public function userlogin(Request $re)
    {
    	$username=$re->username;
    	$password=md5($re->password);
    	$result=DB::table('khachhang')->where('khTaikhoan',$username)->where('khMatkhau',$password)->first();
    	if($result)
    	{
    		session::put("khTen",$result->khTen);
    		return Redirect::to('product');
    	}
    	else
    	{
	    	session::put("loginmessage","Wrong username or password!");
    		return Redirect::to('login');
    	}
    }
}
