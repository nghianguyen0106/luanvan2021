<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use Carbon\Carbon;

//Models
use App\Models\danhgia;
use App\Models\nhacungcap;
use App\Models\admin_log;
use App\Models\donhang;
use App\Models\khuyenmai;
use App\Models\sanpham;


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
 $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            return view('admin.index')->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
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
                Session::put('adMa',$result->adMa);
                Session::put('adTaikhoan',$adTaikhoan);
                Session::put('adTen',$result->adTen);
                Session::put('adHinh',$result->adHinh);
                Session::put('adQuyen',$result->adQuyen);
                Session::forget('error_login');
                $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
 $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
                return view('admin.index')->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
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
 $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $data = DB::table('admin')->get();
            return view('admin.nhanvien')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
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
 $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $data = DB::table('khachhang')->get();
        return view('admin.khachhang')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
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
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $data=DB::table('sanpham')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->leftjoin('loai','loai.loaiMa','=','sanpham.loaiMa')->leftjoin('thuonghieu','thuonghieu.thMa','=','sanpham.thMa')->join('nhucau','nhucau.ncMa','=','sanpham.ncMa')->leftjoin('nhacungcap','nhacungcap.nccMa','=','sanpham.nccMa')->get();
            //dd($data);
            
     
            return view('admin.sanpham')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
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
 $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
             // $data = DB::table("sanpham")->leftjoin('danhgia','danhgia.spMa',"=","sanpham.spMa")->orderBy('dgTrangthai','desc')->get();
             $data = DB::table("danhgia")->leftjoin('sanpham','sanpham.spMa',"=","danhgia.spMa")->orderBy('dgTrangthai','desc')->get();
            return view('admin.binhluan')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
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
 $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $data=DB::table('kho')->get();
            return view('admin.kho')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
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
 $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
              $data = DB::table('loai')->get();
             return view('admin.loai')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
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
 $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
              $data = DB::table('thuonghieu')->get();
        return view('admin.thuonghieu')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
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
 $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
             $data=DB::table('nhucau')->get();
        return view('admin.nhucau')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
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
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $data = DB::table('banner')->get();
            return view('admin.banner')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }
    public function viewLShoatdong()
    {
        if(Session::has('adTaikhoan'))
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $alNgaygio = DB::table('admin_log')->distinct()->get('alNgaygio');
            $data = DB::table('admin_log')->leftjoin('admin','admin.adMa','=','admin_log.adMa')->get();
            return view('admin.lich-su-hoat-dong')->with('data',$data)->with('ngaygio',$alNgaygio)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
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
    public function viewdonhang()
    {
        if(Session::has('adTaikhoan'))
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
           
            Session::put('hdTinhtrang1',$noteDonhang1);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $data1=DB::table('donhang')
                            ->leftjoin('khachhang','khachhang.khMa','=','donhang.khMa')
                            ->where('hdTinhtrang',0)->get();
            $data2=DB::table('donhang')
                            ->leftjoin('khachhang','khachhang.khMa','=','donhang.khMa')
                            ->leftjoin('admin','admin.adMa','=','donhang.adMa')
                            ->where('hdTinhtrang',1)->get();
            $data3=DB::table('donhang')
                            ->leftjoin('khachhang','khachhang.khMa','=','donhang.khMa')
                            ->leftjoin('admin','admin.adMa','=','donhang.adMa')
                            ->where('hdTinhtrang',2)->get();
            $data4=DB::table('donhang')
                            ->leftjoin('khachhang','khachhang.khMa','=','donhang.khMa')
                            ->leftjoin('admin','admin.adMa','=','donhang.adMa')
                            ->where('hdTinhtrang',3)->get();
        return view('admin.don-hang')->with('data1',$data1)->with('data2',$data2)->with('data3',$data3)->with('data4',$data4)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
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
         Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
        $bcNgay = DB::table('donhang')->distinct()->get('hdNgaytao');
        $data=DB::table('baocao')->get();
        return view('admin.bao-cao-ngay')->with('data',$data)->with('bcNgay',$bcNgay)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
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
                Session::flash('note_err','Tài khoản đã tồn tại, vui lòng nhập tài khoản khác!');
              // return Redirect('themnhanvien'); 
             return back()->withInput(Input::all());
            }
            else if( $dataBefore2)
            {
                Session::flash('note_err','Email đã tồn tại, vui lòng nhập email khác!');
               return Redirect('themnhanvien'); 
            }
            else if( $dataBefore3)
            {
                Session::flash('note_err','Số điện thoại đã tồn tại, vui lòng nhập số khác!');
               return Redirect('themnhanvien'); 
            }
           else
           {
                if($re->hasFile('adHinh')==true)
                {
                    $data = array();
                    $data['adMa']=rand(0,1000).strlen($re->adTen);
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

                    $data1 = array();
                    $data1['adMa'] = Session::get('adMa');
                    $data1['alChitiet'] = "Thêm nhân mới: ".$re->adTen;
                    $data1['alNgaygio']= now();
                    DB::table('admin_log')->insert($data1);

                    Session::forget('ad_err');
                    return redirect('adNhanvien');
                    }
                    else
                    {
                    Session::flash("note_err","Hình của nhân viên không được trống!");
                    return Redirect('themnhanvien');  
                    }
            }
        }
    }
 
    public function adDeleteAdmin($id)
    {
      $db = DB::table('admin')->where('adMa',$id)->get();
                $a = array($db);
                $adTen = str_replace('"','',json_encode($a[0][0]->adTen));
          $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Xóa nhân viên:".$adTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
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
                $db = DB::table('admin')->where('adMa',$id)->get();
                $a = array($db);
                $adTen = str_replace('"','',json_encode($a[0][0]->adTen));
                $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Cập nhật nhân viên:".$adTen."->".$re->adTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);

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
                $db = DB::table('admin')->where('adMa',$id)->get();
                $a = array($db);
                $adTen = str_replace('"','',json_encode($a[0][0]->adTen));
                $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Cập nhật nhân viên:".$adTen."->".$re->adTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);

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
                'khMatkhau.required'=>'Mật khẩu khách hàng khôg được để trống',
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
                   Session::flash('note_err','Khách hàng phải trên 10 tuổi');
                   return Redirect('themkhachhang'); 
                }
                if($dataBefore1)
                {
                    Session::flash('note_err','Tài khoản đã tồn tại, vui lòng nhập tài khoản khác!');
                   return Redirect('themkhachhang'); 
                }
                else if( $dataBefore2)
                {
                    Session::flash('note_err','Email đã tồn tại, vui lòng nhập email khác!');
                   return Redirect('themkhachhang'); 
                }
                else if( $dataBefore3)
                {
                    Session::flash('note_err','Số điện thoại đã tồn tại, vui lòng nhập số khác!');
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
        $kmMa=DB::table('khuyenmai')->get();
        $loaiMa=DB::table('loai')->select('loaiMa','loaiTen')->get();
        $thMa=DB::table('thuonghieu')->select('thMa','thTen')->get();
        $ncMa=DB::table('nhucau')->select('ncMa','ncTen')->get();
        $nccMa=DB::table('nhacungcap')->select('nccMa','nccTen')->get();

        return view('admin.themsanpham')->with('kmMa',$kmMa)->with('loaiMa',$loaiMa)->with('thMa',$thMa)->with('ncMa',$ncMa)->with('nccMa',$nccMa);
    }
    public function adCheckAddSanpham(Request $re)
    {
         if($re->spTen ==null||$re->spGia==null||$re->khoSoluong==null)
        {
            Session::forget('sp_err');
            $messages =[
                'spTen.required'=>'Sản phẩm không được để trống',
                'spGia.required'=>'Giá không được để trống',
                'spHanbh.required'=>'Hạn bảo hành không được để trống',
                'khoSoluong.required'=>'Số lượng sản phẩm không được để trống',
                
                
            ];
            $this->validate($re,[
                'spTen'=>'required',
                'spHanbh'=>'required',
                'spGia'=>'required',
                'khoSoluong'=>'required',
               
                
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
                $spMa = rand(0,100).strlen($re->spGia).strlen($re->spTen).rand(0,1000);
                $data = array();
                $data['spMa']=$spMa;
                $data['spTen']=$re->spTen;
                $data['spGia']=$re->spGia;
                $data['spHanbh']=$re->spHanbh;
                if($re->khoSoluong>0)
                {
                    $data['spTinhtrang']=1;
                }
                else
                {
                     $data['spTinhtrang']=0;
                } 
                $data['kmMa']=$re->kmMa;
                $data['thMa']=$re->thMa;
                $data['loaiMa']=$re->loaiMa;
                $data['ncMa']=$re->ncMa;
                
                $data['nccMa']=$re->nccMa;
                $data['kmMa']=$re->kmMa;
                
                DB::table('sanpham')->insert($data);

                $dataLog = array();
                $dataLog['adMa'] = Session::get('adMa');
                $dataLog['alChitiet'] = "Thêm sản phẩm mới:".$re->spTen;
                $dataLog['alNgaygio']= now();
                DB::table('admin_log')->insert($dataLog);

                 $data4 = array();
                 $data4['spMa']= $spMa;
                 $data4['khoSoluong']=$re->khoSoluong;
                 $data4['khoNgaynhap']=now();
                DB::table('kho')->insert($data4);

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
        $db = DB::table('sanpham')->where('spMa',$id)->get();
                $a = array($db);
                $spTen = str_replace('"','',json_encode($a[0][0]->spTen));
          $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Xóa sản phẩm: ".$spTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
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
        $nccOld = DB::table('nhacungcap')->where('nccMa',$spMa->nccMa)->get();
        //
        $kmMa=DB::table('khuyenmai')->get();
        $loaiMa=DB::table('loai')->get();
        $thMa=DB::table('thuonghieu')->get();
        $ncMa=DB::table('nhucau')->get();
        $nccMa=DB::table('nhacungcap')->get();
        $mota=DB::table('mota')->where('spMa',$id)->get();
        $hinh=DB::table('hinh')->where('spMa',$id)->get();
        $kho=DB::table('kho')->where('spMa',$id)->get();
        $data = DB::table('sanpham')->where('spMa',$id)->get();
        return view('admin.suasanpham')->with('spMaCu',$data)->with('kmMa',$kmMa)->with('loaiMa',$loaiMa)->with('thMa',$thMa)->with('ncMa',$ncMa)->with('mota',$mota)->with('kho',$kho)->with('hinh',$hinh)->with('ncOld',$ncOld)->with('kmOld',$kmOld)->with('loaiOld',$loaiOld)->with('thOld',$thOld)->with('nccOld',$nccOld)->with('nccMa',$nccMa);
    }
   
    public function editSanpham(Request $re, $id)
    {
        if($re->spTen ==null||$re->spGia==null||$re->ram==null||$re->ocung==null||$re->cpu==null)
        {
            $messages =[
               
                'spTen.required'=>'Sản phẩm không được để trống',
                'spGia.required'=>'Giá không được để trống',
                'spHanbh.required'=>'Hạn bảo hành không được để trống',
                'ram.required'=>'Ram không được để trống',
                'ocung.required'=>'Ổ cứng không được để trống',
                'cpu.required'=>'CPU không được để trống',
                
            ];
            $this->validate($re,[
               
                'spTen'=>'required',
                'spHanbh'=>'required',
                'spGia'=>'required', 
                'ram'=>'required',
                'ocung'=>'required',
                'cpu'=>'required',
            
 
            ],$messages);
            $errors=$validate->errors();
            }
            else
            {
                
                $dataLog = array();
                $dataLog['adMa'] = Session::get('adMa');
                $dataLog['alChitiet'] = "Cập nhật sản phẩm:".$re->spTen;
                $dataLog['alNgaygio']= now();
                DB::table('admin_log')->insert($dataLog);

                $data = array();
                $data['spMa']=$re->spMa;
                $data['spTen']=$re->spTen;
                $data['spGia']=$re->spGia;
                $data['spHanbh']=$re->spHanbh;
                $data['kmMa']=$re->kmMa;
                $data['thMa']=$re->thMa;
                $data['nccMa']=$re->nccMa;
                $data['loaiMa']=$re->loaiMa;
                $data['ncMa']=$re->ncMa;

                 DB::table('sanpham')->where('spMa',$id)->update($data);
                //
                  if($re->loaiMa==1)
                {

                    $data2 = array();
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
                    DB::table('mota')->where('spMa',$id)->update($data2);
            }
               else
               {
                    $data2 = array();
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
                    DB::table('mota')->where('spMa',$id)->update($data2);
                }
                
                
                 DB::table('mota')->where('spMa',$id)->update($data2);
                //
                $data4 = array();
                $data4['spMa'] =$data['spMa'];
                $data4['khoSoluong'] = $re->khoSoluong;
                $data4['khoNgaynhap'] = now();

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
    public function editKho(Request $re,$id)
    {
       
            if($re->khoSoluong<0)
            {
               Session::flash("note_err","Số lượng sản phẩm trong kho không được ít hơn 0");
                return redirect('updateKho/'.$id);  
            }
            else if($re->khoSoluong==null)
            {
               Session::flash("note_err","Số lượng sản phẩm trong kho không được rỗng");
                return redirect('adKho');  
            }
            else
            {
                $dbKho = DB::table('kho')->where('spMa',$id)->get();
                $dbSP = DB::table('sanpham')->where('spMa',$id)->get();
                $a = array($dbKho);
                $b = array($dbSP);
                $spTen = str_replace('"','',json_encode($b[0][0]->spTen));
                $khoSoluong = str_replace('"','',json_encode($a[0][0]->khoSoluong));
                    
                $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Cập nhật kho, sản phẩm có mã: ".$spTen." số lượng ".$khoSoluong."->".$re->khoSoluong;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);

                $data = array();
                $data['spMa'] = $id;
                $data['khoSoluong']=$re->khoSoluong;
                $data['khoNgaynhap']=now();
                DB::table('kho')->where('spMa',$id)->update($data);
                return redirect('adKho');
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

                $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Thêm loại mới:".$re->loaiTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);

                Session::forget('loai_err');
                return redirect('adLoai');
            }
        }
    }

    public function adDeleteLoai($id)
    {
        $db = DB::table('loai')->where('loaiMa',$id)->get();
                $a = array($db);
                $loaiTen = str_replace('"','',json_encode($a[0][0]->loaiTen));
          $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Xóa loại:".$loaiTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
       
        DB::table('loai')->where('loaiMa',$id)->delete();
        return redirect('adLoai');
    }
    public function editLoai(Request $re, $id)
    {  
        if($re->loaiTen==null)
        {
            Session::flash('note_err','Không được để rỗng!');
            return redirect('adLoai');
        }
        else
        {
                $db = DB::table('loai')->where('loaiMa',$id)->get();
                $a = array($db);
                $loaiTen = str_replace('"','',json_encode($a[0][0]->loaiTen));
                    
                $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Sửa loại:".$loaiTen."->".$re->loaiTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);

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

               $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Thêm nhu cầu mới:".$re->ncTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
            return redirect('adNhucau');
            }
        }
    }
    public function adDeleteNhucau($id)
    {
         $db = DB::table('nhucau')->where('ncMa',$id)->get();
                $a = array($db);
                $ncTen = str_replace('"','',json_encode($a[0][0]->ncTen));
          $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Xóa nhu cầu:".$ncTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
        DB::table('nhucau')->where('ncMa',$id)->delete();
        return redirect('adNhucau');

    }
    public function editNhucau(Request $re, $id)
    {
          if($re->ncTen==null)
        {
            Session::flash('note_err','Không được để rỗng!');
            return redirect('adnhucau');
        }
        else
        {
             $db = DB::table('nhucau')->where('ncMa',$id)->get();
                $a = array($db);
                $ncTen = str_replace('"','',json_encode($a[0][0]->ncTen));
                    
                $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Sửa nhu cầu:".$ncTen."->".$re->ncTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);

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

                $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Thêm thương hiệu mới:".$re->thTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
                return redirect('adThuonghieu');
            }
        }
    }
    public function adDeleteThuonghieu($id)
    {
         $db = DB::table('thuonghieu')->where('thMa',$id)->first();
         $a = array($db);
         $thTen = $db->thTen;
          $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Xóa thương hiệu:".$thTen;
                $data1['alNgaygio']= now();
                //dd($data1['alChitiet']);
                DB::table('admin_log')->insert($data1);
       DB::table('thuonghieu')->where('thMa',$id)->delete();
        return redirect('adThuonghieu');
       
    }
    public function editThuonghieu(Request $re, $id)
    {
          if($re->thTen==null)
        {
            Session::flash('note_err','Không được để rỗng!');
            return redirect('adThuonghieu');
        }
        else
        {
             $db = DB::table('thuonghieu')->where('thMa',$id)->get();
                $a = array($db);
                $thTen = str_replace('"','',json_encode($a[0][0]->thTen));
                    
                $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Sửa thương hiệu:".$thTen."->".$re->thTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);

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
    if($re->bnTieude==null||$re->bnVitri==null)
    {
            $messages =[
                'bnTieude.required'=>'Tiêu đề không được để trống',
                 'bnVitri.required'=>'Vị trí banner không được để trống',
            ];
            $this->validate($re,[
                'bnTieude'=>'required',
                 'bnVitri'=>'required',
            ],$messages);

            $errors=$validate->errors();
    }
    else
    {
        if($re->hasFile('bnHinh')==true)
        {
            $data = array();
            $re->bnMa = rand(0,100).strlen($re->file('bnHinh')).strlen(rand(0,1000));
            $data['bnMa']= $re->bnMa;
            $data['bnTieude']= $re->bnTieude;
            $data['bnHinh'] = $re->file('bnHinh')->getClientOriginalName();
                $imgextention = $re->file('bnHinh')->extension();
                $file = $re->file('bnHinh');
                $file->move('public/images/banners',$data['bnHinh']);
            $data['kmMa']=null;
            $data['bnVitri']= $re->bnVitri;
            $data['bnNgay']= now();
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
public function viewKhuyenmai()
    {
        if(Session::has('adTaikhoan'))
        {   
            $noteDanhgia = danhgia::where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = donhang::where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = donhang::where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
             $data=khuyenmai::all();

            return view('admin.khuyenmai')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }

public function addKhuyenmaiPage()
{
    if(Session::has('adTaikhoan'))
        {   
            $checksanpham=sanpham::join('nhacungcap','nhacungcap.nccMa','sanpham.nccMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->join('hinh','sanpham.spMa','hinh.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->get();
            $noteDanhgia = danhgia::where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = donhang::where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = donhang::where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $a=array();
            $sanpham=array();
            foreach($checksanpham as $i)
            {
              
                if(in_array($i->spMa, $a)==null)
                {
                    array_push($a, $i->spMa);
                    array_push($sanpham, $i);
                }
            }
            
            return view('admin.themkhuyenmai',compact('sanpham','noteDanhgia','noteDonhang','noteDonhang1'));
        }
        else
        {
            return Redirect('/adLogin');
        }
}

public function adCheckAddKhuyenmai(Request $re)
{
    //dd($re->checkboxsp);
    if($re->kmTrigia == null)
        {
            Session::forget('th_err');
            $messages =[
                'kmTen.required'=>'Tên không được để trống !',
                'kmTrigia.required'=>'Giá trị khuyến mãi không được để trống !',
                'kmMota.required'=>'Mô tả không được để trống !',
                'kmNgaybd.required'=>'Vui lòng nhập ngày bắt đầu khuyến mãi !',
                'kmNgaykt.required'=>'Vui lòng nhập ngày kết thúc khuyến mãi !',
                'checkboxsp.required'=>'Vui lòng chọn ít nhất 1 sản phẩm!'
            ];
            $this->validate($re,[
                'kmTen'=>'required',
                'kmTrigia'=>'required',
                'kmMota'=>'required',
                'kmNgaybd'=>'required',
                'kmNgaykt'=>'required',
                'checkboxsp'=>'required',
            ],$messages);
        }
        else
        {
            //create promotion
                $km=new khuyenmai();
                $checkExistKhuyenmai=khuyenmai::where('kmTen',$re->kmTen)->first();
                if($checkExistKhuyenmai)
                {
                    Session::flash('err','Khuyến mãi này đã tồn tại');
                    return redirect()->back();
                }
                $km->kmTen=$re->kmTen;
                if($re->kmTrigia<1)
                {
                    Session::flash('err',"Giá trị khuyến mãi phải lớn hơn 1 ");
                    return redirect()->back();
                }
                elseif($re->kmTrigia>100)
                {
                    Session::flash('err',"Giá trị khuyến mãi phải nhỏ hơn 100 !");
                    return redirect()->back();
                }
                $km->kmTrigia=$re->kmTrigia;
                $km->kmMota=$re->kmMota;
                $today=date_create();
                
                if( $today < date_create($re->kmNgaybd) )
                {
                    
                    if($re->kmNgaybd <= $re->kmNgaykt)
                    {
                        $km->kmNgaybd=$re->kmNgaybd;
                        $km->kmNgaykt=$re->kmNgaykt;
                    }
                    else
                    {
                        Session::flash('err',"Ngày kết thúc phải sau ngày bắt đầu !");
                        return redirect()->back();
                    }
                }
                else
                {
                    Session::flash('err',"Ngày bắt đầu khuyến mãi phải là trong tương lai !");
                    return redirect()->back();
                }

                if($re->kmSoluong!=null)
                {
                    $km->kmSoluong=$re->kmSoluong;
                }
                else
                {
                    $km->kmSoluong=null;
                }
                if($re->kmGioihanmoikh!=null)
                {
                    $km->kmGioihanmoikh=$re->kmSolukmGioihanmoikhong;
                }
                else
                {
                    $km->kmGioihanmoikh=null;
                }
                $km->kmGiatritoida=$re->kmGiatritoida;
                $date=getdate();
                $km->kmMa=$date['seconds'].$date['minutes'].$date['yday'].$date['mon'];
                $kmMa=$km->kmMa;
                Session::flash('success','Thêm thành công !');
                $list="";
                $km->save();
                if($re->checkboxsp!=null)
                {
                   
                    foreach($re->checkboxsp as $v)
                    {
                        $sp=sanpham::where('spMa',$v)->first();
                        $sp->kmMa=$kmMa;
                        $sp->spSlkmtoida=$km->kmSoluong;
                        //dd($km,$sp);
                        
                        $list.=' '.$v.',';
                        $sp->update();    
                    }
                }
                

                //add promotion code to products
                //dd($re->checkboxsp);
                
                //Save_log
                $ad_log=new admin_log();
                $ad_log->adMa=Session::get('adMa');
                $ad_log->alChitiet="Thêm khuyến mãi: ".$re->kmTen.'; Sản phẩm được áp dụng: '.$list;
                $ad_log->alNgaygio=now();
                $ad_log->save();
                return redirect('adKhuyenmai');
        }
    }
      public function adDeleteKhuyenmai(Request $re)
      {
        $promoInfo=khuyenmai::where('kmMa',$re->id)->first();
        if(!$promoInfo)
        {
            Session::flash('err',"Khuyến mãi không tồn tại !");
            return redirect()->back();
        }
        //check product of this promotion
        $checkExistProduct=sanpham::where('kmMa',$re->id)->get();
        if($checkExistProduct)
        {
            foreach($checkExistProduct as $i)
            {
            $sp = sanpham::where('spMa',$i->spMa)->first();
            $sp->kmMa==null;
            $sp->spSlkmtoida=null;
            $sp->update();
            }
        }
        


        $ad_log=new admin_log();
        $ad_log->adMa=Session::get('adMa');
        $ad_log->alChitiet='Xóa chương trình khuyến mãi: '.$promoInfo->kmTen.':'.$promoInfo->kmMota;
        $ad_log->alNgaygio=now();
        $ad_log->save();
        Session::flash('success',"Đã xóa khuyến mãi: ".$promoInfo->kmTen);
        khuyenmai::where('kmMa',$re->id)->delete();
        return redirect('adKhuyenmai');
      }

     

      public function suaKhuyenmaipage(Request $re)
      {
        $km=khuyenmai::where('kmMa',$re->id)->first();
        //dd($checkExistKhuyenmai);
        if(!$km)
        {
           
            Session::flash("err","Chương trình khuyến mãi không tồn tại !");
            return redirect::to('adKhuyenmai');
        }
       
        if(Session::has('adTaikhoan'))
        {   
            $checksanpham=sanpham::join('nhacungcap','nhacungcap.nccMa','sanpham.nccMa')->join('hinh','sanpham.spMa','hinh.spMa')->get();
            $noteDanhgia = danhgia::where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = donhang::where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = donhang::where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $a=array();
            $sanpham=array();
            foreach($checksanpham as $i)
            {
              
                if(in_array($i->spMa, $a)==null)
                {
                    array_push($a, $i->spMa);
                    array_push($sanpham, $i);
                }
            }
            return view('admin.suaKhuyenmai',compact('km','sanpham','noteDanhgia','noteDonhang','noteDonhang1'));
        }
        else
        {
            return Redirect('/adLogin');
        }
      }

      public function suaKhuyenmai(Request $re)
      {
         if($re->kmTrigia == null)
        {
            Session::forget('th_err');
            $messages =[
                'kmTen.required'=>'Tên không được để trống !',
                'kmTrigia.required'=>'Giá trị khuyến mãi không được để trống !',
                'kmMota.required'=>'Mô tả không được để trống !',
                'kmNgaybd.required'=>'Vui lòng nhập ngày bắt đầu khuyến mãi !',
                'kmNgaykt.required'=>'Vui lòng nhập ngày kết thúc khuyến mãi !',
                'checkboxsp.required'=>'Vui lòng chọn ít nhất 1 sản phẩm!'
            ];
            $this->validate($re,[
                'kmTen'=>'required',
                'kmTrigia'=>'required',
                'kmMota'=>'required',
                'kmNgaybd'=>'required',
                'kmNgaykt'=>'required',
                'checkboxsp'=>'required',
            ],$messages);
        }
        else
        {       

                $km=khuyenmai::where('kmMa',$re->id)->first();
                //Declare message for change
                $checkFixed=0;
                $kmTenOld ="";
                $kmMotaOld ="";
                $kmTrigiaOld ="";
                $kmNgaybdOld ="";
                $kmNgayktOld ="";
                $kmSoluongOld ="";
                $kmGioihanmoikhOld ="";
                $kmGiatritoidaOld ="";
                //
                
                if($km->kmTen!=$re->kmTen)
                {
                    $kmTenOld='Tên: '.$km->kmTen.' => ' .$re->kmTen.'; ';
                    $km->kmTen=$re->kmTen;
                    $checkFixed++;    
                }
                
                if($re->kmTrigia<1)
                {
                    Session::flash('err',"Giá trị khuyến mãi phải lớn hơn 1 ");
                    return redirect()->back();
                }
                elseif($re->kmTrigia>100)
                {
                    Session::flash('err',"Giá trị khuyến mãi phải nhỏ hơn 100 !");
                    return redirect()->back();
                }
                if($km->kmTrigia!=$re->kmTrigia)
                {
                    $kmTrigiaOld='Trị giá: '.$km->kmTrigia.' => '.$re->kmTrigia.'; ';
                    $km->kmTrigia=$re->kmTrigia;
                    $checkFixed++; 
                }
                if($km->kmMota!=$re->kmMota)
                {
                    $kmMotaOld='Mô tả: '.$km->kmMota.' => '.$re->kmMota.'; ';
                    $km->kmMota=$re->kmMota;
                    $checkFixed++; 
                }
                
                $today=date_create();
  
                    if($re->kmNgaybd <= $re->kmNgaykt)
                    {
                        if($km->kmNgaybd!=$re->kmNgaybd)
                        {
                            $kmNgaybdOld='Ngày bắt đầu: '.$km->kmNgaybd.' => ' .$re->kmNgaybd.'; ';
                            $km->kmNgaybd=$re->kmNgaybd;
                            $checkFixed++;  
                        }
                        
                        if($km->kmNgaykt!=$re->kmNgaykt)
                        {
                            $kmNgayktOld='Ngày kết thúc: '.$km->kmNgaykt.' => ' .$re->kmNgaykt.'; ';
                            $km->kmNgaykt=$re->kmNgaykt;   
                            $checkFixed++; 
                        }
                        
                    }
                    else
                    {
                        Session::flash('err',"Ngày kết thúc phải sau ngày bắt đầu !");
                        return redirect()->back();
                    }
               
                if($km->kmSoluong!=$re->kmSoluong)
                {
                    if($re->kmSoluong!=null)
                    {
                        $kmSoluongOld='Số lượng khuyến mãi: '.$km->kmSoluong.' => ' .$re->kmSoluong.'; ';
                        $km->kmSoluong=$re->kmSoluong;
                        $checkFixed++; 
                    }
                    else
                    {
                        $kmSoluongOld='Số lượng khuyến mãi: '.$km->kmSoluong.' => Không giới hạn.'.'; ';
                        $km->kmSoluong=null;
                        $checkFixed++; 
                    }
                }
                
                if($km->kmGioihanmoikh!=$re->kmGioihanmoikh)
                {
                    if($re->kmGioihanmoikh!=null)
                    {
                        $kmGioihanmoikhOld='Giới hạn mỗi khách hàng: '.$km->kmGioihanmoikh.' => ' .$re->kmGioihanmoikh.'; ';
                        $km->kmGioihanmoikh=$re->kmGioihanmoikh;
                        $checkFixed++; 
                    }
                    else
                    {
                        $kmGioihanmoikhOld='Giới hạn mỗi khách hàng: '.$km->kmGioihanmoikh.' => Không giới hạn.'.'; ';
                        $km->kmGioihanmoikh=null;
                        $checkFixed++; 
                    }
                }
                if($km->kmGiatritoida!=$re->kmGiatritoida)
                {
                    $kmGiatritoidaOld='Gía tri tối đa được khuyến mãi: '.$km->kmGiatritoida.' => '.$re->kmGiatritoida.'; ';
                    $km->kmGiatritoida=$re->kmGiatritoida;
                    $checkFixed++; 
                }
                
                $date=getdate();
                

                $kmMa=$km->kmMa;

                Session::flash('success','Sửa thành công !');
                $km->update();
                //Remove this promotion for product
                $sp=sanpham::where('kmMa',$re->id)->get();
                $removelist="Sản phẩm đã xóa khỏi khuyến mãi: ";
                $addlist="";
                

                //add promotion code to products
                //dd($re->checkboxsp);
                if($re->checkboxsp!=null)
                {
                    foreach ($sp as $v) 
                    {
                        
                        $v->kmMa=null;
                        $removelist.=', '.$v->spMa;
                        $v->save();
                        $checkFixed++; 
                    }

                    foreach($re->checkboxsp as $v)
                    {
                        $sp=sanpham::where('spMa',$v)->first();
                        $sp->kmMa=$kmMa;
                        $sp->spSlkmtoida=$km->kmSoluong;
                        $checkFixed++; 
                        //dd($km,$sp);
                        
                        $addlist.=$v.', ';
                        $sp->update();    
                    }
                }
                

                //Save_log
                if($checkFixed!=0)
                {
                    $ad_log=new admin_log();
                    $ad_log->adMa=Session::get('adMa');

                    $ad_log->alChitiet="Sửa khuyến mãi: ".$re->kmTen.'; Sản phẩm được áp dụng: '.$addlist.'; '.$removelist.'; '.$kmTenOld.$kmMotaOld.$kmTrigiaOld.$kmNgaybdOld.$kmNgayktOld.$kmSoluongOld.$kmGioihanmoikhOld.$kmGiatritoidaOld;
                    $ad_log->alNgaygio=now();
                    $ad_log->save();
                }
                return redirect('adKhuyenmai');
        }
      }

//end khuyến mãi  

  //Bình luận đánh giá
  public function viewBLSP($id)
  {
     $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
 $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
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
 $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
     $dg = DB::table('danhgia')->where('dgMa',$id)->join('khachhang','khachhang.khMa','=','danhgia.khMa')->get();
     $data = array();
     $data['dgTrangthai']=0;
     DB::table('danhgia')->where('dgMa',$id)->update($data);
    return view('admin.chitietbinhluan')->with('dg',$dg)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
  }
  //Hóa đơn
  public function themNVgiao($id)
  {
      $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
 $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
    $dataNV = DB::table('admin')->where('adQuyen',2)->get();
    $data = DB::table('donhang')->where('hdMa',$id)->get();
    return view('admin.them-nv-giao-hang')->with('dataNV',$dataNV)->with('data',$data)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
  }
  public function giaohang(Request $re,$id)
  {
    $data = array();
    $data["hdTinhtrang"]=1;
    $data["adMa"]=$re->hdNhanvien;
    DB::table('donhang')->where('hdMa',$id)->update($data);
    return redirect('don-hang');
  }
  public function thanhtoan($id)
  {
    $data = array();
    $data["hdTinhtrang"]=2;
    DB::table('donhang')->where('hdMa',$id)->update($data);
    return redirect()->back();
  }
 public function xoadon($id)
 {
    DB::table('donhang')->where('hdMa',$id)->delete();
    return redirect()->back();
 }
  //báo cáo
   public function updateBaocao(Request $re)
  {
    if($re->dateStart > $re->dateEnd)
    {
        Session::flash("note_err","Ngày bắt đầu không được lớn hơn ngày kết thúc");
         return Redirect('bao-cao-ngay');  
    }
    else if($re->dateStart==null || $re->dateEnd==null)
    {
        Session::flash("note_err","Ngày bắt đầu và ngày kết thúc không được trống");
         return Redirect('bao-cao-ngay');  
    }
    else
    {
        $data = array();
        $bcSoluong=DB::table('donhang')
                ->where('hdNgaytao',">=",$re->dateStart)
                ->where('hdNgaytao',"<=",$re->dateEnd)
                ->where('hdTinhtrang',1)
                ->sum("hdSoluongsp");
        
        $data["bcTonghangxuat"] = $bcSoluong;
        $bcTonghangnhap=DB::table('kho')->select('khoSoluong')->where('khoNgaynhap',$re->bcNgay)->sum('khoSoluong');
        $data["bcTonghangnhap"] =$bcTonghangnhap;
        $bcTongtien=DB::table('donhang')
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

         $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Lập báo cáo từ:".$re->dateStart." đến ".$re->dateEnd;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
        return redirect('bao-cao-ngay');
        
    }
  }
  public function deleteBaocao($id)
  {
    
    DB::table('baocao')->where('bcMa',$id)->delete();
    return redirect('bao-cao-ngay');
  }


  // Nhà cung cấp
    
    public function adviewNhacungcap()
    {
        if(Session::has('adTaikhoan'))
        {
            $noteDanhgia = danhgia::where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $data = nhacungcap::all();
            return view('admin.nhacungcap')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }  
        return Redirect('/adLogin');  
    } 

    public function adThemnccpage()
    {
        if(Session::has('adTaikhoan'))
        {
            $noteDanhgia = danhgia::where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = donhang::where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 =donhang::where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $data = nhacungcap::all();
            return view('admin.themnhacungcap')->with('data',$data)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }  
        return Redirect('/adLogin');  
    }

    public function checkAddNcc(Request $re)
    {
        if($re->nccTen == null)
        {
       
            $messages =[
                'nccTen.required'=>'Tên nhà cung cấp không được để trống.',
                'nccDiachi.required'=>'Địa chỉ không được để trống.',
                'nccSdt.required'=>'Số điện thoại không được để trống.'
            ];
            $this->validate($re,[
                'nccTen'=>'required',
                'nccDiachi'=>'required',
                'nccSdt'=>'required'

            ],$messages);
        }
        else
        {
             $checkExistNhacungcap=nhacungcap::where('nccTen',$re->nccTen)->first();
             
            if($checkExistNhacungcap)
            {
                Session::flash('err','Nhà cung cấp đã tồn tại !');
                return redirect()->back();
            }
            else
            {
                $ncc=new nhacungcap();
                $ncc->nccTen=$re->nccTen;
                if(strlen($re->nccDiachi)<10)
                {
                    Session::flash('err','Địa chỉ không hợp lệ !');
                    return Redirect()->back();
                }
                $ncc->nccDiachi=$re->nccDiachi;
                if($re->nccSdt<99999999 || $re->nccSdt>=10000000000)
                {
                    Session::flash('err','Số điện thoại không hợp lệ !');
                    return Redirect()->back();
                }
                $ncc->nccSdt=$re->nccSdt;
                Session::flash('success','Thêm thành công !');
                $ncc->save();
                
                $ad_log=new admin_log();
                $ad_log->adMa=Session::get('adMa');
                $ad_log->alChitiet= "Thêm nhà cung cấp mới: ".$re->nccTen;
                $ad_log->alNgaygio=now();
                $ad_log->save();
               
                return redirect('adNhacungcap');
            }
        }
    }

    public function deleteNhacungcap(Request $re)
    {
        $checkExistNhacungcap =nhacungcap::where('nccMa',$re->id)->first();
        if(!$checkExistNhacungcap)
        {
            Session::flash('err','Nhà cung cấp không tồn tại!');
            return redirect()->back();
        }        
        $oldNccName=$checkExistNhacungcap->nccTen;

        $ad_log=new admin_log();
        $ad_log->adMa=Session::get('adMa');
        $ad_log->alChitiet="Xóa nhà cung cấp: ".$oldNccName;
        $ad_log->alNgaygio=now();        
        $ad_log->save();               
        
        Session::flash('success','Đã xóa nhà cung cấp: '.$oldNccName);
        $checkExistNhacungcap->delete();
        
        return redirect()->back();
    }

    public function suaNhacungcappage(Request $re)
    {
        $checkExistNhacungcap=nhacungcap::where('nccMa',$re->id)->first();
       
        if($checkExistNhacungcap)
        {
            return view('admin.suanhacungcap')->with('data',$checkExistNhacungcap);
        }
        else
        {
            Session::flash('err','Nhà cung cấp không tồn tại!');
            return redirect()->back();
        }
        return Redirect('/adLogin'); 
    }

    public function suaNhacungcap(Request $re)
    {
        $getNhacungcap=nhacungcap::where('nccMa',$re->id)->first();
        $checkExistNhacungcap=nhacungcap::where('nccTen',$re->nccTen)->first();
        if($checkExistNhacungcap)
        {
            Session::flash('err','Nhà cung cấp này đã tồn tại !');
            return redirect()->back();
        }
        else
        {
            $nccTenOld=$getNhacungcap->nccTen;
            $nccDiachiOld=$getNhacungcap->nccDiachi;
            $nccSdtOld=$getNhacungcap->nccSdt;
            $ad_log=new admin_log();
            $ad_log->alChitiet="Sửa thông tin nhà cung cấp:  ";
            if($getNhacungcap->nccTen!=$re->nccTen)
            {   
                $ad_log->alChitiet.='Tên: '.$nccTenOld.' => '.$re->nccTen.'; ';
                $getNhacungcap->nccTen=$re->nccTen;
            }
            if($getNhacungcap->nccDiachi!=$re->nccDiachi)
            {
                $ad_log->alChitiet.='Địa chỉ: '.$nccDiachiOld.' => '.$re->nccDiachi.'; ';
                $getNhacungcap->nccDiachi=$re->nccDiachi;
            }
            if($getNhacungcap->nccSdt!=$re->nccSdt)
            {
                $ad_log->alChitiet.='Số điện thoại: '.$nccSdtOld.' => '.$re->nccSdt.'; ';
                $getNhacungcap->nccSdt=$re->nccSdt;
            }
            $ad_log->adMa=Session::get('adMa');
            $ad_log->alNgaygio=now();
            $getNhacungcap->update();
            $ad_log->save();

            return Redirect::to('adNhacungcap');
        }
    }

    // Tìm ngày hoạt động
    public function timLSHD(Request $re)
    {
         $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
        $alNgaygio = DB::table('admin_log')->distinct()->get('alNgaygio');
        
        $data = DB::table('admin_log')->leftjoin('admin','admin.adMa','=','admin_log.adMa')->where('alNgaygio','like','%'.$re->alNgaygio.'%')->get();
        return view('admin.lich-su-hoat-dong')->with('data',$data)->with('ngaygio',$alNgaygio)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);

    }

}

