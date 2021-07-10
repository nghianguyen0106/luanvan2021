@extends("Userpage.layout_dn_dk")
@section('title')
  Đăng nhập
@endsection
@section('register')
  Đăng ký
@endsection
@section("content")


  <section class="container content__login">
    <div class="row">
      <div class="col-lg-3"></div>
      <div class="col-lg-6 col-sm-12">
          <form id="login__form" action="{{URL::to('/checklogin')}}" method="post">
              <legend>Đăng nhập</legend>
            {{csrf_field()}}

            <div class="content__login--form">
              <br/>
              <!--account-->
              <div class="form-group">
                <input onblur="onUser()" type="text" name="username" class="form-control input__login" id="username" placeholder=" ">
                 <label for="" class="form__label">Tên đăng nhập</label>
                  <span id="acc__err--login"></span>
              </div>
              <!--password-->
              <div class="form-group">
                <input onblur="onPass()" id="password" type="password" name="password" class="form-control input__login" placeholder=" ">
                 <label for="" class="form__label">Mật khẩu</label>
                <i id="show__pass1" class="far fa-eye" style="font-size: 23px;"></i>
                <span id="pass__err--login"></span>
              </div>
              <br/>
              <div class="d-flex justify-content-between">
                <label class="control control--checkbox"><span class="caption">Nhớ tài khoản</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span><a href="{{URL::to('forgotPassword')}}" class="forgot-pass">Quên mật khẩu</a></span> 
              </div>
              <br/>
              <input onmouseover="btnLogin()" id="btn__login" type="submit" value="Đăng nhập" class="btn btn-block btn-primary">
              <span class="d-block text-center my-4 text-muted">&mdash; Hoặc &mdash;</span>
              <div>
                   <a href="{{URL::to('/google')}}" style="text-decoration: none;" class="btn btn-outline-danger btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Đăng nhập bằng <strong>Google</strong>
                                        </a>
                                        <a href="{{--URL::to('/facebook')--}}" style="text-decoration: none; "  class="btn btn-outline-primary btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Đăng nhập bằng <strong>Facebook</strong>
                              </a>
              </div>
              <br/>
             
              </div>
          </form>
        </div>
        <div class="col-lg-3"></div>
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
  footer: '<a class="btn-outline-primary" href="{{URL::to('/register')}}">Đăng ký</a>'
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
<script src="{{URL::asset('public/fe/js/js-validate/validate-login.js')}}"></script>