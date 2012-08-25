<?php
/*+********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ********************************************************************************/
require_once('include/database/PearDatabase.php');
require_once('Smarty_setup.php');
require_once('modules/SalesOrder/SalesOrder.php');
require_once('include/ListView/ListView.php');
require_once('include/utils/utils.php');
require_once('modules/CustomView/CustomView.php');
require_once('include/database/Postgres8.php');

global $app_strings,$mod_strings,$list_max_entries_per_page,$currentModule,$theme;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";

$smarty = new vtigerCRM_Smarty;
$smarty->assign("MOD", $mod_strings);
$smarty->assign("APP", $app_strings);
$smarty->assign("THEME", $theme);
$smarty->assign("IMAGE_PATH",$image_path);
$smarty->assign("MODULE",$currentModule);
$smarty->assign("SINGLE_MOD",'SalesOrder');
$category = getParentTab();
$smarty->assign("CATEGORY",$category);

$focus = new SalesOrder();
// Initialize sort by fields
$focus->initSortbyField('SalesOrder');
// END
$other_text = Array();
$url_string = ''; // assigning http url string

if(!$_SESSION['lvs'][$currentModule])
{
	unset($_SESSION['lvs']);
	$modObj = new ListViewSession();
	$modObj->sorder = $sorder;
	$modObj->sortby = $order_by;
	$_SESSION['lvs'][$currentModule] = get_object_vars($modObj);
}

if($_REQUEST['errormsg'] != '')
{
        $errormsg = vtlib_purify($_REQUEST['errormsg']);
        $smarty->assign("ERROR","The User does not have permission to Change/Delete ".$errormsg." ".$currentModule);
}else
{
        $smarty->assign("ERROR","");
}
//<<<<<<<<<<<<<<<<<<< sorting - stored in session >>>>>>>>>>>>>>>>>>>>
$sorder = $focus->getSortOrder();
$order_by = $focus->getOrderBy();

$_SESSION['SALESORDER_ORDER_BY'] = $order_by;
$_SESSION['SALESORDER_SORT_ORDER'] = $sorder;
//<<<<<<<<<<<<<<<<<<< sorting - stored in session >>>>>>>>>>>>>>>>>>>>

//<<<<cutomview>>>>>>>
$oCustomView = new CustomView("SalesOrder");
$viewid = $oCustomView->getViewId($currentModule);
$customviewcombo_html = $oCustomView->getCustomViewCombo($viewid);
$viewnamedesc = $oCustomView->getCustomViewByCvid($viewid);

//Added to handle approving or denying status-public by the admin in CustomView
$statusdetails = $oCustomView->isPermittedChangeStatus($viewnamedesc['status']);
$smarty->assign("CUSTOMVIEW_PERMISSION",$statusdetails);

//To check if a user is able to edit/delete a customview
$edit_permit = $oCustomView->isPermittedCustomView($viewid,'EditView',$currentModule);
$delete_permit = $oCustomView->isPermittedCustomView($viewid,'Delete',$currentModule);
$smarty->assign("CV_EDIT_PERMIT",$edit_permit);
$smarty->assign("CV_DELETE_PERMIT",$delete_permit);

//<<<<<customview>>>>>
$smarty->assign("CHANGE_OWNER",getUserslist());
$smarty->assign("CHANGE_GROUP_OWNER",getGroupslist());
// Buttons and View options
if(isPermitted('SalesOrder','Delete','') == 'yes')
{
	$other_text['del'] = $app_strings[LBL_MASS_DELETE];
}
if(isPermitted('SalesOrder','EditView','') == 'yes')
{
	$other_text['mass_edit'] = $app_strings[LBL_MASS_EDIT];
	$other_text['c_owner'] = $app_strings[LBL_CHANGE_OWNER];
}
if($viewnamedesc['viewname'] == 'All')
{
	$smarty->assign("ALL", 'All');
}

//<<<<<<<<<customview>>>>>>>>>
global $current_user;
$queryGenerator = new QueryGenerator($currentModule, $current_user);
if ($viewid != "0") {
	$queryGenerator->initForCustomViewById($viewid);
} else {
	$queryGenerator->initForDefaultCustomView();
}
//<<<<<<<<customview>>>>>>>>>

/*************************************/
//$other_text['mass_approval'] = $app_strings[LBL_MASS_APPROVAL];
$fieldname = 'sostatus';
$roleid=$current_user->roleid;
$subrole = getRoleSubordinates($roleid);	
if(count($subrole)> 0)
{
	$roleids = $subrole;
	array_push($roleids, $roleid);
}
else
{
	$roleids = $roleid;
}
if($current_user->is_admin == 'on' )
{
	$pick_query="select $fieldname from vtiger_$fieldname";
	$params = array();
}else
{
	$wqw_sql = "SELECT * FROM vtiger_profile2standardpermissions
				WHERE profileid IN (SELECT profileid FROM `vtiger_role2profile` WHERE roleid = ?)
				AND tabid =? AND operation =1 AND permissions = 0";
	$wqw_Result = $adb->pquery($wqw_sql, array($roleid,$tabid));
	$wqw_rows = $adb->num_rows($wqw_Result);
	if (count($roleids) > 0 && $wqw_rows) {
		$pick_query="select distinct sostatusid,$fieldname from vtiger_$fieldname inner join vtiger_role2picklist on vtiger_role2picklist.picklistvalueid = vtiger_$fieldname.picklist_valueid where roleid in (". generateQuestionMarks($roleids) .") and picklistid in (select picklistid from vtiger_picklist) order by $fieldname asc";
		$params = array($roleids);
	} else {
		$pick_query="select distinct sostatusid,$fieldname from vtiger_$fieldname inner join vtiger_role2picklist on vtiger_role2picklist.picklistvalueid = vtiger_$fieldname.picklist_valueid where picklistid in (select picklistid from vtiger_picklist) order by $fieldname asc";
		$params = array();
	}
}	
$pickListResult = $adb->pquery($pick_query, $params);
while($result_set = $adb->fetch_array($pickListResult))
{	
	$LEAD_STATUS .= '<option values="'.$result_set['sostatus'].'">'.$mod_strings[$result_set['sostatus']].'</option>';
}
$smarty->assign('LEAD_STATUS', $LEAD_STATUS);
/***********************************************/
		
