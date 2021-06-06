<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('public/fe/login/fonts/icomoon/style.css')}}">
    <link rel="stylesheet" href="{{url('public/fe/login/css/owl.carousel.min.css')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('public/fe/login/css/bootstrap.min.css')}}">
    <!-- Style -->
    <link rel="stylesheet" href="{{url('public/fe/login/css/style.css')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Đăng ký tài khoản</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{{'public/fe/login/images/bg_2.jpg'}}}');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <div class="mb-4">
              <h3>Đăng ký tài khoản</h3>
              <p style="color: red" class="mb-4">
                </p>
            </div>
            <form action="{{URL::to('getregister')}}" method="post">
            {{csrf_field()}}
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
                <input id="password" type="password" name="password" required class="form-control" >
                <i id="show__pass1" class="far fa-eye" style="font-size: 23px;position: absolute;top:1.5rem;left:90%;"></i>
              </div>
              <div class="form-group  ">
                <label for="repassword">Nhập lại mật khẩu</label>
                <input id="repassword" type="password" name="repassword" required class="form-control">
                 <i id="show__pass2" class="far fa-eye" style="font-size: 23px;position: absolute;top:1.5rem;left:90%;"></i>
              </div>
              
              <div class="form-group  ">
                <label for="address">Địa chỉ</label>
                <input type="text" name="address" required class="form-control" >
              </div>
              <div class="form-group  ">
                <label for="sdt">Số điện thoại</label>
                <input type="number" name="sdt" required class="form-control" >
              </div>
              <div class="form-group last  mb-3">
                <input type="radio" name="sex" checked value="0" >&nbsp;Nam &nbsp;&nbsp;
                <input type="radio" name="sex" value="1" >&nbsp;Nữ
              </div>


              <input type="submit" value="Register" class="btn btn-block btn-primary">
            
            </form>
              <span class="d-block text-center my-4 text-muted">&mdash; Hoặc &mdash;</span>
              <div class="row" style="color: white; ">
                   <a href="{{URL::to('/google')}}" style="text-decoration: none;" class="btn btn-outline-danger btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Đăng ký bằng <strong>Google</strong>
                                        </a>
                                        <a href="{{URL::to('/facebook')}}" style="text-decoration: none; "  class="btn btn-outline-primary btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Đăng ký bằng <strong>Facebook</strong>
                                        </a>
              </div>
                  <span class="d-block text-center my-4 text-muted"><a href="{{URL::to('/')}}">Trở về trang chính</a>&nbsp;/&nbsp;<a href="{{URL::to('login')}}">Đã có tài khoản <strong>Đăng nhập ngay </strong>?</a></span>
          </div>
        </div>
      </div>
    </div>

    
  </div>
    
    

    <script src="{{url('public/fe/login/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{url('public/fe/login/js/popper.min.js')}}"></script>
    <script src="{{url('public/fe/login/js/bootstrap.min.js')}}"></script>
    <script src="{{url('public/fe/login/js/main.js')}}"></script>
     <script src="{{url('public/fe/login/js/js.js')}}"></script>
  </body>
</html>

  @if(Session::has('error'))
 <script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Opss... ',
  text: '{{Session::get('error')}}!',
})
</script> 
@endif