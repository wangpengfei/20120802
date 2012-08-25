<?php
/*+********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *********************************************************************************/

global $mod_strings,$app_strings,$theme,$currentModule,$current_user;
require_once ('include/database/PearDatabase.php');
require_once ('modules/SMSNotifier/SMSNotifier.php');
global $adb;

function checkbothday($day){
	$day = substr(trim($day),-5);
	$date = date("m-d");
	if($date == $day){
		return true;
	}else{
		return false;
	}
}

// 获取节日信息  
$reselut = $adb->pquery("SELECT * FROM vtiger_smstemplates WHERE subject NOT LIKE '%生日%'");

$date = date("Y-m-d");

$sourcemodule= 'Mentee';

unset($tonumbers);

unset($message);

if( $reselut && $adb->num_rows($reselut) ) {

	while( $resultrow = $adb->fetch_array($reselut) ) {

		//节庆日
		$new_date = substr($resultrow['datetime'],0,10);

		if($new_date==$date){
		
			$message = $resultrow['body'];
			
			//查找学员
			//$accountreselut = $adb->pquery("SELECT accountid,accountname,phone FROM vtiger_account");
			//cf_786 电话
			$accountreselut = $adb->pquery("SELECT a.menteeid,menteename,cf_780,cf_786 FROM vtiger_mentee a, vtiger_menteecf b where a.menteeid=b.menteeid");

			while( $accountresultrow = $adb->fetch_array($accountreselut) ) {
				$length = strlen($accountresultrow['cf_786']);
				if($length==11){
					$tonumbers[] = $accountresultrow['cf_786'];
					$id_num[$accountresultrow['menteeid']] = $accountresultrow['cf_786'];
					$recordids[] = $accountresultrow['menteeid'];
				}
			}
		}
	}
}

if( !empty($tonumbers) && !empty($message) ){
	SMSNotifier::sendsms($message, $tonumbers, $id_num, $current_user->id, $recordids, $sourcemodule);
	echo SMSNotifier::$smserrormsg;
	echo "<br/>";
	echo "正在发送节日短信<br/>";
}

unset($tonumbers);

unset($message);

//获取过生日短信模板
$reselut = $adb->pquery("SELECT * FROM vtiger_smstemplates
where subject like '%生日%' limit 1");
while( $resultrow = $adb->fetch_array($reselut) ) {
	$message = $resultrow['body'];
}

//获取过生日的学员
//$accountreselut = $adb->pquery("SELECT a.accountid,accountname,phone,cf_607 FROM vtiger_account a,vtiger_accountscf b where a.accountid=b.accountid");

//cf_786 电话
//cf_780 生日
	
$accountreselut = $adb->pquery("SELECT a.menteeid,menteename,cf_780,cf_786 FROM vtiger_mentee a, vtiger_menteecf b where a.menteeid=b.menteeid");

while( $accountresultrow = $adb->fetch_array($accountreselut) ) {
	$flag = checkbothday($accountresultrow['cf_780']);
	$length=strlen($accountresultrow['cf_786']);
	if( $flag && $length==11 ){
		$tonumbers[] = $accountresultrow['cf_786'];
		$id_num[$accountresultrow['menteeid']] = $accountresultrow['cf_786'];
		$recordids[] = $accountresultrow['menteeid'];
	}
}

if( !empty($tonumbers) && !empty($message) ){

	SMSNotifier::sendsms($message, $tonumbers, $id_num, $current_user->id, $recordids, $sourcemodule);
	echo SMSNotifier::$smserrormsg;
	echo "<br/>";
	echo "正在发送生日短信<br/>";
}

unset($_SESSION);

exit("自动发送短信页面<br/>");

?>
