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
 * $Header: /advent/projects/wesat/vtiger_crm/sugarcrm/modules/Emails/EditView.php,v 1.25 2005/04/18 10:37:49 samk Exp $
 * Description: TODO:  To be written.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
require_once('Smarty_setup.php');
require_once('data/Tracker.php');
require_once('include/utils/utils.php');
require_once('include/utils/UserInfoUtil.php');
require_once("include/Zend/Json.php");

global $log;
global $app_strings;
global $app_list_strings;
global $mod_strings;
global $current_user;
global $currentModule;
global $default_charset;

$focus = CRMEntity::getInstance($currentModule);
$smarty = new vtigerCRM_Smarty();
$json = new Zend_Json();

$idstring = $_REQUEST['idstring'];
$smarty->assign("IDSTRING", $idstring);
$idstring = explode(";",$idstring);
$idstring = implode("\",\"",$idstring);
$idstring = substr($idstring,0,-3);

//$query = 'SELECT * FROM vtiger_account WHERE accountid in ("'.$idstring .'")';
$query = 'SELECT  *  FROM vtiger_mentee a,vtiger_menteecf b
WHERE a.menteeid =b.menteeid and a.menteeid in ("'.$idstring .'")';

//cf_786  电话
$result = $adb->pquery($query);

if($result && $adb->num_rows($result)) {
	while($resultrow = $adb->fetch_array($result)) {
		if(!empty($resultrow['cf_786'])){
			$phonestr[] = $resultrow['cf_786'];
		}
	}
}

$phonestr = implode(",",$phonestr);

$smarty->assign("PHONE", $phonestr);
	

if($_COOKIE['ck_login_id_vtiger']==1){
	
	$smarty->assign("NOTICE",  $mod_strings['NOTICE']);
	
	//获取模板信息
	//$msgmodereselut = $adb->pquery("SELECT  vtiger_festi.* , vtiger_festicf.*   from vtiger_festi,vtiger_festicf where vtiger_festi.festiid = vtiger_festicf.festiid");
	$msgmodereselut = $adb->pquery("SELECT * FROM vtiger_smstemplates");
	
	if($msgmodereselut && $adb->num_rows($msgmodereselut)) {
		while($resultrow = $adb->fetch_array($msgmodereselut)) {
			if(!empty($resultrow['body'])){
				$select[$resultrow['body']] = $resultrow['subject'];
			}
		}
	}
	$smarty->assign('SELECT',$select);
	
	//获取部门信息
	$depreselut = $adb->pquery("select vtiger_department.*,vtiger_crmentity.crmid FROM vtiger_department INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_department.departmentid WHERE vtiger_department.departmentid > 0 AND vtiger_crmentity.deleted = 0 ORDER BY vtiger_department.departmentname ASC");

	if($depreselut && $adb->num_rows($depreselut)) {

		while($resultrow = $adb->fetch_array($depreselut)) {
		
			if(!empty($resultrow['departmentname'])){
			
				$selectdep[$resultrow['departmentid']] = $resultrow['departmentname'];
			}
		}
	}
	
	//获取俱乐部信息
	$partyreselut = $adb->pquery("SELECT * FROM vtiger_cf_826");

	if($partyreselut && $adb->num_rows($partyreselut)) {
		
		$selectparty['0']="请选择";
		
		while($resultrow = $adb->fetch_array($partyreselut)) {
		
			if(!empty($resultrow['cf_826'])){
			    
				$selectparty[$resultrow['cf_826']] = $resultrow['cf_826'];
			}
		}
	}

	$smarty->assign('SELECTDEP',$selectdep);
	
	$selectpro['0']="请选择";
	
	$smarty->assign('SELECTPRO',$selectpro);
	
	$selectcou['0']="请选择";
	
	$smarty->assign('SELECTCOU',$selectcou);
	
	$smarty->assign('SELECTPARTY',$selectparty);
}

$smarty->assign("THEME", $theme);
$smarty->assign("IMAGE_PATH", $image_path);
$smarty->assign("APP", $app_strings);
$smarty->assign("MOD", $mod_strings);
$smarty->assign("PRINT_URL", "phprint.php?jt=".session_id().$GLOBALS['request_string']);
$smarty->assign("ID", $focus->id);
$smarty->assign("ENTITY_ID", vtlib_purify($_REQUEST["record"]));
$smarty->assign("ENTITY_TYPE",vtlib_purify($_REQUEST["email_directing_module"]));
$smarty->assign("OLD_ID", $old_id );
$smarty->display("ComposSms.tpl");
?>