@extends('Userpage.layout')
@section('title')
Danh sách đơn hàng
@endsection
@section('content')
<br>
<div class="container">
	<div class="row">
		<table style="text-align: center;" class="table-hover table table-inverse table-responsive">
			<thead>
				<tr>
					<th>Mã đơn hàng</th>
					<th>Ngày đặt</th>
					<th>Số lượng sản phẩm</th>
					<th>Địa chỉ giao hàng</th>
					<th>Số điện thoại người nhận</th>
					<th>Ghi chú</th>
					<th>Tình trạng</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
					@foreach($list as $i)
						<tr>
							<td>{{$i->hdMa}}</td>
							<td>{{date_format(date_create($i->hdNgaytao),('d/m/Y'))}}</td>
							<td>{{$i->hdSoluongsp}}</td>
							<td>{{$i->hdDiachi}}</td>
							<td>{{$i->hdSdtnguoinhan}}</td>
							<td>{{$i->hdGhichu}}</td>
								@if($i->hdTinhtrang==0)
									<td><span stylFFe="color:red;">Đang chờ xác nhận</span></td>
									<td><a class="btn btn-danger" href="{{url('huy-don/'.$i->hdMa)}}" >Hủy đơn</a></td>
									@elseif($i->hdTinhtrang==1)
										<td><span style="color:blue;">Đang giao hàng</span></td>
									@elseif($i->hdTinhtrang==2)
										<td><span style="color:green;">Đã thanh toán</span></td>
									@else
										<td><span style="color:red;">Đang chờ xử lý hủy</span></td>
								@endif
							</td>
							<td>
								<a class="btn btn-outline-warning" id="myBtn" onclick="view{{$i->hdMa}}()">Xem</a>
									<!-- The Modal -->
								<div id="myModal{{$i->hdMa}}" class="modal">

								  <!-- Modal content -->
								  <div class="modal-content">
								    <div class="close">Chi tiết đơn hàng</div>

								    <table class="table-hover table table-inverse table-responsive">
								    	<thead>
								    		<tr>
								    			<th>Tên sản phẩm</th>
								    			<th></th>
								    			<th>Số lượng</th>
								    			<th>Đơn giá</th>
								    		</tr>
								    	</thead>
								    	<tbody>
								    		@foreach($details as $v)
								    			@if($v->hdMa==$i->hdMa)
										    		<tr>
										    			<td>{{$v->spTen}}</td>
										    			<td class="invert-image"><a href="{{URL::to('proinfo/'.$v->spMa)}}"><img style="width: 100px;height: 100px;" src="{{URL::asset('public/images/products/'.$v->spHinh)}}" alt=" " class="img-responsive" /></a></td>
										    			<td>{{$v->cthdSoluong}}</td>
										    			<td>{{number_format($v->cthdGia)}} VND</td>
										    		</tr>
								    			@endif
								    		@endforeach
								    	</tbody>
								    </table>
								  </div>
								</div>

							</td>
						</tr>
							
					@endforeach					
			</tbody>
		</table>
	</div>
</div>

@foreach($list as $i)
<script>
	function view{{$i->hdMa}}()
	{
		// Get the modal

		var modal = document.getElementById("myModal{{$i->hdMa}}");
		var span = document.getElementsByClassName("close")[0];
		 modal.style.display = "block";
		window.onclick = function(event) {
		  if (event.target == modal) {
		    modal.style.display = "none";
		  }
		}
	}
</script>
@endforeach
@endsection


