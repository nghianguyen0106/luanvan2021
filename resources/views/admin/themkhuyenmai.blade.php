@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
        <div id="content">
        	<br/>
			<form action="{{URL::to('checkAddAdmin')}}" method="POST"  enctype="multipart/form-data">
				 {{ csrf_field() }}
				 <legend>Thêm thông tin nhân viên</legend>
			<div class="mb-3">
				<input type="text" class="form-input" name="">
			</div>
			 

			 	
			  <button class="btn btn-primary" type="submit" name="btn_add" class="btn btn-primary">Thực hiện</button>
			</form>
			<br/>
                                <button class="btn btn-secondary" type="button" onclick="back()">Trở về</button>
		</div>
	</div>

@endsection
