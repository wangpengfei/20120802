<?php
function GetReleasevNews($maxval,$calCnt)
{
	require_once("data/Tracker.php");
	require_once('modules/News/News.php');
	require_once('include/logging.php');
	require_once('include/ListView/ListView.php');
	require_once('include/utils/utils.php');
	require_once('modules/CustomView/CustomView.php');

	global $current_language,$current_user,$list_max_entries_per_page,$theme,$adb;
	$current_module_strings = return_module_language($current_language, 'News');

	$log = LoggerManager::getLogger('so_list');

	$url_string = '';
	$sorder = '';
/*	$oCustomView = new CustomView("News");
	echo $_SESSION['lvs']['News']["viewname"];echo '1<br />';
echo	$viewid = $oCustomView->getViewId("News");
echo '2<br />';
	echo $_SESSION['lvs']['News']["viewname"];echo '3<br />';
	$viewnamedesc = $oCustomView->getCustomViewByCvid($viewid);
	echo $_SESSION['lvs']['News']["viewname"];echo '4<br />';*/
	$theme_path="themes/".$theme."/";
	$image_path=$theme_path."images/";

	$list_query = "SELECT vtiger_news.newsid,vtiger_news.newsname, vtiger_news.newstype, vtiger_news.startdate, vtiger_news.enddate, vtiger_news.newsid FROM vtiger_news INNER JOIN vtiger_crmentity ON vtiger_news.newsid = vtiger_crmentity.crmid WHERE vtiger_crmentity.deleted=0 AND vtiger_news.newsid > 0";
	
	if(!$viewinfo['viewname'] || $viewinfo['viewname'] == 'Releasev News'){
		$date = date('Y-m-d');
		$list_query .= " and (vtiger_news .startdate <= '".$date."' and vtiger_news.enddate >='".$date."')";
	}
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
			$open_accounts_list[] = Array('newsid' => $adb->query_result($list_result,$i,'newsid'),
					'newsname' => $adb->query_result($list_result,$i,'newsname'),
					'newstype' => $adb->query_result($list_result,$i,'newstype'),
					);								 
		}
	}
	
	$title=array();
	$title[]='myTopAccounts.gif';
	$title[]=$current_module_strings['News'];
	
	$header=array();
	$header[]=$current_module_strings['News Title'];
    $header[]=$current_module_strings['News Type'];
	
	$entries=array();
	foreach($open_accounts_list as $account)
	{
		$value=array();
		$value[]='<a href="index.php?action=DetailView&module=News&record='.$account['newsid'].'">'.$account['newsname'].'</a>';
		$value[]=$account['newstype'];
		$entries[$account['newsid']]=$value;	
	}
	$values=Array('ModuleName'=>'News','Title'=>$title,'Header'=>$header,'Entries'=>$entries);
	$log->debug("Exiting getTopAccounts method ...");
	if (($display_empty_home_blocks && count($entries) == 0 ) || (count($entries)>0))
		return $values;
}
?>
