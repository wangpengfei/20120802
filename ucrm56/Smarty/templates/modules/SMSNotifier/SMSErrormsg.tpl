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

<div style="width: 400px;"   onclick="javascript:this.style.display='none'">

	<form method="POST" action="javascript:void(0);">
	
	<table width="100%" cellpadding="0" cellspacing="0" border="0" class="small mailClient">
	<tr>
		<td colspan="2" class="mailClientWriteEmailHeader" width="90%" align="left">{$APP.LBL_ERROR_LABEL}</td>
	
	</table>
	
	<table width="100%" cellpadding="5" cellspacing="0" border="0" align="center">
		<tr>
			<td align="center">
			
			<div style="width:400px;height:40px;line-height:40px;text-align:center;color:red;font-size:15px;">
			{$MSG}
			</div>
			
			</td>	
		</tr>
	</table>
	
	<table width="100%" cellpadding="5" cellspacing="0" border="0" class="layerPopupTransport">
	<tr>
		<td class="small" align="center">
		&nbsp;
		</td>
	</tr>
	</table>

	</form>
</div>
