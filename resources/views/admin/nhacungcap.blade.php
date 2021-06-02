@extends('admin.layout')
@section('content')
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid"> 
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Quản lý nhà cung cấp</h6>
                            <hr/>
                            	<a href="{{URL::to('adthemncc')}}" class="btn btn-primary"><i class="fas fa-plus"> Thêm nhà cung cấp</i></a>
                        </div>
                    	<br/>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã nhà cung cấp</th>
                                            <th>Tên nhà cung cấp</th>
                                            <th>Địa chỉ</th>
                                            <th>Số điện thoại</th>
                                            <th></th>
                                             
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->nccMa}}</td>
                                            <td>{{$value->nccTen}}</td>
                                            <td>{{$value->nccDiachi}}</td>
                                            <td>{{$value->nccSdt}}</td>
                                           <td>
                                                <a  href="{{URL::to('suaNhacungcappage/'.$value->nccMa)}}">
                                                    <i class="fa fas fa-edit" style="color: blue;"></i>
                                                </a>
                                                <a  href="{{URL::to('deleteNhacungcap/'.$value->nccMa)}}">
                                                    <i class="fa fas fa-trash" style="color: red;"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

@if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Opss... ',
  text: '{{Session::get('err')}}',
 
})
</script> 
@endif

@if(Session::has('success'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Done ! ',
  text: '{{Session::get('success')}}',
 
})
</script> 
@endif

  @endsection