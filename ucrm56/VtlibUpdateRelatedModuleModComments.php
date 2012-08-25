<?php
// Just a bit of HTML formatting
echo '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';

echo '<html><head><title>vtlib Module Script</title>';
echo '<style type="text/css">@import url("themes/softed/style.css");br { display: block; margin: 2px; }</style>';
echo '</head><body class=small style="font-size: 12px; margin: 2px; padding: 2px;">';
echo '<a href="index.php"><img src="themes/softed/images/vtiger-crm.gif" alt="vtiger CRM" title="vtiger CRM" border=0></a><hr style="height: 1px">';

// Turn on debugging level
$Vtiger_Utils_Log = true;

include_once('vtlib/Vtiger/Menu.php');
include_once('vtlib/Vtiger/Module.php');

$moduleaccount = Vtiger_Module::getInstance('Accounts');
$moduleaccount->setRelatedList(Vtiger_Module::getInstance('Track'), 'Track', Array('ADD'), 'get_track');

$moduleaccount->save();





//Contacts ha come RL Track

$modulecontact = Vtiger_Module::getInstance('Contacts');
$modulecontact->setRelatedList(Vtiger_Module::getInstance('Track'), 'Track', Array('ADD'), 'get_track');

$modulecontact->save();


echo '</body></html>';

?>
