
<div style="display: block; position: absolute; left: 225px; top: 150px;" id="creategathersdiv">
<div class="layerPopup" style="display: block; left: 0px; top: 0px;" id="orgLay">
    <form action="index.php" method="POST" name="CreateGathers">
	<input type="hidden" value="SalesOrder" name="module">
	<input type="hidden" value="{$salesorderid}" name="record">
	<input type="hidden" name="action">
	<input type="hidden" value="Sales" name="parenttab">
	<input type="hidden" id="gatherplancount">
	<input type="hidden" name="subject" value="{$subject}">
	
	<table width="100%" cellspacing="0" cellpadding="5" border="0" class="layerHeadingULine">
		<tbody><tr style="cursor: move;">
			<td align="left" class="layerPopupHeading" id="gather_div_title">{$APP.LBL_CREATE_LEAD}{'Gathers'|getTranslatedString:'Gathers'}</td>
			<td align="right"><a href="javascript:fninvsh('orgLay');"><img border="0" align="absmiddle" src="themes/images/close.gif"></a></td>
		</tr>
		</tbody>
   </table>
	
	<table width="95%" cellspacing="0" cellpadding="0" border="0" align="center"> 
	<tbody><tr>
		<td class="small">
			<table width="100%" cellpadding="5" border="0" bgcolor="white" align="center" celspacing="0">
				<tbody>
				<tr>
					<td width="30%" align="right" class="dvtCellLabel">{$APP.Account}</td>
					<td width="70%" class="dvtCellInfo">
                    <input type="text" readonly="readonly" value="{$accountname}"  class="detailedViewTextBox" >
                    <input type="hidden" value="{$accountid}" name="account"></td>
			    </tr>
				<tr>
					<td width="30%" align="right" class="dvtCellLabel">{$APP.LBL_SALES_ORDER_ID}</td>
					<td width="70%" class="dvtCellInfo">
                    <input type="text" readonly="readonly" value="{$salesorder_no}" class="detailedViewTextBox" >
                    <input type="hidden" value="{$salesorderid}" name="salesorder_id"></td>
			    </tr>
				<tr>
					<td width="30%" align="right" class="dvtCellLabel">{'Plan Amount'|getTranslatedString:'Gathers'}</td>
					<td width="70%" class="dvtCellInfo">
                    <input type="text" value="{$total}" class="detailedViewTextBox" name="planamount" id="total" readonly="readonly"></td>
			    </tr>
                <tr>
						<td width="30%" align="right" class="dvtCellLabel">{$APP.LBL_ASSIGNED_TO}：</td>
                       	<td width="70%" class="dvtCellInfo">
				{foreach key=userid item=users from=$users_combo}
					{foreach key=username item=value from=$users}
						{if $value eq 'selected'}
							{assign var=check value=1}
                        {/if}
					{/foreach}
				{/foreach}

				{if $check eq 1}
					{assign var=select_user value='checked'}
					{assign var=style_user value='display:block'}
					{assign var=style_group value='display:none'}
				{else}
					{assign var=select_group value='checked'}
					{assign var=style_user value='display:none'}
					{assign var=style_group value='display:block'}
				{/if}

				<input type="radio" name="assigntype" {$select_user} value="U" onclick="toggleAssignType(this.value)" >&nbsp;{$APP.LBL_USER}

				{if $groups_combo neq ''}
					<input type="radio" name="assigntype" {$select_group} value="T" onclick="toggleAssignType(this.value)">&nbsp;{$APP.LBL_GROUP}
				{/if}
				
				<span id="assign_user" style="{$style_user}">
					<select name="assigned_user_id" class="small">
						{foreach key=key_one item=arr from=$users_combo}
							{foreach key=sel_value item=value from=$arr}
								<option value="{$key_one}" {$value}>{$sel_value}</option>
							{/foreach}
						{/foreach}
					</select>
				</span>

				{if $groups_combo neq ''}
					<span id="assign_team" style="{$style_group}">
						<select name="assigned_group_id" class="small">';
							{foreach key=key_one item=arr from=$groups_combo}
								{foreach key=sel_value item=value from=$arr}
									<option value="{$key_one}" {$value}>{$sel_value}</option>
								{/foreach}
							{/foreach}
						</select>
					</span>
				{/if}
						</td>
				</tr>
				</tbody></table>
			   <table width="100%" cellpadding="5" border="0" bgcolor="white" align="center" celspacing="0" id="gatherTab">
				<tbody>
    <tr>
				<td width="15%" align="left" class="dvtCellLabel">{$APP.LBL_DELETE_BUTTON}</td>
				<td width="15%" align="left" class="dvtCellLabel">{'Times'|getTranslatedString:'Gathers'}</td>
				<td width="25%" align="left" class="dvtCellLabel">{'Plan Amount'|getTranslatedString:'Gathers'}</td>
				<td width="45%" align="left" class="dvtCellLabel">{'Plan Date'|getTranslatedString:'Gathers'}</td>
	</tr>

    </tbody></table>
				
                <table width="100%" cellpadding="5" border="0" bgcolor="white" align="center" celspacing="0">
				<tbody><tr><td align="left" class="dvtCellLabel"><input type="button" class="crmbutton save small" onclick="javascript:fnAddGatherRow('themes/softed/images/',0,'')" value=" {$APP.LBL_ADD_BUTTON} " name="add"></td></tr>
			   </tbody></table><script id="addDefaultPlan">
			   fnAddGatherRow("themes/softed/images/","{$total}","{$date_val}");</script>
			</td>
		</tr>
	</tbody></table>
	<table width="100%" cellspacing="0" cellpadding="5" border="0" class="layerPopupTransport">
	<tbody><tr>
			<td align="center">
				<input type="submit" class="crmbutton save small" onclick="this.form.action.value='SalesOrderToGathers'; return check_data('CreateGathers');" value=" {$APP.LBL_BLOCK_SAVE} " name="Save">&nbsp;&nbsp;
				<input type="button" class="crmbutton cancel small" onclick="fninvsh('orgLay')" value=" {$APP.LBL_BLOCK_CANCEL} " name=" Cancel ">
			</td>
		</tr>
	</tbody></table></form>
</div></div>