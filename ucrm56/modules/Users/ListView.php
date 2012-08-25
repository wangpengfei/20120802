<?php
/*+********************************************************************************
  * The contents of this file are subject to the vtiger CRM Public License Version 1.0
  * ("License"); You may not use this file except in compliance with the License
  * The Original Code is:  vtiger CRM Open Source
  * The Initial Developer of the Original Code is vtiger.
  * Portions created by vtiger are Copyright (C) vtiger.
  * All Rights Reserved.
  ********************************************************************************/

require_once('include/utils/utils.php');
require_once('Smarty_setup.php');
global $app_strings;
global $list_max_entries_per_page;
global $currentModule, $current_user;
if($current_user->is_admin != 'on')
{
        die("<br><br><center>".$app_strings['LBL_PERMISSION']." <a href='javascript:window.history.back()'>".$app_strings['LBL_GO_BACK'].".</a></center>");
}

$log = LoggerManager::getLogger('user_list');

global $mod_strings,$adb;
global $theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";
global $current_language;
$mod_strings = return_module_language($current_language,'Users');
$category = getParentTab();
$focus = new Users();
$no_of_users=UserCount();

//Display the mail send status
$smarty = new vtigerCRM_Smarty;
if($_REQUEST['mail_error'] != '')
{
    require_once("modules/Emails/mail.php");
    //$error_msg = strip_tags(parseEmailErrorString($_REQUEST['mail_error']));
    $error_msg = $app_strings['LBL_MAIL_NOT_SENT_TO_USER']. ' ' . vtlib_purify($_REQUEST['user']). '. ' .$app_strings['LBL_PLS_CHECK_EMAIL_N_SERVER'];
	
	$smarty->assign("ERROR_MSG",$mod_strings['LBL_MAIL_SEND_STATUS'].' <b><font class="warning">'.$error_msg.'</font></b>');
}

if($_REQUEST['has_user_error']){
	$smarty->assign("ERROR_MSG",' <b><font color=red>'.$_REQUEST['has_user_error'].'</font></b>');
}

$list_query = getListQuery("Users");

//Postgres 8 fixes
if( $adb->dbType == "pgsql")
	$list_query = fixPostgresQuery($list_query, $log, 0);

$userid = array(); 
$userid_Query = "SELECT id,user_name FROM vtiger_users WHERE user_name IN ('admin')";
$users = $adb->pquery($userid_Query,array());
$norows = $adb->num_rows($users);
if($norows  > 0){
	for($i=0;$i<$norows ;$i++){
		$id = $adb->query_result($users,$i,'id');
		$userid[$id] = $adb->query_result($users,$i,'user_name');
	}
}
$smarty->assign("USERNODELETE",$userid);

if(!$_SESSION['lvs'][$currentModule]) {
	unset($_SESSION['lvs']);
	$modObj = new ListViewSession();
	$modObj->sorder = $sorder;
	$modObj->sortby = $order_by;
	$_SESSION['lvs'][$currentModule] = get_object_vars($modObj);
}

if($_REQUEST['sorder'] !='')
	$sorder = $adb->sql_escape_string($_REQUEST['sorder']);
else
	$sorder = $focus->getSortOrder();
$_SESSION['USERS_SORT_ORDER'] = $sorder;

if($_REQUEST['order_by'] != '')
	$order_by = $adb->sql_escape_string($_REQUEST['order_by']);
else
	$order_by = $focus->getOrderBy();
$_SESSION['USERS_ORDER_BY'] = $order_by;

$queryGenerator = new QueryGenerator($currentModule, $current_user);
$url_string = '';
if($_REQUEST['query'] == 'true') {
	list($where, $ustring) = split('#@@#', getWhereCondition($currentModule));
	//echo $ustring;
	if($_REQUEST['search_field'] == 'roleid'){
		$where = "vtiger_role.rolename like '%".$_REQUEST['search_text']."%' ";
	}
	if($_REQUEST['search_field'] == 'status'){
		if($mod_strings['LBL_ACTIVE'] == $_REQUEST['search_text']){
			$text = 'Active';
		}elseif($mod_strings['LBL_INACTIVE'] == $_REQUEST['search_text']){
			$text = 'Inactive';
		}else{
			$text = $_REQUEST['search_text'];
		}
		$where = "vtiger_users.status ='$text' ";
	}
	$url_string .= "&query=true$ustring";
	$smarty->assign('SEARCH_URL', $url_string);
}
if($where != '') {
	$list_query = "$list_query AND $where";
}

