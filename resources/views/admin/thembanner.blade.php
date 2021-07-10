@extends('admin.layout')
@section('content')
  	<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
        <div id="content justify-content-around">
			<form class="form-inline " action="{{URL::to('checkAddBanner')}}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                  <div class="flex__form" >
                             <div class="col-lg-3">
                                 <label for="exampleInputPassword1" class="form-label">Tiêu đề(Nếu có):</label>
                                 <input type="text" class="form-control" id="bn__tieude">
                                  <span style="color:red">{{$errors->first('bnTieude')}}</span>
                              </div>
                               <div class="col-lg-4">
                              <label for="exampleInputPassword1" class="form-label">Nội dung(Nếu có):</label>
                            	<textarea style="width: 100%;" id="bn__content">
                            	
                            </textarea>
                            </div>
                              <div class="col-lg-3">
                              <label for="exampleInputPassword1" class="form-label">Chọn ảnh:</label>
                             <input type="file" class="form-control" id="input__images">
                            </div>
                            
                            <br/>
                        <br/>
                        </div>
                        <div class="flex__form">
                        <div class="mb-3">
                                        <label class="form-label text-left">Vị trí:</label>
                                        &emsp;<input  type="radio" value="1" id="bnVitri1">&nbsp;1. BANNER HEADER TOP &emsp;&emsp;
                                        <input type="radio" value="2" id="bnVitri2">&nbsp;2. LOGO&emsp;&emsp;
                                        <input type="radio" value="3" id="bnVitri3">&nbsp;3. BACKGROUND VIDEO&emsp;&emsp;
                                        <input type="radio" value="4" id="bnVitri4">&nbsp;4. LINK LEFT&emsp;&emsp;
                                        <input type="radio" value="5" id="bnVitri5">&nbsp;5. LINK RIGHT&emsp; &emsp;   
                                        <input type="radio" value="6" id="bnVitri6">&nbsp;6. IMAGE CONTENT 1&emsp;&emsp;
                                        <input type="radio" value="7" id="bnVitri7">&nbsp;7. IMAGE CONTENT 2&emsp;&emsp;
                                        <input type="radio" value="8" id="bnVitri8">&nbsp;8. IMAGE CONTENT 3&emsp; &emsp;      
                         </div>
                     </div>
                     <br/>
                     <div class="flex__form">
                     	<button id="btnThem" type="button" class="btn btn-primary">Thêm</button>
                     </div>
                     </div>
                <br/><br/>
                     <div class="container-fluid">
                     	<div class="bn__header">
                     		<div class="row header__top">
                     			<img id="img__header--top" src="" />
                     		1. Banner header top
                     		</div>
                     		<div class="row header__bot">
                     			<div class="col-lg-6">
                     				<img id="img__logo" src="" />
                     				<span id="text__header--bot">2. LOGO</span>
                     			</div>
                     			<div class="col-lg-6">
                     				list menu
                     			</div>
                     		</div>
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
                     		<div class="row bn__pro">
                     			<div class="col-lg-6 bn__pro--left">
                     				<img class="col-lg-12" id="img__pro--left" src="" />
                     				<div class="col-lg-6 text-center">
                     					<span id="text__pro--left">&emsp;4.Link background left</span></div>
                     				<div id="content__left" class="col-lg-6 content__left">
                     					<span id="content__title4">Tiêu đề</span><br/>
                     					<div id="content__text4">Nội dung</div><br/>
                     					<a>Xem thêm</a>
                     				</div>
                     				<div></div>
                     				
                     			</div>
                     			<div class="col-lg-6 bn__pro--right">
                     				<img id="img__pro--right" src="" />
                     				<div class="col-lg-6 text-center">
                     					<span id="text__pro--right">5.Link background right</span>
                     				</div>
                     				<div id="content__right" class="col-lg-6 content__right">
                     					<span id="content__title5">Tiêu đề</span><br/>
                     					<div id="content__text5">Nội dung</div><br/>
                     					<a>Xem thêm</a>
                     				</div>
                     				
                     			</div>
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
                     			<div class="col-lg-6  bn__content--img">
                     				<img id="bn__content--img1" src="" />
                     				<span id="text__content--img1">6.Image content 1</span>
                     			</div>
                     			<div class="col-lg-1 bn__content--border">
                     				<div></div>
                     			</div>
                     			<div class="col-lg-5 bn__content--text">
                     				<span id="text__title1" class="text__title">Tiêu đề</span><br/><br/>
                     				<div id="text__content1" class="text__content">Nội dung</div><br/>
                     				<a>Xem thêm</a>
                     			</div>
                     		</div>
                     		<!---->
                     		<div class="row bn__content">
                     			<div class="col-lg-5 bn__content--text" style="text-align: right;">
                     				<span id="text__title2" class="text__title">Tiêu đề</span><br/><br/>
                     				<div id="text__content2" class="text__content">Nội dung</div><br/>
                     				<a>Xem thêm</a>
                     			</div>
                     			<div class="col-lg-1 bn__content--border">
                     				<div></div>
                     			</div>
                     			<div class="col-lg-6 bn__content--img">
                     				<img id="bn__content--img2" src="" />
                     				<span id="text__content--img2">7.Image content 2</span>
                     			</div>
                     		</div>
                     		<!---->
                     		<div class="row bn__content">
                     			<div class="col-lg-6 bn__content--img">
                     				<img id="bn__content--img3" src="" />
                     				<span id="text__content--img3">8.Image content 3</span>
                     			</div>
                     			<div class="col-lg-1 bn__content--border">
                     				<div></div>
                     			</div>
                     			<div class="col-lg-5 bn__content--text">
                     				<span id="text__title3" class="text__title">Tiêu đề</span><br/><br/>
                     				<div id="text__content3" class="text__content">Nội dung</div><br/>
                     				<a>Xem thêm</a>
                     			</div>
                     		</div>
                     	</div>
                     </div>
                     <br/>   <br/><br/>   
                      <table id="tableInput"></table>
                 <div class="row justify-content-around">
                 	 <button class="btn btn-info" type="button" onclick="back()">Trở về</button>&emsp;
                    <button type="submit" name="btn_add" class="btn btn-primary">Thực hiện</button>
                  </div>

             </form>
			<br/>
            
		</div>
		
	</div>



