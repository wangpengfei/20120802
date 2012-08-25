<?php
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *************************************************************************************/
require_once('Smarty_setup.php'); 
require_once('include/database/PearDatabase.php');
global $adb;
global $log;

global $theme, $currentModule, $mod_strings, $app_strings, $current_user,$smarty;
$theme_path="themes/".$theme."/";
$image_path=$theme_path."images/";


if($_REQUEST['mode']=="Save"){
	// 保存sms配置信息
	$id = $_REQUEST['id'];
	$username = $_REQUEST['username'];
	$password = $_REQUEST['password'];
	$isactive = $_REQUEST['isactive']; 
	
	$adb->pquery("UPDATE vtiger_smsnotifier_servers SET isactive=?,username = ?, password = ? WHERE id=?",array($isactive,$username,$password,$id));
}
// 获取sms配置信息
$reselut = $adb->pquery(" SELECT * FROM vtiger_smsnotifier_servers WHERE isactive = 1 LIMIT 1",array());

if($reselut && $adb->num_rows($reselut)) {
	while($resultrow = $adb->fetch_array($reselut)) {
		$id = $resultrow['id'];
		$name = $resultrow['username'];
		$pwd = $resultrow['password'];
		$isactive = $resultrow['isactive'];
	}
}

if($isactive==1){
	$isactive=getTranslatedString('LBL_ENABLE','Settings');
	$open="checked";
}else{
	$isactive=getTranslatedString('LBL_DISABLE','Settings');
	$close="checked";
}

$sms= array(
	'open'=>$open,
	'close'=>$close
);

$length = strlen($pwd);
for($i=0; $i<$length; $i++){
	$str .= "*"; 
}
$server = array(
	'id'=>$id,
	'username'=>$name,
	'password'=>$str,
	'isactive'=>$isactive
);

$server_edit = array(
	'id'=>$id,
	'username'=>$name,
	'password'=>$pwd,
	'isactive'=>$isactive
);

/*
//获取可发条数
$name = iconv( "UTF-8", "GBK", $name );
$name = urlencode( $name );
$pwd = iconv( "UTF-8", "GBK", $pwd );
$pwd = urlencode( $pwd );
$url ="http://www.china-sms.com/send/getfee.asp?name=$name&pwd=$pwd";
$fp=fopen($url,"r");
$ret  = fgetss($fp,255);
fclose($fp);
//查看返回结果
$ret = iconv("GBK", "UTF-8", $ret);
$access_num_arr  = explode("&",$ret); 
$access_num_arr = explode("=",$access_num_arr[0]); 
$server['access_num'] = $access_num_arr[1];
*/

include_once dirname(__FILE__) . '/SMSNotifier.php';
$provider = SMSNotifierManager::getActiveProviderInstance();
if(is_object($provider)){
	$server['access_num'] = $provider->get_overage($name,$pwd);
}
/*
//获取可发条数
$name = iconv( "UTF-8", "GBK", $name );
$pwd = strtolower(md5($pwd));
$url ="http://api.52ao.com/m/?user=$name&pass=$pwd";
$fp=fopen($url,"r");
$ret  = fgetss($fp,255);
fclose($fp);
//查看返回结果
$access_num_arr  = explode(",",$ret);
$server['access_num'] = $access_num_arr[1];
	 */
	 
$smarty = new vtigerCRM_Smarty();
$smarty->assign("MOD", return_module_language($current_language,'Settings'));
$smarty->assign("IMAGE_PATH", $image_path);
$smarty->assign("APP", $app_strings);
$smarty->assign("CMOD", $mod_strings);
$smarty->assign("MODULE_LBL", $currentModule);
$smarty->assign('SMSSERVERS', $server);
$smarty->assign('SMSSERVERSEDIT', $server_edit);
$smarty->assign('SMS', $sms);

if(empty($_REQUEST['mode'])){
	$smarty->display(vtlib_getModuleTemplate($currentModule, 'SMSConfig.tpl'));
}else if($_REQUEST['mode']=="Edit"){
	$smarty->display(vtlib_getModuleTemplate($currentModule, 'SMSConfigEdit.tpl'));
}else if($_REQUEST['mode']=="Save" || $_REQUEST['mode']=="Cannel"){
	$smarty->display(vtlib_getModuleTemplate($currentModule, 'SMSConfigContents.tpl'));
}

?>