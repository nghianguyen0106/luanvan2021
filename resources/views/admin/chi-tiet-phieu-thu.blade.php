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
                         <form action="{{URL::to('giaohang/'.$data->hdMa)}}" method="POST">
                    {{ csrf_field() }}
                            <tr>
                                <td colspan="4" style="text-align:left;">
                                   <h2 class="m-0 font-weight-bold text-primary" style="text-align: center;">Chi tiết đơn hàng</h2>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align:left;">
                                    <label>Mã đơn hàng:&nbsp;{{$data->hdMa}}</label><br/>
                                </td>
                            </tr>
                             <tr>
                                <td colspan="4" style="text-align:left;">
                                   <label>Ngày lập:&nbsp;{{$data->hdNgaytao}}</label><br/>
                                </td>
                            </tr>
                           
                             <tr>
                                <td colspan="4" style="text-align:left;">
                                    <label>Người đặt:&nbsp;{{$data->khTen}}</label><br/>
                                </td>
                            </tr>
                             <tr>
                                <td colspan="4" style="text-align:left;">
                                    <label>Số điện thoại người nhận:&nbsp;{{$data->hdSdtnguoinhan}}</label><br/>
                                </td>
                            </tr>
                             <tr>
                                <td colspan="4" style="text-align:left;">
                                     <label>Địa chỉ:&nbsp;{{$data->hdDiachi}}</label><br/>
                                </td>
                            </tr>
                             <tr>
                                <td colspan="4" style="text-align:left;">
                                     <label >Tình trạng:&nbsp;
                                {{$data->hdTinhtrang==2?"Đã thanh toán":""}}
                                {{$data->hdTinhtrang==0?"Chưa xử lý":""}}
                                {{$data->hdTinhtrang==1?"Đang giao":""}}
                                {{$data->hdTinhtrang==3?"Đã bị hủy":""}}
                            </label><br/>
                                </td>
                            </tr>
                            @if($data->hdTinhtrang==0)
                            <tr>
                                <td colspan="4" style="text-align: left;">
                                    <label>Chọn nhân viên nhận đơn hàng: </label>
                                     <select name="hdNhanvien" class="form-control" style="width: 220px;">
                                        @foreach($dataNV as $v)
                                           <option value="{{$v->adMa}}" >{{$v->adTen}}</option>
                                          @endforeach
                                      </select>
                                </td>
                            </tr>
                            @endif
                            @foreach($data3 as $v)
                            @if($v->adMa!=0)
                            <tr>
                                <td colspan="4" style="text-align:left;">
                                    <label>Nhân viên giao:&nbsp;{{$v->adTen}}</label><br/>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                                    <tr>
                                        <td>Sản phẩm</td>
                                        <td>Số lượng</td>
                                        <td>Giá</td>
                                        <td>Mã bảo hành</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data2 as $data2)
                                    @if($data2->cthdSoluong>1)
                                    @for($i = 0;$i<$data2->cthdSoluong;$i++)
                                    <tr>
                                        <td>{{$data2->spTen}}</td>
                                        <td>1</td>
                                        <td>{{number_format($data2->cthdGia/$data2->cthdSoluong)}}&nbsp;VND</td>
                                        <td>
                                            @if($data2->cthdImeisp!=0)
                                                {{$data2->cthdImeisp}}
                                            @else
                                                <input type="text" name="imeiID[]" />
                                            @endif
                                        </td>
                                    </tr>
                                    @endfor
                                    @else
                                     <tr>
                                        <td>{{$data2->spTen}}</td>
                                        <td>{{$data2->cthdSoluong}}</td>
                                        <td>{{number_format($data2->cthdGia)}}&nbsp;VND</td>
                                        <td>
                                            @if($data2->cthdImeisp!=0)
                                                {{$data2->cthdImeisp}}
                                            @else
                                                <input type="text" name="imeiID" />
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                     <tr>
                                        <td colspan="4" style="text-align: right;">Tổng số lượng:&nbsp;{{$data->hdSoluongsp}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align: right;">Tổng tiền:&nbsp;{{number_format($data->hdTongtien)}}&nbsp;VND</td>
                                    </tr>
                                </tbody>
                                 @endforeach
                            </table>
                        </div>
                    </div>
                    <br/>
                    <div class="row justify-content-around">
                	<button class="btn btn-info" type="button" onclick="back()">Trở về</button>
                     @if($data->hdTinhtrang==0)
                         <button type="submit" name="btn_add" class="btn btn-primary">Bắt đầu giao hàng</button>
                    @else
                        <button onclick="printt('content__print')" class="btn btn-dark" >In ra phiếu thu</button>
                     @endif
                    </div>
                </div>
                <br/>
            </div>

      </div>  
                                     
              </form>
                               
                              
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

