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
        window.opener.document.EditView.parent_name.value = product_name;
        window.opener.document.EditView.parent_id.value = product_id;
}
function set_return_specific(product_id, product_name) {
        
	//getOpenerObj used for DetailView 
        var fldName = getOpenerObj("purchaseorder_name");
        var fldId = getOpenerObj("purchaseorder_id");
		if(!fldId){
			var fldId = getOpenerObj("purchaseorder");
		}
        fldName.value = product_name;
        fldId.value = product_id;
}
function set_return_formname_specific(formname, product_id, product_name) {
        window.opener.document.EditView1.purchaseorder_name.value = product_name;
        window.opener.document.EditView1.purchaseorder_id.value = product_id;
        window.opener.document.EditView1.purchaseorder.value = product_id;
}
function set_return_todo(product_id, product_name) {
        window.opener.document.createTodo.task_parent_name.value = product_name;
        window.opener.document.createTodo.task_parent_id.value = product_id;
}

//Function used to add a new product row in PO, SO, Quotes and Invoice
var chargeRowCnt = 0;
function fnAddChargeRow(image_path,amount,plandate){
	chargeRowCnt ++;
	var tableName = document.getElementById('chargeTab');
	var prev = tableName.rows.length;
	var count = eval(prev)-1;//As the table has two headers, we should reduce the count
	//alert(count);
	if(amount == 0) {
		var temp1 = 0.0;
		for(var i=0;i<count;i++) {
			if(document.getElementById("chargeamount"+i).value != '') {
				amount_i = document.getElementById("chargeamount"+i).value;
				temp1 += parseFloat(amount_i);
			}
		}
		amount = roundValue(eval(parseFloat(document.CreateCharges.total.value)-temp1));
		if(amount <= 0) {
			alert(alert_arr.CHARGE_TOTAL_EQUAL_PO_TOTAL);
			return "";
		}
	}
	var chargetimes = 0;
	for(var i=0;i<count;i++) {
			if(document.getElementById("chargeamount"+i).value != '') {
				chargetimes ++;
			}
	}
	chargetimes ++;
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
	colone.innerHTML='<img src="themes/images/delete.gif" border="0" onclick="deleteChargeRow('+count+')"><input id="deleted'+count+'" name="deleted'+count+'" type="hidden" value="0">';

	coltwo.className = "crmTableRow small"
	coltwo.innerHTML= '<input id="chargetimes'+count+'" size=5 name="chargetimes'+count+'" value="'+chargetimes+'" type="text">';

	colthree.className = "crmTableRow small"
	colthree.innerHTML= '<input id="chargeamount'+count+'" size=10 name="chargeamount'+count+'" value="'+amount+'" type="text">';	

	colfour.className = "crmTableRow small"
	colfour.innerHTML= '<input id="jscal_field_chargedate'+count+'" size=10 name="chargedate'+count+'" value="'+plandate+'" type="text"><img src="'+image_path+'btnL3Calendar.gif" id="jscal_trigger_chargedate'+count+'"><font size=1><em old="(yyyy-mm-dd)">(yyyy-mm-dd)</em></font><script id="charge'+count+'">getCalendarPopup("jscal_trigger_chargedate'+count+'","jscal_field_chargedate'+count+'","%Y-%m-%d");</script>';

	eval($("charge"+count).innerHTML);
	document.CreateCharges.chargeplancount.value = count;
	//alert(document.CreateCharges.chargeplancount.value);
}

function deleteChargeRow(i)
{
	chargeRowCnt--;
	var tableName = document.getElementById('chargeTab');
	var prev = tableName.rows.length;
//	document.getElementById('proTab').deleteRow(i);
	document.getElementById("row"+i).style.display = 'none';
	document.getElementById("chargetimes"+i).value = "";
	document.getElementById("chargeamount"+i).value = "";
	document.getElementById("jscal_field_chargedate"+i).value = "";
	
}

function check_data(form) {
	//var tableName = document.getElementById('chargeTab');
	//var prev = tableName.rows.length;
	//alert(prev);
	var chargecount = document.CreateCharges.chargeplancount.value;
	//var chargecount = chargeRowCnt;
	var temp = 0.0;
	for(var i=0;i<=chargecount;i++) {
		if(document.getElementById("row"+i).style.display == 'none') continue;
		if($("chargeamount"+i).value == "" || $("chargeamount"+i).value == 0) {
			alert(alert_arr.CHARGE_IS_NULL);
			return false;
		}
		if($("chargetimes"+i).value == "" || $("chargetimes"+i).value == 0) {
			alert(alert_arr.CHARGE_TIMES_IS_NULL);
			return false;
		}
		if($("jscal_field_chargedate"+i).value == "") {
			alert(alert_arr.CHARGE_DATE_IS_NULL);
			return false;
		}
		var x = dateValidate("jscal_field_chargedate"+i,alert_arr.CHARGE_DATE,"GECD");
		if(!x) return x;
		x = numValidate("chargeamount"+i,alert_arr.CHARGE,"any");
		if(!x) return x;
		x = numValidate("chargetimes"+i,alert_arr.CHARGE_TIMES,"any");
		if(!x) return x;
		temp = eval(temp*1+parseFloat($("chargeamount"+i).value));
	}
	
	var total = $("total").value;
	if(temp < parseFloat(total)) {
		alert(alert_arr.CHARGE_TOTAL_NOT_EQUAL_PO_TOTAL);
		return false;
	}

	if(temp > parseFloat(total)) {
		alert(alert_arr.CHARGE_TOTAL_NOT_EQUAL_PO_TOTAL);
		return false;
	}
	return true;	
}
