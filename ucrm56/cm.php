<?php
include_once('vtlib/Vtiger/Module.php');

/*
if($_GET['m']){
	$moduleInstance = Vtiger_Module::getInstance($_GET['m']);
	$moduleInstance->delete();
	echo '成功';
}else{
	echo '模块不存在 m=?';
}
*/
/*
//添加模块到菜单中
$moduleInstance = Vtiger_Module::getInstance('Test');
$menuInstance = Vtiger_Menu::getInstance('Sales');
$menuInstance->addModule($moduleInstance);
*/

/*
//删除菜单中模块
$moduleInstance = Vtiger_Module::getInstance('Test');
$menuInstance = Vtiger_Menu::getInstance('Tools');
$menuInstance->removeModule($moduleInstance);
*/


//模块关联
$moduleInstance = Vtiger_Module::getInstance('PurchaseOrder');
$accountsModule = Vtiger_Module::getInstance('Charges');
$moduleInstance->setRelatedList(
$accountsModule, 'Charges', Array()
);
/*
$moduleInstance = Vtiger_Module::getInstance('Accounts');
$accountsModule = Vtiger_Module::getInstance('Qualification');
$moduleInstance->setRelatedList(
$accountsModule, 'Qualification', Array('ADD')
);

$moduleInstance = Vtiger_Module::getInstance('Accounts');
$accountsModule = Vtiger_Module::getInstance('Performance');
$moduleInstance->setRelatedList(
$accountsModule, 'Performance', Array('ADD')
);
*/

$moduleInstance = Vtiger_Module::getInstance('Accounts');
$accountsModule = Vtiger_Module::getInstance('ExpertType');
$moduleInstance->setRelatedList(
$accountsModule, 'ExpertType', Array('SELECT')
);

/*
$moduleInstance = Vtiger_Module::getInstance('Suppliers');
$accountsModule = Vtiger_Module::getInstance('Qualification');
$moduleInstance->setRelatedList(
$accountsModule, 'Qualification', Array('ADD')
);

$moduleInstance = Vtiger_Module::getInstance('Suppliers');
$accountsModule = Vtiger_Module::getInstance('Keyman');
$moduleInstance->setRelatedList(
$accountsModule, 'Keyman', Array('ADD')
);
*/


/*
$moduleInstance = Vtiger_Module::getInstance('Payslip');
$moduleInstance->addLink(
'DETAILVIEW',
'New Action',
'index.php?module=Payslip&action=EditView&src_module=$MODULE$&src_record=$RECORD$'
);
*/
/*
$moduleInstance = Vtiger_Module::getInstance('Payslip');
$moduleInstance->deleteLink(
'DETAILVIEW',
'New Action',
'index.php?module=Payslip&action=EditView&src_module=$MODULE$&src_record=$RECORD$'
);
*/

