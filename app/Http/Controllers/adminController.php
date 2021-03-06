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
use App\Models\phieunhap_ser;
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
            $total_sp = DB::table('sanpham')->count();
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
                $total_sp = DB::table('sanpham')->count();
                $dh = DB::table('donhang')->where('hdTinhtrang',2)->count();
                $total_price = DB::table('donhang')->where('hdTinhtrang',2)->sum('hdTongtien');
                $total_pay = DB::table('phieunhap')->sum('pnTongtien');
            return view('admin.index',compact('nv','sp','dh','total_price','total_sp','total_pay','noteDonhang','noteDonhang1','noteDanhgia'));
            }
            else
            {
                Session::flash('note_err','T??n t??i kho???n ho???c m???t kh???u kh??ng ch??nh x??c!');
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
        

   public function viewBanner($trang,$vitri)
    {
         if(Session::has('adTaikhoan'))
        {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);

            $vtTopdb = DB::table('slide')->select('bnVitri')
                    ->where('bnTrang',$trang)->orderBy('bnVitri','asc')->limit(1)->get();
          
           $vtDB = DB::table('slide')->select('bnVitri')
                    ->where('bnTrang',$trang)->orderBy('bnVitri','asc')->limit(1)->first();
            $vtDb = $vtDB->bnVitri;
             $page = $trang;
            $vtEmpty = DB::table('slide')
                    ->where('bnTrang',$trang)->count();

            $vt1Empty = DB::table('slide')
                    ->where('bnVitri',1)
                    ->where('bnTrang',$trang)->count();

            $vt = DB::table('slide')->select('bnVitri')
                    ->where('bnTrang',$trang)
                    ->orderBy('bnVitri','asc')->get();

            $default = DB::table('slide')
                    ->select('bnVitri')
                    ->where('bnVitri',$vitri)
                    ->where('bnTrang',$trang)->get();

            $default2 = DB::table('slide')
                    ->select('bnVitri')
                    ->where('bnVitri',$vitri)
                    ->where('bnTrang',$trang)->first();
           
           if($vitri == 1 && $vitri != $vtDB)
           {
              $data = DB::table('slide')->where('bnVitri',$vtDb)
                    ->where('bnTrang',$trang)
                    ->orderBy('bnNgay','desc')->get();
             return view('admin.banner')->with('data',$data)
                                        ->with('page',$page)
                                        ->with('vtEmpty',$vtEmpty)
                                        ->with('vt1Empty',$vt1Empty)
                                        ->with('vtTop',$vtTopdb)
                                        ->with('vtDefault',$default)
                                        ->with('vtDefault2',$default2)
                                        ->with('vitri',$vt)
                                        ->with('noteDanhgia',$noteDanhgia)
                                        ->with('noteDonhang',$noteDonhang)
                                        ->with('noteDonhang1',$noteDonhang1);
           }
           elseif($vitri != 1 && $vitri != $vtDB)
           {
            $data = DB::table('slide')->where('bnVitri',$vitri)
                    ->where('bnTrang',$trang)
                    ->orderBy('bnNgay','desc')->get();
             return view('admin.banner')->with('data',$data)
                                        ->with('page',$page)
                                        ->with('vtEmpty',$vtEmpty)
                                        ->with('vt1Empty',$vt1Empty)
                                        ->with('vtTop',$vtTopdb)
                                        ->with('vtDefault',$default)
                                        ->with('vtDefault2',$default2)
                                        ->with('vitri',$vt)
                                        ->with('noteDanhgia',$noteDanhgia)
                                        ->with('noteDonhang',$noteDonhang)
                                        ->with('noteDonhang1',$noteDonhang1);
           }
           elseif($vitri == 1 && $vitri != $vtDB)
           {
            $data = DB::table('slide')->where('bnVitri',$vitri)
                    ->where('bnTrang',$trang)
                    ->orderBy('bnNgay','desc')->get();
             return view('admin.banner')->with('data',$data)
                                        ->with('page',$page)
                                        ->with('vtEmpty',$vtEmpty)
                                        ->with('vt1Empty',$vt1Empty)
                                        ->with('vtTop',$vtTopdb)
                                        ->with('vtDefault',$default)
                                        ->with('vtDefault2',$default2)
                                        ->with('vitri',$vt)
                                        ->with('noteDanhgia',$noteDanhgia)
                                        ->with('noteDonhang',$noteDonhang)
                                        ->with('noteDonhang1',$noteDonhang1);
           }
           

           
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
                            ->where('alChitiet','like','%'.'Giao h??ng:'.'%')
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
    

    // Nh??n vi??n
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
                'adTen.required'=>'T??n nh??n vi??n kh??ng ???????c ????? tr???ng',
                'adTaikhoan.required'=>'T??i kho???n nh??n vi??n kh??ng ???????c ????? tr???ng',
                'adMatkhau.required'=>'M???t kh???u nh??n vi??n kh??ng ???????c ????? tr???ng',
                'adSdt.required'=>'S??? ??i???n tho???i nh??n vi??n kh??ng ???????c ????? tr???ng',
                'adEmail.required'=>'Email nh??n vi??n kh??ng ???????c ????? tr???ng',
                'adQuyen.required'=>'Quy???n ch???c v??? nh??n vi??n kh??ng ???????c ????? tr???ng',
                
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
             Session::flash('note_err','S??? ??i???n tho???i sai! Vui l??ng nh???p l???i!');
             return "<script>window.history.back();</script>"; 
        }
        else
         {
            $dataBefore1 = DB::table('admin')->where('adTaikhoan',$re->adTaikhoan)->first();
            $dataBefore2 = DB::table('admin')->where('adEmail',$re->adEmail)->first();
            $dataBefore3 = DB::table('admin')->where('adSdt',$re->adSdt)->first();
            if($dataBefore1)
            {
                Session::flash('note_err','T??i kho???n ???? t???n t???i, vui l??ng nh???p t??i kho???n kh??c!');
              return "<script>window.history.back();</script>";
            
            }
            else if( $dataBefore2)
            {
                Session::flash('note_err','Email ???? t???n t???i, vui l??ng nh???p email kh??c!');
               return "<script>window.history.back();</script>";
            }
            else if( $dataBefore3)
            {
                Session::flash('note_err','S??? ??i???n tho???i ???? t???n t???i, vui l??ng nh???p s??? kh??c!');
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
                    $data1['alChitiet'] = "Th??m nh??n m???i: ".$re->adTen;
                    $data1['alNgaygio']= now();
                    DB::table('admin_log')->insert($data1);

                    Session::forget('ad_err');
                    return redirect('adNhanvien');
                    }
                    else
                    {
                    Session::flash("note_err","H??nh c???a nh??n vi??n kh??ng ???????c tr???ng!");
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
                $data1['alChitiet'] = "X??a nh??n vi??n:".$db->adTen;
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
                'adTen.required'=>'T??n nh??n vi??n kh??ng ???????c ????? tr???ng',
                'adTaikhoan.required'=>'T??i kho???n nh??n vi??n kh??ng ???????c ????? tr???ng',
                'adMatkhau.required'=>'M???t kh???u nh??n vi??n kh??ng ???????c ????? tr???ng',
                'adSdt.required'=>'S??? ??i???n tho???i nh??n vi??n kh??ng ???????c ????? tr???ng',
                'adEmail.required'=>'Email nh??n vi??n kh??ng ???????c ????? tr???ng',
                'adQuyen.required'=>'Quy???n nh??n vi??n kh??ng ???????c ????? tr???ng',
                
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
             Session::flash('note_err','S??? ??i???n tho???i sai! Vui l??ng nh???p l???i!');
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
                $data1['alChitiet'] = "C???p nh???t nh??n vi??n:".$adTen."->".$re->adTen;
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
                $data1['alChitiet'] = "C???p nh???t nh??n vi??n:".$adTen."->".$re->adTen;
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

    // End Nh??n vi??n
    //  Khach h??ng
      public function themkhachhang()
    {
        return view('admin.themkhachhang');
    }
    public function adCheckAddKhachhang(Request $re)
    {
        if($re->khTen ==null||$re->khTaikhoan == null||$re->khMatkhau == null||$re->khEmail==null||$re->khDiachi==null||$re->khNgaysinh==null||$re->khGioitinh==null||$re->khQuyen==null)
        {
            $messages =[
                'khTen.required'=>'T??n kh??ch h??ng kh??ng ???????c ????? tr???ng',
                'khTaikhoan.required'=>'T??i kho???n kh??ch h??ng kh??ng ???????c ????? tr???ng',
                'khMatkhau.required'=>'M???t kh???u kh??ch h??ng kh??g ???????c ????? tr???ng',
                'khEmail.required'=>'Email kh??ch h??ng kh??ng ???????c ????? tr???ng',
                'khQuyen.required'=>'Quy???n kh??ch h??ng kh??ng ???????c ????? tr???ng',
                'khDiachi.required'=>'?????a ch??? kh??ch h??ng kh??ng ???????c ????? tr???ng',
                'khNgaysinh.required'=>'Ng??y sinh h??ng kh??ng ???????c ????? tr???ng',
                'khGioitinh.required'=>'Gi???i t??nh kh??ch h??ng kh??ng ???????c ????? tr???ng',
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
                   Session::flash('note_err','Kh??ch h??ng ph???i tr??n 10 tu???i');
                   return "<script>window.history.back();</script>"; 
                }
                if($dataBefore1)
                {
                    Session::flash('note_err','T??i kho???n ???? t???n t???i, vui l??ng nh???p t??i kho???n kh??c!');
                   return "<script>window.history.back();</script>"; 
                }
                else if( $dataBefore2)
                {
                    Session::flash('note_err','Email ???? t???n t???i, vui l??ng nh???p email kh??c!');
                  return "<script>window.history.back();</script>"; 
                }
                else if( $dataBefore3)
                {
                    Session::flash('note_err','S??? ??i???n tho???i ???? t???n t???i, vui l??ng nh???p s??? kh??c!');
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
                'khTen.required'=>'T??n kh??ch h??ng kh??ng ???????c ????? tr???ng',
                'khTaikhoan.required'=>'T??i kho???n kh??ch h??ng kh??ng ???????c ????? tr???ng',
                'khMatkhau.required'=>'M???t kh???u kh??ch h??ng kh??ng ???????c ????? tr???ng',
                'khSdt.required'=>'Sdt kh??ch h??ng kh??ng ???????c ????? tr???ng',
                'khEmail.required'=>'Email kh??ch h??ng kh??ng ???????c ????? tr???ng',
                'khQuyen.required'=>'Quy???n kh??ch h??ng kh??ng ???????c ????? tr???ng',
                'khDiachi.required'=>'?????a ch??? kh??ch h??ng kh??ng ???????c ????? tr???ng',
                'khNgaysinh.required'=>'Ng??y sinh h??ng kh??ng ???????c ????? tr???ng',
                'khGioitinh.required'=>'Gi???i t??nh kh??ch h??ng kh??ng ???????c ????? tr???ng',
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
                Session::flash('note_err','Kh??ch h??ng ph???i tr??n 10 tu???i');
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

    // End kh??ch h??ng
    
    // S???n ph???m
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
                'spTen.required'=>'S???n ph???m kh??ng ???????c ????? tr???ng',
                'spHanbh.required'=>'H???n b???o h??nh kh??ng ???????c ????? tr???ng',
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
                    Session::flash('note_err','S???n ph???m ???? c?? s???n trong d??? li???u!');
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
                $data['kmMa']=$re->kmMa;
                $data['thMa']=$re->thMa;
                $data['loaiMa']=$re->loaiMa;
                $data['ncMa']=$re->ncMa;
                $data['nccMa']=$re->nccMa;
                $data['kmMa']=$re->kmMa;
                
                DB::table('sanpham')->insert($data);

                $dataLog = array();
                $dataLog['adMa'] = Session::get('adMa');
                $dataLog['alChitiet'] = "Th??m s???n ph???m m???i:".$re->spTen;
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
                $data1['alChitiet'] = "X??a s???n ph???m: ".$db->spTen;
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
               
                'spTen.required'=>'S???n ph???m kh??ng ???????c ????? tr???ng',
                'spHanbh.required'=>'H???n b???o h??nh kh??ng ???????c ????? tr???ng',
                'ram.required'=>'Ram kh??ng ???????c ????? tr???ng',
                'ocung.required'=>'??? c???ng kh??ng ???????c ????? tr???ng',
                'cpu.required'=>'CPU kh??ng ???????c ????? tr???ng',
                
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
                $dataLog['alChitiet'] = "C???p nh???t s???n ph???m:".$re->spTen;
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
                Session::forget('img_err','Ch??a ch???n ???nh!');
                return redirect('/updateSanpham/'.$re->spMa);
        }
        else
        {
        Session::put('img_err','Ch??a ch???n ???nh!');
        return redirect('/updateSanpham/'.$re->spMa);

        }
    }
    public function deleteHinhSanpham($tenhinh,$id)
    {
        
        DB::table('hinh')->where('spHinh',$tenhinh)->delete();
        return redirect('/updateSanpham/'.$id);

    }
    //End s???n ph???m
   

    //Loai
    public function adCheckAddLoai(Request $re)
    {
        if($re->loaiTen == null)
        {
            Session::forget('loai_err');
            $messages =[
                'loaiTen.required'=>'T??n lo???i kh??ng ???????c ????? tr???ng',
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
                Session::flash('note_err',"Lo???i ???? t???n t???i!");
                return "<script>window.history.back();</script>"; 
            }
            else
            {
                $data = array();

                $data['loaiTen']=$re->loaiTen;
                DB::table('loai')->insert($data);

                $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Th??m lo???i m???i:".$re->loaiTen;
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
             //Session::flash('note_err','???? c?? s???n ph???m thu???c lo???i n??y, kh??ng ???????c x??a!');
            return response()->json(['message'=>1]);
        }
        else
        {
        $dbOld = DB::table('loai')->select('loaiTen')->where('loaiMa',$id)->first();
               
          $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "X??a lo???i:".$dbOld->loaiTen;
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
            Session::flash('note_err','Kh??ng ???????c ????? r???ng!');
            return "<script>window.history.back();</script>"; 
        }
        else
        {
                $dbOld = DB::table('loai')->select('loaiTen')->where('loaiMa',$id)->first();
               
                $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "S???a lo???i:".$dbOld->loaiTen."->".$re->loaiTen;
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
                'ncTen.required'=>'Nhu c???u kh??ng ???????c ????? tr???ng',
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
                Session::flash('note_err',"Nhu c???u ???? t???n t???i!");
                 return "<script>window.history.back();</script>"; 
            }
            else
            {
            $data = array();
            $data['ncTen']=$re->ncTen;
            DB::table('nhucau')->insert($data);

               $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Th??m nhu c???u m???i:".$re->ncTen;
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
             Session::flash('note_err','???? c?? s???n ph???m thu???c nhu c???u n??y, kh??ng ???????c x??a!');
            return "<script>window.history.back();</script>"; 
        }
        else
        {
         $db = DB::table('nhucau')->select('ncTen')->where('ncMa',$id)->first();
          $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "X??a nhu c???u:".$db->ncTen;
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
            Session::flash('note_err','Kh??ng ???????c ????? r???ng!');
             return "<script>window.history.back();</script>"; 
        }
        else
        {
             $db = DB::table('nhucau')->select('ncTen')->where('ncMa',$id)->first();
                    
                $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "S???a nhu c???u:".$db->ncTen."->".$re->ncTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);

            $data = array();
            $data['ncTen'] = $re->ncTen;
            DB::table('nhucau')->where('ncMa',$id)->update($data);
            return redirect('adNhucau');
        }
    }
    //End nhu cau
    

    //Th????ng hi???u
   
    public function adCheckAddThuonghieu(Request $re)
    {
        if($re->thTen == null)
        {
            $messages =[
                'thTen.required'=>'T??n th????ng hi???u kh??ng ???????c ????? tr???ng',
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
                Session::flash('note_err',"Th????ng hi???u ???? t???n t???i!");
                return "<script>window.history.back();</script>"; 
            }
            else
            {
                $data = array();

                $data['thTen']=$re->thTen;
                DB::table('thuonghieu')->insert($data);
                
                $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Th??m th????ng hi???u m???i:".$re->thTen;
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
             Session::flash('note_err','???? c?? s???n ph???m thu???c th????ng hi???u n??y, kh??ng ???????c x??a!');
            return "<script>window.history.back();</script>"; 
        }
        else
        {
        $db = DB::table('thuonghieu')->select('thTen')->where('thMa',$id)->first();
       
          $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "X??a th????ng hi???u:".$db->thTen;
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
            Session::flash('note_err','Kh??ng ???????c ????? r???ng!');
             return "<script>window.history.back();</script>"; 
        }
        else
        {
             $db = DB::table('thuonghieu')->select('thTen')->where('thMa',$id)->first();
                    
                $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "S???a th????ng hi???u:".$db->thTen."->".$re->thTen;
                $data1['alNgaygio']= now();
                DB::table('admin_log')->insert($data1);

            $data = array();
            $data['thTen'] = $re->thTen;
            DB::table('thuonghieu')->where('thMa',$id)->update($data);
            return redirect('adThuonghieu');
        }
        
    }
    //end th????ng hi???u

  //Khuy???n m??i
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
                'kmTen.required'=>'T??n kh??ng ???????c ????? tr???ng !',
                'kmTrigia.required'=>'Gi?? tr??? khuy???n m??i kh??ng ???????c ????? tr???ng !',
                'kmMota.required'=>'M?? t??? kh??ng ???????c ????? tr???ng !',
                'kmNgaybd.required'=>'Vui l??ng nh???p ng??y b???t ?????u khuy???n m??i !',
                'kmNgaykt.required'=>'Vui l??ng nh???p ng??y k???t th??c khuy???n m??i !',
                'checkboxsp.required'=>'Vui l??ng ch???n ??t nh???t 1 s???n ph???m!'
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
                //     Session::flash('err','Khuy???n m??i n??y ???? t???n t???i');
                //     return "<script>window.history.back();</script>";
                // }
                $km->kmTen=$re->kmTen;
                if($re->kmTrigia<1)
                {
                    Session::flash('err',"Gi?? tr??? khuy???n m??i ph???i l???n h??n 1 ");
                    return "<script>window.history.back();</script>";
                }
                elseif($re->kmTrigia>100)
                {
                    Session::flash('err',"Gi?? tr??? khuy???n m??i ph???i nh??? h??n 100 !");
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
                Session::flash('err',"Ng??y k???t th??c ph???i sau ng??y b???t ?????u !");
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
                Session::flash('success','Th??m th??nh c??ng !');
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
                $ad_log->alChitiet="Th??m khuy???n m??i: ".$re->kmTen.'; S???n ph???m ???????c ??p d???ng: '.$list;
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
            Session::flash('err',"Khuy???n m??i kh??ng t???n t???i !");
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
        $ad_log->alChitiet='X??a ch????ng tr??nh khuy???n m??i: '.$promoInfo->kmTen.':'.$promoInfo->kmMota;
        $ad_log->alNgaygio=now();
        $ad_log->save();
        Session::flash('success',"???? x??a khuy???n m??i: ".$promoInfo->kmTen);
        $promoInfo->update();
        return redirect('adKhuyenmai');
      }

     

      public function suaKhuyenmaipage(Request $re)
      {
        $km=khuyenmai::where('kmMa',$re->id)->first();
        //dd($checkExistKhuyenmai);
        if(!$km)
        {
           
            Session::flash("err","Ch????ng tr??nh khuy???n m??i kh??ng t???n t???i !");
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
                'kmTen.required'=>'T??n kh??ng ???????c ????? tr???ng !',
                'kmTrigia.required'=>'Gi?? tr??? khuy???n m??i kh??ng ???????c ????? tr???ng !',
                'kmMota.required'=>'M?? t??? kh??ng ???????c ????? tr???ng !',
                'kmNgaybd.required'=>'Vui l??ng nh???p ng??y b???t ?????u khuy???n m??i !',
                'kmNgaykt.required'=>'Vui l??ng nh???p ng??y k???t th??c khuy???n m??i !',
                'checkboxsp.required'=>'Vui l??ng ch???n ??t nh???t 1 s???n ph???m!'
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
                    $kmTenOld='T??n: '.$km->kmTen.' => ' .$re->kmTen.'; ';
                    $km->kmTen=$re->kmTen;
                    $checkFixed++;    
                }
                
                if($re->kmTrigia<1)
                {
                    Session::flash('err',"Gi?? tr??? khuy???n m??i ph???i l???n h??n 1 ");
                    return "<script>window.history.back();</script>";
                }
                elseif($re->kmTrigia>100)
                {
                    Session::flash('err',"Gi?? tr??? khuy???n m??i ph???i nh??? h??n 100 !");
                    return "<script>window.history.back();</script>";
                }
                if($km->kmTrigia!=$re->kmTrigia)
                {
                    $kmTrigiaOld='Tr??? gi??: '.$km->kmTrigia.' => '.$re->kmTrigia.'; ';
                    $km->kmTrigia=$re->kmTrigia;
                    $checkFixed++; 
                }
                if($km->kmMota!=$re->kmMota)
                {
                    $kmMotaOld='M?? t???: '.$km->kmMota.' => '.$re->kmMota.'; ';
                    $km->kmMota=$re->kmMota;
                    $checkFixed++; 
                }
                
                $today=date_create();
  
                    if($re->kmNgaybd <= $re->kmNgaykt)
                    {
                        if($km->kmNgaybd!=$re->kmNgaybd)
                        {
                            $kmNgaybdOld='Ng??y b???t ?????u: '.$km->kmNgaybd.' => ' .$re->kmNgaybd.'; ';
                            $km->kmNgaybd=$re->kmNgaybd;
                            $checkFixed++;  
                        }
                        
                        if($km->kmNgaykt!=$re->kmNgaykt)
                        {
                            $kmNgayktOld='Ng??y k???t th??c: '.$km->kmNgaykt.' => ' .$re->kmNgaykt.'; ';
                            $km->kmNgaykt=$re->kmNgaykt;   
                            $checkFixed++; 
                        }
                        
                    }
                    else
                    {
                        Session::flash('err',"Ng??y k???t th??c ph???i sau ng??y b???t ?????u !");
                        return "<script>window.history.back();</script>";
                    }
               
                if($km->kmSoluong!=$re->kmSoluong)
                {
                    if($re->kmSoluong!=null)
                    {
                        $kmSoluongOld='S??? l?????ng khuy???n m??i: '.$km->kmSoluong.' => ' .$re->kmSoluong.'; ';
                        $km->kmSoluong=$re->kmSoluong;
                        $checkFixed++; 
                    }
                    else
                    {
                        $kmSoluongOld='S??? l?????ng khuy???n m??i: '.$km->kmSoluong.' => Kh??ng gi???i h???n.'.'; ';
                        $km->kmSoluong=null;
                        $checkFixed++; 
                    }
                }
                
                if($km->kmGioihanmoikh!=$re->kmGioihanmoikh)
                {
                    if($re->kmGioihanmoikh!=null)
                    {
                        $kmGioihanmoikhOld='Gi???i h???n m???i kh??ch h??ng: '.$km->kmGioihanmoikh.' => ' .$re->kmGioihanmoikh.'; ';
                        $km->kmGioihanmoikh=$re->kmGioihanmoikh;
                        $checkFixed++; 
                    }
                    else
                    {
                        $kmGioihanmoikhOld='Gi???i h???n m???i kh??ch h??ng: '.$km->kmGioihanmoikh.' => Kh??ng gi???i h???n.'.'; ';
                        $km->kmGioihanmoikh=null;
                        $checkFixed++; 
                    }
                }
                if($km->kmGiatritoida!=$re->kmGiatritoida)
                {
                    $kmGiatritoidaOld='G??a tri t???i ??a ???????c khuy???n m??i: '.$km->kmGiatritoida.' => '.$re->kmGiatritoida.'; ';
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

                Session::flash('success','S???a th??nh c??ng !');
                $km->update();
                //Remove this promotion for product
                $sp=sanpham::where('kmMa',$re->id)->get();
                $removelist="S???n ph???m ???? x??a kh???i khuy???n m??i: ";
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

                    $ad_log->alChitiet="S???a khuy???n m??i: ".$re->kmTen.'; './*$removelist.*/'; '.'S???n ph???m ???????c ??p d???ng: '.$addlist.'; '.$kmTenOld.$kmMotaOld.$kmTrigiaOld.$kmNgaybdOld.$kmNgayktOld.$kmSoluongOld.$kmGioihanmoikhOld.$kmGiatritoidaOld;
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
                        $log->alChitiet='?????i tr???ng th??i khuy???n m??i: '.$checkExistKhuyenmai->kmTen.' th??nh ???n.';
                        $log->alNgaygio=now();
                        $log->save();
            }
            else
            {
                $checkExistKhuyenmai->kmTinhtrang=1;
                $checkExistKhuyenmai->update();
                $log= new admin_log();
                        $log->adMa=Session::get('adMa');
                        $log->alChitiet='?????i tr???ng th??i khuy???n m??i: '.$checkExistKhuyenmai->kmTen.' th??nh ???n.';
                        $log->alNgaygio=now();
                        $log->save();
            }
        }
        else
        {
            Session::flash('err','Khuy???n m??i kh??ng t???n t???i !');
        }
        return redirect::to('adKhuyenmai');
      }
//end khuy???n m??i  

  //B??nh lu???n ????nh gi??
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
  //H??a ????n
 
  public function giaohang(Request $re,$id)
  {
    $data = array();
    $data["hdTinhtrang"]=1;
    $data["adMa"]=$re->hdNhanvien;
    DB::table('donhang')->where('hdMa',$id)->update($data);

    $nv = DB::table('admin')->where('adMa',$re->hdNhanvien)->first();
  
    $data1 = array();
    $data1['adMa'] = Session::get('adMa');
    $data1['alChitiet'] = "Giao h??ng: nh??n vi??n ".$nv->adTen." nh???n ????n h??ng c?? m?? ".$id;
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
  //b??o c??o
   public function updateBaocao(Request $re)
  {
    if($re->dateStart > $re->dateEnd)
    {
        Session::flash("note_err","Ng??y b???t ?????u kh??ng ???????c l???n h??n ng??y k???t th??c");
         return "<script>window.history.back();</script>";   
    }
    else if($re->dateStart==null || $re->dateEnd==null)
    {
        Session::flash("note_err","Ng??y b???t ?????u v?? ng??y k???t th??c kh??ng ???????c tr???ng");
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
                $data1['alChitiet'] = "L???p b??o c??o t???:".$re->dateStart." ?????n ".$re->dateEnd;
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


  // Nh?? cung c???p
    
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
                'nccTen.required'=>'T??n nh?? cung c???p kh??ng ???????c ????? tr???ng.',
                'nccDiachi.required'=>'?????a ch??? kh??ng ???????c ????? tr???ng.',
                'nccSdt.required'=>'S??? ??i???n tho???i kh??ng ???????c ????? tr???ng.'
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
                Session::flash('err','Nh?? cung c???p ???? t???n t???i !');
                return "<script>window.history.back();</script>";
            }
            else
            {
                $ncc=new nhacungcap();
                $ncc->nccTen=$re->nccTen;
                if(strlen($re->nccDiachi)<10)
                {
                    Session::flash('err','?????a ch??? kh??ng h???p l??? !');
                    return "<script>window.history.back();</script>";
                }
                $ncc->nccDiachi=$re->nccDiachi;
                if($re->nccSdt<99999999 || $re->nccSdt>=10000000000)
                {
                    Session::flash('err','S??? ??i???n tho???i kh??ng h???p l??? !');
                    return "<script>window.history.back();</script>";
                }
                $ncc->nccSdt=$re->nccSdt;
                $ncc->nccTinhtrang=1;
                Session::flash('success','Th??m th??nh c??ng !');
                $ncc->save();
                
                $ad_log=new admin_log();
                $ad_log->adMa=Session::get('adMa');
                $ad_log->alChitiet= "Th??m nh?? cung c???p m???i: ".$re->nccTen;
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
            Session::flash('err','???? c?? s???n ph???m thu???c nh?? cung c???p n??y, kh??ng ???????c x??a!');
            return "<script>window.history.back();</script>";
        }      
        else
        { 
            $ad_log=new admin_log();
            $ad_log->adMa=Session::get('adMa');
            $ad_log->alChitiet="X??a nh?? cung c???p: ".$exist->nccTen;
            $ad_log->alNgaygio=now();        
            $ad_log->save();               
            
            Session::flash('success','???? x??a nh?? cung c???p: '.$exist->nccTen);
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
                Session::flash('err','Nh?? cung c???p kh??ng t???n t???i!');
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
            Session::flash('err','Nh?? cung c???p n??y ???? t???n t???i !');
            return "<script>window.history.back();</script>";
        }
        else
        {
            $nccTenOld=$getNhacungcap->nccTen;
            $nccDiachiOld=$getNhacungcap->nccDiachi;
            $nccSdtOld=$getNhacungcap->nccSdt;
            $ad_log=new admin_log();
            $ad_log->alChitiet="S???a th??ng tin nh?? cung c???p:  ";
            if($getNhacungcap->nccTen!=$re->nccTen)
            {   
                $ad_log->alChitiet.='T??n: '.$nccTenOld.' => '.$re->nccTen.'; ';
                $getNhacungcap->nccTen=$re->nccTen;
            }
            if($getNhacungcap->nccDiachi!=$re->nccDiachi)
            {
                $ad_log->alChitiet.='?????a ch???: '.$nccDiachiOld.' => '.$re->nccDiachi.'; ';
                $getNhacungcap->nccDiachi=$re->nccDiachi;
            }
            if($getNhacungcap->nccSdt!=$re->nccSdt)
            {
                $ad_log->alChitiet.='S??? ??i???n tho???i: '.$nccSdtOld.' => '.$re->nccSdt.'; ';
                $getNhacungcap->nccSdt=$re->nccSdt;
            }
            $ad_log->adMa=Session::get('adMa');
            $ad_log->alNgaygio=now();
            $getNhacungcap->update();
            $ad_log->save();

            return Redirect::to('adNhacungcap');
        }
    }

    // T??m ng??y ho???t ?????ng
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

    //Phi???u nh???p
    public function viewCTPhieunhap($id)
    {
        $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
        Session::put('dgTrangthai',$noteDanhgia);
        $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
        Session::put('hdTinhtrang',$noteDonhang);
        $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
        Session::put('hdTinhtrang1',$noteDonhang1);
        $data = DB::table("phieunhap")
                ->where('pnMa',$id)
                ->join('admin','admin.adMa','=','phieunhap.adMa')
                ->get();
        $data2 = DB::table("chitietphieunhap")->where('pnMa',$id)
                ->join('sanpham','sanpham.spMa','=','chitietphieunhap.spMa')
                ->join('nhacungcap','nhacungcap.nccMa','=','chitietphieunhap.nccMa')
                ->get();

       
        return view('admin.chi-tiet-phieu-nhap')
                    ->with('data',$data)
                    ->with('data2',$data2)
                    ->with('noteDanhgia',$noteDanhgia)
                    ->with('noteDonhang',$noteDonhang)
                    ->with('noteDonhang1',$noteDonhang1);
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
            $data2["ctpnDongia"]= $re->gia[$key];
            $data2["ctpnThanhtien"]=$re->tonggiasp[$key];
            $data2["spMa"] =  $v;
            $data2["nccMa"] = $re->nccMa[$key];
            $data2["pnMa"] =  $data['pnMa'];
            $data2["serMa"] =  $re->serMa[$key];
           
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
                    $data3["khoSoluong"] = $checkKho + $sumSerial - 1;
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
            $data4['spGia'] =$re->gia[$key];
            $data4["nccMa"] =$re->nccMa[$key];
            DB::table('sanpham')->where('spMa', $v)->update($data4);
         }
         
        

        $data6 = array();
        $data6['adMa'] = Session::get('adMa');
        $data6['alChitiet'] = "L???p phi???u nh???p m???i, ng??y ".now();
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
                'vcMa.required'=>'M?? kh??ng ???????c ????? tr???ng !',
                'vcTen.required'=>'T??n kh??ng ???????c ????? tr???ng !',
                'vcSoluot.required'=>'S??? l?????t kh??ng ???????c ????? tr???ng!',
                'vcNgaybd.required'=>'Nh???p ng??y b???t ?????u !',
                'vcNgaykt.required'=>'Nh???p ng??y k???t th??c !',
                'vcMucgiam.required'=>'Nh???p m???c gi???m!',
                'vcGiatritoida.required'=>'Nh???p gi?? tr??? t???i ??a!',
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
            Session::flash('err','M?? voucher ???? t???n t???i !');
            return "<script>window.history.back();</script>";
        }
        $vc=new voucher();
        //Ki???m tra m?? h???p l???
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
            Session::flash('err','M?? kh??ng ch???a k?? t??? ?????c bi???t !');
            return "<script>window.history.back();</script>";
        }
    
        $vc->vcMa=$re->vcMa;
        $checkExistVoucherName=voucher::where('vcTen',$re->vcTen)->first();
        if($checkExistVoucherName)
        {
            Session::flash('err','Voucher n??y ???? t???n t???i !');
            return "<script>window.history.back();</script>";
        }
        else
        {
            $vc->vcTen=$re->vcTen;    
        }
        
        if($re->vcSoluot<1)
        {
            Session::flash('err','S??? l?????t ph???i l???n h??n 0 !');
            return "<script>window.history.back();</script>";
        }
        $vc->vcSoluot=$re->vcSoluot;

        $vc->vcNgaybd=$re->vcNgaybd;

        if($re->vcNgaybd > $re->vcNgaykt)
        {
            Session::flash('err','Ng??y k???t th??c ph???i sau ng??y b???t ?????u !');
            return "<script>window.history.back();</script>";
        }
        $vc->vcNgaykt=$re->vcNgaykt;
        $vc->vcLoaigiamgia=$re->vcLoaigiamgia;
        if($re->vcLoaigiamgia==0)//Theo gia
        {
            if($re->vcMucgiam<1000)// < 1000VND dong bao loi
            {
                Session::flash('err','M???c gi???m gi?? ph???i l???n h??n 1000?? !');
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
                Session::flash('err','M???c gi???m ph???i l???n h??n 0!');
                return "<script>window.history.back();</script>";
            }
            if($re->vcMucgiam > 100)// < 1000VND dong bao loi
            {
                Session::flash('err','Ph???n tr??m gi???m gi?? ph???i nh??? h??n ho???c b???ng 100 %');
                return "<script>window.history.back();</script>";
            }
            else
            {
                $vc->vcMucgiam=$re->vcMucgiam;        
            }
        }
        if($re->vcGiatritoida<0)
        {
            Session::flash('err','Gi?? tr??? t???i ??a ph???i l???n h??n 0!');
            return "<script>window.history.back();</script>";
        }
        $vc->vcGiatritoida=$re->vcGiatritoida;
        $vc->vcLoai=$re->vcLoai;
        if($re->vcLoai==0)
        {
            if($re->checkboxsp==null)
                {
                    Session::flash('err','Vui l??ng ch???n 1 s???n ph???m !');
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
                    Session::flash('err','??i???u ki???n ??p d???ng theo gi?? ph???i l???n h??n 1000?? !');
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
                    Session::flash('err','??i???u ki???n ??p d???ng theo s???n ph???m ph???i l???n h??n 0 !');
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
        $log->alChitiet="Th??m voucher: ".$re->vcTen;
        $log->alNgaygio=now();
        $log->save();

        Session::flash('success',"Th??m voucher: ".$re->vcTen." th??nh c??ng!");
        return Redirect::to('adVoucher');

    }

    public function suaVoucherpage(Request $re)
    {
        $vc=DB::table('voucher')->where('vcMa',$re->id)->first();
        //dd($checkExistKhuyenmai);
        if(!$vc)
        {
           
            Session::flash("err","Ch????ng tr??nh khuy???n m??i kh??ng t???n t???i !");
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
                'vcMa.required'=>'M?? kh??ng ???????c ????? tr???ng !',
                'vcTen.required'=>'T??n kh??ng ???????c ????? tr???ng !',
                'vcSoluot.required'=>'S??? l?????t kh??ng ???????c ????? tr???ng!',
                'vcNgaybd.required'=>'Nh???p ng??y b???t ?????u !',
                'vcNgaykt.required'=>'Nh???p ng??y k???t th??c !',
                'vcMucgiam.required'=>'Nh???p m???c gi???m!',
                'vcGiatritoida.required'=>'Nh???p gi?? tr??? t???i ??a!',
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
            Session::flash('err','S??? l?????t ph???i l???n h??n 0 !');
            return "<script>window.history.back();</script>";
        }
        $vc->vcSoluot=$re->vcSoluot;

        $vc->vcNgaybd=$re->vcNgaybd;

        if($re->vcNgaybd > $re->vcNgaykt)
        {
            Session::flash('err','Ng??y k???t th??c ph???i sau ng??y b???t ?????u !');
            return "<script>window.history.back();</script>";
        }
        $vc->vcNgaykt=$re->vcNgaykt;
        $vc->vcLoaigiamgia=$re->vcLoaigiamgia;
        if($re->vcLoaigiamgia==0)//Theo gia
        {
            if($re->vcMucgiam<1000)// < 1000VND dong bao loi
            {
                Session::flash('err','M???c gi???m gi?? ph???i l???n h??n 1000?? !');
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
                Session::flash('err','M???c gi???m ph???i l???n h??n 0!');
                return "<script>window.history.back();</script>";
            }
            if($re->vcMucgiam > 100)// < 1000VND dong bao loi
            {
                Session::flash('err','Ph???n tr??m gi???m gi?? ph???i nh??? h??n ho???c b???ng 100 %');
                return "<script>window.history.back();</script>";
            }
            else
            {
                $vc->vcMucgiam=$re->vcMucgiam;        
            }
        }
        if($re->vcGiatritoida<0)
        {
            Session::flash('err','Gi?? tr??? t???i ??a ph???i l???n h??n 0!');
            return "<script>window.history.back();</script>";
        }
        $vc->vcGiatritoida=$re->vcGiatritoida;
        $vc->vcLoai=$re->vcLoai;
        if($re->vcLoai==0)
        {
            if($re->checkboxsp==null)
                {
                    Session::flash('err','Vui l??ng ch???n 1 s???n ph???m !');
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
                    Session::flash('err','??i???u ki???n ??p d???ng theo gi?? ph???i l???n h??n 1000?? !');
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
                    Session::flash('err','??i???u ki???n ??p d???ng theo s???n ph???m ph???i l???n h??n 0 !');
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
        $log->alChitiet="S???a voucher: ".$re->vcTen;
        $log->alNgaygio=now();
        $log->save();

        Session::flash('success',"S???a voucher: ".$re->vcTen." th??nh c??ng!");
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
                        Session::flash('success','???? ?????i t??nh tr???ng voucher: '.$checkExistVoucher->vcTen." th??nh ???n.");
                        $log= new admin_log();
                        $log->adMa=Session::get('adMa');
                        $log->alChitiet='?????i tr???ng th??i voucher: '.$checkExistVoucher->vcTen.' th??nh ???n.';
                        $log->alNgaygio=now();
                        $log->save();
                    }
                    else
                    {
                        $checkExistVoucher->vcTinhtrang=1;
                        $checkExistVoucher->update();
                        Session::flash('success','???? ?????i t??nh tr???ng voucher: '.$checkExistVoucher->vcTen." th??nh Hi???n.");
                        $log= new admin_log();
                        $log->adMa=Session::get('adMa');
                        $log->alChitiet='?????i tr???ng th??i voucher: '.$checkExistVoucher->vcTen.' th??nh Hi???n.';
                        $log->alNgaygio=now();
                        $log->save();
                    }
                }
                else
                {
                    Session::flash('err','Voucher kh??ng t???n t???i !');
                }
                return redirect::to('adVoucher');
            }
            else
            {
                Session::flash('err','B???n kh??ng c?? quy???n n??y !');
                return "<script>window.history.back();</script>";
            }
        }
    }

    public function adDeleteVoucher(Request $re)
    {
        $vcInfo=voucher::where('vcMa',$re->id)->first();
        if(!$vcInfo)
        {
            Session::flash('err',"Voucher kh??ng t???n t???i !");
            return "<script>window.history.back();</script>";
        }
        $vcInfo->vcTinhtrang=99;
        //
        $ad_log=new admin_log();
        $ad_log->adMa=Session::get('adMa');
        $ad_log->alChitiet='X??a voucher: '.$vcInfo->vcTen;
        $ad_log->alNgaygio=now();
        $ad_log->save();
        Session::flash('success',"???? x??a voucher: ".$vcInfo->vcTen);
        $vcInfo->update();
        return redirect('adVoucher');
    }


    public function khoaNhanvien($id)
    {
         $dbOld = DB::table('admin')->select('adTen')->where('adMa',$id)->first();
          $data1 = array();
                $data1['adMa'] = Session::get('adMa');
                $data1['alChitiet'] = "Kh??a nh??n vi??n: ".$dbOld->adTen;
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
        $data1['alChitiet'] = "M??? kh??a nh??n vi??n:".$dbOld->adTen;
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
            $data1['alChitiet'] = "Th??m tin t???c ti??u ?????: ".$re->ttTieude;
            $data1['alNgaygio']= now();
            DB::table('admin_log')->insert($data1);

            return redirect('tin-tuc');
        }
        else
        {
            Session::flash('note_err','Vui l??ng th??m h??nh ch??? ????? cho tin t???c');
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
        $data1['alChitiet'] = "C???p nh???t tin t???c ti??u ????? ".$re->ttTieude;
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
        $data1['alChitiet'] = "C???p nh???t tin t???c ti??u ????? ".$re->ttTieude;
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
        $data1['alChitiet'] = "X??a tin t???c ti??u ?????: ".$dbOld->ttTieude;
        $data1['alNgaygio']= now();
        DB::table('admin_log')->insert($data1);

        DB::table('tintuc')->where('ttMa',$id)->delete();
        return response()->json(['message'=>0]);
    }



        //Banner
     public function vitriBanner($trang)
     {
            $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);

            $page = $trang;
            return view('admin.vi-tri-banner')
                                ->with('page',$page)
                                ->with('noteDanhgia',$noteDanhgia)
                                ->with('noteDonhang',$noteDonhang)
                                ->with('noteDonhang1',$noteDonhang1);
     }
      public function themBanner($trang,$id)
     {
         $noteDanhgia = DB::table("danhgia")->where('dgTrangthai',1)->count();
            Session::put('dgTrangthai',$noteDanhgia);
            $noteDonhang = DB::table("donhang")->where('hdTinhtrang',0)->count();
            Session::put('hdTinhtrang',$noteDonhang);
            $noteDonhang1 = DB::table("donhang")->where('hdTinhtrang',3)->count();
            Session::put('hdTinhtrang1',$noteDonhang1);

            $vitri = $id;
            $trang = $trang;

            return view('admin.them-banner',compact('vitri','trang'))
                                ->with('noteDanhgia',$noteDanhgia)
                                ->with('noteDonhang',$noteDonhang)
                                ->with('noteDonhang1',$noteDonhang1);
     }
      public function adCheckAddBanner(Request $re,$trang,$vitri)
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
                     $data['bnTrang']= $trang;
                    DB::table('slide')->insert($data);
                   
                    return redirect('adBanner/'.$trang."/".$vitri);
            }
            // else
            // {
            //     Session::put('bnError',"Vui l??ng th??m h??nh");
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


