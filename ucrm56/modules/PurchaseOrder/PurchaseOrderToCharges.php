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

require_once('modules/Charges/Charges.php');
require_once('include/logging.php');
require_once('include/database/PearDatabase.php');

$allKeys = array_keys($_REQUEST);
for ($i=0;$i<count($allKeys);$i++)
{
   if(substr($allKeys[$i], 0, 11) == "chargetimes")
   {
	   $chargestimes[] = $_REQUEST[$allKeys[$i]];
   }
   if(substr($allKeys[$i], 0, 12) == "chargeamount")
   {
	   $planamount[] = $_REQUEST[$allKeys[$i]];
   }
   if(substr($allKeys[$i], 0, 10) == "chargedate")
   {
	   $plandate[] = $_REQUEST[$allKeys[$i]];
   }
}

if(!empty($chargestimes) && !empty($planamount) && !empty($plandate)){
	foreach($chargestimes as $key => $times){
		$focus = new Charges();

		if($_REQUEST['assigntype'] == 'U') {
			$focus->column_fields['assigned_user_id'] = $_REQUEST['assigned_user_id'];
		} elseif($_REQUEST['assigntype'] == 'T') {
			$focus->column_fields['assigned_user_id'] = $_REQUEST['assigned_group_id'];
		}
		$isinvoice = vtlib_getPicklistValues('isinvoice');
		$chargesstatus = vtlib_getPicklistValues('chargesstatus');
		
		$focus->column_fields['chargesname'] = $_REQUEST['subject'];
		$focus->column_fields['isinvoice'] = $isinvoice[0];
		$focus->column_fields['chargesstatus'] = $chargesstatus[0];
		$focus->column_fields['vendor_id'] = $_REQUEST['vendor_id'];
		$focus->column_fields['purchaseorder_id'] = $_REQUEST['purchaseorder_id'];
		$focus->column_fields['chargestimes'] = $times;
		$focus->column_fields['planamount'] = $planamount[$key];
		$focus->column_fields['plandate'] = $plandate[$key];
		
		$focus->save("Charges");
		
		//$accounts = new Accounts();
		//$accounts->save_related_module('Accounts', $_REQUEST['account'], 'Gathers', $focus->id);
		$PurchaseOrder = new PurchaseOrder();
		$PurchaseOrder->save_related_module('PurchaseOrder', $_REQUEST['purchaseorder_id'], 'Charges', $focus->id);
	}
}
echo '<script>history.go(-1);</script>';
?>