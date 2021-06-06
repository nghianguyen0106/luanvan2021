<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{{'public/fe/login/fonts/icomoon/style.css'}}}">

    <link rel="stylesheet" href="{{{'public/fe/login/css/owl.carousel.min.css'}}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{{'public/fe/login/css/bootstrap.min.css'}}}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{{'public/fe/login/css/style.css'}}}">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
{{-- FontAW --}}
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Đăng nhập</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{{'public/fe/login/images/bg_2.jpg'}}}');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <div class="mb-4">
              <h3>Đăng nhập</h3>
              <p style="color: red" class="mb-4">
                </p>
            </div>
            <form action="{{URL::to('/checklogin')}}" method="post">
            {{csrf_field()}}
              <div class="form-group first">
                <label for="username">Tên đăng nhập</label>
                <input type="text" name="username" class="form-control" id="username">

              </div>
              <div class="form-group last mb-3">
                <label for="password">Mật khẩu</label>
                <input type="password" name="password" class="form-control" id="password">
                 <i id="show__pass1" class="far fa-eye" style="font-size: 23px;position: absolute;top:1.5rem;left:90%;"></i>
              </div>

              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Nhớ tài khoản</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="{{URL::to('forgotPassword')}}" class="forgot-pass">Quên mật khẩu</a></span> 
              </div>

              <input type="submit" value="Log In" class="btn btn-block btn-primary">


              <span class="d-block text-center my-4 text-muted">&mdash; Hoặc &mdash;</span>
              <div class="row" style="color: white; ">
                   <a href="{{URL::to('/google')}}" style="text-decoration: none;" class="btn btn-outline-danger btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Đăng nhập bằng <strong>Google</strong>
                                        </a>
                                        <a href="{{URL::to('/facebook')}}" style="text-decoration: none; "  class="btn btn-outline-primary btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Đăng nhập bằng <strong>Facebook</strong>
                                        </a>
              </div>
                
                  <span class="d-block text-center my-4 text-muted"><a  style="text-decoration: none;" href="{{URL::to('/')}}">Trở về trang chính</a>&nbsp;/&nbsp;<a style="text-decoration: none;"  href="{{URL::to('/register')}}">Đăng ký</a></span>

            </form>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="{{{'public/fe/login/js/jquery-3.3.1.min.js'}}}"></script>
    <script src="{{{'public/fe/login/js/popper.min.js'}}}"></script>
    <script src="{{{'public/fe/login/js/bootstrap.min.js'}}}"></script>
    <script src="{{{'public/fe/login/js/main.js'}}}"></script>
    <script src="{{{'public/fe/login/js/js.js'}}}"></script>

  </body>
</html>
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