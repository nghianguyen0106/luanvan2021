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
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
                        </div>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã sản phẩm</th>
                                            <th>Mã khách hàng</th>
                                           
                                            <th>Thông báo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Mã sản phẩm</th>
                                            <th>Mã khách hàng</th>
                                           
                                           
                                            <th>Thông báo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        
                                       
                                         @foreach($dg as $dg) 
                                           
                                        <tr>
                                             <td>{{$dg->spMa}}</td>
                                            <td>{{$dg->khTen}}</td>
                                            
                                            <td> 
                                                @if($dg->dgTrangthai==1)
                                                <span style="color: red;">Có thông báo mới</span>
                                                @else
                                                <span style="color: green;">Không có thông báo mới</span>

                                                @endif
                                            </td>
                                            <td>
                                                <a> <a href="{{url('/chitietBLSP/'.$dg->dgMa)}}" class="active" ui-toggle-class="">
                                                    Xem chi tiết  
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