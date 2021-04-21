<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use Cart;
use App\Models\thuonghieu;
use App\Models\loai;
use App\Models\nhucau;
class homeController extends Controller
{

    public function welcome()
    {
        $dblap=DB::table('sanpham')->join('hinh','hinh.spMa','=','sanpham.spMa')->where('sanpham.loaiMa',2)->limit(9)->get();
       $dbpc=DB::table('sanpham')->join('hinh','hinh.spMa','=','sanpham.spMa')->where('sanpham.loaiMa',3)->limit(9)->get();
      
    	return view('welcome',compact('dblap','dbpc'));
    }
   
    public function login()
    {
    	return view('Userpage.userlogin');
    }
    public function logout()
    {
        Session::forget('khTen');
        Session::forget('khMa');
        Session::forget('khTaikhoan');
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
        $db = DB::table('hinh')->join('sanpham', 'hinh.spMa', '=', 'sanpham.spMa')->get();
        $brand=thuonghieu::get();
        $cate=loai::get();
        $needs=nhucau::get();
        return view('Userpage.product',compact('db','brand','cate','needs','total'));
    }
   
    public function proinfo(Request $re)
    {
        $comment=DB::table('danhgia')->leftjoin('khachhang','danhgia.khMa','khachhang.khMa')->get();
   
         $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
        $imgs=DB::table('hinh')->where('spMa',$re->id)->get();
        $cate=loai::get();
        $details=DB::table('mota')->where('spMa',$re->id)->get(); 
        $proinfo=DB::table('sanpham')->join('loai','loai.loaiMa','=','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','=','sanpham.thMa')->where('sanpham.spMa',$re->id)->select('thuonghieu.thTen','thuonghieu.thMa','loai.loaiMa','sanpham.spTen','sanpham.spGia','sanpham.spTinhtrang','sanpham.spMa')->get();
        foreach ($proinfo as  $v) 
        {
            $cateid=$v->loaiMa;
            $brandid=$v->thMa;
            $id=$v->spMa;
        }

        $related_prod=DB::table('sanpham')->join('loai','loai.loaiMa','=','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','=','sanpham.thMa')->join('hinh','hinh.spMa','=','sanpham.spMa')->where('loai.loaiMa',$cateid)->where('thuonghieu.thMa',$brandid)->get();
        return view('Userpage.productinfo',compact('proinfo','imgs','details','related_prod','cate','total','id','comment'));
    }
     //---Find product
    public function findpro(Request $re)
    {
         $db = DB::table('hinh')->join('sanpham', 'hinh.spMa', '=', 'sanpham.spMa')->get();
        $brand=DB::table('thuonghieu')->get();
        $cate=loai::get();
        $needs=nhucau::get();
         $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
        if($re->proname!=null&&$re->priceFrom!=null&&$re->priceTo&&$re->brand!=null&&$re->category!=null&&$re->needs!=null)
        {
            $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->whereIn('sanpham.thMa',$re->brand)->where('sanpham.spTen','like','%'.$re->proname.'%')->get();   
          return view('Userpage.product',compact('db','brand','cate','needs','total'));
        }

        if($re->proname!=null)
        {
            $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spTen','like','%'.$re->proname.'%')->get();
            if($re->priceFrom!=null && $re->priceTo!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->where('sanpham.spTen','like','%'.$re->proname.'%')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->priceFrom!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spGia','>=',$re->priceFrom)->where('sanpham.spTen','like','%'.$re->proname.'%')->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total')); 
            }
            elseif($re->priceTo!=null)
            {
               $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spTen','like','%'.$re->proname.'%')->where('sanpham.spGia','<=',$re->priceTo)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->brand!=null)
            {
                $db=DB::table('thuonghieu')->join('sanpham', 'thuonghieu.thMa', '=', 'sanpham.thMa')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereIn('thuonghieu.thMa',$re->brand)->where('sanpham.spTen','like','%'.$re->proname.'%')->get();
                    return view('Userpage.product',compact('db','brand','cate','needs','total'));  
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
               

               return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
             elseif($re->needs!=null)
                {
                    $db=DB::table('nhucau')->join('sanpham','sanpham.ncMa','nhucau.ncMa')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereIn('sanpham.ncMa',$re->needs)->get();
           
                   return view('Userpage.product',compact('db','brand','cate','needs','total'));
                }
             return view('Userpage.product',compact('db','brand','cate','needs','total'));
        }
        if($re->proname==null)
        {
            if($re->priceFrom!=null && $re->priceTo!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereBetween('sanpham.spGia',[$re->priceFrom,$re->priceTo])->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->priceFrom!=null)
            {
                $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spGia','>=',$re->priceFrom)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total')); 
            }
            elseif($re->priceTo!=null)
            {
               $db=DB::table('sanpham')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->where('sanpham.spGia','<=',$re->priceTo)->get();
                return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->brand!=null)
            {
                $db=DB::table('thuonghieu')->join('sanpham', 'thuonghieu.thMa', '=', 'sanpham.thMa')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereIn('thuonghieu.thMa',$re->brand)->get();
                    return view('Userpage.product',compact('db','brand','cate','needs','total'));  
            }
            elseif($re->category!=null)
            {
                $db=DB::table('loai')->join('sanpham','sanpham.loaiMa','loai.loaiMa')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereIn('loai.loaiMa',$re->category)->get();
              
               return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
            elseif($re->needs!=null)
            {
                $db=DB::table('nhucau')->join('sanpham','sanpham.ncMa','nhucau.ncMa')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereIn('sanpham.ncMa',$re->needs)->get();
       
               return view('Userpage.product',compact('db','brand','cate','needs','total'));
            }
           return Redirect::to('product');
        }
         return Redirect::to('product');
    }
    public function addcomment(Request $re)
    {
            $this->validate($re,[
                'content'=>'required'],[
                'content.required'=>'Nội dung không được để trống']);
            $date=getdate();
            $data['dgMa']=''.strlen($re->content).$date['yday'].rand(0,100).substr($re->id,0,3);
            $data['spMa']=$re->id;
            $data['dgNoidung']=$re->content;
            $data['khMa']=Session::get('khMa');
            $data['dgNgay']=date('Y/m/d');
            DB::table('danhgia')->insert($data);
            return redirect()->back();
        }
    //----------------

// CART
    public function checkout()
    {   
       
        $cate=loai::get();
        $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
            
       return view('Userpage.checkout',compact('cate','cart','total'));
    }

}
