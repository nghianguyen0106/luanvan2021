@extends('admin.layout')
@section('content')
    <div id="content-wrapper" class="d-flex flex-column">
@foreach($spMaCu as $key => $value)
            <!-- Main Content -->
             <div class="card-header py-3">
                            <h2 class="m-0 font-weight-bold text-primary">Xem chi tiết và cập nhật sản phẩm</h2>
                        </div>
            <div id="content" class="col-12">
             <form action="{{URL::to('/editSanpham/'.$value->spMa)}}" method="POST"  enctype="multipart/form-data">
                {{ csrf_field() }}
                <br/>
                 <div class="flex__form">
                     <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mã sản phẩm </label>
                        <input style="background-color:#C8C7D1;color: white;outline: none;border: 0;text-align: center;" readonly name="spMa" type="text" value="{{$value->spMa}}" />
                    </div>
                </div>
                            <!--field flex form-->
                <h4>Tổng quan</h4>
                    <div class="flex__form">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Tên sản phẩm </label>
                            <input class="form-control" name="spTen" type="text"  value="{{$value->spTen}}"/>
                            <span style="color:red">{{$errors->first('spTen')}}</span>
                        </div>

                        <div class="mb-3">
                             <label for="exampleInputPassword1" class="form-label">Giá</label>
                             <input class="form-control" name="spGia" type="number"  value="{{$value->spGia}}"/>
                             <span style="color:red">{{$errors->first('spGia')}}</span>
                         </div>

                        <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Hạn bảo hành</label>
                                <input class="form-control" name="spHanbh" type="number" value="{{$value->spHanbh}}"/>
                                <span style="color:red">{{$errors->first('spHanbh')}}</span>
                        </div>
                    </div>
                    <br/>
                      <div class="flex__form">
                       <div class="mb-3">
                           <label for="exampleInputPassword1" class="form-label">khuyến mãi</label>
                             <select class="form-control" style="width: 205px" name="thMa">
                                @foreach($kmOld as $kmOld)
                                        <option value="{{$kmOld->kmMa}}">{{$kmOld->kmTrigia}}</option>
                                   @endforeach
                                        @foreach($kmMa as $km)
                                            <option  value="{{$km->kmMa}}">{{$km->kmTrigia}}</option>
                                        @endforeach
                                    </select>
                        </div>
                         <div class="mb-3">
                           <label for="exampleInputPassword1" class="form-label">Thương hiệu</label>
                             @foreach($thOld as $thOld)
                                
                                    <select class="form-control" style="width: 205px" name="thMa">
                                        <option value="{{$thOld->thMa}}">{{$thOld->thTen}}</option>
                                   @endforeach
                                        
                                    </select>
                        </div>
                        <div class="mb-3">
                           <label for="exampleInputPassword1" class="form-label">Loại</label>
                           <select id="sua__select__loai" class="form-control" style="width: 205px" name="loaiMa">
                            @foreach($loaiOld as $loaiOld) 
                                 
                               <option value="{{$loaiOld->loaiMa}}">{{$loaiOld->loaiTen}}</option>
                               
                            </select>                        
                            @endforeach
                        </div>

                        <div class="mb-3">
                           <label for="exampleInputPassword1" class="form-label">Nhu cầu</label>
                            @foreach($ncOld as $ncOld)
                                <select class="form-control" style="width: 180px" name="ncMa">
                                    <option value="{{$ncOld->ncMa}}">{{$ncOld->ncTen}}</option>
                                    @foreach($ncMa as $nc)
                                        <option value="{{$nc->ncMa}}">{{$nc->ncTen}}</option>
                                    @endforeach
                                </select>
                            @endforeach
                         </div>
                    </div>

                  <!--field flex form-->
                <br/>
                <h4>Mô tả chi tiết</h4>
                <div class="flex__form">
                    <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Ram</label>
                    <input name="ram" type="text" class="form-control">
                    <span style="color:red">{{$errors->first('')}}</span>
                    </div>
                    <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">CPU</label>
                    <input name="cpu" type="text" class="form-control" >
                    <span style="color:red">{{$errors->first('')}}</span>
                    </div>
                     <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Ổ cứng</label>
                    <input name="ocung" type="text" class="form-control" >
                    <span style="color:red">{{$errors->first('')}}</span>
                    </div> 
                </div>
                
                <!--mota__lap-->
                <div id="sua_lap">
                    <div class="flex__form">
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Màn hình</label>
                        <input name="manhinh" type="text" class="form-control">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Cổng giao tiếp</label>
                        <input name="conggiaotiep" type="text" class="form-control" >
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                         <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Trọng lượng</label>
                        <input name="trongluong" type="text" class="form-control" >
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div> 
                    </div>
                <!---->
                    <div class="flex__form">
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Màu</label>
                        <input name="mau" type="text" class="form-control">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Loa</label>
                        <input name="loa" type="text" class="form-control" >
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                         <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Webcam</label>
                        <input name="webcam" type="text" class="form-control" >
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div> 
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tản nhiệt</label>
                        <input name="tannhiet" type="text" class="form-control" >
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div> 
                    </div>
                
                <!---->
                    <div class="flex__form">
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">PIN</label>
                        <input name="pin" type="text" class="form-control">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Chuẩn wifi</label>
                        <input name="chuanwifi" type="text" class="form-control" >
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                         <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Chuẩn Lan</label>
                        <input name="chuanlan" type="text" class="form-control" >
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div> 
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Hệ điều hành</label>
                        <input name="hedieuhanh" type="text" class="form-control" >
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div> 
                    </div>
                </div>
               
                <!--end mota__lap-->
                <!--mota__pc-->
                <div id="sua_pc">
                    <div class="flex__form">
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mainboard</label>
                        <input name="mainboard" type="text" class="form-control">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">VGA</label>
                        <input name="vga" type="text" class="form-control" >
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">PSU</label>
                        <input name="psu" type="text" class="form-control">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">CASE</label>
                        <input name="case" type="text" class="form-control" >
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                    
                </div>
                </div>
                
                <!--end mota__pc-->
                    <br/>           
                    <!---end foreach mo ta--->  
                       <button class="btn_ok" type="submit" name="btn_edit" class="btn btn-primary">Thực hiện</button>
             </form>
             
                            <h4>Hình ảnh sản phẩm</h4>
                             <form action="{{url('/themhinh')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input hidden name="spMa" value="{{$value->spMa}}" />
                                <input id="upSpHinh" type="file" name="img"  />
                                 <label for="upSpHinh" class="lb__upSpHinh"><i class="fas fa-file-upload" style="font-size: 20px;">&nbsp;Chọn hình mới</i></label>
                                @if(Session::has('img_err'))
                                {{Session::get('img_err')}}
                                @endif
                                <button class="btn_ok" type="submit" class="btn-link" name="btnTH">Thêm hình</button>
                            </form>
                            <div style="display: flex;flex-direction: row; flex-wrap: wrap;padding: 10px 10px; height: 350px;overflow-y: scroll;">
                             @foreach($hinh as $hinh)
                                 <div style="width: 160px;margin-top: 1rem;margin-left: 2rem ">
                                    <img src="{{{'../public/images/products/'.$hinh->spHinh}}}" width="180" height="180" alt="loading">
                                   <a style="padding: 5px 20px 5px 20px" href="{{url('xoahinh/'.$hinh->spHinh."/".$hinh->spMa)}}" class="btn-danger">Xóa</a>
                                  </div>
                             @endforeach

                            </div>
                    <br/>
                                <button class="btn btn-info" type="button" onclick="back()">Trở về</button>     
        </div> 
@endforeach
    </div>
    
@endsection
