<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
global $current_user, $currentModule;

checkFileAccess("modules/$currentModule/$currentModule.php");
require_once("modules/$currentModule/$currentModule.php");

$focus = new $currentModule();
setObjectValuesFromRequest($focus);

$mode = $_REQUEST['mode'];
$record=$_REQUEST['record'];
if($mode) $focus->mode = $mode;
if($record)$focus->id  = $record;

if($_REQUEST['assigntype'] == 'U') {
	$focus->column_fields['assigned_user_id'] = $_REQUEST['assigned_user_id'];
} elseif($_REQUEST['assigntype'] == 'T') {
	$focus->column_fields['assigned_user_id'] = $_REQUEST['assigned_group_id'];
}

$focus->save($currentModule);
$return_id = $focus->id;


/************** Start Send Support Email *****************/
global $app_strings, $mod_strings, $default_charset,$adb;
global $site_URL,$root_directory;

$sql="select * from vtiger_organizationdetails";
$result = $adb->pquery($sql, array());
$organization_name = $adb->query_result($result,0,'organizationname');
$organization_address= $adb->query_result($result,0,'address');
$organization_city = $adb->query_result($result,0,'city');
$organization_state = $adb->query_result($result,0,'state');
$organization_code = $adb->query_result($result,0,'code');
$organization_country = $adb->query_result($result,0,'country');
$organization_phone = $adb->query_result($result,0,'phone');
$organization_fax = $adb->query_result($result,0,'fax');
$organization_website = $adb->query_result($result,0,'website');
$organization_logoname = decode_html($adb->query_result($result,0,'logoname'));

if($_REQUEST['mode'] == 'edit'){
	require('SendReminder.php');
}else{
	$_REQUEST['mode'] = 'create';
}
$contents = '<font color=red><strong>'.$mod_strings['feedbackname'].'&nbsp;&nbsp;:&nbsp;&nbsp;</strong></font><br>'.$_REQUEST['feedbackname'].'<br>'.
			'<font color=red><strong>'.$mod_strings['feedbackcont'].':</strong></font><br>'.nl2br($_REQUEST['feedbackcont']).'<br>'.
			'<font color=red><strong>'.$mod_strings['feedbacknotes'].':</strong></font><br>'.nl2br($_REQUEST['feedbacknotes']).'<br>'.
			'<font color=red><strong>site_URL :&nbsp;&nbsp;</strong></font><br>'.$site_URL.'<br>'.
			'<font color=red><strong>root_directory :&nbsp;&nbsp;</strong></font><br>'.$root_directory.
			"<br /><br /><table border=0 cellspacing=0 cellpadding=0 width=100% >
      <tr>
        <td width=\"30%\" align=right><strong>".getTranslatedString('LBL_ORGANIZATION_NAME','Settings').":</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td width=\"70%\" ><strong>{$organization_name}</strong></td>
      </tr>
      <tr>
        <td align=right><strong>".getTranslatedString('LBL_ORGANIZATION_LOGO','Settings').":</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td  style=\"background-image: url(test/logo/{$organization_logoname}); background-position: left; background-repeat: no-repeat;\" width=\"48\" height=\"48\" border=\"0\"></td>
      </tr>
      <tr>
        <td align=right><strong>".getTranslatedString('LBL_ORGANIZATION_ADDRESS','Settings').":</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td >{$organization_address}</td>
      </tr>
      <tr> 
        <td align=right><strong>".getTranslatedString('LBL_ORGANIZATION_CITY','Settings').":</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td >{$organization_city}</td>
      </tr>
      <tr>
        <td align=right><strong>".getTranslatedString('LBL_ORGANIZATION_STATE','Settings').":</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td >{$organization_state}</td>
      </tr>
      <tr>
        <td align=right><strong>".getTranslatedString('LBL_ORGANIZATION_CODE','Settings').":</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td >{$organization_code}</td>
      </tr>
      <tr>
        <td align=right><strong>".getTranslatedString('LBL_ORGANIZATION_COUNTRY','Settings').":</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td >{$organization_country}</td>
      </tr>
      <tr>
        <td align=right><strong>".getTranslatedString('LBL_ORGANIZATION_PHONE','Settings').":</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td >{$organization_phone}</td>
      </tr>
      <tr>
        <td align=right><strong>".getTranslatedString('LBL_ORGANIZATION_FAX','Settings').":</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td >{$organization_fax}</td>
      </tr>
      <tr>
        <td align=right><strong>".getTranslatedString('LBL_ORGANIZATION_WEBSITE','Settings').":</strong>&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td >{$organization_website}</td>
      </tr>
</table>";
			
$mail = new PHPMailer();
$mail->Subject = $mod_strings['FeedBack'].' - '.$_REQUEST['feedbackname'];
$mail->Body    = $contents;
$mail->IsSMTP();

$sql="select * from vtiger_systems";
$result = $adb->pquery($sql, array());
$mail_server = $adb->query_result($result,0,'server');
$mail_server_username = $adb->query_result($result,0,'server_username');
$mail_server_password = $adb->query_result($result,0,'server_password');
if(!$mail_server){
	$mail_server = 'ssl://smtp.gmail.com:465';
	$mail_server_username = 'feedback@ubiwire.com';
	$mail_server_password = 'feedback';
}
$_REQUEST['server']=$mail_server;
$mail->Host = $mail_server;
$mail->SMTPAuth = true;
$mail->Username = $mail_server_username ;
$mail->Password = $mail_server_password ;
$mail->From = $mail_server_username;
$mail->FromName = $organization_name;
$mail->AddAddress($HELPDESK_SUPPORT_EMAIL_ID);
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->AltBody = $_REQUEST['feedbackcont']."\r\n".$_REQUEST['feedbacknotes'];
$mail->Send();
/************** End Send Support Email *****************/

$search=$_REQUEST['search_url'];

$parenttab = getParentTab();
if($_REQUEST['return_module'] != '') {
	$return_module = vtlib_purify($_REQUEST['return_module']);
} else {
	$return_module = $currentModule;
}

if($_REQUEST['return_action'] != '') {
	$return_action = vtlib_purify($_REQUEST['return_action']);
} else {
	$return_action = "DetailView";
}

if($_REQUEST['return_id'] != '') {
	$return_id = vtlib_purify($_REQUEST['return_id']);
}

header("Location: index.php?action=$return_action&module=$return_module&record=$return_id&parenttab=$parenttab&start=".vtlib_purify($_REQUEST['pagenumber']).$search);

?>