<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
include_once dirname(__FILE__) . '/DART.Config.php';

/**
 * DART class extending the Core class
 */
class DART extends DART_Core {
	
	/**
	 * Determine user's identify having not acted for the day.
	 */
	function users_noactivityForTheDay($fordate) {
		global $adb;
		
		$result = $adb->pquery("SELECT id, user_name as name, email1, email2 FROM vtiger_users where deleted=0 AND status='Active' AND id not IN (SELECT distinct smownerid FROM vtiger_dart_recordchanges WHERE modifiedon=?)", array($fordate));
		
		$rows = array();
		if ($adb->num_rows($result)) {
			while ($resultrow = $adb->fetch_array($result)) {
				$row = array ('name' => decode_html($resultrow['name']));
				$row['email'] = empty($resultrow['email1'])? $resultrow['email2'] : $resultrow['email1'];
				$rows[] = $row;
			}
		}
		return $rows;
	}
	
	/**
	 * Gather the changes of record by-user-by-module
	 */
	function report_GatherChangedRecordDetails($fordate) {
		return $this->report_GatherChangesByUserAndModuleForTheDay($fordate);
	}
	
	/**
	 * Gather the changes of record by-user-by-module-for the day
	 */
	function report_GatherChangesByUserAndModuleForTheDay($date) {
		global $adb;
		
		$group = array();
		
		$moduleinfo = $adb->pquery("SELECT * FROM vtiger_entityname WHERE modulename != 'Users'", array());
		
		if (!$adb->num_rows($moduleinfo)) return $group;
		
		while($row = $adb->fetch_array($moduleinfo)) {
			
			$query = $this->report_PrepareQueryForTheModule($row['modulename'], $row['tablename'], $row['entityidfield'], $row['fieldname']);
			
			$records = $adb->pquery($query, array($date));
			
			if (!$adb->num_rows($records)) continue;
			
			while($record = $adb->fetch_array($records)) {
				
				$module = $row['modulename'];
				$changeType = empty($record['modifier'])? "CREATED" : "UPDATED";
				$changeOwner = empty($record['modifier'])? $record['owner'] : $record['modifier'];
				
				global $current_user;
				if($current_user->is_admin == 'off' && $changeOwner != $current_user->id){
					continue;
				}
				
				if ($this->permittedToView($module, $row['id']) === false) continue;
				
				$username = $this->username($changeOwner);
				if (!isset($group[$username])) {
					$group[$username] = array();
				}
				if (!isset($group[$username][$module])) {
					$group[$username][$module] = array();
				}
				
				$group[$username][$module][] = array( 
					'id' => $record['id'], 'title' => $record['title'], 'module' => $record['module'], 'changetype' => $changeType
				);				
			}
			unset($records);
		}
		
		return $group;
	}
	
