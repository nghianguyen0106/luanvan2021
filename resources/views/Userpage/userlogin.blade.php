
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

    <title>Login</title>
  </head>
  <body>
  

  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{{'public/fe/login/images/bg_2.jpg'}}}');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <div class="mb-4">
              <h3>Sign In</h3>
              <p style="color: red" class="mb-4">
                <?php 
                  $mes = Session::get('loginmessage'); 
                  if(isset($mes))
                  {
                    echo $mes;
                    Session::forget('loginmessage');
                  }

                  if(Session::has('registerSuccess'))
                  {
                    echo Session::get('registerSuccess');
                    Session::forget('registerSuccess');
                  }
                ?> 

                  
                </p>
            </div>
            <form action="{{URL::to('/checklogin')}}" method="post">
            {{csrf_field()}}
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" id="username">

              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password">
                
              </div>
              
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
              </div>

              <input type="submit" value="Log In" class="btn btn-block btn-primary">


              <span class="d-block text-center my-4 text-muted">&mdash; or &mdash;</span>
                  <span class="d-block text-center my-4 text-muted"><a href="{{URL::to('/')}}">Back to Home page</a>&nbsp;/&nbsp;<a href="{{URL::to('/register')}}">Register</a></span>

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
  </body>
</html>