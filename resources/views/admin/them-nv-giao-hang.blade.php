@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
        <div id="content">
        	@foreach($data as $value)
			<form action="{{URL::to('giaohang/'.$value->hdMa)}}" method="GET">
				 {{ csrf_field() }}
			  <div class="mb-3">
			  	<label for="exampleInputPassword1" class="form-label">Mã đơn hàng: {{$value->hdMa}}</label>
			  	<br/>
			    <label for="exampleInputPassword1" class="form-label">Chọn nhân viên nhận đơn hàng</label>
				<select style="width: 205px" class="form-control m-bot15" name="hdNhanvien">
		                            @foreach($dataNV as $v)
		                                <option value="{{$v->adMa}}" >{{$v->adTen}}</option>
		                            @endforeach
		         </select>
			 	<br/>
			  <button type="submit" name="btn_add" class="btn btn-primary">Bắt đầu giao hàng</button>
			</form>
		</div>
		@endforeach
	</div>
</div>

@endsection
 