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
	<div class="row">
		<div class="col-lg-12 banner__header">
			banner bìa
		</div>
	</div>
	<div class="menu__lg">
		<div class="row header__top">
			<div class="col-lg-3">
				<a href="{{URL::to('/')}}"><img src="{{URL::asset('public/fe/images/logo3.png')}}"></a>
			</div>
			<div class="col-lg-9">
				<ul class="menu__header--top">
					<li class="menu__top--item" style="text-align: center;"><a href="{{URL::to('/checkout')}}">
						<i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
								({{Cart::count()}}) Giỏ hàng</a>
					</li>
					
					<li class="menu__top--item" style="text-align: center;"><a href="#"><i class="fas fa-tags" style="font-size: 18px;transform:rotateY(180deg);"></i>&nbsp;Khuyến mãi</a></li>
					@if(Session::has('khTen'))
				    		  		<li class="menu__top--item" style="text-align: center;"><a href="{{URL::to('wishlist')}}"><i class="far fa-heart" style="font-size: 18px;"></i>&nbsp;Bạn đã thích</a></li>
				    		@endif
					@if(Session::has('khTen'))
					
				    		<li class="menu__top--item" style="text-align: center;border:0;">
				    			 <a style="margin-left: -20px;">
								@if(Session::get('khHinh')!=null)
								<img style="width: 40px;height: 40px;border-radius: 360px;" src="{{URL::asset('public/images/khachhang/'.Session::get('khHinh'))}}" />
								@else
								<span></span>
								@endif 
								&nbsp;{{Session::get('khTen')}}
							</a>
						<ul class="menu__account--child">
								<li class="item" style="text-align: left;">
									<a href="{{url("/infomation/".Session::get('khMa'))}}">
					 						<i class="fas fa-info-circle" style="font-size: 18px;"></i>&nbsp;Thông tin cá nhân
					 				</a>
								</li>
								<li class="item" style="text-align: left;"><a href="{{URL::to('listorder')}}"><i class="far fa-file-alt" style="font-size: 18px;"></i>&nbsp;Đơn hàng</a>
								</li>
								<li class="item" style="text-align: left;">
									<a href="{{URL::to('logout')}}">
					 						<i class="fas fa-power-off" style="font-size: 18px;"></i>&nbsp;Đăng xuất
					 				</a>
								</li>
								<br/>
							</ul>
							
						</li>
							@else	
								<li class="menu__top--item" style="text-align: center;border:0;">
								<a href="{{URL::to('login')}}">
									<i class="fas fa-user-circle" style="font-size: 18px;"></i>&nbsp;Đăng nhập
								</a>
							</li>
							@endif
				</ul>
			</div>
		</div>
		<div class="row header__bot">
			<div class="col-lg-12">
				 <ul class="list__menu">
				    		<li class="list__menu--item">
				    			<a href="{{URL::to('/')}}"><i class="fas fa-home" style="font-size: 18px;color: red"></i>&nbsp;Trang chủ</a>
				    		</li>
				    		<li class="list__menu--item">
				    		<a href="{{URL::to('product')}}"><i class="fas fa-tv" style="font-size: 18px;color: red"></i>&nbsp;Sản phẩm</a>
				    		</li>	
				    		<li class="list__menu--item">
				    		<a href="#"><i class="fab fa-youtube" style="font-size: 18px;color: red"></i>&nbsp;Video</a>
				    		</li>
				    		<li class="list__menu--item">
				    		<a href="#"><i class="fas fa-user-plus" style="font-size: 18px;transform: rotateY(180deg);color: red"></i>&nbsp;Tuyển dụng</a>
				    		</li>		
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

<!--------CONTENT--------->
<div style="height: 157px;"></div>

	
@yield('content')

<!-- footer -->
<section class="footerr">
		<div class="container-fluid">
			<div class="row">
			<div class="col-1_5"></div>
			<div class="col-lg-9">
				<div class="footerr__top">
					<div class="row">
						<div class="col-lg-7 footerr__top--left">
						<i class="fas fa-caret-right" style="font-size: 48px;"></i>
						<i class="fas fa-caret-right" style="font-size: 48px;"></i>
						<i class="fas fa-caret-right" style="font-size: 48px;"></i>&nbsp;Nhận thông tin khuyến mãi và nhiều ưu đãi từ cửa hàng qua email</div>
						<div class="col-lg-5 footerr__top--right">
							<form>
								<input type="email" name="email" placeholder="email của bạn..." />
								<button type="submit" class="btn btn-danger btn-outline-dark text-white">Đăng ký</button>
							</form>
						</div>
					</div>
				</div>
				<div class="footerr__bot">
					<div class="row">
						<div class="col-lg-4 footerr__bot--left">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.95441038776!2d106.6756434137993!3d10.737997192347606!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f62a90e5dbd%3A0x674d5126513db295!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBDw7RuZyBOZ2jhu4cgU8OgaSBHw7Ju!5e0!3m2!1svi!2s!4v1624222399573!5m2!1svi!2s" style="border:0;height: 195px;width: 100%;border: 1px solid black;" allowfullscreen="" loading="lazy"></iframe>
						</div>
						<div class="col-lg-8 footerr__bot--right"></div>
					</div>
				</div>
			</div>
			<div class="col-1_5"></div>
		</div>
		</div>
</section>
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