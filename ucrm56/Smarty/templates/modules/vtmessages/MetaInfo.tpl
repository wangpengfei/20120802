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

{literal}
<style type='text/css'>{literal}
.message_Read { background: white; }
.message_Unread { background: white; }
/** Overrides above styles if used together */
.message_MainTopic { background: #FFFFDF; }
.message_Important { background: #FEFF9F; }
.message_Unimportant { background: white;  color: gray; }
</style>
{/literal}

<!-- Scrap new form -->
<div id='vtmessages_new_area' class='layerPopup' style='width: 500px; overflow: none; display: none; position:absolute;'>
	<form name="vtmessages_new_form" method="POST" action="javascript:void(0);">
		<table width="100%" cellpadding=5 cellspacing=0 border=0 class="layerHeadingULine">
		<tr>
			<td width="80%" class='layerPopupHeading'>{$MOD.LBL_MESSAGENOW_TO} <span id='vtmessages_new_toname'></span></td>
			<td align=right><a href='javascript:void(0);' onclick="vtmessages.scrapnew_hide()"><img src="{'close.gif'|@vtiger_imageurl:$THEME}" align=top border=0></a></td>
		</tr>
		</table>

		<table width="95%" cellpadding=2 cellspacing=0 border=0>
			<tr width='100%'><td colspan='2' class='dvtCellLabel'><textarea name=message class="small" width="100%"></textarea></td></tr>
			<tr width='100%'>
				<td class='dvtCellLabel' width='75%'><input type=text name=subject class="small" style='width: 98%' value="" ></td>
				<td class='dvtCellLabel'>{$MOD.LBL_SUBJECT} <span class="small">{$MOD.LBL_SUBJECT_EXAMPLE}</span></td>
			</tr>
		</table>

		<table width="95%" cellpadding=2 cellspacing=0 border=0 class=''>
		<tr>
			<td align=right>
				<input type='hidden' name='_tousers' value=''>
				<input type='submit' class='crmbutton small save' onclick="vtmessages.scrapnow(this, this.form)" value="{$MOD.LBL_SEND}">
			</td>
		</tr>
		</table>
	</form>
</div>

<!-- Scrap reply form -->
<div id='vtmessages_reply_area' class='layerPopup' style='width: 500px; overflow: none; display: none; position:absolute;'>
	<form name="vtmessages_reply_form" method="POST" action="javascript:void(0);">
		<table width="100%" cellpadding=5 cellspacing=0 border=0 class="layerHeadingULine">
		<tr>
			<td width="80%" class='layerPopupHeading'>{$MOD.LBL_SENDREPLY} <span id='vtmessages_replyto_title'></span></td>
			<td align=right><a href='javascript:void(0);' onclick="vtmessages.scrapreply_hide()"><img src="{'close.gif'|@vtiger_imageurl:$THEME}" align=top border=0></a></td>
		</tr>
		</table>

		<table width="95%" cellpadding=2 cellspacing=0 border=0>
			<tr width='100%'><td><textarea name=message class="small" width="100%"></textarea></td></tr>
			<tr>
				<td>
					<input type='hidden' name='messageid' value=''>
				</td>
			</tr>
		</table>

		<table width="100%" cellpadding=5 cellspacing=0 border=0 class=''>
		<tr>
			<td align=right><input type='submit' class='crmbutton small save' onclick="vtmessages.replynow(this, this.form)" value="{$MOD.LBL_REPLY}"></td>
		</tr>
		</table>
	</form>
</div>

<!-- Make the forms draggable?  -->
{* DISABLED: I was not able to select text content in textarea/input box *}
{*literal}
<script type="text/javascript">
Drag.init(document.getElementById('vtmessages_new_area'));
Drag.init(document.getElementById('vtmessages_reply_area'));
</script>
{/literal*}
