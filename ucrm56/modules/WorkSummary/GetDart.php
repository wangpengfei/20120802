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
	<tr>
		<td style="background: #FFFFFF; border: 1px solid #DDDDFF; border-right: 0; padding: 5px;"><strong>
<?php
echo getTranslatedString('LBL_DATE',$currentModule);
?>
</strong></td>		
		<td style="background: #FFFFFF; border: 1px solid #DDDDFF; padding: 1px;">
			<table width="100%" cellpadding=0 cellspacing=0 border=0 style="font: inherit; background: #DDDDFF;">
				<tr valign=top>
					<td width="120px" nowrap="nowrap" style="background: #FFFFFF;"><strong>
<?php
echo getTranslatedString('LBL_MODULES',$currentModule);
?></strong></td>
					<td style="background: #FFFFFF;"><strong>
<?php
echo getTranslatedString('LBL_ACTION_PERFORMED',$currentModule);
?></strong>&nbsp;&nbsp;&nbsp;
<td width="15px" bgcolor="#FFFFFF" id='dart_tdimg'>
</td>
</td>	
				</tr>	
		       </table>
		</td>		
	</tr>
<?php
foreach($result as $date => $GROUP){
?>
	<tr valign=top>
    <td width="120px" nowrap="nowrap" style="background: #FFFFFF;border:1px solid #DDDDFF;border-right:0;padding:0 5px;"><strong>
    <?php
    echo $date;
    ?>
    <strong></td>
    <td style="background: #FFFFFF;" >
        <table width="100%" cellpadding=1 cellspacing=1 border=0 style="font: inherit; background: #DDDDFF;">
	<?php
	foreach($GROUP as $MODULE => $RECORDS){
	?>
        <tr valign=top>
            <td width="120px" nowrap="nowrap" style="background: #FFFFFF;">
          <?php
			echo getTranslatedString($MODULE,$MODULE).'(<font color=red>'.count($RECORDS).'</font>)';
		   ?></td>
						<td style="background: #FFFFFF;">
							<table cellpadding=3 cellspacing=0 border=0 style="font: inherit;">
				<?php
				foreach($RECORDS as $RECORD){
				?>			
							<tr valign=top>
								<td>
									<small>
                 	<?php
					echo getTranslatedString($RECORD['changetype'],'DART');
					echo "</small>: <a href='index.php?module=$RECORD[module]&action=DetailView&record=$RECORD[id]'>$RECORD[title]</a>";
					?>
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
			</td>
		</tr>	
<?php
}
?>	
</table>
<?php
exit;
?>