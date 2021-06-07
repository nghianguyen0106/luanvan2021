@extends("Userpage.layout_dn_dk")
@section('title')
  Đăng nhập
@endsection
@section("content")
<br/>
  <section class="container content__login">
    <div class="row">
      <div class="col-lg-3 col-sm-1"></div>
      <div class="col-lg-6 col-sm-12">
          <form action="{{URL::to('/checklogin')}}" method="post">
              <legend>Đăng nhập</legend>
            {{csrf_field()}}
            <div class="content__login--form">
              <div class="form-group first">
                <label for="username">Tên đăng nhập</label>
                <input type="text" name="username" class="form-control" id="username">

              </div>
              <div class="form-group last mb-3">
                <label for="password">Mật khẩu</label>
                <input id="password" type="password" name="password" class="form-control">
                <i id="show__pass1" class="far fa-eye" style="font-size: 23px;"></i>
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Nhớ tài khoản</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="{{URL::to('forgotPassword')}}" class="forgot-pass">Quên mật khẩu</a></span> 
              </div>

              <input type="submit" value="Đăng nhập" class="btn btn-block btn-primary">

              <span class="d-block text-center my-4 text-muted">&mdash; Hoặc &mdash;</span>
              <div class="row" style="color: white; ">
                   <a href="{{URL::to('/google')}}" style="text-decoration: none;" class="btn btn-outline-danger btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Đăng nhập bằng <strong>Google</strong>
                                        </a>
                                        <a href="{{URL::to('/facebook')}}" style="text-decoration: none; "  class="btn btn-outline-primary btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Đăng nhập bằng <strong>Facebook</strong>
                                        </a>
              </div>
              <br/>
              <div class="content__login--link">
                    <a href="{{URL::to('/')}}">Trở về trang chính</a>&nbsp;/&nbsp;<a href="{{URL::to('/register')}}">Đăng ký</a>
              </div>
              <br/>
              </div>
          </form>
        </div>
        <div class="col-lg-3 col-sm-1"></div>
      </div>
  </section>
  <br/>
<!--Javascript code-->
  @if(Session::has('loginmessage'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: '{{Session::get('loginmessage')}}!',
  footer: '<a href="{{URL::to('/register')}}">Register</a></span>'
})
</script> 
@endif

  @if(Session::has('registerSuccess'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Register success ',
  text: '{{Session::get('registerSuccess')}}!',
})
</script> 
@endif

  @if(Session::has('changepassword'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'success',
  title: 'Thay đổi mật khẩu thành công!',
  text: '{{Session::get('changepassword')}}!',
})
</script> 
@endif

@endsection