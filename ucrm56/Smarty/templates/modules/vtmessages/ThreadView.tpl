<div>
	<table border=0 cellspacing=1 cellpadding=3 width=100% class="lvt small">
	{foreach item=entity key=entity_id from=$LISTENTITY}
		{* Set the curtopic properties for providing suitable actions *}
		{assign var=CURTOPIC_ISMAIN value=false}
		{assign var=CURTOPIC_ISOWNED value=false}
		{assign var=CURTOPIC_ID value=$entity[$LISTFIELDPOS.topicid]}
		
		{if $entity[$LISTFIELDPOS.topicstart] eq 'yes'|getTranslatedString || $entity[$LISTFIELDPOS.topicstart] eq 1}
			{assign var=CURTOPIC_ISMAIN value=true}
		{/if}
		{if $entity[$LISTFIELDPOS.assigned_user_id] eq $CURRENT_USER_NAME}
			{assign var=CURTOPIC_ISOWNED value=true}
		{/if}

		<tr valign=top bgcolor="white" class="message_{$entity[$LISTFIELDPOS.vtmsgstatus]} {if $CURTOPIC_ISMAIN}message_MainTopic{/if}" id="row_{$entity_id}">
		<td>
			<div style="{if !$CURTOPIC_ISMAIN}margin-left: 20px;{/if}">
				<table width=100% cellpadding=0 cellspacing=0 border=0>
				{if $CURTOPIC_ISMAIN && $entity[$LISTFIELDPOS.subject]}
				<tr>
					<td colspan=4><b>{$entity[$LISTFIELDPOS.subject]|@decode_html}</b></td>
				</tr>
				{/if}
				<tr>
					<td>
						{if $CURTOPIC_ISOWNED}<b>{$MOD.LBL_YOU}</b> {$MOD.LBL_SAID}:{else}<b>{$entity[$LISTFIELDPOS.assigned_user_id]}</b> {$MOD.LBL_SAYS}:{/if} {$MOD.LBL_AT} {$entity[$LISTFIELDPOS.CreatedTime]} <br>
						{$entity[$LISTFIELDPOS.message]|@decode_html}<br>
					</td>
					<td width='20px' style='padding: 5px'>
						{if $CURTOPIC_ISMAIN}
							<a href='javascript:void(0);' onclick='vtmessages.scrapreply(this, "{$MOD.LBL_TO}", "{$entity[$LISTFIELDPOS.subject]|@decode_html}", {$entity_id})'><img title="{$MOD.LBL_REPLY}" src="{'reportsMove.gif'|@vtiger_imageurl:$THEME}" border=0 align='absmiddle'></a>
						{/if}
					</td>
					{if $CURTOPIC_ISMAIN && $ISLISTVIEW}
					<td width='20px' style='padding: 5px'>
							<a href='index.php?module={$MODULE}&action=DetailView&record={$entity_id}'><img title="{$MOD.LBL_SUBJECT}" src="modules/vtmessages/resources/images/jump.gif" border=0 align='absmiddle'></a></td>
					{else}
					<td>&nbsp;</td>
					{/if}
					<td width='30px' style='padding: 5px' rowspan=2>
						{if $CURTOPIC_ISOWNED}
							{* No need to show the current status, as its shown by color changes *}
							{* <br>{$entity[$LISTFIELDPOS.vtmsgstatus]}<br> *}

							{* Allow to toggle the status *}
							{if $entity[$LISTFIELDPOS.vtmsgstatus] eq 'Important'}
								{assign var=USEMARKAS value='Unimportant'}
                       		    {assign var=USEMARKASIMG value='onstar.gif'}
	                            <a href='javascript:void(0);' onclick="vtmessages.markas({$entity_id}, '{$USEMARKAS}')"><img src="{$USEMARKASIMG|@vtiger_imageurl:$THEME}" border=0 align='absmiddle' title="{$MOD.LBL_MARKAS} {'LBL_Unimportant'|getTranslatedString:'vtmessages'}" alt="{$MOD.LBL_MARKAS} {'LBL_Unimportant'|getTranslatedString:'vtmessages'}"></a>
							{else}
                   		    	{assign var=USEMARKAS value='Important'}
	                            {assign var=USEMARKASIMG value='offstar.gif'}
       		                    <a href='javascript:void(0);' onclick="vtmessages.markas({$entity_id}, '{$USEMARKAS}')"><img src="{$USEMARKASIMG|@vtiger_imageurl:$THEME}" border=0 align='absmiddle' title="{$MOD.LBL_MARKAS} {'LBL_Important'|getTranslatedString:'vtmessages'}" alt="{$MOD.LBL_MARKAS} {'LBL_Important'|getTranslatedString:'vtmessages'}"></a>
							{/if}

							{* Icons for status change is not required for now *}
							{*
							{foreach item=USEMARKAS from=$LISTMARKAS}
								{if $USEMARKAS neq $entity[$LISTFIELDPOS.vtmsgstatus]}
									{assign var=USEMARKASIMG value=''}
									{if $USEMARKAS eq 'Read'}{assign var=USEMARKASIMG value='yes.gif'}
									{elseif $USEMARKAS eq 'Unread'}{assign var=USEMARKASIMG value='clear_field.gif'}
									{elseif $USEMARKAS eq 'Important'}{assign var=USEMARKASIMG value='onstar.gif'}
									{elseif $USEMARKAS eq 'Unimportant'}{assign var=USEMARKASIMG value='offstar.gif'}
									{/if}
										<a href='javascript:void(0);' onclick="vtmessages.markas({$entity_id}, '{$USEMARKAS}')"><img src="{$USEMARKASIMG|@vtiger_imageurl:$THEME}" border=0 align='absmiddle' title="{$MOD.LBL_MARKAS} {$USEMARKAS}" alt="{$MOD.LBL_MARKAS} {$USEMARKAS}"></a>
								{/if}
							{/foreach}
							*}
					
							{* No edit required *}
							{* <a href='index.php?module={$MODULE}&action=EditView&record={$entity_id}&return_module={$MODULE}&return_action=index&parenttab={$smarty.request.parenttab}'><img src="{'editfield.gif'|@vtiger_imageurl:$THEME}" border=0 align='absmiddle'></a> | *}

							{* Deleting conversation should be discouraged *}
							{*
							<a href='javascript:confirmdelete("index.php?module={$MODULE}&action=Delete&record={$entity_id}&return_module={$MODULE}&return_action=index&parenttab={$smarty.request.parenttab}")'><img src="{'no.gif'|@vtiger_imageurl:$THEME}" border=0 align='absmiddle'></a>
							*}
						{/if}
					</td>
				</tr>
				</table>
			</div>
		</td>
	</tr>

	{foreachelse}
	<tr><td style="background-color:#efefef;height:340px" align="center" colspan="{$smarty.foreach.listviewforeach.iteration+1}">
		<div style="border: 3px solid rgb(153, 153, 153); background-color: rgb(255, 255, 255); width: 45%; ">
			{assign var=vowel_conf value='LBL_A'}						
			{assign var=MODULE_CREATE value=$SINGLE_MOD}	
			
			<table border="0" cellpadding="5" cellspacing="0" width="98%">
			<tr>
				<td rowspan="2" width="25%"><img src="{'empty.jpg'|@vtiger_imageurl:$THEME}" height="60" width="61"></td>
				<td style="border-bottom: 1px solid rgb(204, 204, 204);" nowrap="nowrap" width="75%"><span class="genHeaderSmall">
				{$APP.LBL_NO} {if $APP.$MODULE_CREATE}{$APP.$MODULE_CREATE}s{else}{$MODULE_CREATE}{/if} {$APP.LBL_FOUND} !
				</span></td>
			</tr>
			</table> 
		</div>
	{/foreach}
	</td></tr>
	</table>
</div>
