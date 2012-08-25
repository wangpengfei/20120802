<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
 
global $mod_strings,$app_strings,$theme,$currentModule,$current_user;

require_once('Smarty_setup.php');

$smarty = new vtigerCRM_Smarty;

require_once('Smarty_setup.php');

include_once dirname(__FILE__) . '/SMSNotifier.php';

global $currentModule, $mod_strings, $app_strings, $current_user, $adb;

$idstring = vtlib_purify($_REQUEST['idstring']);
$idstring = trim($idstring, ';');
$idlist = explode(';', $idstring);


$sourcemodule = vtlib_purify($_REQUEST['sourcemodule']);
$message = vtlib_purify($_REQUEST['message']);

$phonefields = vtlib_purify($_REQUEST['phonefields']);
$phonefields = trim($phonefields, ';');
$phonefieldlist = explode(';', $phonefields);

$tonumbers = array();
$recordids = array();

foreach($idlist as $recordid) {
	$focusInstance = CRMEntity::getInstance($sourcemodule);
	$focusInstance->retrieve_entity_info($recordid, $sourcemodule);
	$numberSelected = false;
	foreach($phonefieldlist as $fieldname) {
		if(!empty($focusInstance->column_fields[$fieldname])) {
			$tonumbers[] = $focusInstance->column_fields[$fieldname];
			$numberSelected = true;
			$id_num[$recordid] = $focusInstance->column_fields[$fieldname];
		}
	}
	if($numberSelected) {
		$recordids[] = $recordid;
	}	
}

if(!empty($tonumbers)) {
		//admin 发送
	if($_REQUEST['dep']){
	
		$dep = $_REQUEST['dep'];
		$pro = $_REQUEST['pro'];
		$cou = $_REQUEST['cou'];
		$par = $_REQUEST['par'];
		
		if( $par!="0" ){
			$dep = "俱乐部";
			$pro = "俱乐部";
			$cou = "0";
		}elseif( $dep=='请选择'&&$pro=='请选择'&&$cou=='0'&&$par=="0" ){
			$dep="培训中心";
			$pro="培训中心";
			$cou="0";
			$par="归属其他";
		}elseif( $dep!='请选择'&&$pro=='请选择'&&$cou=='0'&&$par=="0" ){
			$pro="归属部门";
			$cou="0";
			$par="归属其他";
		}elseif( $dep!='请选择'&&$pro!='请选择'&&$cou=='0'&&$par=="0" ){
			$cou="0";
			$par="归属其他";
		}elseif( $dep!='请选择'&&$pro!='请选择'&&$cou!='0'&&$par=="0" ){
			$par="归属其他";
		}
		
		SMSNotifier::sendsms($message, $tonumbers, $id_num, $current_user->id, $recordids, $sourcemodule,$dep,$pro,$cou,$par );	
	}else{
		//其他用户发送获取班级信息
		$idstr = implode(",",$recordids);
		
		$sql = "SELECT * FROM vtiger_mentee 
inner join vtiger_course   on  courseid=vtiger_mentee.linkto3
inner join  vtiger_program    on  programid =vtiger_mentee.linkto2
inner join vtiger_department  on departmentid=vtiger_mentee.linkto
where menteeid 	in (".$idstr.")";

 		$reselut = $adb->pquery($sql);
		
		if($reselut && $adb->num_rows($reselut)) {
	
			while($resultrow = $adb->fetch_array($reselut)) {
				$arr['departmentname']= $resultrow['departmentname'];
				$arr['programname']=$resultrow['programname'];
				$arr['coursename']=$resultrow['courseid'];	
				$data_arr[$resultrow['menteeid']] = $arr;
			}
		}
		
		$par="归属其他";
		
		SMSNotifier::sendsms($message, $tonumbers, $id_num, $current_user->id, $recordids, $sourcemodule,$dep,$pro,$cou,$par,$data_arr);	
	}
}
echo SMSNotifier::$smserrormsg;
/* 
$smarty->assign("APP", $app_strings);

$smarty->assign('MSG',SMSNotifier::$smserrormsg);

$smarty->display(vtlib_getModuleTemplate($currentModule, 'SMSErrormsg.tpl'));
 */
 
?>
