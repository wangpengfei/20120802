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
{if $smarty.request.ajax neq ''}
&#&#&#{$ERROR}&#&#&#
{/if}

<form name="massdelete" method="POST" id="massdelete">
     <input name='search_url' id="search_url" type='hidden' value='{$SEARCH_URL}'>
     <input name="idlist" id="idlist" type="hidden">
     <input name="change_owner" type="hidden">
     <input name="change_status" type="hidden">
     <input name="action" type="hidden">
     <input name="where_export" type="hidden" value="{php} echo to_html($_SESSION['export_where']);{/php}">
     <input name="step" type="hidden">
     <input name="allids" type="hidden" id="allids" value="{$ALLIDS}">
     <input name="selectedboxes" id="selectedboxes" type="hidden" value="{$SELECTEDIDS}">
     <input name="allselectedboxes" id="allselectedboxes" type="hidden" value="{$ALLSELECTEDIDS}">
     <input name="current_page_boxes" id="current_page_boxes" type="hidden" value="{$CURRENT_PAGE_BOXES}">
		<!-- List View Master Holder starts -->
		<table border=0 cellspacing=1 cellpadding=0 width=100% class="lvtBg">
		<tr>
			<td>
				<!-- List View's Buttons and Filters starts -->
			    <table border=0 cellspacing=0 cellpadding=2 width=100% class="small">
			    <tr>
					<!-- Thread or Topic view -->
					<td nowrap>						 
						<select class='small' onchange='location.href=this.value'>
							<option value='index.php?module={$MODULE}&action=ListView&_onlytopics=false' {if $TOPICVIEW eq false}selected=true{/if}>{$MOD.LBL_THREAD} {$MOD.LBL_VIEW}</option>
							<option value='index.php?module={$MODULE}&action=ListView&_onlytopics=true' {if $TOPICVIEW eq true}selected=true{/if}>{$MOD.LBL_TOPIC} {$MOD.LBL_VIEW}</option>
						</select>				
					</td>

					<!-- Record Counts -->
					<td style="padding-right:20px" class="small" nowrap width="10%">{$recordListRange}</td>
					<!-- Page Navigation -->
			        <td nowrap width="50%">
						<table border=0 cellspacing=0 cellpadding=0 class="small">
							<tr>{$NAVIGATION}</tr>
						</table>
    	            </td>

					<td width=100% align="right">
						<!-- Filters -->
						{if $HIDE_CUSTOM_LINKS neq '1'}
						<table border=0 cellspacing=0 cellpadding=0 class="small">
						<tr>
							<td>{$APP.LBL_VIEW}</td>
							<td style="padding-left:5px;padding-right:5px">
        	                    <SELECT NAME="viewname" id="viewname" class="small" onchange="showDefaultCustomView(this,'{$MODULE}','{$CATEGORY}')">{$CUSTOMVIEW_OPTION}</SELECT></td>
           	                {if $ALL eq 'All'}
							<td>
								<a href="index.php?module={$MODULE}&action=CustomView&parenttab={$CATEGORY}">{$APP.LNK_CV_CREATEVIEW}</a>
								<span class="small">|</span>
								<span class="small" disabled>{$APP.LNK_CV_EDIT}</span>
								<span class="small">|</span>
								<span class="small" disabled>{$APP.LNK_CV_DELETE}</span>
							</td>
						    {else}
							<td><a href="index.php?module={$MODULE}&action=CustomView&parenttab={$CATEGORY}">{$APP.LNK_CV_CREATEVIEW}</a>
								<span class="small">|</span>
           		                <a href="index.php?module={$MODULE}&action=CustomView&record={$VIEWID}&parenttab={$CATEGORY}">{$APP.LNK_CV_EDIT}</a>
                   		        <span class="small">|</span>
								<a href="javascript:confirmdelete('index.php?module=CustomView&action=Delete&dmodule={$MODULE}&record={$VIEWID}&parenttab={$CATEGORY}')">{$APP.LNK_CV_DELETE}</a>
							</td>
					    	{/if}
						</tr>
						</table> 
						<!-- Filters  END-->
						{/if}
					</td>	
       		    </tr>
			</table>
			<!-- List View's Buttons and Filters ends -->
			
			{include file="modules/vtmessages/ThreadView.tpl"}

			<table border=0 cellspacing=0 cellpadding=2 width=100% class="small">
				<tr>
					<!-- Record Counts -->
					<td style="padding-right:20px" class="small" nowrap width="10%">{$recordListRange}&nbsp;</td>
					<!-- Page Navigation -->
			        <td nowrap width="90%" align="right" colspan="2">
						<table border=0 cellspacing=0 cellpadding=0 class="small">
							<tr>{$NAVIGATION}</tr>
						</table>
    	            </td>
				</tr>
			</table>
 		</td>
	</tr>
	</table>
</form>	

{$SELECT_SCRIPT}
<div id="basicsearchcolumns" style="display:none;"><select name="search_field" id="bas_searchfield" class="txtBox" style="width:150px">{html_options  options=$SEARCHLISTHEADER}</select></div>
