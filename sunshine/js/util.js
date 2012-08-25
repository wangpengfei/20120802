//该文件包含一些常用的函数

function drawImage(ImgD,iwidth,iheight){
	//参数(图片,允许的宽度,允许的高度)
	var image=new Image();
	image.src=ImgD.src;			
	ImgD.height=iheight;
	ImgD.width=image.width*(iheight/image.height);
	ImgD.alt=ImgD.width+"×"+ImgD.height;
}
function resize(img, width, height) {
	 (img.width > img.height) 
	 ? ((img.height = Math.min(height, width * img.height/img.width)) || (img.width = Math.min(width, img.width))) 
	 : ((img.width = Math.min(width, height * img.width/img.height)) || (img.height = Math.min(height, img.height)));
}


//验证一个form表单
function shvalidate(fmid){
	var ret=true;
	$(fmid).each(function(){
		if(this.type=="image") return true;
		if(this.require=="false") return true;		
		if(this.dataType=="Require"){
			if($(this).attr("value")==""){
				alert(this.msg);
				ret=false;
				return false;
			}
		}
		if(this.dataType=="Email"){
			if(!isEmail(this.value)){
				alert(this.msg);
				ret=false;
				return false;
			}
		}
		if(this.dataType=="Phone"){
			if(!isTel(this.value)){
				alert(this.msg);
				ret=false;
				return false;
			}
		}
		return true;
	});
	return ret;
}
//是否是合法的email字符串
function isEmail(strEmail){
	if (strEmail.search(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/) != -1)
		return true;
	else
		return false;
}
//是否是电话号码
function isTel(str){
    var reg=/^([0-9]|[\-])+$/g ;
    if(str.length<7 || str.length>18){
    	return false;
    }else{
    	return reg.exec(str);
    }
}
//判断字符串是否以指定字符串结束
String.prototype.endwithStr=function(str){
	var lastch=this.substring(this.length-1, this.length);
	if(lastch==str) return true;
	return false;
};
//去除字符串左右空格
String.prototype.trim = function() { 
	return this.replace(/(^\s*)|(\s*$)/g, "");
};
//去除字符串所有空格
String.prototype.trimAll = function(){
	var temp=this.replace(/\s*/g, '');
	var result="";
	if(temp!=''){
		for(var i=0;i<temp.length;i++){
			if(temp.charCodeAt(i)!=160){
				result=result+temp.charAt(i);
			}
		}
	}
	return result;
};

//分页访问
function pagevisit(ipage,url){
	var icurp=parseInt($("#cur_page").val());
	var maxpage=parseInt($("#max_page").val());		
	var vpage=1;
	if(ipage=="1"){
		vpage=1;
	}else if(ipage=="2"){
		if(icurp<=1){
			vpage=1;
		}else{
			vpage=icurp-1;
		}			 
	}else if(ipage=="3"){
		if(icurp<maxpage){
			vpage=icurp+1;
		}else{
			alert("已经是最后一页");
			return ;
		}
	}else if(ipage=="4"){
		vpage=maxpage;
	}
	var zurl=url+"&vpage="+vpage;
	location.href=zurl;
}