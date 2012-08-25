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
    {if $SMSSERVERS.id neq ''}
	<input id="smsserver_edit_button" type="button" class="small edit" value="{$MOD.EDIT}" onclick="editsmsserver()">
    {/if}
	</td>
</tr>
</table>
	
<table width="100%" cellpadding="5" cellspacing="0" class="listTable" >
	<tr>
	<td class="listTableRow small"  width="100">{$MOD.LBL_USERNAME}</td>
	<td class="listTableRow small">{$SMSSERVERS.username}</td>
	</tr>
	<tr>
	<td class="listTableRow small">{$MOD.LBL_PWD}</td>
	<td class="listTableRow small">{$SMSSERVERS.password}</td>
	</tr>
	<tr>
	<td class="listTableRow small">{$MOD.LBL_ACCESS_NUM}</td>
	<td class="listTableRow small">{$SMSSERVERS.access_num}</td>
	</tr>
	<tr>
	<td class="listTableRow small">{$MOD.LBL_ISACTIVE}</td>
	<td class="listTableRow small">{$SMSSERVERS.isactive}</td>
	</tr>
</table>

