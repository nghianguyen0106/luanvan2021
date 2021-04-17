<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use App\Models\thuonghieu;
use App\Models\loai;
class homeController extends Controller
{

    public function welcome()
    {
    	return view('welcome');
    }
   
    public function login()
    {
    	return view('Userpage.userlogin');
    }
    public function logout()
    {
        Session::forget('khTen');
        return view('Userpage.userlogin');
    }
// PRODUCT
     public function product()
    {
        $db = DB::table('hinh')->join('sanpham', 'hinh.spMa', '=', 'sanpham.spMa')->get();
        $brand=thuonghieu::get();
        $cate=loai::get();
        return view('Userpage.product',compact('db','brand','cate'));
    }
    //---Find product
    public function proinfo(Request $re)
    {
        $imgs=DB::table('hinh')->where('spMa',$re->id)->get();
        $details=DB::table('mota')->where('spMa',$re->id)->get(); 
        $proinfo=DB::table('sanpham')->join('loai','loai.loaiMa','=','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','=','sanpham.thMa')->where('sanpham.spMa',$re->id)->select('thuonghieu.thTen','thuonghieu.thMa','loai.loaiMa','sanpham.spTen','sanpham.spGia','sanpham.spTinhtrang','sanpham.spMa')->get();
        foreach ($proinfo as  $v) 
        {
            $cateid=$v->loaiMa;
            $brandid=$v->thMa;
        }

        $related_prod=DB::table('sanpham')->join('loai','loai.loaiMa','=','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','=','sanpham.thMa')->join('hinh','hinh.spMa','=','sanpham.spMa')->where('loai.loaiMa',$cateid)->where('thuonghieu.thMa',$brandid)->get();
        return view('Userpage.productinfo',compact('proinfo','imgs','details','related_prod'));
    }
    public function findpro(Request $re)
    {
         $db = DB::table('hinh')->join('sanpham', 'hinh.spMa', '=', 'sanpham.spMa')->get();
        $brand=DB::table('thuonghieu')->get();
        $cate=loai::get();

        if($re->proname!=null&&$re->priceFrom!=null&&$re->priceTo&&$re->brand!=null&&$re->category!=null)
        {
            $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.thMa',$re->brand)->where('sanpham.spTen','like','%'.$re->proname.'%')->get();   
           return view('Userpage.product',compact('db','brand','cate'));
        }

        if($re->proname!=null)
        {
            $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spTen','like','%'.$re->proname.'%')->get();
            if($re->priceFrom!=null && $re->priceTo!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->get();
                return view('Userpage.product',compact('db','brand','cate'));
            }
            elseif($re->priceFrom!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spGia','>=',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->get();
                return view('Userpage.product',compact('db','brand','cate')); 
            }
            elseif($re->priceTo!=null)
            {
               $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spTen','like','%'.$re->proname.'%')->where('sanpham.spGia','<=',$re->priceTo)->get();
                return view('Userpage.product',compact('db','brand','cate'));
            }
            elseif($re->brand!=null)
            {
                $db=DB::table('thuonghieu')->join('sanpham', 'thuonghieu.thMa', '=', 'sanpham.thMa')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereIn('thuonghieu.thMa',$re->brand)->where('sanpham.spTen','like','%'.$re->proname.'%')->get();
                    return view('Userpage.product',compact('db','brand','cate'));  
            }
            elseif($re->category!=null)
            {
                if(is_array($re->category))
                {
                     $db=DB::table('loai')->join('sanpham','sanpham.loaiMa','loai.loaiMa')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spTen','like','%'.$re->proname.'%')->whereIn('loai.loaiMa',$re->category)->get();
                }
                else
                {
                    $db=DB::table('loai')->join('sanpham','sanpham.loaiMa','loai.loaiMa')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spTen','like','%'.$re->proname.'%')->where('loai.loaiMa',$re->category)->get();
                }
               
              
               return view('Userpage.product',compact('db','brand','cate'));
            }
             return view('Userpage.product',compact('db','brand','cate'));
        }

        if($re->proname==null)
        {
            if($re->priceFrom!=null && $re->priceTo!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->get();
                return view('Userpage.product',compact('db','brand','cate'));
            }
            elseif($re->priceFrom!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spGia','>=',$re->priceFrom)->get();
                return view('Userpage.product',compact('db','brand','cate')); 
            }
            elseif($re->priceTo!=null)
            {
               $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spGia','<=',$re->priceTo)->get();
                return view('Userpage.product',compact('db','brand','cate'));
            }
            elseif($re->brand!=null)
            {
                $db=DB::table('thuonghieu')->join('sanpham', 'thuonghieu.thMa', '=', 'sanpham.thMa')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereIn('thuonghieu.thMa',$re->brand)->get();
                    return view('Userpage.product',compact('db','brand','cate'));  
            }
            elseif($re->category!=null)
            {
                $db=DB::table('loai')->join('sanpham','sanpham.loaiMa','loai.loaiMa')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereIn('loai.loaiMa',$re->category)->get();
              
               return view('Userpage.product',compact('db','brand','cate'));
            }
           return Redirect::to('product');
        }
         return Redirect::to('product');
    }
    //----------------

// CART
    public function checkout()
    {
        return view('Userpage.checkout');
    }

}
