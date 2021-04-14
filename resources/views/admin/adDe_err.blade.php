@if(Session::has('adDe_err')!=null)
	
	<script>
		alert("Admin đang đăng nhập không thể tự xóa chính mình!");
		window.history.back();
	</script>
{{Session::forget('adDe_err')}}
@endif
