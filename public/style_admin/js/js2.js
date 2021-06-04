////Sửa
  var lap = document.getElementById('sua_lap');
  var pc = document.getElementById('sua_pc');
  var loai = document.getElementById('loai').value;
  lap.style.display = 'none';
  pc.style.display = 'none';
  if(loai=="LAPTOP"||loai=="Laptop"||loai=="laptop")
  {
  	lap.style.display = 'block';
    pc.style.display = 'none';
  }
  else
  {
  		lap.style.display = 'none';
      pc.style.display = 'block';
  }


  