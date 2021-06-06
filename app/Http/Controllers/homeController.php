<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use Cart;
//Models
use App\Models\thuonghieu;
use App\Models\loai;
use App\Models\nhucau;
use App\Models\sanpham;
use App\Models\kho;
use App\Models\nhacungcap;
use App\Models\hinh;
use App\Models\khuyenmai;
use App\Models\danhgia;
use App\Models\khachhang;
use App\Models\mota;
use App\Models\banner;


use Illuminate\Support\Facades\Mail;
class homeController extends Controller
{
    public function welcome()
    {
        $dblap=sanpham::join('hinh','hinh.spMa','=','sanpham.spMa')->where('sanpham.loaiMa',1)->limit(6)->get();
        $dbpc=sanpham::join('hinh','hinh.spMa','=','sanpham.spMa')->where('sanpham.loaiMa',2)->limit(6)->get();
            return view('welcome',compact('dblap','dbpc'));
    }
    
     // forgot password
    public function forgotPassword()
    {
        $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
        return view('Userpage.forgotPassword',compact('total'));
    }
    public function login()
    {
        return view('Userpage.userlogin');
    }
    public function logout()
    {
        Cart::destroy();
        session::forget("khMa");
        session::forget("khTen");
        session::forget('khTaikhoan');
        session::forget('khMa');
        session::forget('khEmail');
        session::forget('khHinh');
        return view('Userpage.userlogin');
    }
// PRODUCT
     public function product()
    {
        $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }


        $slide = banner::where('bnVitri',0)->orderBy('bnNgay','desc')->limit(3)->get();
        $countSlide =banner::where('bnVitri',0)->orderBy('bnNgay','desc')->count();
        $bnCon = banner::where('bnVitri',1)->orderBy('bnNgay','desc')->limit(5)->get();
        $countBnCon1 = banner::where('bnVitri',1)->orderBy('bnNgay','desc')->limit(2)->count();
        $countBnCon2 = banner::where('bnVitri',1)->orderBy('bnNgay','desc')->limit(5)->count();



