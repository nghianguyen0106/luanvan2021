
@extends('admin.layout')

@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

@foreach($khMaCu as $key => $value)
			   		
            <!-- Main Content -->
         <div id="content">
			<form action="{{URL::to('/editKhachhang/'.$value->khMa)}}" method="GET">
				 {{ csrf_field() }}
				  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Mã khách hàng</label>
			    <input name="khMa" type="number" readonly value="{{$value->khMa}}" class="form-control" id="khMa">
			    <span style="color:red">{{$errors->first('khTen')}}</span>
			  </div>
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Tên khách hàng</label>
			    <input name="khTen" type="text" value="{{$value->khTen}}" class="form-control" id="khTen">
			    <span style="color:red">{{$errors->first('khTen')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Email</label>
			    <input name="khEmail" type="email" value="{{$value->khEmail}}" class="form-control" id="khEmail">
			     <span style="color:red">{{$errors->first('khEmail')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Tài khoản cho khách hàng</label>
			    <input name="khTaikhoan" type="text" value="{{$value->khTaikhoan}}" class="form-control" id="khTaikhoan">
			     <span style="color:red">{{$errors->first('khTaikhoan')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
			    <input name="khMatkhau" type="password" value="{{$value->khMatkhau}}" class="form-control" id="khMatkhau">
			     <span style="color:red">{{$errors->first('khMatkhau')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Ngày sinh</label>
			    <input name="khNgaysinh" type="date" value="{{$value->khNgaysinh}}" class="form-control" id="khNgaysinh">
			     <span style="color:red">{{$errors->first('khNgaysinhn')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Địa chỉ</label>
			    <input name="khDiachi" type="text" value="{{$value->khDiachi}}" class="form-control" id="khDiachi">
			     <span style="color:red">{{$errors->first('khDiachi')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Giới tính</label>
			    <br/>
			    &emsp;<input name="khGioitinh" {{$value->khGioitinh==1?"checked":"unchecked"}} value="1" type="radio"  id="khGioitinh">Nam
			    &emsp;<input name="khGioitinh"  {{$value->khGioitinh==0?"checked":"unchecked"}} value="0" type="radio"  id="khGioitinh">Nữ
			    <span style="color:red">{{$errors->first('khGioitinh')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Quyền</label>
			    <input name="khQuyen" value="{{$value->khQuyen}}" type="number" class="form-control" id="khQuyen">
			     <span style="color:red">{{$errors->first('khQuyen')}}</span>
			  </div>

			 	
			  <button type="submit" name="btn_khd" class="btn btn-primary">Thực hiện</button>
			</form>
		</div>
			@endforeach
	</div>
	
@endsection