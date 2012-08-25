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

global $client;

$customerid = $_SESSION['customer_id'];
$sessionid = $_SESSION['customer_sessionid'];

$params = Array(Array('id'=>"$customerid", 'sessionid'=>"$sessionid"));
$result = $client->call('get_combo_values', $params, $Server_Path, $Server_Path);

$_SESSION['combolist'] = $result;
$combolist = $_SESSION['combolist'];
for($i=0;$i<count($result);$i++)
{
	if($result[$i]['productid'] != '')
	{
		$productslist[0] = $result[$i]['productid'];
	}
	if($result[$i]['productname'] != '')
	{
		$productslist[1] = $result[$i]['productname'];
	}
	if($result[$i]['ticketpriorities'] != '')
	{
		$ticketpriorities = $result[$i]['ticketpriorities'];
	}
	if($result[$i]['ticketseverities'] != '')
	{
		$ticketseverities = $result[$i]['ticketseverities'];
	}
	if($result[$i]['ticketcategories'] != '')
	{
		$ticketcategories = $result[$i]['ticketcategories'];
	}
	if($result[$i]['servicename'] != ''){
		$servicename = $result[$i]['servicename'];
	}
	if($result[$i]['serviceid'] != ''){
		$serviceid= $result[$i]['serviceid'];
	}
}

if($productslist[0] != '#MODULE INACTIVE#'){
	$noofrows = count($productslist[0]);
	
	for($i=0;$i<$noofrows;$i++)
	{
		if($i > 0)
			$productarray .= ',';
		$productarray .= "'".$productslist[1][$i]."'";
	}
}
if($servicename == '#MODULE INACTIVE#' || $serviceid == '#MODULE INACTIVE#'){
	unset($servicename); 
	unset($serviceid);
}

?>
<tr><td colspan="2">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
   <tr>
	<td height="35">&nbsp;</td>
   </tr>
   <tr>
	<td align="left">
	   <span class="lvtHeaderText">&nbsp;&nbsp;<?PHP echo getTranslatedString('LBL_NEW_TICKET');?></span>
	   <hr noshade="noshade" size="1" width="90%" align="left"><br><br>
		<table width="80%"  border="0" cellspacing="0" cellpadding="5" align="center">
		   <form name="Save" method="post" action="index.php">
		   <input type="hidden" name="module" value="HelpDesk">
		   <input type="hidden" name="action" value="index">
		   <input type="hidden" name="fun" value="saveticket">
		   <input type="hidden" name="projectid" value="<?php echo $_REQUEST['projectid'] ?>" />
		   <tr>
			<td colspan="4" class="detailedViewHeader"><b><?PHP echo getTranslatedString('LBL_NEW_TICKET');?></b></td></tr>  
		   <tr>
			<td class="dvtCellLabel" align="right"><font color="red">*</font><?PHP echo getTranslatedString('TICKET_TITLE');?></td>
			<td colspan="3" class="dvtCellInfo">
				<input type="text" name="title" class="detailedViewTextBox"  onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'">
			</td>
		   </tr>
		   <tr>
			<td class="dvtCellLabel" align="right" width="20%"><?PHP echo getTranslatedString('LBL_PRODUCT_NAME');?></td>

			<!-- Product auto drop down - start -->
			<style>@import url( css/dropdown.css );</style>
			<script src="js/modomt.js"></script>
			<script src="js/getobject2.js"></script>
			<script src="js/acdropdown.js"></script>
	
			<script language="javascript">var products = new Array(<?php echo $productarray; ?>);</script>

			<td class="dvtCellInfo" width="20%">
				<input class="dropdown" autocomplete="off" name="productid" id="inputer2" style="width: 135px;" acdropdown="true" autocomplete_list="array:products" autocomplete_list_sort="false" autocomplete_matchsubstring="true">
			<!-- Product auto drop down - end -->

			</td>
			<td class="dvtCellLabel" align="right" width="20%"><?PHP echo getTranslatedString('LBL_SERVICE_CONTRACTS');?></td>
			<td class="dvtCellInfo" width="20%">&nbsp;
			<?php
					$list = '<select name=servicename size="1" class="detailedViewTextBox">';
						$list .= '<OPTION value="">'.getTranslatedString('NONE').'</OPTION>';
					for($i=0;$i<count($servicename);$i++){
						$list .= '<OPTION value="'.$serviceid[$i].'" >'.$servicename[$i].'</OPTION>';
					}
					$list .= '</select>';
					echo $list;
				?>
			</td>
		   </tr>
		   
		   <tr>
			<td class="dvtCellLabel" align="right"><?PHP echo getTranslatedString('LBL_TICKET_PRIORITY');?></td>
			<td class="dvtCellInfo">
				<?php
					echo getComboList('priority',$ticketpriorities);
				?>
			</td>
			<td class="dvtCellLabel" align="right"><?PHP echo getTranslatedString('LBL_TICKET_SEVERITY');?></td>
			<td class="dvtCellInfo">
				<?php
					echo getComboList('severity',$ticketseverities);
				?>
			</td>
		   </tr>
		   <tr>
			<td class="dvtCellLabel" align="right"><?PHP echo getTranslatedString('LBL_TICKET_CATEGORY');?></td>
			<td class="dvtCellInfo">
				<?php
					echo getComboList('category',$ticketcategories);
				?>
			</td>
			</tr>
		   <tr>
			<td class="dvtCellLabel" align="right"><?PHP echo getTranslatedString('LBL_DESCRIPTION');?></td>
			<td colspan="3" class="dvtCellInfo">
				<textarea name="description" cols="55" rows="5" class="detailedViewTextBox"  onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'"></textarea>
			</td>
		   </tr>
		   <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		   </tr>
		   <tr>
			<td>&nbsp;</td>
			<td colspan="2">
			   <div align="center">
				<input class="crmbutton small cancel" title="<?PHP echo getTranslatedString('LBL_SAVE_ALT');?>" accesskey="S" class="small"  name="button" value="<?PHP echo getTranslatedString('LBL_SAVE');?>" style="width: 70px;" type="submit" onclick="return formvalidate(this.form)">
				<input class="crmbutton small cancel" title="<?PHP echo getTranslatedString('LBL_CANCEL_ALT');?>" accesskey="X" class="small" name="button" value="<?PHP echo getTranslatedString('LBL_CANCEL');?>" style="width: 70px;" type="button" onclick="window.history.back()";>
			   </div>
			</td>
			<td>&nbsp;</td>
		   </tr>
			<tt><td colspan="4">&nbsp;</td></tt>
		   </form>
		</table>
	 </td>
   </tr>
</table>
<script>
function formvalidate(form)
{
	if(trim(form.title.value) == '')
	{
		alert("Ticket Title is empty");
		return false;
	}
	return true;
}
function trim(s) 
{
	while (s.substring(0,1) == " ")
	{
		s = s.substring(1, s.length);
	}
	while (s.substring(s.length-1, s.length) == ' ')
	{
		s = s.substring(0,s.length-1);
	}

	return s;
}
</script>
<?php

?>
