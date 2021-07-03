<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Html5</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
 	<link href="{{URL::asset("public/fe/css/bootstrap.css")}}" rel="stylesheet" type="text/css" media="all" />
 	<link href="{{URL::asset("public/welcome/style.css")}}" rel="stylesheet" type="text/css" media="all" /> 
	<link rel="stylesheet" type="text/css" href="{{URL::asset("public/fe/css/jquery-ui.css")}}">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="favicon.ico">
  </head>

  <body>
  	<section class="container-fluid header__top">
  
		<div class="col-lg-12 banner__header" style="background-image: url(//theme.hstatic.net/1000026716/1000440777/14/bn-top1.jpg?v=20498);background-size: cover;height: 60px;width: 100%;">
		</div>
	
  		<div class="row">
  			<div class="col-lg-6">
  				<div class="header__top--left">
  					<img alt="WP Compu Care" src="http://demo.cmssuperheroes.com/themeforest/wp-compu-care/wp-content/themes/wp-compu-care/assets/images/logo.png">
  				</div>
  			</div>
  			<div class="col-lg-6 header__top--right">
  					<ul class="top__right--menu">
  						<li class="menu__item">
  							<a href="{{URL::to('/')}}">
  								<i class="fas fa-home" ></i>&nbsp;Trang chủ
  							</a>
  						</li>
  						<li class="menu__item">
  							<a href="{{URL::to('product')}}">
  							<i class="fas fa-tv" ></i>&nbsp;Sản phẩm
  							</a>
  						</li>
  						<!--php-->
  						@if(Session::has('khTen'))
  						<li class="menu__item">
	  						<a  href="{{url("/infomation/".Session::get('khMa'))}}">
	  							@if(Session::get('khHinh')!=null)
									<img style="width: 30px;height: 30px;border-radius: 360px;" src="{{URL::asset('public/images/khachhang/'.Session::get('khHinh'))}}" />
									@else
						   			<i class="fas fa-user-circle" style="font-size: 28px;color: lightgrey;position: relative;top:3px"></i>
									@endif 
									&nbsp;{{Session::get('khTen')}}
	  						</a>
	  						<ul class="item__menu--child">
	  							<li class="item__triangle"></li>
	  							<div class="box__list--item">
	  							<li class="menu__child--item">
	  								<a href="{{url("/infomation/".Session::get('khMa'))}}">
					 				<i class="fas fa-info-circle" ></i>&nbsp;Thông tin cá nhân
					 				</a>
	  							</li>
	  							<li class="menu__child--item">
	  								<a href="{{URL::to('wishlist')}}"><i class="far fa-heart" ></i>&nbsp;Sản phẩm yêu thích
	  								</a>
	  							</li>
	  							<li class="menu__child--item">
	  								<a href="{{URL::to('listorder')}}"><i class="far fa-file-alt" ></i>&nbsp;Đơn hàng
	  								</a>
	  							</li>
	  							<li class="menu__child--item">
	  								<a href="{{URL::to('logout')}}">
					 						<i class="fas fa-power-off" ></i>&nbsp;Đăng xuất
					 				</a>
	  							</li>
	  							</div>
	  						</ul>
	  					</li>
  						@else
  						<li class="menu__item">
  							<a href="{{URL::to('login')}}">
  								<i class="fas fa-user-circle" ></i>&nbsp;Đăng nhập
  							</a>
  						</li>
  						@endif
  						<!--endphp-->
  						<li class="menu__item--border"></li>
  						<li class="menu__item">
  							<a href="{{URL::to('/checkout')}}">
  								<i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i>
								({{Cart::count()}})
							</a>
  						</li>
  						
  						
  					</ul>
  			</div>
  		</div>
  	</section>

  	<!--------------CONTENT-------------->
   	<section class="container-fluid wel__bg">
   			<div class="col-lg-12 bg__video">
   				<video muted loop autoplay>
   					<source src="{{URL::asset('public/videos/bg-laptop.mp4')}}" type="video/mp4">
   				</video>
   			</div>
   			<div class="col-lg-6 bg__content">
   				<h2> Tiềm năng của bạn. niềm đam mê của bên chúng tôi. <br/>Đạt kết quả tốt lan toả sự tin tưởng.</h2>
   			</div>
   	</section>

   	<section class="container-fluid wel__content">
   		<div class="row">
   			<div class="col-lg-6" style="margin: 0;padding: 0;">
	   			<div class="wel__content--left">
	   				<img src="{{URL::asset('public/images/bg-button/bg1.png')}}" alt="">
	   				<div class="left__content">
	   					<div class="content__icon">
	   						<i class="fas fa-laptop" style="font-size: 60px;"></i>
	   					</div>
	   					
	   					<div class="content__text">
	   						<div>LAPTOP</div>
	   						<div>Is your handheld deivce running slowly or did you drop it and now it’s smashed? Bring it to us and have it fixed like new.</div>
	   						<div>
	   							<a>Xem thêm &emsp;<i class="fas fa-angle-right"></i></a>
	   						</div>
	   					</div>
	   				</div>
	   			</div>
   			</div>
   			<div  class="col-lg-6" style="margin: 0;padding: 0;">
	   			<div class="wel__content--right">
	   				<img src="{{URL::asset('public/images/bg-button/bg2.png')}}" alt="">
	   				<div class="right__content">
	   					<div class="content__icon">
	   						<i class="fas fa-server" style="font-size: 60px;"></i>
	   					</div>

	   					<div class="content__text">
	   						<div>PC</div>
	   						<div>From full rebuilds to system repairs, we have all the tools to build the perfect PC or to get yours back up to speed again.</div>
	   						<div>
	   							<a>Xem thêm &emsp;<i class="fas fa-angle-right"></i></a>
	   						</div>
	   					</div>
	   				</div>
	   			</div>
   			</div>
   		</div>

   		<!--------------------->

   		<div class="row">
   			<div class="col-lg-2"></div>
   			<div class="col-lg-8 col-sm-12 welcome__text">
   				<h2>
   					<span>Chào mừng bạn đến với</span>
   					<span>Compu-Care</span>
   				</h2>
   				<div class="border__short"></div>
   				<div class="text">
   					Nunc feugiat augue non arcu iaculis dignissim. Curabitur laoreet elit non vestibulum ullamcorper. Ut fringilla pulvinar nibh, non suscipit justo lacinia vel. Aenean at dui pharetra est vulputate porttitor. In placerat sit amet ipsum a ullamcorper.
   				</div>
   			</div>
   			<div class="col-lg-2"></div>
   			</div><br/><br/>

   			<!---------PRODUCT---------->
   			<div class="row box__product">
   				<div class="container"><h3>SẢN PHẨM NỐI BẬT</h3></div>
   				<hr/>
   				<div id="left__arr"  class="col-lg-1 product__arrow">
   					<i class="fas fa-chevron-left" style="font-size: 48px;"></i>
   				</div>
   				<div class="col-lg-10">
   					<div class="row list__product">
   						@foreach($db as $v)
   						<div class="product">
   							<div class="link__proInfo">
   								<a href="{{url('proinfo/'.$v->spMa)}}">Xem chi tiết</a>
   							</div>
   							<img src="{{URL::asset('public/images/products/'.$v->spHinh)}}" /><br/>
   							<h3>{{$v->spTen}}</h3>
   							<h4 class="text-danger">{{number_format($v->spGia)}}VND</h4>
   							<a class="btn btn-primary" href="{{URL::to('save-cart/'.$v->spMa)}}"><i class="far fa-cart-arrow-down" style="font-size: 18px;"></i>&emsp;Thêm vào giỏ hàng</a>
   						</div>
   						@endforeach
   					</div>
   				</div>
   				<div id="right__arr" class="col-lg-1 product__arrow">
   					<i class="fas fa-chevron-right" style="font-size: 48px;"></i>
   				</div>
   			</div>
   		

   			<br/><br/>
   			<!-----------------CONTENT AND FOOTER----------------->
   			<div class="col-lg-12 mid__content">
   				<!-----------CONTENT------------->
   				<div class="row content__pro">
   					<div class="col-lg-6 content__pro--img">
   						<img src="https://demo.cmssuperheroes.com/themeforest/wp-compu-care/wp-content/uploads/2016/10/bg-computer.png" class="vc_single_image-img attachment-full"/>
   					</div>
			   		<div class="col-lg-1 content__pro--border">
			   			<div></div>
			   		</div>
   					<div class="col-lg-5 content__pro--text">
   						<h2>Đội ngũ nhân viên</h2>
   						<br/>
   						<div>
   							Đội ngũ nhân viên được đào tạo nhằm chăm sóc tốt đối với khách hàng
   						</div>
   						<br/>
   						<a href="#">Xem thêm</a>
   					</div>
   				</div>
   				
   				<div class="row content__pro">
   					<div class="col-lg-5 content__pro--text">
   						<h2>Chương trình khuyến mãi hấp dẫn</h2>
   						<br/>
   						<div>
   							Các chương trình khuyến mãi hấp dẫn với một số sản phẩm.... 
   						</div>
   						<br/>
   						<a href="#">Xem thêm</a>
   					</div>
   					<div class="col-lg-1 content__pro--border">
   						<div></div>
   					</div>
   					<div class="col-lg-6 content__pro--img">
   						<img src="https://demo.cmssuperheroes.com/themeforest/wp-compu-care/wp-content/uploads/2016/10/bg-computer.png" class="vc_single_image-img attachment-full"/>
   					</div>
   				</div>

   				<div class="row content__pro">
   					<div class="col-lg-6 content__pro--img">
   						<img src="https://demo.cmssuperheroes.com/themeforest/wp-compu-care/wp-content/uploads/2016/10/bg-computer.png" class="vc_single_image-img attachment-full"/>
   					</div>
			   		<div class="col-lg-1 content__pro--border">
			   			<div></div>
			   		</div>
   					<div class="col-lg-5 content__pro--text">
   						<h2>Đội ngũ nhân viên</h2>
   						<br/>
   						<div>
   							Đội ngũ nhân viên được đào tạo nhằm chăm sóc tốt đối với khách hàng
   						</div>
   						<br/>
   						<a href="#">Xem thêm</a>
   					</div>
   				</div>

   				<!------------END CONTENT------------>
   				<!-----------FOOTER------------->
   				<div class="container-fluid box__footer">
   					<div class="container">
   						<div class="row footer">
   							<div class="col-lg-3 list__footer">
   								<ul><h5>Hỗ trợ khách hàng</h5>
   									<div class="border__span"></div>
   									<li>Hotline chăm sóc khách hàng:<br/>
   										19000091
   									</li>
   									<li>Email liên hệ:</li>
   									<li>Hướng dẫn trả góp</li>
   								</ul>
   							</div>
   							<div class="col-lg-3 list__footer">
   								<ul><h5>Về Compu-Care</h5>
   									<div class="border__span"></div>
   									<li>Giới thiệu Compu-Care</li>
   									<li>Tuyển dụng</li>
   									<li>Chính sách đổi trả</li>
   									<li>Phương thức vận chuyển</li>
   								</ul>
   							</div>
   							<div class="col-lg-3 list__footer">
   								<ul><h5>Sản phẩm được quan tâm</h5>
   									<div class="border__span"></div>
   									<li>
   										@foreach($dbrand as $v)
   										<a class="col-lg-6" href="{{url('proinfo/'.$v->spMa)}}">
   											<img src="{{URL::asset('public/images/products/'.$v->spHinh)}}" /><br/>
   											<span>{{$v->spTen}}</span>
   										</a>

   										@endforeach
   									
   									</li>
   								</ul>
   							</div>
   							<div class="col-lg-3 list__footer">
   								<ul><h5>Kết nối với chúng tối</h5>
   									<div class="border__span"></div>
   									<li>
   										<a><i class="fab fa-facebook-square" style="font-size: 28px;color: #34A5F4"></i></a>&emsp;
   										<a><i class="fab fa-twitter-square" style="font-size: 28px;color: #34A5F4"></i></a>
   									</li>
   									
   								</ul>
   							</div>
   						</div>
   						<hr/>
   						<div class="row">
   							<div class="col-lg-6 footer">
   								<p>Địa chỉ cửa hàng: 180 Cao Lỗ, phường 10, Quận 8, thành phố Hồ Chí Minh</p>

                  <p>Compu-Care nhận đặt hàng trực tuyến và giao hàng tận nơi, và đội ngũ nhân viên hướng dẫn khách hàng mua hàng tận tình tại cửa hàng</p>
   							</div>
   						</div>
   						<hr/>
   						<div class="row">
   								<div class="col-lg-6 footer">
   								<p>© 2021 - Bản quyền của Công Ty Cổ Phần Compu-Care - compucare.com</p>
								<p>Giấy chứng nhận Đăng ký Kinh doanh số 0908712023 do Sở Kế hoạch và Đầu tư Thành phố Hồ Chí Minh cấp ngày 06/01/2021
								</p>
   							</div>
   							<div class="col-lg-6 footer" style="text-align: right;">
   								<img width="40" height="40" src="{{URL::asset('public/images/footer/bo-cong-thuong-2.png')}}" />
   								<img src="{{URL::asset('public/images/footer/bo-cong-thuong.svg')}}"/>
   							</div>
   						</div>
   					</div>
   				</div>
   				<!------------END FOOTER------------->
   			</div>
   		<!------------------>
   	</section>




 








	<!-- js -->
	<script type="text/javascript" src="{{URL::asset("public/fe/js/jquery-2.1.4.min.js")}}"></script>
	<script type="text/javascript" src="{{URL::asset('public/fe/js/bootstrap-3.1.1.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('public/welcome/js.js')}}"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
