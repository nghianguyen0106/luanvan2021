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
                            <h2 class="m-0 font-weight-bold text-primary text-center">Quản lý loại</h2>
                            <hr/>
                            	<form class="form-inline" action="{{URL::to('checkAddLoai')}}" method="GET">

									 {{ csrf_field() }}
								    <label for="exampleInputPassword1" class="form-label">Tên loại</label>
								    &emsp;
								    <input  name="loaiTen" type="text" class="form-control check">
								      <span style="color:red">
								     	@if(Session::has('loai_err')!=null)
								     		{{Session::get('loai_err')}}
								     	@endif
								     </span>
								 	<span style="color:red">{{$errors->first('loaiTen')}}</span>
                                    <span class="err__empty"></span>
								 	 &emsp;
								  <button style="outline: none;" class="btn_ok btn__update" type="submit" name="btn_edit" class="btn btn-primary">Thực hiện</button>
								</form>
                        </div>
                    	<br/>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã loại</th>
                                            <th>Tên loại</th>
                                            <th></th>
                                             <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot style="display:none;">
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
                                            <td><input  class="check"  name="loaiTen" value="{{$value->loaiTen}}"/><br/>
                                                <span class="err__empty"></span>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn__update" type="submit" class="active" ui-toggle-class="">
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
<script src="{{URL::asset('public/fe/js/js-validate/validate-empty.js')}}"></script>
  @endsection