@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">
@foreach($adMaCu as $value)
            <!-- Main Content -->
         <div id="content">
         	<br/>
         	 <h2 class="text-info text-center">Cập nhật thông tin nhân viên</h2>
				 <hr/>
			<form class="row justify-content-around" action="{{URL::to('/editAdmin/'.$value->adMa)}}" method="POST"  enctype="multipart/form-data">
				 {{ csrf_field() }}
			<div class="col-lg-1"></div>
			<div class="col-lg-5 info__left">
				<br/>
				<h5 class="text-dark">THÔNG TIN</h5>
				 <input name="adMa" hidden type="text" value="{{$value->adMa}}" class="form-control" id="adTen">
				<div class="form-group">
				 
				    <label for="exampleInputPassword1" class="form-label">Tên nhân viên</label>
				    <input id="ip__name" name="adTen" onBlur="onName()" type="text" value="{{$value->adTen}}" class="form-control">
				    <span style="color:red">{{$errors->first('adTen')}}</span>
				    <span id="name__err--update"></span>
				  

				 
				    <label for="exampleInputPassword1" class="form-label">Tài khoản cho nhân viên</label>
				    <input id="ip__acc" name="adTaikhoan" onBlur="onAcc()" type="text" value="{{$value->adTaikhoan}}"  class="form-control" >
				     <span style="color:red">{{$errors->first('adTaikhoan')}}</span>
				      <span style="color:red">
				     	@if(Session::has('ad_err')!=null)
				     		{{Session::get('ad_err')}}
				     	@endif
				     </span>
					<span id="acc__err--update"></span>
				  
				</div>


				<div class="form-group">
				  
				    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
				    <input id="ip__pass" name="adMatkhau" onBlur="onPass()" type="password" value="{{$value->adMatkhau}}"  class="form-control" >
				    <span style="color:red">{{$errors->first('adMatkhau')}}</span>
				    <span id="pass__err--update"></span>
				  
				    <br/>
				   
				    <label for="exampleInputPassword1" class="form-label">Số điện thoại</label>
				    <input id="ip__sdt" name="adSdt" onBlur="onSdt()" type="number" value="{{$value->adSdt}}"  class="form-control" >
				     <span style="color:red">{{$errors->first('adSdt')}}</span>
				     <span id="sdt__err--update"></span>
				
				  </div>
				   <div class="form-group">
				  
				    <label for="exampleInputPassword1" class="form-label">Email</label>
				    <input name="adEmail" type="email" class="form-control" value="{{$value->adEmail}}"  id="adEmail">
				     <span style="color:red">{{$errors->first('adEmail')}}</span>
				 <br/>
			  <label for="exampleInputPassword1" class="form-label">Số cmnd</label>
			    <input name="cmnd" type="number" class="form-control" value="{{$value->adHinhcmnd}}" >

			     <br/>
			  <label for="exampleInputPassword1" class="form-label">Dịa chỉ</label>
			    <input name="adDiachi" type="text" class="form-control" value="{{$value->adDiachi}}" >

				     <br/>


				    <label for="exampleInputPassword1" class="form-label">Quyền</label>
				    <input id="ip__quyen" name="adQuyen" onBlur="onQuyen()" type="number" value="{{$value->adQuyen}}"  class="form-control">
				     <span style="color:red">{{$errors->first('adQuyen')}}</span>
				     <span id="quyen__err--update"></span>
			  
					</div>
				
				 	<br/>
			  	<div class="row justify-content-around">
			  <button class="btn btn-dark" type="button" onclick="back()">Trở về</button>
			
			  <button id="btn__register" type="submit" name="btn_add" class="btn btn-primary">Thực hiện</button>
			</div>
			</div>

			<div class="col-lg-4 info__right">
				<br/>
				<h5>ẢNH</h5>
				<br/>
				<div class="row justify-content-around">
					<div class="col-lg-8">
				   	<div id="box__img" class="box__img">
				   		@if($value->adHinh!=null)
						<img id="imgDefault" src="{{URL::asset('public/images/nhanvien/'.$value->adHinh)}}" />
						<img id="img" src="" alt="" />
						@else
						<span class="text">Chưa có ảnh</span>
				   		<img id="img" src="" alt="" />
						@endif
				   	
				   	</div>
				   	<span id="btnCancel"><i class="fas fa-times" style="font-size: 20px;"></i></span>
				   	<div>
				    <input id="inputImg" name="adHinh" type="file" class="form-control">
				   
	 				<label for="exampleInputPassword1" class="form-label"></label>
				    <label id="btnImg" class="lb__adHinh" onclick="defaultAction()"><i class="fas fa-file-upload" style="font-size: 20px;">&nbsp;Đổi ảnh nhân viên</i></label>
				    
					</div>
				  </div>
				</div>
			</div>
			<div class="col-lg-1"></div>
		</div>
			</form>
			<br/>
                                
		</div>
		@if($value->adHinh!=null)
		<script src="{{url('public/style_admin/js/previewImgInputFile2.js')}}"></script>
		@else
		<script src="{{url('public/style_admin/js/previewImgInputFile1.js')}}"></script>
		@endif
		
			@endforeach
	</div>
		
		<script src="{{url('public/fe/js/js-validate/validate-nv.js')}}"></script>
@endsection