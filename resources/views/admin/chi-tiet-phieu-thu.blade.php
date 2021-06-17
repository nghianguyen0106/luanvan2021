@extends('admin.layout')
@section('content')

	  <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                     <div class="card-header py-3">
                            <h2 class="m-0 font-weight-bold text-primary" style="text-align: center;">Chi tiết đơn hàng</h2>
                        </div>
                     <div class="card-body">
                         <div id="content__print" class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                        @foreach($data as $data)
                       
                            <label>Mã đơn hàng:&nbsp;{{$data->hdMa}}</label><br/>
                             <label>Ngày lập:&nbsp;{{$data->hdNgaytao}}</label><br/>
                            <label>Người đặt:&nbsp;{{$data->khTen}}</label><br/>
                            <label>Số điện thoại người nhận:&nbsp;{{$data->hdSdtnguoinhan}}</label><br/>
                            <label>Địa chỉ:&nbsp;{{$data->hdDiachi}}</label><br/>
                            <label>Tình trạng:&nbsp;
                                {{$data->hdTinhtrang==2?"Đã thanh toán":""}}
                                {{$data->hdTinhtrang==0?"Chưa xử lý":""}}
                                {{$data->hdTinhtrang==1?"Đang giao":""}}
                                {{$data->hdTinhtrang==3?"Đã bị hủy":""}}
                            </label><br/>
                            @if($data->adMa!=null)
                            <label>Nhân viên giao:&nbsp;{{$data->adTen}}</label><br/>
                            @endif
                            
                                    <tr>
                                        <td>Sản phẩm</td>
                                        <td>Số lượng</td>
                                        <td>Giá</td>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data2 as $data2)
                                    <tr>
                                        <td>{{$data2->spTen}}</td>
                                        <td>{{$data2->cthdSoluong}}</td>
                                        <td>{{$data2->cthdGia}}</td>
                                        
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                                 @endforeach
                            </table>
                        </div>
                    </div>
                    <br/>
                	<button class="btn btn-info" type="button" onclick="back()">Trở về</button>
                </div>
            </div>

      </div>

     

@endsection

