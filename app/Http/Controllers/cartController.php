<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Cart;
use Illuminate\Support\Facades\Mail;
use Session;
session_start();

//Models
use App\Models\giohang;
use App\Models\sanpham;
use App\Models\khachhang;
use App\Models\donhang;
use App\Models\chitietdonhang;
use App\Models\kho;
use App\Models\khuyenmai;
use App\Models\khuyenmai_log;


class cartController extends Controller
{
    public function savecart(Request $re)
    {
        $khMa=Session::get('khMa');
        $productInfo=sanpham::join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spMa','=',$re->id)->join('kho','kho.spMa','sanpham.spMa')->first();
        //dd($productInfo);
        $count = array();
    
            if($productInfo->khoSoluong ==0 )
            {   
                Session::flash('errCart','Sản phẩm tạm hết hàng!');
                return Redirect::to('product');
            }
            elseif(in_array($productInfo->spMa,$count)==null)
            {
                array_push($count,$productInfo->spMa);
                $checkExistIteminCart=giohang::where('khMa',$khMa)->where('spMa',$productInfo->spMa)->select('ghSoluong')->first();
                if(Session::has('khMa'))
                {
                     if($checkExistIteminCart==null)
                    {
                        $cart=new giohang();
                        $cart->khMa=$khMa;
                        $cart->spMa=$productInfo->spMa;
                        $cart->ghSoluong=1;
                        $cart->save();
                    }
                    else
                    {  
                        $cart=cart::content();
                        foreach($cart as $v)
                        {
                            if($v->qty < $productInfo->khoSoluong)
                            {
                                $quanty['ghSoluong']=$checkExistIteminCart->ghSoluong+1;
                                DB::table('giohang')->where('khMa',$khMa)->where('spMa',$productInfo->spMa)->update($quanty);
                            }
                            else
                            {
                                Session::flash('errCart','Số lượng sản phẩm:'.$productInfo->spTen.' trong giỏ hàng đã đạt tối đa !');
                                return Redirect::to('product');
                            }
                        }
                    }
                }
                Cart::add( $productInfo->spMa , $productInfo->spTen , 1 ,$productInfo->spGia ,0, [ 'spHinh' => $productInfo->spHinh] );
                Session::flash('addCart','Đã thêm sản phẩm vào giỏ hàng !');
            }
        return Redirect::to('product');
    }

    public function savecart2(Request $re)
    {
        $productInfo=sanpham::join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spMa','=',$re->id)->first();
                $khMa=Session::get('khMa');
                if(Session::has('khMa'))
                {
                    $checkExistIteminCart=giohang::where('khMa',$khMa)->where('spMa',$productInfo->spMa)->first();
                     if($checkExistIteminCart==null)
                    {
                        $cart=new giohang();
                        $cart->khMa=$khMa;
                        $cart->spMa=$productInfo->spMa;
                        $cart->ghSoluong=1;
                        $cart->save();
                    }
                    else
                    {   
                       $cart=cart::content();
                        foreach($cart as $v)
                        {
                            if($v->qty < $productInfo->khoSoluong)
                            {
                                $quanty['ghSoluong']=$checkExistIteminCart->ghSoluong+1;
                                DB::table('giohang')->where('khMa',$khMa)->where('spMa',$productInfo->spMa)->update($quanty);
                            }
                            else
                            {
                                Session::flash('errCart','Số lượng sản phẩm:'.$productInfo->spTen.' trong giỏ hàng đã đạt tối đa !');
                                return Redirect::to('product');
                            }
                        }
                    }
                }
        Cart::add($productInfo->spMa,$productInfo->spTen,$re->quanty,$productInfo->spGia,0,[ 'spHinh' => $productInfo->spHinh] );

        Session::flash('addCart','Đã thêm sản phẩm vào giỏ hàng !');
         return Redirect::to('product');
    }

    public function destroy()
    {
        Cart::destroy();
        DB::table('giohang')->where('khMa',Session::get('khMa'))->delete();
        return redirect()->back();
    }

    public function removeitem(Request $re)
    {
  
        //dd(Cart::get($re->id)->id);
        if(Session::has('khMa'))
        {
            $productInfo=sanpham::where('spMa',Cart::get($re->id)->id)->first();
            giohang::where('khMa',Session::get('khMa'))->where('spMa',Cart::get($re->id)->id)->delete();
        }
        Cart::remove($re->id);
        return redirect()->back();
    }

    public function changeQuantyIncrease(Request $re)
    {
        $check=Cart::get($re->id);
        $checkQty=kho::where('spMa',$check->id)->first();
        if($checkQty->khoSoluong>$check->qty)
        {
            $d=$check->qty;
            $d++;

            $productInfo=giohang::join('sanpham','sanpham.spMa','giohang.spMa')->where('sanpham.spMa',$check->id)->first();
            
            giohang::where('khMa',Session::get('khMa'))->where('spMa',$check->id)->update(['ghSoluong'=>$d]);
            Cart::update($re->id,$d);
        }
        else
        {
            Session::flash('err','Số lượng sản phẩm: '.$check->name.' còn: '.$checkQty->khoSoluong);
        }
       
        return Redirect::to('checkout');
    }

