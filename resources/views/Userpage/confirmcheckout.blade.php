@extends('Userpage.layout')
@section('title')
Xác nhận hóa đơn
@endsection
@section('content')

<div class="container">
<div  class="checkout-left">	
				
				<div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
					<a href="{{URL::to('product')}}"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Tiếp tục mua sắm</a>
				</div>
				<div style="width: 600px;"  class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
					<h4>Hóa đơn của bạn</h4>
					<ul>
						@foreach($cart as $k=> $i)
							
						<li> <i class="far fa-check-square" style="color: green;"></i>  <strong>{{$i->name}}</strong><span style="color: orange;"><i class="fas fa-money-check-alt" style="color: green;"></i>&nbsp;{{number_format($i->price * Cart::get($k)->qty)}} VND</span></li>
							
						@endforeach
						<hr>
						<li><b>Tổng tiền</b> <i></i> <span ><b style="color: red;">{{number_format($total)}}</b> VND</span></li>
					</ul>
				<a class="btn btn-success col-12" onclick="" href="{{URL::to('gocheckout/'.$total)}}">Xác nhận hóa đơn thanh toán</a>
				</div>
				<div class="clearfix"> </div>
			</div>
</div>
<script  type="text/javascript" charset="utf-8" async defer>
	function alert()
	{
		Swal.fire({
		  icon: 'success',
		  title: 'Thông báo',
		  text: 'Đặt hàng thành công!',
		 
		})
	}
	
</script>
@endsection