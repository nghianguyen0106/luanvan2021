@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
        <div id="content">
			<form action="{{URL::to('checkAddThuonghieu')}}" method="GET">
				 {{ csrf_field() }}
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Tên thương hiệu</label>
			    <input name="thTen" type="text" class="form-control" id="thTen">
			     <span style="color:red">
			     	@if(Session::has('th_err')!=null)
			     		{{Session::get('th_err')}}
			     	@endif
			     </span>
			  </div>
			 	<span style="color:red">{{$errors->first('thTen')}}</span>
			  <button type="submit" name="btn_add" class="btn btn-primary">Thực hiện</button>
			</form>
		</div>
	</div>
@endsection
 