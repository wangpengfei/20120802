<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
global $app_strings, $mod_strings, $current_language, $currentModule, $theme;
global $list_max_entries_per_page;

require_once('Smarty_setup.php');
require_once('include/ListView/ListView.php');
require_once('modules/CustomView/CustomView.php');
require_once('include/DatabaseUtil.php');
require_once("modules/$currentModule/$currentModule.php");

// Module Customization
// Let us reset listview text length to avoid message truncating
global $listview_max_textlength;
$old_listview_max_textlength = $listview_max_textlength;
$listview_max_textlength = 0;
// END

$category = getParentTab();
$url_string = '';

$tool_buttons = Button_Check($currentModule);
$list_buttons = Array();

// Module Customization
$tool_buttons['EditView'] = 'no';
$tool_buttons['Import'] = 'no';
$tool_buttons['Export'] = 'no';
// END

if(isPermitted($currentModule,'Delete','') == 'yes') {
	//$list_buttons['del'] = $app_strings[LBL_MASS_DELETE];
}
if(isPermitted($currentModule,'Edit','') == 'yes') {
	//$list_buttons['mass_edit'] = $app_strings[LBL_MASS_EDIT];
	// Mass Edit could be used to change the owner as well!
	//$list_buttons['c_owner'] = $app_strings[LBL_CHANGE_OWNER];
}

$focus = new $currentModule();
$sorder = $focus->getSortOrder();
$order_by = $focus->getOrderBy();

$_SESSION[$currentModule."_Order_by"] = $order_by;
$_SESSION[$currentModule."_Sort_Order"]=$sorder;

$smarty = new vtigerCRM_Smarty();

// Identify this module as custom module.
$smarty->assign('CUSTOM_MODULE', true);

$smarty->assign('MOD', $mod_strings);
$smarty->assign('APP', $app_strings);
$smarty->assign('MODULE', $currentModule);
$smarty->assign('SINGLE_MOD', $mod_strings['SINGLE_RECORD']);
$smarty->assign('CATEGORY', $category);
$smarty->assign('BUTTONS', $list_buttons);
$smarty->assign('CHECK', $tool_buttons);
$smarty->assign('IMAGE_PATH', "themes/$theme/images/");
$smarty->assign('THEME', "$theme");

$smarty->assign('CHANGE_OWNER', getUserslist());
$smarty->assign('CHANGE_GROUP_OWNER', getGroupslist());

// Module Customization 
$listOnlyTopics = $focus->defaultIsTopicView();
if($_REQUEST['_onlytopics'] == 'true') {
	$_SESSION[$currentModule."_ListOnlyTopics"] = true;
} else if($_REQUEST['_onlytopics'] == 'false')  {
	$_SESSION[$currentModule."_ListOnlyTopics"] = false;
}
$listOnlyTopics = $_SESSION[$currentModule."_ListOnlyTopics"];
$smarty->assign('TOPICVIEW', $listOnlyTopics);
// END

// Enabling Module Search
$url_string = '';
if($_REQUEST['query'] == 'true') {
	list($where, $ustring) = split('#@@#', getWhereCondition($currentModule));
	$url_string .= "&query=true$ustring";
	$smarty->assign('SEARCH_URL', $url_string);
}

// Custom View
$customView = new CustomView($currentModule);
$viewid = $customView->getViewId($currentModule);
$customview_html = $customView->getCustomViewCombo($viewid);
$viewinfo = $customView->getCustomViewByCvid($viewid);

// Feature available from 5.1
if(method_exists($customView, 'isPermittedChangeStatus')) {
	// Approving or Denying status-public by the admin in CustomView
	$statusdetails = $customView->isPermittedChangeStatus($viewinfo['status']);
	
	// To check if a user is able to edit/delete a CustomView
	$edit_permit = $customView->isPermittedCustomView($viewid,'EditView',$currentModule);
	$delete_permit = $customView->isPermittedCustomView($viewid,'Delete',$currentModule);

	$smarty->assign("CUSTOMVIEW_PERMISSION",$statusdetails);
	$smarty->assign("CV_EDIT_PERMIT",$edit_permit);
	$smarty->assign("CV_DELETE_PERMIT",$delete_permit);
}
// END

$smarty->assign("VIEWID", $viewid);

if($viewinfo['viewname'] == 'All') $smarty->assign('ALL', 'All');

if($viewid ==0)
{
	echo "<table border='0' cellpadding='5' cellspacing='0' width='100%' height='450px'><tr><td align='center'>";
	echo "<div style='border: 3px solid rgb(153, 153, 153); background-color: rgb(255, 255, 255); width: 55%; position: relative; z-index: 10000000;'>

		<table border='0' cellpadding='5' cellspacing='0' width='98%'>
		<tbody><tr>
		<td rowspan='2' width='11%'><img src='". vtiger_imageurl('denied.gif', $theme) ."' ></td>
		<td style='border-bottom: 1px solid rgb(204, 204, 204);' nowrap='nowrap' width='70%'><span clas
		s='genHeaderSmall'>$app_strings[LBL_PERMISSION]</span></td>
		</tr>
		<tr>
		<td class='small' align='right' nowrap='nowrap'>
		<a href='javascript:window.history.back();'>$app_strings[LBL_GO_BACK]</a><br>
		</td>
		</tr>
		</tbody></table>
		</div>";
	echo "</td></tr></table>";
	exit;
}

