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
                            <h6 class="m-0 font-weight-bold text-primary">Quản lý thương hiệu</h6>
                            <hr/>
                            <form class="form-inline" action="{{URL::to('checkAddThuonghieu')}}" method="GET">
                                 {{ csrf_field() }}
                                
                                <label for="exampleInputPassword1" class="form-label">Tên thương hiệu</label>
                                &emsp;
                                <input name="thTen" type="text" class="form-control" id="thTen">
                                 <span style="color:red">
                                    @if(Session::has('th_err')!=null)
                                        {{Session::get('th_err')}}
                                    @endif
                                 </span>
                              &emsp;
                                <span style="color:red">{{$errors->first('thTen')}}</span>
                              <button class="btn_ok" type="submit" name="btn_edit" class="btn btn-primary">Thực hiện</button>
                            </form>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã thương hiệu</th>
                                            <th>Tên thương hiệu</th>
                                           
                                            <th>Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Mã thương hiệu</th>
                                            <th>Tên thương hiệu</th>
                                           
                                            <th>Cập nhật</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                           <td>{{$value->thMa}}</td>
                                            <td>{{$value->thTen}}</td>
                                            <td>
                                                <a> <a href="{{url('updateThuonghieu/'.$value->thMa)}}" class="active" ui-toggle-class="">
                                                    <i class="fa far fa-edit"></i>
                                                </a>&nbsp;|
                                                <a href="{{url('deleteThuonghieu/'.$value->thMa)}}">
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