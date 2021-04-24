@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">
@foreach($dataKho as $key => $value)
            <!-- Main Content -->
         <div id="content">
        	
			<form action="{{URL::to('/editKho/'.$value->spMa)}}" method="POST">
				 {{ csrf_field() }}
			  <div class="mb-3">
			  	 <label for="exampleInputPassword1" class="form-label">Mã sản phẩm</label>
			    <input readonly type="text" value="{{$value->spMa}}" class="form-control">
			  	<br/>
			    <label for="exampleInputPassword1" class="form-label">Số lượng sản phẩm</label>
			    <input name="khoSoluong" type="text" value="{{$value->khoSoluong}}" class="form-control" id="khoSoluong">
			  </div>
			 	<span style="color:red">{{$errors->first('khoSoluong')}}</span>
			 	<br/>
			  <button type="submit" name="btn_edit" class="btn btn-primary">Thực hiện</button>
			</form>
		
		</div>
			@endforeach
	</div>
	
@endsection