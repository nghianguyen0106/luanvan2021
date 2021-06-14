@extends('userpage.layout')
@section('title')
Danh mục yêu thích
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="mb-4 col-12 ">
			<table class="table table-hover  ">
				<thead>
					<th>STT</th>
					<th>Tên sản phẩm</th>
					<th>Loại</th>
					<th>Thương hiệu</th>
					<th>Giá</th>
					<th>Tình trạng</th>	
					<th></th>
				</thead>
				<tbody>
					@foreach($wl as $k=> $i)
					<tr>
						<td>{{$k+1}}</td>
						<td>{{$i->spTen}}</td>
						<td>{{$i->loaiTen}}</td>
						<td>{{$i->thTen}}</td>
						<td>{{number_format($i->spGia)}} VND</td>
						<td>
							@if($i->khoSoluong != 0 )
							Còn hàng
							@else
							Hết hàng
							@endif
						</td>
						<td><a href="{{URL::to('addtowishlist/'.$i->spMa)}}" class="btn btn-outline-danger"><i class="fas fa-heart-broken"></i></a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>


@if(Session::has('success'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Thông báo: ',
  text: '{{Session::get('success')}}',
 
})
</script> 
@endif

@endsection