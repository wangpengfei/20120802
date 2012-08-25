<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
global $currentModule;
$modObj = CRMEntity::getInstance($currentModule);

$ajaxaction = $_REQUEST["ajxaction"];

if($ajaxaction == 'WIDGETADDAPPROVAL') {
	global $adb, $current_user;
	global $log;
	if (isPermitted($currentModule, 'CreateView', '') == 'yes') {
		
		$modObj->column_fields['approvalcontent'] = vtlib_purify($_REQUEST['approval']);
		$modObj->column_fields['related_to'] = vtlib_purify($_REQUEST['parentid']);
		
		
		$modObj->column_fields['reports_to_id'] = vtlib_purify($_REQUEST['reports_to_id']);
		$modObj->column_fields['assigned_user_id'] = $current_user->id;
	
		if (!$modObj->column_fields['reports_to_id']) //close approval flow added by wangyefeng for approval status
			$modObj->column_fields['approvals_status']= getTranslatedString("PAST",$currentModule);
       else
	       $modObj->column_fields['approvals_status']= getTranslatedString("PEND",$currentModule);

		$modObj->save($currentModule);
        if($_REQUEST['pre_approvalsid'])
		{
			$pre_approvalsid = vtlib_purify($_REQUEST['pre_approvalsid']);
			$sql="update vtiger_modapprovals set next_approvals =? ,approvals_status =? where modapprovalsid =?";
			$approvaved_status = getTranslatedString('PAST',$currentModule);
			$params=array($modObj->id,$approvaved_status,$pre_approvalsid );
			$adb->pquery($sql, $params);
		}
	
		if(empty($modObj->column_fields['smcreatorid'])) $modObj->column_fields['smcreatorid'] = $current_user->id;
		if(empty($modObj->column_fields['modifiedtime'])) $modObj->column_fields['modifiedtime']= date('Y-m-d H:i:s');
		
		$widgetInstance = $modObj->getWidget('DetailViewBlockApprovalWidget');
		echo ':#:SUCCESS'. $widgetInstance->processItem($modObj->getAsApprovalModel($modObj->column_fields));
	} else {
		echo ':#:FAILURE';
	}
}

else if($ajaxaction == 'DETAILVIEW') {
	$crmid = $_REQUEST['recordid'];
	$tablename = $_REQUEST['tableName'];
	$fieldname = $_REQUEST['fldName'];
	$fieldvalue = utf8RawUrlDecode($_REQUEST['fieldValue']); 
	if($crmid != '')
	{
		$modObj->retrieve_entity_info($crmid, $currentModule);
		$modObj->column_fields[$fieldname] = $fieldvalue;
		$modObj->id = $crmid;
		$modObj->mode = 'edit';
		$modObj->save($currentModule);
		if($modObj->id != '')
		{
			echo ':#:SUCCESS';
		}else
		{
			echo ':#:FAILURE';
		}   
	}else
	{
		echo ':#:FAILURE';
	}
} elseif($ajaxaction == "LOADRELATEDLIST" || $ajaxaction == "DISABLEMODULE"){
	require_once 'include/ListView/RelatedListViewContents.php';
}
?>