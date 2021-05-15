@extends('Userpage.layout')
@section('title')
Danh sách đơn hàng
@endsection
@section('content')
<br><br><br>
<div class="container">
	<div class="row">
		<table style="text-align: center;" class="table-hover table table-inverse table-responsive">
			<thead>
				<tr>
					<th>Mã đơn hàng</th>
					<th>Ngày đặt</th>
					<th>Số lượng sản phẩm</th>
					<th>Tình trạng</th>
					<th>Địa chỉ giao hàng</th>
					<th>Số điện thoại người nhận</th>
					<th>Ghi chú</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
					@foreach($list as $i)


						<tr>
							<td>{{$i->hdMa}}</td>
							<td>{{date_format(date_create($i->hdNgaytao),('d/m/Y'))}}</td>
							<td>{{$i->hdSoluongsp}}</td>
							<td>
								@if($i->hdTinhtrang==0)
									<span style="color:red;">Đang chờ xác nhận</span>
								@elseif($i->hdTinhtrang==1)
									<span style="color:blue;">Đang giao hàng</span>
								@else
									<span style="color:green;">Đã thanh toán</span>
								@endif
							</td>
							<td>{{$i->hdDiachi}}</td>
							<td>{{$i->hdSdtnguoinhan}}</td>
							<td>{{$i->hdGhichu}}</td>
							<td>
								<a class="btn btn-outline-warning" id="myBtn" onclick="view()">Xem</a>
									<!-- The Modal -->
								<div id="myModal" class="modal">

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

<script>
	function view()
	{
		// Get the modal

		var modal = document.getElementById("myModal");
		var span = document.getElementsByClassName("close")[0];
		 modal.style.display = "block";
		window.onclick = function(event) {
		  if (event.target == modal) {
		    modal.style.display = "none";
		  }
		}
	}

</script>
@endsection


