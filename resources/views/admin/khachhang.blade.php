@extends('admin.layout')
@section('content')
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shkhow mb-4">
                        <div class="card-hekher py-3">
                            <h2 class="m-0 font-weight-bold text-primary text-center">Quản lý khách hàng</h2>
                            <hr/>
                        </div>
                         <a  href="{{url('/themkhachhang')}}" class="btn btn-primary" style="width: 20%;">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"style="color:white;font-weight: bold"></i>
                                        </span>
                                        <span class="text"><b>Thêm khách hàng</b></span>
                                    </a>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Hình</th>
                                            <th>Tên</th>
                                            <th>Email</th>
                                            <th>Tài khoản</th>
                                            <th>Ngày sinh</th>  
                                            <th>Giới tính</th>
                                             <th>Số điện thoại</th>
                                            <th>Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display:none;">
                                        <tr>
                                             <th>Hình</th>
                                            <th>Tên khách hàng</th>
                                            <th>Email</th>
                                            <th>Tài khoản</th>
                                            <th>Ngày sinh</th> 
                                            <th>Giới tính</th>
                                            <th>Số điện thoại</th>
                                            <th>Cập nhật</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                            <th><img width="100" height="100" src="{{{'public/images/khachhang/'.$value->khHinh}}}" alt="Not image"/></th>
                                            <th>{{$value->khTen}}</th>
                                            <th>{{$value->khEmail}}</th>
                                            <th>{{$value->khTaikhoan}}</th>
                                            <th>{{$value->khNgaysinh}}</th>
                                            <th>{{$value->khGioitinh==1?"Nam":"Nữ"}}</th>
                                            <th>{{$value->khSdt}}</th>
                                            <td>
                                                <a> <a href="{{url('updateKhachhang/'.$value->khMa)}}" class="active" ui-toggle-class="">
                                                    <i class="fa far fa-edit"></i>
                                                </a>&nbsp;|
                                                <a  href="{{url('deleteKhachhang/'.$value->khMa)}}">
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