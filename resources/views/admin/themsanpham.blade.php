@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column justify-content-center">
						<div class="card-header py-3">
                            <h2 class="m-0 font-weight-bold text-primary">Thêm sản phẩm</h2>
                        </div>
                        <br/>
            <!-- Main Content -->
        <div id="content" class="col-12">
			<form action="{{URL::to('/checkAddSanpham')}}" method="POST" enctype="multipart/form-data">
				 {{ csrf_field() }}
				<!--field flex form-->
				<h4>Tổng quan</h4>
			<div class="flex__form">
			  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Tên sản phẩm </label>
			    <input name="spTen" type="text" class="form-control" id="spTen">
			    <span style="color:red">{{$errors->first('spTen')}}</span>
			    <span style="color:red">
			    	@if(Session::has('sp_err'))
			    	{{Session::get('sp_err')}}
			    	@endif
			    </span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Số lượng</label>
			    <input name="khoSoluong" type="number" class="form-control" id="soluong">
			     <span style="color:red">{{$errors->first('khoSoluong')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Giá</label>
			    <input name="spGia" type="number" class="form-control" id="spGia">
			     <span style="color:red">{{$errors->first('spGia')}}</span>
			  </div>
			  
				 <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Hạn bảo hành</label>
				    <input name="spHanbh" type="number" class="form-control" id="spHanbh">
				    <span style="color:red">{{$errors->first('spHanbh')}}</span>
				 </div>
			</div>
				<!--field flex form-->
				<div class="flex__form">
					 <div class="mb-3">
					 <label for="exampleInputPassword1" class="form-label">Khuyến mãi</label>
					  <select style="width: 205px" class="form-control m-bot15" name="kmMa">
		                            @foreach($kmMa as $key => $value)
		                                <option value="{{$kmMa[$key]->kmMa}}" >{{$kmMa[$key]->kmTrigia}}</option>
		                            @endforeach
		               </select>
		              
		           </div>

		              <div class="mb-3">
					 <label for="exampleInputPassword1" class="form-label">Thương hiệu</label>
					  <select style="width: 205px" class="form-control m-bot15" name="thMa">
		                            @foreach($thMa as $key => $value)
		                                <option value="{{$thMa[$key]->thMa}}" >{{$thMa[$key]->thTen}}</option>
		                            @endforeach
		               </select>
		           	</div>
		               
		                <div class="mb-3">
					 <label for="exampleInputPassword1" class="form-label">Loại</label>
		                <select onchange="change()" id="select__loai" style="width: 205px" class="form-control m-bot15" name="loaiMa">
		                            @foreach($loaiMa as $key => $value)
		                                <option value="{{$loaiMa[$key]->loaiMa}}" >{{$loaiMa[$key]->loaiTen}}</option>
		                            @endforeach
		               </select>

		               </div>
		                <div class="mb-3">
					 <label for="exampleInputPassword1" class="form-label">Nhu cầu sử dụng</label>
		                <select style="width: 205px" class="form-control m-bot15" name="ncMa">
		                            @foreach($ncMa as $key => $value)
		                                <option value="{{$ncMa[$key]->ncMa}}" >{{$ncMa[$key]->ncTen}}</option>
		                            @endforeach
		               </select>
		           </div>
           		</div>
           		<!--end field flex form-->
				
				
				<!--field flex form-->
				<br/>
				<h4>Mô tả chi tiết</h4>
			    <div class="flex__form">
				    <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Ram</label>
				    <input name="ram" type="text" class="form-control">
				    <span style="color:red">{{$errors->first('')}}</span>
				    </div>
				    <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">CPU</label>
				    <input name="cpu" type="text" class="form-control" >
				    <span style="color:red">{{$errors->first('')}}</span>
				    </div>
				     <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Ổ cứng</label>
				    <input name="ocung" type="text" class="form-control" >
				    <span style="color:red">{{$errors->first('')}}</span>
				  	</div> 
				</div>
				
				<!--mota__lap-->
				<div id="mota__lap">
					<div class="flex__form">
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Màn hình</label>
					    <input name="manhinh" type="text" class="form-control">
					    <span style="color:red">{{$errors->first('')}}</span>
					    </div>
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Cổng giao tiếp</label>
					    <input name="conggiaotiep" type="text" class="form-control" >
					    <span style="color:red">{{$errors->first('')}}</span>
					    </div>
					     <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Trọng lượng</label>
					    <input name="trongluong" type="text" class="form-control" >
					    <span style="color:red">{{$errors->first('')}}</span>
					  	</div> 
					</div>
				<!---->
					<div class="flex__form">
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Màu</label>
					    <input name="mau" type="text" class="form-control">
					    <span style="color:red">{{$errors->first('')}}</span>
					    </div>
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Loa</label>
					    <input name="loa" type="text" class="form-control" >
					    <span style="color:red">{{$errors->first('')}}</span>
					    </div>
					     <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Webcam</label>
					    <input name="webcam" type="text" class="form-control" >
					    <span style="color:red">{{$errors->first('')}}</span>
					  	</div> 
					  	<div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Tản nhiệt</label>
					    <input name="tannhiet" type="text" class="form-control" >
					    <span style="color:red">{{$errors->first('')}}</span>
					  	</div> 
					</div>
				
				<!---->
					<div class="flex__form">
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">PIN</label>
					    <input name="pin" type="text" class="form-control">
					    <span style="color:red">{{$errors->first('')}}</span>
					    </div>
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Chuẩn wifi</label>
					    <input name="chuanwifi" type="text" class="form-control" >
					    <span style="color:red">{{$errors->first('')}}</span>
					    </div>
					  	 <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Chuẩn Lan</label>
					    <input name="chuanlan" type="text" class="form-control" >
					    <span style="color:red">{{$errors->first('')}}</span>
					  	</div> 
					  	<div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Hệ điều hành</label>
					    <input name="hedieuhanh" type="text" class="form-control" >
					    <span style="color:red">{{$errors->first('')}}</span>
					  	</div> 
					</div>
				</div>
			   
				<!--end mota__lap-->
				<!--mota__pc-->
				<div id="mota__pc">
					<div class="flex__form">
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">Mainboard</label>
					    <input name="mainboard" type="text" class="form-control">
					    <span style="color:red">{{$errors->first('')}}</span>
					    </div>
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">VGA</label>
					    <input name="vga" type="text" class="form-control" >
					    <span style="color:red">{{$errors->first('')}}</span>
					    </div>
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">PSU</label>
					    <input name="psu" type="text" class="form-control">
					    <span style="color:red">{{$errors->first('')}}</span>
					    </div>
					    <div class="mb-3">
					    <label for="exampleInputPassword1" class="form-label">CASE</label>
					    <input name="case" type="text" class="form-control" >
					    <span style="color:red">{{$errors->first('')}}</span>
					    </div>
					
				</div>
				</div>
				
				<!--end mota__pc-->

				<br/>
				<label style="font-size: 24px" for="exampleInputPassword1" class="form-label">Hình ảnh sản phẩm</label>
				<div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Ảnh 1 (Bắt buộc phải có)</label>
				    <input name="img" type="file" class="form-control"  accept="image/x-png,image/gif,image/jpeg,image/png,image/jpg">
			  	</div>

			  	<div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Ảnh 2 (Có thể trống)</label>
				    <input name="img2" type="file" class="form-control"  accept="image/x-png,image/gif,image/jpeg,image/png,image/jpg">
			  	</div>
			  	<div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Ảnh 3 (Có thể trống)</label>
				    <input name="img3" type="file" class="form-control"  accept="image/x-png,image/gif,image/jpeg,image/png,image/jpg">
			  	</div>
			  	<div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Ảnh 4 (Có thể trống)</label>
				    <input name="img4" type="file" class="form-control"  accept="image/x-png,image/gif,image/jpeg,image/png,image/jpg">
			    	
			  	</div>
				<br/>
			  <div class="flex__form"><button type="submit" name="btn_khd" class="btn btn-primary">Thực hiện</button></div>
			</form>
			<br/>
                                <button class="btn btn-info" type="button" onclick="back()">Trở về</button>
			<br/>
		</div>
	</div>
@endsection
 