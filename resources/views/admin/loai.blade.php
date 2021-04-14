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
                            <h6 class="m-0 font-weight-bold text-primary">Quản lý loại</h6>

                        </div>
                        <a  href="{{url('/themloai')}}" class="btn btn-primary" style="width: 20%;">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"style="color:white;font-weight: bold"></i>
                                        </span>
                                        <span class="text"><b>Thêm loại mới</b></span>
                                    </a>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã loại</th>
                                            <th>Tên loại</th>
                                            <th>Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>Mã loại</th>
                                            <th>Tên loại</th>
                                            <th>Cập nhật</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->loaiMa}}</td>
                                            <td>{{$value->loaiTen}}</td>
                                           
                                            <td>
                                                <a href="{{url('/updateLoai/'.$value->loaiMa)}}" class="active" ui-toggle-class="">
                                                    <i class="fa far fa-edit"></i>
                                                </a>&nbsp;|
                                                <a href="{{URL::to('/deleteLoai/'.$value->loaiMa)}}" >
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

  @endsection