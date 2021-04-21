<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Cart;
use Session;
session_start();
class cartController extends Controller
{
    public function savecart(Request $re)
    {
    	$productInfo=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spMa','=',$re->id)->get();
    	foreach ($productInfo as $i) 
    	{
    		Cart::add( $i->spMa , $i->spTen , 1 ,$i->spGia ,0, [ 'spHinh' => $i->spHinh] );
    	}
    	return redirect()->back();
    }
    public function destroy()
    {
    	Cart::destroy();
    	return redirect()->back();
    }
    public function removeitem(Request $re)
    {
    	Cart::remove($re->id);
    	return redirect()->back();
    }
    public function gocheckout($money)
    {
        // dd(Cart::content());
    	if(Cart::count()>0)
    	{
    		if(session::has('khTaikhoan'))
	    	{
	    		//create order
	    	$data['khMa']=Session::get('khMa');
	    	$data['hdSoluongsp']=Cart::count();
	    	$data['hdTongtien']=$money;
	    	$data['hdNgaytao']=date("Y/m/d");
	    	$data['hdTinhtrang']=0;
	    	$date=getdate();
	    	$name=Session::get('khTaikhoan');
	    	$data['hdMa']=''.substr($data['hdTongtien'],0,3).$date['yday'].$date['mon'].strlen($name);

	    	DB::table('hoadon')->insert($data);
	    	
            
	    	//create order details
	        foreach (Cart::content() as $k => $i) 
            {
                $dd['hdMa']=$data['hdMa'];
                $dd['spMa']= $i->id;
                $dd['cthdSoluong']=$i->qty;
                $dd['cthdGia']=$i->price * $i->qty;
                DB::table('chitiethoadon')->insert($dd);
            }
            $this->destroy();
	    	}
	    	else
	  	  	{
	  	  		session::put('loginmessage','Please login first !');
	    		return Redirect::to('login');
	    	}
    	}
    	else
    	{	
    		
    		return Redirect::to('product');
    	}
    }
    
}
