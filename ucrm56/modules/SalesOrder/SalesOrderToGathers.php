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
/*********************************************************************************
 * $Header: /cvsroot/vtigercrm/vtiger_crm/modules/SalesOrder/Save.php,v 1.1 2005/12/16 04:13:15 mangai Exp $
 * Description:  Saves an Account record and then redirects the browser to the 
 * defined return URL.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('modules/Gathers/Gathers.php');
require_once('include/logging.php');
require_once('include/database/PearDatabase.php');

$focus = new Gathers();

$allKeys = array_keys($_REQUEST);
for ($i=0;$i<count($allKeys);$i++)
{
   if(substr($allKeys[$i], 0, 11) == "gathertimes")
   {
	   $gatherstimes[] = $_REQUEST[$allKeys[$i]];
   }
   if(substr($allKeys[$i], 0, 12) == "gatheramount")
   {
	   $planamount[] = $_REQUEST[$allKeys[$i]];
   }
   if(substr($allKeys[$i], 0, 10) == "gatherdate")
   {
	   $plandate[] = $_REQUEST[$allKeys[$i]];
   }
}

if(!empty($gatherstimes) && !empty($planamount) && !empty($plandate)){
	foreach($gatherstimes as $key => $times){
		$focus = new Gathers();

		if($_REQUEST['assigntype'] == 'U') {
			$focus->column_fields['assigned_user_id'] = $_REQUEST['assigned_user_id'];
		} elseif($_REQUEST['assigntype'] == 'T') {
			$focus->column_fields['assigned_user_id'] = $_REQUEST['assigned_group_id'];
		}
		$isinvoice = vtlib_getPicklistValues('isinvoice');
		$gathersstatus = vtlib_getPicklistValues('gathersstatus');
		
		$focus->column_fields['gathersname'] = $_REQUEST['subject'];
		$focus->column_fields['isinvoice'] = $isinvoice[0];
		$focus->column_fields['gathersstatus'] = $gathersstatus[0];
		$focus->column_fields['payer'] = $_REQUEST['account'];
		$focus->column_fields['salesorder_id'] = $_REQUEST['salesorder_id'];
		$focus->column_fields['gatherstimes'] = $times;
		$focus->column_fields['planamount'] = $planamount[$key];
		$focus->column_fields['plandate'] = $plandate[$key];
		
		$focus->save("Gathers");
		
		//$accounts = new Accounts();
		//$accounts->save_related_module('Accounts', $_REQUEST['account'], 'Gathers', $focus->id);
		
		require_once('modules/SalesOrder/SalesOrder.php');
		$SalesOrder = new SalesOrder();
		$SalesOrder->save_related_module('SalesOrder', $_REQUEST['salesorder_id'], 'Gathers', $focus->id);
	}
}
echo '<script>history.go(-1);</script>';
?>