if(!empty($order_by)){
	$list_query .= ' ORDER BY '.$order_by.' '.$sorder;
}

if(PerformancePrefs::getBoolean('LISTVIEW_COMPUTE_PAGE_COUNT', false) === true){
	if($_REQUEST['showall']=='true'){
		$list_query = $_SESSION['list_query'];
	}
	$count_result = $adb->query( mkCountQuery($list_query));
	$noofrows = $adb->query_result($count_result,0,"count");
}else{
	$noofrows = null;
}
$queryMode = (isset($_REQUEST['query']) && $_REQUEST['query'] == 'true');
$start = ListViewSession::getRequestCurrentPage($currentModule, $list_query, '', $queryMode);

$navigation_array = VT_getSimpleNavigationValues($start,$list_max_entries_per_page,$noofrows);

$limit_start_rec = ($start-1) * $list_max_entries_per_page;

/*if( $adb->dbType == "pgsql")
	$list_result = $adb->pquery($list_query. " OFFSET $limit_start_rec LIMIT $list_max_entries_per_page", array());
else
	$list_result = $adb->pquery($list_query. " LIMIT $limit_start_rec, $list_max_entries_per_page", array());*/

if( $adb->dbType == "pgsql"){
	$list_result = $adb->pquery($list_query. " OFFSET $limit_start_rec LIMIT $list_max_entries_per_page", array());
}else{
	//记录listview的sql
	if($_REQUEST['showall']!='true'){
		$_SESSION['list_query'] = $list_query;
	}
	if($_REQUEST['showall']=='true'){
		$list_result = $adb->pquery($_SESSION['list_query'], array());
	}else{
		$list_result = $adb->pquery($list_query. " LIMIT $limit_start_rec, $list_max_entries_per_page", array());
	}
}

$recordListRangeMsg = getRecordRangeMessage($list_result, $limit_start_rec,$noofrows);
$smarty->assign('recordListRange',$recordListRangeMsg);

$listview_header_search = getSearchListHeaderValues($focus,$currentModule,$url_string,$sorder,$order_by,'',$customView);
$smarty->assign('SEARCHLISTHEADER',$listview_header_search);

$navigationOutput = getTableHeaderSimpleNavigation($navigation_array, $url_string,"Users","index",'');
if($_REQUEST['search_field']) {
	$url_string .= '&search_field='.trim($_REQUEST['search_field']).'&search_text='.urlencode($_REQUEST['search_text']);
	$navigationOutput=str_replace('parenttab=Settings','parenttab=Settings'.$url_string,$navigationOutput);
}

$controller = new ListViewController($adb, $current_user, $queryGenerator);
$fieldnames = $controller->getAdvancedSearchOptionString();
$criteria = getcriteria_options();
$smarty->assign("CRITERIA", $criteria);
$smarty->assign("FIELDNAMES", $fieldnames);
$smarty->assign("ALPHABETICAL", $alphabetical);

$smarty->assign("MODULE",'Users');
$smarty->assign("MOD", return_module_language($current_language,'Settings'));
$smarty->assign("CMOD", $mod_strings);
$smarty->assign("APP", $app_strings);
$smarty->assign("CURRENT_USERID", $current_user->id);
$smarty->assign("THEME", $theme);
$smarty->assign("IMAGE_PATH",$image_path);
$smarty->assign("CATEGORY",$category);

$listview_header = getListViewHeader($focus,"Users",$url_string,$sorder,$order_by,"","");
$listview_entries = getListViewEntries($focus,"Users",$list_result,$navigation_array,"","","EditView","Delete","");
$smarty->assign("LIST_HEADER",$listview_header);
$smarty->assign("LIST_ENTRIES",$listview_entries);


//Added to select Multiple records in multiple pages
$smarty->assign("SELECTEDIDS", vtlib_purify($_REQUEST['selobjs']));
$smarty->assign("ALLSELECTEDIDS", vtlib_purify($_REQUEST['allselobjs']));
$smarty->assign("CURRENT_PAGE_BOXES", implode(array_keys($listview_entries),";"));


$smarty->assign("PAGE_START_RECORD",$limit_start_rec);
$smarty->assign("RECORD_COUNTS", $record_string);
$smarty->assign("NAVIGATION", $navigationOutput);
$smarty->assign("USER_IMAGES",getUserImageNames());
if($_REQUEST['ajax'] !='')
	$smarty->display("UserListViewContents.tpl");
else
	$smarty->display("UserListView.tpl");

?>