@extends('userpage.layout')
@section('title')
Danh mục yêu thích
@endsection
@section('content')

<br/>
<section class="list__wish">
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
								SẢN PHẨM YÊU THÍCH
							</td>
						</tr>
					</thead>
					<tbody>
						<tr class="thead">
							<td>STT</td>
							<td>Tên sản phẩm</td>
							<td>Hình</td>
							<td>Loại</td>
							<td>Thương hiệu</td>
							<td>Giá</td>
							<td>Tình trạng</td>	
							<td></td>	
						</tr>

					@foreach($wl as $k=> $i)
					<tr>
						<td>{{$k+1}}</td>
						<td><a  href="{{URL::to('proinfo/'.$i->spMa)}}">{{$i->spTen}}</a></td>
						<td><a  href="{{URL::to('proinfo/'.$i->spMa)}}"><img src="{{URL::asset('public/images/products/'.$i->spHinh)}}"></a></td>
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
						<td><a href="{{URL::to('addtowishlist/'.$i->spMa)}}" class="btn btn-outline-danger">Xóa</a></td>
					</tr>
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

<br/><br/>



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