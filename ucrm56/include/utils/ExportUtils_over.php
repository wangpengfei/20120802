<?php
/**
 * this class will provide utility functions to process the export data.
 * this is to make sure that the data is sanitized before sending for export
 */
class ExportUtils{
	var $fieldsArr = array();
	var $picklistValues = array();
	
	function ExportUtils($module, $fields_array){
		self::__init($module, $fields_array);
	}
	
	
	function __init($module, $fields_array){
		$infoArr = self::getInformationArray($module);
		
		//attach extra fields related information to the fields_array; this will be useful for processing the export data
		foreach($infoArr as $fieldname=>$fieldinfo){
			if(in_array($fieldinfo["fieldlabel"], $fields_array)){
				$this->fieldsArr[$fieldname] = $fieldinfo;
			}
		}
	}
	
	/**
	 * this function takes in an array of values for an user and sanitizes it for export
	 * @param array $arr - the array of values
	 */
	function sanitizeValues($arr){
		global $current_user, $adb;
		$roleid = fetchUserRole($current_user->id);
		
		foreach($arr as $fieldlabel=>&$value){
		    //add by wt
            if($fieldlabel=='身份证'){
		      $value = "'".$value;
            }
            //end
			$fieldInfo = $this->fieldsArr[$fieldlabel];
			$uitype = $fieldInfo['uitype'];
			$fieldname = $fieldInfo['fieldname'];
            //update by tanbin
            //*********************************************************
            //if($uitype == 15 || $uitype == 16 || $uitype == 33){
			if($uitype == 15 || $uitype == 16){
			 //*********************************************************
				//picklists
				if(empty($this->picklistValues[$fieldname])){
					$this->picklistValues[$fieldname] = getAssignedPicklistValues($fieldname, $roleid, $adb);
				}
				$value = trim($value);
				if(!empty($this->picklistValues[$fieldname]) && !in_array($value, $this->picklistValues[$fieldname]) && !empty($value)){
					$value = getTranslatedString("LBL_NOT_ACCESSIBLE");
				}
			}
            
            elseif($uitype == 10){
				//have to handle uitype 10
				$value = trim($value);
				if(!empty($value)) {
					$parent_module = getSalesEntityType($value);
					$displayValueArray = getEntityName($parent_module, $value);
					if(!empty($displayValueArray)){
						foreach($displayValueArray as $k=>$v){
							$displayValue = $v;
						}
					}
					if(!empty($parent_module) && !empty($displayValue)){
					    //modified by wt
						//$value = $parent_module."::::".$displayValue;
                        $value = $displayValue;
					}else{
						$value = "";
					}
				} else {
					$value = '';
				}
			}
		}
		return $arr;
	}
	
	/**
	 * this function takes in a module name and returns the field information for it
	 */
	function getInformationArray($module){
		require_once 'include/utils/utils.php';
		global $adb;
		$tabid = getTabid($module);
		
		$result = $adb->pquery("select * from vtiger_field where tabid=?", array($tabid));
		$count = $adb->num_rows($result);
		$arr = array();
		$data = array();
		
		for($i=0;$i<$count;$i++){
			$arr['uitype'] = $adb->query_result($result, $i, "uitype");
			$arr['fieldname'] = $adb->query_result($result, $i, "fieldname");
			$arr['columnname'] = $adb->query_result($result, $i, "columnname");
			$arr['tablename'] = $adb->query_result($result, $i, "tablename");
			$arr['fieldlabel'] = $adb->query_result($result, $i, "fieldlabel");
			$fieldlabel = strtolower($arr['fieldlabel']);
			$data[$fieldlabel] = $arr;
		}
		return $data;
	}
}
?>

