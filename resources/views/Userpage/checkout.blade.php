@extends('userpage.layout')
@section('title')
Giỏ hàng
@endsection
@section('content')


<section class="content__cart">
	<div class="container-fluid">
	<div class="row">
		<div class="col-1_5">
			<div class="quang__cao" style="background-image: url(https://theme.hstatic.net/1000026716/1000440777/14/xxxbannerxxx1.png?v=20498);background-size: cover;"></div>
		</div>
	<div class="col-lg-9">
			{{-- <a class="text-white btn btn-dark" href="{{URL::to('product')}}"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Tiếp tục mua sắm</a> --}}
		<br/>
		<div class="row">
			<table class="cart__list--item">
				<tr class="table__title">
					<td colspan="6">GIỎ HÀNG</td>
				</tr>
				<tbody>
					<tr class="thead">
						<td>Tên sản phẩm</td>
						<td>Hình</td>
						<td>Đơn giá</td>
						<td>Số lượng</td>
						<td>Thành tiền</td>
						<td></td>
					</tr>
					@if(Cart::count() !=0)
					@foreach($cart as $k=> $i)
					<tr>
						<td><a href="{{URL::to('proinfo/'.$i->id)}}">{{$i->name}}</a></td>
						<td><a href="{{URL::to('proinfo/'.$i->id)}}"><img src="{{URL::asset('public/images/products/'.$i->options->spHinh)}}" alt=" " class="img-responsive" /></a></td>
						<td>{{number_format($i->price)}} VND</td>
						<td><div class="counter">
				
						  <button type="button"><a href="{{URL::to('changeQuanty/decrease/'.$k)}}" title="">-</a></button>
						  <input style="width:50px;border: 0;text-align: center;" readonly="" class="form-control-success" min="1" max="{{$i->qty}}" type="number" id="qty" name="quanty" value="{{$i->qty}}">
						 
						   <button type="button"><a href="{{URL::to('changeQuanty/increase/'.$k)}}" title="">+</a></button>
						</div></td>
						<td>{{number_format($i->price * Cart::get($k)->qty)}} VND</td>
						
						<td class="invert"><a class="btn btn-outline-danger"
						onclick="func{{$k}}()">Xóa</a></td>
					</tr>
					@endforeach
				@else
				<tr>
					<td colspan="6"><strong><i class="fas fa-info-circle alert-info"></i> Giỏ hàng trống</strong></td>
				</tr>
				@endif
				<tr>
					<td colspan="6" style="text-align:center;background:linear-gradient(to left bottom, #939299,#B4B4B7,#B7B8C0);padding: 3px 0 3px 0;">
								<a class="btn btn-danger" href="{{URL::to('destroy-cart')}}"><i class="fas fa-trash"></i> Xóa toàn bộ sản phẩm trong giỏ hàng</a>
							</td>
				</tr>
				</tbody>
			</table>
		</div>
		<br/>
		<!------->
		<div class="row justify-content-between cart__bot">
			<div>
				<input type="radio" name="vc_promo">
				<input type="radio" name="vc_promo">
			</div>

			<div id="voucher" class="col-lg-6">
				<form action="{{URL::to('checkvoucher')}}" method="post" accept-charset="utf-8">
					{{csrf_field()}}
				<label>Nhập voucher giảm giá:</label><input type="text" class="form-control" name="vcMa" title="Mã phải là chữ hoặc số không chứa ký tự đặc biệt. Độ dài từ 4-12 ký tự." pattern="[A-Za-z\d]{4,12}" placeholder="Nhập mã voucher vào đây"
				@if(Session::has('vcMa'))
				value="{{Session::get('vcMa')}}" 
				@endif
				>
				<button type="submit" class="btn btn-outline-info"><i class="fas fa-info-circle"></i> Kiểm tra</button>
				@if(Session::has('vcMa'))
				<span class="alert-success">Đã áp dụng voucher!</span>
				@endif
				</form>
			</div>

			<div id="promotion" class="col-lg-6">
				<div class="cart__bot--right">
					<table>
							<tr><td class="promoTitle">KHUYẾN MÃI CÓ THỂ ÁP DỤNG( CHỌN 1 )</td></tr>
					</table>
					<div class="right__content">
						<form action="{{URL::to('order')}}" method="get">
							<input type="radio" checked name="promo" class=" form-check-input"  value="0">&nbsp;Không chọn
							<hr/>
								@foreach($promotion as $v)
								@if( $v->spSlkmtoida!=0 )
								@if($b)
								@php
								$check=array();
								@endphp	
									@foreach($b as $k=> $i)
										@if($i['kmMa']==$v->kmMa && $i['kmSolan'] <= $v->kmGioihanmoikh)
											@if(in_array($v->spMa, $check)==null)
											@php
											array_push($check, $v->spMa)
											@endphp
											<input type="radio" name="promo" class=" form-check-input" value="{{$v->kmMa}},{{$v->spMa}}">&nbsp;<span class="promotitleItem">{{$v->kmTen}}</span>
												<p>{{$v->kmMota}}</p>
												<span>	Giảm: {{$v->kmTrigia}}% cho sản phẩm: {{$v->spTen}}; Tối đa: {{number_format($v->kmGiatritoida)}} VND</span><br>
												<span>Được áp dụng {{$v->kmGioihanmoikh}} lần cho mỗi khách hàng.</span><br><hr>
											@endif
										@endif
									@endforeach
								@endif
						@endif
						@endforeach
					</div>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="cart__bot--left">
					<table>
							<tr><td>ĐƠN HÀNG TẠM TÍNH</td></tr>
					</table>
					<div class="left__content">
							@foreach($cart as $k=> $i)	
							<div class="content__pro">
								<span class="pro__name">
									<i class="fas fa-check" style="font-size: 16px;color: lightgreen;position: relative;left:15px"></i>
									<i class="fas fa-check" style="font-size: 16px;color: lightgreen"></i>&nbsp;{{$i->name}}</span>
								<span class="pro__price"><i class="fas fa-dollar-sign" style="font-size: 16px;color: lightgreen;border: 2px solid lightgreen;padding: 3px 3px 3px 3px"></i>&nbsp;{{number_format($i->price * Cart::get($k)->qty)}} VND</span>
							</div>
								
							@endforeach
							<hr>
							<div class="content__total">
								<span class="total__title">Tổng tiền:</span>
								<span class="total__price">{{number_format($total)}}</b> VND</span>
							</div>
					</div>
				</div>
			</div>

			<div class="row justify-content-center" style="margin-top: 1rem;">
				<button type="submit" class="btn btn-success col-3" href="">Tiến hành đặt hàng</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-1_5">
			<div class="quang__cao2" style="background-image: url(https://theme.hstatic.net/1000026716/1000440777/14/xxxbannerxxx2.png?v=20498);background-size: cover"></div>
		</div>
</div>
</div>
</section>



<br>
<script type="text/javascript">
	
</script>


@if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('err')}}',
 
})
</script> 
@endif

@if(Session::has('success'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Thông báo: ',
  text: '{{Session::get('success')}}',
 
})
</script> 
@endif
<script>


@foreach($cart as $k=> $i)
function func{{$k}}()
{
	Swal.fire(
	{
	  title: 'Bạn có muốn xóa',
	  text: "{{$i->name}} khỏi giỏ hàng ?",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#EC2546',
	  cancelButtonColor: '#B5B5B5',
	  confirmButtonText: 'OK'
	}).then((result) => {
  if (result.isConfirmed) 
  {
    Swal.fire(
      'Deleted!',
      'Đã xóa sản phẩm khỏi giỏ hàng !',
      'success'
    )
    document.location.href="{{URL::to('remove-item/'.$k)}}";
  }
})
}
@endforeach


</script>
@endsection