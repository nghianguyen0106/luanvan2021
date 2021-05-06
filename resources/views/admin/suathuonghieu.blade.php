@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">
@foreach($thMaCu as $key => $value)
            <!-- Main Content -->
         <div id="content">
        	
			<form action="{{URL::to('/editThuonghieu/'.$value->thMa)}}" method="GET">
				 {{ csrf_field() }}
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Tên thương hiệu</label>
			    
			    <input name="thTen" type="text" value="{{$value->thTen}}" class="form-control" id="thTen">
			  </div>
			 	<span style="color:red">{{$errors->first('thTen')}}</span>
			  <button class="btn_ok" type="submit" name="btn_edit" class="btn btn-primary">Thực hiện</button>
			</form>
		
		</div>
			@endforeach
	</div>
	
@endsection