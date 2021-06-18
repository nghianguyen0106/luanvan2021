@extends('Userpage.layout')
@section('title')
Danh sách sản phẩm
@endsection
@section('content')



<!--Slide-->
<br/>
<div class="container-fluid" >
<div class="row">
<div class="col-lg-8" style="margin:0;padding:0;">
@if($countSlide > 0)
<div class="slider">
	<div class="slides">
	<input type="radio" name="radio-btn" id="radio1"/>
	<input type="radio" name="radio-btn" id="radio2"/>
	<input type="radio" name="radio-btn" id="radio3"/>
	
  	@foreach($slide as $slide)
    <div class="slide">
      <img src="{{{'public/images/banners/'.$slide->bnHinh}}}" style="width: 100%" alt="...">  
    </div>
    @endforeach
    <!---button navigation--->
	  <div class="navigation-auto">
	  	@if($countSlide == 1)
	    	<div class="auto-btn1"></div>
	    @elseif($countSlide == 2)
	    	<div class="auto-btn1"></div>
	    	<div class="auto-btn2"></div>
	    	@elseif($countSlide == 3)
	    	<div class="auto-btn1"></div>
	    	<div class="auto-btn2"></div>
	    	<div class="auto-btn3"></div>
	    	@endif
	 </div>
	</div>
	<div class="navigation-manual">
		@if($countSlide == 1)
    	<label for="radio1" class="manual-btn"></label>
    	@elseif($countSlide == 2)
    	<label for="radio1" class="manual-btn"></label>
    	<label for="radio2" class="manual-btn" ></label>
    	@elseif($countSlide == 3)
    	<label for="radio1" class="manual-btn"></label>
    	<label for="radio2" class="manual-btn" ></label>
    	<label for="radio3" class="manual-btn"></label>
    	@endif
    </div>
     <!---end button navigation--->
</div>

  <script>
	document.getElementsByClassName('slide')[0].setAttribute('class', 'slide first');
	var counter = 1;
	setInterval(function(){
		document.getElementById("radio"+counter).checked = true;
		counter++;
		if(counter > 3)
		{
			counter = 1;
		}
	}, 5000);
	</script>
	@endif
</div>
<!--END COL 8-->
<!--COL 4-->
	
<div id="banners" class="col-lg-4">
	<div>	
		@if($countBnCon1==0)
			<div></div>
		@elseif($countBnCon1==1)
		@for($i=0;$i<1;$i++)
			@php 
	 			$bn1 = array($bnCon) 
	 		@endphp
			@foreach($bn1 as $key => $v)
			<div class="banners__child">
				<img src="{{{'public/images/banners/'.str_replace('"','',json_encode($v[$i]->bnHinh))}}}"/>
			</div>
			@endforeach
			@endfor
			@elseif($countBnCon1>=2)
		@for($i=0;$i<2;$i++)
			@php 
	 			$bn1 = array($bnCon) 
	 		@endphp
			@foreach($bn1 as $key => $v)
			<div class="banners__child">
				<img src="{{{'public/images/banners/'.str_replace('"','',json_encode($v[$i]->bnHinh))}}}"/>
			</div>
			@endforeach
			@endfor
		@endif
	</div>
</div>
<!--END COL 4-->
</div>
<!--BANNER ROW-->
<div class="row">
	 @if($countBnCon2==3)
	 @for($i = 2; $i<=2;$i++)
	 	@php 
	 		$bn2 = array($bnCon) 
	 	@endphp
		@foreach($bn2 as $key => $v)
		<div class="col-lg-4 banners__child">
				<img  style="width:102%;height:200px" src="{{{'public/images/banners/'.str_replace('"','',json_encode($v[$i]->bnHinh))}}}"/>
		</div>
		@endforeach
	@endfor
	@elseif($countBnCon2==4)
	 @for($i = 2; $i<=3;$i++)
	 	@php 
	 		$bn2 = array($bnCon) 
	 	@endphp
		@foreach($bn2 as $key => $v)
		<div class="col-lg-4 banners__child">
				<img  style="width:102%;height:200px" src="{{{'public/images/banners/'.str_replace('"','',json_encode($v[$i]->bnHinh))}}}"/>
		</div>
		@endforeach
	@endfor
	@elseif($countBnCon2>4)
	 @for($i = 2; $i<=4;$i++)
	 	@php 
	 		$bn2 = array($bnCon) 
	 	@endphp
		@foreach($bn2 as $key => $v)
		<div class="col-lg-4 banners__child">
				<img  style="width:102%;height:200px" src="{{{'public/images/banners/'.str_replace('"','',json_encode($v[$i]->bnHinh))}}}"/>
		</div>
		@endforeach
	@endfor
	@else
	<div></div>
	@endif	 
</div>



<!--END-->
</div>
<hr/>
<!--END SILDE-->
<!-- mens -->

