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
	    	if(strlen($re->password)<=8)
	    	{
	    		Session::flash('error',' Mật khẩu quá ngắn vui lòng chọn mật khẩu an toàn hơn!');
	    		return Redirect::to('register');
	    	}
	    	if($result)
	    	{
	    		Session::flash('error','Email này đã dùng cho tài khoản khác!');
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
	    		Session::flash('error',' Mật khẩu xác nhận chưa trùng khớp !');
	    		return Redirect::to('register');
	    	}
	    	$check18=date_create($re->date);
	    	$check18=date_format($check18,'Y');
	    	$today=getdate();
	    	$thisyear=$today['year'];
	    	
	    	$decrease=$thisyear-$check18;

	    	if($decrease <= 18)
	    	{
	    		Session::flash('error',' Tuổi chưa đủ 18 !');
	    		return Redirect::to('register');
	    	}
	    	if($decrease <=0)
	    	{
	    		Session::flash('error',' Ngày sinh không hợp lệ!');
	    		return Redirect::to('register');
	    	}


	    	$data['khNgaysinh']=$re->date;
	    	$data['khDiachi']=$re->address;
	    	if(strlen($re->address)<15)
	    	{
	    		Session::flash('error',' Địa chỉ không hợp lệ!');
	    		return Redirect::to('register');
	    	}
	    	$data['khQuyen']=0;
	    	$data['khGioitinh']=$re->sex;
	    	if($re->sdt>10000000000||$re->sdt<100000000)
                    {
                        session::flash('error','Số điện thoại không hợp lệ !');
                        return redirect()->back();
                    }
                    else
                    {
                        $data['khSdt']=$re->sdt;
                    }
	    	
	    	$result2=DB::table('khachhang')->where('khTaikhoan',$re->username)->first();
	    
	    	if($result2)
	    	{
			 	Session::flash('error','Username đã tồn tại vui lòng chọn username khác!');
	    		return Redirect()->back();
	    	}
	    	else
	    	{
	    			$data['khTaikhoan']=$re->username;
	    	}
	    	$data['khMa']="".strlen($re->name).strlen($re->address).strlen($re->username).strlen($re->password);
	    	//dd($decrease);
	    	DB::table('khachhang')->insert($data);
	    	Session::flash('registerSuccess',' Please login :D ');
	    	return Redirect::to('login');	
    }

}
