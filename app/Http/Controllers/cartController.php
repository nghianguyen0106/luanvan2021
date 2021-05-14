<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Cart;
use Illuminate\Support\Facades\Mail;

use Session;
session_start();
class cartController extends Controller
{
    public function savecart(Request $re)
    {
        $productInfo=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spMa','=',$re->id)->join('kho','kho.spMa','sanpham.spMa')->get();
       // dd($productInfo);
        $count = array();
    
        foreach ($productInfo as $i) 
        {

            if($i->khoSoluong ==0 )
            {   
                Session::flash('errCart','Sản phẩm tạm hết hàng!');
                return Redirect::to('product');
            }
            elseif(in_array($i->spMa,$count)==null)
            {
                array_push($count,$i->spMa);
                Cart::add( $i->spMa , $i->spTen , 1 ,$i->spGia ,0, [ 'spHinh' => $i->spHinh] );
                 Session::flash('addCart','Đã thêm sản phẩm vào giỏ hàng !');
            }
        }
        return Redirect::to('product');
    }

    public function savecart2(Request $re)
    {
        $productInfo=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spMa','=',$re->id)->first();
       //dd($productInfo,$re->quanty);
        Cart::add($productInfo->spMa,$productInfo->spTen,$re->quanty,$productInfo->spGia,0,[ 'spHinh' => $productInfo->spHinh] );
        Session::flash('addCart','Đã thêm sản phẩm vào giỏ hàng !');
         return Redirect::to('product');
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

    public function changeQuantyIncrease(Request $re)
    {
        $check=Cart::get($re->id);
        $d=$check->qty;
        $d++;
        Cart::update($re->id,$d);
        //dd(Cart::get($re->id));
        return Redirect::to('checkout');
    }
    public function changeQuantyDecrease(Request $re)
    {
         
        $check=Cart::get($re->id);
        if($check->qty==1)
        {
            Cart::remove($re->id);
            return Redirect::to('checkout');
        }
        $d=$check->qty;
        $d--;
        Cart::update($re->id,$d);
        //dd(Cart::get($re->id));
        return Redirect::to('checkout');
    }

    public function gocheckout(Request $re,$money)
    {
     
        if(Cart::count()>0)
        {
            foreach (Cart::content() as $v) 
            {
                $checkQty=DB::table('kho')->where('spMa',$v->id)->first();
                if($v->qty>$checkQty->khoSoluong)
                {
                    session::flash('errCheckout','Số lượng của sản phẩm '.$v->name.' vượt quá số lượng trong kho hàng vui lòng điều chỉnh lại !');
                    return Redirect::to('checkout');
                }

            }
            if(session::has('khTaikhoan'))
            {
                $customerInfo=DB::table('khachhang')->where('khMa',Session::get('khMa'))->first();
                //dd($customerInfo);
                if($customerInfo->khToken==1)
                {
                    //create order
                    $data['khMa']=Session::get('khMa');
                    $data['hdSoluongsp']=Cart::count();
                    $data['hdTongtien']=$money;
                    $data['hdNgaytao']=date("Y/m/d");
                    $data['hdTinhtrang']=0;
                    $data['adMa']=0;
                    $date=getdate();
                    $name=Session::get('khTaikhoan');
                    $data['hdMa']=''.rand(0,10).substr($data['hdTongtien'],0,1).$date['yday'].$date['mon'].strlen($name).rand(0,10);
                    if($re->address !=null)
                    {
                        $data['hdDiachi']=$re->address;
                    }
                    else
                    {
                        $data['hdDiachi']=$customerInfo->khDiachi;
                    }
                    $data['hdGhichu']=$re->note;

                    if($re->sdt==null)
                    {
                        if($customerInfo->khSdt<100000000|| $customerInfo->khSdt>10000000000)
                        {
                            session::flash('errsdt','Số điện thoại trong thông tin cá nhân không hợp lệ !');
                            return redirect()->back();
                        }
                        else
                        {
                            
                        $data['hdSdtnguoinhan']=$customerInfo->khSdt;
                        }
                    }
                    elseif($re->sdt>10000000000||$re->sdt<100000000)
                    {
                        session::flash('errsdt','Số điện thoại không hợp lệ !');
                        return redirect()->back();
                    }
                    else
                    {
                        $data['hdSdtnguoinhan']=$re->sdt;
                    }

                    DB::table('hoadon')->insert($data);
                    
                    
                    //create order details
                    foreach (Cart::content() as $k => $i) 
                    {

                        $productQuanty=DB::table('kho')->where('spMa',$i->id)->first();
                                         

                        $update['khoSoluong']=$productQuanty->khoSoluong-$i->qty;
                        DB::table('kho')->where('spMa',$i->id)->update($update);
                        $dd['hdMa']=$data['hdMa'];
                        $dd['spMa']= $i->id;
                        $dd['cthdSoluong']=$i->qty;
                        $dd['cthdGia']=$i->price * $i->qty;
                        DB::table('chitiethoadon')->insert($dd);
                    }
                    Cart::destroy();

                    $this->sendmail($data['hdMa']);
                     return Redirect::to('product');
                }
                else
                {
                    session::flash('err','Vui lòng xác thực email trước khi thực hiện thanh toán!');
                    return Redirect::to('infomation/'.$customerInfo->khMa);
                }
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

    public function sendmail($hdMa)
    {
       
        $details=DB::table('hoadon')->join('chitiethoadon','hoadon.hdMa','chitiethoadon.hdMa')->join('sanpham','sanpham.spMa','chitiethoadon.spMa')->where('hoadon.hdMa',$hdMa)->get();

        Mail::to(session::get('khEmail'))->send(new \App\Mail\mail($details));
        Session::flash('addCart','Đặt hàng thành công! Vui lòng kiểm tra trong mục hóa đơn và hộp thư email của bạn ! Cảm ơn bạn đã mua hàng :DD !!!');
    }
    
}