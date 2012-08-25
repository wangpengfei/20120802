/*
 *检查上传图片的格式，大小 
 */
var image_type=new Array("gif","jpg","jpeg","png","bmp");
function checkimage(imgid){
	if(!checkimagetype(imgid)){
		alert("请选择图片，如:gif|jpg|jpeg|png|bmp");
		return false;
	}
	return true;
}

function checkimagetype(imgid){
	var imurl=$("#"+imgid).val();
	var dinx=imurl.lastIndexOf(".");
	var imtype=imurl.substr(dinx+1);
	for(i=0;i<image_type.length;i++){
		if(imtype.toLowerCase()==image_type[i]){
			return true;
		}
	}
	return false;
}

function checkimgsize(imgid){
	
}