<?php
use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;




//---------------------------------------------USER---------------------------------------------------//Welcome page
Route::get('/', 'homeController@welcome' );

// user info
Route::get('/infomation/{id}','homeController@viewInfomation')->middleware('checkAuth');
Route::post('edit_infomation/{id}','homeController@editInfomation')->middleware('checkAuth');
Route::get('updatePass/{id}','homeController@updatePass')->middleware('checkAuth');
Route::post('editPass/{id}','homeController@editPass')->middleware('checkAuth');
Route::get('changeEmail/{id}','homeController@changeEmail')->middleware('checkAuth');
Route::get('listorder','homeController@listorder')->middleware('checkAuth');
Route::post('addInfomation/{id}','loginController@addInfomation');
Route::get('cancelinfo','homeController@cancelinfo');
//--------User register------//
Route::get('/register','registerController@index');
Route::post('/getregister','registerController@getregister');
Route::post('/registerForApi','registerController@registerForApi');
//--------User Login------//
Route::get('login','homeController@login' )->name('loginpage');
Route::post('/checklogin','loginController@userlogin');
Route::get('logout','homeController@logout');
// User forgot password
// 
Route::get('forgotPassword','homeController@forgotPassword');
Route::get('sendCodeGetAcc','loginController@sendCodeGetAcc');
Route::get('changepassword/{id?}','loginController@changepassword');
Route::post('newpass/{id}','loginController@newpass');
//---

// verify-email
Route::get('verify-email/{id}','homeController@verifyemail');
Route::get('sendcode','homeController@sendcode');
Route::post('verifycode','homeController@verifycode');
//---

// Login gg & facebook api
Route::get('google','loginController@loginGoogle');
Route::get('googleredirect','loginController@googleredirect');
Route::get('facebook','loginController@loginFacebook');
Route::get('facebookredirect','loginController@facebookredirect');
//---

// -------Product page-----------//
Route::get('/product','homeController@product' )->name('productpage');
Route::get('proinfo/{id}','homeController@proinfo');
Route::get('findpro','homeController@findpro');
//---

//--comment
Route::post('addcomment/{id}','homeController@addcomment');
Route::get('deletecomment/{id}','homeController@deletecomment');
//---

//
//--------User cart------//
//
//cart
Route::get('/checkout','homeController@checkout' );
//
//add to cart
Route::get('save-cart/{id}','cartController@savecart');
Route::post('save-cart2/{id}','cartController@savecart2');
Route::get('changeQuanty/increase/{id}','cartController@changeQuantyIncrease');
Route::get('changeQuanty/decrease/{id}','cartController@changeQuantyDecrease');
//
//
//remove item
Route::get('destroy-cart','cartController@destroy');
Route::get('remove-item/{id}','cartController@removeitem');
//
//
//create order 
Route::get('order','homeController@order')->middleware('checkAuth');
Route::post('gocheckout/{id}','cartController@gocheckout')->middleware('checkAuth');
Route::get('sendmail','cartController@sendmail');
// 
// ----

//------ Voucher---------//
Route::post('checkvoucher','homeController@checkvoucher')->name('checkvoucher');
Route::get('clearVoucher',function(){
	Session::forget('vcMa');
	Session::flash('success','???? g??? ??p d???ng voucher !');
	return Redirect()->back();
});
//---

//Wishlist
Route::get('wishlist','homeController@wishlist');
Route::get('addtowishlist/{id}','homeController@addtowishlist');
//--????n h??ng--//
Route::get('huy-don/{id}','homeController@huyDon');
//--Tin t???c-->
Route::get('danh-sach-tin-tuc','homeController@viewTintuc');
Route::get('chi-tiet-tin-tuc/{id}','homeController@tintucInfo');
//---------------------------------------------END USER--------------------------------------------//

// test view
Route::get('test',function()
{
	return view('userpage.addInfomation');
});






