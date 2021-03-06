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
                            <h2 class="m-0 font-weight-bold text-primary text-center">Quản lý kho</h2>

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                   <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Mã serial</th>
                                            <th>Tình trạng</th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display:none;">
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Mã serial</th>
                                            <th>Tình trạng</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->spTen}}</td>
                                            <td>
                                               {{$value->serMa}}
                                            </td>
                                            <td>{{$value->serTinhtrang==0?"Chưa bán":"Đã bán"}}</td>
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

          