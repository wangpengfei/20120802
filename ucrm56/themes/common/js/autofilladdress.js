var g_ArrEmailList;
var g_MainDiv = null;
var g_Body = null;
var g_FirstTd = null;
var g_CurrentTd = null;
var g_InputObject = null;
var g_OldInnerTxt = "";
var g_NewInnerTxt = "";
var g_TdCssClassName = "autofill_over";
var g_TbCssClassName = "autofill";
var g_AddListContainer = null;
var g_IgnoreIE = false;

g_IgnoreIE = (navigator.userAgent.indexOf('MSIE 5') != -1 || navigator.userAgent.indexOf('Mac') != -1);

function f_OnKeyDown(obj, event){
	if (obj != g_InputObject){
		if (g_MainDiv != null){
			g_MainDiv.innerHTML = "";
			g_MainDiv = null;
		}
		
		g_OldInnerTxt = "";
		g_NewInnerTxt = "";
		g_FirstTd = null;
		g_CurrentTd = null;
		g_InputObject = obj;
	}
	
	f_InitMain();
	
	var kc = event.keyCode;
	switch (kc){
		case 13:
			f_EnterKey();
			f_SetDivDisplay(false);
			return false;
			break;
		case 9:
			f_SetDivDisplay(false);
			return true;
			break;
		case 27:
			f_EscapeKey();
			f_SetDivDisplay(false);
			return false;
			break;
		case 8:
			f_BackSpaceKey(obj,event);
			return;break;
		case 38:
			f_UpKey();
			return;
			break;
		case 40:
			f_DownKey();
			return;
			break;
		default:
			break;
	}
	return true;
}

function f_OnKeyUp(obj,event){
	var kc = event.keyCode;
	var sTemp = "13,27,38,40,9,116,";
	
	kc = kc + "";
	if (sTemp.indexOf(kc)>-1)
		return false;

	f_InitDivData(obj, event);
	if (g_NewInnerTxt == "" && kc != 32)
		f_SetDivDisplay(false);
	else
		f_SetDivDisplay(true);
}

function f_OnKeyPress(){
	return;
}

function f_OnChange(){
	return;
}

function f_OnBlur(){
	if (g_InputObject == null)
		return;

	var str = g_InputObject.value;
	var x = str.substr(str.length-1, 1);
	if (x == "," || x == ";")
		g_InputObject.value = str.substr(0, str.length-1);
	
	return;
}

function f_OnPasete(){
	return;
}
	
function f_InitMain(){
	if (g_Body == null)
		g_Body = document.body;

	if (g_MainDiv == null){
		g_MainDiv = f_CreateDiv();
		g_Body.appendChild(g_MainDiv);
	}
}

function f_CreateDiv(){
	var div = document.createElement("div");
	
	div.id = "divEmailAddressMain";
	div.style.position = "absolute";
	div.style.display = "";
	
	return div;
}

function f_SetDivDisplay(bTrue){
	if (bTrue)
		g_AddListContainer.style.display = "";
	else
		g_AddListContainer.style.display = "none";
}

function f_GetX(obj) {
	var xx = obj.offsetLeft;
	
	while(obj = obj.offsetParent)
		xx += obj.offsetLeft;
	
	return xx;
}

function f_GetY(obj) {
	var yy = obj.offsetTop;
	
	while (obj = obj.offsetParent)
		yy += obj.offsetTop;

	return yy;
}

function f_CreateTable() {
	var oTable = document.createElement("table");
	
	oTable.border = 0;
	oTable.cellSpacing = 2;
	oTable.cellPadding = 2;
	oTable.className = g_TbCssClassName;
	
	return oTable;
}

function f_CreateRow(table) {
	var rowNode = table.insertRow(-1);
	
	return rowNode;
}

function f_CreateColumn(row, i) {
	var colNode = row.insertCell(document.all ? -1 : 0);
	
	colNode.id = "tdACMA_"+i;
	colNode.zIndex = i;
	colNode.align = "left";
	colNode.style.cursor = document.all ? "hand" : "pointer";
	colNode.onmouseover = f_TdOnmouseover;
	colNode.onclick = f_TdOnclick;
	
	if (i == 0) {
		colNode.className = g_TdCssClassName;
		
		g_FirstTd = colNode;
		g_CurrentTd = colNode;
	}
	else {
		colNode.className = "";
	}
	
	return colNode;
}

function f_TdOnmouseover(elem){
	var obj;
	
	if (!elem)
		var elem = window.event;
	
	if (elem.target)
		obj = elem.target;
	
	if (elem.srcElement)
		obj = elem.srcElement;

	while (obj.tagName != "TD")
		obj = obj.parentNode;
	
	obj.className = "";
	if (g_CurrentTd != null)
		g_CurrentTd.className = "";

	g_CurrentTd = obj;
	g_CurrentTd.className = g_TdCssClassName;
}

function f_TdOnclick(){
	f_FillCurrentEmail()
}

function f_FillCurrentEmail(){
	if (g_CurrentTd == null || g_InputObject == null)
		return;
	
	if (g_ArrEmailList == null || g_ArrEmailList.length == 0)
		return;
	
	var i = parseInt(g_CurrentTd.zIndex);
	var s = g_OldInnerTxt;
	if (g_OldInnerTxt != "")
		s+= ",";
	
	g_InputObject.focus();
	
	if (g_ArrEmailList[i][0] != '')
		g_InputObject.value = s + "\"" + g_ArrEmailList[i][0] + "\" " + "<" + g_ArrEmailList[i][1] + ">";
	else
		g_InputObject.value = s + g_ArrEmailList[i][1];
		
	f_SetDivDisplay(false);
	g_CurrentTd = null;
}

