@extends('Userpage.layout')
@section('title')
Danh sách đơn hàng
@endsection
@section('content')
<div class="container">
	<div class="row">
		<table class="table">
			<thead>
				<tr>
					<th>Mã đơn hàng</th>
					<th>Ngày đặt</th>
					<th>Số lượng sản phẩm</th>
					<th>Tình trạng</th>
					<th>Địa chỉ giao hàng</th>
					<th>Số điện thoại người nhận</th>
					<th>Ghi chú</th>
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
									Đang chờ xác nhận
								@elseif($i->hdTinhtrang==1)
									Đang giao hàng
								@else
									Đã giao
								@endif
							</td>
							<td>{{$i->hdDiachi}}</td>
							<td>{{$i->hdSdtnguoinhan}}</td>
							<td>{{$i->hdGhichu}}</td>
						</tr>


					@endforeach					
			</tbody>
		</table>
	</div>
	
</div>
@endsection


<td>
{{-- 						<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
Xem chi tiết
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Chi tiết đơn hàng ...</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> --}}
					</td>