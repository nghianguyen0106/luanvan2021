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
                            <h6 class="m-0 font-weight-bold text-primary">Quản lý banner </h6>
                            <hr/>
                                <form class="form-inline " action="{{URL::to('checkAddBanner')}}" method="POST" enctype="multipart/form-data">
                                     {{ csrf_field() }}
                                  <div class="mb-3">
                                    <br/>
                                     
                                    <span>Thêm hình ảnh cho banner:</span>
                                    <input name="bnHinh" type="file" class="form-control" id="bnHinh">
                                  </div>
                                    <span style="color:red">
                                        @if(Session::has('bnError'))
                                            {{Session::get('bnError')}}

                                        @endif
                                    </span>
                                    &emsp;
                                  <button type="submit" name="btn_add" class="btn btn-primary">Thực hiện</button>
                                </form>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã banner</th>
                                            <th>Banner</td>
                                            <th>Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Mã banner</th>
                                            <th>Banner</td>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->bnMa}}</td>
                                            <td style="text-align: center"><img src="{{"public/images/banners/".$value->bnHinh}}" width="500" height="200" /></td>
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

                </div>
                <!-- /.container-fluid -->

  @endsection