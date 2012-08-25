<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
require_once('Smarty_setup.php');

class ModApprovals_DetailViewBlockApprovalWidget {
	private $_name = 'DetailViewBlockApprovalWidget';
	
	private $defaultCriteria = 'All';
	
	protected $context = false;
	protected $criteria= false;
	
	function __construct() {
	}
	
	function getFromContext($key, $purify=false) {
		if ($this->context) {
			$value = $this->context[$key];
			if ($purify && !empty($value)) {
				$value = vtlib_purify($value);
			}
			return $value;
		}
		return false;
	}
	
	function title() {
		return getTranslatedString('Approvals Information', 'ModApprovals');
	}
	
	function name() {
		return $this->_name;
	}
	
	function uikey() {
		return "ModApprovalsDetailViewBlockApprovalWidget";
	}
	
	function setCriteria($newCriteria) {
		$this->criteria = $newCriteria;
	}
	
	function getViewer() {
		global $theme, $app_strings, $current_language; 
		global $current_user;
		$smarty = new vtigerCRM_Smarty();
		$smarty->assign('APP', $app_strings);
		$smarty->assign('MOD', return_module_language($current_language,'ModApprovals'));
		$smarty->assign('THEME', $theme);
		$smarty->assign('IMAGE_PATH', "themes/$theme/images/");

	
		$smarty->assign('CUNAME', $current_user->user_name);
		$smarty->assign('CUID', $current_user->id);
		$smarty->assign('UIKEY', $this->uikey());
		$smarty->assign('WIDGET_TITLE', $this->title());
		$smarty->assign('WIDGET_NAME', $this->name());
		
		return $smarty;
	}
	
	protected function getModels($parentRecordId, $criteria) {
		global $adb, $current_user;

		$moduleName = 'ModApprovals';
		if(vtlib_isModuleActive($moduleName)) {
			$entityInstance = CRMEntity::getInstance($moduleName);
			
			$queryCriteria  = '';
			switch($criteria) {
				case 'All': $queryCriteria = ''; break;
				case 'Last5': $queryCriteria = sprintf(" ORDER BY %s.%s DESC LIMIT 5", $entityInstance->table_name, $entityInstance->table_index); break;
				case 'Mine': $queryCriteria = ' AND vtiger_crmentity.smownerid=' . $current_user->id; break;
			}
			
			$query = $entityInstance->getListQuery($moduleName, sprintf(" AND %s.related_to=?", $entityInstance->table_name));
			$query .= $queryCriteria;
			$result = $adb->pquery($query, array($parentRecordId));
		
			$instances = array();
			if($adb->num_rows($result)) {
				while($resultrow = $adb->fetch_array($result)) {
					$instances[] = new ModApprovals_ApprovalsModel($resultrow);
				}
			}
		}
		return $instances;
	}
	
	function processItem($model) {
		$viewer = $this->getViewer();
		$viewer->assign('APPROVALMODEL', $model);
		
		return $viewer->fetch(vtlib_getModuleTemplate("ModApprovals","widgets/DetailViewBlockApprovalItem.tpl"));
	}
	
	function process($context = false) {
		global $current_user;
		$this->context = $context;
		$sourceRecordId =  $this->getFromContext('ID', true);
		$usecriteria = ($this->criteria === false)? $this->defaultCriteria : $this->criteria;
		
		$viewer = $this->getViewer();
		$viewer->assign('ID', $sourceRecordId);
		$viewer->assign('CRITERIA', $usecriteria);
		
		
		$approvals_list =$this->getModels($sourceRecordId, $usecriteria);
		$approvals_size =count($approvals_list);
		
		if($approvals_size > 0)
		{
			$viewer->assign('APPROVALS', $approvals_list );
			$viewer->assign('PRE_APPROVALS_ID',$approvals_list[$approvals_size-1]->approvalsid());
			if($approvals_list[$approvals_size-1]->reports_to_name() == $current_user->user_name)
			{	
				$viewer->assign('ADDAPPROVALS_FLAG', "add");
			}
				else
			{
				$viewer->assign('ADDAPPROVALS_FLAG', "noadd");
			}
		}
		else
		{
			$viewer->assign('ADDAPPROVALS_FLAG', "newadd");
		}
	
		return $viewer->fetch(vtlib_getModuleTemplate("ModApprovals","widgets/DetailViewBlockApproval.tpl"));
	}
	
}