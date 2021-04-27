@extends('Userpage.layout')
@section('title')
Xác nhận hóa đơn
@endsection
@section('content')

<div class="container">
	<form action="{{URL::to('gocheckout/'.$total)}}" method="post">
		{{ csrf_field()}}
  <div class="mb-3">
    <label for="address" class="form-label">Địa chỉ giao hàng ( nếu để trống sẽ giao địa chỉ mặc định trong thông tin đăng ký tài khoản )</label>
    <input type="text" class="form-control" id="address" name="address">
  </div>
    <div class="mb-3">
    <label for="sdt" class="form-label">Số điện thoại người nhận</label>
    <input type="number" required="" class="form-control" id="sdt" name="sdt">
  </div>
  <div class="mb-3">
    <label for="note" class="form-label">Ghi chú</label>
    <textarea name="note" id="note" name="note" class="form-control"></textarea> 
  </div>
<div  class="mb-3">	
				
	<div style="width: 600px;"  class="checkout-left-basket" data-wow-delay=".5s">
					<h4>Hóa đơn của bạn</h4>
					<ul>
						@foreach($cart as $k=> $i)
							
						<li> <i class="far fa-check-square" style="color: green;"></i>  <strong>{{$i->name}}</strong><span style="color: orange;"><i class="fas fa-money-check-alt" style="color: green;"></i>&nbsp;{{number_format($i->price * Cart::get($k)->qty)}} VND</span></li>
						@endforeach
						<hr>
						<li><b>Tổng tiền</b> <i></i> <span ><b style="color: red;">{{number_format($total)}}</b> VND</span></li>
					</ul>
			
				</div>
				<div class="clearfix"> </div>
				<button type="submit" class="btn btn-success col-12" class="btn btn-primary">Xác nhận hóa đơn thanh toán</button>
	</div>
  
</form>
<div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
					<a href="{{URL::to('product')}}"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Tiếp tục mua sắm</a>
				</div>

	
	
				
</div>

@if(Session::has('errsdt'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('errsdt')}}',
 
})
</script> 
@endif
@if(Session::has('errorder'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('errorder')}}',
 
})
</script> 
@endif
@endsection