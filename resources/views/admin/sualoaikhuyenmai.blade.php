@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column" >

            <!-- Main Content -->
        <div id="content" class="container">
        	<br/>
			<form action="{{URL::to('checksualoaikhuyenmai/'.$data->lkmMa)}}" method="POST"  >
				 {{ csrf_field()}}
				 <legend>Sửa loại khuyến mãi</legend>
				 <div class="row">
				 	<div class="mb-3 col-6">
						<label>Mã loại khuyến mãi<input class="form-control" type="text" name="lkmMa" readonly="" value="{{$data->lkmMa}}"></label>
					</div>
					<div class="mb-3 col-6">
						<label>Tên loại khuyến mãi<input  class="form-control"  type="text" name="lkmTen" value="{{$data->lkmTen}}"></label>
						<span style="color: red;" >{{$errors->first('lkmTen')}}</span>
					</div>
					 	<div class="mb-3 col-6">
						  <button class="btn btn-secondary" type="button" onclick="back()">Trở về</button>
						</div>

					 	<div class="mb-3 col-6">
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


@if(Session::has('success'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Done ! ',
  text: '{{Session::get('success')}}',
 
})
</script> 
@endif




@endsection