        $db = sanpham::leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->get();
       // dd($db);
        $brand=thuonghieu::get();
        $cate=loai::get();
        $needs=nhucau::get();
        return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
    }
   
    public function proinfo(Request $re)
    {
        $comment=danhgia::where('spMa',$re->id)->leftjoin('khachhang','danhgia.khMa','khachhang.khMa')->orderBy('dgNgay','asc')->get();
        $checkordered=khachhang::join('donhang','donhang.khMa','khachhang.khMa')->join('chitietdonhang','chitietdonhang.hdMa','donhang.hdMa')->where('chitietdonhang.spMa',$re->id)->where('donhang.khMa',Session::get('khMa'))->where('donhang.hdTinhtrang',4)->select('spMa')->first();

        


        $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
        $cate=loai::all();

        $imgs=hinh::where('spMa',$re->id)->get();
        $details=mota::where('spMa',$re->id)->get(); 
        $proinfo=sanpham::join('kho','kho.spMa','sanpham.spMa')->join('loai','loai.loaiMa','=','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','=','sanpham.thMa')->where('sanpham.spMa',$re->id)->first();

        $today=now();
        $availPromo=sanpham::leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->where('kmNgaybd','<=',$today)->where('khuyenmai.kmNgaykt','>=',$today)->where('sanpham.spMa',$re->id)->get();
       

        $related_prod=sanpham::join('loai','loai.loaiMa','=','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','=','sanpham.thMa')->join('hinh','hinh.spMa','=','sanpham.spMa')->where('loai.loaiMa',$proinfo->loaiMa)->where('thuonghieu.thMa',$proinfo->thMa)->get();

        return view('Userpage.productinfo',compact('proinfo','imgs','details','related_prod','total','comment','checkordered','availPromo'));
    }
     //---Find product
    public function findpro(Request $re)
    {
        //Xóa thông báo lỗi đổi mật khẩu khi chuyển trang
    Session::forget("note__errC");
       Session::forget("note__err");
       //end
         $db = DB::table('hinh')->join('sanpham', 'hinh.spMa', '=', 'sanpham.spMa')->get();
        $brand=DB::table('thuonghieu')->get();
        $cate=loai::get();
        $needs=nhucau::get();
         $cart=Cart::content();
        $total=0;
        $slide = banner::where('bnVitri',0)->orderBy('bnNgay','desc')->limit(3)->get();
        $countSlide =banner::where('bnVitri',0)->orderBy('bnNgay','desc')->count();
        $bnCon = banner::where('bnVitri',1)->orderBy('bnNgay','desc')->limit(5)->get();
        $countBnCon1 = banner::where('bnVitri',1)->orderBy('bnNgay','desc')->limit(2)->count();
        $countBnCon2 = banner::where('bnVitri',1)->orderBy('bnNgay','desc')->limit(5)->count();


        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }

        if($re->priceFrom > $re->priceTo)
        {
            if($re->proname !=null && $re->brand!=null && $re->category !=null && $re->needs!=null)
            {   
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->category !=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->category !=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->category !=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null &&  $re->needs!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null && $re->category !=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null&& $re->needs!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->category !=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.loaiMa',$re->category)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.thMa',$re->brand)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->category !=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.loaiMa',$re->category)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->needs !=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            else
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            return Redirect::to('product');
        }
        elseif ($re->priceFrom<$re->priceTo) 
        {
            if($re->proname !=null && $re->brand!=null && $re->category !=null && $re->needs!=null)
            {   
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->category !=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->category !=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->category !=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null &&  $re->needs!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null && $re->category !=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null&& $re->needs!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->category !=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.loaiMa',$re->category)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.thMa',$re->brand)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->category !=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.loaiMa',$re->category)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->needs !=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            else
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->get();
                //dd($db);
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            return Redirect::to('product');
        }
        else
        {
            if($re->proname !=null && $re->brand!=null && $re->category !=null && $re->needs!=null)
            {   
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->category !=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->category !=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->category !=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null &&  $re->needs!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->get();                
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null && $re->category !=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null&& $re->needs!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->category !=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.loaiMa',$re->category)->get();
                
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.thMa',$re->brand)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->category !=null )
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.loaiMa',$re->category)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->needs !=null )
            {
               $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.ncMa',$re->needs)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            return Redirect::to('product');
        }
        return Redirect::to('product');
    }
    // --------------
    
    // Commment
    public function addcomment(Request $re)
    {
            $this->validate($re,[
                'content'=>'required'],[
                'content.required'=>'Nội dung không được để trống']);
            $date=getdate();
            $data['dgMa']=''.strlen($re->content).$date['yday'].rand(0,100).substr($re->id,0,2);
            $data['spMa']=$re->id;
            $data['dgNoidung']=$re->content;
            $data['khMa']=Session::get('khMa');
            $data['dgNgay']=now();
            $data['dgTrangthai']=1;
            DB::table('danhgia')->insert($data);
            session::flash('comment','Đã đăng bình luận !');
            return redirect()->back();
    }

    public function deleteComment(Request $re)
    {
        DB::table('danhgia')->where('dgMa',$re->id)->delete();
        return redirect()->back();
    }
    // ----------
//----------------

// CART
    public function checkout()
    {   
        //Xóa thông báo lỗi đổi mật khẩu khi chuyển trang
        Session::forget("note__errC");
       Session::forget("note__err");
       //end
        $cate=loai::get();
        $cart=cart::content();
        $total=0;
        $a=array();
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
            array_push($a,$i->id);
        }   
        $today=now();
        
        $checkexistKhuyenmai=khuyenmai::join('sanpham','sanpham.kmMa','khuyenmai.kmMa')->where('kmNgaybd','<=',$today)->whereIn('sanpham.spMa',$a)->where('kmNgaykt','>=',$today)->get();
        //dd($checkexistKhuyenmai);
                
        
       return view('Userpage.checkout',compact('cate','cart','total'))->with('promotion',$checkexistKhuyenmai);
    }

    public function order(Request $re)
    {
        //  dd($re->promo);
        if(Cart::count()>0)
        {
            if(session::has('khTaikhoan'))
            {
                $cart=Cart::content();
                $leng=strlen($re->promo);
                $str=strpos($re->promo,",");//vi tri
                $kmMa=substr($re->promo,0,$str);
                $spMa=substr($re->promo,$str+1,$leng);
                $promoInfo=khuyenmai::where('khuyenmai.kmMa',$kmMa)->join('sanpham','sanpham.kmMa','khuyenmai.kmMa')->first();
                //dd($promoInfo);

                
                $cate=loai::get();
                $total=0;
                foreach ($cart as  $i) 
                {
                    $total+=$i->price*$i->qty;
                }

                
                return view('Userpage.confirmcheckout',compact('promoInfo','cate','cart','total'));
            }
            else
            {
                session::flash('loginmessage','Vui lòng đăng nhập trước khi thực hiện đặt hàng!');
                return Redirect::to('login');
            }
        }
        else
        {   
             Session::flash('errCart','Giỏ hàng trống !');
            return Redirect::to('product');
        }
    }


    //Infomation
    public function viewInfomation($id)
    {
        
        Session::forget("note__errC");
         Session::forget("note__err");
 
         $cate=loai::get();
          $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
        $data = DB::table('khachhang')->where('khMa',$id)->get();
       // dd($data);
        return view('Userpage.infomation')->with('data',$data)->with('cate',$cate)->with('total',$total);
    }
    public function editInfomation(Request $re, $id)
    {
        if($re->khTen ==null||$re->khTaikhoan == null||$re->khSdt==null||$re->khEmail==null||$re->khDiachi==null||$re->khNgaysinh==null||$re->khGioitinh==null)
        {
            $messages =[
                'khTen.required'=>'Tên khách hàng không được để trống',
                'khTaikhoan.required'=>'Tài khoản khách hàng không được để trống', 
                'khEmail.required'=>'Email khách hàng không được để trống',
                'khSdt.required'=>'Số điện thoại khách hàng không được để trống',
                'khDiachi.required'=>'Địa chỉ khách hàng không được để trống',
                'khNgaysinh.required'=>'Ngày sinh hàng không được để trống',
                'khGioitinh.required'=>'Giới tính khách hàng không được để trống',
            ];
            $this->validate($re,[
                'khTen'=>'required',
                'khTaikhoan'=>'required',
                'khEmail'=>'required',
                 'khSdt'=>'required',
                'khDiachi'=>'required', 
                'khNgaysinh'=>'required', 
                'khGioitinh'=>'required',
            ],$messages);
            $errors=$validate->errors();
        }
        else
        {
            if($re->hasFile('khHinh')==true)
            {
                $data = array();
                $data['khMa']=$id;
                $data['khTen']=$re->khTen;
                $data['khEmail']=$re->khEmail;
                $data['khNgaysinh']=$re->khNgaysinh;
                $data['khDiachi']=$re->khDiachi;
                $data['khGioitinh']=$re->khGioitinh;
                $data['khTaikhoan']=$re->khTaikhoan;
                $data['khSdt']=$re->khSdt;
                $data['khHinh'] = $re->file('khHinh')->getClientOriginalName();
                $imgextention=$re->file('khHinh')->extension();
                                $file=$re->file('khHinh');
                                $file->move('public/images/khachhang',$data['khHinh']);
                DB::table('khachhang')->where('khMa',$id)->update($data);
                Session::forget('khHinh');
                Session::put('khHinh', $data['khHinh']);
                return redirect('/infomation/'.$id);
            }
            else
            {
                $data = array();
                $data['khMa']=$id;
                $data['khTen']=$re->khTen;
                $data['khEmail']=$re->khEmail;
                $data['khNgaysinh']=$re->khNgaysinh;
                $data['khDiachi']=$re->khDiachi;
                $data['khGioitinh']=$re->khGioitinh;
                $data['khTaikhoan']=$re->khTaikhoan;
                 $data['khSdt']=$re->khSdt;
                DB::table('khachhang')->where('khMa',$id)->update($data);
                return redirect('/infomation/'.$id);
            }
        }
    }
    public function updatePass($id)
    {
         $cate=loai::get();
          $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
        $data = DB::table('khachhang')->where('khMa',$id)->get();
        return view('Userpage.updatePass')->with('data',$data)->with('cate',$cate)->with('total',$total);
    }
    public function editPass(Request $re ,$id)
    {
        $matkhaucu = md5($re->khPassCu);
        $khPass = DB::table('khachhang')->where("khMa",$id)->where('khMatkhau',$matkhaucu)->first();
        if(!$khPass)
        {
            Session::put("note__errC","Mật khẩu không đúng");
            Session::forget("note__err");
            return redirect('/updatePass/'.$id);
        }
        else
        {
        if($re->khPassCu ==null||$re->khRePassMoi == null||$re->khPassMoi==null)
        {
            Session::forget("note__errC");
            $messages =[
                'khPassCu.required'=>'Mật khẩu hiện tại không được để trống',
                'khRePassMoi.required'=>'Mật khậu nhập lại không được để trống', 
                'khPassMoi.required'=>'Mật khẩu mới không được để trống',   
            ];
            $this->validate($re,[
                'khPassCu'=>'required',
                'khRePassMoi'=>'required',
                'khPassMoi'=>'required',
                
            ],$messages);
            $errors=$validate->errors();
        }
        else
        {
               if($re->khRePassMoi != $re->khPassMoi)
               {
                Session::put("note__err","Mật khẩu nhập lại phải giống với mật khậu mới");
               Session::forget("note__errC");
                return redirect('/updatePass/'.$id);
               }
               else
               {
                Session::forget("note__errC");
                 Session::forget("note__err");
                   $data = array();
                   $data['khMatkhau'] = md5($re->khPassMoi);
                   DB::table('khachhang')->where('khMa',$id)->update($data);
                   return redirect('/infomation/'.$id);
                }
           }
        }
    }
    // Verify Email
    public function verifyemail($id)
    {
         $cate=loai::get();
          $cart=Cart::content();
        $total=0;
        $userEmail=DB::table('khachhang')->where('khMa',$id)->select('khEmail')->first();
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
        return view('Userpage.verify',compact('userEmail','cate','cart','total'));
    }
    public function sendcode()
    {

        $date=getdate();
          $details=''.rand(0,10).strlen(Session::get('khTaikhoan')).strlen(Session::get('khTen')).$date['hours'].$date['yday'].$date['year'];
          //dd($details);
          DB::table('khachhang')->where('khMa',Session::get('khMa'))->update(['khXtemail'=>$details]);
        Mail::to(Session::get('khEmail'))->send(new \App\Mail\verifyemail($details));
        return redirect()->back();
    }

    public function verifycode(Request $re)
    {
        $result=DB::table('khachhang')->where('khMa',Session::get('khMa'))->where('khXtemail',$re->code)->first();
        if($result)
        {
            DB::table('khachhang')->where('khMa',Session::get('khMa'))->update(['khXtemail'=>1]);
            Session::flash('verifySuccess','Email đã được xác thực !');
            return redirect()->back();
        }
        else
        {
            Session::flash('verifyFail','Mã xác thực sai !');
            return redirect()->back();
        }
    }

    public function changeEmail($id)
    {
        DB::table("khachhang")->where('khMa',$id)->update(['khXtemail'=>null]);
        return redirect()->back();
    }

    // ---------
    // -------------
    // 
    // list of order

    public function listorder()
    {
        $cate=loai::get();
        $cart=Cart::content();
        $total=0;
       foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
        $list=DB::table('donhang')->where('khMa',Session::get('khMa'))->get();

        //dd(count($list));
        if(count($list)==0)
        {
            return view('userpage.order',compact('list','cate','cart','total'));
        }
        else
        {
            foreach ($list as  $v) 
        {
            $data=DB::table('chitietdonhang')->join('donhang','donhang.hdMa','chitietdonhang.hdMa')->join('sanpham','chitietdonhang.spMa','sanpham.spMa')->join('hinh','hinh.spMa','sanpham.spMa')->where('khMa',$v->khMa)->orderBy('donhang.hdNgaytao','asc')->get();
    
            $details = array();
            foreach ($data as $key => $value) 
            {
                array_push($details, $value);
            }
        }
        return view('Userpage.order',compact('details','list','cate','cart','total'));
        }
        
    }   

    // ----------//
    public function huyDon($id)
    {
        $data= array();
        $data['hdTinhtrang']=3;

        DB::table('donhang')->where('hdMa',$id)->update($data);
        return redirect()->back();
    }
}

