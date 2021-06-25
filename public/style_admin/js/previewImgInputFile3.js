//Preview Image 1 Input file
const img = document.getElementById("img");
const inputImg = document.getElementById("inputImg");
const btnCancel = document.getElementById("btnCancel");
function defaultAction()
	{
		inputImg.click();
	}

inputImg.addEventListener("change", function(){
	const file = this.files[0];
	if(file)
	{
		var reader = new FileReader();
		reader.onload = function(){
			var result = reader.result;
			img.src = result;
			img.style.display = 'block';
			btnCancel.style.display = 'block';
		}
		btnCancel.addEventListener("click",function(){
			img.src = "";
			img.style.display = 'none';
			btnCancel.style.display = 'none';
		});
		reader.readAsDataURL(file);
	}
}); 

//Preview Image 2 Input file
const img2 = document.getElementById("img2");
const inputImg2 = document.getElementById("inputImg2");
const btnCancel2 = document.getElementById("btnCancel2");
function defaultAction2()
	{
		inputImg2.click();
	}

inputImg2.addEventListener("change", function(){
	const file = this.files[0];
	if(file)
	{
		var reader = new FileReader();
		reader.onload = function(){
			var result = reader.result;
			img2.src = result;
			img2.style.display = 'block';
			btnCancel2.style.display = 'block';
		}
		btnCancel2.addEventListener("click",function(){
			img2.src = "";
			img2.style.display = 'none';
			btnCancel2.style.display = 'none';
		});
		reader.readAsDataURL(file);
	}
});

//Preview Image 3 Input file
const img3 = document.getElementById("img3");
const inputImg3 = document.getElementById("inputImg3");
const btnCancel3 = document.getElementById("btnCancel3");
function defaultAction3()
	{
		inputImg3.click();
	}

inputImg3.addEventListener("change", function(){
	const file = this.files[0];
	if(file)
	{
		var reader = new FileReader();
		reader.onload = function(){
			var result = reader.result;
			img3.src = result;
			img3.style.display = 'block';
			btnCancel3.style.display = 'block';
		}
		btnCancel3.addEventListener("click",function(){
			img3.src = "";
			img3.style.display = 'none';
			btnCancel3.style.display = 'none';
		});
		reader.readAsDataURL(file);
	}
});

//Preview Image 4 Input file
const img4 = document.getElementById("img4");
const inputImg4 = document.getElementById("inputImg4");
const btnCancel4 = document.getElementById("btnCancel4");
function defaultAction4()
	{
		inputImg4.click();
	}

inputImg4.addEventListener("change", function(){
	const file = this.files[0];
	if(file)
	{
		var reader = new FileReader();
		reader.onload = function(){
			var result = reader.result;
			img4.src = result;
			img4.style.display = 'block';
			btnCancel4.style.display = 'block';
		}
		btnCancel4.addEventListener("click",function(){
			img4.src = "";
			img4.style.display = 'none';
			btnCancel4.style.display = 'none';
		});
		reader.readAsDataURL(file);
	}
});
