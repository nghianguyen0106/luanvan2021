@extends('Userpage.layout')
@section('title')
Danh sách sản phẩm
@endsection
@section('content')



<!--Slide-->
<div class="container-fluid">
	<div class="row">
<div class="quang__cao" style="width: 12.3%;background-image: url(https://theme.hstatic.net/1000026716/1000440777/14/xxxbannerxxx1.png?v=20498);background-size: cover;"></div>
<div class="col-lg-9">
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
				<img  style="width:102%;height:165px" src="{{{'public/images/banners/'.str_replace('"','',json_encode($v[$i]->bnHinh))}}}"/>
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
				<img  style="width:102%;height:165px" src="{{{'public/images/banners/'.str_replace('"','',json_encode($v[$i]->bnHinh))}}}"/>
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
				<img  style="width:102%;height:165px" src="{{{'public/images/banners/'.str_replace('"','',json_encode($v[$i]->bnHinh))}}}"/>
		</div>
		@endforeach
	@endfor
	@else
	<div></div>
	@endif	 
</div>
</div>

<div class="quang__cao2" style="width: 12.3%;background-image: url(https://theme.hstatic.net/1000026716/1000440777/14/xxxbannerxxx2.png?v=20498);background-size: cover"></div>
<!--END-->
</div>
</div>
<hr/>
<!--END SILDE-->
<!-- mens -->

<div class="men-wear">
	<div class="container-fluid">
		<div class="row justify-content-around">
			
		<div class="col-lg-2 col-sm-8 products-left box__search">
			{{-- SEARCH --}}
			<div class="title__search">TÌM SẢN PHẨM</div>
			<br/>
			<form class="form" action="{{URL::to('findpro')}}"  method="get" accept-charset="utf-8">
		
				<div class="col">
					<div class="row-1">
						<div class="input-group mb-1">
							  <input type="text" class="form-control" name="proname" placeholder="Nhập tên sản phẩm...." ></span>
						</div>
					</div>
					<div class="row-1">
						<div>
							 <span>Giá từ: </span><span id="pf" s></span><br/>
							  <input  type="range" class="form-range" id="priceFrom" value="0" min=0 max=100000000 name="priceFrom" >
							  
						</div>
					</div>
					<br/>
					<div class="row-1">
						<div>
							  <span>Giá đến: </span><span id="pt" s></span><br/>
							  <input type="range" class="form-range" id="priceTo" value="100000000" min=0 max=100000000 name="priceTo" >
							  
						</div>
					</div>
					
					<hr>
					<div class="row-2">
						
							<label>Thương hiệu:</label><br>
							<div class="row">
							@foreach($brand as $i)
								<div class="col-lg-6" style="font-size: 14px;">
								<input class="form-check-input" type="checkbox" name="brand[]" value="{{$i->thMa}}" id="flexCheckDefault">  {{$i->thTen}}
								</div>
								 
								
							@endforeach
						</div>
						<hr>
					
							<label>Nhu cầu:</label><br>
							<div class="row">
							@foreach($needs as $i)
							<div class="col-lg-8" style="font-size: 14px;">
							<input type="checkbox" name="needs[]" class="row-1 form-check-input ms-1" value="{{$i->ncMa}}">&nbsp;{{$i->ncTen}}
						</div>
							@endforeach
						</div>
						<hr>

							<label>Loại:</label><br>
							<div class="row">
							
							@foreach($cate as $i)
							<div class="col-lg-6" style="font-size: 14px;">
							<input type="checkbox" name="category[]" class="row-1 form-check-input ms-1" value="{{$i->loaiMa}}">&nbsp;{{$i->loaiTen}}
						</div>
							@endforeach
						</div>
					</div>
				</div>
				<br/>
				<button class="btn_search col-12" type="submit"><i class="fas fa-search"></i></button>
			</form>
			{{--  --}}
	<hr>
		</div>
		<!--------product----->
		<div class="col-lg-9 products-right">
				
			<div class="row justify-content-around">
				
				@foreach($db as $k => $i)	
				<div class="col-lg-1"></div>
				<div class="col-lg-3 col-sm-8 item__product">
					@if($i->kmMa!=null)
					<div class="sale_tag"><i class="fas fa-tags"></i> {{$i->kmTrigia}} %</div>
					@endif
					<div class="item_info">
												<a href="{{URL::to('proinfo/'.$i->spMa)}}">Xem sản phẩm</a>
					</div>
								<img class="item_price" src="{{URL::asset('public/images/products/'.$i->spHinh)}}" alt="">
										
								<div class="item-info-product">
									<label class="item_name"><a href="{{URL::to('proinfo/'.$i->spMa)}}">{{$i->spTen}}</a></label>
									<br/>
									@if($i->kmMa!=null)
										<span><s>{{number_format($i->spGia)}} VND</s></span><br>
										<span class="item_price"><i class="fas fa-tags"></i> {{number_format($i->spGia-($i->spGia*$i->kmTrigia/100))}} VND</span>
									@else
										<span class="item_price">{{number_format($i->spGia)}} VND</span>
									@endif
									<div class="row btn__action">
									<a class="btn__addCart" href="{{URL::to('save-cart/'.$i->spMa)}}"><i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng</a>
									@if(Session::has('khMa'))
										@if($i->khMa)
											<a class="btn__heart__checked " href="{{URL::to('addtowishlist/'.$i->spMa)}}"><i class="far fa-heart" style="margin-top:0.3rem ;"></i></a>
											@else
									<a class="btn__heart" href="{{URL::to('addtowishlist/'.$i->spMa)}}"><i class="far fa-heart" style="margin-top:0.3rem ;"></i></a>
										
											@endif
									@endif
								</div>
						</div>
				</div>
				@endforeach
		</div>
	</div>

		</div>
	</div>
</div>	




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