// Enabling Module Search
$url_string = '';
if($_REQUEST['query'] == 'true') {
	$queryGenerator->addUserSearchConditions($_REQUEST);
	$ustring = getSearchURL($_REQUEST);
	$url_string .= "&query=true$ustring";
	$smarty->assign('SEARCH_URL', $url_string);
}

$list_query = $queryGenerator->getQuery();

if(isset($order_by) && $order_by != '')
{
	if($order_by == 'smownerid')
        {
		if( $adb->dbType == "pgsql")
 		    $list_query .= ' GROUP BY user_name';
                $list_query .= ' ORDER BY user_name '.$sorder;
        }
        else
        {
		$tablename = getTableNameForField('SalesOrder',$order_by);
		$tablename = (($tablename != '')?($tablename."."):'');
		if( $adb->dbType == "pgsql")
 		    $list_query .= ' GROUP BY '.$tablename.$order_by;
                $list_query .= ' ORDER BY '.$tablename.$order_by.' '.$sorder;
        }
}

///Postgres 8 fixes
if( $adb->dbType == "pgsql")
	$list_query = fixPostgresQuery( $list_query, $log, 0);

if(PerformancePrefs::getBoolean('LISTVIEW_COMPUTE_PAGE_COUNT', false) === true){
	if($_REQUEST['showall']=='true'){
		$list_query = $_SESSION['list_query'];
	}
	$count_result = $adb->query( mkCountQuery( $list_query));
	$noofrows = $adb->query_result($count_result,0,"count");
}else{
	$noofrows = null;
}

$queryMode = (isset($_REQUEST['query']) && $_REQUEST['query'] == 'true');
$start = ListViewSession::getRequestCurrentPage($currentModule, $list_query, $viewid, $queryMode);

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

//Retreive the List View Table Header
if($viewid !='')
$url_string .="&viewname=".$viewid;

$controller = new ListViewController($adb, $current_user, $queryGenerator);
$listview_header = $controller->getListViewHeader($focus,$currentModule,$url_string,$sorder,
		$order_by);
$smarty->assign("LISTHEADER", $listview_header);

$listview_header_search = $controller->getBasicSearchFieldInfoList();
$smarty->assign("SEARCHLISTHEADER", $listview_header_search);

$listview_entries = $controller->getListViewEntries($focus,$currentModule,$list_result,
		$navigation_array);
$smarty->assign("LISTENTITY", $listview_entries);
$smarty->assign("SELECT_SCRIPT", $view_script);

//Added to select Multiple records in multiple pages
$smarty->assign("SELECTEDIDS", vtlib_purify($_REQUEST['selobjs']));
$smarty->assign("ALLSELECTEDIDS", vtlib_purify($_REQUEST['allselobjs']));
$smarty->assign("CURRENT_PAGE_BOXES", implode(array_keys($listview_entries),";"));

$navigationOutput = getTableHeaderSimpleNavigation($navigation_array, $url_string,"SalesOrder",'index',$viewid);
$alphabetical = AlphabeticalSearch($currentModule,'index','subject','true','basic',"","","","",$viewid);
$fieldnames = $controller->getAdvancedSearchOptionString();
$criteria = getcriteria_options();
$smarty->assign("CRITERIA", $criteria);
$smarty->assign("FIELDNAMES", $fieldnames);
$smarty->assign("ALPHABETICAL", $alphabetical);
$smarty->assign("NAVIGATION", $navigationOutput);
$smarty->assign("CUSTOMVIEW_OPTION",$customviewcombo_html);
$smarty->assign("VIEWID", $viewid);
$smarty->assign("BUTTONS", $other_text);

$check_button = Button_Check($module);
$smarty->assign("CHECK", $check_button);

$_SESSION[$currentModule.'_listquery'] = $list_query;

// Gather the custom link information to display
include_once('vtlib/Vtiger/Link.php');
$customlink_params = Array('MODULE'=>$currentModule, 'ACTION'=>vtlib_purify($_REQUEST['action']), 'CATEGORY'=> $category);
$smarty->assign('CUSTOM_LINKS', Vtiger_Link::getAllByType(getTabid($currentModule), Array('LISTVIEWBASIC','LISTVIEW'), $customlink_params));
// END

if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] != '')
	$smarty->display("ListViewEntries.tpl");
else	
	$smarty->display("ListView.tpl");

?>