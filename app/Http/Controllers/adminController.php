<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
session_start();
class adminController extends Controller
{
    public function index()
    {
        if(Session::has('adTaikhoan'))
        {
            return view('admin.index');
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
                Session::forget('error_login');
                return view('admin.index');
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
        return view('admin.login');
    }


    //VIEW MANAGE
    public function viewNhanvien()
    {

        if(Session::has('adTaikhoan'))
        {
            $data = DB::table('admin')->get();
            return view('admin.nhanvien')->with('data',$data);
        }
        else 
        {  return Redirect('/adLogin'); }
       
    }
      public function viewKhachhang()
    {
          if(Session::has('adTaikhoan'))
        {
             $data = DB::table('khachhang')->get();
        return view('admin.khachhang')->with('data',$data);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }
      public function viewSanpham()
    {
        if(Session::has('adTaikhoan'))
        {
            $data=DB::table('sanpham')->leftjoin('khuyenmai','khuyenmai.kmMa','=','sanpham.kmMa')->join('kho','kho.spMa','sanpham.spMa')->join('loai','loai.loaiMa','=','sanpham.loaiMa')->join('thuonghieu','thuonghieu.thMa','=','sanpham.thMa')->join('nhucau','nhucau.ncMa','=','sanpham.ncMa')->get();
            
     
            return view('admin.sanpham')->with('data',$data);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }
      public function viewKho()
    {
        if(Session::has('adTaikhoan'))
        {
            $data=DB::table('kho')->get();
            return view('admin.kho')->with('data',$data);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }

    public function viewLoai()
    {
         if(Session::has('adTaikhoan'))
        {
              $data = DB::table('loai')->get();
             return view('admin.loai')->with('data',$data);
        }
        else 
        { return Redirect('/adLogin'); }
     
       
    }
      public function viewThuonghieu()
    {
         if(Session::has('adTaikhoan'))
        {
              $data = DB::table('thuonghieu')->get();
        return view('admin.thuonghieu')->with('data',$data);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }
      public function viewNhucau()
    {
        if(Session::has('adTaikhoan'))
        {
             $data=DB::table('nhucau')->get();
        return view('admin.nhucau')->with('data',$data);
        }
        else 
        { return Redirect('/adLogin'); }
       
    }
        public function viewKhuyenmai()
    {
         if(Session::has('adTaikhoan'))
        {
            return view('admin.khuyenmai');
        }
        else 
        { return Redirect('/adLogin'); }
       
    }

   public function viewBanner()
    {
         if(Session::has('adTaikhoan'))
        {
            $data = DB::table('banner')->get();
            return view('admin.banner')->with('data',$data);
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

    //////////////////////////////Add Manage
    

    // Nhân viên
      public function themAdmin()
    {
        return view('admin.themnhanvien');
    }
    public function adCheckAddAdmin(Request $re)
    {
        if($re->adTen ==null||$re->adTaikhoan == null||$re->adMatkhau == null||$re->adEmail==null||$re->adQuyen==null)
        {
            Session::forget('ad_err');
            $messages =[
                'adTen.required'=>'Tên nhân viên không được để trống',
                'adTaikhoan.required'=>'Tài khoản nhân viên không được để trống',
                'adMatkhau.required'=>'Mật khẩu nhân viên không được để trống',
                'adEmail.required'=>'Email nhân viên không được để trống',
                'adQuyen.required'=>'Quyền nhân viên không được để trống',
            ];
            $this->validate($re,[
                'adTen'=>'required',
                'adTaikhoan'=>'required',
                'adMatkhau'=>'required',
                'adEmail'=>'required',
                'adQuyen'=>'required',
            ],$messages);

            $errors=$validate->errors();
        }
        else
         {
            $dataBefore = DB::table('admin')->where('adTaikhoan',$re->adTaikhoan)->first();
            if($dataBefore)
            {
                Session::put('ad_err','Tài khoản đã tồn tại, vui lòng nhập tài khoản khác!');
                return redirect('themnhanvien');
            }
           else
           {
                $data = array();
                $data['adTen']=$re->adTen;
                $data['adTaikhoan']=$re->adTaikhoan;
                $data['adMatkhau']=$re->adMatkhau;
                $data['adEmail']=$re->adEmail;
                $data['adQuyen']=$re->adQuyen;
                DB::table('admin')->insert($data);
                Session::forget('ad_err');
                return redirect('adNhanvien');
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
       if($re->adTen ==null||$re->adTaikhoan == null||$re->adMatkhau == null||$re->adEmail==null||$re->adQuyen==null)
        {
            $messages =[
                'adTen.required'=>'Tên nhân viên không được để trống',
                'adTaikhoan.required'=>'Tài khoản nhân viên không được để trống',
                'adMatkhau.required'=>'Mật khẩu nhân viên không được để trống',
                'adEmail.required'=>'Email nhân viên không được để trống',
                'adQuyen.required'=>'Quyền nhân viên không được để trống',
                
            ];
            $this->validate($re,[
                'adTen'=>'required',
                'adTaikhoan'=>'required',
                'adMatkhau'=>'required',
                'adEmail'=>'required',
               
            ],$messages);

            $errors=$validate->errors();
        }
        else
        {
            $data = array();
            $data['adTen']=$re->adTen;
            $data['adTaikhoan']=$re->adTaikhoan;
            $data['adMatkhau']=$re->adMatkhau;
            $data['adEmail']=$re->adEmail;
            $data['adQuyen']=$re->adQuyen;
            DB::table('admin')->where('adMa',$id)->update($data);
            return redirect('adNhanvien');
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
            $dataBefore=DB::table('khachhang')->where('khTaikhoan',$re->khTaikhoan)->first();
            if($dataBefore)
            {
                Session::put('kh_err',"Tài khoản đăng nhập đã tồn tại, vui lòng nhập tài khoản khác");
                return redirect('/themkhachhang');
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
            DB::table('khachhang')->where('khMa',$id)->update($data);
            return redirect('adKhachhang');
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
         if($re->spTen ==null||$re->khoSoluong == null||$re->spGia==null||$re->ram==null||$re->psu==null||$re->mainboard==null||$re->vga==null||$re->ocung==null||$re->tannhiet==null)
        {
            Session::forget('sp_err');
            $messages =[
               
                'spTen.required'=>'Sản phẩm không được để trống',
                'khoSoluong.required'=>'Số lượng không được để trống',
                'spGia.required'=>'Giá không được để trống',
                'spHanbh.required'=>'Hạn bảo hành không được để trống',
                'ram.required'=>'Ram không được để trống',
                'psu.required'=>'PSU không được để trống',
                'mainboard.required'=>'Mainboard không được để trống',
                 'vga.required'=>'VGA không được để trống',
                'ocung.required'=>'Ổ cứng không được để trống',
                'tannhiet.required'=>'tannhiet không được để trống',
                
            ];
            $this->validate($re,[
               
                'spTen'=>'required',
                'spHanbh'=>'required',
                'khoSoluong'=>'required',
                'spGia'=>'required', 
                'ram'=>'required',
                'psu'=>'required',
                'mainboard'=>'required', 
                'vga'=>'required',
                'ocung'=>'required',
                'tannhiet'=>'required',  
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
                $data = array();
                $data['spMa']=''.strlen($re->spTen).substr($re->spGia,0,3).strlen($re->thMa).strlen($re->loaiMa).strlen($re->ncMa).strlen(rand(0,100000));
                $data['spTen']=$re->spTen;
                $data['spGia']=$re->spGia;
                if($re->khoSoluong >= 0)
                {
                     $data['spTinhtrang']=1;
                }
                else
                {
                    $data['spTinhtrang']=0;
                }
                $data['spHanbh']=$re->spHanbh;
                $data['kmMa']=$re->kmMa;
                $data['thMa']=$re->thMa;
                $data['loaiMa']=$re->loaiMa;
                $data['ncMa']=$re->ncMa;
                //
                $data2 = array();
                $data2['spMa']= $data['spMa'];
                $data2['manhinh']=$re->manhinh;
                $data2['chuot']=$re->chuot;
                $data2['banphim']=$re->banphim;
                $data2['ram']=$re->ram;
                $data2['psu']=$re->psu;
                $data2['mainboard']=$re->mainboard;
                $data2['vga']=$re->vga;
                $data2['ocung']=$re->ocung;
                $data2['vocase']=$re->vocase;
                $data2['pin']=$re->pin;
                $data2['tannhiet']=$re->tannhiet;
                $data2['loa']=$re->loa;
                //Anh 1
                $data3 = array();
                $data3['spMa']= $data['spMa'];
                $data3['spHinh']=$re->file('img')->getClientOriginalName();
                        $imgextention=$re->file('img')->extension();
                        $file=$re->file('img');
                        $file->move('public/images/products',$data3['spHinh']);
                //
                $data4 = array();
                $data4['spMa'] =$data['spMa'];
                $data4['khoSoluong'] = $re->khoSoluong;
                $data4['khoNgaynhap'] = now();
                
                DB::table('sanpham')->insert($data);
                DB::table('mota')->insert($data2);
                DB::table('hinh')->insert($data3);
                DB::table('kho')->insert($data4);

                //Anh 2
                if($re->hasFile('img2')==true)
                {
                    $dataImg2 = array();
                    $dataImg2['spMa']= $data['spMa'];
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
                    $dataImg3['spMa']= $data['spMa'];
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
                    $dataImg4['spMa']= $data['spMa'];
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
        if($re->spTen ==null||$re->khoSoluong == null||$re->spGia==null||$re->ram==null||$re->psu==null||$re->mainboard==null||$re->vga==null||$re->ocung==null||$re->tannhiet==null)
        {
            $messages =[
               
                'spTen.required'=>'Sản phẩm không được để trống',
                'khoSoluong.required'=>'Số lượng không được để trống',
                'spGia.required'=>'Giá không được để trống',
                'spHanbh.required'=>'Hạn bảo hành không được để trống',
                'ram.required'=>'Ram không được để trống',
                'psu.required'=>'PSU không được để trống',
                'mainboard.required'=>'Mainboard không được để trống',
                 'vga.required'=>'VGA không được để trống',
                'ocung.required'=>'Ổ cứng không được để trống',
                'tannhiet.required'=>'tannhiet không được để trống',
                
            ];
            $this->validate($re,[
               
                'spTen'=>'required',
                'spHanbh'=>'required',
                'khoSoluong'=>'required',
                'spGia'=>'required', 
                'ram'=>'required',
                'psu'=>'required',
                'mainboard'=>'required', 
                'vga'=>'required',
                'ocung'=>'required',
                'tannhiet'=>'required',  
            ],$messages);
            $errors=$validate->errors();
            }
            else
            {
                $data = array();
                $data['spMa']=$re->spMa;
                $data['spTen']=$re->spTen;
                $data['spGia']=$re->spGia;
                 if($re->khoSoluong >0)
                {
                     $data['spTinhtrang']=1;
                }
                else
                {
                    $data['spTinhtrang']=0;
                }
                $data['spHanbh']=$re->spHanbh;
                $data['kmMa']=$re->kmMa;
                $data['thMa']=$re->thMa;
                $data['loaiMa']=$re->loaiMa;
                $data['ncMa']=$re->ncMa;
                //
                $data2 = array();
                $data2['spMa']=$re->spMa;
                $data2['manhinh']=$re->manhinh;
                $data2['chuot']=$re->chuot;
                $data2['banphim']=$re->banphim;
                $data2['ram']=$re->ram;
                $data2['psu']=$re->psu;
                $data2['mainboard']=$re->mainboard;
                $data2['vga']=$re->vga;
                $data2['ocung']=$re->ocung;
                $data2['vocase']=$re->vocase;
                $data2['pin']=$re->pin;
                $data2['tannhiet']=$re->tannhiet;
                $data2['loa']=$re->loa;
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
    public function themLoai()
    {
        return view('admin.themloai');
    }
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
    public function themNhucau()
    {
        return view('admin.themnhucau');
    }
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
     public function themThuonghieu()
    {
        return view('admin.themthuonghieu');
    }
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
  public function thembanner()
  {
     return view('admin.thembanner');
  }
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
}


    