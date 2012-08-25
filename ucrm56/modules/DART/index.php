<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
global $current_user, $currentModule, $theme, $app_strings, $mod_strings;

include_once 'Smarty_setup.php';
include_once dirname(__FILE__) . '/DART.php';

$daySelected = vtlib_purify($_REQUEST['_date']);
if (empty($daySelected)) $daySelected = date('Y-m-d');

$today = date('Y-m-d');

$dart = new DART();
$dart->setActiveUser($current_user);

if ($_REQUEST['_refresh'] == 'true') {
	$dart->record_ChangesForTheDay($today);
} 

global $adb,$current_user;
if($current_user->is_admin == 'off'){
	$pres = $adb->pquery('select parentrole from vtiger_role where roleid= ?', array($current_user->roleid));
	$parentrole = $adb->query_result($pres,0,'parentrole');
	
	$sql = "select u.id,u.user_name from vtiger_users u,vtiger_user2role r where u.id=r.userid and roleid in (select roleid from vtiger_role where parentrole like '$parentrole%')";
}else{
	$sql = "select * from vtiger_users";
}
$userres = $adb->pquery($sql, array());

$uid = $_REQUEST['_u'];
while($row = $adb->fetch_array($userres)) {
	$user_key[]=$row['id'];
	if($row['id'] == $uid){
		$select = 'selected="selected"';
	}elseif($row['id'] == $current_user->id){
		$select = 'selected="selected"';
	}else{
		$select = '';
	}
	$lowers .= '<option value="'.$row['id'].'" '.$select.' >'.$row['user_name'].'</option>';
}
if(!in_array($uid,$user_key)){
	$uid = $current_user->id;
}
//$changes = $dart->report_GatherChangedRecordDetails($daySelected);
$changes = $dart->get_detail($uid,$daySelected);

$smarty = new vtigerCRM_Smarty();

$smarty->assign('USERLIST', $lowers);
$smarty->assign('USERID', $uid);

$smarty->assign('BASEURL', '');
$smarty->assign('CHANGES', $changes);
$smarty->assign('DAY', $daySelected);
$smarty->assign('TODAY', $today);

$smarty->assign('MODULE', $currentModule);
$smarty->assign('CATEGORY', getParentTab());
$smarty->assign('THEME', "$theme");
$smarty->assign('IMAGE_PATH', "themes/$theme/images/");
$smarty->assign('MOD', $mod_strings);
$smarty->assign('APP', $app_strings);

$smarty->display(vtlib_getModuleTemplate($currentModule, 'index.tpl'));

?>
