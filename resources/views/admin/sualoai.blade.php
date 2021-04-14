@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">
@foreach($loaiMaCu as $key => $value)
            <!-- Main Content -->
         <div id="content">
        	
			<form action="{{URL::to('/editLoai/'.$value->loaiMa)}}" method="GET">
				 {{ csrf_field() }}
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Tên loại</label>
			    
			    <input name="loaiTen" type="text" value="{{$value->loaiTen}}" class="form-control" id="loaiTen">
			  </div>
			 	<span style="color:red">{{$errors->first('loaiTen')}}</span>
			  <button type="submit" name="btn_edit" class="btn btn-primary">Thực hiện</button>
			</form>
		
		</div>
			@endforeach
	</div>
	
@endsection