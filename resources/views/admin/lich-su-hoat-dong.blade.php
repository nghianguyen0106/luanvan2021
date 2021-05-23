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
                            <h6 class="m-0 font-weight-bold text-primary">Quản lý loại</h6>
                            <hr/>	
                            <form action="{{url('tim-kiem-lshd')}}" method="GET">
                                <select name="alNgaygio">
                                    @foreach($ngaygio as $value)
                                    <option value="{{$value->alNgaygio}}">{{strftime("%Y-%m-%d",strtotime($value->alNgaygio))}}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-info" type="submit">Tìm</button>
                            </form>
                        </div>
                    	<br/>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã loại</th>
                                            <th>Tên loại</th>
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>Mã loại</th>
                                            <th>Chi tiết hoạt động</th>
                                            <th>Thời gian thực hiện</th>
                                           
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->adTaikhoan}}</td>
                                            <td>{{$value->alChitiet}}</td>
                                            <td>{{$value->alNgaygio}}</td>

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