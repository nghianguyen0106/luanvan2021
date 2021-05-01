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
        $dblap=DB::table('sanpham')->join('hinh','hinh.spMa','=','sanpham.spMa')->where('sanpham.loaiMa',1)->limit(6)->get();
       $dbpc=DB::table('sanpham')->join('hinh','hinh.spMa','=','sanpham.spMa')->where('sanpham.loaiMa',2)->limit(6)->get();
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
        Session::forget('khEmail');
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
        $db = DB::table('sanpham')->leftjoin('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->get();
        $brand=thuonghieu::get();
        $cate=loai::get();
        $needs=nhucau::get();
        return view('Userpage.product',compact('db','brand','cate','needs','total'));
    }
   
    public function proinfo(Request $re)
    {
        $comment=DB::table('danhgia')->where('spMa',$re->id)->leftjoin('khachhang','danhgia.khMa','khachhang.khMa')->orderBy('dgNgay','asc')->get();
   
        $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
        $imgs=DB::table('hinh')->where('spMa',$re->id)->get();
        $cate=loai::get();
        $details=DB::table('mota')->where('spMa',$re->id)->get(); 
        $proinfo=DB::table('sanpham')->join('kho','kho.spMa','sanpham.spMa')->join('loai','loai.loaiMa','=','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','=','sanpham.thMa')->where('sanpham.spMa',$re->id)->get();
       $cateid='';
       $brandid='';
       $id='';
      //s dd($proinfo);
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
            elseif($re->brand!=null && $re->category!=null)
            {
                $db=DB::table('thuonghieu')->join('sanpham', 'thuonghieu.thMa', '=', 'sanpham.thMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->join('hinh', 'hinh.spMa', '=', 'sanpham.spMa')->whereIn('thuonghieu.thMa',$re->brand)->where('sanpham.spTen','like','%'.$re->proname.'%')->get();
                    return Redirect::to('product')->with('db',$db)->with('brand',$brand)->with('cate',$cate)->with('needs',$needs)->with('total',$total);  
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
    //----------------

// CART
    public function checkout()
    {   
        //Xóa thông báo lỗi đổi mật khẩu khi chuyển trang
        Session::forget("note__errC");
       Session::forget("note__err");
       //end
        $cate=loai::get();
        $cart=Cart::content();
        $total=0;
        foreach ($cart as  $i) 
        {
            $total+=$i->price*$i->qty;
        }
            
       return view('Userpage.checkout',compact('cate','cart','total'));
    }
    public function order()
    {
        //Xóa thông báo lỗi đổi mật khẩu khi chuyển trang
        Session::forget("note__errC");
       Session::forget("note__err");
       //end
        if(Cart::count()>0)
        {
            if(session::has('khTaikhoan'))
            {
                $cart=Cart::content();
                $cate=loai::get();
                $total=0;
                foreach ($cart as  $i) 
                {
                    $total+=$i->price*$i->qty;
                }


                return view('Userpage.confirmcheckout',compact('cate','cart','total'));
            }
            else
            {
                session::flash('loginmessage','Please login first !');
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
        return view('Userpage.infomation')->with('data',$data)->with('cate',$cate)->with('total',$total);
    }
    public function editInfomation(Request $re, $id)
    {
        if($re->khTen ==null||$re->khTaikhoan == null||$re->khEmail==null||$re->khDiachi==null||$re->khNgaysinh==null||$re->khGioitinh==null)
        {
            $messages =[
                'khTen.required'=>'Tên khách hàng không được để trống',
                'khTaikhoan.required'=>'Tài khoản khách hàng không được để trống', 
                'khEmail.required'=>'Email khách hàng không được để trống',
                'khDiachi.required'=>'Địa chỉ khách hàng không được để trống',
                'khNgaysinh.required'=>'Ngày sinh hàng không được để trống',
                'khGioitinh.required'=>'Giới tính khách hàng không được để trống',
            ];
            $this->validate($re,[
                'khTen'=>'required',
                'khTaikhoan'=>'required',
                'khEmail'=>'required',
                'khDiachi'=>'required', 
                'khNgaysinh'=>'required', 
                'khGioitinh'=>'required',
            ],$messages);
            $errors=$validate->errors();
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
                DB::table('khachhang')->where('khMa',$id)->update($data);
                return redirect('/infomation/'.$id);
            
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

}

