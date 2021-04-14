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
                            <h6 class="m-0 font-weight-bold text-primary">Quản lý sản phẩm</h6>
                        </div>
                        <br/>
                         <a  href="{{url('/themsanpham')}}" class="btn btn-primary " style="width: 20%;">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"style="color:white;font-weight: bold"></i>
                                        </span>
                                        <span class="text"><b>Thêm sản phẩm</b></span>
                                    </a>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                             <th>Tình trạng</th>
                                            <th>Hạn bảo hành</th>
                                            <th>Khuyến mãi</th>
                                            <th>Thương hiệu</th>
                                            <th>Loại</th>
                                            <th>Nhu cầu</th>
                                            
                                            <th>Cập nhật</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá</th>
                                            <th>Tình trạng</th>
                                            <th>Hạn bảo hành</th>
                                            <th>Khuyến mãi</th>
                                            <th>Thương hiệu</th>
                                            <th>Loại</th>
                                            <th>Nhu cầu</th>
                                            
                                             <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                           <th>{{$value->spMa}}</th>
                                            <th>{{$value->spTen}}</th>
                                            <th>{{number_format($value->spGia)}}&nbsp;VND</th>
                                            <th>{{$value->spTinhtrang==1?"Còn hàng":"Hết hàng"}}</th>
                                            <th>{{$value->spHanbh}}&nbsp;năm</th>
                                            <?php $kmFind=DB::table('khuyenmai')->where('kmMa',$value->kmMa)->get(); ?>
                                            <th>{{$kmFind[0]->kmTrigia}}%</th>
                                            <?php $thFind=DB::table('thuonghieu')->where('thMa',$value->thMa)->get() ?>
                                            <th>{{$thFind[0]->thTen}}</th>
                                            <?php $loaiFind=DB::table('loai')->where('loaiMa',$value->loaiMa)->get() ?>
                                            <th>{{$loaiFind[0]->loaiTen}}</th>
                                            <?php $ncFind=DB::table('nhucau')->where('ncMa',$value->ncMa)->get() ?>
                                            <th>{{$ncFind[0]->ncTen}}</th>
                                              
                                            <td>
                                                <a href="{{url('updateSanpham/'.$value->spMa)}}" class="active" ui-toggle-class="">
                                                    <i class="fa far fa-edit"></i>
                                                </a>&nbsp;|
                                                <a href="{{url('deleteSanpham/'.$value->spMa)}}" >
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