function cencel(){
	window.close();
}

function change(obj){
	document.getElementById('sendmsg').value=obj.value;
	showcharnum();
}

function showcharnum(){
	var msg = document.getElementById("sendmsg").value;
	var length = msg.length;
	document.getElementById("showchars").innerHTML=length +' characters have been entered';	
}

function sendsms(obj){

	var message = obj.sendmsg.value;
	 
	
	if(message==""){
		return false;
	}
	
	var idstring = obj.idstring.value;
	
	//var sourcemodule='Accounts';
	var sourcemodule='Mentee';
	
	//var phonefields ="phone";
	var phonefields ="cf_786";
	
	if(obj.dep){
	
		var dep =document.getElementById("dep");   
		var option=dep.getElementsByTagName("option");   
		for(var i=0;i<option.length;++i)   
		{   
			if(option[i].selected)   
			{   
				dep=option[i].text;  
			}   
		}   
		var pro =document.getElementById("pro");   
		var option=pro.getElementsByTagName("option");   
		for(var i=0;i<option.length;++i)   
		{   
			if(option[i].selected)   
			{   
				pro=option[i].text;  
			}   
		}   
		
		var cou = obj.cou.value; 
		var par = obj.par.value;
	}

	if(idstring) {
		
		var url = 'module=SMSNotifier&action=SMSNotifierAjax&ajax=true&file=SMSNotifierSend';	
		url += '&sourcemodule=' + encodeURIComponent(sourcemodule);
		url += '&idstring=' + encodeURIComponent(idstring);
		url += '&phonefields=' + encodeURIComponent(phonefields);
		url += '&message=' + encodeURIComponent(message);
		if(obj.dep){
			url += '&dep=' + encodeURIComponent(dep);
			url += '&pro=' + encodeURIComponent(pro);
			url += '&cou=' + encodeURIComponent(cou);
			url += '&par=' + encodeURIComponent(par);
		}
			
		new Ajax.Request('index.php', {
		queue: {position: 'end', scope: 'command'},
		method: 'post',
		postBody:url,
		onLoading:function (){
			document.getElementById("returnmsg").innerHTML='<font color="blue">正在发送中...</font>';		
		},
		onComplete: function(response) {					
			document.getElementById("returnmsg").innerHTML='<font color="blue">'+response.responseText+'</font>';		
		}
		});
	}
}

function getProject(obj){

	var depid = obj.options[obj.options.selectedIndex].value;
	var url = 'module=SMSNotifier&action=SMSNotifierAjax&file=getCourseandProject';	
	url += '&depid=' + encodeURIComponent(depid);
	
	new Ajax.Request('index.php', {
		queue: {position: 'end', scope: 'command'},
		method: 'post',
		postBody:url,
		onComplete: function(response) {					
			var prostr = response.responseText;
			proarr = prostr.split("#");
			var length = proarr.length;
			var objSelect = document.frm.pro; 
			objSelect.length=0;
			objSelect.options[0]= new Option("请选择","0");
			for( var i=0; i<length; i++ ){
				var zhu = proarr[i].split("$");
				if(zhu[0]!=""){
					objSelect.options[i+1]= new Option(zhu[1],zhu[0]);
				}
			}
			if(prostr==""){
				objSelect.options.length=0;
				objSelect.options[0]= new Option("请选择","0");
			}
		}
	});

}

function getCourse(obj){

	var proid = obj.options[obj.options.selectedIndex].value;
	var url = 'module=SMSNotifier&action=SMSNotifierAjax&file=getCourseandProject';	
	url += '&proid=' + encodeURIComponent(proid);
	
	new Ajax.Request('index.php', {
		queue: {position: 'end', scope: 'command'},
		method: 'post',
		postBody:url,
		onComplete: function(response) {	
			var coursestr = response.responseText;	
			coursearr = coursestr.split("#");
			var length = coursearr.length;
			var objSelect = document.frm.cou; 
			objSelect.length=0;
			objSelect.options[0]= new Option("请选择","0");
			for( var i=0; i<length; i++ ){
				var zhu = coursearr[i].split("$");
				if(zhu[0]!=""){
					objSelect.options[i+1]= new Option(zhu[1],zhu[0]);
				}
			}
			if(coursestr==""){
				objSelect.options.length=0;
				objSelect.options[0]= new Option("请选择","0");
			}
		}
	});
}


