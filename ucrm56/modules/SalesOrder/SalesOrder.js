/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
 ********************************************************************************/

document.write("<script type='text/javascript' src='include/js/Inventory.js'></"+"script>");


function set_return(product_id, product_name) {
	if(document.getElementById('from_link').value != '') {
        window.opener.document.QcEditView.parent_name.value = product_name;
        window.opener.document.QcEditView.parent_id.value = product_id;
	} else {
        window.opener.document.EditView.parent_name.value = product_name;
        window.opener.document.EditView.parent_id.value = product_id;
	}
}
function set_return_specific(product_id, product_name, mode) {

        //getOpenerObj used for DetailView 
        var fldName = getOpenerObj("salesorder_name");
        var fldId = getOpenerObj("salesorder_id");
		if(!fldId){
        	var fldId = getOpenerObj("salesorder");
		}
        fldName.value = product_name;
        fldId.value = product_id;
	if(mode != 'DetailView')
	{
		window.opener.document.EditView.action.value = 'EditView';
        	window.opener.document.EditView.convertmode.value = 'update_so_val';
        	window.opener.document.EditView.submit();
	}
}
function set_return_formname_specific(formname, product_id, product_name) {
        window.opener.document.EditView1.purchaseorder_name.value = product_name;
        window.opener.document.EditView1.purchaseorder_id.value = product_id;
}
function set_return_todo(product_id, product_name) {
	if(document.getElementById('from_link').value != '') {
        window.opener.document.QcEditView.task_parent_name.value = product_name;
        window.opener.document.QcEditView.task_parent_id.value = product_id;
	} else {
        window.opener.document.createTodo.task_parent_name.value = product_name;
        window.opener.document.createTodo.task_parent_id.value = product_id;
	}
}


//Function used to add a new product row in PO, SO, Quotes and Invoice
var gatherRowCnt = 0;
function fnAddGatherRow(image_path,amount,plandate){
	gatherRowCnt ++;
	var tableName = document.getElementById('gatherTab');
	var prev = tableName.rows.length;
	var count = eval(prev)-1;//As the table has two headers, we should reduce the count
	//alert(count);
	if(amount == 0) {
		var temp1 = 0.0;
		for(var i=0;i<count;i++) {
			if(document.getElementById("gatheramount"+i).value != '') {
				amount_i = document.getElementById("gatheramount"+i).value;
				temp1 += parseFloat(amount_i);
			}
		}
		amount = roundValue(eval(parseFloat(document.CreateGathers.total.value)-temp1));
		if(amount <= 0) {
			alert(alert_arr.COLLECTION_TOTAL_EQUAL_SALESORDER_TOTAL);
			return "";
		}
	}
	var gathertimes = 0;
	for(var i=0;i<count;i++) {
			if(document.getElementById("gatheramount"+i).value != '') {
				gathertimes ++;
			}
	}
	gathertimes ++;
	var row = tableName.insertRow(prev);
	row.id = "row"+count;
	row.style.verticalAlign = "top";
	
	var colone = row.insertCell(0);
	//colone.width = "15%";
	var coltwo = row.insertCell(1);
	//coltwo.width = "15%";
	var colthree = row.insertCell(2);
	//coltwo.width = "35%";
	var colfour = row.insertCell(3);
	//coltwo.width = "35%";
	

	
	//Delete link
	colone.className = "crmTableRow small";
	colone.innerHTML='<img src="themes/images/delete.gif" border="0" onclick="deleteGatherRow('+count+')"><input id="deleted'+count+'" name="deleted'+count+'" type="hidden" value="0">';

	coltwo.className = "crmTableRow small"
	coltwo.innerHTML= '<input id="gathertimes'+count+'" size=5 name="gathertimes'+count+'" value="'+gathertimes+'" type="text">';

	colthree.className = "crmTableRow small"
	colthree.innerHTML= '<input id="gatheramount'+count+'" size=10 name="gatheramount'+count+'" value="'+amount+'" type="text">';	

	colfour.className = "crmTableRow small"
	colfour.innerHTML= '<input id="jscal_field_gatherdate'+count+'" size=10 name="gatherdate'+count+'" value="'+plandate+'" type="text"><img src="'+image_path+'btnL3Calendar.gif" id="jscal_trigger_gatherdate'+count+'"><font size=1><em old="(yyyy-mm-dd)">(yyyy-mm-dd)</em></font><script id="gather'+count+'">getCalendarPopup("jscal_trigger_gatherdate'+count+'","jscal_field_gatherdate'+count+'","%Y-%m-%d");</script>';

	eval($("gather"+count).innerHTML);
	document.CreateGathers.gatherplancount.value = count;
	//alert(document.CreateGathers.gatherplancount.value);
}
function deleteGatherRow(i)
{
	gatherRowCnt--;
	var tableName = document.getElementById('gatherTab');
	var prev = tableName.rows.length;
//	document.getElementById('proTab').deleteRow(i);
	document.getElementById("row"+i).style.display = 'none';
	document.getElementById("gathertimes"+i).value = "";
	document.getElementById("gatheramount"+i).value = "";
	document.getElementById("jscal_field_gatherdate"+i).value = "";
	
}

function check_data(form) {
	var gathercount = document.CreateGathers.gatherplancount.value;
	
	var temp = 0.0;

	for(var i=0;i<=gathercount;i++) {
		//alert($("gatheramount"+i).value);
		if(document.getElementById("row"+i).style.display == 'none') continue;
		if($("gatheramount"+i).value == "" || $("gatheramount"+i).value == 0) {
			alert(alert_arr.COLLECTION_IS_NULL);
			return false;
		}
		if($("gathertimes"+i).value == "" || $("gathertimes"+i).value == 0) {
			alert(alert_arr.COLLECTION_TIMES_IS_NULL);
			return false;
		}
		if($("jscal_field_gatherdate"+i).value == "") {
			alert(alert_arr.COLLECTION_DATE_IS_NULL);
			return false;
		}
		var x = dateValidate("jscal_field_gatherdate"+i,alert_arr.COLLECTION_DATE,"GECD");
		if(!x) return x;
		x = numValidate("gatheramount"+i,alert_arr.COLLECTION,"any");
		if(!x) return x;
		x = numValidate("gathertimes"+i,alert_arr.COLLECTION_TIMES,"any");
		
		if(!x) return x;
		temp = eval(temp*1+ parseFloat($("gatheramount"+i).value));
	}
	
	var total = parseFloat($("total").value);

	if(temp < total) {
		alert(alert_arr.COLLECTION_TOTAL_NOT_EQUAL_SALESORDER_TOTAL);
		return false;
	}

	if(temp > total) {
		alert(alert_arr.COLLECTION_TOTAL_NOT_EQUAL_SALESORDER_TOTAL);
		return false;
	}
	return true;	
}
















