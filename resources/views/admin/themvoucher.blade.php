@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
        <div id="content" class="container">
        	<br/>
			<form action="{{URL::to('checkAddVoucher')}}" method="POST"  >
				 {{ csrf_field() }}
				 <legend>Thêm voucher</legend>
				 <div class="row">
				 	<div class="mb-4 col-4">
						<label for="mota">Mã: <input type="text" minlength="5" class="form-control" name="vcMa"><span style="color: red;">{{$errors->first('kmTen')}}</span></label>
					</div>
				 	<div class="mb-4 col-4">
						<label for="mota">Tên: <input type="text" minlength="5" class="form-control" name="vcTen"><span style="color: red;">{{$errors->first('kmTen')}}</span></label>
					</div>
					<div class="mb-4 col-4">
						<label for="mota">Số lượt: <input type="text" minlength="5" class="form-control" name="vcSoluot"><span style="color: red;">{{$errors->first('kmTen')}}</span></label>
					</div>
					<div class="mb-4 col-4">
						<label for="mota">Loại voucher
						<input type="number" class="form-control" min="1" style="width: 190px;"  max="100" name="vcLoai" ><span style="color: red;">{{$errors->first('kmTrigia')}}</span></label>
					</div>
					<div class="mb-4 col-4">
						<label for="mota">Ngày bắt đầu
						<input type="date" class="form-control" min="1" name="vcNgaybd" ><span style="color: red;">{{$errors->first('kmNgaybd')}}</span></label>
					</div>
					<div class="mb-4 col-4">
						<label for="mota">Ngày kết thúc
						<input type="date" class="form-control" min="1" name="vcNgaykt" ><span style="color: red;">{{$errors->first('kmNgaykt')}}</span></label>
					</div>
					
					<div class="mb-4 col-4">
						<label for="mota">Loại giảm giá
						<input type="number" class="form-control" min="1000" style="width: 190px;"  name="vcLoaigiamgia" ><span style="color: red;">{{$errors->first('kmTrigia')}}</span></label>
					</div>

					<div class="mb-3 col-4">
						<label for="mota">Mức giảm
						<input type="number" class="form-control" style="width: 190px;"  name="vcMucgiam" ><span style="color: red;"></span></label>
					</div>
					<div class="mb-3 col-4">
						<label for="mota">Giá trị tối đa
						<input type="number" class="form-control" min="1" name="vcGiatritoida" style="width: 190px;" ></label>
					</div>
					<div class="mb-4 col-4">
						<label for="mota">Tình trạng
							<span><label class="switch">
						  <input type="checkbox" name="vcTinhtrang" value="1" checked>
						  <span class="slider round"></span>
						</label></span>
			</label>
					</div>
					
					<div  class="mb-3 col-12">
						<div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                	<legend>Chọn sản phẩm được áp dụng voucher: </legend>
                                    <thead>
                                        <tr>
                                        		<th></th>
                                            <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Loại sản phẩm</th>
                                            <th>Nhà cung cấp</th>
                                    
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($sanpham as $v)
                                        <tr>
                                        	<td>
                                        		<div >
													<input type="checkbox" name="checkboxsp[]"  value="{{$v->spMa}}">
												</div>
											</td>
                                          <td>{{$v->spMa}}</td>
                                          <td>
                                          	<a href="{{URL::to('updateSanpham/'.$v->spMa)}}" class="active tooltips" ui-toggle-class="">
                                               {{$v->spTen}}
                                               @if($v->kmMa!=null)
                                               	({{$v->kmTen}})
                                               @endif
												<span class="tooltiptexts">
													<img style="height:100px;width: 200px;" src="{{URL::asset('public/images/products/'.$v->spHinh)}}" alt="" class="pro-image-front">
												</span>
												
                                                </a>
                                            </td>
                                                <td>{{$v->loaiTen}}</td>
                                          <td>
                                          	 <div class="tooltips">
                                          	 	<a style="text-decoration: none;" href="{{URL::to('suaNhacungcappage/'.$v->nccMa)}}">{{$v->nccTen}}
                                          	 	</a>
												<span class="tooltiptexts">
													D/c: {{$v->nccDiachi}}<br>
													Sdt: {{$v->nccSdt}}
												</span>
											</div>
                                          </td>
                                        </tr>
                                    @endforeach
                                       
                                    </tbody>
                                </table>
                                <span style="color: red">{{$errors->first('checkboxsp')}}</span>

                            </div>
					</div>
					 	<div class="mb-3 col-6">
						  <button class="btn btn-primary" type="submit" name="btn_add">Thực hiện</button>
						</div>
					 </div>
			</form>
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

