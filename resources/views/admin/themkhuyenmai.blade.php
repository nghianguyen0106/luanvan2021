@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
        <div id="content" class="container">
        	<br/>
			<form action="{{URL::to('checkAddKhuyenmai')}}" method="POST"  >
				 {{ csrf_field() }}
				 <legend>Thêm chương trình khuyến mãi</legend>
				 <div class="row">
				 	<div class="mb-3 col-6">
						<label for="mota">Mô tả chương trình khuyến mãi <textarea class="ckeditor form-control" id="kmMota" name="kmMota"  placeholder="Mô tả"></textarea><span style="color: red;">{{$errors->first('kmMota')}}</span></label>
					</div>
					<div class="mb-3 col-6">
						<label for="mota">Trị giá khuyến mãi (%)
						<input type="number" class="form-control" min="1" max="100" name="kmTrigia" ><span style="color: red;">{{$errors->first('kmTrigia')}}</span></label>
					</div>
					<div class="mb-3 col-6">
						<label for="mota">Ngày bắt đầu
						<input type="date" class="form-control" min="1" name="kmNgaybd" ><span style="color: red;">{{$errors->first('kmNgaybd')}}</span></label>
					</div>
					<div class="mb-3 col-6">
						<label for="mota">Ngày kết thúc
						<input type="date" class="form-control" min="1" name="kmNgaykt" ><span style="color: red;">{{$errors->first('kmNgaykt')}}</span></label>
					</div>
					<div class="mb-3 col-6">
						<label for="mota">Loại khuyến mãi
						<select id="type" class="form-control" name="lkmMa" onchange="chonsanpham()">
							<option value=""></option>
							@foreach($lkm as $v)
							<option value="{{$v->lkmMa}}" >{{$v->lkmTen}}</option>
							@endforeach
						</select>
						</label>
						<span style="color: red;">{{$errors->first('kmLoai')}}</span>
					</div>

					<div id="qtySp" class="mb-3 col-6">
						<label id for="mota">Số lượng được khuyến mãi ( đế trống là không giới hạn số lượng)
						<input type="number" min="1" class="form-control" min="1" name="kmSoluong" ></label>
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

