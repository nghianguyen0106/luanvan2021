//đổi pass 1
var pass = document.getElementById("cont__pass");
pass.setAttribute("type","password");
function showPass()
{
	var pass = document.getElementById("cont__pass");
    var click = document.getElementById("click__pass");
    click.setAttribute("class","far fa-eye-slash");
	pass.setAttribute("type","text");
}
function hidePass()
{
	var pass = document.getElementById("cont__pass");
     var click = document.getElementById("click__pass");
    click.setAttribute("class","far fa-eye");
	pass.setAttribute("type","password");
}
var pwShown = 0;

document.getElementById("click__pass").addEventListener("click", function () {
    if (pwShown == 0) {
        pwShown = 1;
        showPass();
    } else {
        pwShown = 0;
        hidePass();
    }
}, false);

// nhập lại đổi pass 1
var pass = document.getElementById("cont__pass2");
pass.setAttribute("type","password");
function showPass2()
{
	var pass = document.getElementById("cont__pass2");
     var click = document.getElementById("click__pass2");
    click.setAttribute("class","far fa-eye-slash");
	pass.setAttribute("type","text");
}
function hidePass2()
{
	var pass = document.getElementById("cont__pass2");
	pass.setAttribute("type","password");
     var click = document.getElementById("click__pass2");
    click.setAttribute("class","far fa-eye");
}
var pwShown = 0;

document.getElementById("click__pass2").addEventListener("click", function () {
    if (pwShown == 0) {
        pwShown = 1;
        showPass2();
    } else {
        pwShown = 0;
        hidePass2();
    }
}, false);

// nhập lại đổi pass 2 
var pass = document.getElementById("cont__pass3");
pass.setAttribute("type","password");
function showPass3()
{
	var pass = document.getElementById("cont__pass3");
     var click = document.getElementById("click__pass3");
    click.setAttribute("class","far fa-eye-slash");
	pass.setAttribute("type","text");
}
function hidePass3()
{
	var pass = document.getElementById("cont__pass3");
     var click = document.getElementById("click__pass3");
    click.setAttribute("class","far fa-eye");
	pass.setAttribute("type","password");
}
var pwShown = 0;

document.getElementById("click__pass3").addEventListener("click", function () {
    if (pwShown == 0) {
        pwShown = 1;
        showPass3();
    } else {
        pwShown = 0;
        hidePass3();
    }
}, false);

