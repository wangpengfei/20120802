<?php
/*+*******************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ********************************************************************************/

require_once('include/database/PearDatabase.php');

global $adb;

$notesid = vtlib_purify($_REQUEST['record']);

$dbQuery = "select filename,folderid from vtiger_notes where notesid= ?";
$result = $adb->pquery($dbQuery,array($notesid));
$folderid = $adb->query_result($result,0,'folderid');
$filename = $adb->query_result($result,0,'filename');

$fileidQuery = "select attachmentsid from vtiger_seattachmentsrel where crmid = ?";
$fileidRes = $adb->pquery($fileidQuery,array($notesid));
$fileid = $adb->query_result($fileidRes,0,'attachmentsid');

$pathQuery = $adb->pquery("select path from vtiger_attachments where attachmentsid = ?",array($fileid));
$filepath = $adb->query_result($pathQuery,0,'path');
		
$fileinattachments = $root_directory.$filepath.$fileid.'_'.$filename;
//if(!file($fileinattachments))$fileinattachments = $root_directory.$filepath.$fileid."_".$filename;

$newfileinstorage = $root_directory."/storage/$fileid-".$filename;

global $current_language,$default_charset;
if($current_language=="zh_cn")
{
	if (function_exists("mb_convert_encoding"))
	{
		$fileinattachments = mb_convert_encoding($fileinattachments,'GB2312',$default_charset);
		$newfileinstorage = mb_convert_encoding($newfileinstorage,'GB2312',$default_charset);
	}
	else 
	{
		$fileinattachments = iconv($default_charset,'GB2312',$fileinattachments);
		$newfileinstorage = iconv($default_charset,'GB2312',$newfileinstorage);
	}
}

copy($fileinattachments,$newfileinstorage);

echo "<script>window.history.back();</script>";
exit();
?>
