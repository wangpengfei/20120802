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
// Let us reset listview max-length to avoid message truncating
global $listview_max_textlength;
$old_listview_max_textlength = $listview_max_textlength;
$listview_max_textlength = 1024;
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
$focus->id = $_REQUEST['record'];

$sorder = $focus->getSortOrder();
$order_by = $focus->getOrderBy();

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

// Custom View
$customView = new CustomView($currentModule);
$viewid = $focus->getFilterId('All', $currentModule);

if($viewid != '0') {
	$listquery = getListQuery($currentModule);
	$list_query= $customView->getModifiedCvListQuery($viewid, $listquery, $currentModule);
} else {
	$list_query= getListQuery($currentModule);
}

// Detail view w.r.t a Topic
$where = " vtiger_vtmessages.topicid = '". $focus->getTopicId() . "'";

// Get all the messages related to the parent topic
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

$list_result = $adb->query($list_query);
$recordCount = $adb->num_rows($list_result); // We need to show all the messages of a topic

$navigation_array = getNavigationValues(0, $recordCount, $recordCount+1);

$listview_header = getListViewHeader($focus,$currentModule,$url_string,$sorder,$order_by,'',$customView);
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

// Module customization
$listfieldpos = Array();
foreach($customView->list_fields_name as $listfieldlbl=>$listfieldname) $listfieldpos[$listfieldname] = count($listfieldpos);
$smarty->assign("LISTFIELDPOS", $listfieldpos);

//$listofusers = get_user_array(FALSE, "Active", $current_user->id);
//$smarty->assign("USERLIST", $listofusers);

$smarty->assign("CURRENT_USER_NAME", $current_user->user_name);
$smarty->assign("CURRENT_USER_ID", $current_user->id);

$smarty->assign("LISTMARKAS", vtlib_getPicklistValues_AccessibleToAll('vtmsgstatus'));

// Reset the listview length back
$listview_max_textlength = $old_listview_max_textlength;

if(isset($_REQUEST['ajax']) && $_REQUEST['ajax'] != '')
	$smarty->display(vtlib_getModuleTemplate($currentModule, 'DetailViewAjax.tpl'));
else 
	$smarty->display(vtlib_getModuleTemplate($currentModule, 'DetailView.tpl'));

// END
?>
