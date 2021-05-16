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
                            	<form class="form-inline" action="{{URL::to('checkAddLoai')}}" method="GET">

									 {{ csrf_field() }}
								    <label for="exampleInputPassword1" class="form-label">Tên loại</label>
								    &emsp;
								    <input name="loaiTen" type="text" class="form-control" id="loaiTen">
								      <span style="color:red">
								     	@if(Session::has('loai_err')!=null)
								     		{{Session::get('loai_err')}}
								     	@endif
								     </span>
								 	<span style="color:red">{{$errors->first('loaiTen')}}</span>
								 	 &emsp;
								  <button style="outline: none;" class="btn_ok" type="submit" name="btn_edit" class="btn btn-primary">Thực hiện</button>
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
                                             <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th>Mã loại</th>
                                            <th>Tên loại</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data as $value)
                                        <tr>
                                            <td>{{$value->loaiMa}}</td>

                                        <form action="{{URL::to('/editLoai/'.$value->loaiMa)}}" method="POST">
                                             {{ csrf_field() }}
                                            <td><input name="loaiTen" value="{{$value->loaiTen}}"/></td>
                                            <td>
                                                <button class="btn btn-primary" type="submit" class="active" ui-toggle-class="">
                                                   Cập nhật
                                                </button>
                                            </td>
                                        </form>
                                            <td> <a class="btn btn-danger" href="{{URL::to('/deleteLoai/'.$value->loaiMa)}}" >
                                                   Xóa
                                                </a></td>

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