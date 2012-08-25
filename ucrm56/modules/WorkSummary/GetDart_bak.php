<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
global $app_strings, $mod_strings, $current_language, $currentModule, $theme;
include 'modules/DART/DART.php';
$today = date('Y-m-d');
$dart = new DART();
$dart->record_ChangesForTheDay($today);
$result = $dart->get_mydart($_REQUEST['sdate'],$_REQUEST['edate']);
ob_end_clean();
?>
<table cellpadding=0 align="center" cellspacing=1 style="font: 12px Arial, sans-serif; background: #DDDDFF;">
	<tr align="center">
		<td width="120px" style="background: #FFFFFF; border: 1px solid #DDDDFF; border-right: 0; padding: 5px;"><strong>
<?php
echo getTranslatedString('LBL_DATE',$currentModule);
?>
</strong></td>		
		<td width="120px" style="background: #FFFFFF; border: 1px solid #DDDDFF; padding: 1px;"><strong>
<?php
echo getTranslatedString('LBL_MODULES',$currentModule);
?>
</strong></td>
		<td width="120px" style="background: #FFFFFF; border: 1px solid #DDDDFF; padding: 1px;"><strong>
<?php
echo getTranslatedString('LBL_ADD_NUM',$currentModule);
?>
</strong></td>
		<td width="120px"  style="background: #FFFFFF; border: 1px solid #DDDDFF; padding: 1px;"><strong>	
<?php
echo getTranslatedString('LBL_EDIT_NUM',$currentModule);
?>
</strong></td>
	</tr>
<?php
foreach($result as $date => $GROUP){
?>
	<tr valign="middle" align="center">
    <td width="120px" nowrap="nowrap" style="background: #FFFFFF;border:1px solid #DDDDFF;border-right:0;padding:2 5px;"><strong>
    <?php
    echo $date;
    ?>
    <strong></td>
    <td width="360px" colspan="3" style="background: #FFFFFF;" >
        <table width="100%" cellpadding=1 cellspacing=1 border=0 style="font: inherit; background: #DDDDFF;">
	<?php
	foreach($GROUP as $MODULE => $RECORDS){
	?>
        <tr valign="middle" align="center">
            <td width="120px" nowrap="nowrap" style="background: #FFFFFF;">
          <?php
			echo getTranslatedString($MODULE,$MODULE);
		   ?></td>
            <td width="120px" style="background: #FFFFFF;">
            <?php		echo $RECORDS['add'];?>
            </td>
            <td width="120px" style="background: #FFFFFF;">
            <?php		echo $RECORDS['edit'];?>            
            </td>
			</tr>
	<?php
    }
    ?>	
				</table>
			</td>
		</tr>	
<?php
}
?>	
</table>
<?php
exit;
?>