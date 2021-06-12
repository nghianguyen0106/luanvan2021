@extends('admin.layout')
@section('content')

	  <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                     <div class="card-header py-3">
                            <h2 class="m-0 font-weight-bold text-primary" style="text-align: center;">Chi tiết phiếu nhập</h2>
                        </div>
                     <div class="card-body">
                        @foreach($data as $data)
                        <div class="table-responsive">
                            <label>Mã phiếu nhập:&nbsp;{{$data->pnMa}}</label><br/>
                             <label>Ngày lập:&nbsp;{{$data->pnNgaylap}}</label><br/>
                            <label>Tên người lập:&nbsp;{{$data->adTen}}</label><br/>
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <td>Sản phẩm</td>
                                        <td>Nhà cung cấp</td>
                                        <td>Số lượng</td>
                                        <td>Đơn giá</td>
                                        <td>Thành tiền</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data2 as $data2)
                                    <tr>
                                        <td>{{$data2->spTen}}</td>
                                        <td>{{$data2->nccTen}}</td>
                                        <td>{{$data2->ctpnSoluong}}</td>
                                        <td>{{number_format($data2->ctpnDongia)}}&nbsp;VND</td>
                                        <td>{{number_format($data2->ctpnThanhtien)}}&nbsp;VND</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" style="text-align: right">Tổng sản phẩm:&nbsp;{{$data->pnSoluongsp}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"  style="text-align: right">Tổng chi phí:&nbsp;{{number_format($data->pnTongtien)}}&nbsp;VND</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @endforeach
                    </div>
                   
                	<button class="btn btn-info" type="button" onclick="back()">Trở về</button>
                </div>
            </div>

      </div>

     

@endsection