function f_InitDivData(objInput, event){
	var oTb,oTr,oTd;
	
	g_ArrEmailList = f_GetArrEmailList(event);
	if (g_ArrEmailList != null) {
		g_MainDiv.innerHTML = "";
		oTb = f_CreateTable();
		g_MainDiv.appendChild(oTb);
		for (var i = 0; i < g_ArrEmailList.length; i++) {
			oTr = f_CreateRow(oTb);
			oTd = f_CreateColumn(oTr,i);
			var sStrongTextName = g_ArrEmailList[i][0];
			var sStrongTextAddr = g_ArrEmailList[i][1];
			if(g_ArrEmailList[i][0].substring(0,g_NewInnerTxt.length) == g_NewInnerTxt)
				sStrongTextName = "<b>" + g_NewInnerTxt + "</b>" + g_ArrEmailList[i][0].substring(g_NewInnerTxt.length, g_ArrEmailList[i][0].length);
			
			if(g_ArrEmailList[i][1].substring(0,g_NewInnerTxt.length) == g_NewInnerTxt)
				sStrongTextAddr = "<b>" + g_NewInnerTxt + "</b>" + g_ArrEmailList[i][1].substring(g_NewInnerTxt.length, g_ArrEmailList[i][1].length);
			
			if (sStrongTextName != '')
				oTd.innerHTML = "&quot;" + sStrongTextName + "&quot;&nbsp;&lt;" + sStrongTextAddr + "&gt;";
			else
				oTd.innerHTML = sStrongTextAddr;
		}
		
		var e = objInput;
		if (!document.getElementById("divAddListContainer")) {
			var tDiv = document.createElement("div");
			tDiv.id = "divAddListContainer";
			
			with(tDiv.style) {
				position = "absolute";
				zIndex = "99";
				display = "none";
				width = "0px";
				height = "0px";
			}
			
			if (document.all&&!g_IgnoreIE)
				tDiv.innerHTML = '<iframe id="frameAddList" src="blank.htm" scrolling="no" marginwidth="0" marginheight="0" frameborder="1" height="100%" width="100%"></iframe>';
			
			document.body.appendChild(tDiv);
		}
		
		g_AddListContainer = document.getElementById("divAddListContainer");
		g_AddListContainer.style.left = (f_GetX(e) + 1) + "px";
		g_AddListContainer.style.top = (f_GetY(e) + 24) + "px";
		g_AddListContainer.style.display = "";
		g_AddListContainer.appendChild(g_MainDiv);
		g_MainDiv.style.left = 0;
		g_MainDiv.style.top = 0;
		if (document.all && !g_IgnoreIE) {
			var ifr = document.getElementById("frameAddList");
			ifr.style.width = (oTb.offsetWidth+1) + "px";
			ifr.style.height = (oTb.offsetHeight+1) + "px";
		}
	}
}

function f_GetArrEmailList(event){
	if(g_InputObject == null)
		return null;

	var s = g_InputObject.value;
	var k = s.length;
	var iLastSign = 0;
	if(s.lastIndexOf(",") > s.lastIndexOf(";"))
		iLastSign = s.lastIndexOf(",");
	else
		iLastSign = s.lastIndexOf(";");
	
	g_NewInnerTxt = s.substring(iLastSign+1,k);
	if(event.keyCode == 8)
		g_NewInnerTxt = s.substring(iLastSign+1,k-1);
	
	g_NewInnerTxt = f_Trim(g_NewInnerTxt);
	g_OldInnerTxt = s.substring(0, iLastSign);
	g_OldInnerTxt = f_Trim(g_OldInnerTxt);
	
	var arr = new Array();
	var re;
	var j = 0;
	if(g_NewInnerTxt == ""){
		if(event.keyCode == 32) {
			arr = globalEmailAddressList;
		}
	}
	else{
		try{
			re = new RegExp("^" + g_NewInnerTxt, "i");
			for(var i = 0; i < globalEmailAddressList.length; i++){
				if(re.test(globalEmailAddressList[i][0]) || re.test(globalEmailAddressList[i][1])){
					arr[j] = globalEmailAddressList[i];
					j++;
				}
			}
		}
		catch(ex){
		}
	}
	
	return arr;
}

function f_EnterKey(){
	f_FillCurrentEmail();
}

function f_EscapeKey(){
	return;
}

function f_BackSpaceKey(obj, event){
	f_InitDivData(obj,event);
	if (g_NewInnerTxt == "")
   		f_SetDivDisplay(false);
	else
		f_SetDivDisplay(true);
}

function f_UpKey(){
	if (g_CurrentTd == null)
		return;
	
	var k = g_CurrentTd.zIndex-1;
	if (k == -1)
		k += 1;
	
	var oTd = document.getElementById("tdACMA_"+k);
	g_CurrentTd.className = "";
	g_CurrentTd = oTd;
	g_CurrentTd.className = g_TdCssClassName;
	
	f_SetDivDisplay(true);
}

function f_DownKey(){
	if (g_CurrentTd == null)
		return;
	
	var k = g_CurrentTd.zIndex+1;
	if (k == g_ArrEmailList.length)
		k -= 1;
	
	var oTd = document.getElementById("tdACMA_"+k);
	g_CurrentTd.className = "";
	g_CurrentTd = oTd;
	g_CurrentTd.className = g_TdCssClassName;
	
	f_SetDivDisplay(true);
}

function f_Trim(str){
	str = str.replace(/(^\s*)|(\s*$)/g,"");
	
	return str;
}
