
							{foreach key=header item=detail from=$BLOCKS}

							<!-- Detailed View Code starts here-->
							<table border=0 cellspacing=0 cellpadding=0 width=100% class="small">
							<tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                             <td align=right>
							{if $header eq $MOD.LBL_ADDRESS_INFORMATION && ($MODULE eq 'Accounts' || $MODULE eq 'Contacts' || $MODULE eq 'Leads') }
                             {if $MODULE eq 'Leads'}
                             <input name="mapbutton" value="{$APP.LBL_LOCATE_MAP}" class="crmbutton small create" type="button" onClick="searchMapLocation( 'Main' )" title="{$APP.LBL_LOCATE_MAP}">
                             {else}
                             <input name="mapbutton" value="{$APP.LBL_LOCATE_MAP}" class="crmbutton small create" type="button" onClick="fnvshobj(this,'locateMap');" onMouseOut="fninvsh('locateMap');" title="{$APP.LBL_LOCATE_MAP}">
							{/if}
                             {/if}
                             </td>
                             </tr>

							<!-- This is added to display the existing comments -->
							{if $header eq $MOD.LBL_COMMENTS || $header eq $MOD.LBL_COMMENT_INFORMATION}
							   <tr>
								<td colspan=4 class="dvInnerHeader">
						        	<b>{$MOD.LBL_COMMENT_INFORMATION}</b>
								</td>
							   </tr>
							   <tr>
							   			<td colspan=4 class="dvtCellInfo">{$COMMENT_BLOCK}</td>
							   </tr>
							   <tr><td>&nbsp;</td></tr>
							{/if}


	{if $header neq 'Comments'}
 
						     <tr>{strip}
						     <td colspan=4 class="dvInnerHeader">
							
							<div style="float:left;font-weight:bold;"><div style="float:left;"><a href="javascript:showHideStatus('tbl{$header|replace:' ':''}','aid{$header|replace:' ':''}','{$IMAGE_PATH}');">
							
								</a></div><b>&nbsp;
						        	{$header}
	  			     			</b></div>
						     </td>{/strip}
					             </tr>
{/if}
							</table>
{if $header neq 'Comments'}
							{if $BLOCKINITIALSTATUS[$header] neq 1}
							<div style="width:auto;display:block;" id="tbl{$header|replace:' ':''}" >
							{else}
							<div style="width:auto;display:none;" id="tbl{$header|replace:' ':''}" >
							{/if}
							<table border=0 cellspacing=0 cellpadding=0 width="100%" class="small">
						   {foreach item=detail from=$detail}
						     <tr style="height:25px">
							{foreach key=label item=data from=$detail}
							   {assign var=keyid value=$data.ui}
							   {assign var=keyval value=$data.value}
							   {assign var=keytblname value=$data.tablename}
							   {assign var=keyfldname value=$data.fldname}
							   {assign var=keyfldid value=$data.fldid}
							   {assign var=keyoptions value=$data.options}
							   {assign var=keysecid value=$data.secid}
							   {assign var=keyseclink value=$data.link}
							   {assign var=keycursymb value=$data.cursymb}
							   {assign var=keysalut value=$data.salut}
							   {assign var=keyaccess value=$data.notaccess}
							   {assign var=keycntimage value=$data.cntimage}
							   {assign var=keyadmin value=$data.isadmin}
							   {assign var=display_type value=$data.displaytype}
							   
							   
                           {if $label ne ''}
	                        {if $keycntimage ne ''}
				<td class="dvtCellLabel" align=right width=25%><input type="hidden" id="hdtxt_IsAdmin" value={$keyadmin}></input>{$keycntimage}</td>
				{elseif $keyid eq '71' || $keyid eq '72'}<!-- Currency symbol -->
					<td class="dvtCellLabel" align=right width=25%>{$label}<input type="hidden" id="hdtxt_IsAdmin" value={$keyadmin}></input> ({$keycursymb})</td>
				{else}
					<td class="dvtCellLabel" align=right width=25%><input type="hidden" id="hdtxt_IsAdmin" value={$keyadmin}></input>{$label}</td>
				{/if}
				{if $EDIT_PERMISSION eq 'yes' && $display_type neq '2'}
					{* Performance Optimization Control *}
					{if !empty($DETAILVIEW_AJAX_EDIT) }
						{include file="cp/DetailViewUI.tpl"}
					{else}
						{include file="cp/DetailViewFields.tpl"}
					{/if}
					{* END *}
				{else}
					{include file="cp/DetailViewUI.tpl"}
				{/if}
			   {/if}
                                   {/foreach}
						      </tr>	
						   {/foreach}	
						     </table>
							 </div>
{/if}
                     	                      </td>
					   </tr>
		<tr><td style="padding:5px">
			{/foreach}
                    {*-- End of Blocks--*}
                    