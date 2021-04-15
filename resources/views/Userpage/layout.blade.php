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
<link href="{{URL::asset('public/fe/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('public/fe/css/jquery-ui.css')}}">
<link href="{{URL::asset('public/fe/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
<!-- js -->
<script type="text/javascript" src="{{URL::asset('public/fe/js/jquery-2.1.4.min.js')}}"></script>
<!-- //js -->
<!-- cart -->
	<script src="{{URL::asset('public/fe/js/simpleCart.min.js')}}"></script>
<!-- cart -->
<!-- for bootstrap working -->
	<script type="text/javascript" src="{{URL::asset('public/fe/js/bootstrap-3.1.1.min.js')}}"></script>
<!-- //for bootstrap working -->
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<script src="{{URL::asset('public/fe/js/jquery.easing.min.js')}}"></script>
</head>
<body>
<!-- header -->
<div class="header">
	<div class="container">
		<ul>
	
			<li><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><a href="mailto:info@example.com">nguyenchinghia199916@<gmail class="com"></gmail></a></li>
		</ul>
	</div>
</div>
<!-- //header -->
<!-- header-bot -->
<div class="header-bot">
	<div class="container">
		<div class="col-md-3 header-left">
			<h1><a href="{{URL::to('/')}}"><img style="height: 150px;" src="{{URL::asset('public/fe/images/logo3.png')}}"></a></h1>
		</div>
		<div class="col-md-6 header-middle">
			<form>
				<div class="search">
					<input type="search" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}" required="">
				</div>
				<div class="section_room">
					<select id="country" onchange="change_country(this.value)" class="frm-field required">
						<option value="null">LAPTOP</option>
						<option value="null">PC</option>     
					</select>
				</div>
				<div class="sear-sub">
					<input type="submit" value=" ">
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
		<div class="col-md-3 header-right footer-bottom">
			<ul style="font-size: 30px;">
				@if(Session::has('khTen'))
				<h5  >Wellcome {{Session::get('khTen')}} !!!</h5>
 					<li><a href="{{URL::to('logout')}}"><i class="fas fa-sign-out-alt"></i></a></li>
				@else
					<li><a href="{{URL::to('login')}}"><i class="fas fa-sign-in-alt"></i></a></li>
				@endif
				
				


				<li><i class="fab fa-facebook"></i></li>
				<li><i class="fab fa-instagram"></i></li>
			</ul>
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
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
				  <ul class="nav navbar-nav menu__list">
					<li class="active menu__item "><a class="menu__link" href="{{URL::to('product')}}">Home <span class="sr-only">(current)</span></a></li>
					<li class="dropdown menu__item menu__item--current">
						<a href="#" class="dropdown-toggle menu__link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Danh mục sản phẩm<span class="caret"></span></a>
							<ul class="dropdown-menu  columns-3">
								<li>LAPTOP</li>
								<li>PC</li>
							</ul>
					</li>
					<li class=" menu__item "><a class="menu__link" href="contact.html">Liên hệ</a></li>
				  </ul>
				</div>
			  </div>
			</nav>	
		</div>
		<div class="top_nav_right">
			<div class="cart box_1">
						<a href="{{URL::to('/checkout')}}">
							<h3> <div class="total">
								<i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
								<span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span> items)</div>
								
							</h3>
						</a>
						<p><a href="javascript:;" class="simpleCart_empty">Rỗng</a></p>
						
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
		<p class="copy-right">&copy 2016 Smart Shop. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
	</div>
</div>
<!-- //footer -->