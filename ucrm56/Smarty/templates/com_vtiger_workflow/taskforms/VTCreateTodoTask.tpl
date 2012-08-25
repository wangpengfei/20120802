<script src="modules/com_vtiger_workflow/resources/vtigerwebservices.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">
var moduleName = '{$entityName}';
var taskStatus = '{$task->status}';
var taskPriority = '{$task->priority}';
</script>

<script src="modules/com_vtiger_workflow/resources/createtodotaskscript.js" type="text/javascript" charset="utf-8"></script>

<div id="view">
	<table border="0" cellpadding="5" cellspacing="0" width="100%" class="small">
	<tr valign="top">
		<td class='dvtCellLabel' align="right" width=15% nowrap="nowrap"><b><font color=red>*</font> {$APP.Todo}</b></td>
		<td class='dvtCellInfo'><input type="text" name="todo" value="{$task->todo}" id="workflow_todo" class="form_input"></td>
	</tr>
	<tr valign="top">
		<td class='dvtCellLabel' align="right" width=15% nowrap="nowrap"><b>{$APP.Description}</b></td>
		<td class='dvtCellInfo'><textarea name="description" rows="8" cols="40" class='detailedViewTextBox'>{$task->description}</textarea></td>
	</tr>
	<tr valign="top">
		<td class='dvtCellLabel' align="right" width=15% nowrap="nowrap"><b>{$APP.Status}</b></td>
		<td class='dvtCellLabel'>
			<span id="task_status_busyicon"><b>{$MOD.LBL_LOADING}</b><img src="{'vtbusy.gif'|@vtiger_imageurl:$THEME}" border="0"></span>
			<select id="task_status" value="{$task->status}" name="status" class="small" style="display: none;"></select>
		</td>
	</tr> 
	<tr valign="top">
		<td class='dvtCellLabel' align="right" width=15% nowrap="nowrap"><b>{$APP.Priority}</b></td>
		<td class='dvtCellLabel'>
			<span id="task_priority_busyicon"><b>{$MOD.LBL_LOADING}</b><img src="{'vtbusy.gif'|@vtiger_imageurl:$THEME}" border="0"></span>
			<select id="task_priority" value="{$task->priority}" name="priority" class="small" style="display: none;"></select>
		</td>
	</tr>
	<tr><td colspan="2"><hr size="1" noshade="noshade" /></td></tr>
	<tr>
		<td align="right"><b>{$APP.LBL_TIME}</b></td>
		<td><input type="hidden" name="time" value="{$task->time}" id="workflow_time" style="width:60px" class="time_field"></td>
	</tr>
	<tr>
		<td align="right"><b>{$APP.LBL_DUE_DATE}</b></td>
		<td>
			<input type="text" name="days" value="{$task->days}" id="days" style="width:30px" class="small">{'LBL_REMAINDER_DAY'|getTranslatedString:'Calendar'}
			<select name="direction" value="{$task->direction}" class="small">
				<option>{$MOD.LBL_AFTER}</option>
				<option>{$MOD.LBL_BEFORE}</option>
			</select>
			<select name="datefield" value="{$task->datefield}" class="small">
			{foreach key=name item=label from=$dateFields}
				<option value='{$name}' {if $task->datefield eq $name}selected{/if}>
					{$label}
				</option>
			{/foreach}
			</select>
			({$MOD.Same_To_Start})</td>
		</tr>
		<tr valign="top">
			<td align="right"><b>{'LBL_SENDNOTIFICATION'|getTranslatedString:'Calendar'}</b></td>
			<td><input type="checkbox" name="sendNotification" value="true" id="sendNotification" {if $task->sendNotification}checked{/if}></td>
		</tr>
	</table>
</div>
