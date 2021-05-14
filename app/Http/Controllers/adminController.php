<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Session;
use Carbon\Carbon;
session_start();
class adminController extends Controller
{
    public function index()
    {
        if(Session::has('adTaikhoan'))
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            return view('admin.index')->with('noteDonhang',$noteDonhang)->with('noteDonhang',$noteDonhang);
        }
        else 
        { return Redirect('/adLogin'); }
    } 


    // ADMIN AND LOGIN
    public function adLoginView()
    {
        return view('admin.login');
    }
    public function checkLogin(Request $re)
    {
            $adTaikhoan = $re->account;
            $adMatkhau = $re->password;
            $result=DB::table('admin')->where('adTaikhoan',$adTaikhoan)->where('adMatkhau',$adMatkhau)->first();
            if($result)
            {
                Session::put('adTaikhoan',$adTaikhoan);
                Session::put('adTen',$result->adTen);
                Session::put('adHinh',$result->adHinh);
                Session::put('adQuyen',$result->adQuyen);
                Session::forget('error_login');
                $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
                return view('admin.index')->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang);
            }
            else
            {
                Session::put('error_login','Tên tài khoản hoặc mật khẩu không chính xác!');
                return view('admin.login');
            }
    }

    public function logout()
    {
        session::forget('adTaikhoan');
        Session::forget('error_login');
        Session::forget('adTen');
        Session::forget('adHinh');
        Session::forget('adQuyen');
        return view('admin.login');
    }


    //VIEW MANAGE
    public function viewNhanvien()
    {

        if(Session::has('adTaikhoan'))
        {
             $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $data = DB::table('admin')->get();
            return view('admin.nhanvien')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang);
        }
        else 
        {  return Redirect('/adLogin'); }
       
    }
      public function viewKhachhang()
    {
          if(Session::has('adTaikhoan'))
        {
             $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
             $data = DB::table('khachhang')->get();
        return view('admin.khachhang')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }
      public function viewSanpham()
    {
        if(Session::has('adTaikhoan'))
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $data=DB::table('sanpham')->join('loai','loai.loaiMa','=','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','=','sanpham.thMa')->join('nhucau','nhucau.ncMa','=','sanpham.ncMa')->get();
            
     
            return view('admin.sanpham')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }
     public function viewBinhluan()
     {
        if(Session::has('adTaikhoan'))
        {
            Session::forget('dgTrangthai');
             $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
             // $data = DB::table("sanpham")->leftjoin('danhgia','danhgia.spMa',"=","sanpham.spMa")->orderBy('dgTrangthai','desc')->get();
             $data = DB::table("danhgia")->leftjoin('sanpham','sanpham.spMa',"=","danhgia.spMa")->orderBy('dgTrangthai','desc')->get();
            return view('admin.binhluan')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang);
        }
        else
            { return Redirect('/adLogin'); }
     }
      public function viewKho()
    {
        if(Session::has('adTaikhoan'))
        {
             $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $data=DB::table('kho')->get();
            return view('admin.kho')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }

    public function viewLoai()
    {
         if(Session::has('adTaikhoan'))
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
              $data = DB::table('loai')->get();
             return view('admin.loai')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang);
        }
        else 
        { return Redirect('/adLogin'); }
     
       
    }
      public function viewThuonghieu()
    {
         if(Session::has('adTaikhoan'))
        {
             $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
              $data = DB::table('thuonghieu')->get();
        return view('admin.thuonghieu')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }
      public function viewNhucau()
    {
        if(Session::has('adTaikhoan'))
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
             $data=DB::table('nhucau')->get();
        return view('admin.nhucau')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }
        public function viewKhuyenmai()
    {
         if(Session::has('adTaikhoan'))
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
             $data=DB::table('khuyenmai')->get();
            return view('admin.khuyenmai')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }

   public function viewBanner()
    {
         if(Session::has('adTaikhoan'))
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $data = DB::table('banner')->get();
            return view('admin.banner')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }
      public function viewLoiThemHinhSP()
    {
        return view('admin.loiThemHinhSP');
    }
    public function viewLoiXoa()
    {
        return view("admin.loiXoa");
    }
    public function viewHoadon()
    {
        if(Session::has('adTaikhoan'))
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $data1=DB::table('hoadon')
                            ->leftjoin('khachhang','khachhang.khMa','=','hoadon.khMa')
                            ->where('hdTinhtrang',0)->get();
            $data2=DB::table('hoadon')
                            ->leftjoin('khachhang','khachhang.khMa','=','hoadon.khMa')
                            ->leftjoin('admin','admin.adMa','=','hoadon.adMa')
                            ->where('hdTinhtrang',1)->get();
            $data3=DB::table('hoadon')
                            ->leftjoin('khachhang','khachhang.khMa','=','hoadon.khMa')
                            ->leftjoin('admin','admin.adMa','=','hoadon.adMa')
                            ->where('hdTinhtrang',2)->get();
        return view('admin.don-hang')->with('data1',$data1)->with('data2',$data2)->with('data3',$data3)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang);
        }
        else 
        { return Redirect('/adLogin'); }
    }
    public function viewBaocao()
    {
        if(Session::has('adTaikhoan'))
        {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $bcNgay = DB::table('hoadon')->distinct()->get('hdNgaytao');
        $data=DB::table('baocao')->get();
        return view('admin.bao-cao-ngay')->with('data',$data)->with('bcNgay',$bcNgay)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang);
        }
        else 
        { return Redirect('/adLogin'); }
    }

    //////////////////////////////Add Manage
    

    // Nhân viên
      public function themAdmin()
    {
        return view('admin.themnhanvien');
    }
    public function adCheckAddAdmin(Request $re)
    {

        if($re->adTen ==null||$re->adTaikhoan == null||$re->adMatkhau == null||$re->adSdt == null||$re->adEmail==null||$re->adQuyen==null)
        {
            $messages =[
                'adTen.required'=>'Tên nhân viên không được để trống',
                'adTaikhoan.required'=>'Tài khoản nhân viên không được để trống',
                'adMatkhau.required'=>'Mật khẩu nhân viên không được để trống',
                'adSdt.required'=>'Số điện thoại nhân viên không được để trống',
                'adEmail.required'=>'Email nhân viên không được để trống',
                'adQuyen.required'=>'Quyền chức vụ nhân viên không được để trống',
                
            ];
            $this->validate($re,[
                'adTen'=>'required',
                'adTaikhoan'=>'required',
                'adMatkhau'=>'required',
                'adSdt'=>'required',
                'adEmail'=>'required',
                'adQuyen'=>'required',
               
            ],$messages);

            $errors=$validate->errors();
        }
        else
         {
            $dataBefore1 = DB::table('admin')->where('adTaikhoan',$re->adTaikhoan)->first();
            $dataBefore2 = DB::table('admin')->where('adEmail',$re->adEmail)->first();
            $dataBefore3 = DB::table('admin')->where('adSdt',$re->adSdt)->first();
            if($dataBefore1)
            {
                Session::flash('taikhoan_err','Tài khoản đã tồn tại, vui lòng nhập tài khoản khác!');
               return Redirect('themnhanvien'); 
            }
            else if( $dataBefore2)
            {
                Session::flash('email_err','Email đã tồn tại, vui lòng nhập email khác!');
               return Redirect('themnhanvien'); 
            }
            else if( $dataBefore3)
            {
                Session::flash('sdt_err','Số điện thoại đã tồn tại, vui lòng nhập số khác!');
               return Redirect('themnhanvien'); 
            }
           else
           {
                if($re->hasFile('adHinh')==true)
                {
                    $data = array();
                    $data['adTen']=$re->adTen;
                    $data['adTaikhoan']=$re->adTaikhoan;
                    $data['adMatkhau']=$re->adMatkhau;
                    $data['adSdt']=$re->adSdt;
                    $data['adEmail']=$re->adEmail;
                    $data['adHinh'] = $re->file('adHinh')->getClientOriginalName();;
                    $imgextention=$re->file('adHinh')->extension();
                                $file=$re->file('adHinh');
                                $file->move('public/images/nhanvien',$data['adHinh']);
                    $data['adQuyen']=$re->adQuyen;
                    DB::table('admin')->insert($data);
                    Session::forget('ad_err');
                    return redirect('adNhanvien');
                    }
                    else
                    {
                    Session::flash("adHinh_err","Hình của nhân viên không được trống!");
                    return Redirect('themnhanvien');  
                    }
            }
        }
    }
 
    public function adDeleteAdmin($id)
    {
      
        DB::table('admin')->where('adMa',$id)->delete();
         return redirect('adNhanvien');
        
    }

     public function adUpdateAdmin($id)
    {
        $hadData = DB::table('admin')->where('adMa',$id)->get();
        return view('admin.suanhanvien')->with('adMaCu',$hadData);
    }
    public function editAdmin(Request $re, $id)
    {
       if($re->adTen ==null||$re->adTaikhoan == null||$re->adMatkhau == null||$re->adSdt == null||$re->adEmail==null||$re->adQuyen==null)
        {
            $messages =[
                'adTen.required'=>'Tên nhân viên không được để trống',
                'adTaikhoan.required'=>'Tài khoản nhân viên không được để trống',
                'adMatkhau.required'=>'Mật khẩu nhân viên không được để trống',
                'adSdt.required'=>'Số điện thoại nhân viên không được để trống',
                'adEmail.required'=>'Email nhân viên không được để trống',
                'adQuyen.required'=>'Quyền nhân viên không được để trống',
                
            ];
            $this->validate($re,[
                'adTen'=>'required',
                'adTaikhoan'=>'required',
                'adMatkhau'=>'required',
                'adSdt'=>'required',
                'adEmail'=>'required',
               
            ],$messages);

            $errors=$validate->errors();
        }
        else
        {

            if($re->hasFile('adHinh')==true)
            {
                $data = array();
                $data['adMa']=$id;
                $data['adTen']=$re->adTen;
                $data['adTaikhoan']=$re->adTaikhoan;
                $data['adMatkhau']=$re->adMatkhau;
                $data['adSdt']=$re->adSdt;
                $data['adEmail']=$re->adEmail;
                $data['adHinh'] = $re->file('adHinh')->getClientOriginalName();;
                $imgextention=$re->file('adHinh')->extension();
                            $file=$re->file('adHinh');
                            $file->move('public/images/nhanvien',$data['adHinh']);
                $data['adQuyen']=$re->adQuyen;
                DB::table('admin')->where('adMa',$id)->update($data);
                return redirect('adNhanvien');
            }
            else
            {
                $data = array();
                $data['adMa']=$id;
                $data['adTen']=$re->adTen;
                $data['adTaikhoan']=$re->adTaikhoan;
                $data['adMatkhau']=$re->adMatkhau;
                $data['adSdt']=$re->adSdt;
                $data['adEmail']=$re->adEmail;
                $data['adQuyen']=$re->adQuyen;
                DB::table('admin')->where('adMa',$id)->update($data);
                return redirect('adNhanvien');
            }
            
        }
    }

    // End Nhân viên
    //  Khach hàng
      public function themkhachhang()
    {
        return view('admin.themkhachhang');
    }
    public function adCheckAddKhachhang(Request $re)
    {
        if($re->khTen ==null||$re->khTaikhoan == null||$re->khMatkhau == null||$re->khEmail==null||$re->khDiachi==null||$re->khNgaysinh==null||$re->khGioitinh==null||$re->khQuyen==null)
        {
            $messages =[
                'khTen.required'=>'Tên khách hàng không được để trống',
                'khTaikhoan.required'=>'Tài khoản khách hàng không được để trống',
                'khMatkhau.required'=>'Mật khẩu khách hàng không được để trống',
                'khEmail.required'=>'Email khách hàng không được để trống',
                'khQuyen.required'=>'Quyền khách hàng không được để trống',
                'khDiachi.required'=>'Địa chỉ khách hàng không được để trống',
                'khNgaysinh.required'=>'Ngày sinh hàng không được để trống',
                'khGioitinh.required'=>'Giới tính khách hàng không được để trống',
            ];
            $this->validate($re,[
                'khTen'=>'required',
                'khTaikhoan'=>'required',
                'khMatkhau'=>'required',
                'khEmail'=>'required',
                'khDiachi'=>'required', 
                'khQuyen'=>'required',
                'khNgaysinh'=>'required', 
                'khGioitinh'=>'required',
            ],$messages);
            $errors=$validate->errors();
        }
        else
        {
                $dataBefore1 = DB::table('khachhang')->where('khTaikhoan',$re->khTaikhoan)->first();
                $dataBefore2 = DB::table('khachhang')->where('khEmail',$re->khEmail)->first();
                $dataBefore3 = DB::table('khachhang')->where('khSdt',$re->khSdt)->first();
                $yearNow = Carbon::now()->year;
                $yearKh = new Carbon($re->khNgaysinh);
                $yearKhNgaysinh = $yearKh->year;
                if($yearNow - $yearKhNgaysinh<=10)
                {
                   Session::flash('date_err','Khách hàng phải trên 10 tuổi');
                   return Redirect('themkhachhang'); 
                }
                if($dataBefore1)
                {
                    Session::flash('taikhoan_err','Tài khoản đã tồn tại, vui lòng nhập tài khoản khác!');
                   return Redirect('themkhachhang'); 
                }
                else if( $dataBefore2)
                {
                    Session::flash('email_err','Email đã tồn tại, vui lòng nhập email khác!');
                   return Redirect('themkhachhang'); 
                }
                else if( $dataBefore3)
                {
                    Session::flash('sdt_err','Số điện thoại đã tồn tại, vui lòng nhập số khác!');
                   return Redirect('themkhachhang'); 
                }
                if($re->hasFile('khHinh'))
                {
                    $data = array();
                    $data['khMa']=rand(0,100).strlen($re->khTen).strlen($re->khEmail);
                    $data['khTen']=$re->khTen;
                    $data['khEmail']=$re->khEmail;
                    $data['khMatkhau']=$re->khMatkhau;
                    $data['khNgaysinh']=$re->khNgaysinh;
                    $data['khDiachi']=$re->khDiachi;
                    $data['khGioitinh']=$re->khGioitinh;
                    $data['khQuyen']=$re->khQuyen;
                    $data['khTaikhoan']=$re->khTaikhoan;
                    $data['khToken']="";
                    $data['khSdt']=$re->khSdt;
                    $data['khHinh'] = $re->file('khHinh')->getClientOriginalName();;
                        $imgextention=$re->file('khHinh')->extension();
                                    $file=$re->file('khHinh');
                                    $file->move('public/images/khachhang',$data['khHinh']);
                    DB::table('khachhang')->insert($data);
                    Session::forget('kh_err');
                    return redirect('adKhachhang');
                }
                else
                {
                    $data = array();
                    $data['khMa']=rand(0,100).strlen($re->khTen).strlen($re->khEmail);
                    $data['khTen']=$re->khTen;
                    $data['khEmail']=$re->khEmail;
                    $data['khMatkhau']=$re->khMatkhau;
                    $data['khNgaysinh']=$re->khNgaysinh;
                    $data['khDiachi']=$re->khDiachi;
                    $data['khGioitinh']=$re->khGioitinh;
                    $data['khQuyen']=$re->khQuyen;
                    $data['khTaikhoan']=$re->khTaikhoan;
                    $data['khToken']="";
                    $data['khSdt']=$re->khSdt;
                    $data['khHinh'] = "";
                    DB::table('khachhang')->insert($data);
                    Session::forget('kh_err');
                    return redirect('adKhachhang');
                }
            
            
        }
        
    }
    public function adDeleteKhachhang($id)
    {
        DB::table('khachhang')->where('khMa',$id)->delete();
         return redirect('adKhachhang');
    }
     public function adUpdatekhachhang($id)
    {
        $hadData = DB::table('khachhang')->where('khMa',$id)->get();
        return view('admin.suakhachhang')->with('khMaCu',$hadData);
    }
    public function editkhachhang(Request $re, $id)
    {
         if($re->khTen ==null||$re->khTaikhoan == null||$re->khMatkhau == null||$re->khSdt == null||$re->khEmail==null||$re->khDiachi==null||$re->khNgaysinh==null||$re->khGioitinh==null||$re->khQuyen==null)
        {
            $messages =[
                'khTen.required'=>'Tên khách hàng không được để trống',
                'khTaikhoan.required'=>'Tài khoản khách hàng không được để trống',
                'khMatkhau.required'=>'Mật khẩu khách hàng không được để trống',
                'khSdt.required'=>'Sdt khách hàng không được để trống',
                'khEmail.required'=>'Email khách hàng không được để trống',
                'khQuyen.required'=>'Quyền khách hàng không được để trống',
                'khDiachi.required'=>'Địa chỉ khách hàng không được để trống',
                'khNgaysinh.required'=>'Ngày sinh hàng không được để trống',
                'khGioitinh.required'=>'Giới tính khách hàng không được để trống',
            ];
            $this->validate($re,[
                'khTen'=>'required',
                'khTaikhoan'=>'required',
                'khMatkhau'=>'required',
                'khSdt'=>'required',
                'khEmail'=>'required',
                'khDiachi'=>'required', 
                'khQuyen'=>'required',
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
                $data['khMatkhau']=$re->khMatkhau;
                $data['khNgaysinh']=$re->khNgaysinh;
                $data['khDiachi']=$re->khDiachi;
                $data['khGioitinh']=$re->khGioitinh;
                $data['khQuyen']=$re->khQuyen;
                $data['khTaikhoan']=$re->khTaikhoan;
                $data['khSdt']=$re->khSdt;
                $data['khHinh'] = $re->file('khHinh')->getClientOriginalName();;
                    $imgextention=$re->file('khHinh')->extension();
                                $file=$re->file('khHinh');
                                $file->move('public/images/khachhang',$data['khHinh']);
                DB::table('khachhang')->where('khMa',$id)->update($data);
                return redirect('adKhachhang');
            }
            else
            {
                $data = array();
                $data['khMa']=$id;
                $data['khTen']=$re->khTen;
                $data['khEmail']=$re->khEmail;
                $data['khMatkhau']=$re->khMatkhau;
                $data['khNgaysinh']=$re->khNgaysinh;
                $data['khDiachi']=$re->khDiachi;
                $data['khGioitinh']=$re->khGioitinh;
                $data['khQuyen']=$re->khQuyen;
                $data['khTaikhoan']=$re->khTaikhoan;
                $data['khSdt']=$re->khSdt;
                DB::table('khachhang')->where('khMa',$id)->update($data);
                return redirect('adKhachhang');
            }
           
        }
    }

    // End khách hàng
    
    // Sản phẩm
    public function themSanpham()
    {
        $kmMa=DB::table('khuyenmai')->select('kmMa','kmTrigia')->get();
        $loaiMa=DB::table('loai')->select('loaiMa','loaiTen')->get();
        $thMa=DB::table('thuonghieu')->select('thMa','thTen')->get();
        $ncMa=DB::table('nhucau')->select('ncMa','ncTen')->get();
        return view('admin.themsanpham')->with('kmMa',$kmMa)->with('loaiMa',$loaiMa)->with('thMa',$thMa)->with('ncMa',$ncMa);
    }
    public function adCheckAddSanpham(Request $re)
    {
         if($re->spTen ==null||$re->spGia==null)
        {
            Session::forget('sp_err');
            $messages =[
                'spTen.required'=>'Sản phẩm không được để trống',
                'spGia.required'=>'Giá không được để trống',
                'spHanbh.required'=>'Hạn bảo hành không được để trống',
                
                
            ];
            $this->validate($re,[
                'spTen'=>'required',
                'spHanbh'=>'required',
                'spGia'=>'required',
               
                
            ],$messages);
            $errors=$validate->errors();
        }
          else
        {
            if($re->hasFile('img')==true)
            {
                $dataBefore = DB::table('sanpham')->where('spTen',$re->spTen)->first();
                if( $dataBefore)
                {
                    Session::put('sp_err','Sản phẩm đã có sẵn trong dữ liệu!');
                     return redirect('/themsanpham');
                }
                else
                {
                $spMa = rand(0,100).strlen($re->spGia).strlen($re->spTen);
                $data = array();
                $data['spMa']=$spMa;
                $data['spTen']=$re->spTen;
                $data['spGia']=$re->spGia;
                $data['spHanbh']=$re->spHanbh;
                $data['spTinhtrang']=0;
                $data['kmMa']=$re->kmMa;
                $data['thMa']=$re->thMa;
                $data['loaiMa']=$re->loaiMa;
                $data['ncMa']=$re->ncMa;
                
                 DB::table('sanpham')->insert($data);
                if($re->loaiMa==1)
                {

                    $data2 = array();
                    $data2['spMa']= $spMa;
                    $data2['ram'] = $re->ram;
                    $data2['cpu'] = $re->cpu;
                    $data2['psu'] = "";
                    $data2['ocung'] = $re->ocung;
                    $data2['vga'] = "";
                    $data2['mainboard'] = "";
                    $data2['manhinh'] = $re->manhinh;
                    $data2['pin'] = $re->pin;
                    $data2['vocase'] = "";
                    $data2['tannhiet'] = $re->tannhiet;
                    $data2['loa'] =$re->loa;
                    $data2['mau']=$re->mau;
                    $data2['trongluong'] = $re->trongluong;
                    $data2['conggiaotiep'] = $re->conggiaotiep;
                    $data2['webcam'] = $re->webcam;
                    $data2['chuanlan'] = $re->chuanlan;
                    $data2['chuanwifi'] = $re->chuanwifi;
                    $data2['hedieuhanh'] = $re->hedieuhanh;
                    DB::table('mota')->insert($data2);
            }
               else
               {
                    $data2 = array();
                    $data2['spMa']= $spMa;
                    $data2['ram'] = $re->ram;
                    $data2['cpu'] = $re->cpu;
                    $data2['psu'] = $re->psu;
                    $data2['ocung'] = $re->ocung;
                    $data2['vga'] = $re->vga;
                    $data2['mainboard'] = $re->mainboard;
                    $data2['manhinh'] = "";
                    $data2['pin'] = "";
                    $data2['vocase'] = $re->case;
                    $data2['tannhiet'] = "";
                    $data2['loa'] ="";
                    $data2['mau']="";
                    $data2['trongluong'] = "";
                    $data2['conggiaotiep'] = "";
                    $data2['webcam'] = "";
                    $data2['chuanlan'] = "";
                    $data2['chuanwifi'] = "";
                    $data2['hedieuhanh'] = "";
                    DB::table('mota')->insert($data2);
                }
               
                //Anh 1
                $data3 = array();
                $data3['spMa']= $spMa;
                $data3['spHinh']=$re->file('img')->getClientOriginalName();
                        $imgextention=$re->file('img')->extension();
                        $file=$re->file('img');
                        $file->move('public/images/products',$data3['spHinh']);

                DB::table('hinh')->insert($data3);
               

                //Anh 2
                if($re->hasFile('img2')==true)
                {
                    $dataImg2 = array();
                    $dataImg2['spMa']= $spMa;
                    $dataImg2['spHinh']=$re->file('img2')->getClientOriginalName();
                            $imgextention=$re->file('img2')->extension();
                            $file=$re->file('img2');
                            $file->move('public/images/products',$dataImg2['spHinh']);

                    DB::table('hinh')->insert($dataImg2);
                }
                 //Anh 3
                if($re->hasFile('img3')==true)
                {
                    $dataImg3 = array();
                    $dataImg3['spMa']= $spMa;
                    $dataImg3['spHinh']=$re->file('img3')->getClientOriginalName();
                            $imgextention=$re->file('img3')->extension();
                            $file=$re->file('img3');
                            $file->move('public/images/products',$dataImg3['spHinh']);

                    DB::table('hinh')->insert($dataImg3);
                }
                 //Anh 4
                if($re->hasFile('img4')==true)
                {
                    $dataImg4 = array();
                    $dataImg4['spMa']= $spMa;
                    $dataImg4['spHinh']=$re->file('img4')->getClientOriginalName();
                            $imgextention=$re->file('img4')->extension();
                            $file=$re->file('img4');
                            $file->move('public/images/products',$dataImg4['spHinh']);
                    DB::table('hinh')->insert($dataImg4);
                }

                //END
                Session::forget('img_error');
                Session::forget('sp_err');
                return redirect('adSanpham');
                }
              }
            else
            {
                return redirect('/loiThemHinhSP');
            }
        }

    }
  
    public function adDeleteSanpham($id)
    {
        DB::table('sanpham')->where('spMa',$id)->delete();
         return redirect('adSanpham');
    }
    public function adUpdateSanpham($id)
    {
        $spMa=DB::table('sanpham')->where('spMa',$id)->first();
        $ncOld = DB::table('nhucau')->where('ncMa',$spMa->ncMa)->get();
        $kmOld = DB::table('khuyenmai')->where('kmMa',$spMa->kmMa)->get(); 
        $loaiOld = DB::table('loai')->where('loaiMa',$spMa->loaiMa)->get(); 
        $thOld = DB::table('thuonghieu')->where('thMa',$spMa->thMa)->get();
        //
        $kmMa=DB::table('khuyenmai')->get();
        $loaiMa=DB::table('loai')->get();
        $thMa=DB::table('thuonghieu')->get();
        $ncMa=DB::table('nhucau')->get();
        $mota=DB::table('mota')->where('spMa',$id)->get();
        $hinh=DB::table('hinh')->where('spMa',$id)->get();
        $kho=DB::table('kho')->where('spMa',$id)->get();
        $data = DB::table('sanpham')->where('spMa',$id)->get();
        return view('admin.suasanpham')->with('spMaCu',$data)->with('kmMa',$kmMa)->with('loaiMa',$loaiMa)->with('thMa',$thMa)->with('ncMa',$ncMa)->with('mota',$mota)->with('kho',$kho)->with('hinh',$hinh)->with('ncOld',$ncOld)->with('kmOld',$kmOld)->with('loaiOld',$loaiOld)->with('thOld',$thOld);
    }
   
    public function editSanpham(Request $re, $id)
    {
        if($re->spTen ==null||$re->spGia==null||$re->ram==null||$re->ocung==null)
        {
            $messages =[
               
                'spTen.required'=>'Sản phẩm không được để trống',
                'spGia.required'=>'Giá không được để trống',
                'spHanbh.required'=>'Hạn bảo hành không được để trống',
                'ram.required'=>'Ram không được để trống',
                'ocung.required'=>'Ổ cứng không được để trống',
                
            ];
            $this->validate($re,[
               
                'spTen'=>'required',
                'spHanbh'=>'required',
                'spGia'=>'required', 
                'ram'=>'required',
                'ocung'=>'required',
 
            ],$messages);
            $errors=$validate->errors();
            }
            else
            {
                $data = array();
                $data['spMa']=$re->spMa;
                $data['spTen']=$re->spTen;
                $data['spGia']=$re->spGia;
                $data['spHanbh']=$re->spHanbh;
                $data['kmMa']=$re->kmMa;
                $data['thMa']=$re->thMa;
                $data['loaiMa']=$re->loaiMa;
                $data['ncMa']=$re->ncMa;
                //
             
                //
                $data4 = array();
                $data4['spMa'] =$data['spMa'];
                $data4['khoSoluong'] = $re->khoSoluong;
                $data4['khoNgaynhap'] = now();
                DB::table('sanpham')->where('spMa',$id)->update($data);
                DB::table('mota')->where('spMa',$id)->update($data2);
                DB::table('kho')->where('spMa',$id)->update($data4);
                 return redirect('/updateSanpham/'.$re->spMa);
            }

        
    }

    public function addHinhSanpham(Request $re)
    {
       
        if($re->hasFile('img')==true)
        {
            $data = array();
            $data['spMa']=$re->spMa;
            $data['sphinh']=$re->file('img')->getClientOriginalName();
                $imgextention = $re->file('img')->extension();
                $file = $re->file('img');
                $file->move('public/images/products',$data['sphinh']);
                 DB::table('hinh')->insert($data);
                Session::forget('img_err','Chưa chọn ảnh!');
                return redirect('/updateSanpham/'.$re->spMa);
        }
        else
        {
        Session::put('img_err','Chưa chọn ảnh!');
        return redirect('/updateSanpham/'.$re->spMa);

        }
    }
    public function deleteHinhSanpham($tenhinh,$id)
    {
        
        DB::table('hinh')->where('spHinh',$tenhinh)->delete();
        return redirect('/updateSanpham/'.$id);

    }
    //End sản phẩm
    //Kho 
    public function updateKho($id)
    {
          $hadData = DB::table('kho')->where('spMa',$id)->get();
        return view('admin.suakho')->with('dataKho',$hadData);
    }
    public function editKho(Request $re,$id)
    {
           if($re->khoSoluong == null)
        {
            $messages =[
                'khoSoluong.required'=>'Số lượng sản phẩm không được để trống',
            ];
            $this->validate($re,[
                'khoSoluong'=>'required',
            ],$messages);

            $errors=$validate->errors();
        }
        else
        {
            if($re->khoSoluong<0)
            {
               Session::flash("khoSL_err","Số lượng sản phẩm trong kho không được ít hơn 0");
                return redirect('updateKho/'.$id);  
            }
            else
            {
                $data = array();
                $data['spMa'] = $id;
                $data['khoSoluong']=$re->khoSoluong;
                $data['khoNgaynhap']=now();
                DB::table('kho')->where('spMa',$id)->update($data);
                return redirect('adKho');
            }
        }
    }



    //End kho
    //Loai
    public function adCheckAddLoai(Request $re)
    {
        if($re->loaiTen == null)
        {
            Session::forget('loai_err');
            $messages =[
                'loaiTen.required'=>'Tên loại không được để trống',
            ];
            $this->validate($re,[
                'loaiTen'=>'required',
            ],$messages);

            $errors=$validate->errors();
        }
        else
        {
             $dataBefore=DB::table('loai')->where('loaiTen',$re->loaiTen)->first();
            if($dataBefore)
            {
                Session::put('loai_err',"Loại đã tồn tại!");
                return redirect('/themloai');
            }
            else
            {
                $data = array();
                $data['loaiTen']=$re->loaiTen;
                DB::table('loai')->insert($data);
                 Session::forget('loai_err');
                return redirect('adLoai');
            }
        }
    }
    public function adDeleteLoai($id)
    {
        $id_sp = DB::table('sanpham')->where('loaiMa',$id)->get();
       if($id_sp)
       {
        Session::put('loai_del','loai k dc xoa');
        return redirect('loiXoa');
       }
       else
       {
        DB::table('loai')->where('loaiMa',$id)->delete();
        return redirect('adLoai');
       }
    }
     public function adUpdateLoai($id)
    {
        $hadData = DB::table('loai')->where('loaiMa',$id)->get();
        return view('admin.sualoai')->with('loaiMaCu',$hadData);
    }
    public function editLoai(Request $re, $id)
    {
         if($re->loaiTen == null)
        {
           
            $messages =[
                'loaiTen.required'=>'Tên loại không được để trống',
            ];
            $this->validate($re,[
                'loaiTen'=>'required',
            ],$messages);

            $errors=$validate->errors();
        }
        else
        {
                $data = array();
                $data['loaiTen'] = $re->loaiTen;
                DB::table('loai')->where('loaiMa',$id)->update($data);
                

                return redirect('adLoai');
            
        }
    }
    //End Loai
    
    //Nhu cau
  
    public function adCheckAddNhucau(Request $re)
    {
       if($re->ncTen == null)
        {
             Session::forget('nc_err');
            $messages =[
                'ncTen.required'=>'Nhu cầu không được để trống',
            ];
            $this->validate($re,[
                'ncTen'=>'required',
            ],$messages);

            $errors=$validate->errors();
        }
        else
        {
              $dataBefore=DB::table('nhucau')->where('ncTen',$re->ncTen)->first();
            if($dataBefore)
            {
                Session::put('nc_err',"Nhu cầu đã tồn tại!");
                return redirect('/themnhucau');
            }
            else
            {
            $data = array();
            $data['ncTen']=$re->ncTen;
            DB::table('nhucau')->insert($data);
            return redirect('adNhucau');
            }
        }
    }
    public function adDeleteNhucau($id)
    {
       $id_sp = DB::table('sanpham')->where('ncMa',$id)->get();
       if($id_sp)
       {
        Session::put('nc_del','nhu cau k dc xoa');
         return redirect('loiXoa');
       }
       else
       {
        DB::table('nhucau')->where('ncMa',$id)->delete();
        return redirect('adNhucau');
       }
       
    }
    public function adUpdateNhucau($id)
    {
        $hadData = DB::table('nhucau')->where('ncMa',$id)->get();
        return view('admin.suanhucau')->with('ncMaCu',$hadData);
    }
    public function editNhucau(Request $re, $id)
    {
         if($re->ncTen == null)
        {
            $messages =[
                'ncTen.required'=>'Nhu cầu không được để trống',
            ];
            $this->validate($re,[
                'ncTen'=>'required',
            ],$messages);

            $errors=$validate->errors();
        }
        else
        {
           $data = array();
           $data['ncTen'] = $re->ncTen;
            DB::table('nhucau')->where('ncMa',$id)->update($data);
             return redirect('adNhucau');
        }
    }
    //End nhu cau
    

    //Thương hiệu
   
    public function adCheckAddThuonghieu(Request $re)
    {
        if($re->thTen == null)
        {
            Session::forget('th_err');
            $messages =[
                'thTen.required'=>'Tên loại không được để trống',
            ];
            $this->validate($re,[
                'thTen'=>'required',
            ],$messages);

            $errors=$validate->errors();

        }
        else
        {
             $dataBefore=DB::table('thuonghieu')->where('thTen',$re->thTen)->first();
            if($dataBefore)
            {
                Session::put('th_err',"Thương hiệu đã tồn tại!");
                return redirect('/themthuonghieu');
            }
            else
            {
                $data = array();
                $data['thTen']=$re->thTen;
                DB::table('thuonghieu')->insert($data);
                  Session::forget('th_err');
                return redirect('adThuonghieu');
            }
        }
    }
    public function adDeleteThuonghieu($id)
    {
         $id_sp = DB::table('sanpham')->where('thMa',$id)->get();
       if($id_sp)
       {
        Session::put('th_del','thuong hieu k dc xoa');
          return redirect('loiXoa');
       }
       else
       {
        DB::table('thuonghieu')->where('thMa',$id)->delete();
        return redirect('adThuonghieu');
       }
    }
     public function adUpdateThuonghieu($id)
    {
        $hadData = DB::table('thuonghieu')->where('thMa',$id)->get();
        return view('admin.suathuonghieu')->with('thMaCu',$hadData);
    }
    public function editThuonghieu(Request $re, $id)
    {
         if($re->thTen == null)
        {
            $messages =[
                'thTen.required'=>'Tên loại không được để trống',
            ];
            $this->validate($re,[
                'thTen'=>'required',
            ],$messages);

            $errors=$validate->errors();
        }
        else
        {
            $data = array();
            $data['thTen'] = $re->thTen;
            DB::table('thuonghieu')->where('thMa',$id)->update($data);
            return redirect('adThuonghieu');
        }
    }
    //end thương hiệu
  

  //Banner
 
  public function adCheckAddBanner(Request $re)
  {
    if($re->hasFile('bnHinh')==true)
    {
        $data = array();
        $re->bnMa = rand(0,100).strlen($re->file('bnHinh')).strlen(rand(0,1000));
        $data['bnMa']= $re->bnMa;
        $data['bnHinh'] = $re->file('bnHinh')->getClientOriginalName();
            $imgextention = $re->file('bnHinh')->extension();
            $file = $re->file('bnHinh');
            $file->move('public/images/banners',$data['bnHinh']);

        DB::table('banner')->insert($data);
        Session::forget('bnError');
        return redirect('adBanner');
    }
    else
    {
        Session::put('bnError',"Vui lòng thêm hình vào banner");
        return redirect('themBanner');
    }
  }
  public function adDeleteBanner($id)
  {
    DB::table('banner')->where('bnMa',$id)->delete();
   
    return redirect('adBanner');
  }
  public function adUpdateBanner($id)
  {
    $data =DB::table('banner')->get();
    return view('admin.suabanner')->with('bnMaCu',$data);
  }
  public function editBanner(Request $re, $id)
  {
    if($re->hasFile('bnHinh')==true)
    {
        $data = array();
        $data['bnMa'] = $id;
        $data['bnHinh'] = $re->file('bnHinh')->getClientOriginalName();
            $imgextention =$re->file('bnHinh')->extension();
            $file=$re->file('bnHinh');
            $file->move('public/images/banners',$data['bnHinh']);
        DB::table('banner')->where('bnMa',$id)->update($data);
        return redirect('adBanner');
    }
  }
   //endbanner

  //Khuyến mãi
  public function adCheckAddKhuyenmai(Request $re)
  {
      if($re->kmTrigia == null)
        {
            Session::forget('th_err');
            $messages =[
                'kmTrigia.required'=>'giá trị khuyến mãi không được để trống',
            ];
            $this->validate($re,[
                'kmTrigia'=>'required',
            ],$messages);

            $errors=$validate->errors();

        }
        else
        {
                $data = array();
                $data['kmTrigia']=$re->kmTrigia;
                $data['kmMota']=null;
                $data['kmNgaybd']=null;
                $data['kmNgaykt']=null;
                DB::table('khuyenmai')->insert($data);
                return redirect('adKhuyenmai');
        }
    }
      public function adDeleteKhuyenmai($id)
      {
        DB::table('khuyenmai')->where('kmMa',$id)->delete();
       
        return redirect('adKhuyenmai');
      }
//end khuyến mãi  

  //Bình luận đánh giá
  public function viewBLSP($id)
  {
     $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
    $dg = DB::table('danhgia')->leftjoin('khachhang','khachhang.khMa','=','danhgia.khMa')->where('spMa',$id)->orderBy('dgTrangthai','desc')->get();
    return view('admin.binhluansanpham')->with('dg',$dg);
  }
  public function chitietBLSP($id)
  {
     Session::forget('dgTrangthai');
     $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
     $dg = DB::table('danhgia')->where('dgMa',$id)->join('khachhang','khachhang.khMa','=','danhgia.khMa')->get();
     $data = array();
     $data['dgTrangthai']=0;
     DB::table('danhgia')->where('dgMa',$id)->update($data);
    return view('admin.chitietbinhluan')->with('dg',$dg)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang);
  }
  //Hóa đơn
  public function themNVgiao($id)
  {
    $dataNV = DB::table('admin')->where('adQuyen',2)->get();
    $data = DB::table('hoadon')->where('hdMa',$id)->get();
    return view('admin.them-nv-giao-hang')->with('dataNV',$dataNV)->with('data',$data);
  }
  public function giaohang(Request $re,$id)
  {
    $data = array();
    $data["hdTinhtrang"]=1;
    $data["adMa"]=$re->hdNhanvien;
    DB::table('hoadon')->where('hdMa',$id)->update($data);
    return redirect('don-hang');
  }
  public function thanhtoan($id)
  {
    $data = array();
    $data["hdTinhtrang"]=2;
    DB::table('hoadon')->where('hdMa',$id)->update($data);
    return redirect('don-hang');
  }
  public function updateBaocao(Request $re)
  {
    if($re->dateStart > $re->dateEnd)
    {
        Session::flash("date_err","Ngày bắt đầu không được lớn hơn ngày kết thúc");
         return Redirect('bao-cao-ngay');  
    }
    else if($re->dateStart==null || $re->dateEnd==null)
    {
        Session::flash("date_err","Ngày bắt đầu và ngày kết thúc không được trống");
         return Redirect('bao-cao-ngay');  
    }
    else
    {
        $data = array();
        $bcSoluong=DB::table('hoadon')
                ->where('hdNgaytao',">=",$re->dateStart)
                ->where('hdNgaytao',"<=",$re->dateEnd)
                ->where('hdTinhtrang',1)
                ->sum("hdSoluongsp");
        
        $data["bcTonghangxuat"] = $bcSoluong;
        $bcTonghangnhap=DB::table('kho')->select('khoSoluong')->where('khoNgaynhap',$re->bcNgay)->sum('khoSoluong');
        $data["bcTonghangnhap"] =$bcTonghangnhap;
        $bcTongtien=DB::table('hoadon')
                ->where('hdNgaytao',">=",$re->dateStart)
                ->where('hdNgaytao',"<=",$re->dateEnd)
                ->where('hdTinhtrang',2)
                ->sum("hdTongtien");
        $data['bcThu'] = $bcTongtien;
        $data["bcChi"] =0;
        $bcTonkho=DB::table('kho')->select('khoSoluong')->sum('khoSoluong');
        $data["bcTonkho"] =$bcTonkho;
        $data["bcNgayBD"]=$re->dateStart;
        $data["bcNgayKT"]=$re->dateEnd;
        $data["bcNgaylap"]=date(now());
        
        DB::table('baocao')->insert($data);
        return redirect('bao-cao-ngay');
        
    }
  }
  //báo cáo
  public function deleteBaocao($id)
  {
    DB::table('baocao')->where('bcMa',$id)->delete();
    return redirect('bao-cao-ngay');
  }
}



    