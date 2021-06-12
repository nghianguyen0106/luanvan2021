<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Socialite;
use DB;
use Session;
use Mail;
use Cart;
session_start();

use App\Models\khachhang;
use App\Models\giohang;
class loginController extends Controller
{
     public function userlogin(Request $re)
    {
        
    	$username=$re->username;
    	$password=md5($re->password);
    	$result=khachhang::where('khTaikhoan',$username)->where('khMatkhau',$password)->first();
    	if($result)
    	{
            session::put("khMa",$result->khMa);
            session::put("khTen",$result->khTen);
            session::put('khTaikhoan',$result->khTaikhoan);
            session::put('khMa',$result->khMa);
            session::put('khEmail',$result->khEmail);
            session::put('khHinh',$result->khHinh);
            session::put('khDiachi',$result->khDiachi);
            session::put('khSdt',$result->khSdt);
            Session::flash('loginmess','Đăng nhập thành công !');
            Session::flash('name','Chào '.$result->khTen.' !!!');

            
            
            //-save old cart
            $count = array();
            foreach(cart::content() as $v)
            {

                if(in_array($v->id,$count)==null)
                {
                    array_push($count, $v->id);
                    $checkExistprod=giohang::where('khMa',Session::get('khMa'))->where('spMa',$v->id)->first();
                    if($checkExistprod)
                    {
                        $checkExistprod->ghSoluong=$v->qty;
                        $checkExistprod->update();
                    }
                    else
                    {
                        $cart= new giohang();
                        $cart->khMa=Session::get('khMa');
                        $cart->spMa=$v->id;
                        $cart->ghSoluong=$v->qty;
                        $cart->save();
                    }
                }
            }
            cart::  destroy();
            //load cart
            $count2 = array();
            $productInfo=giohang::leftjoin('sanpham','sanpham.spMa','giohang.spMa')->join('hinh','hinh.spMa','sanpham.spMa')->where('khMa',$result->khMa)->get();
            //dd($productInfo);
            foreach ($productInfo as $v) 
            {
                if(in_array($v->spMa,$count2)==null)
                {
                    array_push($count2, $v->spMa);
                    Cart::add( $v->spMa , $v->spTen , $v->ghSoluong ,$v->spGia ,0, [ 'spHinh' => $v->spHinh]);
                    var_dump($v->spMa);
                }
            }
            
    		return Redirect::to('product');
    	}
    	else
    	{
	    	session::flash("loginmessage","Sai tên đăng nhập hoặc mật khảu!");
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
            $checkEmail=khachhang::where('khEmail',$userInfo->email)->first();
           if($checkEmail!=null)
           {
                session::put("khMa",$checkEmail->khMa);
                session::put("khTen",$checkEmail->khTen);
                session::put('khTaikhoan',$checkEmail->khTaikhoan);
                session::put('khMa',$checkEmail->khMa);
                session::put('khEmail',$checkEmail->khEmail);
                session::put('khHinh',$checkEmail->khHinh);
                session::put('khDiachi',$checkEmail->khDiachi);
                session::put('khSdt',$checkEmail->khSdt);
                Session::flash('loginmess','Đăng nhập thành công !');
                Session::flash('name','Chào '.$checkEmail->khTen.' !!!');

                $count = array();
                foreach(cart::content() as $v)
                {

                    if(in_array($v->id,$count)==null)
                    {
                        array_push($count, $v->id);
                        $checkExistprod=giohang::where('khMa',Session::get('khMa'))->where('spMa',$v->id)->first();
                        if($checkExistprod)
                        {
                            $sl['ghSoluong']=$checkExistprod->ghSoluong+$v->qty;
                            DB::table('giohang')->where('khMa',Session::get('khMa'))->where('spMa',$checkExistprod->spMa)->update($sl);
                        }
                        else
                        {
                            $cart= new giohang();
                            $cart->khMa=Session::get('khMa');
                            $cart->spMa=$v->id;
                            $cart->ghSoluong=$v->qty;
                            $cart->save();
                        }
                    }
                }
                cart::  destroy();
                //load cart
                $count2 = array();
                $productInfo=giohang::leftjoin('sanpham','sanpham.spMa','giohang.spMa')->join('hinh','hinh.spMa','sanpham.spMa')->where('khMa',Session::get('khMa'))->get();
                //dd($productInfo);
                foreach ($productInfo as $v) 
                {
                    if(in_array($v->spMa,$count2)==null)
                    {
                        array_push($count2, $v->spMa);
                        Cart::add( $v->spMa , $v->spTen , $v->ghSoluong ,$v->spGia ,0, [ 'spHinh' => $v->spHinh]);
                        //var_dump($v->spMa);
                    }
                }
                return Redirect::to('product');
           }
           else
           {
                //if not exist Account go to auto register
                $data['khTen']=substr($userInfo->name,0,stripos($userInfo->name," "));
                $data['khMatkhau']=md5("123"); 
                $data['khEmail']=$userInfo->email;
                $data['khNgaysinh']=date_create();
                $data['khDiachi']='';
                $data['khQuyen']=0;
                $data['khGioitinh']=0;
                $data['khSdt']=0;
                $data['khTaikhoan']=$userInfo->id;
                $data['khNgaythamgia']=date_create();
                //dd($data);
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
                $checkEmail= khachhang::where('khEmail',$userInfo->email)->first();
               if($checkEmail!=null)
               {
                    session::put("khMa",$checkEmail->khMa);
                    session::put("khTen",$checkEmail->khTen);
                    session::put('khTaikhoan',$checkEmail->khTaikhoan);
                    session::put('khMa',$checkEmail->khMa);
                    session::put('khEmail',$checkEmail->khEmail);
                    session::put('khHinh',$checkEmail->khHinh);
                    session::put('khDiachi',$checkEmail->khDiachi);
                    session::put('khSdt',$checkEmail->khSdt);
                    Session::flash('loginmess','Đăng nhập thành công !');
                    Session::flash('name','Chào '.$checkEmail->khTen.' !!!');

                 $count = array();
                foreach(cart::content() as $v)
                {

                    if(in_array($v->id,$count)==null)
                    {
                        array_push($count, $v->id);
                        $checkExistprod=giohang::where('khMa',Session::get('khMa'))->where('spMa',$v->id)->first();
                        if($checkExistprod)
                        {
                            $sl['ghSoluong']=$checkExistprod->ghSoluong+$v->qty;
                            DB::table('giohang')->where('khMa',Session::get('khMa'))->where('spMa',$checkExistprod->spMa)->update($sl);
                        }
                        else
                        {
                            $cart= new giohang();
                            $cart->khMa=Session::get('khMa');
                            $cart->spMa=$v->id;
                            $cart->ghSoluong=$v->qty;
                            $cart->save();
                        }
                    }
                }
                cart::destroy();
                //load cart
                $count2 = array();
                $productInfo=giohang::leftjoin('sanpham','sanpham.spMa','giohang.spMa')->join('hinh','hinh.spMa','sanpham.spMa')->where('khMa',Session::get('khMa'))->get();
                //dd($productInfo);
                foreach ($productInfo as $v) 
                {
                    if(in_array($v->spMa,$count2)==null)
                    {
                        array_push($count2, $v->spMa);
                        Cart::add( $v->spMa , $v->spTen , $v->ghSoluong ,$v->spGia ,0, [ 'spHinh' => $v->spHinh]);
                      
                    }
                }
                return Redirect::to('product');
                }
                else
                {
                    $data['khTen']=substr($userInfo->name,0,stripos($userInfo->name," "));
                    $data['khMatkhau']=md5("123"); 
                    $data['khEmail']=$userInfo->email;
                    $data['khNgaysinh']=date_create();
                    $data['khDiachi']="";
                    $data['khQuyen']=0;
                    $data['khGioitinh']=0;
                    $data['khSdt']=0;
                    $data['khTaikhoan']=$userInfo->id;
                    $data['khNgaythamgia']=date_create();
                //dd($data);
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

    public function sendCodeGetAcc(Request $re)
    {
        $checkAccount=DB::table('khachhang')->where('khEmail',$re->email)->first();
          $date=getdate();
        if($checkAccount)
        {
            $details=strlen($checkAccount->khMa).$checkAccount->khMa.$date['seconds'].$date['minutes'].$date['hours'].$date['hours'].$date['yday'];
            
            DB::table('khachhang')->where('khEmail',$re->email)->update(['khResetpassword'=> $details]);
           Mail::to($re->email)->send(new \App\Mail\mailToGetAcc($details));
           session::flash('mail','Một email đã được gửi vui lòng kiểm trang hòm thư của bạn !!');
           return redirect()->back();
        }
        elseif($re->email==null)
        {
             session::flash('err','Vui lòng nhập email của tài khoản cần khôi phục !');
            return Redirect::to('forgotPassword');
        }
        else
        {
           session::flash('err','Email Chưa được đăng ký !');
            return Redirect::to('forgotPassword');
        }
    }
    
    public function changepassword(Request $re)
    {
        if($re->id == null)
        {
            session::flash('loginmessage','Đường link không hợp lệ!!');
            return Redirect::to('login');
        }
        else
        {
            $checkExistAcc=DB::table('khachhang')->where('khResetpassword',$re->id)->first();
            if(!$checkExistAcc)
            {
                session::flash('loginmessage','Đường link không hợp lệ!!');
                return Redirect::to('login');
            }
            else
            {
                return view('Userpage.changePassword')->with('id',$checkExistAcc->khMa)->with('name',$checkExistAcc->khTen);
            }
        }
    }

    public function newpass(Request $re)
    {
        if($re->password ==null|| $re->repassword ==null)
        {
            session::flash('err','Vui lòng nhập đầy đủ mật khẩu và xác nhận mật khẩu!');
                return Redirect()->back();
        }
        elseif($re->password != $re->repassword)
        {
            session::flash('err','Mật khẩu xác nhận không trung khớp ! ');
            return Redirect()->back();
        }
        else
        {   
            $checkOldPass=DB::table('khachhang')->where('khMa',$re->id)->where('khMatkhau',md5($re->password))->select('khTen')->first();
            //dd($checkOldPass);
            if($checkOldPass!=null)
            {
                Session::flash('err',' Mật khẩu đã được dùng vui lòng chọn mật khẩu an toàn hơn!');
                return Redirect()->back();
            }
            if(strlen($re->password)<=8)
            {
                Session::flash('err',' Mật khẩu quá ngắn vui lòng chọn mật khẩu an toàn hơn!');
                return Redirect()->back();
            }
            DB::table('khachhang')->where('khMa',$re->id)->update(['khMatkhau'=>md5($re->password)]);
            session::flash('changepassword',' Vui lòng đăng nhập lại ! ');
            return Redirect::to('login');
        }
    }
}
