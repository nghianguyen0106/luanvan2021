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
                                            <th></th>
                                            <th>Tên nhân viên</th>
                                            <th>Tài khoản</th>
                                            <th>Mật khẩu</th>
                                            <th>SDT</th>
                                            <th>Email</th>
                                            <th>Chức vụ</th>   
                                            <th>Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Tên nhân viên</th>
                                            <th>Tài khoản</th>
                                            <th>Mật khẩu</th>
                                            <th>SDT</th>
                                            <th>Email</th>
                                            <th>Chức vụ</th>   
                                            <th>Cập nhật</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                            <td><img width="100" height="100" src="{{{'public/images/nhanvien/'.$value->adHinh}}}" alt="Not image"/></td>
                                             <td>{{$value->adTen}}</td>
                                            <td>{{$value->adTaikhoan}}</td>
                                            <td>{{$value->adMatkhau}}</td>
                                            <td>{{$value->adSdt}}</td>
                                            <td>{{$value->adEmail}}</td>
                                            <td>{{$value->adQuyen==1?"Quản lý":"Vận chuyển"}}</td>   
                                           
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