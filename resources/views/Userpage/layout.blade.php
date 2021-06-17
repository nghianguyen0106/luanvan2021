<!DOCTYPE html>
<html>
<head>
<title>@yield('title')</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Smart Shop Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="{{URL::asset("public/fe/css/bootstrap.css")}}" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="{{URL::asset("public/fe/css/jquery-ui.css")}}">
<link href="{{URL::asset("public/fe/css/style.css")}}" rel="stylesheet" type="text/css" media="all" />
<link href="{{URL::asset("public/fe/css/css.css")}}" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="{{URL::asset("public/fe/css/nghia_custom.css")}}">
<link rel="stylesheet" type="text/css" href="{{URL::asset('public/fe/css/modelpopup.css')}}">
<!-- //for bootstrap working -->
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic' rel='stylesheet' type='text/css'>
<script src="{{URL::to('public/fe/js/jquery.easing.min.js')}}"></script>
{{-- ADD Bootstrap 5 --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

{{-- SweetAlert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>
<body>

<section class="container-fluid header">
	<!--screen large-->
	<div class="menu__lg">
		<div class="row header__top">
			<div class="col-8">
				<a href="{{URL::to('/')}}"><img src="{{URL::asset('public/fe/images/logo3.png')}}"></a>
			</div>
			<div class="col-4">
				<ul class="menu__header--top">
					<li>
						&emsp;
						<a><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>luanvan@gmail.com</a>
					</li>
					<li>
						&emsp;<a><i class="fas fa-phone-alt" style="font-size: 18px;color: orange;"></i>&nbsp;0123456789</a>
					</li>
					
				</ul>
			</div>
		</div>
		<div class="row header__bot">
			<div class="col-lg-12">
				 <ul class="list__menu">
				    		<li class="list__menu--item">
				    			<a href="{{URL::to('/')}}">Trang chủ</a>
				    		</li>
				    		<li class="list__menu--item">
				    		<a href="{{URL::to('product')}}">Sản phẩm</a>
				    		</li>
				    		<li class="list__menu--item" style="text-align: center;"><a href="{{URL::to('/checkout')}}">
						<i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
								({{Cart::count()}}) Giỏ hàng</a>
						</li>
				    	@if(Session::has('khTen'))
				    		  		<li class="list__menu--item"><a href="{{URL::to('listorder')}}">Danh sách đơn hàng</a></li>
				    		  		<li class="list__menu--item"><a href="{{URL::to('wishlist')}}">Danh mục yêu thích</a></li>
				    		@endif
				    		@if(Session::has('khTen'))
				    		<li class="list__menu--item" style="width: 120px;">
				    			 <a style="color: white;">
								{{-- @if(Session::get('khHinh')!=null)
								<img style="width: 40px;height: 40px;border-radius: 360px;" src="{{URL::asset('public/images/khachhang/'.Session::get('khHinh'))}}" />
								@else
								<span></span>
								@endif  --}}
								&nbsp;{{Session::get('khTen')}}
							</a>
						<ul class="menu__account--child">
								<li class="item">
									<a href="{{url("/infomation/".Session::get('khMa'))}}">
					 						Thông tin cá nhân&nbsp;
					 					<i class="far fa-eye"></i>
					 				</a>
								</li>
								<li class="item">
									<a href="{{URL::to('logout')}}">
					 						Đăng xuất&nbsp;<i class="fas fa-sign-out-alt"></i>
					 				</a>
								</li>
								<br/>
							</ul>
							
						</li>
							@else	
								<li class="list__menu--item" style="width: 100px;color: ;white"><a href="{{URL::to('login')}}">
									Đăng nhập&nbsp;<i class="fas fa-sign-in-alt"></i>
								</a>
							</li>
							@endif
							
						</ul>
				 </div>
			</div>
		</div>
	</div>
	<!--end-->
</section>
	<!--Mobile-->
	<div class="col-md-12 menu__sm">
		<div class="row">
			<!----menu con --->
			<input id="show" type="checkbox" hidden/>
			<div class="col-sm-12 col-12 box__menu">
				<h3><span>Menu</span> 
					<label for="show" class="exit__menu">
					<i class="fas fa-sign-out-alt" style="font-size: 28px;background-color: #9597B2;border: 0;background-color: transparent;"></i>
					</label>
				</h3>
				<hr/>
				<ul class="menu__sm--child">
						@if(Session::has('khTaikhoan'))
						<li>	
						<a href="{{url('infomation/'.Session::get('khMa'))}}">
						@if(Session::get('khHinh')!=null)
							<img style="width: 50px;height: 50px;border-radius: 360px" src="{{URL::asset('public/images/khachhang/'.Session::get('khHinh'))}}" />
							&nbsp;{{Session::get('khTaikhoan')}}
						</a>
						@endif
						</li>
						@else	
						<li>	
							<a href="{{URL::to('login')}}">
								Đăng nhập&nbsp;<i class="fas fa-sign-in-alt"></i>
							</a>
						</li>
						@endif
					<li>
						<a style="color: white;font-size: 20px;" href="{{URL::to('/checkout')}}">
						<i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
								({{Cart::count()}})&nbsp; Giỏ hàng
						</a>
					</li>
					<li><a href="{{url('/')}}">Trang chủ</a></li>
					<li><a href="{{url('product')}}">Sản phẩm</a></li>
					<li><a href="{{url('product')}}">Tin tức</a></li>
					@if(Session::has('khTen'))
				    <li><a href="{{URL::to('listorder')}}">Danh sách đơn hàng của bạn</a></li>
				    		  		@endif
					<li>
						<a href="{{URL::to('logout')}}">
					 		Đăng xuất&nbsp;<i class="fas fa-sign-out-alt"></i>
					 	</a>
					</li>
					
				</ul>
			</div>
			<!----end menu con--->
			<div class="col-sm-6 left">
				<a href="{{URL::to('/')}}"><img src="{{URL::asset('public/fe/images/logo3.png')}}"></a>
			</div>
			<div class="col-sm-6 right">
				<a style="color: black;font-size: 30px;" href="{{URL::to('/checkout')}}">
						<i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
								({{Cart::count()}})
						</a>
				&nbsp;
				<label for="show" class="show__menu">
					<i class="fas fa-bars" style="font-size: 38px;"></i>
				</label>
			</div>

	</div>
	</div>



	
@yield('content')

<!-- footer -->
<div class="footer">
	<div class="container">
		<div class="col-md-3 footer-left">
			<h2><a href="index.html"><img src="{{URL::asset('public/fe/images/logo3.jpg')}}" alt=" " /></a></h2>
			<p>Neque porro quisquam est, qui dolorem ipsum quia dolor
			sit amet, consectetur, adipisci velit, sed quia non 
			numquam eius modi tempora incidunt ut labore 
			et dolore magnam aliquam quaerat voluptatem.</p>
		</div>
		<div class="col-md-9 footer-right">
			<div class="col-sm-6 newsleft">
				<h3>SIGN UP FOR NEWSLETTER !</h3>
			</div>
			<div class="col-sm-6 newsright">
				<form>
					<input type="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
					<input type="submit" value="Submit">
				</form>
			</div>
			<div class="clearfix"></div>
			<div class="sign-grds">
				<div class="col-md-4 sign-gd">
					<h4>Information</h4>
					<ul>
						<li><a href="index.html">Home</a></li>
						<li><a href="mens.html">Men's Wear</a></li>
						<li><a href="womens.html">Women's Wear</a></li>
						<li><a href="electronics.html">Electronics</a></li>
						<li><a href="codes.html">Short Codes</a></li>
						<li><a href="contact.html">Contact</a></li>
					</ul>
				</div>
				
				<div class="col-md-4 sign-gd-two">
					<h4>Store Information</h4>
					<ul>
						<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>Address : 1234k Avenue, 4th block, <span>Newyork City.</span></li>
						<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>Email : <a href="mailto:info@example.com">info@example.com</a></li>
						<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>Phone : +1234 567 567</li>
					</ul>
				</div>
				<div class="col-md-4 sign-gd flickr-post">
					<h4>Flickr Posts</h4>
					<ul>
						<li><a href="single.html"><img src="{{URL::asset('public/fe/images/b15.jpg')}}" alt=" " class="img-responsive" /></a></li>
						<li><a href="single.html"><img src="{{URL::asset('public/fe/images/b16.jpg')}}" alt=" " class="img-responsive" /></a></li>
						<li><a href="single.html"><img src="{{URL::asset('public/fe/images/b17.jpg')}}" alt=" " class="img-responsive" /></a></li>
						<li><a href="single.html"><img src="{{URL::asset('public/fe/images/b18.jpg')}}" alt=" " class="img-responsive" /></a></li>
						<li><a href="single.html"><img src="{{URL::asset('public/fe/images/b15.jpg')}}" alt=" " class="img-responsive" /></a></li>
						<li><a href="single.html"><img src="{{URL::asset('public/fe/images/b16.jpg')}}" alt=" " class="img-responsive" /></a></li>
						<li><a href="single.html"><img src="{{URL::asset('public/fe/images/b17.jpg')}}" alt=" " class="img-responsive" /></a></li>
						<li><a href="single.html"><img src="{{URL::asset('public/fe/images/b18.jpg')}}" alt=" " class="img-responsive" /></a></li>
						<li><a href="single.html"><img src="{{URL::asset('public/fe/images/b15.jpg')}}" alt=" " class="img-responsive" /></a></li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- //footer -->
<!-- js -->
<script type="text/javascript" src="{{URL::asset("public/fe/js/jquery-2.1.4.min.js")}}"></script>
<!-- //js -->
<!-- cart -->
	<script src="{{URL::asset("public/fe/js/simpleCart.min.js")}}"></script>
		<script type="text/javascript" src="{{URL::asset('public/fe/js/bootstrap-3.1.1.min.js')}}"></script>
<!-- cart -->
<script src="{{URL::asset("public/fe/js/js.js")}}"></script>


</body>
</html>