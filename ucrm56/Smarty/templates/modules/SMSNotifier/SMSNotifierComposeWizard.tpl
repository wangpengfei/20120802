{*<!--
/*+*******************************************************************************
  * The contents of this file are subject to the vtiger CRM Public License Version 1.0
  * ("License"); You may not use this file except in compliance with the License
  * The Original Code is:  vtiger CRM Open Source
  * The Initial Developer of the Original Code is vtiger.
  * Portions created by vtiger are Copyright (C) vtiger.
  * All Rights Reserved.
  *
  *******************************************************************************/
-->*}

<div style="width: 400px;">

	<form method="POST" action="javascript:void(0);">
	
	<table width="100%" cellpadding="5" cellspacing="0" border="0" class="small mailClient">
	<tr>
		<td colspan="2" class="mailClientWriteEmailHeader" width="90%" align="left">{$APP.LBL_COMPOSE_SMS}</td>
	</table>
	
	<table width="100%" cellpadding="5" cellspacing="0" border="0" align="center">
    
	<tr><td>
			{$APP.SELECT_TP}:&nbsp;&nbsp;
			<select class="small" onchange="document.getElementById('message').value=this.value">
            	<option value="">{$APP.Customize_TP}</option>
                {foreach item=tp from=$SMS_TP}
                	<option value="{$tp.body}">{$tp.subject}</option>
                {/foreach}
            </select>
		</td>
    </tr><tr>
    
		<td>
			<textarea name="message" id="message" maxlength='60' class="small" rows="12" cols="10"  onkeyup="$('__smsnotifer_compose_wordcount__').innerHTML=this.value.length"></textarea>
		</td>
    </tr>
	<tr>
    
	<tr>
    <td>
			<input type="checkbox" id="send_time_checkbox" onclick="show_sendtime(this.checked)" />{$MOD.Regularly_sent}&nbsp;&nbsp;
            <div style="display:none; float:right" id="time_div">
            <input name="send_time" type="text" maxlength="16" value="{'Y-m-d H:i'|date}" />
            <font color="#FF0000">{$MOD.Providers_Support}</font>
            </div>
		</td>
    </tr>
    <tr>
		<td align="right"><span id="__smsnotifer_compose_wordcount__">0</span>{$APP.LBL_CHARACTERS} </td>	
	</tr>
	</table>
	
	<table width="100%" cellpadding="5" cellspacing="0" border="0" class="layerPopupTransport">
	<tr>
		<td class="small" align="center">
			<input type="hidden" name="idstring" value="{$IDSTRING}" />
			<input type="hidden" name="phonefields" value="{$PHONEFIELDS}" />
			<input type="hidden" name="sourcemodule" value="{$SOURCEMODULE}" />
			
			<input type="button" class="small crmbutton save" onclick="SMSNotifierCommon.triggerSendSMS(this.form);" value="{$APP.LBL_SEND}"/>
			<input type="button" class="small crmbutton cancel" onclick="SMSNotifierCommon.hideComposeWizard();" value="{$APP.LBL_CANCEL_BUTTON_LABEL}"/>
		</td>
	</tr>
    
	</table>

	</form>
</div>