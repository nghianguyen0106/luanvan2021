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
                            <h1 class="m-0 font-weight-bold text-primary text-center">Quản lý banner</h1>
                        </div>
                        <div class="card-body">
                             <span>Trang hiển thị :&nbsp;</span>
                            <select id="chon__trang" class="btn btn-outline-info">
                                @if($page == 1)
                                <option value="1" selected>Trang chủ</option>
                                <option value="2">Sản phẩm</option>
                                @else
                                <option value="2" selected>Sản phẩm</option>
                                <option value="1">Trang chủ</option>
                                @endif
                            </select>
                            &emsp;&emsp;
                             <a  href="{{url('/vi-tri-banner/'.$page)}}" class="btn btn-primary">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"style="color:white;font-weight: bold"></i>
                                        </span>
                                        <span class="text"><b>Thêm banner</b></span>
                                    </a>
                                    <br/><br/>
                            <span>Vị trí banner:&nbsp;</span>
                            <!----->
                            <select id="chon__vitri" class="btn btn-outline-info">
                                @if($vtEmpty == 0)
                                    <option value="0" selected>Chưa có vị trí được thêm
                                    </option>
                                <!--------Chưa có vị trí 1------->
                                 @elseif($vt1Empty==0)
                                    @if($vtDefault2==null)
                                     @foreach($vtTop as $vt) 
                                         @foreach($vitri as $value)  
                                             @if($value->bnVitri == $vt->bnVitri)
                                                <option value="{{$value->bnVitri}}" selected>Vị trí {{$value->bnVitri}}</option>
                                             @else
                                                <option value="{{$value->bnVitri}}">Vị trí {{$value->bnVitri}}</option>
                                             @endif
                                        @endforeach 
                                        @endforeach  
                                    @elseif($vtDefault2!=null)
                                      @foreach($vtDefault as $vt)
                                        @foreach($vitri as $value)  
                                         @if($value->bnVitri == $vt->bnVitri)
                                            <option value="{{$value->bnVitri}}" selected>Vị trí {{$value->bnVitri}}</option>
                                         @else
                                            <option value="{{$value->bnVitri}}">Vị trí {{$value->bnVitri}}</option>
                                         @endif
                                         @endforeach
                                    @endforeach 
                                    @endif  
                                
                                <!-----Đã có vị trí 1---->
                                @elseif($vt1Empty!=0)
                                    @foreach($vtDefault as $vt)
                                     @foreach($vitri as $value)  
                                         @if($value->bnVitri == $vt->bnVitri)
                                            <option value="{{$value->bnVitri}}" selected>Vị trí {{$value->bnVitri}}</option>
                                         @else
                                            <option value="{{$value->bnVitri}}">Vị trí {{$value->bnVitri}}</option>
                                         @endif
                                         @endforeach
                                    @endforeach 
                                
                                @endif
                            </select>
                            <!----->
                            <br/><br/>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Tiêu đề</th>
                                            <th>Banner</td>
                                            
                                            <th>Cập nhật</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display:none;">
                                        <tr>
                                            <th>Tiêu đề</th>
                                            <th>Banner</td>
                                           
                                            <th>Cập nhật</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->bnTieude}}</td>
                                            @if($value->bnVitri == 1 && $value->bnTrang == 1)
                                            <td style="text-align: center; margin: 0;padding: 0;width: 50%;">
                                                
                                                <img src="{{URL::asset('public/images/banners/'.$value->bnHinh)}}" style="width: 100%;" height="60" />
                                            </td>
                                            @elseif($value->bnVitri == 3 && $value->bnTrang == 1)
                                            <td>
                                               <video muted loop autoplay>
                                                   <source src="{{URL::asset('public/images/banners/'.$value->bnHinh)}}" type="video/mp4">
                                               </video>
                                            </td>
                                             @else
                                                <td>
                                                <img src="{{URL::asset('public/images/banners/'.$value->bnHinh)}}" width="450" height="200" /></td>
                                                @endif
                                            <td>{{$value->bnNgay}}</td>
                                            <td>
                                                <a class="btn btn-danger" href="{{url('/deleteBanner/'.$value->bnMa)}}" >
                                                  Xóa
                                                </a>
                                            </td>

                                        </tr>
                                        @endforeach
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

<script>
    var trang = document.getElementById("chon__trang");
    trang.addEventListener("change", function(){
        if(trang.value == 1)
        { 
           location.replace('{{URL::to('adBanner/'."1"."/"."1")}}');
        }
        if(trang.value == 2)
        {
           location.replace('{{URL::to('adBanner/'."2"."/"."1")}}');
        }
    });
    var vitri = document.getElementById("chon__vitri");
    vitri.addEventListener("change", function(){
        if(vitri.value == 1)
        { 
           window.location=1; 
        }
        if(vitri.value == 2)
        {
           window.location=2;
        }
        if(vitri.value == 3)
        {
           window.location=3;
        }
        if(vitri.value == 4)
        {
           window.location=4;
        }
        if(vitri.value == 5)
        {
           window.location=5;
        }
        if(vitri.value == 6)
        {
           window.location=6;
        }
        if(vitri.value == 7)
        {
           window.location=7;
        }
        if(vitri.value == 8)
        {
           window.location=8;
        }
    });
</script>

  @endsection