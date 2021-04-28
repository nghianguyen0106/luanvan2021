@extends('userpage.layout')
@section('content')

<!-- banner -->

<!---Content--->
 <div class="container">
	<div class="row">
		<div class="col-2"></div>
		<div class="col-8">
			<br/>
			
			@foreach($data as $v)
				<form class="box__info" action="{{url("edit_infomation/".$v->khMa)}}" method="POST">
					  {{csrf_field()}}
				<h3 style="color:orange;">Thông tin của bạn</h3>
				<hr/>
				<div class="flex__info">
					<span class="info__item">Tên:</span>
					<span  class="info__item">
						<input class="ip" type="text" value="{{$v->khTen}}" name="khTen"/>
					</span>
					 <span style="color:red">{{$errors->first('khTen')}}</span>
				</div>
				<br/>
				<div class="flex__info">
					<span class="info__item">Tài khoản đăng nhập:</span>
					<span  class="info__item">
						<input class="ip" type="text" value="{{$v->khTaikhoan}}" name="khTaikhoan"/>
					</span>
					<span style="color:red">{{$errors->first('khTaikhoan')}}</span>
				</div>
				<br/>
				<div class="flex__info">
					<span class="info__item">Email:</span>
					<span>
						<input class="ip" type="email" value="{{$v->khEmail}}" name="khEmail"/>
					</span>
					 <span style="color:red">{{$errors->first('khEmail')}}</span>
				</div>
				<br/>
				<div class="flex__info">
					<span class="info__item">Địa chỉ:</span>
					<span  class="info__item" class="info__item">
						<input class="ip" type="text" value="{{$v->khDiachi}}" name="khDiachi"/>
					</span>
					<span style="color:red">{{$errors->first('khDiachi')}}</span>
				</div>
				<br/>
				<div class="flex__info">
					<span class="info__item">Ngày sinh:</span>
					<span  class="info__item" class="info__item">
						<input class="ip" type="text" value= "{{$v->khNgaysinh}}" name="khNgaysinh"/>
					</span>
					<span style="color:red">{{$errors->first('khNgaysinh')}}</span>
				</div>
				<br/>
				<div class="flex__info">
					<span class="info__item">Giới tính:</span>
					<span class="info__item">
						<input value="0" type="radio" {{$v->khGioitinh==0?"checked":"unchecked"}} name="khGioitinh"/>Nam &emsp;
					 	<input value="1" type="radio" {{$v->khGioitinh==1?"checked":"unchecked"}} name="khGioitinh"/>Nữ
					 </span>
				 </div>
				<br/>
				 <a class="btn_editPass" href="{{url('updatePass/'.$v->khMa)}}">Đổi mật khẩu</a>
				&emsp;
				<button class="btn_editInfo" type="submit">Cập nhật thông tin</button>
				
				
				<br/>
				<br/>
				</form>
				
				<br/>
			@endforeach
		</div>
		<div class="col-2"></div>
	</div>
</div>

@endsection




