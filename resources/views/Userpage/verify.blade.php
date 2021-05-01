@extends('Userpage.layout')
@section('title')
Xác thực Email
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div id="form" class="col-12">
				<h3>Một mã xác thực sẽ được gửi đến email {{substr($userEmail->khEmail,0,5)}}.......... </h3>
				<a href="{{URL::to('sendcode')}}" onclick="hide()" class="btn btn-primary">Gửi mã xác thực</a>
			</div>
			<div id="code"class="col-4">
				<form action="{{URL::to('verifycode')}}" method="post" accept-charset="utf-8">
				{{csrf_field()}}
				<div class="input-group-prepend">
				    <span class="input-group-text" id="basic-addon1"><input type="text" class="form-control" placeholder="Nhập mã tại đây" aria-label="Username" name="code" aria-describedby="basic-addon1"></span>
				  </div>
				  <span><button type="submit" class="btn btn-primary">Gửi</button></span>
				</form>
				<div class="input-group-prepend">

			</div>
			
		</div>
	</div>

@if(Session::has('verifySuccess'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Thông báo: ',
  text: '{{Session::get('verifySuccess')}}',
 
})
</script> 
@endif

@if(Session::has('verifyFail'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('verifyFail')}}',
 
})
</script> 
@endif
@endsection