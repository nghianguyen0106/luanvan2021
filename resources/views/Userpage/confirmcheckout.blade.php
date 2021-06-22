@extends('Userpage.layout')
@section('title')
Xác nhận hóa đơn
@endsection
@section('content')


<section class="content__cart">
	<div class="container-fluid">
	<div class="row">
	<div class="col-1_5"></div>
	<div class="col-lg-9">
			{{-- <a class="text-white btn btn-dark" href="{{URL::to('product')}}"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Tiếp tục mua sắm</a> --}}
		<br/>
		<div class="row">
			<table class="cart__list--item">
				<tr class="table__title">
					<td colspan="5">ĐƠN HÀNG CỦA BẠN</td>
				</tr>
				<tbody>
					<tr class="thead">
						<td>Tên sản phẩm</td>
						<td>Hình</td>
						<td>Đơn giá</td>
						<td>Số lượng</td>
						<td>Thành tiền</td>
					</tr>
					@if(Cart::count() !=0)
					@foreach($cart as $k=> $i)
					<tr>
						<td><a href="{{URL::to('proinfo/'.$i->id)}}">{{$i->name}}</a></td>
						<td><a href="{{URL::to('proinfo/'.$i->id)}}"><img src="{{URL::asset('public/images/products/'.$i->options->spHinh)}}" alt=" " class="img-responsive" /></a></td>
						<td>{{number_format($i->price)}} VND</td>
						<td>{{$i->qty}}</td>
						<td>{{number_format($i->price * Cart::get($k)->qty)}} VND</td>
					</tr>
					@endforeach
				@else
				<tr>
					<td colspan="5"><strong><i class="fas fa-info-circle alert-info"></i> Đơn hàng trống</strong></td>
				</tr>
				@endif
				
						<form action="{{URL::to('gocheckout/'.$total)}}" method="post">
												{{ csrf_field()}}

						@if($promoInfo)
					<tfoot>
					<tr>
					<td colspan="5">
						<br/>
						<div class="row justify-content-around">
							<div class="col-lg-5">
								<h5>Sản phẩm khuyến mãi:&nbsp;{{$proinfo->spTen}}</h5>
								<input type="text" hidden name="spMa" value="{{$proinfo->spMa}}">
								<input type="text"  hidden  name="kmMa" value="{{$promoInfo->kmMa}}">
							</div>
							<div class="col-lg-5">
								
							<span>Khuyến mãi:&nbsp;{{$promoInfo->kmTrigia}}%</span>
						 <input readonly type="number" name="discount" value="{{$promoInfo->kmTrigia}}">
								</div>
						</div>
						<div class="row justify-content-around">
							<div class="col-lg-5">
								<h5>Số tiền được khuyến mãi:</h5>
							</div>
							<div class="col-lg-5">
								<span>{{number_format($pricePromo)}}&nbsp;VND</span>
								<input readonly type="number" name="price" value="{{$pricePromo}}">
							</div>
						</div>
						<hr/>
						<div class="row justify-content-around">
							<div class="col-lg-5">
								<h5>Tổng tiền:</h5>
							</div>
							<div class="col-lg-5">
								<span>{{number_format($total)}}&nbsp;VND</span>
								<input readonly type="number" value="{{$total}}" name="total">  
							</div>
						</div>
					</td>
				</tr>
			</tfoot>
			@else
				<tfoot>
						<tr style="text-align: right;border: 2px solid #757390;">
								<td colspan="4" style="padding-right: 4px;"><span><strong>TỔNG TIỀN:</strong></span></td>
								<td colspan="1" style="padding-right: 4px;">
										<span style="color: red;font-weight: bold; font-size: 20px;">{{number_format($total)}} VND</span>
											<input type="number" style="display:none" readonly value="{{$total}}" name="total">  
										</td>
						</tr>
					</tfoot>
				@endif
					
				</tbody>
			</table>
		</div>
		<br/>
	
		<!------->
		<div class="row justify-content-between">
			<div class="col-lg-6 address__info">
				<table>
					<thead>
						<tr>
							<td colspan="2">THÔNG TIN GIAO HÀNG</td>
						</tr>
					</thead>
					<tbody>
						<tr class="thead">
							<td>Địa chỉ</td>
							<td>Số điện thoại người nhận</td>
						</tr>
						<tr>
							<td>{{Session::get('khDiachi')}}</td>
							<td>{{Session::get('khSdt')}}</td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="text" name="note" placeholder="Ghi chú..." />
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-lg-6 address__info">
				<table>
					<thead>
						<tr>
							<td colspan="2">ĐẾN ĐỊA CHỈ KHÁC</td>
						</tr>
					</thead>
					<tbody>
						<tr class="thead">
							<td>Địa chỉ</td>
							<td>Số điện thoại người nhận</td>
						</tr>
								<tr>
							<td><input type="text" name="address" placeholder="Nhập địa chỉ..." /></td>
							<td><input type="number" name="sdt" placeholder="Nhập số điện thoại nhận..." /></td>
						</tr>
						<tr>
							<td colspan="2">
								<input type="text" name="note" placeholder="Ghi chú..." />
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		

			<div class="row justify-content-center" style="margin-top: 1rem;">
				<button type="submit" class="btn btn-success col-3" href="">Xác nhận đơn hàng</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col-1_5"></div>
</div>
</div>
</section>































{{-- <div class="container">
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
													<td  style="font-weight: bold;"><i class=" fas fa-gift"></i> Sản phẩm được khuyến mãi: <span style="color: orange;font-weight: bold; font-size: 20px;">{{$proinfo->spTen}} </span>
													</td>
													<input type="text" style="display: none;" name="spMa" value="{{$proinfo->spMa}}">
													<input type="text"  style="display: none;"  name="kmMa" value="{{$promoInfo->kmMa}}">

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
													<td><span style="font-weight: bold;">TỔNG TIỀN:</span>	</td>
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
													<td><span style="font-weight: bold;">TỔNG TIỀN:</span>	</td>
													<td>
														<span style="color: red;font-weight: bold; font-size: 20px;">{{number_format($total)}} VND</span>
														 <input type="number" style="display:none" readonly="" value="{{$total}}" name="total">  
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
					     <button id="show__boxAddress" type="button" class="btn btn-secondary">Gửi đến địa chỉ khác</button>
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
</div> --}}
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