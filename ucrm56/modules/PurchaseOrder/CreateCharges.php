<?php
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Public License Version 1.1.2
 * ("License"); You may not use this file except in compliance with the 
 * License. You may obtain a copy of the License at http://www.sugarcrm.com/SPL
 * Software distributed under the License is distributed on an  "AS IS"  basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for
 * the specific language governing rights and limitations under the License.
 * The Original Code is:  SugarCRM Open Source
 * The Initial Developer of the Original Code is SugarCRM, Inc.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.;
 * All Rights Reserved.
 * Contributor(s): ______________________________________.
 ********************************************************************************/
/*********************************************************************************
 * $Header$
 * Description:  TODO To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('Smarty_setup.php');
require_once('data/Tracker.php');
require_once('include/CustomFieldUtil.php');
require_once('include/utils/utils.php');
require_once('user_privileges/default_module_view.php');

global $mod_strings,$adb,$app_strings,$theme,$currentModule,$current_user,$singlepane_view;
ob_end_clean();
$smarty = new vtigerCRM_Smarty;

$focus = CRMEntity::getInstance($currentModule);
//Charges
if(isset($_REQUEST['record']) && isset($_REQUEST['record'])) {
	$sql = "select * from vtiger_charges 
	inner join vtiger_crmentityrel on vtiger_crmentityrel.relmodule='Charges' and vtiger_crmentityrel.relcrmid=vtiger_charges.chargesid 
	inner join vtiger_crmentity on vtiger_crmentity.crmid=vtiger_charges.chargesid and vtiger_crmentity.deleted!=1 
	where purchaseorder_id=?";
	$res = $adb->pquery($sql,array($_REQUEST['record']));
	
	if($adb->query_result($res, 0, 'chargesid')){
		die('ERROR::'.$app_strings['LBL_ALREADY_CHARGES']);
	}
	
	$sql = "select * from vtiger_purchaseorder 
inner join vtiger_crmentity on vtiger_crmentity.crmid=vtiger_purchaseorder.purchaseorderid and vtiger_crmentity.deleted!=1 
left join vtiger_vendor on vtiger_vendor.vendorid=vtiger_purchaseorder.vendorid 
where vtiger_purchaseorder.purchaseorderid=?";
	$res = $adb->pquery($sql,array($_REQUEST['record']));
	
	$smarty->assign("subject", $adb->query_result($res, 0, 'subject'));
	$smarty->assign("vendorid", $adb->query_result($res, 0, 'vendorid'));
	$smarty->assign("vendorname", $adb->query_result($res, 0, 'vendorname'));
	$smarty->assign("purchaseorder_no", $adb->query_result($res, 0, 'purchaseorder_no'));
	$smarty->assign("purchaseorderid", $adb->query_result($res, 0, 'purchaseorderid'));
	$smarty->assign("total", $adb->query_result($res, 0, 'total'));
}

$module_name = 'PurchaseOrder';
$fieldlabel  = 'Assigned To';
global $noof_group_rows;
if($fieldlabel == 'Assigned To' && $is_admin==false && $profileGlobalPermission[2] == 1 && ($defaultOrgSharingPermission[getTabid($module_name)] == 3 or $defaultOrgSharingPermission[getTabid($module_name)] == 0))
{
	$result=get_current_user_access_groups($module_name);
}
else
{ 		
	$result = get_group_options();
}
if($result) $nameArray = $adb->fetch_array($result);

if($value != '' && $value != 0)
	$assigned_user_id = $value;
else{
	if($value=='0'){
		if (isset($col_fields['assigned_group_info']) && $col_fields['assigned_group_info'] != '') {
			$selected_groupname = $col_fields['assigned_group_info'];
		} else {
			$record = $col_fields["record_id"];
			$module = $col_fields["record_module"];
			$selected_groupname = getGroupName($record, $module);
		}
	}else
		$assigned_user_id = $current_user->id;
}

if($fieldlabel == 'Assigned To' && $is_admin==false && $profileGlobalPermission[2] == 1 && ($defaultOrgSharingPermission[getTabid($module_name)] == 3 or $defaultOrgSharingPermission[getTabid($module_name)] == 0))
{
	$users_combo = get_select_options_array(get_user_array(FALSE, "Active", $assigned_user_id,'private'), $assigned_user_id);
}
else
{
	$users_combo = get_select_options_array(get_user_array(FALSE, "Active", $assigned_user_id), $assigned_user_id);
}

if($noof_group_rows!=0)
{
	if($fieldlabel == 'Assigned To' && $is_admin==false && $profileGlobalPermission[2] == 1 && ($defaultOrgSharingPermission[getTabid($module_name)] == 3 or $defaultOrgSharingPermission[getTabid($module_name)] == 0))
	{
		$groups_combo = get_select_options_array(get_group_array(FALSE, "Active", $assigned_user_id,'private'), $assigned_user_id);
	}
	else
	{
		$groups_combo = get_select_options_array(get_group_array(FALSE, "Active", $assigned_user_id), $assigned_user_id);
	}
}

$dat_fmt = (($current_user->date_format == '')?('yyyy-mm-dd'):($current_user->date_format));
$disp_value = (($dat_fmt == 'dd-mm-yyyy')?(date('d-m-Y')):(($dat_fmt == 'mm-dd-yyyy')?(date('m-d-Y')):(($dat_fmt == 'yyyy-mm-dd')?(date('Y-m-d')):(''))));

$smarty->assign("MOD", $mod_strings);
$smarty->assign("APP", $app_strings);
$smarty->assign("THEME", $theme);
$smarty->assign("dateStr", $dat_fmt);
$smarty->assign("date_val", $disp_value);
$smarty->assign("users_combo", $users_combo);
$smarty->assign("groups_combo", $groups_combo);

$smarty->display("Inventory/CreateCharges.tpl");
?>