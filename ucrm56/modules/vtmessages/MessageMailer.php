<?php
/*+*******************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ******************************************************************************/
global $current_user, $currentModule;

require_once("vtlib/Vtiger/Mailer.php");
require_once("vtlib/Vtiger/Utils/StringTemplate.php");

class Message_Mailer {

	static function getEmailTemplate($type) {
		$filename = dirname(__FILE__) . '/resources/EmailTemplates';

		if($type == 'New') $filename .= '/NewMessage.txt';
		else if($type == 'Reply') $filename .= '/ReplyMessage.txt';

		$filecontents = file_get_contents($filename);
		if(file_exists($filename)) {
			$filecontents = file_get_contents($filename);
		}
		return $filecontents;
	}	

	static function getMessageURL($recordid=false) {
		global $site_URL;
		if($recordid) return ($site_URL ."/index.php?module=vtmessages&action=DetailView&record=$recordid");
		else return $site_URL . '/index.php?module=vtmessages&action=index';
	}

	static function getUserActiveInfo($userids) {
		global $adb;
		$userinfos = Array();
		$query = "SELECT * FROM vtiger_users WHERE id IN(".implode(',', array_fill(0, count($userids), '?')) . ") AND status='Active'";
		$userres  = $adb->pquery($query, $userids);
		while($userrow = $adb->fetch_array($userres)) {
			$userinfos[$userrow['id']] = $userrow;
		}
		return $userinfos;
	}

	static function send($focus, $current_user, $mode, $userids) {
		global $log, $adb, $mod_strings;

		$userinfos = self::getUserActiveInfo($userids);
		$fromuserinfo = $userinfos[$current_user->id];
		unset($userinfos[$current_user->id]);

		$emailbody = self::getEmailTemplate($mode);
		$emailsubject = false;
		$strtemplate = new Vtiger_StringTemplate();

		// Group message?
		if(count($userinfos) > 1) {
			$strtemplate->assign('MESSAGETO_USERNAME', $mod_strings['LBL_MAIL_GROUP_SALUTATION']);

			if($mode == 'New') {
				$emailsubject = $mod_strings['LBL_MAIL_SUBJECT_PREFIX'] . decode_html($fromuserinfo['user_name']) . 
					$mod_strings['LBL_MAIL_SUBJECT_NEW_SUFFIX_FORYOU'];
			} else {
				$emailsubject = $mod_strings['LBL_MAIL_SUBJECT_PREFIX'] . decode_html($fromuserinfo['user_name']) . 
					$mod_strings['LBL_MAIL_SUBJECT_REPLY_SUFFIX_FORYOU'];
			}

		} else {
			// Direct message
			$otheruserinfo = array_values($userinfos);
			$otheruserinfo = $otheruserinfo[0];
			$strtemplate->assign('MESSAGETO_USERNAME', $otheruserinfo['user_name']);

			if($mode == 'New') {
				$emailsubject = $mod_strings['LBL_MAIL_SUBJECT_PREFIX'] . decode_html($fromuserinfo['user_name']) . 
					$mod_strings['LBL_MAIL_SUBJECT_NEW_SUFFIX_FORYOU'];
			} else {
				$emailsubject = $mod_strings['LBL_MAIL_SUBJECT_PREFIX'] . decode_html($fromuserinfo['user_name']) . 
					$mod_strings['LBL_MAIL_SUBJECT_REPLY_SUFFIX_FORYOU'];
			}
		}
		$strtemplate->assign('MESSAGEFROM_USERNAME', $fromuserinfo['user_name']);
		$strtemplate->assign('MESSAGE_URL', self::getMessageURL($focus->id));
		$strtemplate->assign('MESSAGE_SUBJECT', decode_html($focus->column_fields['subject']));
		if($strtemplate->get('MESSAGE_SUBJECT') == '') $strtemplate->assign('MESSAGE_SUBJECT', ' ');
		$strtemplate->assign('MESSAGE_CONTENT', decode_html($focus->column_fields['message']));

		$mailer = new Vtiger_Mailer();
		$mailer->IsHTML(true);
		$mailer->ConfigSenderInfo(decode_html($fromuserinfo['email1']), decode_html($fromuserinfo['user_name']));
		$mailer->Subject = $emailsubject;
		$mailer->Body = $strtemplate->merge($emailbody);

		$mailer->Host 	  = $current_user->cf_614;
		$mailer->Username = $current_user->email1;
		$mailer->Password = $current_user->cf_617;
		
		foreach($userinfos as $userid=>$userinfo) {
			$mailer->AddAddress(
				decode_html($userinfo['email1']), 
				decode_html($userinfo['user_name'])
			);
		}

		return $mailer->Send(true);
	}
}

?>
