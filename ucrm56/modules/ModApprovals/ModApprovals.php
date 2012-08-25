<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
include_once dirname(__FILE__) . '/ModApprovalsCore.php';
include_once dirname(__FILE__) . '/models/Approvals.php';

class ModApprovals extends ModApprovalsCore {
	
	/**
	 * Invoked when special actions are performed on the module.
	 * @param String Module name
	 * @param String Event Type (module.postinstall, module.disabled, module.enabled, module.preuninstall)
	 */
	function vtlib_handler($modulename, $event_type) {
		parent::vtlib_handler($modulename, $event_type);
		if ($event_type == 'module.postinstall') {
			self::addWidgetTo(array('Leads', 'Contacts', 'Accounts'));
		}
	}
	
	/**
	 * Get widget instance by name
	 */
	static function getWidget($name) {
		if ($name == 'DetailViewBlockApprovalWidget') {
			require_once dirname(__FILE__) . '/widgets/DetailViewBlockApproval.php';
			return (new ModApprovals_DetailViewBlockApprovalWidget());
		}
		return false;
	}
	
	/**
	 * Add widget to other module.
	 * @param unknown_type $moduleNames
	 * @return unknown_type
	 */
	static function addWidgetTo($moduleNames, $widgetType='DETAILVIEWWIDGET', $widgetName='DetailViewBlockApprovalWidget') {
		if (empty($moduleNames)) return;
		
		include_once 'vtlib/Vtiger/Module.php';
		
		if (is_string($moduleNames)) $moduleNames = array($moduleNames);
		
		$approvalWidgetCount = 0; 
		foreach($moduleNames as $moduleName) {
			$module = Vtiger_Module::getInstance($moduleName);
			if($module) {
				$module->addLink($widgetType, $widgetName, "block://ModApprovals:modules/ModApprovals/ModApprovals.php");
				++$approvalWidgetCount;
			}
		}
		if ($approvalWidgetCount) {
			$modApprovalsModule = Vtiger_Module::getInstance('ModApprovals');
			$modApprovalsModule->addLink('HEADERSCRIPT', 'ModApprovalsCommonHeaderScript', 'modules/ModApprovals/ModApprovalsCommon.js');
			$modApprovalsRelatedToField = Vtiger_Field::getInstance('related_to', $modApprovalsModule);
			$modApprovalsRelatedToField->setRelatedModules($moduleNames);
		}
	}
	
	/**
	 * Remove widget from other modules.
	 * @param unknown_type $moduleNames
	 * @param unknown_type $widgetType
	 * @param unknown_type $widgetName
	 * @return unknown_type
	 */
	static function removeWidgetFrom($moduleNames, $widgetType='DETAILVIEWWIDGET', $widgetName='DetailViewBlockApprovalWidget') {
		if (empty($moduleNames)) return;
		
		include_once 'vtlib/Vtiger/Module.php';
		
		if (is_string($moduleNames)) $moduleNames = array($moduleNames);
		
		$approvalWidgetCount = 0; 
		foreach($moduleNames as $moduleName) {
			$module = Vtiger_Module::getInstance($moduleName);
			if($module) {
				$module->deleteLink($widgetType, $widgetName, "block://ModApprovals:modules/ModApprovals/ModApprovals.php");
				++$approvalWidgetCount;
			}
		}
		if ($approvalWidgetCount) {
			$modApprovalsModule = Vtiger_Module::getInstance('ModApprovals');
			$modApprovalsRelatedToField = Vtiger_Field::getInstance('related_to', $modApprovalsModule);
			$modApprovalsRelatedToField->unsetRelatedModules($moduleNames);
		}
	}
	
	/**
	 * Wrap this instance as a model
	 */
	function getAsApprovalModel() {
		return new ModApprovals_ApprovalsModel($this->column_fields);
	}

}
?>
