{*<!--
/*********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *
 ********************************************************************************/
-->*}
<script language="JavaScript" type="text/javascript" src="modules/{$MODULE}/{$MODULE}.js"></script>

{include file='Buttons_List1.tpl'}

{*<!-- Contents -->*}
<table border=0 cellspacing=0 cellpadding=0 width=98% align=center>
     <tr>
        <td valign=top>&nbsp;</td>
		<td class="showPanelBg" valign="top" width=100% style="padding:10px;">

		<table width="100%" cellpadding=2 cellspacing=2 border=0>
		<tr valign=top>
			<td align=right><input type='button' class='crmbutton small cancel' value='{$APP.LBL_GO_BACK}' onclick='history.back();'></td>
		</tr>
		</table>

		<!-- PUBLIC CONTENTS STARTS-->
		<table width="100%" cellpadding=2 cellspacing=2 border=0>
		<tr valign=top>
			<td>
				{include file="modules/vtmessages/DetailViewAjax.tpl"}
			</td>
		</tr>
		</table>

	</td>
	<td valign=top>&nbsp;</td>
</tr>
</table>

{include file='modules/vtmessages/MetaInfo.tpl'}