	/**
	 * Query to pickup the changes across all the module.
	 */
	function report_PrepareQueryForTheModule($module, $table, $idcolumn, $titlecolumn) {
		if (strpos($titlecolumn, ',') > 0) {
			$titlecolumn = "concat($titlecolumn)";
		}
		
		$idcolumnalias = $idcolumn;
		if ($idcolumnalias != 'id') {
			$idcolumnalias = "$idcolumn as id";
		} else {
			$idcolumnalias = "$table.$idcolumn";
		}
		
		$selectcolumn = $titlecolumn;
		if ($selectcolumn != $idcolumn) {
			$selectcolumn .= ' as title, ' . $idcolumnalias;
		}
		
		if($module == 'Calendar'){
			return sprintf( "SELECT $selectcolumn, vtiger_dart_recordchanges.modifiedby as modifier, vtiger_dart_recordchanges.smownerid as owner, module
			FROM $table INNER JOIN vtiger_dart_recordchanges ON 
			$table.$idcolumn = vtiger_dart_recordchanges.crmid AND DATE(modifiedon) = ? where vtiger_activity.activitytype != 'Emails' 
INNER JOIN vtiger_crmentity c ON c.crmid=vtiger_dart_recordchanges.crmid and c.deleted=0");
		}elseif($module == 'Emails'){
			return sprintf( "SELECT $selectcolumn, vtiger_dart_recordchanges.modifiedby as modifier, vtiger_dart_recordchanges.smownerid as owner, module
			FROM $table INNER JOIN vtiger_dart_recordchanges ON 
			$table.$idcolumn = vtiger_dart_recordchanges.crmid AND DATE(modifiedon) = ? where vtiger_activity.activitytype = 'Emails' 
INNER JOIN vtiger_crmentity c ON c.crmid=vtiger_dart_recordchanges.crmid and c.deleted=0");
		}
		
		return sprintf( "SELECT $selectcolumn, vtiger_dart_recordchanges.modifiedby as modifier, vtiger_dart_recordchanges.smownerid as owner, module
			FROM $table INNER JOIN vtiger_dart_recordchanges ON 
			$table.$idcolumn = vtiger_dart_recordchanges.crmid AND DATE(modifiedon) = ? 
INNER JOIN vtiger_crmentity c ON c.crmid=vtiger_dart_recordchanges.crmid and c.deleted=0");
	}
	/*
	function get_mydart($fdate,$tdate) {
		global $adb;
		global $current_user;
		
		$group = array();
		
		$moduleinfo = $adb->pquery("SELECT * FROM vtiger_entityname WHERE modulename != 'Users'", array());
		
		if (!$adb->num_rows($moduleinfo)) return $group;
		
		while($row = $adb->fetch_array($moduleinfo)) {
			
			$query = $this->mydart_query($row['modulename'], $row['tablename'], $row['entityidfield'], $row['fieldname']);
			$records = $adb->pquery($query, array($fdate,$tdate,$current_user->id,$current_user->id));

			if (!$adb->num_rows($records)) continue;
			$count_add = 0;
			$count_edit= 0;
			while($record = $adb->fetch_array($records)) {
				
				$module = $row['modulename'];
				$changeDate = $record['modifiedon'];

				if ($this->permittedToView($module, $row['id']) === false) continue;
				
				if (!isset($group[$changeDate])) {
					$group[$changeDate] = array();
				}
				if (!isset($group[$changeDate][$module])) {
					if(empty($record['modifier'])){
						$group[$changeDate][$module]['add'] = 1;
						$group[$changeDate][$module]['edit'] = 0;
					}else{
						$group[$changeDate][$module]['add'] = 0;
						$group[$changeDate][$module]['edit'] = 1;
					}
				}else{
					if(empty($record['modifier'])){
						$group[$changeDate][$module]['add'] += 1;
					}else{
						$group[$changeDate][$module]['edit'] += 1;
					}
				}			
			}
			unset($records);
		}
		
		return $group;
	}
	
	function mydart_query($module, $table, $idcolumn, $titlecolumn) {
		if (strpos($titlecolumn, ',') > 0) {
			$titlecolumn = "concat($titlecolumn)";
		}
		
		$idcolumnalias = $idcolumn;
		if ($idcolumnalias != 'id') {
			$idcolumnalias = "$idcolumn as id";
		} else {
			$idcolumnalias = "$table.$idcolumn";
		}
		
		$selectcolumn = $titlecolumn;
		if ($selectcolumn != $idcolumn) {
			$selectcolumn .= ' as title, ' . $idcolumnalias;
		}
		
		if($module == 'Calendar'){
			return sprintf( "SELECT $selectcolumn,module,modifiedby as modifier,modifiedon
			FROM $table INNER JOIN vtiger_dart_recordchanges ON 
			$table.$idcolumn = vtiger_dart_recordchanges.crmid AND(DATE(modifiedon) BETWEEN  ? AND ? )AND(modifiedby=? OR (smownerid=? AND modifiedby =''))where vtiger_activity.activitytype != 'Emails'");
		}elseif($module == 'Emails'){
			return sprintf( "SELECT $selectcolumn,module,modifiedby as modifier,modifiedon
			FROM $table INNER JOIN vtiger_dart_recordchanges ON 
			$table.$idcolumn = vtiger_dart_recordchanges.crmid AND(DATE(modifiedon) BETWEEN  ? AND ? )AND(modifiedby=? OR (smownerid=? AND modifiedby =''))where vtiger_activity.activitytype = 'Emails'");
		}
		
		return sprintf( "SELECT $selectcolumn,module,modifiedby as modifier,modifiedon
			FROM $table INNER JOIN vtiger_dart_recordchanges ON 
			$table.$idcolumn = vtiger_dart_recordchanges.crmid AND(DATE(modifiedon) BETWEEN  ? AND ? )AND(modifiedby=? OR (smownerid=? AND modifiedby =''))");
	}
	*/
	function get_mydart($fdate,$tdate) {
		global $adb;
		global $current_user;
		
		$group = array();
		
		$moduleinfo = $adb->pquery("SELECT * FROM vtiger_entityname WHERE modulename != 'Users'", array());
		
		if (!$adb->num_rows($moduleinfo)) return $group;
		
		while($row = $adb->fetch_array($moduleinfo)) {
			
			$query = $this->mydart_query($row['modulename'], $row['tablename'], $row['entityidfield'], $row['fieldname']);
			$records = $adb->pquery($query, array($fdate,$tdate,$current_user->id,$current_user->id));

			if (!$adb->num_rows($records)) continue;
			
			while($record = $adb->fetch_array($records)) {
				
				$module = $row['modulename'];
				$changeDate = $record['modifiedon'];
				$changeType = empty($record['modifier'])? "CREATED" : "UPDATED";

				if ($this->permittedToView($module, $row['id']) === false) continue;
				
				if (!isset($group[$changeDate])) {
					$group[$changeDate] = array();
				}
				if (!isset($group[$changeDate][$module])) {
					$group[$changeDate][$module] = array();
				}
				
				$group[$changeDate][$module][] = array( 
					'id' => $record['id'], 'title' => $record['title'], 'module' => $record['module'], 'changetype' => $changeType
				);				
			}
			unset($records);
		}
		
		return $group;
	}
	
	function mydart_query($module, $table, $idcolumn, $titlecolumn) {
		if (strpos($titlecolumn, ',') > 0) {
			$titlecolumn = "concat($titlecolumn)";
		}
		
		$idcolumnalias = $idcolumn;
		if ($idcolumnalias != 'id') {
			$idcolumnalias = "$idcolumn as id";
		} else {
			$idcolumnalias = "$table.$idcolumn";
		}
		
		$selectcolumn = $titlecolumn;
		if ($selectcolumn != $idcolumn) {
			$selectcolumn .= ' as title, ' . $idcolumnalias;
		}
		
		if($module == 'Calendar'){
			return sprintf( "SELECT $selectcolumn, modifiedby as modifier, smownerid as owner,module,modifiedon
			FROM $table INNER JOIN vtiger_dart_recordchanges ON 
			$table.$idcolumn = vtiger_dart_recordchanges.crmid AND(DATE(modifiedon) BETWEEN  ? AND ? )AND(modifiedby=? OR (smownerid=? AND modifiedby =''))where vtiger_activity.activitytype != 'Emails'");
		}elseif($module == 'Emails'){
			return sprintf( "SELECT $selectcolumn, modifiedby as modifier, smownerid as owner,module,modifiedon
			FROM $table INNER JOIN vtiger_dart_recordchanges ON 
			$table.$idcolumn = vtiger_dart_recordchanges.crmid AND(DATE(modifiedon) BETWEEN  ? AND ? )AND(modifiedby=? OR (smownerid=? AND modifiedby =''))where vtiger_activity.activitytype = 'Emails'");
		}
		
		return sprintf( "SELECT $selectcolumn, modifiedby as modifier, smownerid as owner,module,modifiedon
			FROM $table INNER JOIN vtiger_dart_recordchanges ON 
			$table.$idcolumn = vtiger_dart_recordchanges.crmid AND(DATE(modifiedon) BETWEEN  ? AND ? )AND(modifiedby=? OR (smownerid=? AND modifiedby =''))");
	}
	function get_detail($uid,$date) {
		global $adb;
		
		$group = array();
		
		$moduleinfo = $adb->pquery("SELECT * FROM vtiger_entityname WHERE modulename != 'Users'", array());
		
		if (!$adb->num_rows($moduleinfo)) return $group;
		
		while($row = $adb->fetch_array($moduleinfo)) {
			
			$query = $this->get_detailForTheModule($row['modulename'], $row['tablename'], $row['entityidfield'], $row['fieldname']);
			$records = $adb->pquery($query, array($date,$uid,$uid));
			
			if (!$adb->num_rows($records)) continue;
			
			while($record = $adb->fetch_array($records)) {
				
				$module = $row['modulename'];
				$changeType = empty($record['modifier'])? "CREATED" : "UPDATED";
				$changeOwner = empty($record['modifier'])? $record['owner'] : $record['modifier'];
				
				if ($this->permittedToView($module, $row['id']) === false) continue;
				
				$username = $this->username($changeOwner);
				if (!isset($group[$username])) {
					$group[$username] = array();
				}
				if (!isset($group[$username][$module])) {
					$group[$username][$module] = array();
				}
				
				$group[$username][$module][] = array( 
					'id' => $record['id'], 'title' => $record['title'], 'module' => $record['module'], 'changetype' => $changeType
				);				
			}
			unset($records);
		}
		
		return $group;
	}
	
	/**
	 * Query to pickup the changes across all the module.
	 */
	function get_detailForTheModule($module, $table, $idcolumn, $titlecolumn) {
		if (strpos($titlecolumn, ',') > 0) {
			$titlecolumn = "concat($titlecolumn)";
		}
		
		$idcolumnalias = $idcolumn;
		if ($idcolumnalias != 'id') {
			$idcolumnalias = "$idcolumn as id";
		} else {
			$idcolumnalias = "$table.$idcolumn";
		}
		
		$selectcolumn = $titlecolumn;
		if ($selectcolumn != $idcolumn) {
			$selectcolumn .= ' as title, ' . $idcolumnalias;
		}
		
		if($module == 'Calendar'){
			return sprintf( "SELECT $selectcolumn, modifiedby as modifier, smownerid as owner, module
			FROM $table INNER JOIN vtiger_dart_recordchanges ON 
			$table.$idcolumn = vtiger_dart_recordchanges.crmid AND DATE(modifiedon) = ? where vtiger_activity.activitytype != 'Emails' AND(modifiedby=? OR (smownerid=? AND modifiedby =''))");
		}elseif($module == 'Emails'){
			return sprintf( "SELECT $selectcolumn, modifiedby as modifier, smownerid as owner, module
			FROM $table INNER JOIN vtiger_dart_recordchanges ON 
			$table.$idcolumn = vtiger_dart_recordchanges.crmid AND DATE(modifiedon) = ? where vtiger_activity.activitytype = 'Emails' AND(modifiedby=? OR (smownerid=? AND modifiedby =''))");
		}
		
		return sprintf( "SELECT $selectcolumn, modifiedby as modifier, smownerid as owner, module
			FROM $table INNER JOIN vtiger_dart_recordchanges ON 
			$table.$idcolumn = vtiger_dart_recordchanges.crmid AND DATE(modifiedon) = ? AND(modifiedby=? OR (smownerid=? AND modifiedby =''))");
	}
}

/**
 * Core DART class
 */
class DART_Core {
	/**
	 * Helper function to retrieve username
	 */
	static $usernameCache = false;	
	function username($id) {
		global $adb;
		if (self::$usernameCache === false) {
			self::$usernameCache = array();
			$result = $adb->pquery("SELECT user_name, id FROM vtiger_users", array());
			while($row = $adb->fetch_array($result)) {
				self::$usernameCache[$row['id']] = $row['user_name'];
			}
		}
		return self::$usernameCache[$id];
	}
	
	/**
	 * Helper function to retrieve configuration parameter
	 */
	function config($key, $defvalue=false) {
		global $__DART_CONFIG;
		if (isset($__DART_CONFIG[$key])) return $__DART_CONFIG[$key];
		return $defvalue;
	}
	
	// Access restriction user context
	protected $activeUser = false;
	
	/**
	 * Set active user context.
	 */
	function setActiveUser($user) {
		$this->activeUser = $user;
	}
	
	/**
	 * Is record view permitted?
	 */
	function permittedToView($module, $crmid) {
		if ($this->activeUser !== false) {
			return (isPermitted($module, 'DetailView', $crmid) == 'yes');
		}
		return true;
	}
	
	/**
	 * Record the changes for the day
	 */
	function record_ChangesForTheDay($date) {
		global $adb;
		
		$sql = "SELECT setype, crmid, smownerid, modifiedby FROM vtiger_crmentity WHERE DATE(modifiedtime)=?";
		$result = $adb->pquery($sql, array($date));
		
		if (!$adb->num_rows($result)) return;
		
		while($row = $adb->fetch_array($result)) {
			$this->record_ChangesForTheModule($row['setype'], $row['crmid'], $row['smownerid'], $row['modifiedby'], $date);
		}
	}
	
	/**
	 * Record the changes for the module for the day
	 */
	function record_ChangesForTheModule($module, $crmid, $smownerid, $modifiedby, $date) {
		global $adb;
		$sql = "INSERT IGNORE INTO vtiger_dart_recordchanges(module, crmid, smownerid, modifiedby, modifiedon) VALUES (?, ?, ?, ?, ?)";
		$adb->pquery($sql, array($module, $crmid, $smownerid, $modifiedby, $date));
	}
	
}

?>
