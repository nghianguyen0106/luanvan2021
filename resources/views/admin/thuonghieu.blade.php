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
                            <h2 class="m-0 font-weight-bold text-primary text-center">Quản lý thương hiệu</h2>
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
                              <button style="outline: none;" type="submit" name="btn_edit" class="btn btn-primary ">Thực hiện</button>
                            </form>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã thương hiệu</th>
                                            <th>Tên thương hiệu</th>
                                           <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot  style="display:none;">
                                        <tr>
                                            <th>Mã thương hiệu</th>
                                            <th>Tên thương hiệu</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                           <td>{{$value->thMa}}</td>
                                           <form action="{{URL::to('/editThuonghieu/'.$value->thMa)}}" method="GET">
                                         {{ csrf_field() }}
                                            <td><input name="thTen" value="{{$value->thTen}}" /></td>
                                            <td>
                                                <button type="submit" class="btn btn-primary " ui-toggle-class="">Cập nhật</button>
                                            </td>
                                            <td>
                                             <a class="btn btn-danger" href="{{url('deleteThuonghieu/'.$value->thMa)}}">
                                                    Xóa
                                                </a></td>
                                        </form>
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