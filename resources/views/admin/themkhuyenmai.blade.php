@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
        <div id="content" class="container">
        	<br/>
			<form action="{{URL::to('checkAddKhuyenmai')}}" method="POST"  >
				 {{ csrf_field() }}
				 <legend>Thêm chương trình</legend>
				 <div class="row">
				 	<div class="mb-4 col-4">
						<label for="mota">Tên chương trình: <input type="text" minlength="5" class="form-control" name="kmTen"><span style="color: red;">{{$errors->first('kmTen')}}</span></label>
					</div>
				 	<div class="mb-4 col-4">
						<label for="mota">Mô tả : <textarea class="form-control" id="kmMota" name="kmMota"  placeholder="Mô tả"></textarea><span style="color: red;">{{$errors->first('kmMota')}}</span></label>
					</div>
					<div class="mb-4 col-4">
						<label for="mota">Trị giá khuyến mãi (%)
						<input type="number" class="form-control" min="1" style="width: 190px;"  max="100" name="kmTrigia" ><span style="color: red;">{{$errors->first('kmTrigia')}}</span></label>
					</div>
					<div class="mb-4 col-4">
						<label for="mota">Ngày bắt đầu
						<input type="date" class="form-control" min="1" name="kmNgaybd" ><span style="color: red;">{{$errors->first('kmNgaybd')}}</span></label>
					</div>
					<div class="mb-4 col-4">
						<label for="mota">Ngày kết thúc
						<input type="date" class="form-control" min="1" name="kmNgaykt" ><span style="color: red;">{{$errors->first('kmNgaykt')}}</span></label>
					</div>
					
					<div class="mb-4 col-4">
						<label for="mota">Giá trị khuyến mãi tối đa (VND)
						<input type="number" class="form-control" min="1000" style="width: 190px;"  name="kmGiatritoida" ><span style="color: red;">{{$errors->first('kmTrigia')}}</span></label>
					</div>

					<div class="mb-3 col-4">
						<label for="mota">Giới hạn số lần khuyến mãi
						<input type="number" class="form-control" style="width: 190px;"  name="kmGioihanmoikh" ><span style="color: red;"></span></label>
					</div>
					<div class="mb-3 col-4">
						<label for="mota">Số lượng sản phẩm được khuyến mãi 
						<input type="number" class="form-control" min="1" name="kmSoluong" style="width: 190px;" ></label>
					</div>
					<div class="mb-4 col-4">
						<label for="mota">Tình trạng
							<span><label class="switch">
						  <input type="checkbox" name="kmTinhtrang" value="1" checked>
						  <span class="slider round"></span>
						</label></span>
			</label>
					</div>
					
					<div  class="mb-3 col-12">
						<div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                	<legend>Chọn sản phẩm được khuyến mãi: </legend>
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

