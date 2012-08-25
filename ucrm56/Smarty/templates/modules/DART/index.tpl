{*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************}

{include file="Buttons_List1.tpl"}

<div style="min-height: 350px;">

<table width="100%" cellpadding=3 cellspacing=0 border=0>

<tr valign=top>

	<td width="33%" style="padding-left: 10px;">

		<p style="font: 12px Arial, sans-serif; clear: both;">
			<b>{'NOTE'|@getTranslatedString:$MODULE}:</b> {'LBL_NOTE_TEXT'|@getTranslatedString:$MODULE}<br /><br />
<strong>{'LBL_USER_AUDIT'|@getTranslatedString:'Settings'}:</strong>
<select name="userid" onchange="show_dart(this)">
{$USERLIST}
</select>
		</p>
		
		<!-- Calendar setup -->
		<div id='_cal' style="float: left;"></div>
		
		<script type="text/javascript">
		function __convertPHP2JSCalDate(ymd) {ldelim}
			var ymdsplits = ymd.split('-');
			console.log(ymd);
			var value = ymdsplits[0] + '/' + (parseInt(ymdsplits[2])-0) + '/' + (parseInt(ymdsplits[1])-1);
			console.log(value);
			return value;
		{rdelim}
		Event.observe(window, 'load', function() {ldelim}
			Calendar.setup({ldelim}
			date: "{'-'|@str_replace:'/':$DAY}",
			flat: "_cal",
			flatCallback : function(cal) {ldelim}
				var yyyy = cal.date.getFullYear(), mm = cal.date.getMonth()+1, dd = cal.date.getDate();
				if (mm < 10) mm = "0" + mm;
				if (dd < 10) dd = "0" + dd;
				var selectedDate = yyyy + '-' + mm + '-' + dd;
				
				VtigerJS_DialogBox.block();
				location.href = 'index.php?module=DART&action=index&_date=' + encodeURIComponent(selectedDate)+'&_u={$USERID}'
			{rdelim}
		{rdelim}); {rdelim});
		</script>
		
		<p style="clear: both;"></p>
		
	</td>
	
	<td>
		{include file="modules/DART/emailreport.tpl"}
	</td>
	
</tr>

</table>

</div>
<script>
var d="{$DAY}";
{literal}
function show_dart(sel){
	var val = sel.value;
	location.href = 'index.php?module=DART&action=index&_date=' + encodeURIComponent(d)+'&_u='+val;
}
{/literal}
</script>