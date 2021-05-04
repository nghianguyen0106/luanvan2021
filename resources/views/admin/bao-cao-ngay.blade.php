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
                             <form action="{{url('update-bao-cao-ngay')}}" method="GET">
                            {{csrf_field()}}
                             <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Ngày bắt đầu</label>
                                <input name="dateStart" hi type="date" class="dateInput"  id="dateStart">
                                
                                <br/>
                                 <label for="exampleInputPassword1" class="form-label">Ngày kết thúc</label>
                                <input name="dateEnd" type="date" class="dateInput" id="dateEnd">
                                 
                              </div>
                            <button type="submit" class="btn btn-primary" style="width: 25%;">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-plus"style="color:white;font-weight: bold"></i>
                                            </span>
                                            <span class="text"><b>Cập nhật báo cáo </b></span>
                            </button>
                           

                        </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã báo cáo</th>
                                            <th>Tổng sản phẩm đã bán</th>
                                            <th>Tổng sản phẩm nhập</th>
                                            <th>Tổng thu trong ngày</th>
                                            <th>Tổng chi trong ngày</th>
                                            <th>Tồn kho</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Ngày kết thúc</th>
                                            <th>Ngày lập</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Mã báo cáo</th>
                                            <th>Tổng sản phẩm đã bán</th>
                                            <th>Tổng sản phẩm nhập</th>
                                            <th>Tổng thu trong ngày</th>
                                            <th>Tổng chi trong ngày</th>
                                            <th>Tồn kho</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Ngày kết thúc</th>
                                            <th>Ngày lập</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->bcMa}}</td>
                                            <td>{{$value->bcTonghangxuat}}</td>
                                            <td>{{$value->bcTonghangnhap}}</td>
                                            <td>{{$value->bcThu}}</td>
                                            <td>{{$value->bcChi}}</td>
                                            <td>{{$value->bcTonkho}}</td>
                                            <td>{{$value->bcNgayBD}}</td>
                                            <td>{{$value->bcNgayKT}}</td>
                                            <td>{{$value->bcNgaylap}}</td>
                                            <td>
                                             <a href="{{url('/deleteBaocao/'.$value->bcMa)}}" >
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


