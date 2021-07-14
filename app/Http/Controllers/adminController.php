<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Session;
use Carbon\Carbon;

//Models
use App\Models\admin;
use App\Models\khachhang;
use App\Models\sanpham;
use App\Models\kho;
use App\Models\hinh;
use App\Models\mota;
use App\Models\phieunhap;
use App\Models\danhgia;
use App\Models\thuonghieu;
use App\Models\loai;
use App\Models\nhucau;
use App\Models\nhacungcap;
use App\Models\slide;
use App\Models\admin_log;
use App\Models\donhang;
use App\Models\khuyenmai;
use App\Models\voucher;
use App\Models\chitietphieunhap;
use App\Models\chitietdonhang;



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
            $nv = DB::table('admin')->get();
            $sp = DB::table('sanpham')
                ->join('hinh','hinh.spMa','=','sanpham.spMa')
                ->where('hinh.thutu','=','1')
                ->join('kho','kho.spMa','=','sanpham.spMa')
                ->get();
            $dh = DB::table('donhang')->where('hdTinhtrang',2)->count();
            $total_price = DB::table('donhang')->where('hdTinhtrang',2)->sum('hdTongtien');
            $total_sp = DB::table('sanpham')->where('spTinhtrang',1)->count();
            $total_pay = DB::table('phieunhap')->sum('pnTongtien');
            return view('admin.index',compact('nv','sp','dh','total_price','total_sp','total_pay','noteDonhang','noteDonhang1','noteDanhgia'));
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
               
                $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
                Session::put('dgTrangthai',$noteDanhgia);
                $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
                Session::put('hdTinhtrang',$noteDonhang);
                $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
                Session::put('hdTinhtrang1',$noteDonhang1);
                $nv = DB::table('admin')->get();
                $sp = DB::table('sanpham')
                    ->join('hinh','hinh.spMa','=','sanpham.spMa')
                    ->where('hinh.thutu','=','1')
                    ->join('kho','kho.spMa','=','sanpham.spMa')
                    ->get();
                $total_sp = DB::table('sanpham')->where('spTinhtrang',1)->count();
                $dh = DB::table('donhang')->where('hdTinhtrang',2)->count();
                $total_price = DB::table('donhang')->where('hdTinhtrang',2)->sum('hdTongtien');
                $total_pay = DB::table('phieunhap')->sum('pnTongtien');
            return view('admin.index',compact('nv','sp','dh','total_price','total_sp','total_pay','noteDonhang','noteDonhang1','noteDanhgia'));
            }
            else
            {
                Session::flash('note_err','Tên tài khoản hoặc mật khẩu không chính xác!');
                return "<script>window.history.back();</script>"; 
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
            $data=DB::table('kho')->join('sanpham','sanpham.spMa','=','kho.spMa')->get();
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
        

   public function viewBanner($vitri)
    {
         if(Session::has('adTaikhoan'))
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $data = DB::table('slide')->where('bnVitri',$vitri)->orderBy('bnNgay','desc')->get();
            $vt = DB::table('slide')->select('bnVitri')->orderBy('bnNgay','asc')->get();
            $default = DB::table('slide')->select('bnVitri')->where('bnVitri',$vitri)->get();

            return view('admin.banner')->with('data',$data)
                                        ->with('vitri',$vt)
                                        ->with('default',$default)
                                        ->with('noteDanhgia',$noteDanhgia)
                                        ->with('noteDonhang',$noteDonhang)
                                        ->with('noteDonhang1',$noteDonhang1);
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
            $data = DB::table('admin_log')->leftjoin('admin','admin.adMa','=','admin_log.adMa')->orderBy('alNgaygio','desc')->get();
            return view('admin.lich-su-hoat-dong')->with('data',$data)->with('ngaygio',$alNgaygio)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }
      public function viewLSgiaohang()
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
            $data = DB::table('admin_log')
                            ->leftjoin('admin','admin.adMa','=','admin_log.adMa')
                            ->where('alChitiet','like','%'.'Giao hàng:'.'%')
                            ->orderBy('alNgaygio','desc')->get();
            return view('admin.lich-su-giao-hang')->with('data',$data)->with('ngaygio',$alNgaygio)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }

    public function viewTintuc()
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);

        $data = DB::table('tintuc')->join('admin','admin.adMa','=','tintuc.adMa')->get();
        return view('admin.tin-tuc')
                                ->with('data',$data)->with('noteDanhgia',$noteDanhgia)
                                ->with('noteDonhang',$noteDonhang)
                                ->with('noteDonhang1',$noteDonhang1);
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
            Session::put('hdTinhtrang1',$noteDonhang);
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
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
        $bcNgay = DB::table('donhang')->distinct()->get('hdNgaytao');
        $data=DB::table('baocao')->get();
        return view('admin.bao-cao-ngay')->with('data',$data)->with('bcNgay',$bcNgay)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        { return Redirect('/adLogin'); }
    }

    public function viewQlPhieunhap()
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
        $pn = DB::table('phieunhap')->join('admin','admin.adMa','=','phieunhap.adMa')->get();

        return view('admin.quan-ly-phieu-nhap',compact('pn','noteDanhgia','noteDonhang','noteDonhang1'));
    }


    //////////////////////////////Add Manage
    

    // Nhân viên
      public function themAdmin()
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
        return view('admin.themnhanvien',compact('noteDanhgia','noteDonhang','noteDonhang1'));
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
        if($re->adSdt<0)
        {
             Session::flash('note_err','Số điện thoại sai! Vui lòng nhập lại!');
             return "<script>window.history.back();</script>"; 
        }
        else
         {
            $dataBefore1 = DB::table('admin')->where('adTaikhoan',$re->adTaikhoan)->first();
            $dataBefore2 = DB::table('admin')->where('adEmail',$re->adEmail)->first();
            $dataBefore3 = DB::table('admin')->where('adSdt',$re->adSdt)->first();
            if($dataBefore1)
            {
                Session::flash('note_err','Tài khoản đã tồn tại, vui lòng nhập tài khoản khác!');
              return "<script>window.history.back();</script>";
            
            }
            else if( $dataBefore2)
            {
                Session::flash('note_err','Email đã tồn tại, vui lòng nhập email khác!');
               return "<script>window.history.back();</script>";
            }
            else if( $dataBefore3)
            {
                Session::flash('note_err','Số điện thoại đã tồn tại, vui lòng nhập số khác!');
              return "<script>window.history.back();</script>";
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
                    $data['adHinhcmnd']=$re->cmnd;
                     $data['adDiachi']=$re->adDiachi;
                    $data['adEmail']=$re->adEmail;
                    $data['adHinh'] = $re->file('adHinh')->getClientOriginalName();
                    $imgextention=$re->file('adHinh')->extension();
                                $file=$re->file('adHinh');
                                $file->move('public/images/nhanvien',$data['adHinh']);
                    $data['adQuyen']=$re->adQuyen;
                    $data['adTinhtrang']=1;
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
                   return "<script>window.history.back();</script>"; 
                    }
            }
        }
    }
 
    public function adDeleteAdmin($id)
    {
      $db = DB::table('admin')->select('adTen')->where('adMa',$id)->first();
               
          $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Xóa nhân viên:".$db->adTen;
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
         if($re->adSdt<0)
        {
             Session::flash('note_err','Số điện thoại sai! Vui lòng nhập lại!');
             return "<script>window.history.back();</script>"; 
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
                $data['adHinhcmnd']=$re->cmnd;
                $data['adDiachi']=$re->adDiachi;
                $data['adEmail']=$re->adEmail;
                $data['adHinh'] = $re->file('adHinh')->getClientOriginalName();
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
                $data['adHinhcmnd']=$re->cmnd;
                $data['adDiachi']=$re->adDiachi;
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
            return "<script>window.history.back();</script>"; 
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
                   return "<script>window.history.back();</script>"; 
                }
                if($dataBefore1)
                {
                    Session::flash('note_err','Tài khoản đã tồn tại, vui lòng nhập tài khoản khác!');
                   return "<script>window.history.back();</script>"; 
                }
                else if( $dataBefore2)
                {
                    Session::flash('note_err','Email đã tồn tại, vui lòng nhập email khác!');
                  return "<script>window.history.back();</script>"; 
                }
                else if( $dataBefore3)
                {
                    Session::flash('note_err','Số điện thoại đã tồn tại, vui lòng nhập số khác!');
                  return "<script>window.history.back();</script>";
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
                    $data['khTaikhoan']=$re->khTaikhoan;
                    $data['khSdt']=$re->khSdt;
                    $data['khHinh'] = $re->file('khHinh')->getClientOriginalName();
                        $imgextention=$re->file('khHinh')->extension();
                                    $file=$re->file('khHinh');
                                    $file->move('public/images/khachhang',$data['khHinh']);
                   $data['khXtemail'] = 1;
                    $data['khResetpassword']=null;
                    $data['khNgaythamgia']=now();
                    $data['khQuyen']=$re->khQuyen;
                    
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
                    $data['khTaikhoan']=$re->khTaikhoan;
                    $data['khSdt']=$re->khSdt;
                    $data['khHinh'] = "";
                    $data['khXtemail'] = 1;
                    $data['khResetpassword']=null;
                    $data['khNgaythamgia']=now();
                    $data['khQuyen']=$re->khQuyen;
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
            $yearNow = Carbon::now()->year;
            $yearKh = new Carbon($re->khNgaysinh);
            $yearKhNgaysinh = $yearKh->year;
            if($yearNow - $yearKhNgaysinh<=10)
            {
                Session::flash('note_err','Khách hàng phải trên 10 tuổi');
               return "<script>window.history.back();</script>"; 
            }
            if($re->hasFile('khHinh')==true)
            {
                $data = array();
                $data['khTen']=$re->khTen;
                $data['khEmail']=$re->khEmail;
                $data['khMatkhau']=$re->khMatkhau;
                $data['khNgaysinh']=$re->khNgaysinh;
                $data['khDiachi']=$re->khDiachi;
                $data['khGioitinh']=$re->khGioitinh;
                $data['khTaikhoan']=$re->khTaikhoan;
                $data['khSdt']=$re->khSdt;
                $data['khHinh'] = $re->file('khHinh')->getClientOriginalName();
                    $imgextention=$re->file('khHinh')->extension();
                                $file=$re->file('khHinh');
                                $file->move('public/images/khachhang',$data['khHinh']);
                 $data['khQuyen']=$re->khQuyen;
                DB::table('khachhang')->where('khMa',$id)->update($data);
                return redirect('adKhachhang');
            }
            else
            {
                $data = array();
                $data['khTen']=$re->khTen;
                $data['khEmail']=$re->khEmail;
                $data['khMatkhau']=$re->khMatkhau;
                $data['khNgaysinh']=$re->khNgaysinh;
                $data['khDiachi']=$re->khDiachi;
                $data['khGioitinh']=$re->khGioitinh;
                $data['khTaikhoan']=$re->khTaikhoan;
                $data['khSdt']=$re->khSdt;
                $data['khQuyen']=$re->khQuyen;
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
         if($re->spTen ==null)
        {  
            $messages =[
                'spTen.required'=>'Sản phẩm không được để trống',
                'spHanbh.required'=>'Hạn bảo hành không được để trống',
            ];
            $this->validate($re,[
                'spTen'=>'required',
                'spHanbh'=>'required',
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
                    Session::flash('note_err','Sản phẩm đã có sẵn trong dữ liệu!');
                     return "<script>window.history.back();</script>"; 
                }
                else
                {
                $spMa = rand(0,100).strlen($re->spGia).strlen($re->spTen).rand(0,1000);
                $data = array();
                $data['spMa']=$spMa;
                $data['spTen']=$re->spTen;
                $data['spGia']=0;
                $data['spHanbh']=$re->spHanbh;
                $data['spTinhtrang']=0;
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


                if($re->loaiMa==1)
                {

                    $data2 = array();
                    $data2['spMa']= $spMa;
                    $data2['ram'] = $re->ram;
                    $data2['cpu'] = $re->cpu;
                    $data2['ocung'] = $re->ocung;
                    $data2['psu'] = "";
                    $data2['vga'] = "";
                    $data2['mainboard'] = "";
                    $data2['manhinh'] = $re->manhinh;
                    $data2['chuot'] = $re->chuot;
                    $data2['banphim'] = $re->banphim;
                    $data2['vocase'] = "";
                    $data2['pin'] = $re->pin;
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
                    $data2['ocung'] = $re->ocung;
                    $data2['psu'] = $re->psu;
                    $data2['vga'] = $re->vga;
                    $data2['mainboard'] = $re->mainboard;
                    $data2['manhinh'] = "";
                    $data2['chuot'] = "";
                    $data2['banphim'] = "";
                    $data2['vocase'] = $re->case;
                    $data2['pin'] = "";
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
              
                $data3 = array();
                $data3['spMa']= $spMa;
                $data3['spHinh']=$re->file('img')->getClientOriginalName();
                        $imgextention=$re->file('img')->extension();
                        $file=$re->file('img');
                        $file->move('public/images/products',$data3['spHinh']);
                 $data3['thutu'] = 1;
                DB::table('hinh')->insert($data3);

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
        $db = DB::table('sanpham')->select('spTen')->where('spMa',$id)->first();
          $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Xóa sản phẩm: ".$db->spTen;
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
        if($re->spTen ==null||$re->ram==null||$re->ocung==null||$re->cpu==null)
        {
            $messages =[
               
                'spTen.required'=>'Sản phẩm không được để trống',
                'spHanbh.required'=>'Hạn bảo hành không được để trống',
                'ram.required'=>'Ram không được để trống',
                'ocung.required'=>'Ổ cứng không được để trống',
                'cpu.required'=>'CPU không được để trống',
                
            ];
            $this->validate($re,[
               
                'spTen'=>'required',
                'spHanbh'=>'required',
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
                    $data2['spMa']= $id;
                    $data2['ram'] = $re->ram;
                    $data2['cpu'] = $re->cpu;
                    $data2['ocung'] = $re->ocung;
                    $data2['psu'] = "";
                    $data2['vga'] = "";
                    $data2['mainboard'] = "";
                    $data2['manhinh'] = $re->manhinh;
                    $data2['chuot'] = $re->chuot;
                    $data2['banphim'] = $re->banphim;
                    $data2['vocase'] = "";
                    $data2['pin'] = $re->pin;
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
                    $data2['spMa']= $id;
                    $data2['ram'] = $re->ram;
                    $data2['cpu'] = $re->cpu;
                    $data2['ocung'] = $re->ocung;
                    $data2['psu'] = $re->psu;
                    $data2['vga'] = $re->vga;
                    $data2['mainboard'] = $re->mainboard;
                    $data2['manhinh'] = "";
                    $data2['chuot'] = "";
                    $data2['banphim'] = "";
                    $data2['vocase'] = $re->case;
                    $data2['pin'] = "";
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
                
                
                 DB::table('mota')->where('spMa',$id)->update($data2);

                 return redirect('/updateSanpham/'.$re->spMa);
            }

        
    }
    public function editStatusHinh($tenhinh, $id)
    {
        $count = DB::table('hinh')->select("spHinh")->where('spMa',$id)->where("thutu","1")->count();
        $oldDB = DB::table('hinh')->where('spMa',$id)->where("thutu","1")->first();
        if($count == 0)
        {
            $data = array();
            $data["thutu"] = 1;
            DB::table('hinh')->where('spHinh',$tenhinh)->update($data);
            return redirect('/updateSanpham/'.$id);
        }
        elseif($count>=1)
        {
           
            $data1 = array();
            $data1["thutu"] = 0;
            DB::table('hinh')->where('spHinh',$oldDB->spHinh)->update($data1);

              $data = array();
                $data["thutu"] = 1;
                DB::table('hinh')->where('spHinh',$tenhinh)->update($data);
                return redirect('/updateSanpham/'.$id);
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
             $data['thutu']=0;
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
                Session::flash('note_err',"Loại đã tồn tại!");
                return "<script>window.history.back();</script>"; 
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
  
                return redirect('adLoai');
            }
        }
    }

    public function adDeleteLoai($id)
    {
        $exist = DB::table('sanpham')->where('loaiMa',$id)->count();
        if($exist >= 1)
        {
             //Session::flash('note_err','Đã có sản phẩm thuộc loại này, không được xóa!');
            return response()->json(['message'=>1]);
        }
        else
        {
        $dbOld = DB::table('loai')->select('loaiTen')->where('loaiMa',$id)->first();
               
          $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Xóa loại:".$dbOld->loaiTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
       
        DB::table('loai')->where('loaiMa',$id)->delete();
        return response()->json(['message'=>0]);
       // return redirect('adLoai');
        }
    }
    public function editLoai(Request $re, $id)
    {  
        if($re->loaiTen==null)
        {
            Session::flash('note_err','Không được để rỗng!');
            return "<script>window.history.back();</script>"; 
        }
        else
        {
                $dbOld = DB::table('loai')->select('loaiTen')->where('loaiMa',$id)->first();
               
                $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Sửa loại:".$dbOld->loaiTen."->".$re->loaiTen;
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
                Session::flash('note_err',"Nhu cầu đã tồn tại!");
                 return "<script>window.history.back();</script>"; 
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

        $exist = DB::table('sanpham')->where('ncMa',$id)->count();
        if($exist >= 1)
        {
             Session::flash('note_err','Đã có sản phẩm thuộc nhu cầu này, không được xóa!');
            return "<script>window.history.back();</script>"; 
        }
        else
        {
         $db = DB::table('nhucau')->select('ncTen')->where('ncMa',$id)->first();
          $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Xóa nhu cầu:".$db->ncTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
        DB::table('nhucau')->where('ncMa',$id)->delete();
        return redirect('adNhucau');
        }

    }
    public function editNhucau(Request $re, $id)
    {
          if($re->ncTen==null)
        {
            Session::flash('note_err','Không được để rỗng!');
             return "<script>window.history.back();</script>"; 
        }
        else
        {
             $db = DB::table('nhucau')->select('ncTen')->where('ncMa',$id)->first();
                    
                $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Sửa nhu cầu:".$db->ncTen."->".$re->ncTen;
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
            $messages =[
                'thTen.required'=>'Tên thương hiệu không được để trống',
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
                Session::flash('note_err',"Thương hiệu đã tồn tại!");
                return "<script>window.history.back();</script>"; 
            }
            else
            {
                $data = array();

                $data['thTen']=$re->thTen;
                DB::table('thuonghieu')->insert($data);
                
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
        $exist = DB::table('sanpham')->where('thMa',$id)->count();
        if($exist >= 1)
        {
             Session::flash('note_err','Đã có sản phẩm thuộc thương hiệu này, không được xóa!');
            return "<script>window.history.back();</script>"; 
        }
        else
        {
        $db = DB::table('thuonghieu')->select('thTen')->where('thMa',$id)->first();
       
          $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Xóa thương hiệu:".$db->thTen;
                $data1['alNgaygio']= now();
                //dd($data1['alChitiet']);
                DB::table('admin_log')->insert($data1);
       DB::table('thuonghieu')->where('thMa',$id)->delete();
        return redirect('adThuonghieu');
        }
       
    }
    public function editThuonghieu(Request $re, $id)
    {
        if($re->thTen==null)
        {
            Session::flash('note_err','Không được để rỗng!');
             return "<script>window.history.back();</script>"; 
        }
        else
        {
             $db = DB::table('thuonghieu')->select('thTen')->where('thMa',$id)->first();
                    
                $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Sửa thương hiệu:".$db->thTen."->".$re->thTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);

            $data = array();
            $data['thTen'] = $re->thTen;
            DB::table('thuonghieu')->where('thMa',$id)->update($data);
            return redirect('adThuonghieu');
        }
        
    }
    //end thương hiệu

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
                // if($checkExistKhuyenmai)
                // {
                //     Session::flash('err','Khuyến mãi này đã tồn tại');
                //     return "<script>window.history.back();</script>";
                // }
                $km->kmTen=$re->kmTen;
                if($re->kmTrigia<1)
                {
                    Session::flash('err',"Giá trị khuyến mãi phải lớn hơn 1 ");
                    return "<script>window.history.back();</script>";
                }
                elseif($re->kmTrigia>100)
                {
                    Session::flash('err',"Giá trị khuyến mãi phải nhỏ hơn 100 !");
                    return "<script>window.history.back();</script>";
                }
                $km->kmTrigia=$re->kmTrigia;
                $km->kmMota=$re->kmMota;
                $today=date_create();
                

                if($re->kmNgaybd <= $re->kmNgaykt)
                {
                $km->kmNgaybd=$re->kmNgaybd;
                $km->kmNgaykt=$re->kmNgaykt;
                }
                else
                {
                Session::flash('err',"Ngày kết thúc phải sau ngày bắt đầu !");
                        return "<script>window.history.back();</script>";
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
                    $km->kmGioihanmoikh=$re->kmGioihanmoikh;
                }
                else
                {
                    $km->kmGioihanmoikh=null;
                }
                $km->kmGiatritoida=$re->kmGiatritoida;
                $date=getdate();
                if($re->kmTinhtrang!=0)
                {
                    $km->kmTinhtrang=1;    
                }
                else
                {
                    $km->kmTinhtrang=0;       
                }
                
                $km->kmMa=$date['seconds'].$date['minutes'].$date['yday'].$date['mon'];
                //dd($km->kmMa);
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
                            
                        
                        $list.=' '.$v.',';
                        $sp->update();    
                    }
                }
                
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
            return "<script>window.history.back();</script>";
        }
        //check product of this promotion
        $promoInfo->kmTinhtrang=99;
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
        $promoInfo->update();
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
            $checksanpham=sanpham::join('nhacungcap','nhacungcap.nccMa','sanpham.nccMa')->join('hinh','sanpham.spMa','hinh.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->leftjoin('khuyenmai','khuyenmai.kmMa','sanpham.kmMa')->get();
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
            //dd($sanpham);
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
                    return "<script>window.history.back();</script>";
                }
                elseif($re->kmTrigia>100)
                {
                    Session::flash('err',"Giá trị khuyến mãi phải nhỏ hơn 100 !");
                    return "<script>window.history.back();</script>";
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
                        return "<script>window.history.back();</script>";
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
                if($re->kmTinhtrang!=0)
                {
                    $km->kmTinhtrang=1;    
                }
                else
                {
                    $km->kmTinhtrang=0;       
                }
                
                $date=getdate();
                

                $kmMa=$km->kmMa;

                Session::flash('success','Sửa thành công !');
                $km->update();
                //Remove this promotion for product
                $sp=sanpham::where('kmMa',$re->id)->get();
                $removelist="Sản phẩm đã xóa khỏi khuyến mãi: ";
                $addlist="";
                // dd($sp);

                //add promotion code to products
                //dd($re->checkboxsp);
                foreach ($sp as $v) 
                    {
                        
                        $v->kmMa=null;
                        //$removelist.=', '.$v->spMa;
                        $v->save();
                        $checkFixed++; 
                    }
                if($re->checkboxsp!=null)
                {
                    
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

                    $ad_log->alChitiet="Sửa khuyến mãi: ".$re->kmTen.'; './*$removelist.*/'; '.'Sản phẩm được áp dụng: '.$addlist.'; '.$kmTenOld.$kmMotaOld.$kmTrigiaOld.$kmNgaybdOld.$kmNgayktOld.$kmSoluongOld.$kmGioihanmoikhOld.$kmGiatritoidaOld;
                    $ad_log->alNgaygio=now();
                    $ad_log->save();
                }
                return redirect('adKhuyenmai');
        }
      }

      public function switchStatus(Request $re)
      {
        $checkExistKhuyenmai=khuyenmai::Where('kmMa',$re->id)->first();
        if($checkExistKhuyenmai)
        {
            if($checkExistKhuyenmai->kmTinhtrang!=0)
            {
                $checkExistKhuyenmai->kmTinhtrang=0;
                $checkExistKhuyenmai->update();
                $log= new admin_log();
                        $log->adMa=Session::get('adMa');
                        $log->alChitiet='Đổi trạng thái khuyến mãi: '.$checkExistKhuyenmai->kmTen.' thành Ẩn.';
                        $log->alNgaygio=now();
                        $log->save();
            }
            else
            {
                $checkExistKhuyenmai->kmTinhtrang=1;
                $checkExistKhuyenmai->update();
                $log= new admin_log();
                        $log->adMa=Session::get('adMa');
                        $log->alChitiet='Đổi trạng thái khuyến mãi: '.$checkExistKhuyenmai->kmTen.' thành Ẩn.';
                        $log->alNgaygio=now();
                        $log->save();
            }
        }
        else
        {
            Session::flash('err','Khuyến mãi không tồn tại !');
        }
        return redirect::to('adKhuyenmai');
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
 
  public function giaohang(Request $re,$id)
  {
    $data = array();
    $data["hdTinhtrang"]=1;
    $data["adMa"]=$re->hdNhanvien;
    DB::table('donhang')->where('hdMa',$id)->update($data);

    $nv = DB::table('admin')->where('adMa',$re->hdNhanvien)->first();
  
    $data1 = array();
    $data1['adMa'] = Session::get('adMa');
    $data1['alChitiet'] = "Giao hàng: nhân viên ".$nv->adTen." nhận đơn hàng có mã ".$id;
    $data1['alNgaygio']= now();
    DB::table('admin_log')->insert($data1);
    
    return redirect('don-hang');
  }
  public function thanhtoan($id)
  {
    $data = array();
    $data["hdTinhtrang"]=2;
    DB::table('donhang')->where('hdMa',$id)->update($data);
    return "<script>window.history.back();</script>";
  }
 public function xoadon($id)
 {
    DB::table('donhang')->where('hdMa',$id)->delete();
    return "<script>window.history.back();</script>";
 }
  //báo cáo
   public function updateBaocao(Request $re)
  {
    if($re->dateStart > $re->dateEnd)
    {
        Session::flash("note_err","Ngày bắt đầu không được lớn hơn ngày kết thúc");
         return "<script>window.history.back();</script>";   
    }
    else if($re->dateStart==null || $re->dateEnd==null)
    {
        Session::flash("note_err","Ngày bắt đầu và ngày kết thúc không được trống");
        return "<script>window.history.back();</script>"; 
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
                return "<script>window.history.back();</script>";
            }
            else
            {
                $ncc=new nhacungcap();
                $ncc->nccTen=$re->nccTen;
                if(strlen($re->nccDiachi)<10)
                {
                    Session::flash('err','Địa chỉ không hợp lệ !');
                    return "<script>window.history.back();</script>";
                }
                $ncc->nccDiachi=$re->nccDiachi;
                if($re->nccSdt<99999999 || $re->nccSdt>=10000000000)
                {
                    Session::flash('err','Số điện thoại không hợp lệ !');
                    return "<script>window.history.back();</script>";
                }
                $ncc->nccSdt=$re->nccSdt;
                $ncc->nccTinhtrang=1;
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
        $exist =nhacungcap::where('nccMa',$re->id)->first();
        if($exist)
        {
            Session::flash('err','Đã có sản phẩm thuộc nhà cung cấp này, không được xóa!');
            return "<script>window.history.back();</script>";
        }      
        else
        { 
            $ad_log=new admin_log();
            $ad_log->adMa=Session::get('adMa');
            $ad_log->alChitiet="Xóa nhà cung cấp: ".$exist->nccTen;
            $ad_log->alNgaygio=now();        
            $ad_log->save();               
            
            Session::flash('success','Đã xóa nhà cung cấp: '.$exist->nccTen);
            $exist->nccTinhtrang=99;
            $exist->update();
            
            return redirect('adNhacungcap');
        }  
       
    }

    public function suaNhacungcappage(Request $re)
    {
        $checkExistNhacungcap=nhacungcap::where('nccMa',$re->id)->first();
       if(Session::has('adMa'))
       {
            if($checkExistNhacungcap)
            {
                return view('admin.suanhacungcap')->with('data',$checkExistNhacungcap);
            }
            else
            {
                Session::flash('err','Nhà cung cấp không tồn tại!');
                return "<script>window.history.back();</script>";
            }
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
            return "<script>window.history.back();</script>";
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
    // public function timLSHD(Request $re)
    // {
    //         $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
    //         Session::put('dgTrangthai',$noteDanhgia);
    //         $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
    //         Session::put('hdTinhtrang',$noteDonhang);
    //         $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
    //         Session::put('hdTinhtrang1',$noteDonhang1);
    //         $alNgaygio = DB::table('admin_log')->distinct()->get('alNgaygio');
        
    //     $data = DB::table('admin_log')->leftjoin('admin','admin.adMa','=','admin_log.adMa')->where('alNgaygio','like','%'.$re->alNgaygio.'%')->get();
    //     return view('admin.lich-su-hoat-dong')->with('data',$data)->with('ngaygio',$alNgaygio)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
    // }

    //Phiếu nhập
    public function viewCTPhieunhap($id)
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);
        $data = DB::table("phieunhap")->where('pnMa',$id)->join('admin','admin.adMa','=','phieunhap.adMa')->get();
        $data2 = DB::table("chitietphieunhap")->where('pnMa',$id)
                ->join('sanpham','sanpham.spMa','=','chitietphieunhap.spMa')
                ->join('nhacungcap','nhacungcap.nccMa','=','chitietphieunhap.nccMa')
                ->join('serial','serial.spMa','=','chitietphieunhap.spMa')
                ->get();
        return view('admin.chi-tiet-phieu-nhap')->with('data',$data)->with('data2',$data2)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
    }
    public function viewLapPhieuNhap()
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);
        $sanpham = DB::table('sanpham')->select('spMa','spTen')->get();
        $nhacungcap = DB::table('nhacungcap')->select('nccMa','nccTen')->get();
        return view('admin.lap-phieu-nhap')->with('sanpham',$sanpham)->with('nhacungcap',$nhacungcap)->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
    }
    public function addPhieunhap(Request $re)
    {
        $data = array();
        $data['pnMa'] = rand(0,100).strlen("adMa").strlen($re->tongsl).strlen( $re->tonggia);
        $data['pnNgaylap'] = now();
        $data['adMa'] = Session::get('adMa');
        $data['pnSoluongsp']=$re->tongsl;
        $data['pnTongtien']=  $re->tonggia; 
        
        DB::table('phieunhap')->insert($data);
         
        foreach($re->spMa as $key => $v)
        {
            $data2 = array();
            $data2["pnMa"] =  $data['pnMa'];
            $data2["spMa"] =  $v;
            $data2["nccMa"] = $re->nccMa[$key];
            $data2["ctpnSoluong"]=$re->soluong[$key];
            $data2["ctpnDongia"]= $re->gia[$key];
            $data2["ctpnThanhtien"]=$re->tonggiasp[$key];
            DB::table('chitietphieunhap')->insert($data2);

            $data5 =array();
            $data5['spMa']=$v;
            $data5['serMa']=$re->serMa[$key];
            $data5['serTinhtrang']=0;
            DB::table('serial')->insert($data5);

            $sumSerial = DB::table('serial')->where('spMa',$v)->count();
            $checkExist = DB::table('kho')->where('spMa',$v)->count();
            $checkKho = DB::table('kho')->select('khoSoluong')->where('spMa',$v)->count();
            if($checkExist==0)
            {
                $data3 = array();
                $data3["spMa"] = $v;
                $data3["khoSoluong"] = $sumSerial;
                $data3["khoNgaynhap"] = now(); 
                $data3["khoSoluongdaban"] = 0;   
                DB::table('kho')->insert($data3);
            }
            else
            {
                if($checkKho > 0)
                {
                    $data3 = array();
                    $data3["khoSoluong"] = $checkKho + $sumSerial -1;
                    $data3["khoNgaynhap"] = now(); 
                    $data3["khoSoluongdaban"] = 0;   
                    DB::table('kho')->where('spMa', $v)->update($data3);
                }
                else
                {
                    $data3 = array();
                    $data3["khoSoluong"] = $sumSerial;
                    $data3["khoNgaynhap"] = now(); 
                    $data3["khoSoluongdaban"] = 0;   
                    DB::table('kho')->where('spMa', $v)->update($data3);
                }
                
            }

            $data4 = array();
            $data4['spTinhtrang'] =1;
            $data4['spGia'] =$re->gia[$key];
            $data4["nccMa"] =$re->nccMa[$key];
            DB::table('sanpham')->where('spMa', $v)->update($data4);
         }
         
        

        $data6 = array();
        $data6['adMa'] = Session::get('adMa');
        $data6['alChitiet'] = "Lập phiếu nhập mới, ngày ".now();
        $data6['alNgaygio']= now();
        DB::table('admin_log')->insert($data6);

        return redirect("quan-ly-phieu-nhap");
    }

     public function viewCTDonhang($id)
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);
        $data = DB::table('donhang')->where('hdMa',$id)
                    ->join('khachhang','khachhang.khMa','=','donhang.khMa')->get();
        $data2 = DB::table('chitietdonhang')->where("hdMa",$id)
                    ->join('sanpham','sanpham.spMa','=','chitietdonhang.spMa')
                    ->get();
        $data3 = DB::table('admin')
                    ->leftjoin("donhang","donhang.adMa","=","admin.adMa")
                    ->where("donhang.hdMa","=",$id)
                    ->get();
        $dataNV = DB::table('admin')->where('adQuyen',4)->get();

        return view('admin.chi-tiet-phieu-thu',compact('data','data2','data3','dataNV','noteDanhgia','noteDonhang','noteDonhang1'));
    }
// VOUCHER
    public function viewVoucher()
    {
        if(Session::has('adTaikhoan'))
        {   
            $noteDanhgia = danhgia::where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = donhang::where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = donhang::where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);
            $vc= DB::table('voucher')->leftjoin('sanpham','sanpham.spMa','voucher.spMa')->where('vcTinhtrang','!=' ,99)->get();;

            
            return view('admin.voucher',compact('vc'))->with('noteDanhgia',$noteDanhgia)->with('noteDonhang',$noteDonhang)->with('noteDonhang1',$noteDonhang1);
        }
        else 
        {
            return view('admin.login');    
        }
    }

    public function addVoucherpage()
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
            
            return view('admin.themvoucher',compact('sanpham','noteDanhgia','noteDonhang','noteDonhang1'));
        }
        else 
        {
            return view('admin.voucher');    
        }
    }

    public function checkAddVoucher(Request $re)
    {
        //Validate
       $messages =[
                'vcMa.required'=>'Mã không được để trống !',
                'vcTen.required'=>'Tên không được để trống !',
                'vcSoluot.required'=>'Số lượt không được để trống!',
                'vcNgaybd.required'=>'Nhập ngày bắt đầu !',
                'vcNgaykt.required'=>'Nhập ngày kết thúc !',
                'vcMucgiam.required'=>'Nhập mức giảm!',
                'vcGiatritoida.required'=>'Nhập giá trị tối đa!',
            ];
            $this->validate($re,[
                'vcMa'=>'required',
                'vcTen'=>'required',
                'vcSoluot'=>'required',
                'vcNgaybd'=>'required',
                'vcNgaykt'=>'required',
                 'vcMucgiam'=>'required',
                 'vcGiatritoida'=>'required'
            ],$messages);
        $checkExistVoucher= voucher::find($re->vcMa);
        if($checkExistVoucher)
        {
            Session::flash('err','Mã voucher đã tồn tại !');
            return "<script>window.history.back();</script>";
        }
        $vc=new voucher();
        //Kiểm tra mã hợp lệ
        $flag='';
        for($i=0;$i < strlen($re->vcMa);$i++)
        {
            
            for($j=65;$j<=91;$j++)
            {
                if(chr($j)==$re->vcMa[$i])
                {
                    $flag.=$re->vcMa[$i];
                }
            }
            for($j=48;$j<=57;$j++)
            {
                if(chr($j)==$re->vcMa[$i])
                {
                    $flag.=$re->vcMa[$i];
                }
            }
            for($j=97;$j<=122;$j++)
            {
                if(chr($j)==$re->vcMa[$i])
                {
                    $flag.=$re->vcMa[$i];
                }
            }
            if(chr(32)==$re->vcMa[$i])
            {
                $flag.=$re->vcMa[$i];
            }
        }
        if(strlen($flag)==strlen($re->vcMa))
        {
            $vc->vcMa=$re->vcMa;
        }
        else
        {
            Session::flash('err','Mã không chứa ký tự đặc biệt !');
            return "<script>window.history.back();</script>";
        }
    
        $vc->vcMa=$re->vcMa;
        $checkExistVoucherName=voucher::where('vcTen',$re->vcTen)->first();
        if($checkExistVoucherName)
        {
            Session::flash('err','Voucher này đã tồn tại !');
            return "<script>window.history.back();</script>";
        }
        else
        {
            $vc->vcTen=$re->vcTen;    
        }
        
        if($re->vcSoluot<1)
        {
            Session::flash('err','Số lượt phải lớn hơn 0 !');
            return "<script>window.history.back();</script>";
        }
        $vc->vcSoluot=$re->vcSoluot;

        $vc->vcNgaybd=$re->vcNgaybd;

        if($re->vcNgaybd > $re->vcNgaykt)
        {
            Session::flash('err','Ngày kết thúc phải sau ngày bất đầu !');
            return "<script>window.history.back();</script>";
        }
        $vc->vcNgaykt=$re->vcNgaykt;
        $vc->vcLoaigiamgia=$re->vcLoaigiamgia;
        if($re->vcLoaigiamgia==0)//Theo gia
        {
            if($re->vcMucgiam<1000)// < 1000VND dong bao loi
            {
                Session::flash('err','Mức giảm giá phải lớn hơn 1000đ !');
                return "<script>window.history.back();</script>";
            }
            else
            {
                $vc->vcMucgiam=$re->vcMucgiam;        
            }
        }
        else
        {
            if($re->vcMucgiam<0)
            {
                Session::flash('err','Mức giảm phải lớn hơn 0!');
                return "<script>window.history.back();</script>";
            }
            if($re->vcMucgiam > 100)// < 1000VND dong bao loi
            {
                Session::flash('err','Phần trăm giảm giá phải nhỏ hơn hoặc bằng 100 %');
                return "<script>window.history.back();</script>";
            }
            else
            {
                $vc->vcMucgiam=$re->vcMucgiam;        
            }
        }
        if($re->vcGiatritoida<0)
        {
            Session::flash('err','Giá trị tối đa phải lớn hơn 0!');
            return "<script>window.history.back();</script>";
        }
        $vc->vcGiatritoida=$re->vcGiatritoida;
        $vc->vcLoai=$re->vcLoai;
        if($re->vcLoai==0)
        {
            if($re->checkboxsp==null)
                {
                    Session::flash('err','Vui lòng chọn 1 sản phẩm !');
                return "<script>window.history.back();</script>";
            }
            else
            {
                $vc->spMa=$re->checkboxsp;
            }
        }
        $vc->vcDkapdung=$re->vcDkapdung;
        //dd($re->vcDkapdung);
        if($re->vcDkapdung==0)
        {
            if($re->vcGtcandat!=null)
            {
                if($re->vcGtcandat>=1000)
                {
                    $vc->vcGtcandat=$re->vcGtcandat;
                }
                else
                {
                    Session::flash('err','Điều kiện áp dụng theo giá phải lớn hơn 1000đ !');
                    return "<script>window.history.back();</script>";
                }
            }
        }
        else
        {
            if($re->vcGtcandat!=null)
            {
                if($re->vcGtcandat>0)
                {
                    $vc->vcGtcandat=$re->vcGtcandat;
                }
                else
                {
                    Session::flash('err','Điều kiện áp dụng theo sản phẩm phải lớn hơn 0 !');
                    return "<script>window.history.back();</script>";
                }
            }
        }
        if($re->vcTinhtrang!=null)
        {
            $vc->vcTinhtrang=$re->vcTinhtrang;
        }
        else
        {
               $vc->vcTinhtrang=0;
        }
        $vc->save();

        //save log
        $log = new admin_log();
        $log->adMa=Session::get('adMa');
        $log->alChitiet="Thêm voucher: ".$re->vcTen;
        $log->alNgaygio=now();
        $log->save();

        Session::flash('success',"Thêm voucher: ".$re->vcTen." thành công!");
        return Redirect::to('adVoucher');

    }

    public function suaVoucherpage(Request $re)
    {
        $vc=DB::table('voucher')->where('vcMa',$re->id)->first();
        //dd($checkExistKhuyenmai);
        if(!$vc)
        {
           
            Session::flash("err","Chương trình khuyến mãi không tồn tại !");
            return redirect::to('adKhuyenmai');
        }
       
        if(Session::has('adTaikhoan'))
        {   
            $checksanpham=sanpham::leftjoin('voucher','voucher.spMa','sanpham.spMa')->join('nhacungcap','nhacungcap.nccMa','sanpham.nccMa')->join('hinh','sanpham.spMa','hinh.spMa')->join('loai','loai.loaiMa','sanpham.loaiMa')->get();
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
            
           
            return view('admin.suaVoucher',compact('vc','sanpham','noteDanhgia','noteDonhang','noteDonhang1'));
        }
        else
        {
            return Redirect('/adLogin');
        }
    }

    public function checkSuaVoucher(Request $re)
    {
        $messages =[
                'vcMa.required'=>'Mã không được để trống !',
                'vcTen.required'=>'Tên không được để trống !',
                'vcSoluot.required'=>'Số lượt không được để trống!',
                'vcNgaybd.required'=>'Nhập ngày bắt đầu !',
                'vcNgaykt.required'=>'Nhập ngày kết thúc !',
                'vcMucgiam.required'=>'Nhập mức giảm!',
                'vcGiatritoida.required'=>'Nhập giá trị tối đa!',
            ];
            $this->validate($re,[
                'vcMa'=>'required',
                'vcTen'=>'required',
                'vcSoluot'=>'required',
                'vcNgaybd'=>'required',
                'vcNgaykt'=>'required',
                 'vcMucgiam'=>'required',
                 'vcGiatritoida'=>'required'
            ],$messages);
        
        $vc=voucher::where('vcMa',$re->id)->first();
        $vc->vcTen=$re->vcTen;    
        
        
        if($re->vcSoluot<1)
        {
            Session::flash('err','Số lượt phải lớn hơn 0 !');
            return "<script>window.history.back();</script>";
        }
        $vc->vcSoluot=$re->vcSoluot;

        $vc->vcNgaybd=$re->vcNgaybd;

        if($re->vcNgaybd > $re->vcNgaykt)
        {
            Session::flash('err','Ngày kết thúc phải sau ngày bất đầu !');
            return "<script>window.history.back();</script>";
        }
        $vc->vcNgaykt=$re->vcNgaykt;
        $vc->vcLoaigiamgia=$re->vcLoaigiamgia;
        if($re->vcLoaigiamgia==0)//Theo gia
        {
            if($re->vcMucgiam<1000)// < 1000VND dong bao loi
            {
                Session::flash('err','Mức giảm giá phải lớn hơn 1000đ !');
                return "<script>window.history.back();</script>";
            }
            else
            {
                $vc->vcMucgiam=$re->vcMucgiam;        
            }
        }
        else
        {
            if($re->vcMucgiam<0)
            {
                Session::flash('err','Mức giảm phải lớn hơn 0!');
                return "<script>window.history.back();</script>";
            }
            if($re->vcMucgiam > 100)// < 1000VND dong bao loi
            {
                Session::flash('err','Phần trăm giảm giá phải nhỏ hơn hoặc bằng 100 %');
                return "<script>window.history.back();</script>";
            }
            else
            {
                $vc->vcMucgiam=$re->vcMucgiam;        
            }
        }
        if($re->vcGiatritoida<0)
        {
            Session::flash('err','Giá trị tối đa phải lớn hơn 0!');
            return "<script>window.history.back();</script>";
        }
        $vc->vcGiatritoida=$re->vcGiatritoida;
        $vc->vcLoai=$re->vcLoai;
        if($re->vcLoai==0)
        {
            if($re->checkboxsp==null)
                {
                    Session::flash('err','Vui lòng chọn 1 sản phẩm !');
                return "<script>window.history.back();</script>";
            }
            else
            {
                $vc->spMa=$re->checkboxsp;
            }
        }
        $vc->vcDkapdung=$re->vcDkapdung;
   
        if($re->vcDkapdung==0)
        {
            if($re->vcGtcandat!=null)
            {
                if($re->vcGtcandat>=1000)
                {
                    $vc->vcGtcandat=$re->vcGtcandat;
                }
                else
                {
                    Session::flash('err','Điều kiện áp dụng theo giá phải lớn hơn 1000đ !');
                    return "<script>window.history.back();</script>";
                }
            }
        }
        else
        {
            if($re->vcGtcandat!=null)
            {
                if($re->vcGtcandat>0)
                {
                    $vc->vcGtcandat=$re->vcGtcandat;
                }
                else
                {
                    Session::flash('err','Điều kiện áp dụng theo sản phẩm phải lớn hơn 0 !');
                    return "<script>window.history.back();</script>";
                }
            }
        }
        if($re->vcTinhtrang!=null)
        {
            $vc->vcTinhtrang=$re->vcTinhtrang;
        }
        else
        {
               $vc->vcTinhtrang=0;
        }
        $vc->update();

        //save log
        $log = new admin_log();
        $log->adMa=Session::get('adMa');
        $log->alChitiet="Sửa voucher: ".$re->vcTen;
        $log->alNgaygio=now();
        $log->save();

        Session::flash('success',"Sửa voucher: ".$re->vcTen." thành công!");
        return Redirect::to('adVoucher');

    }

    public function switchStatusVc(Request $re)
    {
        if(Session::has('adMa'))
        {
            $adInfo=admin::where('adMa',Session::get('adMa'))->first();
            if($adInfo && $adInfo->adQuyen==1)
            {
                $checkExistVoucher=voucher::Where('vcMa',$re->id)->first();
                if($checkExistVoucher)
                {
                    if($checkExistVoucher->vcTinhtrang!=0)
                    {
                        $checkExistVoucher->vcTinhtrang=0;
                        $checkExistVoucher->update();
                        Session::flash('success','Đã đổi tình trạng voucher: '.$checkExistVoucher->vcTen." thành Ẩn.");
                        $log= new admin_log();
                        $log->adMa=Session::get('adMa');
                        $log->alChitiet='Đổi trạng thái voucher: '.$checkExistVoucher->vcTen.' thành Ẩn.';
                        $log->alNgaygio=now();
                        $log->save();
                    }
                    else
                    {
                        $checkExistVoucher->vcTinhtrang=1;
                        $checkExistVoucher->update();
                        Session::flash('success','Đã đổi tình trạng voucher: '.$checkExistVoucher->vcTen." thành Hiện.");
                        $log= new admin_log();
                        $log->adMa=Session::get('adMa');
                        $log->alChitiet='Đổi trạng thái voucher: '.$checkExistVoucher->vcTen.' thành Hiện.';
                        $log->alNgaygio=now();
                        $log->save();
                    }
                }
                else
                {
                    Session::flash('err','Voucher không tồn tại !');
                }
                return redirect::to('adVoucher');
            }
            else
            {
                Session::flash('err','Bạn không có quyền này !');
                return "<script>window.history.back();</script>";
            }
        }
    }

    public function adDeleteVoucher(Request $re)
    {
        $vcInfo=voucher::where('vcMa',$re->id)->first();
        if(!$vcInfo)
        {
            Session::flash('err',"Voucher không tồn tại !");
            return "<script>window.history.back();</script>";
        }
        $vcInfo->vcTinhtrang=99;
        //
        $ad_log=new admin_log();
        $ad_log->adMa=Session::get('adMa');
        $ad_log->alChitiet='Xóa voucher: '.$vcInfo->vcTen;
        $ad_log->alNgaygio=now();
        $ad_log->save();
        Session::flash('success',"Đã xóa voucher: ".$vcInfo->vcTen);
        $vcInfo->update();
        return redirect('adVoucher');
    }


    public function khoaNhanvien($id)
    {
         $dbOld = DB::table('admin')->select('adTen')->where('adMa',$id)->first();
          $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Khóa nhân viên: ".$dbOld->adTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);
        

        $data = array();
        $data['adTinhtrang']=0;
        DB::table('admin')->where('adMa',$id)->update($data);
         return redirect('adNhanvien');
    }
     public function moKhoaNhanvien($id)
    {
        $dbOld = DB::table('admin')->where('adMa',$id)->first();
        $data1 = array();
        $data1['adMa'] = Session::get('adMa');
        $data1['alChitiet'] = "Mở khóa nhân viên:".$dbOld->adTen;
        $data1['alNgaygio']= now();
        DB::table('admin_log')->insert($data1);
        

        $data = array();
        $data['adTinhtrang']=1;
        DB::table('admin')->where('adMa',$id)->update($data);
         return redirect('adNhanvien');
    }


    public function themTintuc()
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);

        return view('admin.them-tin-tuc')
                                ->with('noteDanhgia',$noteDanhgia)
                                ->with('noteDonhang',$noteDonhang)
                                ->with('noteDonhang1',$noteDonhang1);
    }
     public function adCheckAddTT(Request $re)
    {
        if($re->hasFile('ttHinh')==true)
        {
          
            $data = array();
            $data['ttMa'] = rand(0,1000).strlen($re->ttTieude).strlen($re->ttNoidung);
            $data['ttTieude'] = $re->ttTieude;
            $data['ttGioithieu'] = $re->ttGioithieu;
            $data['ttNoidung'] = $re->ttNoidung;
            $data['ttLoai'] =$re->ttLoai; 
            $data['ttHinh'] = $re->file('ttHinh')->getClientOriginalName();
                $imgextention=$re->file('ttHinh')->extension();
                $file=$re->file('ttHinh');
                $file->move('public/images/tintuc',$data['ttHinh']);
            $data['ttNgaydang'] = now();
            $data['ttTinhtrang'] =0;
            $data['ttLuotxem'] =0;
            $data['adMa'] =SESSION::get('adMa');
            DB::table('tintuc')->insert($data);

            $data1 = array();
            $data1['adMa'] = Session::get('adMa');
            $data1['alChitiet'] = "Thêm tin tức tiêu đề: ".$re->ttTieude;
            $data1['alNgaygio']= now();
            DB::table('admin_log')->insert($data1);

            return redirect('tin-tuc');
        }
        else
        {
            Session::flash('note_err','Vui lòng thêm hình chủ đề cho tin tức');
            return "<script>window.history.back();</script>";
       }
    }
    public function adUpdateTintuc($id)
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);
        $data = DB::table('tintuc')->where('ttMa',$id)->get();
        return view('admin.cap-nhat-tin-tuc')
                                ->with('data',$data)
                                ->with('noteDanhgia',$noteDanhgia)
                                ->with('noteDonhang',$noteDonhang)
                                ->with('noteDonhang1',$noteDonhang1);
    }
    public function editTintuc(Request $re,$id)
    {
        if($re->hasFile('ttHinh')==true)
        {
        $data = array();
        $data['ttTieude'] = $re->ttTieude;
        $data['ttGioithieu'] = $re->ttGioithieu;
        $data['ttNoidung'] = $re->ttNoidung;
        $data['ttLoai'] =$re->ttLoai; 
        $data['ttHinh'] = $re->file('ttHinh')->getClientOriginalName();
            $imgextention=$re->file('ttHinh')->extension();
            $file=$re->file('ttHinh');
            $file->move('public/images/tintuc',$data['ttHinh']);
        $data['ttTinhtrang'] = $re->ttTinhtrang;
        DB::table('tintuc')->where('ttMa',$id)->update($data);

        $data1 = array();
        $data1['adMa'] = Session::get('adMa');
        $data1['alChitiet'] = "Cập nhật tin tức tiêu đề ".$re->ttTieude;
        $data1['alNgaygio']= now();
        DB::table('admin_log')->insert($data1);

        return redirect('tin-tuc');
        }
        else
        {
        $data = array();
        $data['ttTieude'] = $re->ttTieude;
        $data['ttGioithieu'] = $re->ttGioithieu;
        $data['ttNoidung'] = $re->ttNoidung;
        $data['ttLoai'] =$re->ttLoai; 
        $data['ttTinhtrang'] = $re->ttTinhtrang;
        DB::table('tintuc')->where('ttMa',$id)->update($data);

        $data1 = array();
        $data1['adMa'] = Session::get('adMa');
        $data1['alChitiet'] = "Cập nhật tin tức tiêu đề ".$re->ttTieude;
        $data1['alNgaygio']= now();
        DB::table('admin_log')->insert($data1);

        return redirect('tin-tuc');
        }
    }
    public function deleteTintuc($id)
    { 
        $dbOld = DB::table('tintuc')->select('ttTieude')->where('ttMa',$id)->first();
        $data1 = array();
        $data1['adMa'] = Session::get('adMa');
        $data1['alChitiet'] = "Xóa tin tức tiêu đề: ".$dbOld->ttTieude;
        $data1['alNgaygio']= now();
        DB::table('admin_log')->insert($data1);

        DB::table('tintuc')->where('ttMa',$id)->delete();
        return response()->json(['message'=>0]);
    }



        //Banner
     public function vitriBanner()
     {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);

            return view('admin.vi-tri-banner')
                                ->with('noteDanhgia',$noteDanhgia)
                                ->with('noteDonhang',$noteDonhang)
                                ->with('noteDonhang1',$noteDonhang1);
     }
      public function themBanner($id)
     {
         $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);

            $vitri = $id;

            return view('admin.them-banner',compact('vitri'))
                                ->with('noteDanhgia',$noteDanhgia)
                                ->with('noteDonhang',$noteDonhang)
                                ->with('noteDonhang1',$noteDonhang1);
     }
      public function adCheckAddBanner(Request $re,$vitri)
      {
             if($re->hasFile('bnHinh'))
            {
                    $data = array();
                    $data['bnMa']= time();
                    $data['bnTieude']= $re->bnTieude;
                    $data['bnNoidung']= $re->bnNoidung;
                    $data['bnHinh'] = $re->file('bnHinh')->getClientOriginalName();
                        $imgextention = $re->file('bnHinh')->extension();
                        $file = $re->file('bnHinh');
                        $file->move('public/images/banners',$data['bnHinh']);
                    $data['bnNgay']= now();
                    $data['bnVitri']= $vitri;
                    $data['bnTrangthai']= $re->bnTrangthai;
                    DB::table('slide')->insert($data);
                   
                    return redirect('adBanner/'.$vitri);
            }
            // else
            // {
            //     Session::put('bnError',"Vui lòng thêm hình");
            //     return redirect('themBanner');
            // }
      }
      public function adDeleteBanner($id)
      {
        DB::table('slide')->where('bnMa',$id)->delete();
       
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
            DB::table('slide')->where('bnMa',$id)->update($data);
            return redirect('adBanner');
        }
      }
       //endbanner
      //Kho
      public function viewCTKho($id)
      {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);

        $data = DB::table('serial')->join('sanpham','sanpham.spMa','=','serial.spMa')->get();
        return view('admin.chi-tiet-kho')->with('data',$data);
      }


}


