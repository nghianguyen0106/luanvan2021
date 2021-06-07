@extends("Userpage.layout_dn_dk")
@section('title')
  Đăng ký tài khoản
@endsection
@section("content")
<br/>
<section class="container content__register">
    <div class="row">
      <div class="col-lg-3 col-sm-1"></div>
      <div class="col-lg-6 col-sm-12">
            <form action="{{URL::to('getregister')}}" method="post">
             <legend>Đăng ký tài khoản</legend>
            {{csrf_field()}}
            <div class="content__register--form">
               <div class="form-group first">
                <label for="name">Tên của bạn</label>
                <input type="text" name="name" required class="form-control" >
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" required class="form-control" >
              </div>
               <div class="form-group">
                <input type="date" name="date" required class="form-control" >
              </div>
               <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" name="username" required class="form-control" id="username">
              </div>
               <div class="form-group ">
                <label for="password">Mật khẩu</label>
                <input id="password" type="password" name="password" required class="form-control">
                <i id="show__pass1" class="far fa-eye" style="font-size: 23px;"></i>
              </div>
              <div class="form-group  ">
                <label for="password">Nhập lại mật khẩu</label>
                <input id="repassword" type="password" name="repassword" required class="form-control">
                 <i id="show__pass2" class="far fa-eye" style="font-size: 23px;"></i>
              </div>
              
              <div class="form-group  ">
                <label for="address">Địa chỉ</label>
                <input type="text" name="address" required class="form-control">
              </div>
              <div class="form-group  ">
                <label for="sdt">Số điện thoại</label>
                <input type="number" name="sdt" required class="form-control" >
              </div>
              <div class="form-group last  mb-3">
                <input type="radio" name="sex" checked value="0" >&nbsp;Nam &nbsp;&nbsp;
                <input type="radio" name="sex" value="1" >&nbsp;Nữ
              </div>


              <input type="submit" value="Đăng ký" class="btn btn-block btn-primary">
              <br/>
               <span class="d-block text-center my-4 text-muted">&mdash; Hoặc &mdash;</span>
              <div class="row" style="color: white; ">
                   <a href="{{URL::to('/google')}}" style="text-decoration: none;" class="btn btn-outline-danger btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Đăng ký bằng <strong>Google</strong>
                                        </a>
                                        <a href="{{URL::to('/facebook')}}" style="text-decoration: none; "  class="btn btn-outline-primary btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Đăng ký bằng <strong>Facebook</strong>
                                        </a>
              </div>
                  <div class="content__register--link">
                    <a href="{{URL::to('/')}}">Trở về trang chính</a>&nbsp;/&nbsp;
                    <a href="{{URL::to('login')}}">Đã có tài khoản <strong>Đăng nhập ngay </strong>?</a>
                  </div>
                </div>
            </form>
          </div>
        </div>
        </section>
<!----Javascript code-->
@if(Session::has('error'))
<script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Opss... ',
  text: '{{Session::get('error')}}!',
})
</script> 
@endif



@endsection