<script>
	var bnNoidung = document.getElementById("bn__content");
	var bnTieude = document.getElementById("bn__tieude");
	//Vị trí 1
	var viTri1 = document.getElementById("bnVitri1");
	var imgVT1 = document.getElementById("img__header--top");
	//Vị trí 2
	var viTri2 = document.getElementById("bnVitri2");
	var imgVT2 = document.getElementById("img__logo");
	var textVT2 = document.getElementById("text__header--bot");
	//Vị trí 3
	var viTri3 = document.getElementById("bnVitri3");
	var video = document.getElementById("bg__video");
	var source = document.getElementById("bg__source");
	var text = document.getElementById("bg__video--text");
	//Vị trí 4
	var viTri4 = document.getElementById("bnVitri4");
	var imgVT4 = document.getElementById("img__pro--left");
	var textVT4 = document.getElementById("text__pro--left");
	var div4 = document.getElementById("content__left");
	var title4 = document.getElementById("content__title4");
	var content4 = document.getElementById("content__text4");
	//Vị trí 5
	var viTri5 = document.getElementById("bnVitri5");
	var imgVT5 = document.getElementById("img__pro--right");
	var textVT5 = document.getElementById("text__pro--right");
	var div5 = document.getElementById("content__right");
	var title5 = document.getElementById("content__title5");
	var content5 = document.getElementById("content__text5");
	//Vị trí 6
	var viTri6 = document.getElementById("bnVitri6");
	var imgVT6 = document.getElementById("bn__content--img1");
	var textVT6 = document.getElementById("text__content--img1");
	var title6 = document.getElementById("text__title1");
	var content6 = document.getElementById("text__content1");
	//Vị trí 7
	var viTri7 = document.getElementById("bnVitri7");
	var imgVT7 = document.getElementById("bn__content--img2");
	var textVT7 = document.getElementById("text__content--img2");
	var title7 = document.getElementById("text__title2");
	var content7 = document.getElementById("text__content2");
	//Vị trí 8
	var viTri8 = document.getElementById("bnVitri8");
	var imgVT8 = document.getElementById("bn__content--img3");
	var textVT8 = document.getElementById("text__content--img3");
	var title8 = document.getElementById("text__title3");
	var content8 = document.getElementById("text__content3");
	//Tạo dữ liệu
	//Input Images
	var inputImg = document.getElementById("input__images")
	inputImg.addEventListener('change', function(){
		var file = this.files[0];
		if(file)
		{
			var reader = new FileReader();
			reader.onload = function(){
			var result = reader.result;
			//Xử lý
			var btnThem = document.getElementById("btnThem");
			btnThem.addEventListener("click", function(){
					if(viTri1.checked==true)
					{
						imgVT1.src=result;
						imgVT1.style.display = 'block';
						var tableData = document.getElementById("tableInput");
						var addRow = `<tr>
										<td><input type="text" name="bnTieude[]"  value="${bnTieude.value}" class="form-control"></td>
										<td><input type="text" name="bnNoidung[]" value="${bnNoidung.value}" class="form-control"></td>
										<td><input type="number" name="bnVitri[]" value="1" class="form-control"></td>
										<td><input type="number" name="bnPage[]" value="0" class="form-control"></td>
										<td><input type="file" name="bnHinh[]" value="${result}" class="form-control"></td>
									 </tr>`;
						tableData.innerHTML+= addRow;
						console.log(reader);
					}
					if(viTri2.checked==true)
					{
						imgVT2.src=result;
						imgVT2.style.display = 'block';
						textVT2.style.display = 'none';
					}
					if(viTri3.checked==true)
					{
						source.setAttribute("src", result);
						video.load();
						video.play();
						if(bnNoidung.value!=null)
						{
							text.innerHTML = bnNoidung.value;
						}
					}
					if(viTri4.checked==true)
					{
						imgVT4.src=result;
						imgVT4.style.display = 'block';
						textVT4.style.display = 'none';
						div4.style.display = 'block';
						if(bnTieude.value!=null)
						{
							title4.innerHTML = bnTieude.value;
						}
						if(bnNoidung.value!=null)
						{
							content4.innerHTML = bnNoidung.value;
						}

					}
					if(viTri5.checked==true)
					{
						imgVT5.src=result;
						imgVT5.style.display = 'block';
						textVT5.style.display = 'none';
						div5.style.display = 'block';
						if(bnTieude.value!=null)
						{
							title5.innerHTML = bnTieude.value;
						}
						if(bnNoidung.value!=null)
						{
							content5.innerHTML = bnNoidung.value;
						}
					}
					if(viTri6.checked==true)
					{
						imgVT6.src=result;
						imgVT6.style.display = 'block';
						textVT6.style.display = 'none';
						if(bnTieude.value!=null)
						{
							title6.innerHTML = bnTieude.value;
						}
						if(bnNoidung.value!=null)
						{
							content6.innerHTML = bnNoidung.value;
						}
					}
					if(viTri7.checked==true)
					{
						imgVT7.src=result;
						imgVT7.style.display = 'block';
						textVT7.style.display = 'none';
						if(bnTieude.value!=null)
						{
							title7.innerHTML = bnTieude.value;
						}
						if(bnNoidung.value!=null)
						{
							content7.innerHTML = bnNoidung.value;
						}
					}
					if(viTri8.checked==true)
					{
						imgVT8.src=result;
						imgVT8.style.display = 'block';
						textVT8.style.display = 'none';
						if(bnTieude.value!=null)
						{
							title8.innerHTML = bnTieude.value;
						}
						if(bnNoidung.value!=null)
						{
							content8.innerHTML = bnNoidung.value;
						}
					}
				});
			}
		reader.readAsDataURL(file);
		}
	}); 

</script>
@endsection
 
























{{-- 
     <div class="flex__form" >
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Tiêu đề banner:</label>
                                        <input name="bnTieude" type="text" class="form-control" id="bnTieude">
                                         <span style="color:red">{{$errors->first('bnTieude')}}</span>
                                      </div>
                                       <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Thêm hình ảnh cho banner:</label>
                                        <input name="bnHinh" type="file" class="form-control" id="bnHinh">
                                      </div>
                                       <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Vị trí:</label>
                                        <input  type="radio" value="0" class="form-control" id="bnVitri">&nbsp;Slide &emsp;
                                        <input  type="radio" value="1" class="form-control" id="bnVitri">&nbsp;Banner con&emsp;
                                        <input  type="radio" value="2" class="form-control" id="bnVitri">&nbsp;Banner quảng cáo
                                        
                                      </div>
                                    </div>
                                  </div>
                                    --}}