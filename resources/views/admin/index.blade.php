@extends('admin.layout')
@section('content')
        <!-- Content Wrapper -->
        <div class="container">
        <div>
            <br/>
            <h4>Số liệu cửa hàng</h4>
        </div>
        <hr/>
       <section id="content__1">
           <div class="row">
               <div class="content__1--item">
                   <label>Tổng đơn hàng</label>
                   <div>
                       10,000 đơn
                   </div>
               </div>
               <div class="content__1--item">
                <label>Tổng doanh thu</label>
                <div>
                    20&nbsp;VND
                </div>
               </div>
               <div class="content__1--item">
                    <label>Đang bán</label>
                    <div>
                        30 sản phẩm
                    </div>
               </div>
               <div class="content__1--item">
                    <label>Khách hàng đã mua</label>
                    <div>40 khách</div>
               </div>
           </div>
       </section>
       <br/>
       <section id="content__2">
           <div class="row">
               <div id="item__left" class="content__2--item item__left">
                   <div class="title__content--2">
                    <label>Danh sách nhân viên</label>
                    <a id="btnShow" onclick="showViewNV()">Xem tất cả</a>
                    <a id="btnClose" onclick="closeViewNV()">Thu gọn</a>
                   </div>
                    @foreach($nv as $nv)
                      <div class="item__info">
                          <span>
                            <img src="{{{"public/images/nhanvien/".$nv->adHinh}}}">
                           </span>
                           <span>
                           {{$nv->adTen}}
                          </span>
                          <span>
                            @if($nv->adQuyen ==1)
                                Chủ cửa hàng
                            @elseif($nv->adQuyen ==2)
                                Giao hàng
                            @endif
                           </span>
                      </div>
                       @endforeach
                   </table>
               </div>
               <div id="item__right" class="content__2--item item__right">
                <div class="title__content--2">
                   <label>Danh sách sản phẩm đang bán</label>
                  <a id="btnShow2" onclick="showViewSP()">Xem tất cả</a>
                  <a id="btnClose2" onclick="closeViewSP()">Thu gọn</a>
               </div>
                     @foreach($sp as $sp)
                       <div class="item__info">
                        <span>
                           <img src="{{{"public/images/products/".$sp->spHinh}}}">
                       </span>
                       <span>
                           {{$sp->spTen}}
                       </span>
                       <span>
                           {{number_format($sp->spGia)}}&nbsp;VND
                       </span>
                       <span>
                           Hiện còn&nbsp;{{$sp->khoSoluong}}
                       </span>
                       </div>
                       @endforeach
               </div>
           </div>
       </section>
   </div>

   <script>
       function showViewNV()
       {
        var btnShow = document.getElementById("btnShow");
        var btnClose = document.getElementById("btnClose");
        var view_nv = document.getElementById("item__left");
        view_nv.style.overflowY = 'visible';
        btnShow.style.display = 'none';
        btnClose.style.display = 'block';
       }
       function closeViewNV()
       {
        var btnShow = document.getElementById("btnShow");
        var btnClose = document.getElementById("btnClose");
        var view_nv = document.getElementById("item__left");
        view_nv.style.overflowY = 'hidden';
        btnShow.style.display = 'block';
        btnClose.style.display = 'none';
       }

       function showViewSP()
       {
        var btnShow = document.getElementById("btnShow2");
        var btnClose = document.getElementById("btnClose2");
        var view_sp = document.getElementById("item__right");
        view_sp.style.overflowY = 'visible';
        btnShow.style.display = 'none';
        btnClose.style.display = 'block';
       }
       function closeViewSP()
       {
        var btnShow = document.getElementById("btnShow2");
        var btnClose = document.getElementById("btnClose2");
        var view_sp = document.getElementById("item__right");
        view_sp.style.overflowY = 'hidden';
        btnShow.style.display = 'block';
        btnClose.style.display = 'none';
       }
   </script>
@endsection