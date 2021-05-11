<?php

use Illuminate\Support\Facades\Route;



//---------------------------------------------USER----------------------------------------------------//
Route::get('/', 'homeController@welcome' );

// user info
Route::get('/infomation/{id}','homeController@viewInfomation');
Route::post('edit_infomation/{id}','homeController@editInfomation');
Route::get('updatePass/{id}','homeController@updatePass');
Route::get('editPass/{id}','homeController@editPass');
Route::get('changeEmail/{id}','homeController@changeEmail');
Route::get('listorder	','homeController@listorder');
//--------User register------//
Route::get('/register','registerController@index');
Route::post('/getregister','registerController@getregister');
Route::post('/registerForApi','registerController@registerForApi');
//--------User Login------//
Route::get('login','homeController@login' );
Route::post('/checklogin','loginController@userlogin');
Route::get('logout','homeController@logout');
// User forgot password
// 
Route::get('forgotPassword','homeController@forgotPassword');
Route::get('sendCodeGetAcc','loginController@sendCodeGetAcc');
Route::get('changepassword/{id?}','loginController@changepassword');
Route::post('newpass/{id}','loginController@newpass');
// verify-email
Route::get('verify-email/{id}','homeController@verifyemail');
Route::get('sendcode','homeController@sendcode');
Route::post('verifycode','homeController@verifycode');

// Login gg & facebook api
Route::get('google','loginController@loginGoogle');
Route::get('googleredirect','loginController@googleredirect');
Route::get('facebook','loginController@loginFacebook');
Route::get('facebookredirect','loginController@facebookredirect');
// -------Product -----------//
Route::get('/product','homeController@product' );
Route::get('proinfo/{id}','homeController@proinfo');
Route::post('findpro','homeController@findpro');
	//--comment
Route::post('addcomment/{id}','homeController@addcomment');
Route::get('deletecomment/{id}','homeController@deletecomment');

//--------User cart------//
Route::get('/checkout','homeController@checkout' );
Route::get('save-cart/{id}','cartController@savecart');
Route::post('save-cart2/{id}','cartController@savecart2');
Route::get('destroy-cart','cartController@destroy');
Route::get('remove-item/{id}','cartController@removeitem');
Route::post('gocheckout/{id}','cartController@gocheckout');
Route::get('order','homeController@order');
Route::get('sendmail','cartController@sendmail');

Route::get('changeQuanty/increase/{id}','cartController@changeQuantyIncrease');
Route::get('changeQuanty/decrease/{id}','cartController@changeQuantyDecrease');

//---------------------------------------------END USER--------------------------------------------//








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
Route::get('/adBanner','adminController@viewBanner');
Route::get('/adBinhluan','adminController@viewBinhluan');

//--------Admin Add Manage View------//
//--Nhân viên--//
Route::get('/themnhanvien','adminController@themAdmin');
Route::post('/checkAddAdmin','adminController@adCheckAddAdmin');
Route::get('/deleteAdmin/{id}','adminController@adDeleteAdmin');
Route::get('/updateAdmin/{id}','adminController@adUpdateAdmin');
Route::post('/editAdmin/{id}','adminController@editAdmin');

//--Khách hàng--//
Route::get('/themkhachhang','adminController@themKhachhang');
Route::post('/checkAddKhachhang','adminController@adCheckAddKhachhang');
Route::get('/deleteKhachhang/{id}','adminController@adDeleteKhachhang');
Route::get('/updateKhachhang/{id}','adminController@adUpdateKhachhang');
Route::post('/editKhachhang/{id}','adminController@editKhachhang');
//--Sản phẩm--//
Route::get('/themsanpham','adminController@themSanpham');
Route::post('/checkAddSanpham','adminController@adCheckAddSanpham');
Route::get('/deleteSanpham/{id}','adminController@adDeleteSanpham');
Route::get('/updateSanpham/{id}','adminController@adUpdateSanpham');
Route::post('/editSanpham/{id}','adminController@editSanpham');
Route::post('/themhinh','adminController@addHinhSanpham');
Route::get('/xoahinh/{tenhinh}/{id}','adminController@deleteHinhSanpham');
Route::post('/editMota/{id}','adminController@editMota');
Route::get('/loiThemHinhSP','adminController@viewLoiThemHinhSP');
//--Kho--//
Route::get('updateKho/{id}','adminController@updateKho');
Route::post('editKho/{id}','adminController@editKho');

//--Loai--//
Route::get('/themloai','adminController@themLoai');
Route::get('/checkAddLoai','adminController@adCheckAddLoai');
Route::get('/deleteLoai/{id}','adminController@adDeleteLoai');
Route::get('/updateLoai/{id}','adminController@adUpdateLoai');
Route::get('/editLoai/{id}','adminController@editLoai');
//--Nhu cầu --//
Route::get('/themnhucau','adminController@themNhucau');
Route::get('/checkAddNhucau','adminController@adCheckAddNhucau');
Route::get('/deleteNhucau/{id}','adminController@adDeleteNhucau');
Route::get('/updateNhucau/{id}','adminController@adUpdateNhucau');
Route::get('/editNhucau/{id}','adminController@editNhucau');
//--Thương hiệu--//
Route::get('/themthuonghieu','adminController@themThuonghieu');
Route::get('/checkAddThuonghieu','adminController@adCheckAddThuonghieu');
Route::get('/deleteThuonghieu/{id}','adminController@adDeleteThuonghieu');
Route::get('/updateThuonghieu/{id}','adminController@adUpdateThuonghieu');
Route::get('/editThuonghieu/{id}','adminController@editThuonghieu');
//--Banner--//
Route::get('/themBanner','adminController@themBanner');
Route::post('/checkAddBanner','adminController@adCheckAddBanner');
Route::get('/deleteBanner/{id}','adminController@adDeleteBanner');
Route::get('/updateBanner/{id}','adminController@adUpdateBanner');
Route::post('/editBanner/{id}','adminController@editBanner');
//--Khuyến mãi--//
Route::post('/checkAddKhuyenmai','adminController@adCheckAddKhuyenmai');
Route::get('/deleteKhuyenmai/{id}','adminController@adDeleteKhuyenmai');
////--Bình luận--//
Route::get('viewBLSP/{id}','adminController@viewBLSP');
Route::get('chitietBLSP/{id}','adminController@chitietBLSP');
//--Hóa đơn--//
Route::get('don-hang','adminController@viewHoadon');
Route::get('them-nv-giao-hang/{id}','adminController@themNVgiao');
Route::get('giaohang/{id}','adminController@giaohang');
Route::get('thanhtoan/{id}','adminController@thanhtoan');
Route::get('update-bao-cao-ngay','adminController@updateBaocao');
//--Báo cáo ngày--//
Route::get('bao-cao-ngay','adminController@viewBaocao');
Route::get('deleteBaocao/{id}','adminController@deleteBaocao');