<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;
class registerController extends Controller
{
    public function index()
    {
    	return view('userpage.userregister');
    }
    public function getregister(Request $re)
    {
   
	    	$data['khTen']=$re->name;
	    	$result=DB::table('khachhang')->where('khEmail',$re->email)->first();
	    	if($result)
	    	{
	    		Session::put('error','Email is used for another account  !');
	    		return Redirect::to('register');
	    	}
	    	else
	    	{
	    		
	    		$data['khEmail']=$re->email;
	    	}
	    	if($re->password==$re->repassword)
	    	{
	    		$data['khMatkhau']=md5($re->password);	
	    	}
	    	else
	    	{
	    		Session::put('error',' Password and Repassword does not match !');
	    		return Redirect::to('register');
	    	}
	    	$data['khNgaysinh']=$re->date;
	    	$data['khDiachi']=$re->address;
	    	$data['khQuyen']=0;
	    	$data['khGioitinh']=$re->sex;
	    	$result2=DB::table('khachhang')->where('khTaikhoan',$re->username)->first();
	    
	    	if($result2)
	    	{
			 	Session::put('error','Username already exists !');
	    		return Redirect()->back();
	    	}
	    	else
	    	{
	    			$data['khTaikhoan']=$re->username;
	    	}
	    	$data['khMa']="".strlen($re->name).strlen($re->address).strlen($re->username).strlen($re->password);
	    	DB::table('khachhang')->insert($data);
	    	Session::flash('registerSuccess',' Please login :D ');
	    	return Redirect::to('login');
    }
}
