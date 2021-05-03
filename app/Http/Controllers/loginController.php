<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Socialite;
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
            session::put("khMa",$result->khMa);
    		session::put("khTen",$result->khTen);
            session::put('khTaikhoan',$result->khTaikhoan);
            session::put('khMa',$result->khMa);
            session::put('khEmail',$result->khEmail);
            session::put('khHinh',$result->khHinh);
            Session::flash('loginmess','Đăng nhập thành công !');
            Session::flash('name','Chào '.$result->khTen.' !!!');
    		return Redirect::to('product');
    	}
    	else
    	{
	    	session::flash("loginmessage","Wrong username or password!");
    		return Redirect::to('login');
    	}
    }
    public function loginGoogle()
    {
        try
        {
            return Socialite::driver('google')->redirect();
        }
        catch(Exception $e)
        {
            return Redirect::to('login');
        }
    }
    public function googleredirect()
    {
            $userInfo=Socialite::driver('google')->user();
            //dd($userInfo);
            $checkEmail= DB::table('khachhang')->where('khEmail',$userInfo->email)->first();
           if($checkEmail!=null)
           {
                session::put("khMa",$checkEmail->khMa);
                session::put("khTen",$checkEmail->khTen);
                session::put('khTaikhoan',$checkEmail->khTaikhoan);
                session::put('khMa',$checkEmail->khMa);
                session::put('khEmail',$checkEmail->khEmail);
                session::put('khHinh',$checkEmail->khHinh);
                Session::flash('loginmess','Đăng nhập thành công !');
                Session::flash('name','Chào '.$checkEmail->khTen.' !!!');
                return Redirect::to('product');
           }
           else
           {
                $data['khTen']=substr($userInfo->name,0,stripos($userInfo->name," "));
                $data['khMatkhau']=md5("123"); 
                $data['khEmail']=$userInfo->email;
                $data['khNgaysinh']='1999-06-01';
                $data['khDiachi']='180 cao lo phuong 4 quan 8';
                $data['khQuyen']=0;
                $data['khGioitinh']=0;
                $data['khTaikhoan']=$userInfo->id;
                $data['khMa']="".strlen($data['khTen']).strlen( $data['khDiachi']).strlen($data['khTaikhoan']).strlen($data['khMatkhau']);
                DB::table('khachhang')->insert($data);
                //login
                session::put("khMa",$data['khMa']);
                session::put("khTen",$data['khTen']);
                session::put('khTaikhoan',$data['khTaikhoan']);
                session::put('khEmail',$data['khEmail']);
                Session::flash('loginmess','Đăng ký thành công vui lòng xác thực Email và kiểm tra thông tin trong mục thông tin cá nhân !');
                Session::flash('name','Chào '.$data['khTen'].' !!!');
                return Redirect::to('product');
      
           }
       
    }

    public function loginFacebook()
        {
            try
            {
                return Socialite::driver('facebook')->redirect();
            }
            catch(Exception $e)
            {
                return Redirect::to('login');
            }
        }
        public function facebookredirect()
        {
                $userInfo=Socialite::driver('facebook')->user();
                //dd($userInfo);
                $checkEmail= DB::table('khachhang')->where('khEmail',$userInfo->email)->first();
               if($checkEmail!=null)
               {
                    session::put("khMa",$checkEmail->khMa);
                    session::put("khTen",$checkEmail->khTen);
                    session::put('khTaikhoan',$checkEmail->khTaikhoan);
                    session::put('khMa',$checkEmail->khMa);
                    session::put('khEmail',$checkEmail->khEmail);
                    Session::flash('loginmess','Đăng nhập thành công !');
                    Session::flash('name','Chào '.$checkEmail->khTen.' !!!');
                    return Redirect::to('product');
               }
               else
               {
                    $data['khTen']=substr($userInfo->name,0,stripos($userInfo->name," "));
                    $data['khMatkhau']=md5("123"); 
                    $data['khEmail']=$userInfo->email;
                    $data['khNgaysinh']='1999-06-01';
                    $data['khDiachi']='180 cao lo phuong 4 quan 8';
                    $data['khQuyen']=0;
                    $data['khGioitinh']=0;
                    $data['khTaikhoan']=$userInfo->id;
                    $data['khMa']="".strlen($data['khTen']).strlen( $data['khDiachi']).strlen($data['khTaikhoan']).strlen($data['khMatkhau']);
                    DB::table('khachhang')->insert($data);
                    //login
                    session::put("khMa",$data['khMa']);
                    session::put("khTen",$data['khTen']);
                    session::put('khTaikhoan',$data['khTaikhoan']);
                    session::put('khEmail',$data['khEmail']);
                    Session::flash('loginmess','Đăng ký thành công vui lòng xác thực Email và kiểm tra thông tin trong mục thông tin cá nhân !');
                    Session::flash('name','Chào '.$data['khTen'].' !!!');
                    return Redirect::to('product');
          
               }
           
        }

   
}
