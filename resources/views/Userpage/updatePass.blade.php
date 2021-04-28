@extends('Userpage.layout')
@section('content')


<div class="container">
	<div class="row">
		<div class="col-2"></div>
		<div class="col-8">
			<br/>
@foreach($data as $v)
<form id="box__editPass" class="box__info"  action="{{url('editPass/'.$v->khMa)}}" method="GET">
					<legend>Đổi mật khẩu</legend>
					<div class="flex__info">
						<span class="info__item">Mật khẩu cũ:</span>
						<span  class="info__item" class="info__item">
							<input class="ip" type="text"  name="khPassCu" placeholder="*********" />
						</span><br/>
						<span style="color:red">{{$errors->first('khPassCu')}}</span>
						@if(Session::has('note__errC')!=null)
						{
							<span style="color:red">{{Session::get("note__errC")}}</span>
						}
						@endif
					</div>
					<div class="flex__info">
						<span class="info__item">Mật khẩu mới:</span>
						<span  class="info__item" class="info__item">
							<input class="ip" type="text"  name="khPassMoi" placeholder="*********" />
						</span><br/>
						<span style="color:red">{{$errors->first('khPassMoi')}}</span>
					</div>
					<div class="flex__info">
						<span class="info__item">Nhập lại mật khẩu mới:</span>
						<span  class="info__item" class="info__item">
							<input class="ip" type="text"  name="khRePassMoi" placeholder="*********" />
						</span><br/>
						<span style="color:red">{{$errors->first('khRePassMoi')}}</span>
						@if(Session::has('note__err')!=null)
						{
							<span style="color:red">{{Session::get("note__err")}}</span>
						}
						@endif
					</div>
					<br/>
					<div class="flex__btnPass">
						<button type="button" ><a href="{{url('infomation/'.$v->khMa)}}"><i class="fas fa-times-circle" style="font-size: 38px;color: red"></i></a></button>
						&emsp;
						<button type="submit"><i class="fas fa-check-circle" style="font-size: 38px;color: green"></i></button>
					</div>
				</form>
				<br/>
				@endforeach
			</div></div></div>
				@endsection