$listquery = getListQuery($currentModule);
$list_query= $customView->getModifiedCvListQuery($viewid, $listquery, $currentModule);

// Is only topics to be listed?
if($listOnlyTopics) {
	$where .= " $focus->table_name.topicstart = 1";
}

if($where != '') {
	$list_query = "$list_query AND $where";
}

// Sorting
if($order_by) {
	if($order_by == 'smownerid') $list_query .= ' ORDER BY user_name '.$sorder;
	else {
		// Module Customization
		/* $tablename = getTableNameForField($currentModule, $order_by);
		$tablename = ($tablename != '')? ($tablename . '.') : '';
		$list_query .= ' ORDER BY ' . $tablename . $order_by . ' ' . $sorder;*/

		$list_query .= ' ORDER BY ' . $order_by;
		// END
	}
}

// List view record counting
if(PerformancePrefs::getBoolean('LISTVIEW_COMPUTE_PAGE_COUNT', false) === true){
	$count_result = $adb->query( mkCountQuery( $list_query));
	$noofrows = $adb->query_result($count_result,0,"count");
}else{
	$noofrows = null;
}

$queryMode = (isset($_REQUEST['query']) && $_REQUEST['query'] == 'true');
$start = ListViewSession::getRequestCurrentPage($currentModule, $list_query, $viewid, $queryMode);

$navigation_array = VT_getSimpleNavigationValues($start,$list_max_entries_per_page,$noofrows);
$limit_start_rec = ($start-1) * $list_max_entries_per_page;

$list_result = $adb->pquery($list_query. " LIMIT $limit_start_rec, $list_max_entries_per_page", array());

$recordListRangeMsg = getRecordRangeMessage($list_result, $limit_start_rec);
$smarty->assign('recordListRange',$recordListRangeMsg);

$smarty->assign("CUSTOMVIEW_OPTION",$customview_html);

// Navigation
$navigationOutput = getTableHeaderSimpleNavigation($navigation_array, $url_string, $currentModule, 'index', $viewid);
$smarty->assign("NAVIGATION", $navigationOutput);

$listview_header = getListViewHeader($focus,$currentModule,$url_string,$sorder,$order_by,'',$customView);
$listview_header_search = getSearchListHeaderValues($focus,$currentModule,$url_string,$sorder,$order_by,'',$customView);
$metalistview_entries = getListViewEntries($focus,$currentModule,$list_result,$navigation_array,'','','EditView','Delete',$customView);

// Tweak: Remove the listview metainfo HTML nodes
$listview_entries = array();
if(!empty($metalistview_entries)) {
	foreach($metalistview_entries as $metalistview_key => $metalistview_entry) {
		$listview_entry = array();
		foreach($metalistview_entry as $k => $v) {
			$listview_entry[$k] = preg_replace("/[ ]?<span type='vtlib_metainfo' vtrecordid=(.*)><\/span>/", '', $v);
		}
		$listview_entries[$metalistview_key] = $listview_entry;
	}
}

$smarty->assign('LISTHEADER', $listview_header);
$smarty->assign('LISTENTITY', $listview_entries);
$smarty->assign('SEARCHLISTHEADER',$listview_header_search);

// Module Search
$alphabetical = AlphabeticalSearch($currentModule,'index',$focus->def_basicsearch_col,'true','basic','','','','',$viewid);
$fieldnames = getAdvSearchfields($currentModule);
$criteria = getcriteria_options();
$smarty->assign("ALPHABETICAL", $alphabetical);
$smarty->assign("FIELDNAMES", $fieldnames);
$smarty->assign("CRITERIA", $criteria);

// Module customization
$listfieldpos = Array();
foreach($customView->list_fields_name as $listfieldlbl=>$listfieldname) $listfieldpos[$listfieldname] = count($listfieldpos);
$smarty->assign("LISTFIELDPOS", $listfieldpos);

$listofusers = get_user_array(FALSE, "Active", $current_user->id);
$smarty->assign("USERLIST", $listofusers);

$smarty->assign("CURRENT_USER_NAME", $current_user->user_name);
$smarty->assign("CURRENT_USER_ID", $current_user->id);

$smarty->assign("LISTMARKAS", vtlib_getPicklistValues_AccessibleToAll('vtmsgstatus'));
$smarty->assign("ISLISTVIEW", true);

// Reset the listview length back
$listview_max_textlength = $old_listview_max_textlength;

/* Module Customization
if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] != '')
	$smarty->display('ListViewEntries.tpl');
else 
	$smarty->display('ListView.tpl');
*/

$_SESSION[$currentModule.'_listquery'] = $list_query;

if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] != '')
	$smarty->display(vtlib_getModuleTemplate($currentModule, 'ListViewEntries.tpl'));
else 
	$smarty->display(vtlib_getModuleTemplate($currentModule, 'ListView.tpl'));

// END
?>
