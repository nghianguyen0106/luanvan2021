@extends('Userpage.layout')
@section('title')

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
						<li data-thumb="{{URL::asset('public/images/products/'.$v->spHinh)}}">
							<div class="thumb-image"> <img src="{{URL::asset('public/images/products/'.$v->spHinh)}}" data-imagezoom="true" class="img-responsive"> </div>
						</li>
						@endforeach
					</ul>
					<div class="clearfix"></div>
				</div>	
			</div>
		</div>
		<div class="col-md-6 single-right-left simpleCart_shelfItem animated wow slideInRight animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInRight;">

			<form action="" method="post" accept-charset="utf-8">
				{{ csrf_field() }}
			@foreach($proinfo as $v)
					<h3>{{$v->spTen}}</h3>
					<p><span style="color: red;" class="item_price">{{number_format($v->spGia)}} VND</span> </p>
					<p>Thương hiệu:<span> {{$v->thTen}}</span></p>
					<p>Tình trạng:<span> 
						@if($v->spTinhtrang>0)
							Còn hàng
						@else
							Hết hàng
						@endif
					</span></p>
					<p> Số lượng: <span>
						<select name="quanty"  class="form-select" aria-label="Default select example">
							@for($i=1;$i<11;$i++)
							
							<option value="{{$i}}">{{$i}}</option>}
							
							@endfor

						</select>
					</span></p>
					<div class="occasion-cart">
						<a href="{{URL::to('savecart/'.$v->spMa)}}" class="item_add hvr-outline-out button2">Thêm vào giỏ hàng</a>
					</div>
			@endforeach

			</form>
			
		</div>
				<div class="clearfix"> </div>

				<div class="bootstrap-tab animated wow slideInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
					<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
						<ul id="myTab" class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Thông tin chi tiết sản phẩm</a></li>
							<li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Đánh giá</a></li>
							{{-- <li role="presentation" class="dropdown">
								<a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents">Information <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
									<li><a href="#dropdown1" tabindex="-1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">cleanse</a></li>
									<li><a href="#dropdown2" tabindex="-1" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2">fanny</a></li>
								</ul>
							</li> --}}
						</ul>
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active bootstrap-tab-text" id="home" aria-labelledby="home-tab">
								{{-- <h5>Product Brief Description</h5> --}}
								
					@foreach($details as $i)
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
					@endforeach
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
							<div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="profile" aria-labelledby="profile-tab">
								<div class="bootstrap-tab-text-grids">
									<div class="bootstrap-tab-text-grid">
										<div class="bootstrap-tab-text-grid-left">
											<img src="images/men3.jpg" alt=" " class="img-responsive">
										</div>
										<div class="bootstrap-tab-text-grid-right">
											<ul>
												<li><a href="#">Admin</a></li>
												<li><a href="#"><span class="glyphicon glyphicon-share" aria-hidden="true"></span>Reply</a></li>
											</ul>
											<p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis 
												suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem 
												vel eum iure reprehenderit.</p>
										</div>
										<div class="clearfix"> </div>
									</div>
									
									<div class="add-review">
										<h4>add a review</h4>
										<form>
											<input type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
											<input type="email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
											
											<textarea type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required="">Message...</textarea>
											<input type="submit" value="SEND">
										</form>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="dropdown1" aria-labelledby="dropdown1-tab">
								<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
							</div>
							<div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="dropdown2" aria-labelledby="dropdown2-tab">
								<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
							</div>
						</div>
					</div>
				</div>
	</div>
</div>
<!-- //single -->
@endsection