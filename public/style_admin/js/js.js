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
