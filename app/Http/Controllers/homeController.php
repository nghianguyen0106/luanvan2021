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
        $dbprorand = DB::table('hinh')->join('sanpham', 'hinh.spMa', '=', 'sanpham.spMa')->join('mota','mota.spMa','=','sanpham.spMa')->inRandomOrder()->first();

    	return view('Userpage.product',compact('db','dbprorand'));
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
        $db=DB::table('sanpham')->where('spMa',$re->id)->get();
        $hinh=DB::table('hinh')->where('spMa',$re->id)->get();
        $mota=DB::table('mota')->where('spMa',$re->id)->get();         
        return view('Userpage.productinfo',compact('db','hinh','mota'));
    }
}
