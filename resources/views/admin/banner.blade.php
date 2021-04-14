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
                            <h6 class="m-0 font-weight-bold text-primary">Quản lý banner </h6>
                        </div>
                         <a  href="{{url('/themBanner')}}" class="btn btn-primary" style="width: 20%;">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"style="color:white;font-weight: bold"></i>
                                        </span>
                                        <span class="text"><b>Thêm banner mới</b></span>
                                    </a>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã banner</th>
                                            <th>Banner</td>
                                            <th>Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Mã banner</th>
                                            <th>Banner</td>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->bnMa}}</td>
                                            <td style="text-align: center"><img src="{{"public/images/banners/".$value->bnHinh}}" width="500" height="200" /></td>
                                            <td>
                                                <a> <a href="{{url('/updateBanner/'.$value->bnMa)}}" class="active" ui-toggle-class="">
                                                    <i class="fa far fa-edit"></i>
                                                </a>&nbsp;|
                                                <a href="{{url('/deleteBanner/'.$value->bnMa)}}" >
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