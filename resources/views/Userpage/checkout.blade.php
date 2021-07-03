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
				
						  <a class="btn btn-outline-danger" href="{{URL::to('changeQuanty/decrease/'.$k)}}" title="">-</a>
						  <input style="width:50px;border: 0;text-align: center;" readonly="" class="form-control-success" min="1" max="{{$i->qty}}" type="number" id="qty" name="quanty" value="{{$i->qty}}">
						 
					<a class="btn btn-outline-success" href="{{URL::to('changeQuanty/increase/'.$k)}}" title="">+</a>
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
				</tbody>
				<tfoot>
					<tr>
					<td colspan="6" class="text-center">
								<a style="color:red;" href="{{URL::to('destroy-cart')}}"><i class="fas fa-trash" style="color: red;"></i> Xóa toàn bộ sản phẩm trong giỏ hàng</a>
							</td>
				</tr>
				</tfoot>
			</table>
		</div>
		<br/>
		<!------->
		<div class="row justify-content-between cart__bot">
			<div>
			<h4>Chọn 1 ưu đãi</h4>
				<input id="vc" onclick="funcVc()" type="radio" class="form-check-input" name="vc_promo" checked=""> Nhập voucher giảm giá &nbsp;&nbsp;&nbsp;
				<input id="pr" onclick="funcPr()" type="radio" class="form-check-input" name="vc_promo"> Chọn chương trình khuyến mãi
			</div>

			<div id="voucher" style="display: none;" class="col-lg-6">
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

			<div id="promotion" style="display: none;" class="col-lg-6">
				<div class="cart__bot--right">
					<table>
							<tr><td class="promoTitle">KHUYẾN MÃI CÓ THỂ ÁP DỤNG( CHỌN 1 )</td></tr>
					</table>
					<div class="right__content">
						<form action="{{URL::to('order')}}" method="get">
							<input type="radio" id="noPromo" checked name="promo" class=" form-check-input"  value="0">&nbsp;Không chọn
							
								@foreach($use as $v)
									<HR>
											<input type="radio" name="promo" class=" form-check-input" value="{{$v->kmMa}},{{$v->spMa}}">&nbsp;<span class="promotitleItem">{{$v->kmTen}}</span>
												<p>{{$v->kmMota}}</p>
												<span>	Giảm: {{$v->kmTrigia}}% cho sản phẩm: {{$v->spTen}}; Tối đa: {{number_format($v->kmGiatritoida)}} VND</span><br>
								@endforeach
								@foreach($unuse as $v)
									<HR>
											<input type="radio" disabled="" name="promo" class=" form-check-input" value="{{$v->kmMa}},{{$v->spMa}}">&nbsp;<span class="promotitleItem">{{$v->kmTen}}</span>(Bạn đã dùng tối đa số lần khuyến mãi)
												<p>{{$v->kmMota}}</p>
												<span>	Giảm: {{$v->kmTrigia}}% cho sản phẩm: {{$v->spTen}}; Tối đa: {{number_format($v->kmGiatritoida)}} VND</span><br>
								@endforeach

					</div>
				</div>
			</div>

			<div class="col-lg-6">
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
	var promo=document.getElementById("pr");
	if(promo.checked ==true)
	{
		document.getElementById("promotion").style.display = 'block';
	}

	var vc=document.getElementById("vc");
	if(vc.checked ==true)
	{
		document.getElementById("voucher").style.display = 'block';
	}

	function funcVc()
	{
		var vc=document.getElementById("vc");
		if(vc.checked ==true)
		{
			document.getElementById("voucher").style.display = 'block';
			document.getElementById("promotion").style.display = 'none';
			document.getElementById("noPromo").checked="true";
		}
	}

	function funcPr()
	{
		var promo=document.getElementById("pr");
		if(promo.checked ==true)
		{
			document.getElementById("promotion").style.display = 'block';
			document.getElementById("voucher").style.display = 'none';
		}
	}
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