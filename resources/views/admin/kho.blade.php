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
                            <h6 class="m-0 font-weight-bold text-primary">Quản lý kho</h6>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã sản phẩm</th>
                                            <th>Số lượng sản phẩm</th>
                                            <th>Ngày cập nhật</th>
                                             <th>Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Mã sản phẩm</th>
                                            <th>Số lượng sản phẩm</th>
                                            <th>Ngày cập nhật</th>
                                             <th>Cập nhật</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->spMa}}</td>
                                            <form action="{{URL::to('/editKho/'.$value->spMa)}}" method="POST">
                                            {{ csrf_field() }}
                                            <td>
                                                <input type="number" value="{{$value->khoSoluong}}" name="khoSoluong"/>
                                            </td>
                                            <td>{{$value->khoNgaynhap}}</td>
                                            <td>
                                             <button class="btn btn-primary" type="submit">Cập nhật</button>
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
 