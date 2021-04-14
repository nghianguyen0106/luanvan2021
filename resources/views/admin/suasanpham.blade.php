@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">
@foreach($spMaCu as $key => $value)
            <!-- Main Content -->
             <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Xem chi tiết và cập nhật sản phẩm</h6>
                        </div>
        	<div id="content" class="col-12">
        	 <form action="{{URL::to('/editSanpham/'.$value->spMa)}}" method="POST"  enctype="multipart/form-data">
         		{{ csrf_field() }}
         		<table border="1" style="width: 80%;">
         			<tr style="text-align: center;">
         				<td>Thuộc tính</td>
         			
         				<td>Form điền thông tin cần thay đổi</td>
         			</tr>
         			<tr>
         				<td >Mã sản phẩm</td>
         				
         				<td><input readonly name="spMa" type="text" value="{{$value->spMa}}" /></td>
         			</tr>
         			<tr>
         				<td >Tên sản phẩm</td>
         				
         				<td><input name="spTen" type="text"  value="{{$value->spTen}}"/>
                             <span style="color:red">{{$errors->first('spTen')}}</span>
                      </td>
         			</tr>
         			<tr>
         				<td >Giá</td>
         				
         				<td><input name="spGia" type="number"  value="{{$value->spGia}}"/>
                             <span style="color:red">{{$errors->first('spGia')}}</span>
                       </td>
         			</tr>
         			<tr>
         				<td >Tình trạng</td>
         				
         				<td><input name="spTinhtrang" type="number"  value="{{$value->spTinhtrang}}"/>
                             <span style="color:red">{{$errors->first('spTinhtrang')}}</span>
                       </td>
         			</tr>
         			<tr>
         				<td >Hạn bảo hành</td>
         				
         				<td><input name="spHanbh" type="number" value="{{$value->spHanbh}}"/>
                             <span style="color:red">{{$errors->first('spHanbh')}}</span>
                    </td>
         			</tr>
         			<tr>
                    
                     <td >Khuyến mãi</td>
                      @foreach($kmOld as $kmOld)
                    
                     <td>
                        <select name="kmMa">
                           <option value="{{$kmOld->kmMa}}">{{$kmOld->kmTrigia}}</option>
                         @endforeach
                           @foreach($kmMa as $km)
                              <option  value="{{$km->kmMa}}">{{$km->kmTrigia}}</option>
                           @endforeach
                        </select>
                       
                     </td>
                    
                  </tr>
         			<tr>
         				
         				<td >Thương hiệu</td>
                     @foreach($thOld as $thOld)
         				
         				<td>
         					<select name="thMa">
         						<option value="{{$thOld->thMa}}">{{$thOld->thTen}}</option>
                           @endforeach
         						@foreach($thMa as $th)
         							<option  value="{{$th->thMa}}">{{$th->thTen}}</option>
         						@endforeach
         					</select>
                       
         				</td>
         				
         			</tr>
         			<tr>
         				@foreach($loaiOld as $loaiOld)
         				<td >Loại</td>
         				
         				<td>
         					 <select name="loaiMa">
                           <option value="{{$loaiOld->loaiMa}}">{{$loaiOld->loaiTen}}</option>
                           @foreach($loaiMa as $loai)
                              <option  value="{{$loai->loaiMa}}">{{$loai->loaiTen}}</option>
                           @endforeach
                        </select>
                       
         				</td>
         				@endforeach
         			</tr>
         			<tr>
         				<td >Nhu cầu</td>
         				@foreach($ncOld as $ncOld)
         				
         				<td>
         					<select name="ncMa">
         						<option value="{{$ncOld->ncMa}}">{{$ncOld->ncTen}}</option>
         						@foreach($ncMa as $nc)
         							<option value="{{$nc->ncMa}}">{{$nc->ncTen}}</option>
         						@endforeach
         					</select>
                       
         				</td>
         				@endforeach
         			</tr>
         			@foreach($mota as $mota)
         			<tr>
         				<td> Màn hình</td>
         				
         				<td><input name="manhinh" type="text" value="{{$mota->manhinh}}"/>
                    </td>
         			</tr>
         			<tr>
         				<td>Chuột</td>
         			
         				<td><input name="chuot" type="text" value="{{$mota->chuot}}"/>
                    </td>
         			</tr>
         			<tr>
         				<td>Bàn phím</td>
         				
         				<td><input name="banphim" type="text" value="{{$mota->banphim}}"/>
                    </td>
         			</tr>
         			<tr>
         				<td> RAM</td>
         				
         				<td><input name="ram" type="text" value="{{$mota->ram}}"/>
                             <span style="color:red">{{$errors->first('ram')}}</span>
                    </td>
         			</tr>
         			<tr>
		                <td> PSU</td>
		                
		                <td><input name="psu" type="text" value="{{$mota->psu}}" />
                             <span style="color:red">{{$errors->first('psu')}}</span>
                     </td>
		             </tr>	
		             <tr>
		                <td> Mainboard</td>
		               
		                <td><input name="mainboard" type="text" value="{{$mota->mainboard}}"/>
                             <span style="color:red">{{$errors->first('mainboard')}}</span>
                     </td>
		             </tr>	
		              <tr>
		                <td>VGA</td>
		               
		                <td><input name="vga" type="text" value="{{$mota->vga}}"/>
                             <span style="color:red">{{$errors->first('vga')}}</span>
                     </td>
		             </tr>	
		              <tr>
		                <td>Ổ cứng</td>
		               
		                <td><input name="ocung" type="text" value="{{$mota->ocung}}"/>
                             <span style="color:red">{{$errors->first('ocung')}}</span>
                    </td>
		             </tr>	
		              <tr>
		                <td>Vỏ case</td>
		                
		                <td><input name="vocase" type="text" value="{{$mota->vocase}}"/>
                      </td></td>
		             </tr>	
		              <tr>
		                <td>PIN</td>
		                
		                <td><input name="pin" type="text" value="{{$mota->pin}}"/>
                      </td></td>
		             </tr>	
		              <tr>
		                <td> Tản nhiệt</td>
		               
		                <td><input name="tannhiet" type="text"value="{{$mota->tannhiet}}" />
                             <span style="color:red">{{$errors->first('tannhiet')}}</span>
                      </td></td>
		             </tr>	
		              <tr>
		                <td> Loa</td>
		               
		                <td><input name="loa" type="text" value="{{$mota->loa}}" />
                      </td></td>
		             </tr>	
         			@endforeach
         			<!---end foreach mo ta--->
         			 <tr style="height: 500px">
		             	<td>Hình ảnh sản phẩm</td>
		             	<td colspan="2" >
                            <div style="display: flex;flex-direction: row; flex-wrap: wrap;padding: 10px 10px;justify-content: space-around; height: 350px;overflow-y: scroll;">
		             		 @foreach($hinh as $hinh)
                             <div style="width: 160px;margin-top: 1rem ">
		             		 	<img src="{{{'../public/images/products/'.$hinh->spHinh}}}" width="150" height="150" alt="loading">

                           <a style="padding: 5px 20px 5px 20px" href="{{url('xoahinh/'.$hinh->spHinh."/".$hinh->spMa)}}" class="btn-danger">Xóa</a>

                          </div>

		             		 @endforeach
                            </div>
		             	</td>
		             
		             </tr>
		             <tr><td colspan="3"> <button type="submit" class="btn-primary" >Cập nhật</button></tr>
         			
         		</table>
         			
    		 </form>
    		 <form action="{{url('/themhinh')}}" method="post" enctype="multipart/form-data">
		             			{{ csrf_field() }}
		             			<input hidden name="spMa" value="{{$value->spMa}}" />
		             			<input type="file" name="img"  />
		             			@if(Session::has('img_err'))
		             			{{Session::get('img_err')}}
		             			@endif
		             			<button type="submit" class="btn-link" name="btnTH">Thêm hình</button>
		             		</form>
		</div> 
@endforeach
	</div>
	
@endsection