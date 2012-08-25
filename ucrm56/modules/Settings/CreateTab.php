<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/

function getParentTabs( )
{
				global $adb;
				global $app_strings;
				$dbQuery = " SELECT parenttabid,parenttab_label FROM vtiger_parenttab order by parenttabid";
				$result = $adb->query( $dbQuery );
				$row = $adb->fetch_array( $result );
				$parenttab_list = array( );
				if ( $row != "" )
				{
								do
								{
												if ( isset( $app_strings[$row['parenttab_label']] ) )
												{
																$parenttab_list[$row['parenttabid']] = $app_strings[$row['parenttab_label']];
												}
												else
												{
																$parenttab_list[$row['parenttabid']] = $row['parenttab_label'];
												}
								} while ( $row = $adb->fetch_array( $result ) );
				}
				return $parenttab_list;
}

require_once( "Smarty_setup.php" );
require_once( "include/tabgroup/TemplateGroupChooser.php" );
global $mod_strings;
global $app_strings;
global $app_list_strings;
global $theme;
global $adb;
$theme_path = "themes/".$theme."/";
$image_path = $theme_path."images/";
require_once( $theme_path."layout_utils.php" );
$id = "";
$parenttab_label_cn = "";
$displayed_modules = array( );
$system_modules = array( );
if ( isset( $_REQUEST['id'] ) )
{
				$id = $_REQUEST['id'];
				$query = "select * from vtiger_parenttab where parenttabid='".$id."'";
				$result = $adb->query( $query );
				$row = $adb->fetch_array( $result );
				if ( $row )
				{
								if ( isset( $app_strings[$row['parenttab_label']] ) )
								{
												$parenttab_label_cn = $app_strings[$row['parenttab_label']];
								}
								else
								{
												$parenttab_label_cn = $row['parenttab_label'];
								}
								$parenttab_label = $row['parenttab_label'];
								$sequence = $row['sequence'];
				}
				$query = "select vtiger_parenttabrel.tabid,vtiger_tab.name from vtiger_parenttab left join vtiger_parenttabrel on vtiger_parenttabrel.parenttabid=vtiger_parenttab.parenttabid left join vtiger_tab on vtiger_tab.tabid=vtiger_parenttabrel.tabid where vtiger_parenttab.parenttabid='".$id."' order by vtiger_parenttabrel.sequence";
				$result = $adb->query( $query );
				while ( $row = $adb->fetch_array( $result ) )
				{
								if ( isset( $app_strings[$row['name']] ) )
								{
												$displayed_modules[$row['tabid']] = $app_strings[$row['name']];
								}
								else
								{
												$displayed_modules[$row['tabid']] = $row['name'];
								}
				}
}
else
{
				$parenttab_label = "";
				$sequence = "";
}
//$query = "select tabid,name from vtiger_tab where tabid not in(1,7,24,27,29) order by tabsequence";
$query = "select tabid,name from vtiger_tab where tabid not in(29,51) order by tabsequence";
$result = $adb->query( $query );
while ( $row = $adb->fetch_array( $result ) )
{
				if ( isset( $app_strings[$row['name']] ) )
				{
								$system_modules[$row['tabid']] = $app_strings[$row['name']];
				}
				else
				{
								$system_modules[$row['tabid']] = $row['name'];
				}
}
$system_modules = array_diff( $system_modules, $displayed_modules );
$smarty = new vtigerCRM_Smarty( );
$smarty->assign( "MOD", $mod_strings );
$smarty->assign( "APP", $app_strings );
global $theme;
$theme_path = "themes/".$theme."/";
$image_path = $theme_path."images/";
require_once( $theme_path."layout_utils.php" );
$smarty->assign( "IMAGE_PATH", $image_path );
$parentTabArr = getParentTabs( );
$output .= "\n\t<form action=\"index.php\" method=\"post\" name=\"addtodb\" onSubmit=\"return validate_tab()\">\n\t  <input type=\"hidden\" name=\"module\" value=\"Settings\">\n      <input type=\"hidden\" name=\"action\" value=\"AddTabToDB\">\n\t  <input type=\"hidden\" name=\"id\" value=\"".$id."\">\n\t  <input type=\"hidden\" name=\"mode\" value=\"".$mode."\">\n\t  <input type=\"hidden\" name=\"display_tabs_def\">\n\t\t<table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\" class=\"layerHeadingULine\">\n\t\t\t<tr>";
$output .= "<table width=\"30%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\" class=\"small\"><tr>\n\t\t\t\t\t<td width=\"50%\" class=\"dataLabel\" nowrap=\"nowrap\" align=\"right\"><b>".$mod_strings['PARENT_TAB_EN']."</b></td>\n\t\t\t\t\t<td width=\"50%\" class=\"dvtCellInfo\" align=\"left\"><input type=\"text\" size=20 name=\"parenttab_label\" value=\"".$parenttab_label."\" class=\"txtBox\"></td>\n\t\t\t\t</tr>\n\t\t\t\t<tr>\n\t\t\t\t\t<td width=\"50%\" class=\"dataLabel\" nowrap=\"nowrap\" align=\"right\"><b>".$mod_strings['PARENT_TAB_CN']."</b></td>\n\t\t\t\t\t<td width=\"50%\" class=\"dvtCellInfo\" align=\"left\"><input type=\"text\" size=20 name=\"parenttab_label_cn\" value=\"".$parenttab_label_cn."\" class=\"txtBox\"></td>\n\t\t\t\t</tr>\n\t\t\t\t<tr>\n\t\t\t\t\t<td class=\"dataLabel\" nowrap=\"nowrap\" align=\"right\"><b>".$mod_strings['MODULE_ORDER']."</b></td>\n\t\t\t\t\t<td class=\"dvtCellInfo\" align=\"left\"><input type=\"text\" size=5 name=\"sequence\" value=\"".$sequence."\" class=\"txtBox\"></td>\n\t\t\t\t</tr></table>";
$output .= "<table width=\"100%\" border=\"0\" cellpadding=\"5\" cellspacing=\"0\" class=\"small\"><tr><td>";
$chooser = new TemplateGroupChooser( );
$chooser->args['id'] = "edit_tabs";

