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
                            <h2 class="m-0 font-weight-bold text-primary">Quản lý voucher</h2>
                            <hr/>

                        </div>
                        <a  href="{{URL::to('addVoucherpage')}}" class="btn btn-primary " style="width: 20%;">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"style="color:white;font-weight: bold"></i>
                                        </span>
                                        <span class="text"><b>Thêm voucher</b></span>
                                    </a>
                        <br/>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                   <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã</th>
                                            <th>Tên </th>
                                            <th>Số lượt</th>
                                            <th>Loại</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Ngày kết thúc</th>
                                            <th>Loại giảm giá</th>
                                            <th>Mức giảm</th>
                                            <th>Giá trị tối đa</th>
                                            <th>Tình trạng (ẩn/hiện)</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($vc as $value)
                                        <tr>
                                            <td>{{$value->kmMa}}</td>
                                            <td>{{$value->kmTen}}</td>
                                            <td>{{$value->kmMota}}</td>
                                            <td>
                                                @if($value->kmSoluong==0)
                                                    Không giới hạn số lượng
                                                @else
                                                    {{$value->kmSoluong}}
                                                @endif
                                            </td>
                                            <td>@if($value->kmGioihanmoikh==null)
                                                    Không giới hạn
                                                @else
                                                    {{$value->kmGioihanmoikh}}
                                                @endif
                                            </td>
                                            <td>{{$value->kmNgaybd}}</td>
                                            <td>{{$value->kmNgaykt}}</td>

                                            <td>{{$value->kmTrigia}} %</td>
                                            <td>
                                                <label class="switch">
                                                <a href="{{URL::to('switchStatus/'.$value->kmMa)}}">
                                                  <input type="checkbox" name="kmTinhtrang" value="1" 
                                                  @if($value->kmTinhtrang!=0) checked="" @endif>
                                                  <span class="slider round"></span>
                                                </a>
                                                </label>

                                            </td>
                                            <td>
                                                <a  href="{{URL::to('suaKhuyenmaipage/'.$value->kmMa)}}">
                                                    <i class="fa fas fa-edit" style="color: blue;"></i>
                                                </a>
                                                <a  href="{{URL::to('deleteKhuyenmai/'.$value->kmMa)}}">
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

@if(Session::has('success'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Ok ! ',
  text: '{{Session::get('success')}}',
 
})
</script>   
@endif

@if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Opss... ! ',
  text: '{{Session::get('err')}}',
 
})
</script> 
@endif
  @endsection