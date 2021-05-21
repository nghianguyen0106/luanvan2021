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
                            <hr/>
                                <form class="form-inline " action="{{URL::to('checkAddBanner')}}" method="POST" enctype="multipart/form-data">
                                     {{ csrf_field() }}
                                 
                                      <div class="flex__form" >
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Tiêu đề banner:</label>
                                        <input name="bnTieude" type="text" class="form-control" id="bnTieude">
                                         <span style="color:red">{{$errors->first('bnTieude')}}</span>
                                      </div>
                                       <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Thêm hình ảnh cho banner:</label>
                                        <input name="bnHinh" type="file" class="form-control" id="bnHinh">
                                        
                                      </div>
                                       <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Vị trí:</label>
                                        <input name="bnVitri" type="radio" value="0" class="form-control" id="bnVitri">&nbsp;Slide &emsp;
                                        <input name="bnVitri" type="radio" value="1" class="form-control" id="bnVitri">&nbsp;Banner con&emsp;
                                        <input name="bnVitri" type="radio" value="2" class="form-control" id="bnVitri">&nbsp;Banner quảng cáo
                                         <span style="color:red">{{$errors->first('bnVitri')}}</span>
                                      </div>
                                    </div>
                                  </div>
                                    <span style="color:red">
                                        @if(Session::has('bnError'))
                                            {{Session::get('bnError')}}

                                        @endif
                                    </span>

                                    <div>
                                        <button type="submit" name="btn_add" class="btn btn-primary">Thực hiện</button>
                                    </div>
                                </form>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tiêu đề</th>
                                            <th>Banner</td>
                                            <th>Vị trí</td>
                                            <th>Ngày tạo</td>
                                            <th>Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
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