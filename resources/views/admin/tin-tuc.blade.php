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
                            <h2 class="m-0 font-weight-bold text-primary text-center">Quản lý tin tức</h2>
                        
                        </div>
                        <div class="card-body">
                            <a href="{{URL::to('them-tin-tuc')}}" class="btn btn-primary"><i class="fas fa-plus"></i>
                                 Thêm tin tức</a>
                                 <br/><br/>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead style="background:linear-gradient(to right,#627FFD,#8572FA ); ;color: white;">
                                        <tr>
                                            <th>Mã tin tức</th>
                                            <th>Tiêu đề tin tức</th>
                                            <th>Ngày nhập</th>
                                            <th></th> 
                                             <th></th>  
                                        </tr>
                                    </thead>
                                   
                                     <tfoot  style="display:none;"> 
                                         <tr>
                                            <th>Mã tin tức</th>
                                            <th>Tiêu đề tin tức</th>
                                            <th>Ngày nhập</th>
                                            <th></th> 
                                            <th></th>  
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($data as $value)
                                        <tr class="tt{{$value->ttMa}}">
                                            <td>{{$value->ttMa}}</td>
                                            <td>{{$value->ttTieude}}</td>
                                            <td>{{$value->ttNgay}}</td>
                                           <td>
                                            <a class="btn btn-primary" href="{{URL::to('cap-nhat-tin-tuc/'.$value->ttMa)}}">Cập nhật</a>
                                            </td>
                                            <td>
                                                <button class="btn btn-danger btnDel" value="{{$value->ttMa}}">
                                                  Xóa
                                                </button>
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


<script>
   $(document).on('click','.btnDel',function(e){
    e.preventDefault();
    var id = $(this).val();
       $.ajax({
        type:"GET",
        cache:false,
        url:'xoa-tin-tuc/'+id,
        dataType:'JSON',
        data:{
            id:id
        },
        success:function(response){
            result = response.message;
           if(result == 0)
           {
            $(".tt"+id).remove();
            alert('Xóa thành công')
           }
       }
        });
   });
</script>

@if(Session::has('err'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Opss... ',
  text: '{{Session::get('err')}}',
 
})
</script> 
@endif
@endsection