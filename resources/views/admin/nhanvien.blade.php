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
                            <h6 class="m-0 font-weight-bold text-primary">Quản lý nhân viên</h6>
                        </div>
                         <a  href="{{url('/themnhanvien')}}" class="btn btn-primary" style="width: 20%;">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"style="color:white;font-weight: bold"></i>
                                        </span>
                                        <span class="text"><b>Thêm nhân viên</b></span>
                                    </a>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã nhân viên</th>
                                            <th>Tên nhân viên</th>
                                            <th>Tài khoản</th>
                                            <th>Mật khẩu</th>
                                            <th>Email</th>
                                            <th>Quyền</th>   
                                            <th>Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                             <th>Mã nhân viên</th>
                                            <th>Tên nhân viên</th>
                                            <th>Tài khoản</th>
                                            <th>Mật khẩu</th>
                                            <th>Email</th>
                                            <th>Quyền</th>   
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                            <th>{{$value->adMa}}</th>
                                             <th>{{$value->adTen}}</th>
                                            <th>{{$value->adTaikhoan}}</th>
                                            <th>{{$value->adMatkhau}}</th>
                                            <th>{{$value->adEmail}}</th>
                                            <th>{{$value->adQuyen}}</th>   
                                           
                                            <td>
                                                <a> <a href="{{url('updateAdmin/'.$value->adMa)}}" class="active" ui-toggle-class="">
                                                    <i class="fa far fa-edit"></i>
                                                </a>&nbsp;|
                                                <a  href="{{url('deleteAdmin/'.$value->adMa)}}">
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