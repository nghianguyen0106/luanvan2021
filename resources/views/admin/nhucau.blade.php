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
                            <h2 class="m-0 font-weight-bold text-primary text-center">Quản lý nhu cầu</h2>
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
                          <button style="outline: none;" class="btn_ok" type="submit" name="btn_edit" class="btn btn-primary">Thực hiện</button>
                        </form>
                        </div>
                        @if(Session::has('nc_del')!=null)
                            {{Session::get('nc_del')}}
                        @endif
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã nhu cầu</th>
                                            <th>Tên nhu cầu</td>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot  style="display:none;">
                                        <tr>
                                            <th>Mã nhu cầu</th>
                                            <th>Tên nhu cầu</td>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->ncMa}}</td>

                                    <form action="{{URL::to('/editNhucau/'.$value->ncMa)}}" method="GET">
                                         {{ csrf_field() }}
                                            <td><input name="ncTen" value="{{$value->ncTen}}"/></td>
                                            <td>
                                               <button class="btn btn-primary" ui-toggle-class="">Cập nhật </button>
                                           </td>
                                           <td>
                                            <a class="btn btn-danger" href="{{url('/deleteNhucau/'.$value->ncMa)}}" >
                                                    Xóa
                                                </a>
                                            </td>
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