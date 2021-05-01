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
                            <h6 class="m-0 font-weight-bold text-primary">Doanh thu</h6>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã báo cáo</th>
                                            <th>Tổng sản phẩm đã bán</th>
                                            <th>Tổng tiền trong ngày</th>
                                            <th>Tồn kho</th>
                                            <th>Ngày lập</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>Mã báo cáo</th>
                                            <th>Tổng sản phẩm đã bán</th>
                                            <th>Tổng tiền trong ngày</th>
                                            <th>Tồn kho</th>
                                            <th>Ngày lập</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->bcMa}}</td>
                                            <td>{{$value->bcTongxuat}}</td>
                                            <td>{{$value->bcThu}}</td>
                                            <td>{{$value->bcTonkho}}</td>
                                            <td>{{$value->bcNgaylap}}</td>
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