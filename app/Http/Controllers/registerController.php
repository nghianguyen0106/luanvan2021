<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use DB;

//Models
use App\Models\khachhang;
class registerController extends Controller
{
    public function index()
    {
    	return view('userpage.userregister');
    }
    public function getregister(Request $re)
    {
   			$kh= new khachhang();
	    	$kh->khTen=$re->name;
	    	$result=DB::table('khachhang')->where('khEmail',$re->email)->first();
	    	if(strlen($re->password)<=8)
	    	{
	    		Session::flash('error',' Mật khẩu quá ngắn vui lòng chọn mật khẩu an toàn hơn!');
	    		return Redirect()->back();
	    	}
	    	if($result)
	    	{
	    		Session::flash('error','Email này đã dùng cho tài khoản khác!');
	    		return Redirect()->back();
	    	}
	    	else
	    	{
	    		$kh->khEmail=$re->email;
	    	}
	    	if($re->password==$re->repassword)
	    	{
	    		$kh->khMatkhau=md5($re->password);	
	    	}
	    	else
	    	{
	    		Session::flash('error',' Mật khẩu xác nhận chưa trùng khớp !');
	    		return Redirect()->back();
	    	}
	    	$check18=date_create($re->date);
	    	$check18=date_format($check18,'Y');
	    	$today=getdate();
	    	$thisyear=$today['year'];
	    	
	    	$decrease=$thisyear-$check18;

	    	if($decrease <= 18)
	    	{
	    		Session::flash('error',' Tuổi chưa đủ 18 !');
	    		return Redirect()->back();
	    	}
	    	if($decrease <=0)
	    	{
	    		Session::flash('error',' Ngày sinh không hợp lệ!');
	    		return Redirect()->back();
	    	}


	    	$kh->khNgaysinh=$re->date;
	    	$kh->khDiachi=$re->address;
	    	if(strlen($re->address)<15)
	    	{
	    		Session::flash('error',' Địa chỉ không hợp lệ!');
	    		return Redirect()->back();
	    	}
	    	$kh->khQuyen=0;
	    	$kh->khGioitinh=$re->sex;
	    	$kh->khNgaythamgia=date_create();
	    	//dd($data);
	    	if($re->sdt>10000000000||$re->sdt<100000000)
                    {
                        session::flash('error','Số điện thoại không hợp lệ !');
                        return redirect()->back();
                    }
                    else
                    {
                        $kh->khSdt=$re->sdt;
                    }
	    	
	    	$result2=DB::table('khachhang')->where('khTaikhoan',$re->username)->first();
	    
	    	if($result2)
	    	{
			 	Session::flash('error','Username đã tồn tại vui lòng chọn username khác!');
	    		return Redirect()->back();
	    	}
	    	else
	    	{
	    			$kh->khTaikhoan=$re->username;
	    	}
	    	$kh->khMa="".strlen($re->name).strlen($re->address).strlen($re->username).strlen($re->password);
	    	$khMa=$kh->khMa;
	    	//dd($decrease);
	    	$kh->save();
	    	Session::flash('success',' Đăng ký thành công vui lòng xác thực Email! ');
	    	return Redirect::to('verify-email/'.$khMa);	
    }
}
