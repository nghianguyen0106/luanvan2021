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
						<label for="mota">Mã: <input type="text" title="Mã phải là chữ hoặc số không chứa ký tự đặc biệt. Độ dài từ 4-12 ký tự." pattern="[A-Za-z\d]{3,12}" minlength="5" class="form-control" name="vcMa"><span style="color: red;">{{$errors->first('vcMa')}}</span></label>
					</div>
				 	<div class="mb-4 col-4">
						<label for="mota">Tên: <input type="text" minlength="5" class="form-control" name="vcTen"><span style="color: red;">{{$errors->first('vcTen')}}</span></label>
					</div>
					<div class="mb-4 col-4">
						<label for="mota">Số lượt: <input type="number" min=1 class="form-control" name="vcSoluot"><span style="color: red;">{{$errors->first('vcSoluot')}}</span></label>
					</div>
					
					<div class="mb-4 col-4">
						<label for="mota">Ngày bắt đầu
						<input type="date" class="form-control" min="1" name="vcNgaybd" ><span style="color: red;">{{$errors->first('vcNgaybd')}}</span></label>
					</div>
					<div class="mb-4 col-4">
						<label for="mota">Ngày kết thúc
						<input type="date" class="form-control" min="1" name="vcNgaykt" ><span style="color: red;">{{$errors->first('vcNgaykt')}}</span></label>
					</div>
					
					<div class="mb-4 col-4">
						<label for="mota">Loại giảm giá:<br>
						<span><input class="form-check-input" type="radio" checked name="vcLoaigiamgia" value="0"> Theo giá</span><br>
							<span><input class="form-check-input" type="radio" name="vcLoaigiamgia" value="1"> Theo % giá</span></span></label>
					</div>

					<div class="mb-3 col-4">
						<label for="mota">Mức giảm:
						<input type="number" class="form-control" style="width: 190px;" min="1"  name="vcMucgiam" ><span style="color: red;">{{$errors->first('vcMucgiam')}}</span></label>
					</div>
					<div class="mb-3 col-4">
						<label for="mota">Giá trị được giảm tối đa:
						<input type="number" class="form-control" min="1" name="vcGiatritoida" style="width: 190px;" ><span style="color: red;">{{$errors->first('vcGiatritoida')}}</span></label>
					</div>
					<div class="mb-4 col-4">
						<label for="mota">Loại voucher:<br>
							<span><input id="radioSanpham" onclick="radioSanphamfunc()" class="form-check-input" type="radio" checked name="vcLoai" value="0"> Cho sản phẩm</span><br>
							<span><input id="radioDonhang" onclick="radioDonhangfunc()" class="form-check-input" type="radio" name="vcLoai" value="1"> Cho đơn hàng</span>

						</label>
					</div>
					
					<div class="mb-4 col-4">
						<label for="mota">Tình trạng
							<span><label class="switch">
						  <input type="checkbox" id="cbx" name="vcTinhtrang" value="1" checked="" onclick="myfunc()">
						  <span class="slider round"></span>
						</label></span>&nbsp;<span class="btn btn-outline-info" id="textTinhtrang" style="color:green;">Hiện</span>
						</label>
					</div>
					<div class="mb-4 col-4">
					</div>
					<div class="mb-4 col-4" id="dk" style="display: none;">
						<label for="mota">Điều kiện áp dụng<br>
							<span><input id="rdotheogia" onclick="rdotheogiafunc()" class="form-check-input"  type="radio" checked="" name="vcDkapdung" value="0">Theo giá ( VND )</span><br>
							
							<span><input id="rdosp" onclick="rdospfunc()" class="form-check-input" type="radio" name="vcDkapdung" value="1"> Theo số lượng sản phẩm</span>
							<span><input class="form-control" type="number" name="vcGtcandat"></span><br>
						</label>
					</div>

					
					<div  class="mb-4 col-12" id="tableSp">
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
													<input type="radio" name="checkboxsp"  value="{{$v->spMa}}">
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

<script type="text/javascript">
	var cbx= document.getElementById("cbx");
	if(cbx.checked == true)
		{
			document.getElementById('textTinhtrang').style.color = 'green';
			document.getElementById('textTinhtrang').innerHTML="Hiện";
		}
		else
		{
			document.getElementById('textTinhtrang').style.color = 'red';
			document.getElementById('textTinhtrang').innerHTML="Ẩn";	
		}
	function myfunc()
	{
		if(cbx.checked == true)
		{
			document.getElementById('textTinhtrang').style.color = 'green';
			document.getElementById('textTinhtrang').innerHTML="Hiện";
		}
		else
		{
			document.getElementById('textTinhtrang').style.color = 'red';
			document.getElementById('textTinhtrang').innerHTML="Ẩn";	
		}

	}
	
	function radioSanphamfunc()
	{
		var a =document.getElementById("radioSanpham");
		if(a.checked==true)
		{
			document.getElementById("tableSp").style.display = 'block';
			document.getElementById("dk").style.display = 'none';
		}
	}

	function radioDonhangfunc()
	{
		var a =document.getElementById("radioDonhang");
		if(a.checked==true)
		{
			document.getElementById("dk").style.display = 'block';
			document.getElementById("tableSp").style.display = 'none';
		}
	}

	function rdotheogiafunc()
	{
		var a =document.getElementById("rdotheogia");
		if(a.checked==true)
		{
			document.getElementById("theogia").style.display = 'block';
			document.getElementById("theoslsp").style.display = 'none';
		}
	}

	function rdospfunc()
	{
		var a =document.getElementById("rdosp");
		if(a.checked==true)
		{
			document.getElementById("theoslsp").style.display = 'block';
			document.getElementById("theogia").style.display = 'none';
		}
	}
		
	
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
@endsection

