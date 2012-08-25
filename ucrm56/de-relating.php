<?php

// Custom script to remove comments block

require_once 'vtlib/Vtiger/Module.php';
require_once 'modules/ModComments/ModComments.php';

$commentsModule = Vtiger_Module::getInstance('ModApprovals');

// This will remove the comments block from display on DetailView.
ModComments::removeWidgetFrom('OTHERMODULENAME'); // Use ModComments::addWidgetTo('OTHERMODULENAME'); to add.

echo "Comments widget removed.";

// This will make sure to remove the relation as well
$fieldInstance = Vtiger_Field::getInstance('related_to', $commentsModule);
$fieldInstance->unsetRelatedModules(array('OTHERMODULENAME'));

echo "Comments widget de-related.";

?>