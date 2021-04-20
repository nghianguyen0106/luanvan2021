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
                                <label for="exampleInputPassword1" class="form-label">Số lượng</label>
                                @foreach($kho as $kho)
                                <input class="form-control" name="khoSoluong" type="number"  value="{{$kho->khoSoluong}}"/>
                                     <span style="color:red">{{$errors->first('khoSoluong')}}</span>
                               @endforeach
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
                           <label for="exampleInputPassword1" class="form-label">Khuyến mãi </label>
         			         @foreach($kmOld as $kmOld)
                            <select class="form-control" style="width: 205px" name="kmMa">
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
                                        @foreach($thMa as $th)
                                            <option  value="{{$th->thMa}}">{{$th->thTen}}</option>
                                        @endforeach
                                    </select>
                        </div>
                        <div class="mb-3">
                           <label for="exampleInputPassword1" class="form-label">Loại</label>
                            @foreach($loaiOld as $loaiOld) 
                                 <select class="form-control" style="width: 205px" name="loaiMa">
                               <option value="{{$loaiOld->loaiMa}}">{{$loaiOld->loaiTen}}</option>
                               @foreach($loaiMa as $loai)
                                  <option  value="{{$loai->loaiMa}}">{{$loai->loaiTen}}</option>
                               @endforeach
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

                    <hr/>
                    
                     <h4>Mô tả chi tiết</h4>
                     <br/>
         			@foreach($mota as $mota)
             			 <div class="flex__form">
             				 <div class="mb-3">
                               <label for="exampleInputPassword1" class="form-label">Màn hình</label>	
             				   <input class="form-control" name="manhinh" type="text" value="{{$mota->manhinh}}"/>
                            </div>
                             <div class="mb-3">
                               <label for="exampleInputPassword1" class="form-label">Chuột</label>
                               <input class="form-control" name="chuot" type="text" value="{{$mota->chuot}}"/>
                            </div>
                            <div class="mb-3">
                               <label for="exampleInputPassword1" class="form-label">Bàn phím</label>
                               <input class="form-control" name="banphim" type="text" value="{{$mota->banphim}}"/>
                            </div>
                            <div class="mb-3">
                               <label for="exampleInputPassword1" class="form-label">RAM</label>
                               <input class="form-control" name="ram" type="text" value="{{$mota->ram}}"/>
                               <span style="color:red">{{$errors->first('ram')}}</span>
                            </div>
                        </div>
             			<br/>
                         <div class="flex__form">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">PSU</label>
                                <input class="form-control" name="psu" type="text" value="{{$mota->psu}}" />
                                <span style="color:red">{{$errors->first('psu')}}</span>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Mainboard</label>
                                <input class="form-control" name="mainboard" type="text" value="{{$mota->mainboard}}"/>
                                <span style="color:red">{{$errors->first('mainboard')}}</span>
                             </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">VGA</label>
                                <input class="form-control" name="vga" type="text" value="{{$mota->vga}}"/>
                                <span style="color:red">{{$errors->first('vga')}}</span>
                            </div>
                             <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Ổ cứng</label>
                                <input class="form-control" name="ocung" type="text" value="{{$mota->ocung}}"/>
                                <span style="color:red">{{$errors->first('ocung')}}</span>
                             </div>
                         </div>
                         <br/>
             			<div class="flex__form">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Vỏ case</label>
                                <input class="form-control" name="vocase" type="text" value="{{$mota->vocase}}"/>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">PIN</label>
                                <input class="form-control" name="pin" type="text" value="{{$mota->pin}}"/>
                            </div>
                             <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tản nhiệt</label>
                                <input class="form-control" name="tannhiet" type="text"value="{{$mota->tannhiet}}" />
                                <span style="color:red">{{$errors->first('tannhiet')}}</span>
                             </div>
                              <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Loa</label>
                                <input class="form-control" name="loa" type="text" value="{{$mota->loa}}" />
                             </div>
                        </div>
                    @endforeach
                    <br/>			
         			<!---end foreach mo ta--->  
		            <div class="flex__form"><button type="submit" class="btn-primary" >Cập nhật</button></div>	
    		 </form>
             
                            <h4>Hình ảnh sản phẩm</h4>
                             <form action="{{url('/themhinh')}}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input hidden name="spMa" value="{{$value->spMa}}" />
                                <input type="file" name="img"  />
                                @if(Session::has('img_err'))
                                {{Session::get('img_err')}}
                                @endif
                                <button type="submit" class="btn-link" name="btnTH">Thêm hình</button>
                            </form>
                            <div style="display: flex;flex-direction: row; flex-wrap: wrap;padding: 10px 10px; height: 350px;overflow-y: scroll;">
                             @foreach($hinh as $hinh)
                                 <div style="width: 160px;margin-top: 1rem;margin-left: 2rem ">
                                    <img src="{{{'../public/images/products/'.$hinh->spHinh}}}" width="180" height="180" alt="loading">
                                   <a style="padding: 5px 20px 5px 20px" href="{{url('xoahinh/'.$hinh->spHinh."/".$hinh->spMa)}}" class="btn-danger">Xóa</a>
                                  </div>
                             @endforeach

                            </div>
    		             
		</div> 
@endforeach
	</div>
	
@endsection