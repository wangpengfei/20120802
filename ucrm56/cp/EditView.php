<script>
var gVTModule = '<?php echo $_REQUEST['module'];?>';
</script>
<script language="JavaScript" type="text/javascript" src="../include/js/general.js"></script>
	<!-- vtlib customization: Javascript hook -->	
	<script language="JavaScript" type="text/javascript" src="../include/js/vtlib.js"></script>
	<!-- END -->
	<script language="JavaScript" type="text/javascript" src="../include/js/zh_cn.lang.js?"></script>
	<script language="javascript" type="text/javascript" src="../include/scriptaculous/prototype.js"></script>
	<script language="JavaScript" type="text/javascript" src="../include/calculator/calc.js"></script>
	<script language="JavaScript" type="text/javascript" src="../modules/Calendar/script.js"></script>
	<script language="javascript" type="text/javascript" src="../include/scriptaculous/dom-drag.js"></script>
	<script language="JavaScript" type="text/javascript" src="../include/js/notificationPopup.js"></script>
	<link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" media="all" href="../jscalendar/calendar-win2k-cold-1.css">
        <script type="text/javascript" src="../jscalendar/calendar.js"></script>
        <script type="text/javascript" src="../jscalendar/calendar-setup.js"></script>
        <script type="text/javascript" src="../jscalendar/lang/calendar-zh.js"></script>
<?php
/*********************************************************************************
 ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *
 ********************************************************************************/
/* 
ob_start();
echo '<iframe height="550" width="1345" display="none" src="http://localhost/CRM/ucrm531/index.php?module=Performance&action=EditView&record=644" ></iframe>';
$fc = ob_get_contents();
ob_end_clean();
echo $fc;exit;*/
/*$f=fopen('aa.txt','a');
fwrite($f,$fc);
fclose($f);*/
include("include.php");
include("version.php");
require_once("PortalConfig.php");
require_once("include/utils/utils.php");

global $version,$default_language,$result;
global $app_strings, $mod_strings, $current_language, $currentModule, $theme;

session_start();
setPortalCurrentLanguage();
$default_language = getPortalCurrentLanguage();
require_once("language/".$default_language.".lang.php");

$params = array(array('module' => $_REQUEST['module'],
	'id'=>$_REQUEST['id'],
	'customer_account_id'=>$_SESSION['customer_account_id']));

$result = $client->call('get_edit', $params, $Server_Path, $Server_Path);
$array_data = json_decode($result,1);
$BLOCKS = $array_data['data'];
$validationArray = $array_data['validationArray'];

?>

<script>
        var fieldname = new Array(<?php echo $validationArray['fieldname'];?>);
        var fieldlabel = new Array(<?php echo $validationArray['fieldlabel'];?>);
        var fielddatatype = new Array(<?php echo $validationArray['datatype'];?>);
		var userDateFormat = "yyyy-mm-dd" ;
</script>
<?php
echo '<table><tr><td><input class="crmbutton small cancel" type="button" value="'.getTranslatedString('LBL_BACK_BUTTON').'" onclick="window.history.back();"/></td></tr></table>';
echo '<br>';
echo '<table border=0 cellspacing=0 cellpadding=0 width=100% >';
echo '<form name="EditView" onsubmit="VtigerJS_DialogBox.block();" action="Save.php"  method="post" encType="multipart/form-data">';
echo '<input name="module" id="module" type="hidden" value="'.$_REQUEST['module'].'"/>
		<input name="customer_account_id" id="customer_account_id" type="hidden" value="'.$_SESSION['customer_account_id'].'"/>
	  <input name="recordid" id="recordid" type="hidden" value="'.$_REQUEST['id'].'"/>';
