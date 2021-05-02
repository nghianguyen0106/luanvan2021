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
                       
                        <form action="{{url('update-bao-cao-ngay')}}" method="GET">
                            {{csrf_field()}}
                            <button type="submit" class="btn btn-primary" style="width: 25%;">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-plus"style="color:white;font-weight: bold"></i>
                                            </span>
                                            <span class="text"><b>Cập nhật báo cáo ngày</b></span>
                            </button>
                            <select name="bcNgay" class="btn btn-primary">
                                 @foreach($bcNgay as $value)
                                            <option value="{{$value->hdNgaytao}}">{{$value->hdNgaytao}}</option>
                                 @endforeach
                            </select>
                        </form>
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã hóa đơn</th>
                                            <th>Mã khách hàng</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng sản phẩm</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>Mã hóa đơn</th>
                                            <th>Mã khách hàng</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng sản phẩm</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data1 as $value)
                                        <tr>
                                            <td>{{$value->hdMa}}</td>
                                            <td>{{$value->khMa}}</td>
                                            <td>{{$value->hdNgaytao}}</td>
                                            <td>{{$value->hdSoluongsp}}</td>
                                            <td>{{$value->hdTongtien}}</td>
                                            <td>{{$value->hdTinhtrang==0?"Chưa thanh toán":"Thanh toán"}}</td>
                                            <td>
                                                <a href="{{url('thanhtoan/'.$value->hdMa)}}">Xác nhận thanh toán</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                       
                                    </tbody>
                                </table>
                                <br/>
                                <hr/>
                                <br/>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã hóa đơn</th>
                                            <th>Mã khách hàng</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng sản phẩm</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>Mã hóa đơn</th>
                                            <th>Mã khách hàng</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng sản phẩm</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data2 as $value)
                                        <tr>
                                            <td>{{$value->hdMa}}</td>
                                            <td>{{$value->khMa}}</td>
                                            <td>{{$value->hdNgaytao}}</td>
                                            <td>{{$value->hdSoluongsp}}</td>
                                            <td>{{$value->hdTongtien}}</td>
                                            <td>{{$value->hdTinhtrang==1?"Thanh toán":"Chưa"}}</td>

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

