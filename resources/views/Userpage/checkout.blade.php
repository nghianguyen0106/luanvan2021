@extends('userpage.layout')
@section('title')
Giỏ hàng
@endsection
@section('content')
<!-- check out -->
<div class="checkout">
	<div class="container">
		<h3>Giỏ hàng</h3>
		<div class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
			<table class="timetable_sub">
				<thead>
					<tr>
						<th style="width: 300px;">Tên sản phẩm</th>
						<th style="width: 200px;">Hình</th>
						<th>Đơn giá</th>
						<th>Số lượng</th>
						<th>Khuyến mãi</th>
						<th>Thành tiền</th>
						<th>Xóa</th>
					</tr>
				</thead>
				@if(Cart::count() !=0)

					@foreach($cart as $k=> $i)
					<tr class="rem1">
						<td class="invert"><a href="{{URL::to('proinfo/'.$i->id)}}">{{$i->name}}</a></td>
						<td class="invert-image"><a href="{{URL::to('proinfo/'.$i->id)}}"><img src="{{URL::asset('public/images/products/'.$i->options->spHinh)}}" alt=" " class="img-responsive" /></a></td>
						<td class="invert">{{number_format($i->price)}} VND</td>
						<td class="invert"><div class="counter">
						  <button  class="btn btn-outline-danger" type="button" onClick='decreaseCount(event, this)'>-</button>
						  <input style="width:50px " class="form-control-success" min="1" max="{{$i->qty}}" type="number" id="qty" name="quanty" value="1">
						  <button class="btn btn-outline-success"  type="button"  onClick='increaseCount(event, this)'>+</button>
						</div></td>
						<td class="invert">0%</td>
						<td>{{number_format($i->price * Cart::get($k)->qty)}} VND</td>
						
						<td class="invert"><a class="btn btn-outline-danger" href="{{URL::to('remove-item/'.$k)}}">X</a></td>
					</tr>
					@endforeach
				@else
				<tr>
					<td colspan="6"><strong><i class="fas fa-info-circle alert-info"></i> Giỏ hàng trống</strong></td>
				</tr>
					
				@endif
					
								<!--qunatity-->
									<script>
									$('.value-plus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
										divUpd.text(newVal);
									});

									$('.value-minus').on('click', function(){
										var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
										if(newVal>=1) divUpd.text(newVal);
									});
									</script>
								<!--quantity-->
			</table>
			<div class="row">
				<a class="btn btn-outline-danger" href="{{URL::to('destroy-cart')}}">Xóa toàn bộ sản phẩm trong giỏ hàng</a>
			</div>
		</div>
		
		<div  class="checkout-left">	
				
				<div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
					<a href="{{URL::to('product')}}"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Tiếp tục mua sắm</a>
				</div>
				<div style="width: 600px;"  class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
					<h4>Hóa đơn tạm tính</h4>
					<ul>
						@foreach($cart as $k=> $i)
							
						<li> <i class="far fa-check-square" style="color: green;"></i>  <strong>{{$i->name}}</strong><span style="color: orange;"><i class="fas fa-money-check-alt" style="color: green;"></i>&nbsp;{{number_format($i->price * Cart::get($k)->qty)}} VND</span></li>
							
						@endforeach
						<hr>
						<li><b>Tổng tiền</b> <i></i> <span ><b style="color: red;">{{number_format($total)}}</b> VND</span></li>
					</ul>
				<a class="btn btn-success col-12" href="{{URL::to('order')}}">Thanh toán</a>
				</div>
				<div class="clearfix"> </div>
			</div>
	</div>
</div>	
<!-- //check out -->
<!-- //product-nav -->
<div class="coupons">
	<div class="container">
		<div class="coupons-grids text-center">
			<div class="col-md-3 coupons-gd">
				<h3>Buy your product in a simple way</h3>
			</div>
			<div class="col-md-3 coupons-gd">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				<h4>LOGIN TO YOUR ACCOUNT</h4>
				<p>Neque porro quisquam est, qui dolorem ipsum quia dolor
			sit amet, consectetur.</p>
			</div>
			<div class="col-md-3 coupons-gd">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				<h4>SELECT YOUR ITEM</h4>
				<p>Neque porro quisquam est, qui dolorem ipsum quia dolor
			sit amet, consectetur.</p>
			</div>
			<div class="col-md-3 coupons-gd">
				<span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
				<h4>MAKE PAYMENT</h4>
				<p>Neque porro quisquam est, qui dolorem ipsum quia dolor
			sit amet, consectetur.</p>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>


@if(Session::has('errCheckout'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('errCheckout')}}',
 
})
</script> 
@endif

<script>
  function increaseCount(a, b) {
  var input = document.getElementById('qty');
  var value = parseInt(input.value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  input.value = value;
}

function decreaseCount(a, b) {
  var input = document.getElementById('qty');
  var value = parseInt(input.value, 10);
  if (value > 1) {
    value = isNaN(value) ? 0 : value;
    value--;
    input.value = value;
  }
}
</script>
@endsection