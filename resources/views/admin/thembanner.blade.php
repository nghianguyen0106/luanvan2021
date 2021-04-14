@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
        <div id="content">
			<form action="{{URL::to('checkAddBanner')}}" method="POST" enctype="multipart/form-data">
				 {{ csrf_field() }}
			  <div class="mb-3">
			  	<br/>
			  	 
			  	<span>Thêm hình ảnh cho banner:</span>
			    <input name="bnHinh" type="file" class="form-control" id="bnHinh">
			  </div>
			 	<span style="color:red">
			 		@if(Session::has('bnError'))
			 			{{Session::get('bnError')}}

			 		@endif
			 	</span>
			  <button type="submit" name="btn_add" class="btn btn-primary">Thực hiện</button>
			</form>
		</div>
	</div>
@endsection
 