@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">
@foreach($ncMaCu as $key => $value)
            <!-- Main Content -->
         <div id="content">
        	
			<form action="{{URL::to('/editNhucau/'.$value->ncMa)}}" method="GET">
				 {{ csrf_field() }}
				  <div class="flex__form">
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Tên nhu cầu</label>
			    
			    <input name="ncTen" type="text" value="{{$value->ncTen}}" class="form-control" id="ncTen">
			  </div>
			</div>
			 	<span style="color:red">{{$errors->first('ncTen')}}</span>
			  <button class="btn_ok" type="submit" name="btn_edit" class="btn btn-primary">Thực hiện</button>
			</form>
		<br/>
                                <button class="btn btn-info" type="button" onclick="back()">Trở về</button>
		</div>
			@endforeach
	</div>
	
@endsection