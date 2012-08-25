<?php
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Public License Version 1.1.2
 * ("License"); You may not use this file except in compliance with the
 * License. You may obtain a copy of the License at http://www.sugarcrm.com/SPL
 * Software distributed under the License is distributed on an  "AS IS"  basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for
 * the specific language governing rights and limitations under the License.
 * The Original Code is:  SugarCRM Open Source
 * The Initial Developer of the Original Code is SugarCRM, Inc.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.;
 * All Rights Reserved.
 * Contributor(s): ______________________________________.
 ********************************************************************************/
require_once('config.php');
require_once('include/logging.php');
require_once('include/database/PearDatabase.php');
require_once('modules/Accounts/Accounts.php');
require_once('modules/Contacts/Contacts.php');
require_once('modules/Leads/Leads.php');
require_once('modules/Contacts/Contacts.php');
require_once('modules/Emails/Emails.php');
require_once('modules/Calendar/Activity.php');
require_once('modules/Documents/Documents.php');
require_once('modules/Potentials/Potentials.php');
require_once('modules/Users/Users.php');
require_once('modules/Products/Products.php');
require_once('modules/HelpDesk/HelpDesk.php');
require_once('modules/Vendors/Vendors.php');
require_once('include/utils/UserInfoUtil.php');
require_once('modules/CustomView/CustomView.php');
require_once 'modules/PickList/PickListUtils.php';
require_once 'ExportUtils_over.php';
require_once 'function.export.php';

// Set the current language and the language strings, if not already set.
setCurrentLanguage();

global $allow_exports,$app_strings;

session_start();

$current_user = new Users();

if(isset($_SESSION['authenticated_user_id']))
{
	$result = $current_user->retrieveCurrentUserInfoFromFile($_SESSION['authenticated_user_id'],"Users");
	if($result == null)
	{
		session_destroy();
		header("Location: index.php?action=Login&module=Users");
		exit;
	}
}

//Security Check
if(isPermitted($_REQUEST['module'],"Export") == "no")
{
	$allow_exports="none";
}

if ($allow_exports=='none' || ( $allow_exports=='admin' && ! is_admin($current_user) ) )
{
?>
	<script type='text/javascript'>
		alert("<?php echo $app_strings['NOT_PERMITTED_TO_EXPORT']?>");
		window.location="index.php?module=<?php echo vtlib_purify($_REQUEST['module']) ?>&action=index";
	</script>
<?php 
	exit; 
}

/**Function convert line breaks to space in description during export
 * Pram $str - text
 * retrun type string
*/
function br2nl_vt($str)
{
	global $log;
	$log->debug("Entering br2nl_vt(".$str.") method ...");
	$str = preg_replace("/(\r\n)/", " ", $str);
	$log->debug("Exiting br2nl_vt method ...");
	return $str;
}

/**Function sort fields  as header
 * Pram $showarr - array,  $request - array
 * retrun type array
*/
function order_show($request)
{
	$showarr = $request['show'];
	foreach( $request  as $key=>$val ){
		$orderkey = substr($key,-(strlen($key)-6));
		//设定了排序数字的序列
		if( (substr($key,0,6) == "order_") && !empty($val) ) {
			foreach( $showarr  as $key1=>$val1 ){
				if( $orderkey == $key1 ){
				
					$order[$orderkey]=$val;
				}
			}
		//没有设置排序的序列
		} else if( (substr($key,0,6) == "order_") && empty($val) ) {
			foreach( $showarr  as $key1=>$val1 ){
				if( $orderkey == $key1 ){
					
					$order_out[$orderkey]=$val;
				}
			}
		}
	}
	//按照键值大小排序
	asort($order);

	if( empty($order) ){
		$header=$order_out;
	}elseif( empty($order_out) ){
		$header=$order;
	}else{
		$header=array_merge($order,$order_out);
	}
	return array_keys($header);
} 
/**Function sort fields  as header
 * Pram $new_arr - array,  $header - array
 * retrun type array
*/
function  orderdataline($new_arr,$header)
{
	foreach( $header as $key=>$val ){
		foreach($new_arr as $key1=>$val1){
			//过滤
			if( $key1==$val ){
				//排序 数组里的调换位置
				$new_arr_1[$key1]=$val1;//$_REQUEST['module']
			}
		}
	}
	return $new_arr_1;
} 

/**Function  ucfirst everyone  word
 * Pram $str - string
 * retrun type string 
*/
function  ucfirst_str($str)
{
	$new_str = explode(" ",$str);
	foreach($new_str as $key=>$val)
	{
		$new_str[$key]= ucfirst($val);
	}
	$str = implode(" ",$new_str);
	return $str;
} 

/**
 * This function exports all the data for a given module
 * Param $type - module name
 * Return type text
 */
