@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column justify-content-center">
						<div class="card-header py-3">
                            <h3 class="m-0 font-weight-bold text-primary">Thêm sản phẩm</h3>
                        </div>
                        <br/>
            <!-- Main Content -->
        <div id="content" class="col-3">
			<form action="{{URL::to('/checkAddSanpham')}}" method="POST" enctype="multipart/form-data">
				 {{ csrf_field() }}
				
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
			    <label for="exampleInputPassword1" class="form-label">Tình trạng</label>
			    <input name="spTinhtrang" type="number" class="form-control" id="spTinhtrang">
			     <span style="color:red">{{$errors->first('spTinhtrang')}}</span>
			  </div>
			   <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Hạn bảo hành</label>
			    <input name="spHanbh" type="number" class="form-control" id="spHanbh">
			     <span style="color:red">{{$errors->first('spHanbh')}}</span>
			  </div>
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
			    <input name="ram" type="number" class="form-control" >
			    <span style="color:red">{{$errors->first('ram')}}</span>
			  </div>
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
			  Khuyến mãi
			  <select class="form-control m-bot15" name="kmMa">
                            @foreach($kmMa as $key => $value)
                                <option value="{{$kmMa[$key]->kmMa}}" >{{$kmMa[$key]->kmTrigia}}</option>
                            @endforeach
               </select>
               <br/>
			  Thương hiệu
			  <select class="form-control m-bot15" name="thMa">
                            @foreach($thMa as $key => $value)
                                <option value="{{$thMa[$key]->thMa}}" >{{$thMa[$key]->thTen}}</option>
                            @endforeach
               </select>
               <br/>
               Loại
                <select class="form-control m-bot15" name="loaiMa">
                            @foreach($loaiMa as $key => $value)
                                <option value="{{$loaiMa[$key]->loaiMa}}" >{{$loaiMa[$key]->loaiTen}}</option>
                            @endforeach
               </select>
               <br/>
               Nhu cầu sử dụng
                <select class="form-control m-bot15" name="ncMa">
                            @foreach($ncMa as $key => $value)
                                <option value="{{$ncMa[$key]->ncMa}}" >{{$ncMa[$key]->ncTen}}</option>
                            @endforeach
               </select>
				<br/>
				  <div class="mb-3">
			    <label for="exampleInputPassword1" class="form-label">Hình ảnh sản phẩm</label>
			    <input name="img" type="file" class="form-control"  accept="image/x-png,image/gif,image/jpeg,image/png,image/jpg">
			    <span style="color:red">{{Session::get('img_error')}}</span>
			  </div>
				<br/>
			  <button type="submit" name="btn_khd" class="btn btn-primary">Thực hiện</button>
			</form>
		</div>
	</div>
@endsection
 