foreach($BLOCKS as $header => $data){
	echo "<tr><td colspan=4 class=\"detailedViewHeader\">{$header}</td>
			</tr><tr><td>&nbsp;</td></tr>";
	foreach($data as $label => $subdata){
		echo '<tr>';
		foreach($subdata as $mainlabel => $maindata){
			$uitype = $maindata[0][0];
			$fldlabel = $maindata[1][0];
			$fldlabel_sel = $maindata[1][1];
			$fldlabel_combo = $maindata[1][2];
			$fldlabel_other = $maindata[1][3];
			$fldname = $maindata[2][0];
			$fldvalue = $maindata[3][0];
			$secondvalue = $maindata[3][1];
			$thirdvalue = $maindata[3][2];
			$typeofdata = $maindata[4]; 
			$vt_tab = $maindata[5][0];
			                    
			if ($typeofdata == 'M')
				$mandatory_field = "*";
			else
				$mandatory_field = "";
	
			$usefldlabel = $fldlabel;
			
			
			if ($uitype == '10'){
				echo	"<td width=20% class=\"dvtCellLabel\" align=right>
					<font color=\"red\">{$mandatory_field}</font>";
				echo	$fldlabel[displaylabel] ;
					if (count($fldlabel['options']) == 1){
						$use_parentmodule = $fldlabel['options'][0];
						echo	"<input type='hidden' class='small' name=\"{$fldname}_type\" value=\"{$use_parentmodule}\">";
						echo $app[$use_parentmodule];
					}else{
						echo "<br>
					<select id=\"{$fldname}_type\" name=\"{$fldname}_type\" onChange='document.EditView.{$fldname}_display.value=\"\"; document.EditView.{$fldname}.value=\"\";$(\"qcform\").innerHTML=\"\"'>";
						foreach($fldlabel['options'] as $option){
								echo "<option value=\"{$option}\" ";
								if ($fldlabel['selected'] == $option){
									echo 'selected';
								}
								echo '>';
								echo getTranslatedString($option);
								echo '</option>'; 
						}
						echo '</select>';
					}
					echo "</td>
					<td width=\"30%\" align=left class=\"dvtCellInfo\">
						<input id=\"{$fldname}\" name=\"{$fldname}\" type=\"hidden\" value=\"$fldvalue[entityid]\" id=\"$fldname\">
						<input id=\"{$fldname}_display\" name=\"{$fldname}_display\" id=\"edit_{$fldname}_display\" readonly type=\"text\" style=\"border:1px solid #bababa;\" value=\"{$fldvalue[displayvalue]}\">&nbsp;
						&nbsp;
					</td>";
			}
			
			
			if ($uitype == 2){
				echo "<td width=20% class=\"dvtCellLabel\" align=right>
					<font color=\"red\">
					$mandatory_field
					</font>
					$usefldlabel
				</td>
				<td width=30% align=left class=\"dvtCellInfo\">
		<input type=\"text\" name=\"{$fldname}\" tabindex=\"{$vt_tab}\" value=\"{$fldvalue}\" tabindex=\"{$vt_tab}\" class=detailedViewTextBox onFocus=\"this.className='detailedViewTextBoxOn'\" onBlur=\"this.className='detailedViewTextBox'\">
				</td>";
			}
			elseif ($uitype == 3 || $uitype == 4){
				echo "
					<td width=20% class=\"dvtCellLabel\" align=right><font color=\"red\">{$mandatory_field}</font>{$usefldlabel} </td>
									<td width=30% align=left class=\"dvtCellInfo\">
				<input readonly type=\"text\" tabindex=\"{$vt_tab}\" name=\"{$fldname}\" id =\"{$fldname}\" value=\"{$fldvalue}\" class=detailedViewTextBox onFocus=\"this.className='detailedViewTextBoxOn'\" onBlur=\"this.className='detailedViewTextBox'\"></td>";
			}elseif ($uitype == 11 || $uitype == 1 || $uitype == 13 || $uitype == 7 || $uitype == 9){
				echo	"<td width=20% class=\"dvtCellLabel\" align=right><font color=\"red\">{$mandatory_field}</font>{$usefldlabel}</td>";
				if ($fldname == 'tickersymbol' && $module == 'Accounts'){
						echo	"<td width=30% align=left class=\"dvtCellInfo\">
								<input type=\"text\" name=\"{$fldname}\" tabindex=\"{$vt_tab}\" id =\"{$fldname}\" value=\"{$fldvalue}\" class=detailedViewTextBox onFocus=\"this.className='detailedViewTextBoxOn';\" onBlur=\"this.className='detailedViewTextBox';sensex_info();\">
								<span id=\"vtbusy_info\" style=\"display:none;\">
									<img src=\"../themes/woodspice/images/vtbusy.gif\" border=\"0\"></span>
							</td>";
				}else{
						echo	"<td width=30% align=left class=\"dvtCellInfo\"><input type=\"text\" tabindex=\"{$vt_tab}\" name=\"{$fldname}\" id =\"{$fldname}\" value=\"{$fldvalue}\" class=detailedViewTextBox onFocus=\"this.className='detailedViewTextBoxOn'\" onBlur=\"this.className='detailedViewTextBox'\"></td>";
				}
			}
			elseif ($uitype == 19 || $uitype == 20){
				echo	"<td width=20% class=\"dvtCellLabel\" align=right>
							<font color=\"red\">{$mandatory_field}</font> 
						{$usefldlabel} 
					</td>
					<td colspan=3>
						<textarea class=\"detailedViewTextBox\" tabindex=\"{$vt_tab}\" onFocus=\"this.className='detailedViewTextBoxOn'\" name=\"{$fldname}\"  onBlur=\"this.className='detailedViewTextBox'\" cols=\"90\" rows=\"8\">{$fldvalue}</textarea>
					</td>";
			}elseif ($uitype == 21 || $uitype == 24){
				echo "<td width=20% class=\"dvtCellLabel\" align=right>
								<font color=\"red\">{$mandatory_field}</font>
							{$usefldlabel}
						</td>
						<td width=30% align=left class=\"dvtCellInfo\">
							<textarea value=\"{$fldvalue}\" name=\"{$fldname}\" tabindex=\"{$vt_tab}\" class=detailedViewTextBox onFocus=\"this.className='detailedViewTextBoxOn'\" onBlur=\"this.className='detailedViewTextBox'\" rows=5>{$fldvalue}</textarea>
						</td>";
			}elseif ($uitype == 15 || $uitype == 16){
				echo	"<td width=\"20%\" class=\"dvtCellLabel\" align=right>
						<font color=\"red\">{$mandatory_field}</font>
						{$usefldlabel} 
					</td>
					<td width=\"30%\" align=left class=\"dvtCellInfo\">
							<select name=\"{$fldname}\" tabindex=\"{$vt_tab}\" >";
				if(is_array($fldvalue)){
					foreach($fldvalue as $arr){
						if ($arr[0] == $APP['LBL_NOT_ACCESSIBLE']){
							echo "<option value=\"$arr[0]\" $arr[2]>
							$arr[0]
						</option>";
						}else{
							echo "<option value=\"$arr[1]\" $arr[2]>
													$arr[0]
											</option>";
						}
					 }
				}else{
					   echo "<option value=\"\"></option>
						<option value=\"\" style='color: #777777' disabled>";
					   echo $APP['LBL_NONE'];
					   echo '</option>';
				}
				   echo '</select>
							</td>';
			}elseif ($uitype == 33){
				echo "<td width=\"20%\" class=\"dvtCellLabel\" align=right>
							<font color=\"red\">{$mandatory_field}</font>{$usefldlabel} 
						</td>
						<td width=\"30%\" align=left class=\"dvtCellInfo\">
						   <select MULTIPLE name=\"{$fldname}[]\" size=\"4\" style=\"width:160px;\" tabindex=\"{$vt_tab}\" >";
							foreach($fldvalue as $arr){
								echo "<option value=\"{$arr[1]}\" {$arr[2]}>
															{$arr[0]}
													</option>";
							}
						  echo '</select>
						</td>';
			}elseif($uitype == 53){
				echo "<td width=\"20%\" class=\"dvtCellLabel\" align=right>
						<font color=\"red\">{$mandatory_field}</font>{$usefldlabel} 
					</td>
					<td width=\"30%\" align=left class=\"dvtCellInfo\">";
						echo "<span id=\"assign_user\" style=\"{$style_user}\">";
								foreach($fldvalue as $key_one =>$arr){
									foreach($arr as $sel_value =>$value){
										if($value == 'selected'){
                                        	echo "<input id=\"assigned_user_id\" name=\"assigned_user_id\"  type=\"hidden\" value=\"$key_one\"><input id=\"$key_one\" name=\"$key_one\" readonly type=\"text\" style=\"border:1px solid #bababa;\" class=detailedViewTextBox  value=\"$sel_value\">";
                                        }
									}
								}
						echo "</span>";
		
					echo "</td>";
				/*
				echo "<td width=\"20%\" class=\"dvtCellLabel\" align=right>
						<font color=\"red\">{$mandatory_field}</font>{$usefldlabel} 
					</td>
					<td width=\"30%\" align=left class=\"dvtCellInfo\">";
						$check = 1;
						foreach($fldvalue as $key_one =>$arr){
							foreach($arr as $sel_value =>$value){
								if($value == '')
									$check = $check*0;
								else
									$check = $check*1;
							}
						}
		
						if($check == 0){
							$select_user = 'checked';
							$style_user = 'display:block';
							$style_group = 'display:none';
						}else{
							$select_group = 'checked';
							$style_user = 'display:none';
							$style_group = 'display:block';
						}
		
						echo "<input type=\"radio\" tabindex=\"{$vt_tab}\" name=\"assigntype\" {$select_user} value=\"U\" onclick=\"toggleAssignType(this.value)\" >&nbsp;	";		
						echo $APP['LBL_USER'];
		
						if($secondvalue != ''){
							echo "<input type=\"radio\" name=\"assigntype\" {$select_group} value=\"T\" onclick=\"toggleAssignType(this.value)\">&nbsp;";
							echo $APP['LBL_GROUP'];
						}
						
						echo "<span id=\"assign_user\" style=\"{$style_user}\">
							<select name=\"{$fldname}\" >";
								foreach($fldvalue as $key_one =>$arr){
									foreach($arr as $sel_value =>$value){
										echo "<option value=\"{$key_one}\" {$value}>{$sel_value}</option>";
									}
								}
						echo "</select>
						</span>";
		
						if($secondvalue != ''){
							echo "<span id=\"assign_team\" style=\"{$style_group}\">
								<select name=\"assigned_group_id\" >";
									foreach($secondvalue as $key_one =>$arr){
										foreach($arr as $sel_value =>$value){
											echo "<option value=\"{$key_one}\" {$value}>{$sel_value}</option>";
										}
									 }
							echo "</select>
							</span>";
						}
					echo "</td>";*/
			}elseif(($uitype == 23 || $uitype == 5 || $uitype == 6) && $fldname != 'support_start_date' && $fldname != 'support_end_date'){
				echo "<td width=\"20%\" class=\"dvtCellLabel\" align=right>
							<font color=\"red\">{$mandatory_field}</font>{$usefldlabel}
						</td>
						<td width=\"30%\" align=left class=\"dvtCellInfo\">";
							foreach($fldvalue as $date_value => $time_value ){
								$date_val = $date_value;
								$time_val = $time_value;
							}
				echo "<input name=\"{$fldname}\" tabindex=\"{$vt_tab}\" id=\"jscal_field_{$fldname}\" type=\"text\" style=\"border:1px solid #bababa;\" size=\"11\" maxlength=\"10\" value=\"{$date_val}\">
							<img src=\"../themes/woodspice/images/btnL3Calendar.gif\" id=\"jscal_trigger_{$fldname}\">";
							if ($uitype == 6){
								echo "<input name=\"time_start\" tabindex=\"{$vt_tab}\" style=\"border:1px solid #bababa;\" size=\"5\" maxlength=\"5\" type=\"text\" value=\"{$time_val}\">";
							}
							
							foreach($secondvalue as $date_format => $date_str ){
								$dateFormat = $date_format;
								$dateStr = $date_str;
							}
			
							if ($uitype == 5 || $uitype == 23){
								echo "<br><font size=1><em old=\"(yyyy-mm-dd)\">({$dateStr})</em></font>";
							}else{
								echo "<br><font size=1><em old=\"(yyyy-mm-dd)\">({$dateStr})</em></font>";
							}
			
							echo "<script type=\"text/javascript\" id='massedit_calendar_{$fldname}'>
								Calendar.setup ({
									inputField : \"jscal_field_{$fldname}\", ifFormat : \"{$dateFormat}\", showsTime : false, button : \"jscal_trigger_{$fldname}\", singleClick : true, step : 1
								})
							</script>
						</td>";
			}elseif ($uitype == 71 || $uitype == 72){
					echo	"<td width=\"20%\" class=\"dvtCellLabel\" align=right>
							<font color=\"red\">{$mandatory_field}</font>{$usefldlabel} 
						</td>
						<td width=\"30%\" align=left class=\"dvtCellInfo\">				
							<input name=\"{$fldname}\" tabindex=\"{$vt_tab}\" type=\"text\" class=detailedViewTextBox onFocus=\"this.className='detailedViewTextBoxOn'\" onBlur=\"this.className='detailedViewTextBox'\"  value=\"{$fldvalue}\">
						</td>";
			}elseif($uitype == 17){
				echo "<td width=\"20%\" class=\"dvtCellLabel\" align=right>
						<font color=\"red\">{$mandatory_field}</font>{$usefldlabel}
					</td>
					<td width=\"30%\" align=left class=\"dvtCellInfo\">
						&nbsp;&nbsp;http://
					<input style=\"width:74%;\" class = 'detailedViewTextBox' type=\"text\" tabindex=\"{$vt_tab}\" name=\"{$fldname}\" style=\"border:1px solid #bababa;\" size=\"27\" onFocus=\"this.className='detailedViewTextBoxOn'\"onBlur=\"this.className='detailedViewTextBox'\" onkeyup=\"validateUrl('{$fldname}');\" value=\"{$fldvalue}\">
					</td>";
			}elseif ($uitype == 55 || $uitype == 255){
				echo "<td width=\"20%\" class=\"dvtCellLabel\" align=right>";
				if ($uitype == 55){
					echo $usefldlabel;
				}elseif ($uitype == 255){
					echo "<font color=\"red\">{$mandatory_field}</font>{$usefldlabel}";
				}
				echo "</td>
				<td width=\"30%\" align=left class=\"dvtCellInfo\">";
				if ($fldvalue != ''){
					echo "<select name=\"salutationtype\">";
					foreach($fldvalue as $arr){
						echo "<option value=\"{$arr[1]}\" {$arr[2]}>
						{$arr[0]}
						</option>";
					}
					echo "</select>";
				}
				echo "<input type=\"text\" name=\"{$fldname}\" tabindex=\"{$vt_tab}\" class=detailedViewTextBox onFocus=\"this.className='detailedViewTextBoxOn'\" onBlur=\"this.className='detailedViewTextBox'\" style=\"width:58%;\" value= \"{$secondvalue}\" >
				</td>";
			}elseif ($uitype == 51){
				echo "<td width=\"20%\" class=\"dvtCellLabel\" align=right>
					<font color=\"red\">{$mandatory_field}</font>{$usefldlabel} 
				</td>
				<td width=\"30%\" align=left class=\"dvtCellInfo\">
					<input readonly name=\"account_name\" style=\"border:1px solid #bababa;\" type=\"text\" value=\"{$fldvalue}\"><input name=\"{$fldname}\" type=\"hidden\" value=\"{$secondvalue}\">&nbsp;
				</td>";
			}elseif ($uitype == 28){
				echo "<td width=\"20%\" class=\"dvtCellLabel\" align=right>
					<font color=\"red\">{$mandatory_field}</font>{$usefldlabel}
				</td>
			
				<td colspan=\"1\" width=\"30%\" align=\"left\" class=\"dvtCellInfo\">
				<script type=\"text/javascript\">
					function changeDldType(type, onInit){
						var fieldname = '{$fldname}';
						if(!onInit){
							var dh = getObj('{$fldname}_hidden');
							if(dh) dh.value = '';
						}
						
						var v1 = document.getElementById(fieldname+'_E__');
						var v2 = document.getElementById(fieldname+'_I__');
						
						var text = v1.type ==\"text\"? v1: v2;
						var file = v1.type ==\"file\"? v1: v2;
						var filename = document.getElementById(fieldname+'_value');
						if(type == 'file'){
							// Avoid sending two form parameters with same key to server
							file.name = fieldname;
							text.name = '_' + fieldname;
							
							file.style.display = '';
							text.style.display = 'none';	
							text.value = '';
							filename.style.display = '';
						}else{
							// Avoid sending two form parameters with same key to server
							text.name = fieldname;
							file.name = '_' + fieldname;
							
							file.style.display = 'none';
							text.style.display = '';		
							file.value = '';
							filename.style.display = 'none';
							filename.innerHTML=\"\";
						}
					}
				</script>
				<div>
					<input name=\"{$fldname}\" id=\"{$fldname}_I__\" type=\"file\" value=\"{$secondvalue}\" tabindex=\"{$vt_tab}\" onchange=\"validateFilename(this)\" style=\"display: none;\"/>
					<input type=\"hidden\" name=\"{$fldname}_hidden\" value=\"{$secondvalue}\"/>
					<input type=\"hidden\" name=\"id\" value=\"\"/>
					<input type=\"text\" id=\"{$fldname}_E__\" name=\"{$fldname}\" class=\"detailedViewTextBox\" onFocus=\"this.className='detailedViewTextBoxOn'\" onBlur=\"this.className='detailedViewTextBox'\" value=\"{$secondvalue}\" /><br>
					<span id=\"{$fldname}_value\" style=\"display:none;\">";
						if ($secondvalue != ''){
						   echo "[{$secondvalue}]";
						}
					echo "</span>
				</div>	
				</td>";
			}elseif ($uitype == 26){
				echo "<td width=\"20%\" class=\"dvtCellLabel\" align=right>
				<font color=\"red\">{$mandatory_field}</font>{$fldlabel}
				</td>
				<td width=\"30%\" align=left class=\"dvtCellInfo\">
					<select name=\"{$fldname}\" tabindex=\"{$vt_tab}\" >";
						foreach($fldvalue as $k => $v){ 	 
							echo "<option value=\"{$k}\">{$v}</option> ";
						}
					echo "</select>
				</td>";
			}
			elseif ($uitype == 27){
				echo "<td width=\"20%\" class=\"dvtCellLabel\" align=\"right\" >
					<font color=\"red\">{$mandatory_field}</font>{$fldlabel_other}&nbsp;	
				</td>
				<td width=\"30%\" align=left class=\"dvtCellInfo\">
					<select name=\"{$fldname}\" onchange=\"changeDldType((this.value=='I')? 'file': 'text');\">";
						foreach($fldlabel as $key => $combo){
							echo "<option value=\"".$fldlabel_combo[$key]."\" ".$fldlabel_sel[$key]." >".$fldlabel[$key]." </option>";
						}
					echo "</select>
					<script>
						function vtiger_{$fldname}Init(){
							var d = document.getElementsByName('{$fldname}')[0];
							var type = (d.value=='I')? 'file': 'text';
			
							changeDldType(type, true);
						}
						if(typeof window.onload =='function'){
							var oldOnLoad = window.onload;
							document.body.onload = function(){
								vtiger_{$fldname}Init();
								oldOnLoad();
							}
						}else{
							window.onload = function(){
								vtiger_{$fldname}Init();
							}
						}
						
					</script>
				</td>";
			}elseif( $uitype == 56){
				echo "<td width=\"20%\" class=\"dvtCellLabel\" align=right>
					<font color=\"red\">{$mandatory_field}</font>{$usefldlabel}
				</td>";
				if ($fldname == 'portal'){
					echo "<td width=\"30%\" align=left class=\"dvtCellInfo\">
						<input type=\"hidden\" name=\"existing_portal\" value=\"{$fldvalue}\">
						<input name=\"{$fldname}\" type=\"checkbox\" tabindex=\"{$vt_tab}\" disabled=\"disabled\" ";
						if ($fldvalue == 1){
							echo 'checked';
						}
						echo ">
					</td>";
				}else{
					if ($fldvalue == 1){
						echo "<td width=\"30%\" align=left class=\"dvtCellInfo\">
							<input name=\"{$fldname}\" type=\"checkbox\" tabindex=\"{$vt_tab}\" checked>
						</td>";
					}elseif ($fldname == 'filestatus'&& $_REQUEST['id']){
						echo "<td width=\"30%\" align=left class=\"dvtCellInfo\">
							<input name=\"{$fldname}\" type=\"checkbox\" tabindex=\"{$vt_tab}\" checked>
						</td>";
					}else{
						echo "<td width=\"30%\" align=left class=\"dvtCellInfo\">
							<input name=\"{$fldname}\" tabindex=\"{$vt_tab}\" type=\"checkbox\">
						</td>";
					}
				}
			}

		}
		echo '</tr>';
	}
	
}
echo '<tr><td align=center colSpan=4>
<input name="button" title="'.getTranslatedString('LBL_SAVE').'[Alt+S]" class="crmbutton small cancel" accessKey="S" style="width: 70px;" onclick="this.form.action.value=\'Save\';  return formValidate()" type="submit" value="'.getTranslatedString('LBL_SAVE').'"/>&nbsp;&nbsp;&nbsp;
<input class="crmbutton small cancel" type="button" value="'.getTranslatedString('LBL_BACK_BUTTON').'" onclick="window.history.back();"/></td></tr>';
echo "</form></table>";
?>