    public function changeQuantyDecrease(Request $re)
    {
         
        $check=Cart::get($re->id);
        if($check->qty==1)
        {
            Cart::remove($re->id);
            DB::table('giohang')->where('khMa',Session::get('khMa'))->where('spMa',$check->id)->delete();
            return Redirect::to('checkout');
        }
        $d=$check->qty;
        $d--;

        $productInfo=DB::table('giohang')->join('sanpham','sanpham.spMa','giohang.spMa')->where('sanpham.spMa',$check->id)->first();
        DB::table('giohang')->where('khMa',Session::get('khMa'))->where('spMa',$check->id)->update(['ghSoluong'=>$d]);

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
                $checkQty=kho::where('spMa',$v->id)->first();
                if($v->qty>$checkQty->khoSoluong)
                {
                    session::flash('err','Sản phẩm '.$v->name.' Vừa có khách hàng đặt trước bạn và cũng là sản phẩm cuối cùng, vui lòng liên hệ Hotline để biết thêm thông tin!');
                    return Redirect::to('checkout');
                }
            }
            if(session::has('khTaikhoan'))
            {
                $customerInfo=khachhang::where('khMa',Session::get('khMa'))->first();
                if($customerInfo->khXtemail==1)
                {
                    //create order
                    $dh= new donhang();
                    $dh->khMa=Session::get('khMa');
                    $dh->hdSoluongsp=Cart::count();
                    $dh->hdTongtien=$money;
                    $dh->hdNgaytao=date_create();
                    $dh->hdTinhtrang=0;
                    $dh->adMa=0;
                 
                    if($re->discount!=null && $re->price!=null)
                    {
                        $dh->hdGiamgia=$re->discount;
                        $dh->hdGiakhuyenmai=$re->price;
                        
                        //save to khuyenmai_log table
                        $checkExistKhuyenmai_log=khuyenmai_log::where('kmMa',$re->kmMa)->where('khMa',Session::get('khMa'))->first();
                        if($checkExistKhuyenmai_log)
                        {
                            $sl['kmgSolan']=$checkExistKhuyenmai_log->kmgSolan+=1;
                            DB::table('khuyenmai_log')->where('khMa',Session::get('khMa'))->where('kmMa',$re->kmMa)->update($sl);
                        }
                        else
                        {
                            $kmg= new khuyenmai_log();
                            $kmg->kmMa=$promoInfo->kmMa;
                            $kmg->khMa=Session::get('khMa');
                            $kmg->kmgSolan=1;
                            //$kmg->save();
                        }
                    }
                    else
                    {
                        $dh->hdGiamgia=0;
                        $dh->hdGiakhuyenmai=0;
                    }
                    $date=getdate();

                    $name=Session::get('khTaikhoan');
                    $dh->hdMa=''.$date['seconds'].$date['minutes'].substr($dh->hdTongtien,0,1).$date['yday'].$date['mon'];
                    $hdMa=$dh->hdMa;
                
                    if($re->address !=null)
                    {
                        $dh->hdDiachi=$re->address;
                    }
                    else
                    {
                        $dh->hdDiachi=$customerInfo->khDiachi;
                    }
                    $dh->hdGhichu=$re->note;
                    if($re->sdt==null)
                    {
                        if($customerInfo->khSdt<100000000|| $customerInfo->khSdt>10000000000)
                        {
                            session::flash('errsdt','Số điện thoại trong thông tin cá nhân không hợp lệ !');
                            return redirect()->back();
                        }
                        else
                        {
                            $dh->hdSdtnguoinhan=$customerInfo->khSdt;
                        }
                    }
                    elseif($re->sdt>10000000000||$re->sdt<100000000)
                    {
                        session::flash('errsdt','Số điện thoại không hợp lệ !');
                        return redirect()->back();
                    }
                    else
                    {
                        $dh->hdSdtnguoinhan=$re->sdt;
                    }
                    $dh->save();
                    
                    //create order details
                    foreach (Cart::content() as $k => $i) 
                    {
                        //update Quanty of Kho table
                        $productInfo=kho::where('spMa',$i->id)->first();
                        $updateKho['khoSoluong']=$productInfo->khoSoluong-$i->qty;
                        DB::table('kho')->where('spMa',$productInfo->spMa)->update($updateKho);
                        //

                        $ct=new chitietdonhang();
                        $ct->hdMa=$hdMa;
                        $ct->spMa= $i->id;
                        $ct->cthdSoluong=$i->qty;
                        $ct->cthdGia=$i->price * $i->qty;
                        if($productInfo->spMa==$re->spMa && $productInfo->spSlkmtoida >0 )
                        {
                            $proinfo=sanpham::where('spMa',$re->spMa)->first();
                            $proinfo->spSlkmtoida-=$i->qty;
                            $proinfo->update();
                            $ct->cthdTrigiakm=$re->discount;    
                        }
                        
                        $ct->save();
                    }

                    //clear cart
                     //   Cart::destroy();
                    giohang::where('khMa',Session::get('khMa'))->delete();
                    $this->sendmail($hdMa);
                    
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
                session::put('loginmessage','Vui lòng đăng nhập để thực hiện đặt hàng!');
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
        $details=chitietdonhang::where('hdMa',$hdMa)->join('sanpham','chitietdonhang.spMa','sanpham.spMa')->get();
        $order=donhang::Where('donhang.hdMa',$hdMa)->first();
        Mail::to(session::get('khEmail'))->send(new \App\Mail\mail($details,$order));
        Session::flash('addCart','Đặt hàng thành công! Vui lòng kiểm tra trong mục hóa đơn và hộp thư email của bạn ! Cảm ơn bạn đã mua hàng :DD !!!');
    }
    
}