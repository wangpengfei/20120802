<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
class ModApprovals_ApprovalsModel {
	private $data;
	
	static $ownerNamesCache = array();
	
	static $nextApproverNamesCache = array();

	function __construct($datarow) {
		$this->data = $datarow;
	}
	
	function author() {
		$authorid = $this->data['smcreatorid'];
		if(!isset(self::$ownerNamesCache[$authorid])) {
			self::$ownerNamesCache[$authorid] = getOwnerName($authorid);
		}
		return self::$ownerNamesCache[$authorid];
	}
	
	function timestamp(){ 
		return getDisplayDate($this->data['modifiedtime']);
	}
	
	function content() {
		return decode_html($this->data['approvalcontent']);
	}
	function approvalsid() {
		return decode_html($this->data['modapprovalsid']);
	}
	function approvals_status() {
		return decode_html($this->data['approvals_status']);
	}
	function next_approvals() {
		return decode_html($this->data['next_approvals']);
	}

	function reports_to_name() {

		$reports_to_id = $this->data['reports_to_id'];
		if(!isset(self::$nextApproverNamesCache[$reports_to_id])) {
			self::$nextApproverNamesCache[$reports_to_id] = getOwnerName($reports_to_id);
		}
		return self::$nextApproverNamesCache[$reports_to_id];

		//return decode_html( getUserName($this->data['reports_to_id']));
	}
}