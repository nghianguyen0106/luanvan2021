	var left__arr = document.getElementById("left__arr");
   				var right__arr =  document.getElementById("right__arr");
   				var pro = document.getElementsByClassName("product");
   				var l = 0;
   				right__arr.onclick = ()=>{
   					l++;
   					for(var i of pro)
   					{
   						if(l==0){ i.style.left = '0px'; }
   						if(l==1){ i.style.left = '-100%'; }
   						if(l==2){ i.style.left = '0px'; }
   						if(l>2){l=0;}
   					}
   						
   				}

   					left__arr.onclick = ()=>{
	   					l--;
	   					for(var i of pro)
	   					{
	   						if(l==0){ i.style.left = '0px'; }
	   						if(l==1){ i.style.left = '-100%'; }
	   						if(l==2){ i.style.left = '0px'; }
	   						if(l<0){l=0;}
	   					}
	   					
   					}