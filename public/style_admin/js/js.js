
//BACK//
function back()
    {
        window.history.back();
    }
//END BACK//

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
 if(loai=="LAPTOP"||loai=="Laptop"||loai=="laptop")
 {
    mota__lap.style.display = 'block';
    mota__pc.style.display = 'none';
 }
 else if(loai=="PC"||loai=="Pc"||loai=="pc")
 {
     mota__lap.style.display = 'none';
    mota__pc.style.display = 'block';
 }
}






