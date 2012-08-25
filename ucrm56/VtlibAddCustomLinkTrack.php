<?
include_once('vtlib/Vtiger/Module.php');
	
	// Links for Accounts module
	$moduleInstance = Vtiger_Module::getInstance('Accounts');
	// Detail View Custom link
	$moduleInstance->addLink(
		'HEADERSCRIPT', 'LBL_APPROVAL', 
		'index.php?module=Track&action=EditView&return_module=$MODULE$&return_action=DetailView&return_id=$RECORD$&parent_id=$RECORD$',
		'themes/images/bookMark.gif'
	);
	
	$moduleInstance3 = Vtiger_Module::getInstance('Contacts');
	$moduleInstance3->addLink(
		'DETAILVIEWBASIC', 'LBL_ADD_TRACK', 
		'index.php?module=Track&action=EditView&return_module=$MODULE$&return_action=DetailView&return_id=$RECORD$&parent_id=$RECORD$',
		'themes/images/bookMark.gif'
	);

?>