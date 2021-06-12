// Validation Login Register updatePass
   function onPass1(){
        //cont__pass
         var ip_old_pass = document.getElementById("cont__pass").value;
         var ip_old_pass_css = document.getElementById("cont__pass");
         var err_pass = document.getElementById("old__pass--err");
         err_pass.style.display = 'none';
        //btn_update
         var btn_update = document.getElementById("btn__update");
        if(ip_old_pass.trim().length<=8)
          {
            err_pass.style.color = 'red';
            ip_old_pass_css.style.border= '3px solid red';
            err_pass.style.display = 'block';
            err_pass.innerHTML="&emsp;Mật khẩu không được quá ngắn(ít nhất 8 kí tự)";
            btn_update.setAttribute("type","button");
          }
          else { 
             ip_old_pass_css.style.border= '3px solid green';
             err_pass.style.display = 'none';
             err_pass.innerHTML="";
             btn_update.setAttribute("type","submit");
          }  
    }
     function onPass2(){
        //cont__pass
         var ip_old_pass = document.getElementById("cont__pass2").value;
         var ip_old_pass_css = document.getElementById("cont__pass2");
         var err_pass = document.getElementById("old__pass--err2");
         err_pass.style.display = 'none';
        //btn_update
         var btn_update = document.getElementById("btn__update");
        if(ip_old_pass.trim().length<=8)
          {
            err_pass.style.color = 'red';
            ip_old_pass_css.style.border= '3px solid red';
            err_pass.style.display = 'block';
            err_pass.innerHTML="&emsp;Mật khẩu mới không được quá ngắn(ít nhất 8 kí tự)";
            btn_update.setAttribute("type","button");
          }
          else { 
             ip_old_pass_css.style.border= '3px solid green';
             err_pass.style.display = 'none';
             err_pass.innerHTML="";
             btn_update.setAttribute("type","submit");
          }  
    }
    function onPass3(){
        //cont__pass
         var ip_old_pass = document.getElementById("cont__pass3").value;
         var ip_old_pass_css = document.getElementById("cont__pass3");
         var err_pass = document.getElementById("old__pass--err3");
         err_pass.style.display = 'none';
        //btn_update
         var btn_update = document.getElementById("btn__update");
        if(ip_old_pass.trim().length<=8)
          {
            err_pass.style.color = 'red';
            ip_old_pass_css.style.border= '3px solid red';
            err_pass.style.display = 'block';
            err_pass.innerHTML="&emsp;Mật khẩu nhập lại phải trùng với mật khẩu vừa mới)";
            btn_update.setAttribute("type","button");
          }
          else { 
             ip_old_pass_css.style.border= '3px solid green';
             err_pass.style.display = 'none';
             err_pass.innerHTML="";
             btn_update.setAttribute("type","submit");
          }  
    }

    function btnLogin()
    {
      var ip_old_pass = document.getElementById("cont__pass").value;
      var ip_pass = document.getElementById("cont__pass").value;
       if(ip_old_pass.length<8||ip_pass.length<8)
       {
        btn_update.setAttribute("type","button");
       }
       else {
         btn_update.setAttribute("type","submit");
       }
    }