//---------------------------------------------ADMIN----------------------------------------------------//
//--------Admin Login------//
Route::get('admin','adminController@index');
Route::get('/adLogin','adminController@adLoginView');
Route::get('/checkLogin','adminController@checkLogin');
Route::get('/adLogout','adminController@logout');
Route::get('/loiXoa','adminController@viewLoiXoa');

//--------Admin Manage View------//
Route::get('/adNhanvien','adminController@viewNhanvien');
Route::get('/adKhachhang','adminController@viewKhachhang');
Route::get('/adSanpham','adminController@viewSanpham');
Route::get('/adKho','adminController@viewKho');
Route::get('/motasanpham/{id}','adminController@viewMotaSanpham');
Route::get('/adLoai','adminController@viewLoai');
Route::get('/adThuonghieu','adminController@viewThuonghieu');
Route::get('/adNhucau','adminController@viewNhucau');
Route::get('/adKhuyenmai','adminController@viewKhuyenmai');
Route::get('/adBanner/{trang}/{vitri}','adminController@viewBanner');
Route::get('/adBinhluan','adminController@viewBinhluan');

//--------Admin Add Manage View------//
//--Nh??n vi??n--//
Route::get('/themnhanvien','adminController@themAdmin');
Route::post('/checkAddAdmin','adminController@adCheckAddAdmin');
Route::get('/deleteAdmin/{id}','adminController@adDeleteAdmin');
Route::get('/updateAdmin/{id}','adminController@adUpdateAdmin');
Route::post('/editAdmin/{id}','adminController@editAdmin');

//--Kh??ch h??ng--//
Route::get('/themkhachhang','adminController@themKhachhang');
Route::post('/checkAddKhachhang','adminController@adCheckAddKhachhang');
Route::get('/deleteKhachhang/{id}','adminController@adDeleteKhachhang');
Route::get('/updateKhachhang/{id}','adminController@adUpdateKhachhang');
Route::post('/editKhachhang/{id}','adminController@editKhachhang');
//--S???n ph???m--//
Route::get('/themsanpham','adminController@themSanpham');
Route::post('/checkAddSanpham','adminController@adCheckAddSanpham');
Route::get('/deleteSanpham/{id}','adminController@adDeleteSanpham');
Route::get('/updateSanpham/{id}','adminController@adUpdateSanpham');
Route::post('/editSanpham/{id}','adminController@editSanpham');
Route::post('/themhinh','adminController@addHinhSanpham');
Route::get('/editHinhStt/{tenhinh}/{id}','adminController@editStatusHinh');
Route::get('/xoahinh/{tenhinh}/{id}','adminController@deleteHinhSanpham');
Route::post('/editMota/{id}','adminController@editMota');
Route::get('/loiThemHinhSP','adminController@viewLoiThemHinhSP');
//--Kho--//
Route::post('editKho/{id}','adminController@editKho');

//--Loai--//

Route::post('/checkAddLoai','adminController@adCheckAddLoai');
Route::post('editLoai/{id}','adminController@editLoai');
Route::get('/deleteLoai/{id}',[adminController::class,'adDeleteLoai']);

//--Nhu c???u --//

Route::get('/checkAddNhucau','adminController@adCheckAddNhucau');
Route::get('/deleteNhucau/{id}','adminController@adDeleteNhucau');
Route::get('/editNhucau/{id}','adminController@editNhucau');
//--Th????ng hi???u--//

Route::get('/checkAddThuonghieu','adminController@adCheckAddThuonghieu');
Route::get('/deleteThuonghieu/{id}','adminController@adDeleteThuonghieu');
Route::get('/editThuonghieu/{id}','adminController@editThuonghieu');
//--Banner--//
Route::get('vi-tri-banner/{trang}','adminController@vitriBanner');
Route::get('them-banner/{trang}/{id}','adminController@themBanner');
Route::post('checkAddBanner/{trang}/{vitri}','adminController@adCheckAddBanner');
Route::get('/deleteBanner/{id}','adminController@adDeleteBanner');
Route::get('/updateBanner/{id}','adminController@adUpdateBanner');
Route::post('/editBanner/{id}','adminController@editBanner');



