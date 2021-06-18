@extends('Userpage.layout')
@section('title')
Thông tin cá nhân
@endsection
@section('content')

<!-- banner -->
<br/>
<!---Content--->
 <div class="container">
	<div class="row">
			<h2 style="color:orange;">Thông tin của bạn</h2>
				<hr/>
		<div class="col-lg-12">
			<br/>
			@foreach($data as $v)
				<form class="col-lg-12 box__info" action="{{url("edit_infomation/".$v->khMa)}}" method="POST" enctype="multipart/form-data">
					  {{csrf_field()}}
					  <div class="row">
				<div class="col-lg-7">
				<div class="flex__info">
					<span class="info__item">Tên:</span>
					<span class="info__item">
						<input onblur="onName()" id="ip__name" class="ip" type="text" value="{{$v->khTen}}" name="khTen"/>
					</span>
					 <div>
						<br/>
						<br/>
						 <span style="color:red">{{$errors->first('khTen')}}</span>
					<span style="margin-left: -6rem;" id="name__err--regis"></span>
					</div>
				</div>
				<br/>
				<div class="flex__info">
					<span class="info__item">Tên đăng nhập: </span>
					<span  class="info__item">
						<input class="ip" type="text" readonly value="{{$v->khTaikhoan}}" name="khTaikhoan"/>
					</span>
					<span style="color:red">{{$errors->first('khTaikhoan')}}</span>
				</div>
				<br/>
				<div class="flex__info">
					<span class="info__item">Email:</span>
					
					<span class="info__item">
						@if($v->khXtemail!=1)
						<input readonly="" class="ip" type="email" value="{{$v->khEmail}}" name="khEmail"/>
						@else
						<input  class="ip" value="{{$v->khEmail}}" name="khEmail"><i style="color: green" class="far fa-check-square"></i>
				
						<a  class="btn btn-secondary" href="{{URL::to('changeEmail/'.$v->khMa)}}">Thay đổi Email</a>
						@endif
						@if($v->khXtemail!=1)

						<span class="info__item" style="color: red;">Email chưa được xác thực!</span>
						<br/>
						<a href="{{URL::to('verify-email/'.$v->khMa)}}" class="btn btn-warning">Xác thực Email</a>

						@endif
					</span>

					 <span style="color:red">{{$errors->first('khEmail')}}</span>
					
					 @if(Session::has('Cemail_err'))
					  <span style="color:red">{{Session::get('Cemail_err')}}</span>
					 @endif
				</div>
				<br/>
				<div class="flex__info">
					<span class="info__item">Số điện thoại:</span>
					<span class="info__item" class="info__item">
						<input onblur="onSDT()" id="sdt" class="ip" type="text" value="{{$v->khSdt}}" name="khSdt"/>
					</span>
					<div>
						<br/>
						<br/>
						<span style="color:red">{{$errors->first('khSdt')}}</span>
					<span style="margin-left: -6rem;" id="sdt__err--regis"></span>
					</div>
				</div>
				<br/>
				<div class="flex__info">
					<span class="info__item">Địa chỉ:</span>
					<span  class="info__item" class="info__item">
						<input onblur="onAddress()" id="address" class="ip" type="text" value="{{$v->khDiachi}}" name="khDiachi"/>
					</span>
						<div>
						<br/>
						<br/>
						<span style="color:red">{{$errors->first('khDiachi')}}</span>
					<span style="margin-left: -3rem;" id="address__err--regis"></span>
					</div>
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
				<br/>
				</div>
				<div class="col-lg-5">
				
					@if($v->khHinh!=null)
					
					 <img style="width: 300px;height: 300px;border-radius: 360px" src="{{{'../public/images/khachhang/'.$v->khHinh}}}" />
					 @endif
					 <br/><br/>
					 <input id="khHinh" name="khHinh" type="file" />
					 <label for="khHinh" class="lb__khHinh"><i class="fas fa-file-upload" style="font-size: 20px;">&nbsp;Chọn ảnh khác</i></label>
					 <br/>
					 <br/>
					
				</div>
			</div>
			 <a class="btn_editPass" href="{{url('updatePass/'.$v->khMa)}}">Đổi mật khẩu</a>
				
					<button id="btn__register" class="btn_editInfo" type="submit">Cập nhật thông tin</button>
				 <br/>
				</form>
				 <br/>
		</div>
	
		@endforeach
	</div>
</div>

@if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('err')}}',
 
})
</script> 
@endif

@if(Session::has('success'))
<script type="text/javascript" >
	Swal.fire({
		icon:'info',
  title: '{{Session::get('success')}}',
  showDenyButton: true,

  confirmButtonText: `Ok`,
  denyButtonText: `Để sau`,

}).then((result) => {
  if(result.isDenied) 
  {
    document.location.href="{{URL::to('cancelinfo')}}";
  }
})

</script> 

@endif
@endsection
<script src="{{url('public/fe/js/js-validate/validate-register.js')}}"></script>



