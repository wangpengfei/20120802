<?php
/*********************************************************************************
 ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 * register
 ********************************************************************************/
include("include.php");
include("version.php");
require_once("PortalConfig.php");
require_once("include/utils/utils.php");

global $version,$default_language,$result;
$lastname = $_REQUEST['lastname'];
$email =$_REQUEST['email'];
$phone = $_REQUEST['phone'];
$company = $_REQUEST['company'];
$description = $_REQUEST['description'];



setPortalCurrentLanguage();
$default_language = getPortalCurrentLanguage();
require_once("language/".$default_language.".lang.php");

$params = Array(array('lastname' => "$lastname",
	'email'=>"$email",
	'phone'=>"$phone",
'company'=>"$company",
'description'=>"$description"));



/*
$params = array();
$params["lastname"] = "lastnamea";
$params["email"] = "email@email.com";
$params["phone"] = "phone";
$params["company"] = "company";
$params["description"] = "description";
*/
$result = $client->call('register_user', $params, $Server_Path, $Server_Path);
//The following are the debug informations

//-----------
$contactid = '';
if(isset($result[0]['contactid']) &&$result[0]['contactid'] != '')
{
	$new_record = 1;
	$contactid = $result[0]['contactid'];
}

if($new_record == 1)
{
   
//	$signup_sucess_msg = getTranslatedString("LBL_SIGNUP_SUCESS");
	//$signup_sucess_msg = base64_encode('<font color=green size=1px;> '.$signup_sucess_msg.' </font>');
	header("Location: sign_up.php?signup_sucess=1&contactid=$contactid");
}
else
{
	header("Location: sign_up.php?signup_error=1");
}
?>