<div class="men-wear">
	<div class="container">
		<div class="col-md-3 products-left">
			{{-- SEARCH --}}
			<h4 style="color: #FDA30E; font-size: 25px; text-transform: uppercase;">Lọc sản phẩm</h4>
			<form class="form" action="{{URL::to('findpro')}}"  method="get" accept-charset="utf-8">
		
				<div class="col">
					<div class="row-1">
						<div class="input-group mb-1">
							 <span class=" input-group-text">Tên sản phẩm &nbsp;&nbsp;
							  <input type="text" class="form-control" name="proname" ></span>
						</div>
					</div>
					<div class="row-1">
						<div class="input-group mb-1">
							 <span class=" input-group-text">Giá từ &nbsp;&nbsp;&nbsp;&nbsp;
							  <input   type="range" class="form-range" id="priceFrom" value="0" min=0 max=100000000 name="priceFrom" ><span id="pf"></span>&nbsp;</span>
							  
						</div>
					</div>
					<div class="row-1">
						<div class="input-group mb-1">
							  <span class="input-group-text">Giá đến &nbsp;
							  <input type="range" class="form-range" id="priceTo" value="100000000" min=0 max=100000000 name="priceTo" ><span id="pt"></span>&nbsp;</span>
							  
						</div>
					</div>
					
					<hr>
					<div class="row-2">
						<div class="col my-3">
							<label>Thương hiệu: </label><br>
							@foreach($brand as $i)
								<div class="row-1 form-check-inline">
								  <label class="form-check-label"><input class="form-check-input" type="checkbox" name="brand[]" value="{{$i->thMa}}" id="flexCheckDefault">&nbsp;
								    {{$i->thTen}}
								  </label>
								</div>
							@endforeach
						</div>
						<hr>
						<div class="col my-3">
							@foreach($needs as $i)
							<label ><input type="checkbox" name="needs[]" class="row-1 form-check-input ms-1" value="{{$i->ncMa}}">&nbsp;{{$i->ncTen}}</label>&nbsp;&nbsp;
							@endforeach
						</div>
						<hr>
						<div class="col my-3">
							@foreach($cate as $i)
							<label ><input type="checkbox" name="category[]" class="row-1 form-check-input ms-1" value="{{$i->loaiMa}}">&nbsp;{{$i->loaiTen}}</label>&nbsp;&nbsp;
							@endforeach
						</div>
					</div>
				</div>
				
				<button class="btn btn-outline-warning col-12" type="submit"><i class="fas fa-search"></i></button>
			</form>
			{{--  --}}
	<hr>
			<div class="clearfix"></div>
		</div>
		<div class="col-md-9 products-right">
			<h5>Danh sách sản phẩm</h5>

			{{-- QUICK SORT --}}
			{{--  <div class="sort-grid">
				<div class="sorting">
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
				<div class="clearfix"></div>
			</div> 
 --}}

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
						
					<?php $check = array();?>
			
					@foreach($db as $k => $i)	

					@if (in_array($i->spMa, $check)==null && $i->spTinhtrang==1) 
					
					<?php array_push($check, $i->spMa); ?>
				<div class="col-md-4 product-men p-4" style="height: 400px">
					<div class="men-pro-item simpleCart_shelfItem">
						<div class="men-thumb-item">
								<img style="height: 200px" src="{{URL::asset('public/images/products/'.$i->spHinh)}}" alt="" class="pro-image-front">
								<img style="height: 200px" src="{{URL::asset('public/images/products/'.$i->spHinh)}}" alt="" class="pro-image-back">							
								

										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">

												<a href="{{URL::to('proinfo/'.$i->spMa)}}" class="link-product-add-cart">Xem sản phẩm</a>
								
											</div>
										</div>
										{{-- <span class="product-new-top">New</span> --}}
										
						</div>
						<div class="item-info-product ">
									<h4><a href="{{URL::to('proinfo/'.$i->spMa)}}">{{$i->spTen}}</a></h4>
									<div class="info-product-price">
										<span class="item_price">{{number_format($i->spGia)}} VND</span>
									
									</div>
									<a href="{{URL::to('save-cart/'.$i->spMa)}}" class="item_add single-item hvr-outline-out button2"><i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng</a>
									@if(Session::has('khMa'))
											<a href="{{URL::to('addtowishlist/'.$i->spMa)}}" class="btn btn-outline-danger"><i class="fas fa-heart"></i></a>
									@endif
						</div>
					</div>
				</div>
				@endif
				@endforeach


						{{--  --}}
				<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		
		
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

</body>
</html>
{{-- Notification --}}

@if(Session::has('loginmess'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: '{{Session::get('name')}}',
  text: '{{Session::get('loginmess')}}',
 
})
</script> 
@endif

@if(Session::has('addCart'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: '',
  text: '{{Session::get('addCart')}}',
 	footer: '<a href="{{URL::to('checkout')}}" class="btn btn-outline-warning">Tới giỏ hàng</a></span>'
})
</script> 
@endif
@if(Session::has('errCart'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('errCart')}}',
 
})
</script> 
@endif

@if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo: ',
  text: '{{Session::get('err')}}',
 
})
</script> 
@endif

@if(Session::has('success'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Thông báo: ',
  text: '{{Session::get('success')}}',
 
})
</script> 
@endif

 <script>
 	var inpf = document.getElementById('priceFrom');
 	var outpf =document.getElementById('pf');
 	outpf.innerHTML= Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(inpf.value);
 	inpf.oninput=function(){
 		outpf.innerHTML=   Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(this.value);
 	}

 	var inpt = document.getElementById('priceTo');
 	var outpt =document.getElementById('pt');
 	outpt.innerHTML= Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(inpt.value);
 	inpt.oninput=function(){
 		outpt.innerHTML =  Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(this.value);
 	}
 </script>
{{--  --}}
@endsection