function export($type){

    global $log,$list_max_entries_per_page;
    $log->debug("Entering export(".$type.") method ...");
    global $adb;
	global $current_language,$default_charset;
	
    $focus = 0;
    $content = '';

    if ($type != ""){
		// vtlib customization: Hook to dynamically include required module file.
		// Refer to the logic in setting $currentModule in index.php
		$focus = CRMEntity::getInstance($type);
    }
    $log = LoggerManager::getLogger('export_'.$type);
    $db = PearDatabase::getInstance();

	$oCustomView = new CustomView("$type");
	$viewid = $oCustomView->getViewId("$type");
	$sorder = $focus->getSortOrder();
	$order_by = $focus->getOrderBy();

    $search_type = $_REQUEST['search_type'];
    $export_data = $_REQUEST['export_data'];
	
	if(isset($_SESSION['export_where']) && $_SESSION['export_where']!='' && $search_type == 'includesearch'){
		$where =$_SESSION['export_where'];
	}

	$query = $focus->create_export_query($where);
      
	if($search_type != 'includesearch' && $type != 'Calendar') {
		$stdfiltersql = $oCustomView->getCVStdFilterSQL($viewid);
		$advfiltersql = $oCustomView->getCVAdvFilterSQL($viewid);
		if(isset($stdfiltersql) && $stdfiltersql != ''){
			$query .= ' and '.$stdfiltersql;
		}
		if(isset($advfiltersql) && $advfiltersql != '') {
			$query .= ' and '.$advfiltersql;
		}
	}
	
	$params = array();

	if(($search_type == 'withoutsearch' || $search_type == 'includesearch') && $export_data == 'selecteddata'){
		$idstring = explode(";", $_REQUEST['idstring']);
		if($type == 'Accounts' && count($idstring) > 0) {
			$query .= ' and vtiger_account.accountid in ('. generateQuestionMarks($idstring) .')';
			array_push($params, $idstring);
		} elseif($type == 'Contacts' && count($idstring) > 0) {
			$query .= ' and vtiger_contactdetails.contactid in ('. generateQuestionMarks($idstring) .')';
			array_push($params, $idstring);
		} elseif($type == 'Potentials' && count($idstring) > 0) {
			$query .= ' and vtiger_potential.potentialid in ('. generateQuestionMarks($idstring) .')';
			array_push($params, $idstring);
		} elseif($type == 'Leads' && count($idstring) > 0) {
			$query .= ' and vtiger_leaddetails.leadid in ('. generateQuestionMarks($idstring) .')';
			array_push($params, $idstring);
		} elseif($type == 'Products' && count($idstring) > 0) {
			$query .= ' and vtiger_products.productid in ('. generateQuestionMarks($idstring) .')';
			array_push($params, $idstring);
		} elseif($type == 'Documents' && count($idstring) > 0) {
			$query .= ' and vtiger_notes.notesid in ('. generateQuestionMarks($idstring) .')';
			array_push($params, $idstring);
		} elseif($type == 'HelpDesk' && count($idstring) > 0) {
			$query .= ' and vtiger_troubletickets.ticketid in ('. generateQuestionMarks($idstring) .')';
			array_push($params, $idstring);
		} elseif($type == 'Vendors' && count($idstring) > 0) {
			$query .= ' and vtiger_vendor.vendorid in ('. generateQuestionMarks($idstring) .')';
			array_push($params, $idstring);
		} else if(count($idstring) > 0) {
			// vtlib customization: Hook to make the export feature available for custom modules.
			$query .= " and $focus->table_name.$focus->table_index in (" . generateQuestionMarks($idstring) . ')';
			array_push($params, $idstring);
			// END
		}
	}
	
	if(isset($order_by) && $order_by != ''){
		if($order_by == 'smownerid'){
			$query .= ' ORDER BY user_name '.$sorder;
		}elseif($order_by == 'lastname' && $type == 'Documents'){
			$query .= ' ORDER BY vtiger_contactdetails.lastname  '. $sorder;
		}elseif($order_by == 'crmid' && $type == 'HelpDesk'){
			$query .= ' ORDER BY vtiger_troubletickets.ticketid  '. $sorder;
		}else{
			$tablename = getTableNameForField($type,$order_by);
			$tablename = (($tablename != '')?($tablename."."):'');
			if( $adb->dbType == "pgsql"){
				$query .= ' GROUP BY '.$tablename.$order_by;
			}
			$query .= ' ORDER BY '.$tablename.$order_by.' '.$sorder;
		}
	}
	
	if($export_data == 'currentpage'){
		$current_page = ListViewSession::getCurrentPage($type,$viewid);
		$limit_start_rec = ($current_page - 1) * $list_max_entries_per_page;
		if ($limit_start_rec < 0) $limit_start_rec = 0;
		$query .= ' LIMIT '.$limit_start_rec.','.$list_max_entries_per_page;
	}
    $result = $adb->pquery($query, $params, true, "Error exporting $type: "."<BR>$query");

    $fields_array = $adb->getFieldsArray($result);
	
	//这里决定排序和是否输出
	$fields_array=order_show($_REQUEST);
	
	$counts=$adb->num_rows($result);
	
	for($i=0;$i<$counts;$i++){
	
		$row = $adb->query_result_rowdata($result,$i);
		$new_arr = array();

		foreach ($row as $key => $value){
			
			$china_key = getTranslatedString(ucfirst_str($key),$type);

			if(in_array($china_key,$fields_array)){
				$value = $focus->transform_export_value($key, $value);
				$new_arr[$china_key]=getTranslatedString($value,$_REQUEST['module']);
			}
		}
		
		//排序数据
		$new_arr = orderdataline($new_arr,$fields_array);
		
		$data_line[] = $new_arr;
	}
	
	$log->debug("Exiting export method...");
	
	createxls($data_line);
	
	return true;
}
/** Send the output header and invoke function for contents output */
ob_end_clean();
export(vtlib_purify($_REQUEST['module']));
exit;
?>