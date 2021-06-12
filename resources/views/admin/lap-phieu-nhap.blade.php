@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" >

            <!-- Main Content -->
        <div id="content" class="container-fluid">
        	<br/>
        	 <div class="row">
			<form class="col-lg-12" action="{{URL::to('addPhieuNhap')}}" method="POST"  >
				 {{ csrf_field()}}
				 <legend> 
				 	<h2 class="m-0 font-weight-bold text-primary">Lập phiếu nhập</h2>
				 </legend>
				 		<table border="0" style="width: 100%;">
				 			<thead style="border: 0;">
				 				<tr>
				 					<td>Sản phẩm</td>
				 					<td>Nhà cung cấp</td>
				 					<td>Số lượng</td>
				 					<td>Giá sản phẩm</td>
				 					<td></td>
				 					<td></td>
				 				</tr>
				 				</thead>
				 				<tbody>
				 				<tr>
				 					<td>
				 						<select id="spMa">
				 							@foreach($sanpham as $sp)
				 							<option value="{{$sp->spMa}}">{{$sp->spTen}}
				 							</option>
				 							@endforeach
				 						</select>
				 					</td>
				 					<td>
				 						<select id="nccMa">
				 							@foreach($nhacungcap as $ncc)
				 							<option value="{{$ncc->nccMa}}">{{$ncc->nccTen}}</option>
				 							@endforeach
				 						</select>
				 					</td>
				 					<td>
				 						<input id="soluong" type="number" />
				 					</td>
				 					<td>
				 						<input id="gia" type="number" />
				 					</td>
				 					<td>
				 						<button onclick="addRow()" id="btn__phieunhap" class="btn btn-primary" type="button">Thêm sản phẩm</button>
				 					</td>
				 				</tr>
				 				<tr>
				 					<td style="height: 20px;"></td>
				 				</tr>
				 				</tbody>
				 		</table>
				 		<hr/>
				 		<h4>Sản phẩm đã chọn</h4>
				 		<br/>
				 		<table style="width: 100%;">
				 			<thead id="thead__phieunhap">
				 				<tr>
				 					<td>Sản phẩm</td>
				 					<td>Nhà cung cấp</td>
				 					<td>Số lượng</td>
				 					<td>Giá sản phẩm</td>
				 					<td>Tổng giá</td>
				 				</tr>
				 				</thead>
				 			<tbody style="border: 0;" id="tbody__phieunhap">
				 			</tbody>
				 			<tr>
				 				<td colspan="5"></td>
				 			</tr>
				 			<tr>
				 				<td class="label__total" colspan="4" style="text-align: right;">Tổng số lượng:</td>
				 				<td colspan="1">
				 					<input id="row__soluong"  class="input__phieunhap" style="display: none;width: 100%;text-align: right;" name="tongsl" type="text">
				 				</td>
				 			</tr>
				 			<tr>
				 					<td class="label__total" colspan="4" style="text-align: right;">Tổng chi phí:</td>
				 				<td colspan="1" style="text-align: right;">
				 					<input id="row__tongtien" class="input__phieunhap" style="display: none;width: 100%;text-align: right;" name="tonggia" type="text">
				 				</td>
				 			</tr>
				 		</table>
				 		<br/>
				
					 	<div>
						  <button class="btn btn-primary" type="submit">Thực hiện</button>
						</div>
			</form>
      </div>              
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

<script>
	var btnPN = document.getElementById("btn__phieunhap");
	function addRow()
	{
		let spMa = document.getElementById("spMa").value;
		let nccMa = document.getElementById("nccMa").value;
		let soluong = document.getElementById("soluong").value;
		let gia = document.getElementById("gia").value;
		
		var rowSL = document.getElementById("row__soluong");
		var rowGia = document.getElementById("row__tongtien");

		var table = document.getElementById("tbody__phieunhap");
		var addRow = `
								<tr style="border: 0;">
				 					<td>
				 						<input class="input__phieunhap" name="spMa[]" type="text" readonly value=${spMa}>
				 					</td>
				 					</td>
				 					<td>
				 						<input class="input__phieunhap" name="nccMa[]" type="text" readonly value=${nccMa}>
				 					</td>
				 					<td>
				 						<input class="sl input__phieunhap" name="soluong[]" type="text" readonly value=${soluong}>
				 					</td>
				 					<td>
				 						<input  class="input__phieunhap" name="gia[]" type="text" readonly value=${gia}>
				 					</td>
				 					<td>
				 						<input class="gia input__phieunhap" name="tonggiasp[]" type="text" readonly value=${gia*soluong}>
				 					</td/>
				 				</tr>`;
				 table.innerHTML+= addRow;
				 var ip__sl = document.querySelectorAll(".sl");
				 var ip__gia = document.querySelectorAll(".gia");
				 var sumSL = 0;
				 var sumGia = 0;
				 for(var i = 0;i< ip__sl.length;i++)
				 {
				 	sumSL = sumSL + parseInt(ip__sl[i].value);
				 }
				 for(var y =0;y<ip__gia.length;y++)
				 {
				 	sumGia = sumGia + parseInt(ip__gia[y].value);
				 }

				 rowSL.style.display = 'block';
				 rowSL.value = sumSL;
				 rowGia.style.display = 'block';
				 rowGia.value = sumGia;

				 
				


	}
</script>
