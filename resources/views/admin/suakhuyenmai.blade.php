@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column" >

            <!-- Main Content -->
        <div id="content" class="container">
        	<br/>
			<form action="{{URL::to('checkSuaKhuyenmai/'.$data->kmMa)}}" method="POST"  >
				 {{ csrf_field() }}
				 <legend>Sửa chương trình khuyến mãi</legend>
				 <div class="row">
				 	<div class="mb-3 col-6">
						<label for="mota">Mô tả chương trình khuyến mãi <textarea class="ckeditor form-control" id="kmMota" name="kmMota"  placeholder="Mô tả">{{$data->kmMota}}</textarea><span style="color: red;">{{$errors->first('kmMota')}}</span></label>
					</div>
					<div class="mb-3 col-6">
						<label for="mota">Trị giá khuyến mãi (%)
						<input type="number" class="form-control" min="1" max="100" name="kmTrigia" value="{{$data->kmTrigia}}" ><span style="color: red;">{{$errors->first('kmTrigia')}}</span></label>
					</div>
					<div class="mb-3 col-6">
						<label for="mota">Ngày bắt đầu
						<input type="date" class="form-control" min="1" name="kmNgaybd" value="{{date_format(date_create($data->kmNgaybd),"Y-m-d")}}" ><span style="color: red;">{{$errors->first('kmNgaybd')}}</span></label>
					</div>

					<div class="mb-3 col-6">
						<label for="mota">Ngày kết thúc
						<input type="date" class="form-control" value="{{date_format(date_create($data->kmNgaykt),"Y-m-d")}}" min="1" name="kmNgaykt" id="kmNgaykt" ><span style="color: red;">{{$errors->first('kmNgaykt')}}</span></label>
					</div>
					<div class="mb-3 col-6">
						<label for="mota">Loại khuyến mãi
						<select id="type" class="form-control" name="kmLoai" onchange="chonsanpham()" >
					
							<option value="0"  
							@if($data->kmLoai==0)
							selected 
							@endif >Sản phẩm</option>
							<option value="1" @if($data->kmLoai==1)
							selected
							@endif>Đơn hàng</option>
						</select>
						</label>
						<span style="color: red;">{{$errors->first('kmLoai')}}</span>
					</div>

					<div class="mb-3 col-6">
						<label>Số lượng khuyến mãi:</label>
						
						<label id="qtySp"  style="display: none;" for="mota">Số lượng sản phẩm được khuyến mãi ( đế trống là không giới hạn số lượng sản phẩm)</label>
						<label id="qtyHd"  style="display: none;" for="mota">Số lượng đơn hàng được khuyến mãi ( đế trống là không giới hạn số lượng đơn hàng)
							</label>
						<input type="number" min="1" class="form-control" min="1" name="kmSoluong" value="{{$data->kmSoluong}}" ></label>
					</div>
					 </div>
					 <div class="row">
					 	<div class="mb-3 col-6">
					  <button class="btn btn-secondary" type="button" onclick="back()">Trở về</button>
					</div>

					 	<div class="mb-3 col-6">
						  <button class="btn btn-primary" type="submit" name="btn_add">Thực hiện</button>
						</div>

					 
					 </div>
					

			 	
			</form>
                               
		</div>
	</div>
<script type="text/javascript" charset="utf-8">
	function chonsanpham()
	{
		var x=document.getElementById('type');
		var xValue = document.getElementById('type').value;

		var sp=document.getElementById('qtySp');
		var hd=document.getElementById('qtyHd');
		if(xValue==0)
		{
			sp.style.display='block';
			hd.style.display='none';
		}
		if(xValue==1)
		{
			sp.style.display='none';
			hd.style.display='block';
		}


	}



</script>


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

