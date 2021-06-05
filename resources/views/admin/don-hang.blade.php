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
                            <h2 class="m-0 font-weight-bold text-primary">Danh sách đơn hàng</h2>
                            <hr/>
                            <ul class="menu__donhang">
                                <li onclick="show_moi()">
                                    @if(Session::get('hdTinhtrang')!=null)
                                    <span style="color:red;">Đơn hàng mới({{$noteDonhang}})</span>
                                    @else
                                     <span onclick="show_moi()">Đơn hàng mới</span>
                                     @endif
                                </li>
                               
                                <li onclick="show_giao()">Đơn hàng đang giao</li>
                                <li onclick="show_xong()">Đơn hàng hoàn thành</li>
                                 @if(Session::get('hdTinhtrang1')!=null)
                                <li onclick="show_huy()" style="color: red;">Đơn hàng đang chờ hủy({{$noteDonhang1}})</li>
                                 @else
                                     <span  onclick="show_huy()">Đơn hàng đang chờ hủy</span>
                                @endif

                            </ul>
                        </div>
                            <div id="don_hang_huy" class="card-body">
                            <div class="table-responsive">
                                <h3>Đơn hàng đang chờ hủy</h3>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                   <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã hóa đơn</th>
                                            
                                            <th>Tên khách hàng</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng sản phẩm</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display:none;">
                                        <tr>
                                           <th>Mã hóa đơn</th>
                                         
                                            <th>Tên khách hàng</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng sản phẩm</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data4 as $value)
                                        <tr>
                                            <td>{{$value->hdMa}}</td>
                                            <td>{{$value->khTen}}</td>
                                            <td>{{$value->hdNgaytao}}</td>
                                            <td>{{$value->hdSoluongsp}}</td>
                                            <td>{{$value->hdTongtien}}</td>
                                            <td style="color:red">{{$value->hdTinhtrang==3?"Khách hàng đang yêu cầu hủy":""}}</td>
                                            <td><a class="btn btn-danger" href="{{url('xoa-don/'.$value->hdMa)}}">Xác nhận hủy</a></td>
                                        </tr>
                                    @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!---------------------------------------2----------------------------------------------->
                          
                        <div id="don_hang_moi" class="card-body">
                            <div class="table-responsive">
                                 <h3>Đơn hàng chưa thanh toán</h3>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã hóa đơn</th>
                                            <th>Tên khách hàng</th>
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
                                            <th>Tên khách hàng</th>
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
                                            <td>{{$value->khTen}}</td>
                                            <td>{{$value->hdNgaytao}}</td>
                                            <td>{{$value->hdSoluongsp}}</td>
                                            <td>{{$value->hdTongtien}}</td>
                                            <td style="color:red">{{$value->hdTinhtrang==0?"Đơn hàng mới":""}}</td>
                                            <td>
                                                <a href="{{url('them-nv-giao-hang/'.$value->hdMa)}}">
                                                Bắt đầu giao hàng
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                         <!---------------------------------------3----------------------------------------------->
                               
                            <div class="card-body">
                            <div  id="don_hang_giao" class="table-responsive">
                                <h3>Đơn hàng đang giao</h3>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã hóa đơn</th>
                                            <th>Nhân viên giao</th>
                                            <th>Tên khách hàng</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng sản phẩm</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>Mã hóa đơn</th>
                                           <th>Nhân viên giao</th>
                                            <th>Tên khách hàng</th>
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
                                            <td>{{$value->adTen}}</td>
                                            <td>{{$value->khTen}}</td>
                                            <td>{{$value->hdNgaytao}}</td>
                                            <td>{{$value->hdSoluongsp}}</td>
                                            <td>{{$value->hdTongtien}}</td>
                                            <td><a href="{{url('thanhtoan/'.$value->hdMa)}}">{{$value->hdTinhtrang==1?"Xác nhận đã giao":""}}</a></td>

                                        </tr>
                                    @endforeach
                                       
                                    </tbody>
                                </table>
                            </div></div>
                             <!---------------------------------------4----------------------------------------------->
                                 <div  id="don_hang_xong" class="card-body">
                            <div class="table-responsive">
                                <h3>Đơn hàng đã hoàn thành</h3>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã hóa đơn</th>
                                              <th>Nhân viên giao</th>
                                            <th>Tên khách hàng</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng sản phẩm</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>Mã hóa đơn</th>
                                           <th>Nhân viên giao</th>
                                            <th>Tên khách hàng</th>
                                            <th>Ngày tạo</th>
                                            <th>Số lượng sản phẩm</th>
                                            <th>Tổng tiền</th>
                                            <th>Tình trạng</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data3 as $value)
                                        <tr>
                                            <td>{{$value->hdMa}}</td>
                                            <td>{{$value->adTen}}</td>
                                            <td>{{$value->khTen}}</td>
                                            <td>{{$value->hdNgaytao}}</td>
                                            <td>{{$value->hdSoluongsp}}</td>
                                            <td>{{$value->hdTongtien}}</td>
                                            <td style="color:green">{{$value->hdTinhtrang==2?"Đã thanh toán":""}}</td>

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

