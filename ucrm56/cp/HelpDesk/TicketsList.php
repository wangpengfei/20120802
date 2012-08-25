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
$onlymine=$_REQUEST['onlymine'];
if($onlymine == 'true') {
    $mine_selected = 'selected';
    $all_selected = '';
} else {
    $mine_selected = '';
    $all_selected = 'selected';
}

?>
	<span class="lvtHeaderText">
	<?PHP echo getTranslatedString('SHOW');?>&nbsp;</b>
		<select id="ticket_status_combo" onchange="this.form.module.value='HelpDesk';this.form.action.value='index';this.form.fun.value='home'; showTickets(index)">
			<?php 
				echo getStatusComboList($show);
			?>
		</select>
		<?PHP $show = $client->call('show_all',array('module'=>'HelpDesk'), $Server_Path, $Server_Path);
		if($show == 'true'){
			echo '&nbsp; <select id="only_mine_combo" name="list_type" onchange="getList(this, \'HelpDesk\');">
					<option value="mine" '. $mine_selected .'>'.getTranslatedString('MINE').'</option>
					<option value="all"'. $all_selected .'>'.getTranslatedString('ALL').'</option>
					</select>'; 
			} 
		?>
		<td></td><td></td>
	    <td align="right"><input class="crmbutton small cancel" name="newticket" type="submit" value="<?PHP echo getTranslatedString('LBL_NEW_TICKET');?>" onclick="this.form.module.value='HelpDesk';this.form.action.value='index';this.form.fun.value='newticket'">&nbsp;&nbsp;&nbsp;
	    	<input class="crmbutton small cancel" name="srch" type="button" value="<?PHP echo getTranslatedString('LBL_SEARCH');?>" onClick="showSearchFormNow('tabSrch');">
	    </td>
	    </form>
	</tr>
	<tr>
		<td colspan="2">&nbsp;
		</td>
	</tr>	
</table>

<?PHP
global $result;
$list = '';
$closedlist = '';

if($result == '') {
	$list .= '<tr><td>';
	$list .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">';
	$list .= '<tr><td class="pageTitle">'.getTranslatedString('LBL_NONE_SUBMITTED').'</td></tr></table>';
	$list .= '</td></tr>';
} else {

	$header = $result[0]['head'][0];
	$nooffields = count($header);
	$data = $result[1]['data'];
	$rowcount = count($data);
	$showstatus = $_REQUEST['showstatus'];
		if($showstatus != '' && $rowcount >= 1) {
			$list .= '<tr><td colspan="1"><div id="scrollTab">';
			$list .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">';
			$list .= '<tr><td class="mnu">'.getTranslatedString($showstatus)." ".getTranslatedString('LBL_TICKETS').' </td></tr></table>';
			$list .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
			$list .= '<tr>';
	
			for($i=0; $i<$nooffields; $i++)
			{
				$header_value = $header[$i]['fielddata'];
				$list .= '<td class="detailedViewHeader" align="center">'.$header_value.'</td>';
			}
			$list .= '</tr>';
	
			$ticketexist = 0;
			for($i=0;$i<count($data);$i++)
			{		
				$ticketlist = '';
		
				if ($i%2==0)
					$ticketlist .= '<tr class="dvtLabel">';
				else
					$ticketlist .= '<tr class="dvtInfo">';
			
				$ticket_status = '';
				for($j=0; $j<$nooffields; $j++) {			
					$ticketlist .= '<td>'.getTranslatedString($data[$i][$j]['fielddata']).'</td>';
					if ($header[$j]['fielddata'] == 'Status') {
						$ticket_status = $data[$i][$j]['fielddata'];
					}
				}
			$ticketlist .= '</tr>';
	
			if($ticket_status == $showstatus){
				$list .= $ticketlist; 
				$ticketexist++;
			}		
		}
		if($ticketexist == 0)
		{
			$list .= '<tr><td>&nbsp;</td></tr><tr><td class="pageTitle">'.getTranslatedString('LBL_NONE_SUBMITTED').'</td></tr>';
		}
	
		$list .= '</table>';
	
	}
	else {
		$list .= '<tr><td colspan="2"><div id="scrollTab">';
		$list .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">';
		$list .= '<tr><td class="mnu">'.getTranslatedString('LBL_MY_OPEN_TICKETS').'</td></tr></table>';
		$list .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
		$list .= '<tr>';
	
		$closedlist .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">';
		$closedlist .= '<tr><td class="mnu">'.getTranslatedString('LBL_CLOSED_TICKETS').'</td></tr></table>';
		$closedlist .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
		$closedlist .= '<tr>';
		
		for($i=0; $i<$nooffields; $i++)
		{
			$header_value = $header[$i]['fielddata'];
			$headerlist .= '<td class="detailedViewHeader" align="center">'.getTranslatedString($header_value).'</td>';
		}
		$headerlist .= '</tr>';
		
		$list .= $headerlist;
		$closedlist .= $headerlist;
	
		for($i=0;$i<count($data);$i++)
		{
			$ticketlist = '';
			
			if ($i%2==0)
				$ticketlist .= '<tr class="dvtLabel">';
			else
				$ticketlist .= '<tr class="dvtInfo">';
			
			$ticket_status = '';
			for($j=0; $j<$nooffields; $j++) {		
				$ticketlist .= '<td>'.$data[$i][$j]['fielddata'].'</td>';
				if ($header[$j]['fielddata'] == 'Status') {
					$ticket_status = $data[$i][$j]['fielddata'];
				}
			}
			$ticketlist .= '</tr>';
	
			if($ticket_status == getTranslatedString('LBL_STATUS_CLOSED'))
				$closedlist .= $ticketlist;
			elseif($ticket_status != '')
				$list .= $ticketlist;
		}	
	
		$list .= '</table>';
		$closedlist .= '</table>';
	
		$closedlist .= '</div></td></tr>';
	
		$list .= '<br><br>'.$closedlist;
	}
}
echo $list;

?>
