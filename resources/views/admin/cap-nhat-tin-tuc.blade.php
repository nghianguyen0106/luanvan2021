@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column" >

            <!-- Main Content -->
        <div id="content" class="container">
        	<br/>
        	@foreach($data as $value)
			<form class="row" action="{{URL::to('editTintuc/'.$value->ttMa)}}" method="POST" enctype="multipart/form-data">
				 {{ csrf_field()}}

				 	<div class="col-lg-2"></div>
				 	<div class="col-lg-7 info__left">
				 		<br/>
				<h5 class="text-dark text-center">THÔNG TIN</h5>
					<div class="form-group">
						<label>Tiêu đề</label><br>
							<input name="ttTieude" class="form-control" type="text" value="{{$value->ttTieude}}"/>
					</div>

					<div class="form-group">
						<label>Nội dung</label><br>
					<textarea name="ttNoidung" style="width: 100%;height: 300px;">
						{{$value->ttNoidung}}
					</textarea>
					</div>
						<label>Ảnh chủ đề</label><br>
					<div class="form-group text-center">
					   	<div id="box__img" class="box__imgTT">
					   		@if($value->ttHinh!=null)
								<img id="imgDefaultTT" src="{{URL::asset('public/images/tintuc/'.$value->ttHinh)}}" />
									<img id="imgtt" src="" alt="" />
								@else
								<span class="text">Chưa có ảnh</span>
						   		<img id="imgtt" src="" alt="" />
								@endif
					   	</div>
					   	<span id="btnCanceltt"><i class="fas fa-times" style="font-size: 20px;"></i></span>
					   	<div>
					    <input id="inputImg" name="ttHinh" type="file" class="form-control" />
					   
		 				<label for="exampleInputPassword1" class="form-label"></label>
					    <label id="btnImg" class="lb__ttHinh" onclick="defaultAction()"><i class="fas fa-file-upload" style="font-size: 20px;">&nbsp;Thêm ảnh</i></label>
						</div>
					</div>
					<br/>
					<button type="submit" class="btn btn-primary">Thực hiện</button>
					</div>
			</form>    
			@if($value->ttHinh!=null)
		<script src="{{url('public/style_admin/js/previewImgInputFile6.js')}}"></script>
		@else
		<script src="{{url('public/style_admin/js/previewImgInputFile5.js')}}"></script>
		@endif
		
			@endforeach                   
		</div>
	</div>



@if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Opss... ',
  text: '{{Session::get('err')}}',
 
})
</script> 
@endif
@endsection

