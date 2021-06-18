@extends('Userpage.layout_dn_dk')
@section('title')
Xác thực Email
@endsection
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-1"></div>
			<div class="col-10">
					<h3>Một mã xác thực sẽ được gửi đến email {{$userEmail->khEmail}} </h3>
			</div>
		</div>
		<div class="row">
			<div class="mb-4 col-2"></div>
			<div class="mb-4 col-6">
				<div class="row">
					<form action="{{URL::to('verifycode')}}" method="post" accept-charset="utf-8">
					{{csrf_field()}}
						<div class="form-control-success col-2">
						    <input type="text" class="form-control" placeholder="Nhập mã tại đây" aria-label="Username" name="code" aria-describedby="basic-addon1">
						</div>
						<div class="mb-4 col-2">
								<a href="{{URL::to('sendcode')}}" onclick="hide()" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Gửi mã xác thực</a>
						</div>
						<div class="mb-4 col-2">
								<button style="" type="submit" class="btn btn-primary"><i class="far fa-check-square"></i> Xác nhận</button>
						</div>
					</form>
				</div>
					
			</div>
			<div class="mb-4 col-4"></div>
	</div>
</div>
@if(Session::has('success'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Thông báo: ',
  text: '{{Session::get('success')}}',
 
})
</script> 
@endif

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