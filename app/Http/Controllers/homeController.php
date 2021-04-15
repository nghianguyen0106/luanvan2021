<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
class homeController extends Controller
{

    public function welcome()
    {
    	return view('welcome');
    }
    public function product()
    {
        $db = DB::table('hinh')->join('sanpham', 'hinh.spMa', '=', 'sanpham.spMa')->get();
       

    	return view('Userpage.product',compact('db',));
    }
     public function checkout()
    {
    	return view('Userpage.checkout');
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
}
