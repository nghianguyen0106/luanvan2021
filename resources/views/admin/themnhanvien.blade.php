@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
        <div id="content">
			<form action="{{URL::to('checkAddAdmin')}}" method="GET">
				 {{ csrf_field() }}
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Tên nhân viên</label>
			    <input name="adTen" type="text" class="form-control" id="adTen">
			    <span style="color:red">{{$errors->first('adTen')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Tài khoản cho nhân viên</label>
			    <input name="adTaikhoan" type="text" class="form-control" id="adTaikhoan">
			     <span style="color:red">{{$errors->first('adTaikhoan')}}</span>
			      <span style="color:red">
			     	@if(Session::has('ad_err')!=null)
			     		{{Session::get('ad_err')}}
			     	@endif
			     </span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
			    <input name="adMatkhau" type="password" class="form-control" id="adMatkhau">
			     <span style="color:red">{{$errors->first('adMatkhau')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Email</label>
			    <input name="adEmail" type="email" class="form-control" id="adEmail">
			     <span style="color:red">{{$errors->first('adEmail')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Quyền</label>
			    <input name="adQuyen" type="number" class="form-control" id="adQuyen">
			     <span style="color:red">{{$errors->first('adQuyen')}}</span>
			  </div>

			 	
			  <button type="submit" name="btn_add" class="btn btn-primary">Thực hiện</button>
			</form>
		</div>
	</div>
@endsection
 