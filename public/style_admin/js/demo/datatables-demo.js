// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({ 
   "language":{
    "lengthMenu":"Số dòng hiển thị: _MENU_",
    "search":"Tìm:",
    "emptyTable":"Chưa có dữ liệu!",
    "info":"Hiển thị _END_ của tổng _TOTAL_ dữ liệu",
    "infoEmpty":"Dữ liệu trống",
    "infoFiltered":"trên tổng _MAX_ dữ liệu đang có",
    "zeroRecords":"Không tìm thấy dữ liệu",
    "paginate":{
      "previous":"Trang trước",
      "next":"Trang kế",
    }
   },
 });
});
