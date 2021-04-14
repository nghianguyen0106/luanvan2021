@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">
@foreach($adMaCu as $key => $value)
            <!-- Main Content -->
         <div id="content">
			<form action="{{URL::to('/editAdmin/'.$value->adMa)}}" method="GET">
				 {{ csrf_field() }}
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Tên nhân viên</label>
			    <input name="adTen" type="text" value="{{$value->adTen}}" class="form-control" id="adTen">
			    <span style="color:red">{{$errors->first('adTen')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Tài khoản cho nhân viên</label>
			    <input name="adTaikhoan" type="text" value="{{$value->adTaikhoan}}" class="form-control" id="adTaikhoan">
			     <span style="color:red">{{$errors->first('adTaikhoan')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
			    <input name="adMatkhau" type="password" value="{{$value->adMatkhau}}" class="form-control" id="adMatkhau">
			     <span style="color:red">{{$errors->first('adMatkhau')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Email</label>
			    <input name="adEmail" type="email" value="{{$value->adEmail}}" class="form-control" id="adEmail">
			     <span style="color:red">{{$errors->first('adEmail')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Quyền</label>
			    <input name="adQuyen" type="number" value="{{$value->adQuyen}}" class="form-control" id="adQuyen">
			     <span style="color:red">{{$errors->first('adQuyen')}}</span>
			  </div>

			 	
			  <button type="submit" name="btn_add" class="btn btn-primary">Thực hiện</button>
			</form>
		</div>
			@endforeach
	</div>
	
@endsection