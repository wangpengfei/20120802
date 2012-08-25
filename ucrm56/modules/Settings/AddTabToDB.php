<?php
/*********************/
/*                   */
/*  Version : 5.1.0  */
/*  Author  : RM     */
/*  Comment : 071223 */
/*                   */
/*********************/
set_time_limit( 0 );
global $adb;
global $current_language;
$id = $_REQUEST['id'];
$parenttab_label = $_REQUEST['parenttab_label'];
$parenttab_label_cn = $_REQUEST['parenttab_label_cn'];
$sequence = $_REQUEST['sequence'];
$mode = $_REQUEST['mode'];
if ( !empty( $id ) )
{
				$query = "update vtiger_parenttab set parenttab_label='".$parenttab_label."',sequence='".$sequence."' where parenttabid='".$id."'";
				$adb->query( $query );
}
else
{
				$query = "select max(parenttabid) as parenttabid from vtiger_parenttab";
				$result = $adb->query( $query );
				$id = $adb->query_result( $result, 0, "parenttabid" ) + 1;
				$query = "insert into vtiger_parenttab(parenttabid,parenttab_label,sequence,visible) values ('".$id."','".$parenttab_label."','".$sequence."','0')";
				$adb->query( $query );
}
//$language_file_path = $root_directory."cache/application/language/".$current_language.".lang.php";
$language_file_path = $root_directory."include/language/cache.lang.php";
if ( !is_file( $language_file_path ) )
{
		touch( $language_file_path );
}
if ( is_writable( $language_file_path ) )
{
	$custom_app_strings = return_custom_application_language( $current_language );
	$custom_applist_strings = return_custom_app_list_strings_language( $current_language );
				
		if ( !is_array( $custom_app_strings ) && 0 < count( $custom_app_strings ) || is_array( $custom_applist_strings ) && 0 < count( $custom_applist_strings ) )
				{
								$bk = chr( 10 );
								$qo = "  ";
								$string = "";
								$fd = fopen( $language_file_path, "w" );
								fwrite( $fd, "<?php".$bk );
								if ( is_array( $custom_app_strings ) && 0 < count( $custom_app_strings ) )
								{
												unset( $custom_app_strings[$parenttab_label] );
												foreach ( $custom_app_strings as $key1 => $arr )
												{
																$string .= $qo."\$app_strings['".$key1."'] = '".$arr."';".$bk;
												}
								}
								$string .= $qo."\$app_strings['".$parenttab_label."'] = '".$parenttab_label_cn."';".$bk;
								if ( is_array( $custom_applist_strings ) && 0 < count( $custom_applist_strings ) )
								{
												foreach ( $custom_applist_strings['moduleList'] as $key1 => $arr )
												{
																$string .= $qo."\$app_list_strings['moduleList']['".$key1."'] = '".$arr."';".$bk;
												}
								}
								fwrite( $fd, $string );
								fwrite( $fd, $bk."?>" );
								fclose( $fd );
				}
				else
				{
								/*$bk = chr( 10 );
								$qo = "  ";
								$string = "";
								$fd = fopen( $language_file_path, "w" );
								fwrite( $fd, "<?php".$bk );
								$string .= $qo."\$app_strings['".$parenttab_label."'] = '".$parenttab_label_cn."';".$bk;
								fwrite( $fd, $string );
								fwrite( $fd, $bk."?>" );
								fclose( $fd );*/
							$bk = chr( 10 );
                            $qo = "  ";
                        	$fdr = fopen( $language_file_path, "r" );
                            while (!feof ($fdr)) {
                                    $buf = fgets($fdr, 4096);
                        			if(strpos($buf,$parenttab_label) || strpos($buf,'?>') !== false){
                        				continue;
                        			}else{
                        				$str .= $buf;
                        			}
                            }
                        	fclose( $fdr );
                        	$str .= $qo."\$app_strings['".$parenttab_label."'] = '".$parenttab_label_cn."';";
                        	$fd = fopen( $language_file_path, "w" );
                        	fwrite( $fd, $str );
                        	fwrite( $fd, $bk."?>" );
                        	fclose( $fd );
				}
}
$display_tabs = array( );
$tabs_def = urldecode( $_REQUEST['display_tabs_def'] );
$DISPLAY_ARR = array( );
parse_str( $tabs_def, &$DISPLAY_ARR );
$display_tabs = $DISPLAY_ARR['display_tabs'];
if ( is_array( $display_tabs ) && 0 < count( $display_tabs ) )
{
	$count = 0;
	$query = "delete from vtiger_parenttabrel where parenttabid='".$id."'";
	$adb->query( $query );
	foreach ( $display_tabs as $tabid )
	{
		++$count;
		$query = "insert into vtiger_parenttabrel(parenttabid,tabid,sequence) values('".$id."','".$tabid."','".$count."')";
		$adb->query( $query );
	}
}
else
{
	$query = "delete from vtiger_parenttabrel where parenttabid='".$id."'";
	$adb->query( $query );
}

require_once("modules/Settings/CreateMenuFile.php");
//header("Location:index.php?module=Settings&action=CustomFieldList&fld_module=".$fldmodule."&parenttab=".$parenttab);
$url = "index.php?module=Settings&action=CustomTabList&parenttab=Settings";
header("Location:index.php?module=Settings&action=CustomTabList&parenttab=Settings");

?>
