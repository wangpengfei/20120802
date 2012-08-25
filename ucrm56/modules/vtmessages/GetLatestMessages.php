<?php
function GetLatestMessages($maxval,$calCnt)
{
	require_once("data/Tracker.php");
	require_once('modules/vtmessages/vtmessages.php');
	require_once('include/logging.php');
	require_once('include/ListView/ListView.php');
	require_once('include/utils/utils.php');
	require_once('modules/CustomView/CustomView.php');

	global $current_language,$current_user,$list_max_entries_per_page,$theme,$adb;
	$current_module_strings = return_module_language($current_language, 'vtmessages');

	$log = LoggerManager::getLogger('so_list');

	$url_string = '';
	$sorder = '';
	
	$theme_path="themes/".$theme."/";
	$image_path=$theme_path."images/";

	$uid = $current_user->id;
	$list_query = "select vtiger_vtmessages.message,case when (vtiger_users.user_name not like '') then vtiger_users.user_name else vtiger_groups.groupname end as user_name,vtiger_crmentity.crmid 
	FROM vtiger_vtmessages 
	INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_vtmessages.vtmessagesid 
	INNER JOIN vtiger_vtmessagescf ON vtiger_vtmessagescf.vtmessagesid = vtiger_vtmessages.vtmessagesid 
	LEFT JOIN vtiger_users ON vtiger_users.id = vtiger_crmentity.smownerid 
	LEFT JOIN vtiger_groups ON vtiger_groups.groupid = vtiger_crmentity.smownerid 
	LEFT JOIN vtiger_vtmessages_topicrel ON vtiger_vtmessages_topicrel.topicid = vtiger_vtmessages.topicid AND vtiger_vtmessages_topicrel.userid = $uid 
	WHERE vtiger_vtmessages.vtmessagesid > 0 AND vtiger_crmentity.deleted = 0 AND (vtiger_crmentity.smownerid = $uid OR vtiger_vtmessages_topicrel.userid = $uid) ORDER BY vtiger_crmentity.createdtime DESC";
	
	//<<<<<<<<customview>>>>>>>>>
	
	$list_query .= " LIMIT " . $adb->sql_escape_string($maxval);
	
	if($calCnt == 'calculateCnt') {
		$list_result_rows = $adb->query(mkCountQuery($list_query));
		return $adb->query_result($list_result_rows, 0, 'count');
	}
	$list_result=$adb->query($list_query);
	$open_accounts_list = array();
	$noofrows = $adb->num_rows($list_result);
	
	if ($noofrows) {
		for($i=0;$i<$noofrows;$i++) 
		{
			$open_accounts_list[] = Array('crmid' => $adb->query_result($list_result,$i,'crmid'),
					'message' => mb_substr($adb->query_result($list_result,$i,'message'),0,20,'UTF-8').'...',
					'user_name' => $adb->query_result($list_result,$i,'user_name'),
					);								 
		}
	}
	
	$title=array();
	$title[]='myTopAccounts.gif';
	$title[]=$current_module_strings['Latest Messages'];
	
	$header=array();
	$header[]=$current_module_strings['Message'];
    $header[]=$current_module_strings['From'];
	
	$entries=array();
	foreach($open_accounts_list as $account)
	{
		$value=array();
		$value[]='<a href="index.php?action=DetailView&module=vtmessages&record='.$account['crmid'].'">'.$account['message'].'</a>';
		$value[]=$account['user_name'];
		$entries[$account['crmid']]=$value;	
	}
	$values=Array('ModuleName'=>'vtmessages','Title'=>$title,'Header'=>$header,'Entries'=>$entries);
	
	if (($display_empty_home_blocks && count($entries) == 0 ) || (count($entries)>0))
		return $values;
}
?>
