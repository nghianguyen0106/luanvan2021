@extends('Userpage.layout')
@section('title')
Xác nhận hóa đơn
@endsection
@section('content')

<div class="container">
<br><br/>
				
					<div class="row">
					 	<div class="mb-3 col-lg-12 col-sm-12">
										<h4 style="text-align: center;font-weight: bold; color:white;background-color: orange; padding: 5px;margin: 0; " >Đơn hàng của bạn</h4>
										<table class="table-responsive table-hover table">
											<thead style="font-weight: bold; font-size: 20px;">
												<th>Tên sản phẩm</th>
												<th>Số lượng</th>
												<th>Đơn giá</th>
												<th>Thành tiền</th>
											</thead>
											<tbody>
													@foreach($cart as $k=> $i)
													<tr>
														<td>{{$i->name}}</td>
														<td>{{$i->qty}}</td>
														<td>{{number_format($i->price)}} VND</td>
														<td>{{number_format($i->qty * $i->price)}} VND</td>
													</tr>
													@endforeach
											</tbody>

											<form action="{{URL::to('gocheckout/'.$total)}}" method="post">
												{{ csrf_field()}}

											@if($promoInfo)

											<tfoot>

												<tr>
													<td></td>
													<td></td>
													<td  style="font-weight: bold;"><i class=" fas fa-gift"></i> Sản phẩm được khuyến mãi: <span style="color: orange;font-weight: bold; font-size: 20px;">{{$proinfo->spTen}} </span></td><input type="text" style="display: none;" name="spMa" value="{{$proinfo->spMa}}"><input type="text"  style="display: none;"  name="kmMa" value="{{$promoInfo->kmMa}}">

													<td>Khuyến mãi: <b><span style="color: orange;font-weight: bold; font-size: 20px;">
													{{$promoInfo->kmTrigia}}%</span> </b> </td>

													<input style="display: none;" type="number" name="discount" value="{{$promoInfo->kmTrigia}}">
												</tr>
												<tr>
													<td></td>
													<td></td>
													<td>Số tiền được giảm giá</td>
													<td>
														<span style="color: red;font-weight: bold; font-size: 20px;">{{number_format($pricePromo)}} VND</span>
														<input style="display:none; " readonly="" type="number" name="price" value="{{$pricePromo}}">
													</td>
												</tr>

												<tr><td><hr></td><td><hr></td><td><hr></td><td><hr></td></tr>

												<tr>

													<td></td>
													<td></td>
													<td><span style="font-weight: BOLD;">TỔNG TIỀN:</span>	</td>
													<td>
														<span style="color: red;font-weight: bold; font-size: 20px;">{{number_format($total)}} VND</span>
														<input type="number" style="display:none" readonly="" value="{{$total}}" name="total">  
													</td>

												</tr>

											</tfoot>

											@else
											
											<tfoot>
												<tr>
													<td></td>
													<td></td>
													<td><span style="font-weight: BOLD;">TỔNG TIỀN:</span>	</td>
													<td>
														 <input type="number" style="width:200px;border: none; font-size: 20px;text-align: center;color: red;font-weight: bold;" readonly="" value="{{$total}}" name="total">  VND
													</td>
												</tr>
											</tfoot>

											@endif

										</table>
						</div>
						<div class="mb-3 col-lg-12 col-sm-12">
										<h4 style="text-align: center;font-weight: bold; color:white;background-color: orange; padding: 5px;margin: 0; " >Thông tin giao hàng</h4>
										<table class="table-responsive table-hover table">
											<thead style="font-weight: bold; font-size: 20px;">
												<th>Địa chỉ giao hàng</th>
												<th>Số điện thoại người nhận</th>
											</thead>
											<tbody>
													<tr>
														<td>{{Session::get('khDiachi')}}</td>
														<td>{{Session::get('khSdt')}}</td>
													</tr>
											</tbody>
										</table>
						</div>

						 <div class="mb-3 col-lg-12">
					     <button id="show__boxAddress" type="button" class="btn btn-secondary">Gửi đến bạn bè</button>
					     <div id="update__address">
					     	<br/>
					     	 <label for="address" class="form-label">Địa chỉ giao hàng:</label>
					     	 <input style="width: 350px;" type="text" class="form-control" id="address" name="address">
					     	 <br/>
					     	 <label for="sdt" class="form-label">Số điện thoại người nhận</label>
								 <input style="width: 350px;" type="number" class="form-control" id="sdt" name="sdt"> 
								 <br/>
								 <label for="note" class="form-label">Ghi chú</label>
					     		<span>&emsp;
								  <textarea  style="width: 350px;" name="note" id="note" name="note" class="form-control"></textarea> 
								  <br/>
								   <button id="hide__boxAddress" type="button" class="btn btn-danger">Đóng</button>
					     </div>

					  </div>
				</div>
					<button type="submit" class="btn btn-success col-12" class="btn btn-primary">Xác nhận đơn hàng</button>
					<div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
					<a style="color: white;" href="{{URL::to('product')}}"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Tiếp tục mua sắm</a>
					</div>
				</form>
</div>
<br/>
<script src="{{URL::asset("public/fe/js/js2.js")}}"></script>

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