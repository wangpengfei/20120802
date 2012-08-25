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

	<table width="100%" cellpadding="5" cellspacing="0" border="0" class="layerHeadingULine">
	<tr>
		<td class="genHeaderSmall" width="90%" align="left">{$MOD.SERVER_NOT_CONF}</td>
		<td width="10%" align="right">
			<a href="javascript:void(0);" onclick="SMSNotifierCommon.hideSelectWizard();"><img src="{'close.gif'|@vtiger_imageurl:$THEME}" border="0"/></a>
		</td>
	</table>
	
	<table width="95%" cellpadding="5" cellspacing="0" border="0" align="center">
	<tr>
		<td>
		
			<table width="100%" cellpadding="5" cellspacing="0" border="0" align="center" bgcolor="white">
			<tr>
				<td align="left"><strong>{$MOD.NO_ACTIVE_SERVER_FOUND}</strong><br/><br/>
                
					{if $IS_ADMIN}{$MOD.REVIEW_SMS_SETTING}{else}{$MOD.CONTACT_ADMIN}{/if}
									
				</td>			
			</tr>			
			</table>			
		
		</td>
	</tr>
	</table>
	
	<table width="100%" cellpadding="5" cellspacing="0" border="0" class="layerPopupTransport">
	<tr>
		<td class="small" align="center">
			<input type="button" class="small crmbutton cancel" onclick="SMSNotifierCommon.hideSelectWizard();" value="{$APP.LBL_CANCEL_BUTTON_LABEL}"/>
		</td>
	</tr>
	</table>
	
	</form>

</div>