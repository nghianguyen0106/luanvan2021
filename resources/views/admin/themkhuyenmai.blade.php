@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
        <div id="content" class="container">
        	<br/>
			<form action="{{URL::to('checkAddAdmin')}}" method="POST"  enctype="multipart/form-data">
				 {{ csrf_field() }}
				 <legend>Thêm chương trình khuyến mãi</legend>
				 <div class="row">
				 	<div class="mb-3 col-6">
						<label for="mota">Mô tả chương trình khuyến mãi <textarea class="form-control" id="kmMota" name="mota"  placeholder="Mô tả"></textarea></label>
					</div>
					<div class="mb-3 col-6">
						<label for="mota">Trị giá khuyến mãi (%)
						<input type="number" class="form-control" min="1" name="kmTrigia" ></label>
					</div>
					<div class="mb-3 col-6">
						<label for="mota">Ngày bắt đầu
						<input type="date" class="form-control" min="1" name="kmNgaybt" ></label>
					</div>
					<div class="mb-3 col-6">
						<label for="mota">Ngày kết thúc
						<input type="date" class="form-control" min="1" name="kmNgaykt" ></label>
					</div>
					<div class="mb-3 col-6">
						<label for="mota">Loại khuyến mãi
						<select name="kmLoai">
							<option value="0" onclick="chonsanpham()">Sản phẩm</option>
							<option value="1">Hóa đơn</option>
						</select>
						</label>
					</div>
					<div class="mb-3 col-6">
						<label for="mota">Số lượng sản phẩm được khuyến mãi
						<input type="number" min="1" class="form-control" min="1" name="trigia" ></label>
					</div>
				 </div>
			
			 

			 	
			  <button class="btn btn-primary" type="submit" name="btn_add" class="btn btn-primary">Thực hiện</button>
			</form>
			<br/>
                                <button class="btn btn-secondary" type="button" onclick="back()">Trở về</button>
		</div>
	</div>

@endsection
