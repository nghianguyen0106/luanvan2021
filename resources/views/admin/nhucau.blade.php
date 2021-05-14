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
                            <h6 class="m-0 font-weight-bold text-primary">Quản lý nhu cầu sản phẩm</h6>
                            <hr/>
                            <form class="form-inline" action="{{URL::to('/checkAddNhucau')}}" method="GET">
                             {{ csrf_field() }}     
                            <label for="exampleInputPassword1" class="form-label">Nhu cầu sử dụng</label>
                            &emsp;
                            <input name="ncTen" type="text" class="form-control" id="ncTen">
                              <span style="color:red">
                                @if(Session::has('nc_err')!=null)
                                    {{Session::get('nc_err')}}
                                @endif
                             </span>
                             &emsp;
                            <span style="color:red">{{$errors->first('ncTen')}}</span>
                          <button class="btn_ok" type="submit" name="btn_edit" class="btn btn-primary">Thực hiện</button>
                        </form>
                        </div>
                        @if(Session::has('nc_del')!=null)
                            {{Session::get('nc_del')}}
                        @endif
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã nhu cầu</th>
                                            <th>Tên nhu cầu</td>
                                            <th>Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Mã nhu cầu</th>
                                            <th>Tên nhu cầu</td>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->ncMa}}</td>
                                            <td>{{$value->ncTen}}</td>
                                            <td>
                                                <a> <a href="{{url('/updateNhucau/'.$value->ncMa)}}" class="active" ui-toggle-class="">
                                                    <i class="fa far fa-edit"></i>
                                                </a>&nbsp;|
                                                <a href="{{url('/deleteNhucau/'.$value->ncMa)}}" >
                                                    <i class="fa fas fa-trash" style="color: red;"></i>
                                                </a></a>
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