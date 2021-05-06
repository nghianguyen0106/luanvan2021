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
                            <h6 class="m-0 font-weight-bold text-primary">Quản lý khuyến mãi</h6>
                            <hr/>

                        </div>
                        <form action="{{URL::to('/checkAddKhuyenmai')}}" method="POST">
                             {{ csrf_field() }}
                          <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Giá trị khuyến mãi</label>
                            <input name="kmTrigia" type="number" class="form-control" id="kmTrigia">
                              
                          </div>
                            <span style="color:red">{{$errors->first('kmTrigia')}}</span>
                          <button type="submit" name="btn_add" class="btn btn-primary">Thực hiện</button>
                        </form>
                        <br/>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã khuyến mãi</th>
                                            <th>Trị giá</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Mã khuyến mãi</th>
                                            <th>Trị giá</th>
                                             <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->kmMa}}</td>
                                            <td>{{$value->kmTrigia}}%</td>
                                            <td>
                                                <a  href="{{url('deleteKhuyenmai/'.$value->kmMa)}}">
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