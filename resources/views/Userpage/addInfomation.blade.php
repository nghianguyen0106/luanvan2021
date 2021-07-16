@extends("Userpage.layout_dn_dk")
@section('title')
  Đăng ký tài khoản
@endsection
@section("content")
<br/>
<section class="container content__register" >
    <div class="row">
      <div class="col-lg-2"></div>
      <div class="col-lg-8 col-sm-12">
            <form action="{{URL::to('addInfomation/'.Auth::guard('khachhang')->user()->khMa)}}" method="post">
             <legend>Đăng ký tài khoản  {{Session::get('khMa')}} {{Auth::guard('khachhang')->user()->khTen}}</legend>
            {{csrf_field()}}
   
            <br/>
            <div class="content__register--form">
              
               <div class="form-group ">
                <input onblur="onPass1()" id="password" type="password" name="password" required class="form-control input__register" placeholder=" ">
                 <label for="" class="form__label">Mật khẩu</label>
                <i id="show__pass1" class="far fa-eye" style="font-size: 23px;"></i>
                <span id="pass__err"></span>
              </div>
              <div class="form-group ">
                <input onblur="onPass2()" id="repassword" type="password" name="repassword" required class="form-control input__register" placeholder=" ">
                 <label for="" class="form__label">Nhập lại mật khẩu</label>
                 <i id="show__pass2" class="far fa-eye" style="font-size: 23px;"></i>
                 <span id="pass__err2"></span>
              </div>
              
              <div class="form-group  ">
                <input onblur="onAddress()" minlength="10" title="Địa chỉ bao gồm: Số nhà, Tên đường, phường xã (Độ dài phải hơn 10 ký tự)" id="address" type="text" name="address" required class="form-control input__register" placeholder=" ">
                <label for="" class="form__label">Địa chỉ</label>
                 <span id="address__err--regis"></span>
              </div>
              <div class="form-group  ">
                <input onblur="onSDT()" id="sdt" type="number" name="sdt" maxlength="11" minlength="10" required class="form-control input__register" placeholder=" ">
                <label for="" class="form__label">Số điện thoại</label>
                <span id="sdt__err--regis"></span>
              </div>
              <div class="form-group last  mb-3">
              <input id="btn__register" type="submit" value="Xác nhận" class="btn btn-block btn-primary">
              </div>
              <br>
                </div>
                <br>
            </form>
          </div>
          <div class="col-lg-2"></div>
        </div>
        </section>
        <br/>
<!----Javascript code-->
@if(Session::has('info'))
<script type="text/javascript" >
Swal.fire({
  icon: 'info',
  title: 'Thông báo',
  text: '{{Session::get('info')}}!',
})
</script> 
@endif

@if(Session::has('err'))
<script type="text/javascript" >
Swal.fire({
  icon: 'error',
  title: 'Thông báo',
  text: '{{Session::get('err')}}!',
})
</script> 
@endif

@endsection
<script type="text/javascript">
          window.addEventListener('beforeunload', function (e) {
            // e.preventDefault();
            // e.returnValue = '';
            // window.location.href="{{URL::to('login')}}";
        });
// Show notification register
@if(Session::has('ok'))
Swal.fire({
  icon: 'info',
  title: 'Thông báo',
  text: '{{Session::get('ok')}}!',
});

@endif
</script>
<script src="{{url('public/fe/js/js-validate/validate-register.js')}}"></script>