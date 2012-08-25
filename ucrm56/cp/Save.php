<?php

include("include.php");
include("version.php");
require_once("PortalConfig.php");
require_once("include/utils/utils.php");

global $version,$default_language,$result;
global $app_strings, $mod_strings, $current_language, $currentModule, $theme;

session_start();
setPortalCurrentLanguage();
$default_language = getPortalCurrentLanguage();
require_once("language/".$default_language.".lang.php");

if(!empty($_FILES)){

	$file = $_FILES['filename'];
	$type = $file['type'];
	$name = $file['name'];

	if($default_language=="zh_cn")
	{
		if (function_exists("mb_convert_encoding"))
		{
			$name = mb_convert_encoding($name,'GB2312','UTF-8');
		}
		else 
		{
			$name = iconv('UTF-8','GB2312',$name);
		}
	}
	$filetmp_name = str_replace(' ','_','../cache/upload/'.$name);
	move_uploaded_file($file['tmp_name'],$filetmp_name);
	$_REQUEST['filename'] = str_replace(' ','_',$file['name']);
	$_REQUEST['filetype'] = $type;
	$_REQUEST['filesize'] = filesize($filetmp_name);
	
}

$params = array(array($_REQUEST));

//print_r($_REQUEST);
//print_r($params);exit;
$result = $client->call('save_detail', $params, $Server_Path, $Server_Path);

header('location:index.php?module='.$result[0].'&action=index&id='.$result[1]);
?>