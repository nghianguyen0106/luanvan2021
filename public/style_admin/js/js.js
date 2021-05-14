//BACK//
function back()
    {
        window.history.back();
    }
//END BACK//
//LOGIN ADMIN//
var pass = document.getElementById("cont__pass");
function showPass()
{
	var pass = document.getElementById("cont__pass");
    var click = document.getElementById("click__pass");
    click.innerHTML="Ẩn mật khẩu";
	pass.setAttribute("type","text");
}
function hidePass()
{
	var pass = document.getElementById("cont__pass");
    var click = document.getElementById("click__pass");
    click.innerHTML="Hiện mật khẩu";
	pass.setAttribute("type","password");
}
var pwShown = 0;

function showHide(){
    if (pwShown == 0) {
        pwShown = 1;
        showPass();
    } else {
        pwShown = 0;
        hidePass();
    }
}
//DATE PICKER
 $(function() {
        $(".dateInput").datepicker(
            {
                dateFormat:"yy-mm-dd",
                changeMonth:true,
                changeYear:true,
            });
});
//END DATE PICKER
//END LOGIN ADMIN

//ALERT ERROR

//END ALERT ERROR
//Quản lý sản phẩm show hiện ẩn laptop pc
////Thêm
var mota__lap = document.getElementById('mota__lap');
var mota__pc = document.getElementById('mota__pc');
mota__lap.style.display = 'block';
 mota__pc.style.display = 'none';
function change()
{
 var loai = document.getElementById('select__loai').value;
 if(loai==1)
 {
    mota__lap.style.display = 'block';
    mota__pc.style.display = 'none';
 }
 else if(loai==2)
 {
     mota__lap.style.display = 'none';
    mota__pc.style.display = 'block';
 }
}


