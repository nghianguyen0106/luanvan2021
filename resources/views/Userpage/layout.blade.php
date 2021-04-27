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
<!-- js -->
<script type="text/javascript" src="{{URL::asset("public/fe/js/jquery-2.1.4.min.js")}}"></script>
<!-- //js -->
<!-- cart -->
	<script src="{{URL::asset("public/fe/js/simpleCart.min.js")}}"></script>
<!-- cart -->
<!-- for bootstrap working -->
	<script type="text/javascript" src="{{URL::asset("public/fe/js/bootstrap-3.1.1.min.js")}}"></script>
<!-- //for bootstrap working -->
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic' rel='stylesheet' type='text/css'>
<script src="{{URL::asset("public/fe/js/jquery.easing.min.js")}}"></script>
{{-- ADD Bootstrap 5 --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
{{-- FontAW --}}
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
{{-- SweetAlert --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<style>

</style>

</head>
<body>
<!-- header -->
<div class="header">
	<div class="container">
		<ul>
	
			<li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="#">luanvan@gmail.com</a></li>
		</ul>
	</div>
</div>
<!-- //header -->
<!-- header-bot -->
<div class="header-bot">
	<div class="container">
		<div class="col-md-2 header-left">
			<h1><a href="{{URL::to('/')}}"><img style="height: 100px;width: 100px;" src="{{URL::asset('public/fe/images/logo3.png')}}"></a></h1>
		</div>
				<div class="col-md-4 footer-bottom">
				@if(Session::has('khTen'))
				<div>
					<ul class="menu__account">
						<li>
							<a style="text-decoration: none;font-size: 24px;color:#0A0746">
						<i class="far fa-user-circle"></i>&nbsp;{{Session::get('khTen')}}</a>
						<ul class="menu__account--child">
							<br/>
							<li>
								<a style="text-decoration: none;font-size: 20px;color:#0A0746" href="{{url("/infomation/".Session::get('khMa'))}}">
			 						Thông tin cá nhân&nbsp;
			 							<i class="far fa-eye"></i>
			 					</a>
							</li>
							<li>
								<a style="text-decoration: none;font-size: 20px;color:#0A0746" href="{{URL::to('logout')}}">
			 						Đăng xuất&nbsp;<i class="fas fa-sign-out-alt"></i>
			 					</a>
							</li>
							<br/>
						</ul>
						</li>
					</ul>
				</div>
				@else
				<div>
					<ul class="menu__account">
					<li>
						<a style="text-decoration: none;font-size: 20px;color:#0A0746" href="{{URL::to('login')}}">
							Đăng nhập&nbsp;<i class="fas fa-sign-in-alt"></i>
						</a>
					</li>
					<li>
						Hoặc
						<a href="#" style="font-size: 30px; color: red"><i class="fab fa-google-plus" ></i></a>
						<a href="#" style="font-size: 30px; color: blue"><i class="fab fa-facebook"></i></a>
					</li>
					</ul>
				</div>
				@endif
		</div>
		<div class="col-md-6 header-middle">
			<form  class="form" action="{{URL::to('findpro')}}"  method="get" accept-charset="utf-8">
				
				<div class="search">
					<input type="search" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}" required="" name="proname" >
				</div>
				<div class="section_room">
					<select id="country" name="category" onchange="change_country(this.value)" class="frm-field required">
						@foreach($cate as $i)
						<option value="{{$i->loaiMa}}">{{$i->loaiTen}}</option>
						@endforeach 
					</select>
				</div>
				<div class="sear-sub">
					<input type="submit" value=" ">
				</div>
				<div class="clearfix"></div>
			</form>
		</div>

		<div class="clearfix"></div>
	</div>
</div>
<!-- //header-bot -->
<!-- banner -->
<div class="ban-top">
	<div class="container">
		<div class="top_nav_left">
			<nav class="navbar navbar-default">
			  <div class="container-fluid">
				<nav class="navbar navbar-expand-lg navbar-default">
				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
				   {{--  <ul class="navbar-nav mr-auto">
				     <li class="active menu__item "><a class="menu__link" href="{{URL::to('product')}}">Home <span class="sr-only"></span></a></li>
				     <li class=" "><a class="menu__link" href="">Danh mục sản phẩm <span class="sr-only"></span></a></li>
				     <li class=""><a class="menu__link" href="{{URL::to('product')}}">Liên hệ với chúng tôi <span class="sr-only"></span></a></li>
				     
				      </li>
				    </ul> --}}
				  <ul id="list__menu">
				    	<li class="list__menu--item"><a href="{{URL::to('product')}}">Home</a></li>
				    	<li class="list__menu--item"><a href="{{URL::to('product')}}">Liên hệ với chúng tôi</a></li>
				    		@if(Session::has('khTen'))
				    		  		<li class="list__menu--item"><a href="#">Danh sách hóa đơn</a></li>
				    		  		@endif
				    </ul>
				    
				  </div>
				</nav>
			  </div>
			</nav>	
		</div>
		  
		<div class="top_nav_right">
			<div class="cart box_1">
						<a href="{{URL::to('/checkout')}}">
							<h3> <div class="total">
								 <i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
								{{number_format($total)}} VND | ({{Cart::count()}})Item</div>
								
							</h3>
						</a>
						<p><a href="{{URL::to('destroy-cart')}}" class="simpleCart_empty"><i class="fas fa-trash-alt"></i> Xóa toàn bộ sản phẩm trong giỏ hàng</a></p>
						
			</div>	
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- //banner-top -->
<!-- banner -->
<div class="page-head" style="background-image: url('{{URL::asset('public/fe2/images/2.jpg')}}'); background-size: 15">
	<div class="container">
		<h3>PC</h3>
	</div>
</div>
<!-- //banner -->

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