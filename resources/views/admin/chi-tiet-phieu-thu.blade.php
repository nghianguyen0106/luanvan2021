@extends('admin.layout')
@section('content')

	  <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                     
                        
                        
                     <div class="card-body">
                         <div id="content__print" class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                        @foreach($data as $data)
                            <tr>
                                <td colspan="3" style="text-align:left;">
                                   <h2 class="m-0 font-weight-bold text-primary" style="text-align: center;">Chi tiết đơn hàng</h2>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align:left;">
                                    <label>Mã đơn hàng:&nbsp;{{$data->hdMa}}</label><br/>
                                </td>
                            </tr>
                             <tr>
                                <td colspan="3" style="text-align:left;">
                                   <label>Ngày lập:&nbsp;{{$data->hdNgaytao}}</label><br/>
                                </td>
                            </tr>
                           
                             <tr>
                                <td colspan="3" style="text-align:left;">
                                    <label>Người đặt:&nbsp;{{$data->khTen}}</label><br/>
                                </td>
                            </tr>
                             <tr>
                                <td colspan="3" style="text-align:left;">
                                    <label>Số điện thoại người nhận:&nbsp;{{$data->hdSdtnguoinhan}}</label><br/>
                                </td>
                            </tr>
                             <tr>
                                <td colspan="3" style="text-align:left;">
                                     <label>Địa chỉ:&nbsp;{{$data->hdDiachi}}</label><br/>
                                </td>
                            </tr>
                             <tr>
                                <td colspan="3" style="text-align:left;">
                                     <label >Tình trạng:&nbsp;
                                {{$data->hdTinhtrang==2?"Đã thanh toán":""}}
                                {{$data->hdTinhtrang==0?"Chưa xử lý":""}}
                                {{$data->hdTinhtrang==1?"Đang giao":""}}
                                {{$data->hdTinhtrang==3?"Đã bị hủy":""}}
                            </label><br/>
                                </td>
                            </tr>
                            @if($data->adMa!=null)
                            <tr>
                                <td colspan="3" style="text-align:left;">
                                    <label>Nhân viên giao:&nbsp;{{$data->adTen}}</label><br/>
                                </td>
                            </tr>
                            
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
                                     <tr>
                                        <td colspan="3" style="text-align: right;">Tổng số lượng:&nbsp;{{$data->hdSoluongsp}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style="text-align: right;">Tổng tiền:&nbsp;{{$data->hdTongtien}}</td>
                                    </tr>
                                </tbody>
                                 @endforeach
                            </table>
                        </div>
                    </div>
                    <br/>
                	&emsp;<button class="btn btn-info" type="button" onclick="back()">Trở về</button>
                    &emsp; &emsp;
                    <button onclick="printt('content__print')" class="btn btn-dark" >In ra phiếu thu</button>
                </div>
                <br/>
            </div>

      </div>


      <script>
        
    function printt(content__print)
    {
        var restorepage = document.body.innerHTML; 
         var content = document.getElementById(content__print).innerHTML;
         document.body.innerHTML = content;
        window.print();
        document.body.innerHTML = restorepage;
    }
      </script>
@endsection

