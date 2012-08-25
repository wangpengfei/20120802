<?
include_once('vtlib/Vtiger/Module.php');
	
	// Links for SalesOrder module
	$moduleInstance = Vtiger_Module::getInstance('SalesOrder');
	// Detail View Custom link
	$moduleInstance->addLink('LISTVIEWBASIC', 'LBL_APPROVAL', 'SMSNotifierCommon.displaySelectWizard(this, \'$MODULE$\');','');

$moduleInstance->addLink('DETAILVIEWBASIC', 'LBL_APPROVAL', 'javascript:SMSNotifierCommon.displaySelectWizard_DetailView(\'$MODULE$\', \'$RECORD$\');','themes/images/bookMark.gif');

?>