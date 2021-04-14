@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">
@foreach($bnMaCu as $key => $value)
            <!-- Main Content -->
         <div id="content">
        	
			<form action="{{URL::to('/editBanner/'.$value->bnMa)}}" method="POST" enctype="multipart/form-data">
				 {{ csrf_field() }}
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Bạn muốn thay đổi hình ảnh banner, vui lòng chọn ảnh</label>
			    
			    <input name="bnHinh" type="file" value="{{$value->bnHinh}}" class="form-control" id="bnHinh">
			  </div>
			 	<span style="color:red">
			 	@if(Session::has('bnError'))
			 			{{Session::get('bnError')}}

			 		@endif
			 	</span>
			  <button type="submit" name="btn_edit" class="btn btn-primary">Thực hiện</button>
			</form>
		
		</div>
			@endforeach
	</div>
	
@endsection