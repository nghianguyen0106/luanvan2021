<!DOCTYPE html>
<html>
<head>
    <title>Hóa Đơn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  
</head>
<body>
   
  <div class="container">
  	 <h1>Hóa đơn {{$details[0]->hdMa}}</h1>
     <h3>Chào {{Session::get('khTen')}}</h3>
     <h4>Ngày đặt hàng: {{$details[0]->hdNgaytao}}</h4>
     <h4>Số lượng sản phẩm: {{$details[0]->hdSoluongsp}}</h4>
     <h4>Địa chỉ giao hàng: {{$details[0]->hdDiachi}}</h4>
     <h4>Số điện thoại người nhận: {{$details[0]->hdSdtnguoinhan}}</h4>
	  <table border="1" class="table" style="text-align: center;">
  <thead>
    <tr>
      <th style="margin-left: 15px;" scope="col">Stt</th>
      <th style="margin-left: 15px;" scope="col">Tên sản phẩm</th>
      <th style="margin-left: 15px;" scope="col">Số lượng</th>
      <th style="margin-left: 15px;" scope="col">Đơn giá</th>
      <th style="margin-left: 15px;" scope="col">Khuyến mãi</th>
      <th style="margin-left: 15px;" scope="col">Thành tiền</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($details as $k => $v)
    <tr>
      <th style="margin-left: 15px;">{{$k+1}}</th>
      <td style="margin-left: 15px;">{{$v->spTen}}</td>
      <td style="margin-left: 15px;">{{$v->cthdSoluong}}</td>
      <td style="margin-left: 15px;">{{number_format($v->spGia)}} VND</td>
      <td style="margin-left: 15px;">{{$v->kmMa}} %</td>
      <td style="margin-left: 15px;">{{number_format($v->cthdGia)}} VND</td>
    </tr>
    @endforeach
    <tr>
    	<td colspan="6">
    			<span><strong>Tổng tiền: </strong></span>
    			<span><strong style="color: red;">{{number_format($details[0]->hdTongtien)}}</strong> VND</span>
    			
    	</td>
    </tr>
  </tbody>
</table>
    <p style="color: green;"><strong>Thank you !</strong></p>

</body>
</html>
