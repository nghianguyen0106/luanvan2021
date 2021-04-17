<?php

use Illuminate\Support\Facades\Route;



//---------------------------------------------USER----------------------------------------------------//
Route::get('/', 'homeController@welcome' );


Route::get('/product','homeController@product' );
Route::get('/checkout','homeController@checkout' );
//--------User register------//
Route::get('/register','registerController@index');
Route::post('/getregister','registerController@getregister');

//--------User Login------//
Route::post('/checklogin','loginController@userlogin');
Route::get('login','homeController@login' );
Route::get('logout','homeController@logout');

// -------Product -----------//
Route::get('proinfo/{id}','homeController@proinfo');
Route::post('findpro','homeController@findpro');
//---------------------------------------------END USER--------------------------------------------//








//---------------------------------------------ADMIN----------------------------------------------------//
//--------Admin Login------//
Route::get('admin','adminController@index');
Route::get('/adLogin','adminController@adLoginView');
Route::get('/checkLogin','adminController@checkLogin');
Route::get('/adLogout','adminController@logout');

//--------Admin Manage View------//
Route::get('/adNhanvien','adminController@viewNhanvien');
Route::get('/adKhachhang','adminController@viewKhachhang');
Route::get('/adSanpham','adminController@viewSanpham');
Route::get('/motasanpham/{id}','adminController@viewMotaSanpham');
Route::get('/adLoai','adminController@viewLoai');
Route::get('/adThuonghieu','adminController@viewThuonghieu');
Route::get('/adNhucau','adminController@viewNhucau');
Route::get('/adKhuyenmai','adminController@viewKhuyenmai');
Route::get('/adBanner','adminController@viewBanner');

//--------Admin Add Manage View------//
//--Nhân viên--//
Route::get('/themnhanvien','adminController@themAdmin');
Route::get('/checkAddAdmin','adminController@adCheckAddAdmin');
Route::get('/deleteAdmin/{id}','adminController@adDeleteAdmin');
Route::get('/updateAdmin/{id}','adminController@adUpdateAdmin');
Route::get('/editAdmin/{id}','adminController@editAdmin');

//--Khách hàng--//
Route::get('/themkhachhang','adminController@themKhachhang');
Route::get('/checkAddKhachhang','adminController@adCheckAddKhachhang');
Route::get('/deleteKhachhang/{id}','adminController@adDeleteKhachhang');
Route::get('/updateKhachhang/{id}','adminController@adUpdateKhachhang');
Route::get('/editKhachhang/{id}','adminController@editKhachhang');
//--Sản phẩm--//
Route::get('/themsanpham','adminController@themSanpham');
Route::post('/checkAddSanpham','adminController@adCheckAddSanpham');
Route::get('/deleteSanpham/{id}','adminController@adDeleteSanpham');
Route::get('/updateSanpham/{id}','adminController@adUpdateSanpham');
Route::post('/editSanpham/{id}','adminController@editSanpham');
Route::post('/themhinh','adminController@addHinhSanpham');
Route::get('/xoahinh/{tenhinh}/{id}','adminController@deleteHinhSanpham');
Route::post('/editMota/{id}','adminController@editMota');

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