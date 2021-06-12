<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang đăng nhập cho admin</title>

    <!-- Custom fonts for this template-->
    <link href="{{{'public/style_admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet'}}}" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Custom styles for this template-->
    <link href="{{{'public/style_admin/css/sb-admin-2.min.css'}}}" rel="stylesheet">
   
    <link href="{{{'public/style_admin/css/style.css'}}}" rel="stylesheet">
    <script src="{{URL::asset("public/style_admin/js/js.js")}}"></script>
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body  style="background-image: url('public/images/bg-login-register/bg-login.png');background-size: cover;">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-12 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5" style="background-color: transparent;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-around" >
                        
                            <div class="col-lg-6 col-sm-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 style="color: white">Welcome Login!</h1>
                                    </div>
                                    <form class="user" action="{{URL::to('/checkLogin')}}">
                                        <div class="form-group">
                                            <input onblur="onUser()" name="account" type="text" class="form-control form-control-user"
                                                id="username" aria-describedby="emailHelp"
                                                placeholder="Enter Account...">
                                        <span id="acc__err--login"></span>
                                        </div>  
                                        <div class="form-group">
                                            <input onblur="onPass()" id="password" name="password" type="password" class="form-control form-control-user" placeholder="Password">
                                             <i id="click__pass" class="far fa-eye" style="font-size: 23px;position: relative;z-index: 1000;left:90%;color: #888992;top:-2.3rem;"></i>
                                            <span id="pass__err--login"></span><br/>
                                        </div>
                                        <button id="btn__login" type="submit" name="btnLogin" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{{'public/style_admin/vendor/jquery/jquery.min.js'}}}"></script>
    <script src="{{{'public/style_admin/vendor/bootstrap/js/bootstrap.bundle.min.js'}}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- Core plugin JavaScript-->
    <script src="{{{'public/style_admin/vendor/jquery-easing/jquery.easing.min.js'}}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{{'public/style_admin/js/sb-admin-2.min.js'}}}"></script>
    <script src="{{url('public/fe/js/js-validate/validate-login.js')}}"></script>
     @if(Session::has('note_err'))
     <script type="text/javascript">
    Swal.fire({
      icon: 'error',
      title: 'Lỗi đăng nhập',
      text: '{{Session::get('note_err')}}!',
    });
    {{Session::forget('note_err')}}
    </script> 
   @endif
   <script>
       //LOGIN ADMIN//
        var pass = document.getElementById("password");
        function showPass()
        {
            var pass = document.getElementById("password");
            var click = document.getElementById("click__pass");
            click.setAttribute("class","far fa-eye-slash");
            pass.setAttribute("type","text");
        }
        function hidePass()
        {
            var pass = document.getElementById("password");
            var click = document.getElementById("click__pass");
            click.setAttribute("class","far fa-eye");
            pass.setAttribute("type","text");
        }
        var pwShown = 0;
        document.getElementById("click__pass").addEventListener("click", function (){
            if (pwShown == 0) {
                pwShown = 1;
                showPass();
            } else {
                pwShown = 0;
                hidePass();
            }
        });
   </script>
</body>

</html>