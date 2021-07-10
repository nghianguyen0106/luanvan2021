@extends('Userpage.layout')
@section('title')
Danh sách đơn hàng
@endsection
@section('content')
<br>
<section class="list__order">
	<div class="container-fluid">
		<div class="row">
		<div class="col-1_5"></div>
		<div class="col-lg-9">
		<div class="row">
			<div class="col-lg-12">
				<table class="order__table">
					<thead>
						<tr>
							<td colspan="8">
								DANH SÁCH ĐƠN HÀNG
							</td>
						</tr>
					</thead>
					<tbody>
						<tr class="thead">
							<td>Mã đơn hàng</td>
							<td>Ngày đặt</td>
							<td>Số lượng</td>
							<td>Tổng tiền</td>
							<td>Địa chỉ giao hàng</td>
							<td>Số điện thoại nhận</td>
							<td>Tình trạng</td>
							<td></td>
							<td></td>
						</tr>

						@foreach($list as $i)
					@if($i->hdTinhtrang!=3)
						<tr>
							<td>{{$i->hdMa}}</td>
							<td>{{date_format(date_create($i->hdNgaytao),('d/m/Y'))}}</td>
							<td>{{$i->hdSoluongsp}}</td>
							<td>{{number_format($i->hdTongtien)}} VND</td>
							<td>{{$i->hdDiachi}}</td>
							<td>{{$i->hdSdtnguoinhan}}</td>
							<td>
								@if($i->hdTinhtrang==0)
									<span style="color:red;">Đang chờ xác nhận</span>
								@elseif($i->hdTinhtrang==1)
										<span style="color:blue;">Đang giao hàng</span>
								@elseif($i->hdTinhtrang==2)
										<span style="color:green;">Đã thanh toán</span>
								@endif
							</td>
							<td>
								<a class="btn btn-dark text-white" id="myBtn" onclick="view{{$i->hdMa}}()">Xem</a>
									<!-- The Modal -->
								<div id="myModal{{$i->hdMa}}" class="modal">

								  <!-- Modal content -->
								  <div class="modal-content">
								    <div class="close text-dark">Chi tiết đơn hàng</div>

								    <table class="order__table">
								    	<tbody>
								    		<tr class="thead">
								    			<td>Tên sản phẩm</td>
								    			<td>Hình</td>
								    			<td>Số lượng</td>
								    			<td>Đơn giá</td>
								    		</tr>
								    		@foreach($details as $v)
								    			@if($v->hdMa==$i->hdMa)
										    		<tr>
										    			<td>{{$v->spTen}}</td>
										    			<td class="invert-image"><a href="{{URL::to('proinfo/'.$v->spMa)}}"><img src="{{URL::asset('public/images/products/'.$v->spHinh)}}" alt=" " class="img-responsive" /></a></td>
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
							<td>
								@if($i->hdTinhtrang==0)
									<a class="btn btn-danger" href="{{url('huy-don/'.$i->hdMa)}}">Hủy đơn</a>
								@endif
							</td>
						</tr>
						@endif						
					@endforeach	

					</tbody>
				</table>
			</div>
		</div>
		</div>
		<div class="col-1_5"></div>
	</div>
</div>
</section>

<br/>



{{-- 
		<table style="text-align: center;" class="table-hover table table-inverse table-responsive">
			<thead>
				<tr>
					<th>Mã đơn hàng</th>
					<th>Ngày đặt</th>
					<th>Số lượng sản phẩm</th>
					<th>Địa chỉ giao hàng</th>
					<th>Số điện thoại người nhận</th>
					<th>Tình trạng</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
					@foreach($list as $i)
					@if($i->hdTinhtrang!=3)
						<tr>
							<td>{{$i->hdMa}}</td>
							<td>{{date_format(date_create($i->hdNgaytao),('d/m/Y'))}}</td>
							<td>{{$i->hdSoluongsp}}</td>
							<td>{{$i->hdDiachi}}</td>
							<td>{{$i->hdSdtnguoinhan}}</td>
							<td>
								@if($i->hdTinhtrang==0)

									<td><span style="color:red;">Đang chờ xác nhận</span></td>
										<td><a class="btn btn-danger" href="{{url('huy-don/'.$i->hdMa)}}" >Hủy đơn</a></td>
								@elseif($i->hdTinhtrang==1)
										<td><span style="color:blue;">Đang giao hàng</span></td>
								@elseif($i->hdTinhtrang==2)
										<td><span style="color:green;">Đã thanh toán</span></td>
								@endif
							</td>
							<td>
								
							</td>
							
							
						</tr>
						
						@endif

							
					@endforeach					
			</tbody>
		</table>

 --}}
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


