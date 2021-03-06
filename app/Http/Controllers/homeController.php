<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
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
use App\Models\slide;
use App\Models\wishlist;
use App\Models\donhang;
use App\Models\voucher;
//

class homeController extends Controller
{
    public function welcome()
    {
        $db=sanpham::join('hinh','hinh.spMa','=','sanpham.spMa')
                ->where('hinh.thutu','=','1')
                ->inRandomOrder()
                ->get();
        $dblap=sanpham::join('hinh','hinh.spMa','=','sanpham.spMa')
                ->where('sanpham.loaiMa',1)
                ->where('hinh.thutu','=','1')
                ->limit(8)->get();
        $dbpc=sanpham::join('hinh','hinh.spMa','=','sanpham.spMa')
                ->where('sanpham.loaiMa',2)
                ->where('hinh.thutu','=','1')
                ->limit(8)->get();
       
        return view('welcome',compact('db','dblap','dbpc'));
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
        // Auth::guard('khachhang')->logout();
        return view('Userpage.userlogin');
    }
    public function logout()
    {
        Auth::guard('khachhang')->logout();
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
        if(Session::has('khMa'))
        {
            $kh= khachhang::where('khMa',Session::get('khMa'))->first();
            if ($kh->khDiachi==null || $kh->khSdt ==null)
            {
                Session::flash('success',' Vui l??ng ??i???n th??ng tin c???a b???n ????? ph???c v??? cho vi???c giao h??ng !');
                return Redirect::to('infomation/'.Session::get('khMa'));
            }
        }
        $brand=thuonghieu::all();
        $cate=loai::all();
        $needs=nhucau::all();
        $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
        
        //slide
        $slide = slide::where('bnVitri',0)->orderBy('bnNgay','desc')->limit(3)->get();
        $countSlide =slide::where('bnVitri',0)->orderBy('bnNgay','desc')->count();
        $bnCon = slide::where('bnVitri',1)->orderBy('bnNgay','desc')->limit(5)->get();
        $countBnCon1 = slide::where('bnVitri',1)->orderBy('bnNgay','desc')->count();
        $countBnCon2 = slide::where('bnVitri',1)->orderBy('bnNgay','desc')->count();
        
        if(Auth::guard('khachhang')->check())
        {
            $loadproduct=sanpham::leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->where('hinh.thutu','=','1')->get();
            $db=array();
            foreach($loadproduct as $i )
            {
                if($i->kmTinhtrang ==1 || $i->kmTinhtrang ==null)
                {
                    array_push($db,$i);
                }
             
            }
        }
        else
        {
            $db = sanpham::leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('hinh.thutu','=','1')->get();
        }
        //dd($db);
            
        //dd($cate);
        
        return view('Userpage.product',compact('db','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2','brand'));
    }
   
    public function proinfo(Request $re)
    {
        $comment=danhgia::where('spMa',$re->id)->leftjoin('khachhang','danhgia.khMa','khachhang.khMa')->orderBy('dgNgay','asc')->get();
        $countorderedProduct=khachhang::join('donhang','donhang.khMa','khachhang.khMa')->join('chitietdonhang','chitietdonhang.hdMa','donhang.hdMa')->where('chitietdonhang.spMa',$re->id)->where('donhang.khMa',Session::get('khMa'))->where('donhang.hdTinhtrang',2)->count();
        $usercomment=danhgia::where('khMa',Session::get('khMa'))->where('spMa',$re->id)->count();
            // dd($countorderedProduct,$usercomment);
        if($countorderedProduct > $usercomment)
        {
            $checkordered=khachhang::join('donhang','donhang.khMa','khachhang.khMa')->join('chitietdonhang','chitietdonhang.hdMa','donhang.hdMa')->where('chitietdonhang.spMa',$re->id)->where('donhang.khMa',Session::get('khMa'))->where('donhang.hdTinhtrang',2)->select('spMa')->first();
        }
        else
        {
            $checkordered=null;
        }
        $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i)
        {
            $total+=$i->price*$i->qty;
        }
        $cate=loai::all();

