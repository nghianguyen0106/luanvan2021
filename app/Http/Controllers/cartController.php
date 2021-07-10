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

use App\Models\sanpham;
use App\Models\khachhang;
use App\Models\donhang;
use App\Models\chitietdonhang;
use App\Models\kho;
use App\Models\khuyenmai;
use App\Models\wishlist;
use App\Models\voucher;



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
                
                Cart::add( $productInfo->spMa , $productInfo->spTen , 1 ,$productInfo->spGia ,0, [ 'spHinh' => $productInfo->spHinh] );
                Session::flash('addCart','Đã thêm sản phẩm vào giỏ hàng !');
            }
        return Redirect::to('product');
    }

    public function savecart2(Request $re)
    {
        $productInfo=sanpham::join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spMa','=',$re->id)->first();
                $khMa=Session::get('khMa');
                
        Cart::add($productInfo->spMa,$productInfo->spTen,$re->quanty,$productInfo->spGia,0,[ 'spHinh' => $productInfo->spHinh] );

        Session::flash('comment','Đã thêm sản phẩm vào giỏ hàng !');
         return Redirect()->back();
    }

    public function destroy()
    {
        Cart::destroy();
        Session::forget('vcMa');
        return redirect()->back();
    }

    public function removeitem(Request $re)
    {
        Session::forget('vcMa');
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
            $checkExistVoucher=voucher::find(Session::get('vcMa'));
            if($checkExistVoucher)
            {
                if($checkExistVoucher->vcLoai == 0)
                {
                    Session::forget('vcMa');
                }
            }
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
        $checkExistVoucher=voucher::find(Session::get('vcMa'));
        $cart=Cart::content();
        if($check->qty==1)
        {
            if($checkExistVoucher && $check->id == $checkExistVoucher->spMa)
            {
                Session::forget('vcMa');
            }
            Cart::remove($re->id);
            return Redirect::to('checkout');
        }
        $d=$check->qty;
        $d--;
        Cart::update($re->id,$d);
        $total=0;
        $a=array();
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
            array_push($a,$i->id);
        }   
        if($checkExistVoucher)
        {
            if($checkExistVoucher->vcLoai == 1  && $checkExistVoucher->vcDkapdung == 1)
            {
                if(Cart::count() <  $checkExistVoucher->vcGtcandat)
                {
                    Session::forget('vcMa');
                    Session::flash('err','Đã bỏ áp dụng voucher vì không đủ số lượng !');
                }
            }
            if($checkExistVoucher->vcLoai == 1  && $checkExistVoucher->vcDkapdung == 0)
            {
                    //dd($checkExistVoucher->vcGtcandat,Session::get('total'));
                if( $total < $checkExistVoucher->vcGtcandat )
                {   
                    Session::forget('vcMa');
                    Session::flash('err','Đã bỏ áp dụng voucher vì tổng giá trị đơn hàng của bạn phải lớn hơn ' .number_format($checkExistVoucher->vcGtcandat)."đ mới có thể áp dụng voucher này !");
                }
            }
        }
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
                    session::flash('err','Sản phẩm '.$v->name.' còn: '.$checkQty->khoSoluong.', vui lòng liên hệ Hotline để biết thêm thông tin!');
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
                    if($re->kmMa!=null)
                    {
                        $dh->kmMa=$re->kmMa;
                    }
                    else
                    {
                        $dh->kmMa==null; 
                    }
                    
                    if($re->discount!=null && $re->price!=null)
                    {
                        $dh->hdGiamgia=$re->discount;
                        $dh->hdGiakhuyenmai=$re->price;
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
                            session::flash('err','Số điện thoại trong thông tin cá nhân không hợp lệ !');
                            return redirect('infomation/'.Session::get('khMa'));
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
                    if(Session::has('vcMa'))
                    {
                        $vcInfo=DB::table('voucher')->where('vcMa',Session::get('vcMa'))->first();
                        //update quanty of  voucher
                        $sl['vcSoluot']=$vcInfo->vcSoluot-1;
                        DB::table('voucher')->where('vcMa',Session::get('vcMa'))->update($sl);
                        $dh->vcMa=$vcInfo->vcMa;
                    }
                    $dh->save();
                    
                    //create order details
                    foreach (Cart::content() as $k => $i)
                    {
                        //update Quanty of Kho table
                        $productInfo=kho::where('spMa',$i->id)->first();
                        $updateKho['khoSoluong']=$productInfo->khoSoluong-$i->qty;
                        DB::table('kho')->where('spMa',$productInfo->spMa)->update($updateKho);

             
                        $ct=new chitietdonhang();
                        $ct->hdMa=$hdMa;
                        $ct->spMa= $i->id;
                        $ct->cthdSoluong=$i->qty;
                        $ct->cthdGia=$i->price * $i->qty;  
                        $proinfo=sanpham::where('spMa',$re->spMa)->first();
                        if($productInfo->spMa==$re->spMa && $proinfo->spSlkmtoida != 0 )
                        {
                            $proinfo->spSlkmtoida-=$i->qty;
                            //dd($proinfo);
                            $proinfo->update();
                            $ct->cthdTrigiakm=$re->discount; 
                        }
                        $ct->save();
                    }
                    //clear cart
                    Cart::destroy();
                    $this->sendmail($hdMa);
                    Session::forget('vcMa');
                    
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
        return Redirect::to('product');
    }

    public function sendmail($hdMa)
    {
        $details=chitietdonhang::where('hdMa',$hdMa)->join('sanpham','chitietdonhang.spMa','sanpham.spMa')->get();
        $order=donhang::Where('donhang.hdMa',$hdMa)->first();
        Mail::to(session::get('khEmail'))->send(new \App\Mail\mail($details,$order));
        Session::flash('addCart','Đặt hàng thành công! Vui lòng kiểm tra trong mục hóa đơn và hộp thư email của bạn ! Cảm ơn bạn đã mua hàng :DD !!!');
    }
}