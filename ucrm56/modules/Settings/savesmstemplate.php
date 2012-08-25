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

global $log;
$db = PearDatabase::getInstance();
$templateid = vtlib_purify($_REQUEST["templateid"]);
$subject = from_html($_REQUEST["subject"]);
$body = fck_from_html($_REQUEST["body"]);

if(isset($templateid) && $templateid !='')
{
	$log->info("the templateid is set");  
	$sql = "update vtiger_smstemplates set subject =?, body =? where templateid =?";
	$params = array($subject, $body, $templateid);
	$adb->pquery($sql, $params);
 
	$log->info("about to invoke the detailviewsmstemplate file");  
	header("Location:index.php?module=Settings&action=detailviewsmstemplate&parenttab=Settings&templateid=".$templateid);
}
else
{
	$templateid = $db->getUniqueID('vtiger_smstemplates');
	$sql = "insert into vtiger_smstemplates values (?,?,?)";
	$params = array($templateid, $subject, $body);
	$adb->pquery($sql, $params);

	 $log->info("added to the db the smstemplate");
	header("Location:index.php?module=Settings&action=detailviewsmstemplate&parenttab=Settings&templateid=".$templateid);
}
?>