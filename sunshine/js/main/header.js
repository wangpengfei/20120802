//用户登录
function userLogin(){
	var elid="#floatBox #userlogin input";
	if(!shvalidate(elid)) return;
	var fusername=$("#floatBox #userlogin input[id='username']").val();
	var fpwd=$("#floatBox #userlogin input[id='upasswd']").val();	
	var url="index.php?action=firstpage&method=userLogin";
	$.post(url,{username : fusername , upasswd : fpwd },function(data){
		if(data=="0"){
			alert("用户名不存在");			
		}else if(data=="-1"){
			alert("密码错误！");
		}else{
			alert("登录成功！");
			$("#userid").val(data);
			$("#isreg").val("0");
			$("#dspusername").text(fusername);
		}
		closedialog();
	},"html");
}
//注册新用户
function regeditUser(){
	var elid="#floatBox #reguser input";
	if(!shvalidate(elid)) return;
	//取到所有输入项
	var fudspname=$("#floatBox #reguser input[id='udspname']").val();
	var fpwd=$("#floatBox #reguser input[id='upasswd']").val();	
	var fqrpwd=$("#floatBox #reguser input[id='qrupasswd']").val();
	var fucompany=$("#floatBox #reguser input[id='ucompany']").val();
	var fudepart=$("#floatBox #reguser input[id='udepart']").val();
	var fulinkman=$("#floatBox #reguser input[id='ulinkman']").val();
	var fuphone=$("#floatBox #reguser input[id='uphone']").val();
	var fuemail=$("#floatBox #reguser input[id='uemail']").val();
	if(fpwd!=fqrpwd){
		alert("两次输入密码不一致!");
		return false;
	}
	var url="index.php?action=firstpage&method=regditUser";
	$.post(url,{udspname : fudspname , upasswd : fpwd , ucompany : fucompany , 
		udepart : fudepart ,ulinkman : fulinkman , uphone : fuphone , uemail : fuemail},function(data){
		if(data!="0"){
			alert("注册新用户成功");
			$("#userid").val(data);
			$("#isreg").val("0");
			$("#dspusername").text(fudspname);
		}else{
			alert("注册新用户失败，请稍后再注册!");
		}
		closedialog();
	},"text");
}

