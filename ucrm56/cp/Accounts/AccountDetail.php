<?php
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
 ********************************************************************************/
global $result;
global $client;
global $Server_Path;

$customerid = $_SESSION['customer_id'];
$sessionid = $_SESSION['customer_sessionid'];
if($accountid != '')
{
	$params = array('id' => "$accountid", 'block'=>"$block",'contactid'=>$customerid,'sessionid'=>"$sessionid");
	$result = $client->call('get_details', $params, $Server_Path, $Server_Path);
	// Check for Authorization
	if (count($result) == 1 && $result[0] == "#NOT AUTHORIZED#") {
		echo '<tr>
			<td colspan="6" align="center"><b>'.getTranslatedString('LBL_NOT_AUTHORISED').'</b></td>
		</tr></table></td></tr></table></td></tr></table>';
		die();
	}
	$noteinfo = $result[0][$block];
	echo '<table><tr><td><input class="crmbutton small cancel" type="button" value="'.getTranslatedString('LBL_BACK_BUTTON').'" onclick="window.history.back();"/></td>
	<td><input class="crmbutton small cancel" type="button" value="'.getTranslatedString('LBL_EDIT_BUTTON')
	.'" onclick="window.location.href=\'index.php?module='.$module.'&action=EditView&id='.$accountid.'\'"/></td></tr></table>';
	echo getblock_fieldlist($noteinfo);

	echo '</table></td></tr>';	
	echo '</table></td></tr></table></td></tr></table>';
	echo '<!-- --End--  -->';
}
/*
$c = count($result[1]);
for($i=1; $i <= $c; $i++){
	echo $result[1][$i]['module'];
	$RELATEDLISTDATA = $result[1][$i]['data'];*/
?>
<!--
<table border=0 cellspacing=1 cellpadding=3 width=100% style="background-color:#eaeaea;" class="small">
	<tr >
		{foreach key=index item=_HEADER_FIELD from=$RELATEDLISTDATA.header}
		<td class="lvtCol">{$_HEADER_FIELD}</td>
		{/foreach}
	</tr>
	{foreach key=_RECORD_ID item=_RECORD from=$RELATEDLISTDATA.entries}
		<tr bgcolor=white>
			{foreach key=index item=_RECORD_DATA from=$_RECORD}
				 {* vtlib customization: Trigger events on listview cell *}
                 <td onmouseover="vtlib_listview.trigger('cell.onmouseover', $(this))" onmouseout="vtlib_listview.trigger('cell.onmouseout', $(this))"> {$_RECORD_DATA|@getTranslatedString:$_RECORD_DATA}</td>
                 {* END *}
			{/foreach}
		</tr>
	{foreachelse}
		<tr style="height: 25px;" bgcolor="white"><td><i>{$APP.LBL_NONE_INCLUDED}</i></td></tr>
	{/foreach}
</table>-->