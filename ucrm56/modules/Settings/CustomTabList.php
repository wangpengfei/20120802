<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function getTabListEntries( )
{
				global $adb;
				global $theme;
				global $app_strings;
				global $mod_strings;
				$theme_path = "themes/".$theme."/";
				$image_path = $theme_path."images/";
				$count = 1;
				$modulelist = array( );
				$query = "select * from vtiger_parenttab order by sequence";
				$result = $adb->query( $query );
				$row = $adb->fetch_array( $result );
				if ( $row != "" )
				{
								do
								{
												$cf_element = array( );
												$cf_element['no'] = $count;
												if ( isset( $app_strings[$row['parenttab_label']] ) )
												{
																$cf_element['parenttab_label'] = $app_strings[$row['parenttab_label']];
												}
												else
												{
																$cf_element['parenttab_label'] = $row['parenttab_label'];
												}
												$cf_element['sequence'] = $row['sequence'];
												if ( $row['parenttab_label'] != "Settings" )
												{
																$cf_element['tool'] = "<a href=\"index.php?module=Settings&action=CreateTab&id=".$row['parenttabid']."&parenttab=Settings\" >".$mod_strings['Edit']."</a>&nbsp;|&nbsp;<a href=\"#\" onClick=\"deleteTab(".$row['parenttabid'].")\">".$mod_strings['Delete']."</a>";
												}
												else
												{
																$cf_element['tool'] = "<a href=\"index.php?module=Settings&action=CreateTab&id=".$row['parenttabid']."&parenttab=Settings\" >".$mod_strings['Edit']."</a>";
												}
												$modulelist[] = $cf_element;
												++$count;
								} while ( $row = $adb->fetch_array( $result ) );
				}
				return $modulelist;
}

require_once( "Smarty_setup.php" );
require_once( "include/database/PearDatabase.php" );
global $mod_strings;
global $app_strings;
global $adb;
$smarty = new vtigerCRM_Smarty( );
$smarty->assign( "MOD", $mod_strings );
$smarty->assign( "APP", $app_strings );
global $theme;
$theme_path = "themes/".$theme."/";
$image_path = $theme_path."images/";
require_once( $theme_path."layout_utils.php" );
$smarty->assign( "IMAGE_PATH", $image_path );
$custommtablist = getTabListEntries( );
$smarty->assign( "TABENTRIES", $custommtablist );
if ( $_REQUEST['mode'] != "" )
{
				$mode = $_REQUEST['mode'];
}
$smarty->assign( "MODE", $mode );
$smarty->display( "Settings/CustomTabList.tpl" );
?>
