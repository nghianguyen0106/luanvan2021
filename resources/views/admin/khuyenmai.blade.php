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
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Hạn bảo hành</th>
                                            <th>Khuyến mãi</th>
                                            <th>Thương hiệu</th>
                                            <th>Nhu cầu</th>
                                            <th>Loại</th>
                                            <th>Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Hạn bảo hành</th>
                                            <th>Khuyến mãi</th>
                                            <th>Thương hiệu</th>
                                            <th>Nhu cầu</th>
                                            <th>Loại</th>
                                             <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>Tiger Nixon</td>
                                            <td>System Architect</td>
                                            <td>Edinburgh</td>
                                            <td>61</td>
                                            <td>2011/04/25</td>
                                            <td>$320,800</td>
                                             <td>2011/04/25</td>
                                            <td>$320,800</td>
                                            <td>
                                                <a> <a href="#" class="active" ui-toggle-class="">
                                                    <i class="fa far fa-edit"></i>
                                                </a>&nbsp;|
                                                <a href="#" >
                                                    <i class="fa fas fa-trash" style="color: red;"></i>
                                                </a></a>
                                            </td>
                                        </tr>

                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

  @endsection