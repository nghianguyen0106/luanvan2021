//Preview Image Input file
const img = document.getElementById("img");
const inputImg = document.getElementById("inputImg");
const btnCancel = document.getElementById("btnCancel");
const btnImg = document.getElementById("btnImg");
const btnImgEdit = document.getElementById("btnImg__editSP");
function defaultAction()
	{
		inputImg.click();
	}

inputImg.addEventListener("change", function(){
	const file = this.files[0];
	if(file)
	{
		const reader = new FileReader();
		reader.onload = function(){
			const result = reader.result;
			img.src = result;
			img.style.display = 'block';
			btnCancel.style.display = 'block';
			btnImg.style.display="none";
			btnImgEdit.style.display = "block";
		}
		btnCancel.addEventListener("click",function(){
			img.src = "";
			img.style.display = 'none';
			btnCancel.style.display = 'none';
			btnImg.style.display="block";
			btnImgEdit.style.display = "none";
		});
		reader.readAsDataURL(file);
	}
}); 


