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
                             <a  href="{{url('/them-banner')}}" class="btn btn-primary">
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
                                            <td>{{-- {{$value->bnTieude}} --}}</td>
                                            <td style="text-align: center"><img src="{{"public/images/banners/".$value->bnHinh}}" width="450" height="200" /></td>
                                            <td>
                                                @if($value->bnVitri==0)
                                                Slide
                                                @elseif($value->bnVitri==1)
                                                Banner con
                                                @else
                                                Banner quảng cáo
                                                @endif
                                                
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

               
                <!-- /.container-fluid -->

  @endsection