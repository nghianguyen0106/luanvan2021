@extends('admin.layout')
@section('content')

    <div id="content-wrapper" class="d-flex flex-column">
@foreach($spMaCu as $key => $value)
            <!-- Main Content -->
             <div class="card-header py-3">
                            <h2 class="m-0 font-weight-bold text-primary text-center">Xem chi tiết và cập nhật sản phẩm</h2>
                            <hr/>
                             <a href="{{URL::asset("adSanpham")}}" class="btn btn-info" type="button">Trở về</a>   
                        </div>
            <div id="content" class="col-12">
             <form action="{{URL::to('/editSanpham/'.$value->spMa)}}" method="POST"  enctype="multipart/form-data">
                {{ csrf_field() }}
                <br/>
                <div class="mb-3">
                       
                        <input  hidden class="form-control" name="spMa" type="text" value="{{$value->spMa}}" />
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
                          <label for="exampleInputPassword1" class="form-label">Hạn bảo hành:</label><br/>
                          <input name="spHanbh" {{$value->spHanbh==0?"checked":"unchecked"}} type="radio" value="0"  id="spHanbh"/>6 tháng &emsp;
                          <input name="spHanbh" {{$value->spHanbh==1?"checked":"unchecked"}} type="radio" value="1"id="spHanbh"/>12 tháng &emsp;
                          <input name="spHanbh" {{$value->spHanbh==2?"checked":"unchecked"}} type="radio" value="2"  id="spHanbh"/>24 tháng &emsp;
                          <br/>
                          <span style="color:red">{{$errors->first('spHanbh')}}</span>
                       </div>
                    </div>
                    <br/>
                      <div class="flex__form">
                       <div class="mb-3">
                           <label for="exampleInputPassword1" class="form-label">khuyến mãi</label>
                             <select class="form-control" style="width: 205px" name="thMa">

                                @foreach($kmOld as $kmOld)
                                        <option value="{{$kmOld->kmMa}}">{{$kmOld->kmTen}}.{{$kmOld->kmTrigia}}</option>
                                   @endforeach
                                        @foreach($kmMa as $v)
                                        <option value="{{$v->kmMa}}" >{{$v->kmTen}}.{{$v->kmTrigia}} % </option>
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
                           <select  id="loai"  class="form-control" style="width: 205px" name="loaiMa">
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

                          <div class="mb-3">
                           <label for="exampleInputPassword1" class="form-label">Nhà cung cấp</label>
                            @foreach($nccOld as $nccOld)
                                    <select style="width: 205px" class="form-control m-bot15" name="nccMa">
                                      <option value="{{$nccOld->nccMa}}">{{$nccOld->nccTen}}</option>
                                                @foreach($nccMa as $ncc)
                                                    <option value="{{$ncc->nccMa}}" >{{$ncc->nccTen}}</option>
                                                @endforeach
                                   </select>
                              @endforeach
                               </div>
                    </div>

                  <!--field flex form-->
                <br/>
                <h4>Mô tả chi tiết</h4>
                @foreach($mota as $mota)
                <div class="flex__form">
                    <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Ram</label>
                    <input name="ram" type="text" class="form-control" value="{{$mota->ram}}">
                    <span style="color:red">{{$errors->first('')}}</span>
                    </div>
                    <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">CPU</label>
                    <input name="cpu" type="text" class="form-control" value="{{$mota->cpu}}">
                    <span style="color:red">{{$errors->first('')}}</span>
                    </div>
                     <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Ổ cứng</label>
                    <input name="ocung" type="text" class="form-control" value="{{$mota->ocung}}">
                    <span style="color:red">{{$errors->first('')}}</span>
                    </div> 
                </div>
                
                <!--mota__lap-->
                <div id="sua_lap">
                    <div class="flex__form">
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Màn hình</label>
                        <input name="manhinh" type="text" class="form-control" value="{{$mota->manhinh}}">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Cổng giao tiếp</label>
                        <input name="conggiaotiep" type="text" class="form-control" value="{{$mota->conggiaotiep}}">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                         <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Trọng lượng</label>
                        <input name="trongluong" type="text" class="form-control" value="{{$mota->trongluong}}">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div> 
                    </div>
                <!---->
                    <div class="flex__form">
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Màu</label>
                        <input name="mau" type="text" class="form-control" value="{{$mota->mau}}">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Loa</label>
                        <input name="loa" type="text" class="form-control" value="{{$mota->loa}}">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                         <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Webcam</label>
                        <input name="webcam" type="text" class="form-control" value="{{$mota->webcam}}">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div> 
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tản nhiệt</label>
                        <input name="tannhiet" type="text" class="form-control" value="{{$mota->tannhiet}}">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div> 
                    </div>
                
                <!---->
                    <div class="flex__form">
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">PIN</label>
                        <input name="pin" type="text" class="form-control" value="{{$mota->pin}}">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Chuẩn wifi</label>
                        <input name="chuanwifi" type="text" class="form-control" value="{{$mota->chuanwifi}}">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                         <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Chuẩn Lan</label>
                        <input name="chuanlan" type="text" class="form-control" value="{{$mota->chuanlan}}">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div> 
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Hệ điều hành</label>
                        <input name="hedieuhanh" type="text" class="form-control" value="{{$mota->hedieuhanh}}">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div> 
                    </div>
                    <!---->
                        <div class="flex__form">
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Chuột</label>
                        <input name="chuot" value="{{$mota->chuot}}" type="text" class="form-control">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Bàn phím</label>
                        <input name="banphim" value="{{$mota->banphim}}" type="text" class="form-control" >
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
                        <input name="mainboard" type="text" class="form-control" value="{{$mota->mainboard}}">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">VGA</label>
                        <input name="vga" type="text" class="form-control" value="{{$mota->vga}}">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">PSU</label>
                        <input name="psu" type="text" class="form-control" value="{{$mota->psu}}">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">CASE</label>
                        <input name="case" type="text" class="form-control" value="{{$mota->vocase}}">
                        <span style="color:red">{{$errors->first('')}}</span>
                        </div>
                    
                </div>
                </div>
                @endforeach
                <!--end mota__pc-->
                    <br/>           
                    <!---end foreach mo ta--->  
                    <div class="row justify-content-around">
                       <button class="btn_ok" type="submit" name="btn_edit" class="btn btn-primary">Thực hiện</button>
                   </div>
             </form>
             <hr/>
                            <div class="row">
                                <div class="box__list--img col-lg-8">
                                     <div class="col-lg-12">
                                        <h4>Hình ảnh sản phẩm</h4>
                                        <span id="note__check"></span>
                                    </div>
                                    <br/>
                            @if($hinh != null)
                              
                             @foreach($hinh as $hinh)
                                <div class="item__img">
                                    <img src="{{{'../public/images/products/'.$hinh->spHinh}}}" width="180" height="180" alt="loading">
                                    <br/>
                                    <table border="1">
                                        <tr>
                                            @if($hinh->thutu == 1)
                                            <td class="text-light btn-dark">
                                                Đang là ảnh mặc định
                                            </td>
                                            @else
                                            <td class="btn__chose">
                                             <a  href="{{URL::asset('editHinhStt/'.$hinh->spHinh."/".$hinh->spMa)}}">Chọn ảnh mặc định</a>
                                            </td>
                                            <td class="btn__delete">
                                               <a href="{{URL::asset('xoahinh/'.$hinh->spHinh."/".$hinh->spMa)}}">
                                                    <i class="fa far fa-trash"></i>
                                               </a>
                                            </td>
                                            @endif
                                            
                                        </tr>
                                    </table>
                                    <button id="btn__statusSP" type="submit" hidden>Đổi trạng thái</button>
                                   
                                  </div>
                                  &emsp;&emsp;
                             @endforeach
                            </div>
                            @else
                            <span></span>
                            @endif
                            <div class="col-lg-4" style="border-left: 1px solid black;">
                                   <h4>Ảnh mới</h4>
                            <br/>
                            <form action="{{URL::asset('/themhinh')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input name="spMa" type="text" hidden value="{{$value->spMa}}" />
                               
                                <span id="btnCancel"><i class="fas fa-times" style="font-size: 20px;"></i></span>
                                <div id="box__img" class="box__img">
                                    <span class="text">Chưa có ảnh</span>
                                    <img id="img" src="" alt="" />
                                </div>
                                <div class="col-lg-12 text-center">
                                <input id="inputImg" name="img" type="file" class="form-control" accept="image/x-png,image/gif,image/jpeg,image/png,image/jpg">
                               
                                <label for="exampleInputPassword1" class="form-label"></label>
                                <label id="btnImg" class="lb__spHinh" onclick="defaultAction()"><i class="fas fa-file-upload" >&nbsp;Chọn ảnh</i></label>
                                <div class="row justify-content-around">
                                    <button id="btnImg__editSP" class="btn btn-success" type="submit">Xác nhận</button>
                                 </div>
                            </div>
                                </div>
                                @if(Session::has('img_err'))
                                {{Session::get('img_err')}}
                                @endif
                                </div>
                            </form>
                            </div>
                        </div>
                          
                    <br/>            
        </div> 
@endforeach
    </div>
    <script src="{{URL::asset('public/style_admin/js/previewImgInputFile4.js')}}"></script>
@endsection


    


 <br/>



