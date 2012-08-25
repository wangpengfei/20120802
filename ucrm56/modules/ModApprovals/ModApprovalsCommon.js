/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
if (typeof(ModApprovalsCommon) == 'undefined') {
	ModApprovalsCommon = {
		addApproval : function(domkeyid, parentid,cuid,pre_approvalsid) {
			var textBoxField = $('txtbox_'+domkeyid);
			var editareaDOM = $('editarea_'+domkeyid);
			var reportsToID =$('reports_to_id_'+domkeyid); //add by wangyefeng for get next approver id
			var reportsToName =$('reports_to_name_'+domkeyid); //add by wangyefeng for get next approver id
			var contentWrapDOM = $('contentwrap_'+domkeyid);
			if (textBoxField.value == '') {
				return;
			}
			if (reportsToID.value == '') {
				if (!confirm(alert_arr.END_APPROVAL_CONFIRM))
				{
					return;
				}
			}
			
			var url = 'module=ModApprovals&action=ModApprovalsAjax&file=DetailViewAjax&ajax=true&ajxaction=WIDGETADDAPPROVAL&pre_approvalsid='+encodeURIComponent(pre_approvalsid)+'&parentid='+encodeURIComponent(parentid);
			url += '&reports_to_id=' +encodeURIComponent(reportsToID.value); 	// added by wangyefeng for add approver field
			url += '&approval=' + encodeURIComponent(textBoxField.value);
	//	alert(url);

			VtigerJS_DialogBox.block();
			$("vtbusy_info").style.display="inline"; 
			
			new Ajax.Request('index.php',{
				queue: {position: 'end', scope: 'command'},
				method: 'post',
				postBody:url,
				onComplete: function(response) {
					 $("vtbusy_info").style.display="none"; 
					VtigerJS_DialogBox.unblock();
					var isdisplayaddapproval =true;
					
						
					if (reportsToID.value != cuid)
					{
						 isdisplayaddapproval =false;
					}
					var responseTextTrimmed = trim(response.responseText);
					if (responseTextTrimmed.substring(0, 10) == ':#:SUCCESS') 
					{
						textBoxField.value = '';
						reportsToID.value = '';
						reportsToName.value='';
						contentWrapDOM.innerHTML += responseTextTrimmed.substring(10);
						hndCancel('dtlview_'+domkeyid,'editarea_'+domkeyid,domkeyid);
						//if(!isdisplayaddapproval)
						//{
							$('mouseArea_'+domkeyid).onmouseover=function(){}
 						//}
					} else {
						alert(alert_arr.OPERATION_DENIED);
					
					}
				}}
			);
		},
		reloadContentWithFiltering : function(widget, parentid, criteria, targetdomid, indicator) {
			if($(indicator)) $(indicator).style.display="inline";
			
			var url = 'module=ModApprovals&action=ModApprovalsAjax&file=ModApprovalsWidgetHandler&ajax=true';
			url += '&widget=' + encodeURIComponent(widget) + '&parentid='+encodeURIComponent(parentid);
			url += '&criteria='+ encodeURIComponent(criteria);
			
			new Ajax.Request('index.php',{
				queue: {position: 'end', scope: 'command'},
				method: 'post',
				postBody:url,
				onComplete: function(response) {
					if($(indicator)) $(indicator).style.display="none";
					
					if($(targetdomid)) $(targetdomid).innerHTML = response.responseText;
				}}
			);
		}
	}
}

