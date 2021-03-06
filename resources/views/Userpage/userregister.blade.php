@extends("Userpage.layout_dn_dk")
@section('title')
  Đăng ký tài khoản
@endsection
@section('login')
  Đăng nhập
@endsection
@section("content")

<section class="container content__register">
    <div class="row">
      <div class="col-lg-2"></div>
      <div class="col-lg-8 col-sm-12">
            <form action="{{URL::to('getregister')}}" method="post">
             <legend>Đăng ký tài khoản</legend>
            {{csrf_field()}}
            <br/>
            <div class="content__register--form">
               <div class="form-group">
                <input onblur="onName()" id="ip__name" type="text" name="name" class="form-control input__register" placeholder=" ">
                <label for="" class="form__label">Tên của bạn</label>
                <span id="name__err--regis"></span>
              </div>

              <div class="form-group">
                <input id="ip__email" type="email" name="email" required class="form-control input__register" placeholder=" ">
                <label for="" class="form__label">Email</label>
                <span id="email__err--regis"></span>
              </div>
               <div class="form-group">
                <input type="date" name="date" required class="form-control input__register" placeholder=" ">
                <label for="" class="form__label">Ngày sinh</label>
              </div>
               <div class="form-group">
                <input onblur="onAcc()" id="ip__acc" type="text" name="username" required class="form-control input__register" placeholder=" ">
                <label for="" class="form__label">Tên đăng nhập</label>
                <span id="acc__err--regis"></span>
              </div>
               <div class="form-group ">
                <input onblur="onPass1()" id="password" type="password" name="password" required class="form-control input__register" placeholder=" ">
                 <label for="" class="form__label">Mật khẩu</label>
                <i id="show__pass1" class="far fa-eye" style="font-size: 23px;"></i>
                <span id="pass__err"></span>
              </div>
              <div class="form-group  ">
                <input onblur="onPass2()" id="repassword" type="password" name="repassword" required class="form-control input__register" placeholder=" ">
                 <label for="" class="form__label">Nhập lại mật khẩu</label>
                 <i id="show__pass2" class="far fa-eye" style="font-size: 23px;"></i>
                 <span id="pass__err2"></span>
              </div>
              
              <div class="form-group  ">
                <input onblur="onAddress()" id="address" type="text" name="address" required class="form-control input__register" placeholder=" ">
                <label for="" class="form__label">Địa chỉ</label>
                 <span id="address__err--regis"></span>
              </div>
              <div class="form-group  ">
                <input onblur="onSDT()" id="sdt" type="number" name="sdt" required class="form-control input__register" placeholder=" ">
                <label for="" class="form__label">Số điện thoại</label>
                <span id="sdt__err--regis"></span>
              </div>
              <div class="form-group last  mb-3">
                <input type="radio" name="sex" checked value="0" >&nbsp;Nam &nbsp;&nbsp;
                <input type="radio" name="sex" value="1" >&nbsp;Nữ
              </div>

              <input id="btn__register" type="submit" value="Đăng ký" class="btn btn-block btn-primary">
              <br/>
               <span class="d-block text-center my-4 text-muted">&mdash; Hoặc &mdash;</span>
              <div>
                   <a href="{{URL::to('/google')}}" style="text-decoration: none;" class="btn btn-outline-danger btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Đăng ký bằng <strong>Google</strong>
                                        </a>
                                     {{--    <a href="{{URL::to('/facebook')}}" style="text-decoration: none; "  class="btn btn-outline-primary btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Đăng ký bằng <strong>Facebook</strong>
                                        </a> --}}
              </div>  
                </div>
                <br/>
            </form>
          </div>
          <div class="col-lg-2"></div>
        </div>
        </section>
        <br/>
        {{-- @dd(Session::get('error')); --}}
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
<script src="{{url('public/fe/js/js-validate/validate-register.js')}}"></script>