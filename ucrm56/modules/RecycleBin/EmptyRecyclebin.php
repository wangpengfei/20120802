<?php
/*********************************************************************************
 *** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 ** ("License"); You may not use this file except in compliance with the License
 ** The Original Code is:  vtiger CRM Open Source
 ** The Initial Developer of the Original Code is vtiger.
 ** Portions created by vtiger are Copyright (C) vtiger.
 ** All Rights Reserved.
 **
 *********************************************************************************/
global $adb;

$parenttab = getParentTab();

$idlist = explode(";",$_REQUEST['idlist']);
if($_REQUEST['idlist']){
	$selected_module = $_REQUEST['selectmodule'];
	$idlist = implode(",",$idlist);
	$idlist = substr($idlist,0,-1);
	$adb->query("DELETE FROM vtiger_crmentity WHERE deleted = 1 and crmid in(".$idlist.")");
	header("Location: index.php?module=RecycleBin&action=RecycleBinAjax&file=index&parenttab=$parenttab&mode=ajax&selected_module=$selected_module");

}else{
	$adb->query('DELETE FROM vtiger_crmentity WHERE deleted = 1');
	$adb->query('DELETE FROM vtiger_relatedlists_rb');
	header("Location: index.php?module=RecycleBin&action=RecycleBinAjax&file=index&parenttab=$parenttab&mode=ajax");
}
?>

