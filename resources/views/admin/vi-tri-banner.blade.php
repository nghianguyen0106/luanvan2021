@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
        <div id="content justify-content-around">
        	<br/>
        	
			 &emsp;<button class="btn btn-info" type="button" onclick="back()">Trở về</button>
			 <br/>
			 <div>&emsp;Nhấp chuột vào khung vị trí cần thay đổi</div>
               <br/>
                     <div class="container-fluid">
                     	<div class="bn__header">
                     		<a class="link__addBn" href="{{url('them-banner/'."1")}}">
                     		<div class="row header__top">
                     			<img id="img__header--top" src="" />
                     		1. Banner header top
                     		</div>
                     		</a>
                     		<div class="row header__bot">
                     			<div class="col-lg-6">
                     				<a class="col-lg-12 text-center link__addBn" href="{{url('them-banner/'."2")}}">
                     				<img id="img__logo" src="" />
                     				<span id="text__header--bot">2. LOGO</span>
                     				</a>
                     			</div>
                     			<div class="col-lg-6">
                     				list menu
                     			</div>
                     		</div>
                     		<!-------->
                     			<a href="{{url('them-banner/'."3")}}">
                     			<div class="row bn__video">
                     			<div class="col-lg-12 bg__video">
					   				<video id="bg__video" muted loop autoplay>
					   					<source id="bg__source" src="" type="video/mp4">
					   				</video>
					   			</div>
					   			<div class="col-lg-6 bg__content">
					   				<h2 id="bg__video--text"> Nội dung background video</h2>
					   			</div>
					   			3. BACKGROUND VIDEO
					   			</div>
					   			</a>
                     			

                     		
                     		
                     		<!------->
                     		<div class="row bn__pro">
                     				<a class="col-lg-6 bn__pro--left" href="{{url('them-banner/'."4")}}">
                     				<img id="img__pro--left" src="" />
                     				<div class="col-lg-12 text-center">
                     					<span id="text__pro--left">&emsp;4.Link background left</span></div>
                     				{{-- <div id="content__left" class="col-lg-6 content__left">
                     					<span id="content__title4">Tiêu đề</span><br/>
                     					<div id="content__text4">Nội dung</div><br/>
                     					<a>Xem thêm</a>
                     				</div> --}}
                     				
                     				</a>
                     				<!---->
                     				<a class="col-lg-6 bn__pro--right" href="{{url('them-banner/'."5")}}">
                     				<img id="img__pro--right" src="" />
                     				<div class="col-lg-12 text-center">
                     					<span id="text__pro--right">5.Link background right</span>
                     				</div>
                     				{{-- <div id="content__right" class="col-lg-6 content__right">
                     					<span id="content__title5">Tiêu đề</span><br/>
                     					<div id="content__text5">Nội dung</div><br/>
                     					<a>Xem thêm</a>
                     				</div> --}}
                     				</a>
                     			</div>
                     	
                     		<br/>
                     		<div class="row justify-content-around">
                     			<h3>WELCOME</h3>
                     		</div>
                     		<hr/>
                     		<div class="row justify-content-around">
                     			<h3>DANH SÁCH SẢN PHẨM</h3>
                     		</div>
                     		<hr/>
                     		<div class="row bn__content">
                     			<a href="{{url('them-banner/'."6")}}" class="col-lg-6 bn__content--img">
                     				<img id="bn__content--img1" src="" />
                     				<span id="text__content--img1">6.Image content 1</span>
                     			</a>	
                     			<div class=" row col-lg-6 bn__content--text">
                     				<div class="bn__content--border">
                     				<div></div>
                     				</div>
                     				&emsp;&emsp;
                     				<div>
                     				<span id="text__title1" class="text__title">Tiêu đề</span><br/><br/>
                     				<div id="text__content1" class="text__content">Nội dung</div><br/>
                     				<a>Xem thêm</a>
                     			</div>
                     			</div>
                     		</div>
                     		<!---->
                     		<div class="row bn__content">
                     			<div class="row col-lg-6 bn__content--text justify-content-end" style="text-align: right;">
                     				<div>
                     				<span id="text__title2" class="text__title">Tiêu đề</span><br/><br/>
                     				<div id="text__content2" class="text__content">Nội dung</div><br/>
                     				<a>Xem thêm</a>
                     				</div>
                     				&emsp;&emsp;
                     				<div class="bn__content--border">
                     				<div></div>
                     				</div>
                     			</div>
                     			<a href="{{url('them-banner/'."7")}}" class="col-lg-6 bn__content--img">
                     			<div class="col-lg-6 bn__content--img">
                     				<img id="bn__content--img2" src="" />
                     				<span id="text__content--img2">7.Image content 2</span>
                     			</div>
                     			</a>
                     		</div>
                     		<!---->
                     		<div class="row bn__content">
                     			<a href="{{url('them-banner/'."8")}}" class="col-lg-6 bn__content--img">
                     				<img id="bn__content--img1" src="" />
                     				<span id="text__content--img1">6.Image content 1</span>
                     			</a>	
                     			<div class=" row col-lg-6 bn__content--text">
                     				<div class="bn__content--border">
                     				<div></div>
                     				</div>
                     				&emsp;&emsp;
                     				<div>
                     				<span id="text__title1" class="text__title">Tiêu đề</span><br/><br/>
                     				<div id="text__content1" class="text__content">Nội dung</div><br/>
                     				<a>Xem thêm</a>
                     			</div>
                     			</div>
                     		</div>
                     		<!---->
                     	</div>
                     </div>
                     <br/>   <br/><br/>   
                      <table id="tableInput"></table>
                
             </form>
			<br/>
            
		</div>
		
	</div>

@endsection
 

