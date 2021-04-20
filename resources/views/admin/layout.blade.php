<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Page Admin</title>

    <!-- Custom fonts for this template-->
    <link href="{{url('public/style_admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{url('public/style_admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{url('public/style_admin/css/style.css')}}" rel="stylesheet">
 

    <!-- Custom styles for this page -->
    <link href="{{url('public/style_admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Hi {{Session::get('adTaikhoan')}}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{URL::to('admin')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

          

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Quản lý người dùng</span>
                </a>
               <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Danh mục quản lý:</h6>
                        <a class="collapse-item" href="{{URL::to('/adNhanvien')}}">Quản lý nhân viên</a>
                        <a class="collapse-item"  href="{{URL::to('/adKhachhang')}}">Quản lý khách hàng</a>
                    </div>
                </div>
            </li>
             <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Quản lý dữ liệu cửa hàng</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Danh mục quản lý:</h6>
                        <a class="collapse-item"  href="{{URL::to('/adSanpham')}}">Quản lý sản phẩm</a>
                        <a class="collapse-item" href="{{URL::to('/adThuonghieu')}}">Quản lý thương hiệu</a>
                        <a class="collapse-item" href="{{URL::to('/adLoai')}}">Quản lý loại</a>
                        <a class="collapse-item" href="{{URL::to('/adNhucau')}}">Quản lý nhu cầu</a>
                        <a class="collapse-item" href="{{URL::to('/adKhuyenmai')}}">Quản lý khuyến mãi</a>
                         <a class="collapse-item" href="{{URL::to('/adBanner')}}">Quản lý Banner</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


          

              <li class="nav-item">
                <a class="nav-link" href="{{URL::to('/adLogout')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Đăng xuất</span></a>
            </li>

          

        </ul>
         @yield("content")
    </div>
        <!-- End of Sidebar -->


      

         <!-- Footer -->
            <footer class="sticky-footer bg-dark" style="color: white;font-weight: bold;">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Nhân and Nghĩa's Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

   

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{url('public/style_admin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{url('public/style_admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{url('public/style_admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{url('public/style_admin/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{url('public/style_admin/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{url('public/style_admin/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{url('public/js/demo/chart-pie-demo.js')}}"></script>
      <!-- Page level plugins -->
    <script src="{{url('public/style_admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('public/style_admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{url('public/style_admin/js/demo/datatables-demo.js')}}"></script>

</body>

</html>