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
                            <h6 class="m-0 font-weight-bold text-primary">Quản lý loại khuyến mãi</h6>
                            <hr/>
                                <form class="form-inline" action="{{URL::to('checkAddLoaikhuyenmai')}}" method="post">

                                     {{ csrf_field() }}
                                    <label for="exampleInputPassword1" class="form-label">Thêm loại khuyến mãi</label>
                                    &emsp;
                                    <input name="lkmTen" type="text" class="form-control" id="lkmTen">
                                    <span style="color:red">{{$errors->first('lkmTen')}}</span>
                                     &emsp;
                                  <button style="outline: none;" class="btn btn-success" type="submit" name="btn_edit" class="btn btn-primary">Thực hiện</button>
                                </form>
                        </div>
                        <br/>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã nhà cung cấp</th>
                                            <th>Tên nhà cung cấp</th>
                                            <th></th>
                                             
                                        </tr>
                                    </thead>
                                    
                                    <tbody>

                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->nccMa}}</td>
                                            <td>{{$value->nccTen}}</td>
                                           <td>
                                                <a  href="{{URL::to('suaNhacungcappage/'.$value->nccMa)}}">
                                                    <i class="fa fas fa-edit" style="color: blue;"></i>
                                                </a>
                                                <a  href="{{URL::to('deleteNhacungcap/'.$value->nccMa)}}">
                                                    <i class="fa fas fa-trash" style="color: red;"></i>
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