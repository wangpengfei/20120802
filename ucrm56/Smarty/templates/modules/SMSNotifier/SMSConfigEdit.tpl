{*<!--
/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ("License"); You may not use this file except in compliance with the License
   * The Original Code is:  vtiger CRM Open Source
   * The Initial Developer of the Original Code is vtiger.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
  *
 ********************************************************************************/
-->*}
<table width="100%" border="0" cellpadding="5" cellspacing="0" class="tableHeading">
	<tr>
		<td style="padding-left:5px;" class="big">{$MOD.SMS_SERVER_CONFIGURATION}</td>                    
		<td valign=top class="small" align="right">
		<input id="smsserver_edit_button" type="button" class="small save" value="{$MOD.SAVE}" onclick="savesmsserver()">
		<input id="smsserver_cannel_button" type="button" class="crmButton small cancel" value="{$MOD.CANNEL}" onclick="cannelsmsserver()">
		</td>
	</tr>
</table>

<table width="100%" cellpadding="5" cellspacing="0" class="listTable" >
	<tr>
	<td class="listTableRow small"  width="100">{$MOD.LBL_USERNAME}</td>
	<td class="listTableRow small"><input type="text"  name="username"   id="username"  value="{$SMSSERVERSEDIT.username}" ></td>
	</tr>
	<tr>
	<td class="listTableRow small">{$MOD.LBL_PWD}</td>
	<td class="listTableRow small"><input type="password"  name="password1"  id="password1" value="{$SMSSERVERSEDIT.password}" ></td>
	</tr>
	<tr>
	<td class="listTableRow small">{$MOD.LBL_ISAVTIVE_LABEL}</td>
	<td class="listTableRow small">
	<input type="radio"  name="isactive"  id="isactive1" value=1 {$SMS.open} >{$MOD.LBL_OPEN_LABEL}
	<input type="radio"  name="isactive"  id="isactive2" value=0 {$SMS.close} >{$MOD.LBL_CLOSE_LABEL}
	</td>
	</tr>
</table>



