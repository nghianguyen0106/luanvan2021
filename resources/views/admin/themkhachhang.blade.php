@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
        <div id="content">
			<form action="{{URL::to('/checkAddKhachhang')}}" method="POST"  enctype="multipart/form-data">
				 {{ csrf_field() }}
				  <legend>Thêm thông tin khách hàng</legend>
				 <hr/>
			<div class="flex__form">
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Tên khách hàng</label>
			    <input name="khTen" type="text" class="form-control" id="khTen">
			    <span style="color:red">{{$errors->first('khTen')}}</span>
			  </div>
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">SDT</label>
			    <input name="khSdt" type="number" class="form-control" id="adSdt">
			     <span style="color:red">{{$errors->first('khSdt')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Email</label>
			    <input name="khEmail" type="email" class="form-control" id="khEmail">
			     <span style="color:red">{{$errors->first('khEmail')}}</span>
			  </div>
			</div>

			<div class="flex__form">
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Tài khoản cho khách hàng</label>
			    <input name="khTaikhoan" type="text" class="form-control" id="khTaikhoan">
			     <span style="color:red">{{$errors->first('khTaikhoan')}}</span>
			    
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
			    <input name="khMatkhau" type="password" class="form-control" id="khMatkhau">
			     <span style="color:red">{{$errors->first('khMatkhau')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Ngày sinh</label><br/>
			    <input name="khNgaysinh" type="date" class="dateInput" id="khNgaysinh">
			     <span style="color:red">{{$errors->first('khNgaysinhn')}}</span>
			  </div>
			</div>


			<div class="flex__form">
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Địa chỉ</label>
			    <input name="khDiachi" type="text" class="form-control" id="khDiachi">
			     <span style="color:red">{{$errors->first('khDiachi')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Giới tính</label>
			    <br/>
			    &emsp;<input name="khGioitinh" value="1" type="radio"  id="khGioitinh">Nam
			    &emsp;<input name="khGioitinh"  value="0" type="radio"  id="khGioitinh">Nữ
			    <span style="color:red">{{$errors->first('khGioitinh')}}</span>
			  </div>
			   <div class="mb-3">

			    <label for="exampleInputPassword1" class="form-label">Quyền</label>
			    <input name="khQuyen" type="number" value="0" class="form-control" id="khQuyen">
			     <span style="color:red">{{$errors->first('khQuyen')}}</span>
			  </div>
			</div>
			<br/>
			 	<div class="mb-3">
			    <input name="khHinh" type="file" class="form-control" id="khHinh">
			     <label for="khHinh" class="lb__khHinh"><i class="fas fa-file-upload" style="font-size: 20px;">&nbsp;Thêm ảnh khách hàng</i></label>
			  </div>
			  <br/>
			   &emsp;
			  <button class="btn btn-dark" type="button" onclick="back()">Trở về</button>
			  &emsp; &emsp; &emsp;
			  <button class="btn_ok" type="submit" name="btn_khd" class="btn btn-primary">Thực hiện</button>
			</form>
			<br/>
                    
		</div>
	</div>
	</div>
@endsection
 