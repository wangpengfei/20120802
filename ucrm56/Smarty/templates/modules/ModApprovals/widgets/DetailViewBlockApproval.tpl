{*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************}
 
{if empty($smarty.request.ajax)}
<table class="small" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td colspan="4" class="dvInnerHeader">
	<div style="float: left; font-weight: bold;">
	<div style="float: left;">
	<a href="javascript:showHideStatus('tbl{$UIKEY}','aid{$UIKEY}','$IMAGE_PATH');"><img id="aid{$UIKEY}" src="{'inactivate.gif'|@vtiger_imageurl:$THEME}" style="border: 0px solid rgb(0, 0, 0);" alt="{$APP.Hide}" title="{$APP.Hide}"></a>
	</div><b>&nbsp;{$WIDGET_TITLE}</b></div>
	<!--span style="float: right;">
		<img src="themes/images/vtbusy.gif" border=0 id="indicator{$UIKEY}" style="display:none;">
		{$APP.LBL_SHOW} <select class="small" onchange="ModApprovalsCommon.reloadContentWithFiltering('{$WIDGET_NAME}', '{$ID}', this.value, 'tbl{$UIKEY}', 'indicator{$UIKEY}');">
			<option value="All" {if $CRITERIA eq 'All'}selected{/if}>{$APP.LBL_ALL}</option>
			<option value="Last5" {if $CRITERIA eq 'Last5'}selected{/if}>{$MOD.LBL_LAST5}</option>
			<option value="Mine" {if $CRITERIA eq 'Mine'}selected{/if}>{$MOD.LBL_MINE}</option>
		</select>
	</span-->
	</td>
</tr>
</table>
{/if}

<div id="tbl{$UIKEY}" style="display:none">
	
	<table class="small" border="0" cellpadding="0" cellspacing="0" width="100%">
	
	<tr style="height: 25px;">
		<td colspan="4" align="left" class="dvtCellInfo" >
		<div id="contentwrap_{$UIKEY}" style="overflow: auto; margin-top: 5px; height: 250px; width: 100%;">
			{foreach item=APPROVALMODEL from=$APPROVALS}
				{include file="modules/ModApprovals/widgets/DetailViewBlockApprovalItem.tpl" APPROVALMODEL=$APPROVALMODEL}
			{/foreach}
		</div>
		</td>
	</tr>
	{if $ADDAPPROVALS_FLAG eq 'newadd' or $ADDAPPROVALS_FLAG eq 'add'} 
	<tr style="height: 25px;">
	<td class="dvtCellLabel" align="right">
		{  $MOD.LBL_ADD_APPROVAL}
	
	</td>
	<td width="100%" colspan="3" class="dvtCellInfo" align="left" id="mouseArea_{$UIKEY}" onmouseover="hndMouseOver(19,'{$UIKEY}');" onmouseout="fnhide('crmspanid');">
		<span id="dtlview_{$UIKEY}"></span>
		
		
		<div id="editarea_{$UIKEY}" style="display:block;">
                  <table>
		  <tr><td>{$MOD.LBL_MODAPPROVALS_INFORMATION}</td><td><textarea id="txtbox_{$UIKEY}" class="detailedViewTextBox" onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'" cols="90" rows="8"></textarea>
		  </td></tr> 
			<tr><td>
			{$MOD.NextApprover}</td><td><input readonly name='reports_to_name' id="reports_to_name_{$UIKEY}" class="small" type="text" value=''  >
			<input name='reports_to_id'   id="reports_to_id_{$UIKEY}"  type="hidden" value=''>&nbsp;
<img  src="{'select.gif'|@vtiger_imageurl:$THEME}" alt="{$APP.LBL_SELECT}" title="{$APP.LBL_SELECT}" LANGUAGE=javascript onclick='return window.open("index.php?module=Users&action=Popup&form=UsersEditView&form_submit=false&fromlink={$fromlink}&recordid={$ID}&domkeyid={$UIKEY}","test","width=640,height=603,resizable=0,scrollbars=0");'align="absmiddle" style='cursor:hand;cursor:pointer'>

	            	&nbsp;<input type="image" src="{'clear_field.gif'|@vtiger_imageurl:$THEME}" alt="{$APP.LBL_CLEAR}" title="{$APP.LBL_CLEAR}" LANGUAGE=javascript onClick="reports_to_id.value=''; reports_to_name.value=''; return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
                        &nbsp;  <font color="gray" ><em>  {$MOD.LBL_MODAPPROVALS_NOTES}    </em></font>
			</td></tr>
			<tr><td colspan="2" align="center"><input type="button" class="crmbutton small save" value="{$APP.LBL_SAVE_LABEL}" onclick="ModApprovalsCommon.addApproval('{$UIKEY}', '{$ID}','{$CUID}','{$PRE_APPROVALS_ID}');fnhide('crmspanid');"/> {$APP.LBL_OR}
			<a href="javascript:;" onclick="hndCancel('dtlview_{$UIKEY}','editarea_{$UIKEY}','{$UIKEY}')" class="link">{$APP.LBL_CANCEL_BUTTON_LABEL}</a>
			</td></tr></table>

			
		</div>
		
	</td>							
	</tr>
	
	{/if}
	</table>
</div>
