@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
        <div id="content">
			<form action="{{URL::to('checkAddLoai')}}" method="GET">
				 {{ csrf_field() }}
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Tên loại</label>
			    <input name="loaiTen" type="text" class="form-control" id="loaiTen">
			      <span style="color:red">
			     	@if(Session::has('loai_err')!=null)
			     		{{Session::get('loai_err')}}
			     	@endif
			     </span>
			  </div>
			 	<span style="color:red">{{$errors->first('loaiTen')}}</span>
			  <button type="submit" name="btn_add" class="btn btn-primary">Thực hiện</button>
			</form>
		</div>
	</div>
@endsection
 