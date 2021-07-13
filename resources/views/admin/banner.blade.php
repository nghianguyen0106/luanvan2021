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
                            <h1 class="m-0 font-weight-bold text-primary">Quản lý banner </h1>
                        </div>
                        <div class="card-body">
                            <span>Chọn danh sách banner:&nbsp;</span>
                            <select id="chon__vitri" class="btn btn-outline-info">
                                @foreach($default as $vt)
                                     @foreach($vitri as $v)
                                     @if($v->bnVitri == $vt->bnVitri)
                                     <option value="{{$v->bnVitri}}" selected>Vị trí {{$v->bnVitri}}</option>
                                     @else
                                     <option value="{{$v->bnVitri}}">Vị trí {{$v->bnVitri}}</option>
                                     @endif
                                    @endforeach 
                                @endforeach
                            </select>
                            &emsp;
                             <a  href="{{url('/vi-tri-banner')}}" class="btn btn-primary">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"style="color:white;font-weight: bold"></i>
                                        </span>
                                        <span class="text"><b>Thêm banner</b></span>
                                    </a>
                                    <br/><br/>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Tiêu đề</th>
                                            <th>Banner</td>
                                            <th>Vị trí</td>
                                            <th>Ngày tạo</td>
                                            <th>Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display:none;">
                                        <tr>
                                            <th>Tiêu đề</th>
                                            <th>Banner</td>
                                            <th>Vị trí</td>
                                            <th>Ngày tạo</td>
                                            <th>Cập nhật</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->bnTieude}}</td>
                                            <td style="text-align: center">
                                                @if($value->bnVitri == 1)
                                                <img src="{{URL::asset('public/images/banners/'.$value->bnHinh)}}" width="500" height="60" /></td>
                                                @else
                                                <img src="{{URL::asset('public/images/banners/'.$value->bnHinh)}}" width="450" height="200" /></td>
                                                @endif
                                            <td>
                                             {{$value->bnVitri}}
                                               
                                            </td>
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