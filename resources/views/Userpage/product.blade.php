@extends('Userpage.layout')
@section('title')
Product
@endsection
@section('content')

<!-- mens -->
<div class="men-wear">
	<div class="container-fluid">
		<div class="col-md-2 products-left">
			
			<div class="css-treeview">
				<h4>LỌC SẢN PHẨM</h4>
				<ul>
					<li>Lọc theo giá
						<ul>
							<li>
								<label>Giá từ<input type="text/submit/hidden/button/etc" name="" value=""></label>
							</li>
							<li>
								<label>Giá đến<input type="text/submit/hidden/button/etc" name="" value=""></label>
							</li>
						</ul></li>
				</ul>	
			</div>
			
			<div class="clearfix"></div>
		</div>
		<div class="col-md-8 products-right">
			<h5>Danh sách sản phẩm</h5>

			{{-- QUICK SORT --}}
			 <div class="sort-grid">
			{{--	<div class="sorting">
					<h6>Sort By</h6>
					<select id="country1" onchange="change_country(this.value)" class="frm-field required sect">
						<option value="null">Default</option>
						<option value="null">Name(A - Z)</option> 
						<option value="null">Name(Z - A)</option>
						<option value="null">Price(High - Low)</option>
						<option value="null">Price(Low - High)</option>	
						<option value="null">Model(A - Z)</option>
						<option value="null">Model(Z - A)</option>					
					</select>
					<div class="clearfix"></div>
				</div>
				<div class="sorting">
					<h6>Showing</h6>
					<select id="country2" onchange="change_country(this.value)" class="frm-field required sect">
						<option value="null">7</option>
						<option value="null">14</option> 
						<option value="null">28</option>					
						<option value="null">35</option>								
					</select>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>--}}
			</div> 


			<div class="men-wear-top">
				<script src="{{URL::asset('public/fe/js/responsiveslides.min.js')}}"></script>
				<script>
						// You can also use "$(window).load(function() {"
						$(function () {
						 // Slideshow 4
						$("#slider3").responsiveSlides({
							auto: true,
							pager: true,
							nav: false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
						$('.events').append("<li>before event fired.</li>");
						},
						after: function () {
							$('.events').append("<li>after event fired.</li>");
							}
							});
						});
				</script>
				
				<div class="clearfix"></div>
			</div>
						{{-- Item --}}
						
					@foreach($db as $i)	
				<div class="col-md-3 product-men p-4" style="height: 350px">
					<div class="men-pro-item simpleCart_shelfItem">
						<div class="men-thumb-item">
								
								<img style="height: 200px" src="{{URL::asset('public/images/products/'.$i->spHinh)}}" alt="" class="pro-image-front">
								<img style="height: 200px"  src="{{URL::asset('public/images/products/'.$i->spHinh)}}" alt="" class="pro-image-back">							
							

										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="{{URL::to('proinfo/'.$i->spMa)}}" class="link-product-add-cart">Quick Viewx</a>
											</div>
										</div>
										{{-- <span class="product-new-top">New</span> --}}
										
						</div>
						<div class="item-info-product ">
									<h4><a href="{{URL::to('proinfo/'.$i->spMa)}}">{{$i->spTen}}</a></h4>
									<div class="info-product-price">
										<span class="item_price">{{number_format($i->spGia)}} VND</span>
									
									</div>
									<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
						</div>
					</div>
				</div>
				@endforeach
						{{--  --}}
				<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		<div class=" row single-pro">
			
			<div class="css-treeview">
				<h4>SẢN PHẨM ĐỀ XUẤT</h4>
			
			</div>
				<div class="col-md-4 product-men">
							
							<img src="{{URL::asset('public/images/products/'.$dbprorand->spHinh)}}" alt="" class="pro-image">
							{{-- <img src="{{URL::asset('public/images/products/'.$dbprorand->spHinh)}}" alt="" class="pro-image-back"> --}}

										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="{{URL::to('proinfo/'.$dbprorand->spMa)}}" class="link-product-add-cart">Quick View</a>
											</div>
										</div>
										{{-- <span class="product-new-top">New</span> --}}
										
						
						<div class="item-info-product ">
									<h4><a href="{{URL::to('proinfo/'.$dbprorand->spMa)}}">{{$dbprorand->spTen}}</a></h4>
									<div class="info-product-price">
										<span class="item_price">{{number_format($dbprorand->spGia)}}</span>
										{{-- <del>$69.71</del> --}}
									</div>
									<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>			
						</div></div>
						<div class="col-4"></div>
						<div class="col-4">
					{{-- 		@foreach($dbprorand as $i)
					<ul class="list-group">
						
						<li class="list-group-item"><label for="list-group-item">Màn hình:</label> {{$i->manhinh}}</li>
						<li class="list-group-item"><label for="list-group-item">RAM: </label> {{$i->ram}}</li>
						<li class="list-group-item"><label for="list-group-item">Chuột: </label> {{$i->chuot}}</li>
						<li class="list-group-item"><label for="list-group-item">Màn hình: </label> {{$i->banphim}}</li>
						<li class="list-group-item"><label for="list-group-item">PSU: </label> {{$i->psu}}</li>
						<li class="list-group-item"><label for="list-group-item">Mainboard: </label> {{$i->mainboard}}</li>
						<li class="list-group-item"><label for="list-group-item">Ổ Cứng:</label> {{$i->ocung}}</li>
						<li class="list-group-item"><label for="list-group-item">VGA: </label> {{$i->vga}}</li>
						<li class="list-group-item"><label for="list-group-item">Vỏ Case: </label> {{$i->vocase}}</li>
						<li class="list-group-item"><label for="list-group-item">Pin: </label> {{$i->pin}}</li>
						<li class="list-group-item"><label for="list-group-item">Tản nhiệt: </label> {{$i->tannhiet}}</li>		 
						<li class="list-group-item"><label for="list-group-item">Loa: </label> {{$i->loa}}</li>
					</ul>
					@endforeach --}}
						</div>
	
			<div class="clearfix"></div>
		</div>
		{{-- PAGING --}}
		{{-- <div class="pagination-grid text-right">
			<ul class="pagination paging">
				<li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
				<li class="active"><a href="#">1<span class="sr-only">(current)</span></a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
			</ul>
		</div> --}}
		{{--  --}}
	</div>
</div>	
<!-- //mens -->
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

<!-- login -->
			<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-info">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
						<div class="modal-body modal-spa">
							<div class="login-grids">
								<div class="login">
									<div class="login-bottom">
										<h3>Sign up for free</h3>
										<form>
											<div class="sign-up">
												<h4>Email :</h4>
												<input type="text" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
											</div>
											<div class="sign-up">
												<h4>Password :</h4>
												<input type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
												
											</div>
											<div class="sign-up">
												<h4>Re-type Password :</h4>
												<input type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
												
											</div>
											<div class="sign-up">
												<input type="submit" value="REGISTER NOW" >
											</div>
											
										</form>
									</div>
									<div class="login-right">
										<h3>Sign in with your account</h3>
										<form>
											<div class="sign-in">
												<h4>Email :</h4>
												<input type="text" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
											</div>
											<div class="sign-in">
												<h4>Password :</h4>
												<input type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
												<a href="#">Forgot password?</a>
											</div>
											<div class="single-bottom">
												<input type="checkbox"  id="brand" value="">
												<label for="brand"><span></span>Remember Me.</label>
											</div>
											<div class="sign-in">
												<input type="submit" value="SIGNIN" >
											</div>
										</form>
									</div>
									<div class="clearfix"></div>
								</div>
								<p>By logging in you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
<!-- //login -->
</body>
</html>
@endsection