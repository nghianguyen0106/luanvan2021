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
			    <label for="exampleInputPassword1" class="form-label">Giá</label>
			    <input name="spGia" type="number" class="form-control" id="spGia">
			     <span style="color:red">{{$errors->first('spGia')}}</span>
			  </div>
			   <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Số lượng</label>
				    <input name="khoSoluong" type="number" class="form-control" id="khoSoluong">
				    <span style="color:red">{{$errors->first('khoSoluong')}}</span>
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
		                <select style="width: 205px" class="form-control m-bot15" name="loaiMa">
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
				
				<!--end field flex form-->
				<!--field flex form-->
				<br/>
				<h4>Mô tả chi tiết</h4>
			    <div class="flex__form">

				    <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Màn hình</label>
				    <input name="manhinh" type="text" class="form-control">
				    <span style="color:red">{{$errors->first('')}}</span>
				    </div>
				    <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Chuột</label>
				    <input name="chuot" type="text" class="form-control" >
				    <span style="color:red">{{$errors->first('')}}</span>
				    </div>
				     <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Bàn phím</label>
				    <input name="banphim" type="text" class="form-control" >
				    <span style="color:red">{{$errors->first('')}}</span>
				  	</div>
				    <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">RAM</label>
				    <input name="ram" type="text" class="form-control" >
				    <span style="color:red">{{$errors->first('ram')}}</span>
			 		</div>
				</div>
				
				<!--field flex form-->
				<div class="flex__form">
				    <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">PSU</label>
				    <input name="psu" type="text" class="form-control" >
				    <span style="color:red">{{$errors->first('psu')}}</span>
				    </div>
				    <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Mainboard</label>
				    <input name="mainboard" type="text" class="form-control" >
				    <span style="color:red">{{$errors->first('mainboard')}}</span>
				    </div>
				    <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">VGA</label>
				    <input name="vga" type="text" class="form-control" >
				    <span style="color:red">{{$errors->first('vga')}}</span>
				  	</div>
				    <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Ổ cứng</label>
				    <input name="ocung" type="text" class="form-control" >
				    <span style="color:red">{{$errors->first('ocung')}}</span>
				  	</div>
			    </div>
			   
				<!--field flex form-->
				<div class="flex__form">
				    <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Vỏ case</label>
				    <input name="vocase" type="text" class="form-control" >
				    <span style="color:red">{{$errors->first('')}}</span>
				  	</div>
				    <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Pin</label>
				    <input name="pin" type="text" class="form-control" >
				    <span style="color:red">{{$errors->first('')}}</span>
				  	</div>
				  	 <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Tản nhiệt</label>
				    <input name="tannhiet" type="text" class="form-control" >
				    <span style="color:red">{{$errors->first('tannhiet')}}</span>
				    </div>
				    <div class="mb-3">
				    <label for="exampleInputPassword1" class="form-label">Loa</label>
				    <input name="loa" type="text" class="form-control" >
				    <span style="color:red">{{$errors->first('')}}</span>
				    </div>
				</div>
				
				<!--end field flex form-->

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
		</div>
	</div>
@endsection
 