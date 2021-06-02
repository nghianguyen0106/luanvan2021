@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column" >

            <!-- Main Content -->
        <div id="content" class="container">
        	<br/>
			<form action="{{URL::to('checkAddNcc/')}}" method="POST"  >
				 {{ csrf_field()}}
				 <legend>Thêm nhà cung cấp</legend>
				 <div class="row">
					<div class="mb-3 col-6">
						<label>Tên nhà cung cấp<input  class="form-control"  type="text" name="nccTen" ></label><br><span class="alert-danger">{{$errors->first('nccTen')}}</span>
					</div>
					<div class="mb-3 col-6">
						<label>Số điện thoại<input  class="form-control"  type="number" name="nccSdt" ></label><br><span class="alert-danger">{{$errors->first('nccSdt')}}</span>
					</div>
					<div class="mb-3 col-12">
						<label>Địa chỉ<input  class="form-control"  type="text" name="nccDiachi"></label><br><span class="alert-danger">{{$errors->first('nccDiachi')}}</span>
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
@endsection

