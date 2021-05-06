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

    <!-- Custom styles for this template-->
    <link href="{{{'public/style_admin/css/sb-admin-2.min.css'}}}" rel="stylesheet">
   
    <link href="{{{'public/style_admin/css/style.css'}}}" rel="stylesheet">
    <script src="{{URL::asset("public/style_admin/js/js.js")}}"></script>

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
                        
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 style="color: white">Welcome Login!</h1>
                                    </div>
                                    <form class="user" action="{{URL::to('/checkLogin')}}">
                                        <div class="form-group">
                                            <input name="account" type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Account...">
                                              
                                        </div>
                                        <div class="form-group">
                                            <input id="cont__pass" name="password" type="password" class="form-control form-control-user" placeholder="Password">
                                             <a onclick="showHide()" id="click__pass">Hiện mật khẩu</a>
                                        </div>

                                                <span style="color:red;font-size: 16px">{{Session::get('error_login')}}</span>
                                        <button type="submit" name="btnLogin" class="btn btn-primary btn-user btn-block">
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

    <!-- Core plugin JavaScript-->
    <script src="{{{'public/style_admin/vendor/jquery-easing/jquery.easing.min.js'}}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{{'public/style_admin/js/sb-admin-2.min.js'}}}"></script>

</body>

</html>