        $imgDefault=hinh::where('spMa',$re->id)->where("thutu",'=','1')->first('spHinh');
        $imgs=hinh::where('spMa',$re->id)->limit(3)->get();
        $details=mota::where('spMa',$re->id)->get(); 
        $proinfo=sanpham::join('kho','kho.spMa','sanpham.spMa')->join('loai','loai.loaiMa','=','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','=','sanpham.thMa')->where('sanpham.spMa',$re->id)->first();
        // dd($proinfo);
        //load promotion
        $today=now();
        $availPromo=sanpham::leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->where('khuyenmai.kmNgaybd','<=',$today)->where('khuyenmai.kmNgaykt','>=',$today)->where('sanpham.spMa',$re->id)->first();
     
        
      
        //dd($availPromo);
        return view('Userpage.productinfo',compact('proinfo','imgDefault','imgs','details','total','comment','checkordered','availPromo'));
    }
     //---Find product
    public function findpro(Request $re)
    {
        //X??a th??ng b??o l???i ?????i m???t kh???u khi chuy???n trang
    Session::forget("note__errC");
       Session::forget("note__err");
       //end
         $db = hinh::join('sanpham', 'hinh.spMa', '=', 'sanpham.spMa')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->where('hinh.thutu','=','1')->get();
        $brand=thuonghieu::get();
        $cate=loai::get();
        $needs=nhucau::get();
         $cart=Cart::content();
        $total=0;

        $slide = slide::where('bnVitri',0)->orderBy('bnNgay','desc')->limit(3)->get();
        $countSlide =slide::where('bnVitri',0)->orderBy('bnNgay','desc')->count();
        $bnCon = slide::where('bnVitri',1)->orderBy('bnNgay','desc')->limit(5)->get();
        $countBnCon1 = slide::where('bnVitri',1)->orderBy('bnNgay','desc')->limit(2)->count();
        $countBnCon2 = slide::where('bnVitri',1)->orderBy('bnNgay','desc')->limit(5)->count();


        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }

        if($re->priceFrom > $re->priceTo)
        {
            if($re->proname !=null && $re->brand!=null && $re->category !=null && $re->needs!=null)
            {   
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->category !=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->category !=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->category !=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null &&  $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null && $re->category !=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null&& $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->category !=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('sanpham.spTen','like','%'.$re->proname.'%')->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.thMa',$re->brand)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->category !=null )
            {

                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->needs !=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            else
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceTo,$re->priceFrom])->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            return Redirect::to('product');
        }
        elseif ($re->priceFrom<$re->priceTo) 
        {
            if($re->proname !=null && $re->brand!=null && $re->category !=null && $re->needs!=null)
            {   
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->category !=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->category !=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->category !=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null &&  $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null && $re->category !=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null&& $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->category !=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.thMa',$re->brand)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->category !=null )
            {
                //return $re->category;
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->needs !=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            else
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('hinh.thutu','=','1')->get();
                //dd($db);
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            return Redirect::to('product');
        }
        else
        {
            if($re->proname !=null && $re->brand!=null && $re->category !=null && $re->needs!=null)
            {   
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->category !=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->category !=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->category !=null && $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.loaiMa',$re->category)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null &&  $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.ncMa',$re->needs)->get();                
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null && $re->category !=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.thMa',$re->brand)->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null&& $re->needs!=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->category !=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->get();
                
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null && $re->brand!=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('sanpham.thMa',$re->brand)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif($re->proname !=null)
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->brand!=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.thMa',$re->brand)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->category !=null )
            {
                $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.loaiMa',$re->category)->where('hinh.thutu','=','1')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total','slide','bnCon','countSlide','countBnCon1','countBnCon2'));
            }
            elseif( $re->needs !=null )
            {
               $db=DB::table('sanpham')->leftjoin('wishlist','wishlist.spMa','sanpham.spMa')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->join('nhucau','nhucau.ncMa','sanpham.ncMa')->where('sanpham.spGia',$re->priceFrom)->whereIn('sanpham.ncMa',$re->needs)->where('hinh.thutu','=','1')->get();
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
                'content.required'=>'N???i dung kh??ng ???????c ????? tr???ng']);
            $date=getdate();
            $data['dgMa']=''.strlen($re->content).$date['yday'].rand(0,100).substr($re->id,0,2);
            $data['spMa']=$re->id;
            $data['dgNoidung']=$re->content;
            $data['khMa']=Session::get('khMa');
            $data['dgNgay']=now();
            $data['dgTrangthai']=1;
            DB::table('danhgia')->insert($data);
            session::flash('comment','???? ????ng b??nh lu???n !');
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
        //X??a th??ng b??o l???i ?????i m???t kh???u khi chuy???n trang
        Session::forget("note__errC");
       Session::forget("note__err");
       //end
       //
      
       if(Cart::count()==0)
       {
        Session::forget('vcMa');
       }
        $cate=loai::get();
        $cart=cart::content();
        $a=array();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
            array_push($a,$i->id);
        }   
        $today=date_create();
     
        $checkexistKhuyenmai=khuyenmai::join('sanpham','sanpham.kmMa','khuyenmai.kmMa')->where('kmNgaybd','<=',$today)->whereIn('sanpham.spMa',$a)->where('kmNgaykt','>=',$today)->where('kmTinhtrang','!=',99)->get();
        $use=array();
        $unuse=array();
        if(Auth::guard('khachhang')->check())
        {
            foreach($checkexistKhuyenmai as $i)
            {
                $checkordered=donhang::where('khMa',Auth::guard('khachhang')->user()->khMa)->where('kmMa',$i->kmMa)->count();
               //dd(Auth::guard('khachhang')->user()->khMa);
                if($i->kmGioihanmoikh!=null)
                {
                    if($i->kmGioihanmoikh > $checkordered)
                    {
                        array_push($use,$i);
                    }
                    else
                    {
                        array_push($unuse,$i);
                    }
                }
                else
                {
                    array_push($use,$i);
                }
            }
        }
        // dd($use,$unuse);
        Session::put('total',$total);
        return view('Userpage.checkout',compact('cate','cart','total','use','unuse'))->with('promotion',$checkexistKhuyenmai);
        }

    public function order(Request $re)
    {
         // dd(Auth::guard('khachhang')->check());
        if(Cart::count()>0)
        {
            if(Auth::guard('khachhang')->check())
            {
                $cart=Cart::content();
                $cate=loai::get();
                $leng=strlen($re->promo);
                $str=strpos($re->promo,",");
                $kmMa=substr($re->promo,0,$str);
                $spMa=substr($re->promo,$str+1,$leng);
                
                $promoInfo=khuyenmai::where('khuyenmai.kmMa',$kmMa)->join('sanpham','sanpham.kmMa','khuyenmai.kmMa')->first();
                    $pricePromo=0;
                    $total=0;
                    $proinfo=sanpham::where('spMa',$spMa)->first();
                // Apply promotion
                if($promoInfo)
                {
                    
                    foreach ($cart as  $i) 
                    {
                        if($i->id==$spMa)
                        {
                            if($promoInfo->kmGiatritoida!=null)
                            {
                                $discountPercent=$promoInfo->kmTrigia/100;

                                $pricePromo=($i->price*$i->qty*$discountPercent)*$i->qty;
                                if($pricePromo>$promoInfo->kmGiatritoida)
                                {
                                    $pricePromo=($promoInfo->kmGiatritoida)*$i->qty;
                                }
                            }
                            $total+=$i->price*$i->qty-$pricePromo;
                             
                        }
                        else
                        {
                            $total+=$i->price*$i->qty;
                        }
                    }

                }

                $priceVc=0;
                $discountPercent=0;
                
                // Apply voucher
                $vcInfo=voucher::where('vcMa',Session::get('vcMa'))->first();
                if($vcInfo)
                { 
                    if($vcInfo->vcLoai==0)//Theo san pham
                    {
                        $proinfo=sanpham::where('spMa',$vcInfo->spMa)->first();
                        foreach($cart as $i)
                        {
                            if($i->id==$vcInfo->spMa)
                            { 
                                $total+=$i->price*$i->qty;
                                // Giam theo gia
                                if($vcInfo->vcLoaigiamgia==0)
                                {
                                    $priceVc=$vcInfo->vcMucgiam;
                                }
                                //Giam theo %
                                if($vcInfo->vcLoaigiamgia==1)
                                {
                                    $discountPercent=$vcInfo->vcMucgiam/100;
                                    $priceVc=$i->price * $i->qty*$discountPercent;
                                    
                                    if($priceVc > $vcInfo->vcGiatritoida)
                                    {
                                        $priceVc=$vcInfo->vcGiatritoida*$i->qty;
                                    }
                                }
                            }
                            else
                            {
                                $total+=$i->price*$i->qty;
                            }
                        }//endforeach
                        //Giam theo gia
                        if($vcInfo->vcLoaigiamgia==0)
                        {
                            $total=$total-$priceVc;
                        }
                        //Giam theo %
                        if($vcInfo->vcLoaigiamgia==1)
                        {
                            
                            $total-=$priceVc;
                        }
                    }
                    elseif($vcInfo->vcLoai==1)// Theo don hang
                    {
                        foreach($cart as $i)
                        {
                            $total+=$i->price*$i->qty;
                            // Giam theo gia
                            if($vcInfo->vcLoaigiamgia==0)
                            {
                                $priceVc=$vcInfo->vcMucgiam;
                            }
                            //Giam theo %
                            if($vcInfo->vcLoaigiamgia==1)
                            {
                                $discountPercent=$vcInfo->vcMucgiam/100;
                            }  
                        }//end foreach
                        // Giam theo gia
                        if($vcInfo->vcLoaigiamgia==0)
                        {
                            $total=$total-$priceVc;
                        }
                        //Giam theo %
                        if($vcInfo->vcLoaigiamgia==1)
                        {
                            $priceVc=$total*$discountPercent;
                            if($priceVc > $vcInfo->vcGiatritoida)
                            {
                                $priceVc=$vcInfo->vcGiatritoida;
                            }
                            $total-=$priceVc;
                        }              
                    }
                    else
                    {
                        foreach($cart as $i)
                        {
                            $total+=$i->price*$i->qty;
                        }
                    }
                }
                
                
                //return  number_format($priceVc)." ". number_format($total);
                
                
                return view('Userpage.confirmcheckout',compact('vcInfo','priceVc','pricePromo','promoInfo','proinfo','cate','cart','total'));

            }
            else
            {
                session::flash('loginmessage','Vui l??ng ????ng nh???p tr?????c khi th???c hi???n ?????t h??ng!');
                return Redirect::to('login');
            }
        }
        else
        {   
             Session::flash('errCart','Gi??? h??ng tr???ng !');
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
      
        return view('Userpage.infomation')->with('data',$data)->with('cate',$cate)->with('total',$total);
    }
    public function editInfomation(Request $re, $id)
    {
        if($re->khTen ==null||$re->khTaikhoan == null||$re->khSdt==null||$re->khEmail==null||$re->khDiachi==null||$re->khNgaysinh==null||$re->khGioitinh==null)
        {
            $messages =[
                'khTen.required'=>'T??n kh??ch h??ng kh??ng ???????c ????? tr???ng',
                'khTaikhoan.required'=>'T??i kho???n kh??ch h??ng kh??ng ???????c ????? tr???ng', 
                'khEmail.required'=>'Email kh??ch h??ng kh??ng ???????c ????? tr???ng',
                'khSdt.required'=>'S??? ??i???n tho???i kh??ch h??ng kh??ng ???????c ????? tr???ng',
                'khDiachi.required'=>'?????a ch??? kh??ch h??ng kh??ng ???????c ????? tr???ng',
                'khNgaysinh.required'=>'Ng??y sinh h??ng kh??ng ???????c ????? tr???ng',
                'khGioitinh.required'=>'Gi???i t??nh kh??ch h??ng kh??ng ???????c ????? tr???ng',
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
            Session::put("note__errC","M???t kh???u kh??ng ????ng");
            Session::forget("note__err");
            return redirect('/updatePass/'.$id);
        }
        else
        {
        if($re->khPassCu ==null||$re->khRePassMoi == null||$re->khPassMoi==null)
        {
            Session::forget("note__errC");
            $messages =[
                'khPassCu.required'=>'M???t kh???u hi???n t???i kh??ng ???????c ????? tr???ng',
                'khRePassMoi.required'=>'M???t kh???u nh???p l???i kh??ng ???????c ????? tr???ng', 
                'khPassMoi.required'=>'M???t kh???u m???i kh??ng ???????c ????? tr???ng',   
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
                Session::put("note__err","M???t kh???u nh???p l???i ph???i gi???ng v???i m???t kh???u m???i");
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

    public function cancelinfo()
    {
        $kh=khachhang::where('khMa',Session::get('khMa'))->first();
        $kh->khDiachi="x";
        $kh->khSdt="x";
        $kh->update();
        Session::flash('loginmess','????ng nh???p th??nh c??ng !');
            Session::flash('name','Ch??o '.$kh->khTen.' !!!');
        return Redirect::to('product');
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
        if(Session::has('khMa'))
        {
            $date=getdate();
            $details=''.rand(0,10).strlen(Session::get('khTaikhoan')).strlen(Session::get('khTen')).$date['hours'].$date['yday'].$date['year'];
            //dd(Session::get('khEmail'));
            $kh=khachhang::where('khMa',Session::get('khMa'))->first();
            $kh->khXtemail=$details;
            $kh->update();
            Mail::to(Session::get('khEmail'))->send(new \App\Mail\verifyemail($details));
            return redirect()->back();
        }
        
    }

    public function verifycode(Request $re)
    {
        $result=DB::table('khachhang')->where('khMa',Session::get('khMa'))->where('khXtemail',$re->code)->first();
        if($result)
        {
            DB::table('khachhang')->where('khMa',Session::get('khMa'))->update(['khXtemail'=>1]);
            Session::flash('verifySuccess','Email ???? ???????c x??c th???c !');
            return redirect()->back();
        }
        else
        {
            Session::flash('verifyFail','M?? x??c th???c sai !');
            return redirect()->back();
        }
    }

    public function changeEmail($id)
    {
        $kh=khachhang::where('khMa',$id)->first();
        $kh->khXtemail=null;
        $kh->update();
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
            $details=DB::table('chitietdonhang')->join('donhang','donhang.hdMa','chitietdonhang.hdMa')->join('sanpham','chitietdonhang.spMa','sanpham.spMa')->join('hinh','hinh.spMa','sanpham.spMa')->where('khMa',$v->khMa)->orderBy('donhang.hdNgaytao','asc')->where('hinh.thutu',1)->get();
    
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


    // Wish List
    public function wishlist()
    {
        $getwishlist=wishlist::join('sanpham','sanpham.spMa','wishlist.spMa')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('kho','sanpham.spMa','kho.spMa')->join('thuonghieu','thuonghieu.thMa','sanpham.thMa')->get();
        $check=array();
        $wl=array();
        foreach ($getwishlist as  $i)
        {
           if(in_array($i->spMa,$check)==null)
           {
                array_push($check,$i->spMa);
                array_push($wl,$i);
           }
        }
        //dd($wl);
        return view('Userpage.wishlist',compact('wl'));
    }

    public function addtowishlist(Request $re)
    {
        $checkExistProduct=sanpham::join('wishlist','wishlist.spMa','sanpham.spMa')->where('sanpham.spMa',$re->id)->first();
        if(!$checkExistProduct)
        {
            $wl=new wishlist();
            $wl->spMa=$re->id;
            $wl->khMa=Session::get('khMa');   
            $wl->save(); 
            Session::flash('success','???? th??m v??o wishlist.');
            
        }
        else
        {
            $wl=wishlist::where('spMa',$checkExistProduct->spMa)->delete();
            Session::flash('success','???? x??a kh???i wishlist.');
        }
        return redirect()->back();
    }
    // 


    public function checkvoucher(Request $re)
    {
        if($re->vcMa==null)
        {
            Session::flash('err','M?? voucher kh??ng ???????c ????? tr???ng !');
            Session::forget('vcMa');
            return redirect()->back();
        }
        $checkExistVoucher=voucher::where('vcMa',$re->vcMa)->where('vcTinhtrang',1)->first();
        $countOrderusedVoucher=donhang::where('khMa',Session::get('khMa'))->where('vcMa',$re->vcMa)->count();
        //dd($re->total);
        if($checkExistVoucher)
        {
           if($countOrderusedVoucher!=0)
           {
                Session::flash('err','B???n ???? d??ng voucher n??y r???i!');
                return redirect()->back();
           } 
           else
           {    
                if($checkExistVoucher->vcLoai==0)
                {
                    $flag=0;
                    foreach(Cart::content() as $i)
                    {
                        if($checkExistVoucher->spMa== $i->id)
                        {
                            $flag+=1;
                        }
                    }
                    if($flag!=0)
                    {   
                        $proName=sanpham::find($checkExistVoucher->spMa);
                        Session::flash('success','???? ??p d???ng voucher cho s???n ph???m: '.$proName->spTen.' ');
                        Session::put('vcMa',$re->vcMa);
                        return redirect()->back();
                    }
                    else
                    {
                        Session::flash('err','Kh??ng th??? s??? d???ng voucher n??y v?? kh??ng c?? s???n ph???m ???????c ??p d???ng trong gi??? h??ng !');
                        return redirect()->back();
                    }
                    
                }
                elseif($checkExistVoucher->vcLoai==1)
                {
                    if($checkExistVoucher->vcDkapdung==0)
                    {
                        if($re->total<$checkExistVoucher->vcGtcandat)
                        {
                            Session::flash('err','T???ng gi?? tr??? ????n h??ng c???a b???n ph???i l???n h??n ' .number_format($checkExistVoucher->vcGtcandat)."?? m???i c?? th??? ??p d???ng voucher n??y !");
                             Session::forget('vcMa');
                            return redirect()->back();
                        }
                        else
                        {
                            Session::flash('success','???? ??p d???ng voucher cho ????n h??ng n??y !');
                            Session::put('vcMa',$re->vcMa);
                            return redirect()->back();
                        }
                    }
                    if($checkExistVoucher->vcDkapdung==1)
                    {
                        if(Cart::count()<$checkExistVoucher->vcGtcandat)
                        {
                            Session::flash('err','T???ng s??? s???n ph???m c???a b???n ph???i l???n h??n ' .number_format($checkExistVoucher->vcGtcandat)." m???i c?? th??? ??p d???ng voucher n??y !");
                             Session::forget('vcMa');
                            return redirect()->back();
                        }
                        else
                        {
                            Session::flash('success','???? ??p d???ng voucher cho ????n h??ng n??y !');
                            Session::put('vcMa',$re->vcMa);
                            return redirect()->back();
                        }
                    }
                    
                }
           }
        }
        else
        {
            Session::forget('vcMa');
            Session::flash('err','M?? voucher kh??ng h???p l??? !');
            return redirect()->back();
        }
    }
    
    //////////////////TIN T???C ////////////////////
    public function viewTintuc()
    {
        $data1 = DB::table('tintuc')->where('ttTinhtrang','0')->where('ttLoai','1')->orderBy('ttNgaydang','desc')->get();
        $data2 = DB::table('tintuc')->where('ttTinhtrang','0')->where('ttLoai','2')->orderBy('ttNgaydang','desc')->get();
     
        return view('Userpage.danh-sach-tin-tuc')->with('data1',$data1)->with('data2',$data2);
    }
     public function tintucInfo($id)
    {
       $data = DB::table('tintuc')->where('ttMa',$id)->get();
    $data2 = DB::table('tintuc')->where('ttTinhtrang','0')->where('ttLoai','2')->orderBy('ttNgaydang','desc')->get();
       $viewOld = DB::table('tintuc')->select('ttLuotxem')->where('ttMa',$id)->first();
       $changeView = array();
       $changeView['ttLuotxem']=$viewOld->ttLuotxem+1; 
       DB::table('tintuc')->where('ttMa',$id)->update($changeView);

       
        return view('Userpage.chi-tiet-tin-tuc')->with('data',$data)->with('data2',$data2);
    }
        
}

