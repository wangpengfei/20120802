<?php
global $adb;

$delete_rel_sql = "DELETE FROM vtiger_parenttabrel WHERE parenttabid = ?";

$adb->pquery($delete_rel_sql,array($_REQUEST['id']));

$delete_sql = "DELETE FROM vtiger_parenttab WHERE parenttabid = ?";

$adb->pquery($delete_sql,array($_REQUEST['id']));

require_once("modules/Settings/CreateMenuFile.php");

$url = "index.php?module=Settings&action=CustomTabList&parenttab=Settings";

header("Location:$url");
?>