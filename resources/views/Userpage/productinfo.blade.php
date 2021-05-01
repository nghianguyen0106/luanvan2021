@extends('Userpage.layout')
@section('title')
Thông tin sản phẩm
@endsection
@section('content')
<div class="single">
	<div class="container">
		<div class="col-md-6 single-right-left animated wow slideInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
			<div class="grid images_3_of_2">
				<div class="flexslider">
					<!-- FlexSlider -->
						<script>
						// Can also be used with $(document).ready()
							$(window).load(function() {
								$('.flexslider').flexslider({
								animation: "slide",
								controlNav: "thumbnails"
								});
							});
						</script>
					<!-- //FlexSlider-->
					<ul class="slides">
						@foreach($imgs as $v)
						<li style="list-style-type: none;" data-thumb="{{URL::asset('public/images/products/'.$v->spHinh)}}">
							<div class="thumb-image"> <img src="{{URL::asset('public/images/products/'.$v->spHinh)}}" data-imagezoom="true" class="img-responsive"> </div>
						</li>
						@endforeach
					</ul>
					<div class="clearfix"></div>
				</div>	
			</div>
		</div>
		<div class="col-md-6 single-right-left simpleCart_shelfItem animated wow slideInRight animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInRight;">
@foreach($proinfo as $v)
			<form action="{{URL::to('save-cart2/'.$v->spMa)}}" method="post" accept-charset="utf-8">
				{{ csrf_field() }}
			
					<h3>{{$v->spTen}}</h3>
					<p><span style="color: red;" class="item_price">{{number_format($v->spGia)}} VND</span> </p>
					<p>Thương hiệu:<span> {{$v->thTen}}</span></p>
					<p>Tình trạng:<span> 
						<?php $x= 0;?>
						@if($v->khoSoluong>0)
							Còn hàng. &nbsp;<br>
							Số lượng: {{$x=$v->khoSoluong}} sản phẩm.

						@else
							Hết hàng
						@endif
					</span></p>
					<p>Chọn số lượng: <span>
						<div class="counter">
						  <button  class="btn btn-outline-danger" type="button" onClick='decreaseCount(event, this)'>-</button>
						  <input style="width:50px " class="form-control-success" min="1" max="{{$v->khoSoluong}}" type="number" id="qty" name="quanty" value="1">
						  <button class="btn btn-outline-success"  type="button"  onClick='increaseCount(event, this)'>+</button>
						</div>
					</span></p>
					<div class="occasion-cart">
						<button class="btn btn-warning" type="submit">Thêm vào giỏ hàng </button>
					</div>
			@endforeach

			</form>
			
		</div>
				<div class="clearfix"> </div>

				<div class="bootstrap-tab animated wow slideInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
					<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">


		<ul class="nav nav-tabs">
		    <li class="nav-item">
		      <a class="nav-link active" data-toggle="tab" href="#home">Thông tin chi tiết</a>
		    </li>
		    <li class="nav-item">
		      <a class="nav-link" data-toggle="tab" href="#menu1">Đánh giá</a>
		    </li>
		  </ul>

  				<!-- Tab panes -->
			  <div class="tab-content">
    			<div id="home" class="container tab-pane active"><br>
					
					<ul class=" list-group-item-light">
					@foreach($details as $i)
	
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
					@endforeach
					</ul>    
				</div>

			    <div id="menu1" class="container tab-pane "><br>
			   		
			   		<div class="row">
			   			@if(count($comment)>0)
			   			@foreach($comment as $i)
			   				@if($i->khTaikhoan == Session::get('khTaikhoan'))
			   			<div class="list-group-item-primary mb-3 p-4 row">
			   				<div class="col-11">
			   				<div class=" list-group-item username"><strong><i class="far fa-user"></i> &nbsp;{{$i->khTen}}</strong> <span class="date">{{$i->dgNgay}}</span></div>
			   				<div class=" list-group-item usercomment">{{$i->dgNoidung}}</div>
			   					
			   				</div>
			   				<div class="col-1"><a class="btn btn-outline-danger" href="{{URL::to('deletecomment/'.$i->dgMa)}}">X</a></div>

			   				<hr>
			   			</div>
			   			@else
			   			<div class="list-group-item mb-3">
			   				<div class=" list-group-item username"><strong><i class="far fa-user"></i> &nbsp;{{$i->khTen}}</strong>  <span class="date">{{$i->dgNgay}}</span></div>
			   				<div class=" list-group-item usercomment">{{$i->dgNoidung}}</div>
			   				<hr>
			   			</div>
			   			@endif
			   			@endforeach
			   			@else
			   			<div class="col-12"> <p class="bg-info">Chưa có đánh giá nào về sản phẩm này.</p></div>
			   			@endif
			   			
			   		{{-- add comment --}}
			   		{{-- @dd($checkordered) --}}
			   			@if($checkordered!=null)
			   			<form action="{{URL::to('addcomment/'.$id)}}" method="post" accept-charset="utf-8">
			   				{{ csrf_field() }}
			   				<div class="form-floating mb-3">
							  <input type="textarea" style="height: 100px;" class="form-control" id="comment" name="content" >
							  <label for="comment">Đánh giá/Bình luận của bạn</label>
							  @foreach($errors->all() as $i)
			   			<p class="alert-danger">{{$i}}</p>
			   			@endforeach
							  <input type="submit" class="btn btn-outline-success my-1" name="btnSubmit" value="Gửi bình luận">
							</div>
			   			</form>
			   			@endif
			   			{{--  --}}
			   		</div>
			    </div>
			    
			  </div>
			</div>
			</div>


		<div class=" row single-pro">
			<div class="css-treeview">
				<h4>SẢN PHẨM ĐỀ XUẤT</h4>
			
			</div>
				@foreach($related_prod as $i)
				<div class="col-md-3 product-men p-4" style="height: 350px">
					<div class="men-pro-item simpleCart_shelfItem">
						<div class="men-thumb-item">
								
								<img style="height: 200px" src="{{URL::asset('public/images/products/'.$i->spHinh)}}" alt="" class="pro-image-front">
								<img style="height: 200px"  src="{{URL::asset('public/images/products/'.$i->spHinh)}}" alt="" class="pro-image-back">							
							

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
									<a href="#" class="item_add single-item hvr-outline-out button2">Thêm vào giỏ hàng</a>									
						</div>
					</div>
				</div>
				@endforeach
						<div class="col-4"></div>
			<div class="clearfix"></div>
		</div>
							
							
						</div>
					</div>
				</div>
	</div>
</div>
<!-- //single -->

@if(Session::has('comment'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Thông báo: ',
  text: '{{Session::get('comment')}}',
 
})
</script> 
@endif
<script>
  function increaseCount(a, b) {
  var input = document.getElementById('qty');
  var value = parseInt(input.value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  input.value = value;
}

function decreaseCount(a, b) {
  var input = document.getElementById('qty');
  var value = parseInt(input.value, 10);
  if (value > 1) {
    value = isNaN(value) ? 0 : value;
    value--;
    input.value = value;
  }
}
</script>
@endsection