//--Khuy???n m??i--//

Route::get('addKhuyenmaiPage','adminController@addKhuyenmaiPage');
Route::post('/checkAddKhuyenmai','adminController@adCheckAddKhuyenmai');
Route::get('/deleteKhuyenmai/{id}','adminController@adDeleteKhuyenmai');
Route::get('suaKhuyenmaipage/{id}','adminController@suaKhuyenmaipage');
Route::post('checkSuaKhuyenmai/{id}','adminController@suaKhuyenmai');
Route::get('switchStatus/{id}','adminController@switchStatus');

// Voucher
Route::get('adVoucher','adminController@viewVoucher');
Route::get('addVoucherpage','adminController@addVoucherpage');
Route::post('checkAddVoucher','adminController@checkAddVoucher');
Route::get('suaVoucherpage/{id}','adminController@suaVoucherpage');
Route::post('checkSuaVoucher/{id}','adminController@checkSuaVoucher');
Route::get('switchStatusVc/{id}','adminController@switchStatusVc');
Route::get('adDeleteVoucher/{id}','adminController@adDeleteVoucher');
////--B??nh lu???n--//
Route::get('viewBLSP/{id}','adminController@viewBLSP');
Route::get('chitietBLSP/{id}','adminController@chitietBLSP');
//--H??a ????n--//
Route::get('don-hang','adminController@viewDonhang');
Route::post('giaohang/{id}','adminController@giaohang');
Route::get('thanhtoan/{id}','adminController@thanhtoan');
Route::get('xoa-don/{id}','adminController@xoadon');
//--B??o c??o ng??y--//
Route::get('update-bao-cao-ngay','adminController@updateBaocao');
Route::get('bao-cao-ngay','adminController@viewBaocao');
Route::get('deleteBaocao/{id}','adminController@deleteBaocao');

// --Nh?? cung c???p --//

Route::get('adNhacungcap','adminController@adviewNhacungcap');
Route::get('adthemncc','adminController@adThemnccpage');
Route::post('checkAddNcc','adminController@checkAddNcc');
Route::get('deleteNhacungcap/{id}','adminController@deleteNhacungcap');
Route::get('suaNhacungcappage/{id}','adminController@suaNhacungcappage');
Route::post('checkSuaNhacungcap/{id}','adminController@suaNhacungcap');

//--L???ch s??? ho???t ?????ng --//
Route::get('lich-su-hoat-dong','adminController@viewLShoatdong');
Route::get('tim-kiem-lshd','adminController@timLSHD');
Route::get('lich-su-giao-hang','adminController@viewLSgiaohang');
//--Qu???n l?? phi???u nh???p--//
Route::get('quan-ly-phieu-nhap','adminController@viewQlPhieunhap');
Route::get('lap-phieu-nhap','adminController@viewLapPhieuNhap');
Route::post('addPhieuNhap','adminController@addPhieuNhap');
Route::get('chi-tiet-phieu-nhap/{id}','adminController@viewCTPhieunhap');
Route::get('chi-tiet-phieu-thu/{id}','adminController@viewCTDonhang');

//-----Kh??a t??i kho???n----->
Route::get('khoa-nv/{id}','adminController@khoaNhanvien');
Route::get('mokhoa-nv/{id}','adminController@moKhoaNhanvien');

//------Tin t???c--------->
Route::get('tin-tuc','adminController@viewTintuc');
Route::get('them-tin-tuc','adminController@themTintuc');
Route::post('checkAddTT','adminController@adCheckAddTT');
Route::get('cap-nhat-tin-tuc/{id}','adminController@adUpdateTintuc');
Route::post('editTintuc/{id}','adminController@editTintuc');
Route::get('xoa-tin-tuc/{id}',[adminController::class,'deleteTintuc']);

//--------Chi ti???t kho------//
Route::get('chi-tiet-kho/{id}','adminController@viewCTKho');