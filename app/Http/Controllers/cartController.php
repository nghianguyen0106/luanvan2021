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
        $khMa=Session::get('khMa');
        $productInfo=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spMa','=',$re->id)->join('kho','kho.spMa','sanpham.spMa')->first();
       // dd($productInfo);
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
                $checkExistItem=DB::table('giohang')->where('khMa',$khMa)->where('spMa',$productInfo->spMa)->select('ghSoluong')->first();
                if(Session::has('khMa'))
                {
                     if($checkExistItem==null)
                    {
                        $data['khMa']=$khMa;
                        $data['spMa']=$productInfo->spMa;
                        $data['ghSoluong']=1;
                        DB::table('giohang')->insert($data);    
                    }
                    else
                    {
                        $quanty['ghSoluong']=$checkExistItem->ghSoluong+1;
                        DB::table('giohang')->where('khMa',$khMa)->where('spMa',$productInfo->spMa)->update($quanty);
                    }
                }
               
                
                 Session::flash('addCart','Đã thêm sản phẩm vào giỏ hàng !');
            }
        return Redirect::to('product');
    }

    public function savecart2(Request $re)
    {
        $productInfo=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spMa','=',$re->id)->first();
       
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
  
        //dd(Cart::get($re->id)->id);
        if(Session::has('khMa'))
        {

            $productInfo=DB::table('sanpham')->where('spMa',Cart::get($re->id)->id)->first();
            DB::table('giohang')->where('khMa',Session::get('khMa'))->where('spMa',Cart::get($re->id)->id)->delete();
            
        }
        Cart::remove($re->id);
        return redirect()->back();
    }

    public function changeQuantyIncrease(Request $re)
    {
        $check=Cart::get($re->id);
        $d=$check->qty;
        $d++;

        $productInfo=DB::table('giohang')->join('sanpham','sanpham.spMa','giohang.spMa')->where('sanpham.spMa',$check->id)->first();
        
        DB::table('giohang')->where('khMa',Session::get('khMa'))->where('spMa',$check->id)->update(['ghSoluong'=>$d]);

        //dd($productInfo);
        Cart::update($re->id,$d);
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
                //dd(date_create());
                if($customerInfo->khXtemail==1)
                {
                    //dd(date_timestamp_get(localtime()));
                    //create order
                    $data['khMa']=Session::get('khMa');
                    $data['hdSoluongsp']=Cart::count();
                    $data['hdTongtien']=$money;
                    $data['hdNgaytao']=date_create();
                    $data['hdTinhtrang']=0;
                    $data['adMa']=0;
                    $data['kmMa']=null;
                    $date=getdate();

                    $name=Session::get('khTaikhoan');
                    $data['hdMa']=''.$date['seconds'].$date['minutes'].substr($data['hdTongtien'],0,1).$date['yday'].$date['mon'];
                  
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

                    DB::table('donhang')->insert($data);
                    
                    
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
                        DB::table('chitietdonhang')->insert($dd);
                    }
                    Cart::destroy();
                    DB::table('giohang')->where('khMa',Session::get('khMa'))->delete();
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
       
        $details=DB::table('donhang')->join('chitietdonhang','donhang.hdMa','chitietdonhang.hdMa')->join('sanpham','sanpham.spMa','chitietdonhang.spMa')->where('donhang.hdMa',$hdMa)->get();

        Mail::to(session::get('khEmail'))->send(new \App\Mail\mail($details));
        Session::flash('addCart','Đặt hàng thành công! Vui lòng kiểm tra trong mục hóa đơn và hộp thư email của bạn ! Cảm ơn bạn đã mua hàng :DD !!!');
    }
    
}