$chooser->args['values_array'][0] = $displayed_modules;
$chooser->args['values_array'][1] = $system_modules;
$chooser->args['left_name'] = "display_tabs";
$chooser->args['right_name'] = "hide_tabs";
$chooser->args['left_label'] = $mod_strings['LBL_DISPLAY_TABS'];
$chooser->args['right_label'] = $mod_strings['LBL_HIDE_TABS'];
$chooser->args['title'] = $mod_strings['LBL_EDIT_TABS'];
$output .= $chooser->display();
$output .= "</td></tr></table>\t\t\t\t\n\t<table border=0 cellspacing=0 cellpadding=5 width=100% class=\"layerPopupTransport\">\n\t\t\t<tr>\n\t\t\t\t<td align=\"left\">\n\t\t\t\t\t<input type=\"submit\" name=\"save\" onClick=\"return set_chooser();\" value=\" &nbsp; ".$app_strings['LBL_SAVE_BUTTON_LABEL']." &nbsp; \" class=\"crmButton small save\" />&nbsp;\n\t\t\t\t\t<input type=\"button\" name=\"cancel\" value=\" ".$app_strings['LBL_CANCEL_BUTTON_LABEL']." \" class=\"crmButton small cancel\" onclick=\"javascript:document.location.href='index.php?module=Settings&action=CustomTabList&parenttab=Settings';\" />\n\t\t\t\t</td>\n\t\t\t</tr>\n\t</table>\n\t</form></div>";

$smarty->assign( "OUTPUT", $output );
$smarty->display( "Settings/CreateTab.tpl" );
?>
