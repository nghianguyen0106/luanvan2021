@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column" >

            <!-- Main Content -->
        <div id="content" class="container">
        	<br/>
			<form class="row" action="{{URL::to('checkAddNcc/')}}" method="POST"  >
				 {{ csrf_field()}}

				 	<div class="col-lg-3"></div>
				 	<div class="col-lg-5 info__left">
				 		<br/>
				<h5 class="text-dark text-center">THÔNG TIN</h5>
					<div class="form-group">
						<label>Tên nhà cung cấp<input  class="form-control"  type="text" name="nccTen" ></label><br><span class="alert-danger">{{$errors->first('nccTen')}}</span>
					</div>

					<div class="form-group">
						<label>Số điện thoại<input  class="form-control"  type="number" name="nccSdt" ></label><br><span class="alert-danger">{{$errors->first('nccSdt')}}</span>
					</div>
					<div class="form-group">
						<label>Địa chỉ<input  class="form-control"  type="text" name="nccDiachi"></label><br><span class="alert-danger">{{$errors->first('nccDiachi')}}</span>
						<br/><br/>
						 <button class="btn btn-secondary" type="button" onclick="back()">Trở về</button>
						&emsp;
						  <button class="btn btn-primary" type="submit">Thực hiện</button>
					</div>
					</div>
			 	
			</form>
                               
		</div>
	</div>



@if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Opss... ',
  text: '{{Session::get('err')}}',
 
})
</script> 
@endif
@endsection

