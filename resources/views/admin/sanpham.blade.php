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
                            <h2 class="m-0 font-weight-bold text-primary text-center">Quản lý sản phẩm</h2>
                            <hr/>
                        </div>
                        <a  href="{{url('/themsanpham')}}" class="btn btn-primary " style="width: 20%;">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"style="color:white;font-weight: bold"></i>
                                        </span>
                                        <span class="text"><b>Thêm sản phẩm</b></span>
                                    </a>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                   <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Tình trạng</th>
                                            <th>Hạn bảo hành</th>
                                           <th>Khuyến mãi</th>
                                            
                                             <th>Nhà cung cấp</th>
                                            <th>Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tfoot  style="display:none;">
                                        <tr>
                                             <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                             <th>Tình trạng</th>
                                            <th>Hạn bảo hành</th>
                                           <th>Khuyến mãi</th>
                                           
                                            <th>Nhà cung cấp</th>
                                            <th>Cập nhật</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                       
                                         @foreach($data as $value)
                                        <tr>
                                           <th>{{$value->spMa}}</th>
                                            <th>{{$value->spTen}}</th>
                                            <th>{{number_format($value->spGia)}}&nbsp;VND</th>
                                            <th>{{$value->spTinhtrang==0?"Hết hàng":"Còn hàng"}}</th>
                                            <th>
                                                @if($value->spHanbh==0)
                                                6 tháng
                                                @elseif($value->spHanbh==1)
                                                12 tháng
                                                @else
                                                24 tháng
                                                @endif
                                            </th>
                                            <th>{{$value->kmMa!=null?"$value->kmMa":"0%"}}</th>
                                            
                                            <th>{{$value->nccTen}}</th>
                                            <td>
                                                <a href="{{url('updateSanpham/'.$value->spMa)}}" class="active" ui-toggle-class="">
                                                    <i class="fa far fa-edit"></i>
                                                </a>&nbsp;|
                                                <a href="{{url('deleteSanpham/'.$value->spMa)}}" >
                                                    <i class="fa fas fa-trash" style="color: red;"></i>
                                                </a></a>
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

  @endsection