<?php
/*+********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *********************************************************************************/
require_once('include/logging.php');
require_once('include/database/PearDatabase.php');
global $adb;

if($_REQUEST['proid']){
	// 获取班级信息
	$coursereselut = $adb->pquery("select vtiger_course.*,vtiger_crmentity.crmid FROM vtiger_course 
INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_course.courseid where linkto=".$_REQUEST['proid']." and vtiger_course.courseid > 0 AND vtiger_crmentity.deleted = 0 ORDER BY vtiger_course.coursename ASC");

	if($coursereselut && $adb->num_rows($coursereselut)) {
		while($resultrow = $adb->fetch_array($coursereselut)) {
			if(!empty($resultrow['coursename'])){
				$coursestr.=$resultrow['courseid']."$".$resultrow['coursename']."#";
			}
		}
	}
	echo $coursestr;
	
}else{
	// 获取项目信息
	$proreselut = $adb->pquery("select vtiger_program.*,vtiger_crmentity.crmid FROM vtiger_program 
INNER JOIN vtiger_crmentity ON vtiger_crmentity.crmid = vtiger_program.programid  where linkto=".$_REQUEST['depid']." and vtiger_program.programid > 0 AND vtiger_crmentity.deleted = 0 
ORDER BY vtiger_program.programname ASC");

	if($proreselut && $adb->num_rows($proreselut)) {
		while($resultrow = $adb->fetch_array($proreselut)) {
			if(!empty($resultrow['programname'])){
				$prostr.=$resultrow['programid']."$".$resultrow['programname']."#";
			}
		}
	}
	echo $prostr;
}
?>
