@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
        <div id="content">
			<form action="{{URL::to('/checkAddNhucau')}}" method="GET">
				 {{ csrf_field() }}
				  <div class="flex__form">
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Nhu cầu sử dụng</label>
			    <input name="ncTen" type="text" class="form-control" id="ncTen">
			      <span style="color:red">
			     	@if(Session::has('nc_err')!=null)
			     		{{Session::get('nc_err')}}
			     	@endif
			     </span>
			  </div>
			</div>
			 	<span style="color:red">{{$errors->first('ncTen')}}</span>
			  <button class="btn_ok" type="submit" name="btn_edit" class="btn btn-primary">Thực hiện</button>
			</form>
			<br/>
                                <button class="btn btn-info" type="button" onclick="back()">Trở về</button>
		</div>
	</div>
@endsection
 