//按关键字查询
function searchbykey(oid){
	var kw=$("#"+oid).val();
	var url="index.php?action=frontproduct&method=searchByKey&keyword="+kw.trim();
	location.href=encodeURI(url);
}
//得到产品的详细信息
function getprodetail(pid){
	var url="index.php?action=frontproduct&method=getprodetail&pid="+pid;
	window.open(url,"产品详细信息");
}
//分页访问产品列表
function gotoPage(ipage){
	var mth=$("#bcmethod").val();
	var mparam=$("#bcparam").val();
	var zurl="index.php?action=frontproduct&method="+mth.trim()+"&"+mparam.trim();
	pagevisit(ipage,encodeURI(zurl));		
}
//菜单导航
function gotoCategory(cid){	
	var ctname=$("#"+cid).text();
	var zurl="index.php?action=frontproduct&method=dodefault&ctname="+ctname.trimAll();
	location.href=encodeURI(zurl);
}
//禁用右键菜单
$(document).ready(function(){
    $(document).bind("contextmenu",function(e){
        return false;
    });
});
// JavaScript Document
//变换导航商品类目,当选择某一类目时导航的css改变。
function ChangedItime(ItemsID)
{
	var objIndex = document.getElementById("index");
	var objRecommend = document.getElementById("recommend");
	var objBrand = document.getElementById("brand");
	var objTextile = document.getElementById("textile");
	var objTicket = document.getElementById("ticket");
	var objLife = document.getElementById("life");
	var objKitchen = document.getElementById("kitchen");
	var objMovement = document.getElementById("movement");
	var objPromotions = document.getElementById("promotions");
	var objAbout = document.getElementById("about");
	var switchItemId = ItemsID;
	switch (switchItemId)
	{
		case "index":
			objIndex.className = "h_menu1_down";
			objRecommend.className = "h_menu2";
			objBrand.className = "h_menu3";
			objTextile.className = "h_menu4";
			objTicket.className = "h_menu5";
			objLife.className = "h_menu6";
			objKitchen.className = "h_menu7";
			objMovement.className = "h_menu8";
			objPromotions.className = "h_menu9";
			objAbout.className = "h_menu11";
			break;
		case "recommend":
			objIndex.className = "h_menu0";
			objRecommend.className = "h_menu10";
			objBrand.className = "h_menu3";
			objTextile.className = "h_menu4";
			objTicket.className = "h_menu5";
			objLife.className = "h_menu6";
			objKitchen.className = "h_menu7";
			objMovement.className = "h_menu8";
			objPromotions.className = "h_menu9";
			objAbout.className = "h_menu11";
			break;
		case "brand":
			objIndex.className = "h_menu0";
			objRecommend.className = "h_menu2";
			objBrand.className = "h_menu10";
			objTextile.className = "h_menu4";
			objTicket.className = "h_menu5";
			objLife.className = "h_menu6";
			objKitchen.className = "h_menu7";
			objMovement.className = "h_menu8";
			objPromotions.className = "h_menu9";
			objAbout.className = "h_menu11";
			break;
		case "textile":
			objIndex.className = "h_menu0";
			objRecommend.className = "h_menu2";
			objBrand.className = "h_menu3";
			objTextile.className = "h_menu10";
			objTicket.className = "h_menu5";
			objLife.className = "h_menu6";
			objKitchen.className = "h_menu7";
			objMovement.className = "h_menu8";
			objPromotions.className = "h_menu9";
			objAbout.className = "h_menu11";
			break;
		case "ticket":
			objIndex.className = "h_menu0";
			objRecommend.className = "h_menu2";
			objBrand.className = "h_menu3";
			objTextile.className = "h_menu4";
			objTicket.className = "h_menu10";
			objLife.className = "h_menu6";
			objKitchen.className = "h_menu7";
			objMovement.className = "h_menu8";
			objPromotions.className = "h_menu9";
			objAbout.className = "h_menu11";
			break;
		case "life":
			objIndex.className = "h_menu0";
			objRecommend.className = "h_menu2";
			objBrand.className = "h_menu3";
			objTextile.className = "h_menu4";
			objTicket.className = "h_menu5";
			objLife.className = "h_menu10";
			objKitchen.className = "h_menu7";
			objMovement.className = "h_menu8";
			objPromotions.className = "h_menu9";
			objAbout.className = "h_menu11";
			break;
		case "kitchen":
			objIndex.className = "h_menu0";
			objRecommend.className = "h_menu2";
			objBrand.className = "h_menu3";
			objTextile.className = "h_menu4";
			objTicket.className = "h_menu5";
			objLife.className = "h_menu6";
			objKitchen.className = "h_menu10";
			objMovement.className = "h_menu8";
			objPromotions.className = "h_menu9";
			objAbout.className = "h_menu11";
			break;
		case "movement":
			objIndex.className = "h_menu0";
			objRecommend.className = "h_menu2";
			objBrand.className = "h_menu3";
			objTextile.className = "h_menu4";
			objTicket.className = "h_menu5";
			objLife.className = "h_menu6";
			objKitchen.className = "h_menu7";
			objPromotions.className = "h_menu9";
			objMovement.className = "h_menu10";
			objAbout.className = "h_menu11";
			break;
		case "promotions":
			objIndex.className = "h_menu0";
			objRecommend.className = "h_menu2";
			objBrand.className = "h_menu3";
			objTextile.className = "h_menu4";
			objTicket.className = "h_menu5";
			objLife.className = "h_menu6";
			objKitchen.className = "h_menu7";
			objPromotions.className = "h_menu10";
			objMovement.className = "h_menu8";
			objAbout.className = "h_menu11";
			break;
		case "about":
			objIndex.className = "h_menu0";
			objRecommend.className = "h_menu2";
			objBrand.className = "h_menu3";
			objTextile.className = "h_menu4";
			objTicket.className = "h_menu5";
			objLife.className = "h_menu6";
			objKitchen.className = "h_menu7";
			objPromotions.className = "h_menu9";
			objMovement.className = "h_menu8";
			objAbout.className = "h_menu10";
			break;	
	}
}
