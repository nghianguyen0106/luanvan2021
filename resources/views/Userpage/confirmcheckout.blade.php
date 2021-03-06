@extends('Userpage.layout')
@section('title')
Xác nhận đơn hàng
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
								<h5>Sản phẩm khuyến mãi:&nbsp;<span style="color: #2684ED;">{{$proinfo->spTen}}</span></h5>
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
								<span style="color: red;font-weight: bold; font-size: 20px;">{{number_format($total)}}&nbsp;VND</span>
								<input readonly type="number" value="{{$total}}" name="total">  
							</div>
						</div>
					</td>
				</tr>
			</tfoot>
			@elseif(Session::has('vcMa'))
				<tfoot>
					<tr>
					<td colspan="5">
						<br/>
						<div class="row justify-content-around">
							@if($vcInfo->vcLoai==0)
							<div class="col-lg-5">
								<h5>Sản phẩm được giảm giá:&nbsp;{{$proinfo->spTen}}</h5>
								<input type="text" hidden name="spMa" value="{{$proinfo->spMa}}">
								<input type="text"  hidden  name="vcMa" value="{{$vcInfo->vcMa}}">
							</div>
							@else
							<div class="col-lg-5"></div>
							@endif
								@if($vcInfo->vcLoaigiamgia==0)
									@if($vcInfo->vcLoai==0)
									<div class="col-lg-5">
										<span style="color:#FF4242;font-weight: bold;">Giảm giá trực tiếp:&nbsp;
											{{number_format($vcInfo->vcMucgiam)}} VND (Tối đa {{number_format($vcInfo->vcGiatritoida)}}đ / 1 sản phẩm)</span>
									</div>
									@elseif($vcInfo->vcLoai==1)
									<div class="col-lg-5">
										<span style="color:#FF4242;font-weight: bold;">Giảm giá trực tiếp:&nbsp;
											{{number_format($vcInfo->vcMucgiam)}} VND (Tối đa {{number_format($vcInfo->vcGiatritoida)}}đ / Tổng giá trị đơn hàng)</span>
									</div>
									@endif
								<div class="col-lg-5">
								<h5>Số tiền được giảm:</h5>
								</div>
								<div class="col-lg-5">
									<span>{{number_format($priceVc)}}&nbsp;VND</span>
									<input readonly type="number" name="price" value="{{$priceVc}}">
								</div>
									<input readonly type="number" name="discount" value="{{$vcInfo->vcMucgiam}}">
								@elseif($vcInfo->vcLoaigiamgia==1)
									@if($vcInfo->vcLoai==0)
										<div class="col-lg-5">
											<span style="color:#FF4242;font-weight: bold;">Giảm giá:&nbsp;
												{{$vcInfo->vcMucgiam}} % (Tối đa {{number_format($vcInfo->vcGiatritoida)}}đ / 1 sản phẩm)</span>
												<input readonly type="number" name="discount" value="{{$vcInfo->vcMucgiam}}">
										</div>
										<div class="col-lg-5">
											<h5>Số tiền được giảm:</h5>
										</div>
										<div class="col-lg-5">
											<span>{{number_format($priceVc)}}&nbsp;VND</span>
											<input readonly type="number" name="price" value="{{$priceVc}}">
										</div>
									@elseif($vcInfo->vcLoai==1)
										<div class="col-lg-5">
										<span style="color:#FF4242;font-weight: bold;">Giảm giá:&nbsp;
											{{$vcInfo->vcMucgiam}} % (Tối đa {{number_format($vcInfo->vcGiatritoida)}}đ / Tổng giá trị đơn hàng)</span>
											<input readonly type="number" name="discount" value="{{$vcInfo->vcMucgiam}}">
										</div>
										<div class="col-lg-5">
											<h5>Số tiền được giảm:</h5>
										</div>
										<div class="col-lg-5">
											<span>{{number_format($priceVc)}}&nbsp;VND</span>
											<input readonly type="number" name="price" value="{{$priceVc}}">
										</div>
									@endif
								@endif
						</div>
						<hr>
						<div class="row justify-content-around">
							<div class="col-lg-5">
								<h5>Tổng tiền:</h5>
							</div>
							<div class="col-lg-5">
								<span style="color: red;font-weight: bold; font-size: 20px;">{{number_format($total)}}&nbsp;VND</span>
								<input readonly type="number" value="{{$total}}" name="total">  
							</div>
						</div>
					</td>
				</tr>
			</tfoot>
			@else
				<tfoot>
						<tr style="text-align: right;">
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
				<button id="show__boxAddress" type="button" class="show__boxAddress">Gửi đến địa chỉ khác</button>
		{{-- 		<button id="hide__boxAddress" type="button" class="hide__boxAddress">Đóng</button> --}}
				<div id="update__address">
				<table>
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
				<button type="submit" class="btn btn-success col-3">Xác nhận đơn hàng</button>
				</form>
			</div>
		</div>

		</div>
		<div class="col-1_5">
			<div class="quang__cao2" style="background-image: url(https://theme.hstatic.net/1000026716/1000440777/14/xxxbannerxxx2.png?v=20498);background-size: cover"></div>
		</div>
	</div>

</div>
</div>
</section>

<script src="{{URL::asset("public/fe/js/js2.js")}}"></script>

<br/>


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