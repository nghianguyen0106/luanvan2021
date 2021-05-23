@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column" >

            <!-- Main Content -->
        <div id="content" class="container">
        	<br/>
			<form action="{{URL::to('checkSuaNhacungcap/'.$data->nccMa)}}" method="POST"  >
				 {{ csrf_field()}}
				 <legend>Sửa nhà cung cấp</legend>
				 <div class="row">
				 	<div class="mb-3 col-6">
						<label>Mã nhà cung cấp<input class="form-control" type="text" name="nccMA" readonly="" value="{{$data->nccMa}}"></label>
					</div>
					<div class="mb-3 col-6">
						<label>Tên nhà cung cấp<input  class="form-control"  type="text" name="nccTen" value="{{$data->nccTen}}"></label>
					</div>
					 	<div class="mb-3 col-6">
						  <button class="btn btn-secondary" type="button" onclick="back()">Trở về</button>
						</div>

					 	<div class="mb-3 col-6">
						  <button class="btn btn-primary" type="submit">Thực hiện</button>
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

