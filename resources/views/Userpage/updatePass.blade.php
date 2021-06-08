@extends('Userpage.layout')
@section('content')



<br/>
@foreach($data as $v)
 <section class="container content__login">
    <div class="row">
      <div class="col-lg-3 col-sm-1"></div>
      <div class="col-lg-6 col-sm-12">
<form id="box__editPass" class="box__info"  action="{{url('editPass/'.$v->khMa)}}" method="post">
					{{csrf_field()}}
					<legend style="color:orange">Đổi mật khẩu</legend>
					 <div class="content__login--form">
					<div class="form-group">
						<input id="cont__pass" class="form-control input__upPass" type="password"  name="khPassCu" placeholder=" " />
							<label class="info__item form__label">Mật khẩu cũ:</label>
							<i id="click__pass" class="far fa-eye" style="font-size: 23px;top: -2rem;"></i>
						<br/>
						
						@if(Session::has('note__errC')!=null)
						{
							<span style="color:red">{{Session::get("note__errC")}}</span>
						}
						@endif
					</div>
					<div class="form-group first">
							<input id="cont__pass2" class="form-control input__upPass" type="password"  name="khPassMoi" placeholder=" " />
							<label class="info__item form__label">Mật khẩu mới:</label>
							<i id="click__pass2" class="far fa-eye" style="font-size: 23px;top: -2rem;"></i>
						<br/>
						<span style="color:red">{{$errors->first('khPassMoi')}}</span>
					</div>
					<div class="form-group first">
							<input id="cont__pass3" class="form-control input__upPass" type="password"  name="khRePassMoi" placeholder=" " />
							<label class="info__item form__label">Nhập lại mật khẩu mới:</label>
							<i id="click__pass3" class="far fa-eye" style="font-size: 23px;top: -2rem;"></i>
						<br/>
						<span style="color:red">{{$errors->first('khRePassMoi')}}</span>
						@if(Session::has('note__err')!=null)
						{
							<span style="color:red">{{Session::get("note__err")}}</span>
						}
						@endif
					</div>
					<div class="flex__btnPass">
						<button class="btn btn-dark" type="button" ><a href="{{url('infomation/'.$v->khMa)}}">Trở về</a></button>
						
						<button class="btn btn-primary" type="submit">Thực hiện</button>
					</div>
				</div>
				<br/>
				</form>
			</div>
		</div>
	</section>
				<br/>
				@endforeach
				@endsection