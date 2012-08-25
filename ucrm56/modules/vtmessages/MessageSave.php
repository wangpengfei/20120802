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
require_once("modules/$currentModule/$currentModule.php");

$messagemode = $_REQUEST['messagemode'];
$mode = $_REQUEST['mode'];
$record=$_REQUEST['record'];

$focus = new $currentModule();
$basefocus = false;

$SendMailNotification = false;
if($messagemode == 'Mark') {
	$mode = 'edit';
	$focus->retrieve_entity_info($record, $currentModule);
	$focus->column_fields['vtmsgstatus'] = $_REQUEST['vtmsgstatus'];
} else if($messagemode == 'Reply') {
	$basefocus = new $currentModule();
	$basefocus->retrieve_entity_info($record, $currentModule);
	$basefocus->id = $record;

	if($basefocus->column_fields['vtmsgstatus'] == 'Unread') {
		$basefocus->column_fields['vtmsgstatus'] = 'Read';
		$basefocus->mode='edit';
		$basefocus->save($currentModule);
	}

	setObjectValuesFromRequest($focus);

	$focus->column_fields['subject'] = $basefocus->column_fields['subject'];
	$focus->column_fields['assigned_user_id'] = $current_user->id;
	$focus->column_fields['relatedto']= $basefocus->id;

	$SendMailNotification = true;

} else {
	setObjectValuesFromRequest($focus);
	$focus->column_fields['assigned_user_id'] = $current_user->id;
	$SendMailNotification = true;
}

if($mode) $focus->mode = $mode;
if($record)$focus->id  = $record;

$focus->save($currentModule);

$notifyuserids = false;
if($messagemode == 'Reply') {
	$topicuserids = Array($basefocus->column_fields['assigned_user_id']);
	$focus->setTopicId($basefocus->getTopicId());
	$focus->linkWithTopic($topicuserids);

	$notifyuserids = $focus->getTopicUserIds();
} else if($messagemode == 'New') {
	$focus->setTopicId();
	// Current user and other users are part-of the topic
	$topicuserids = split(',', $_REQUEST['_tousers']);
	if(!$topicuserids) $topicuserids = Array();
	$topicuserids[] = $current_user->id;
	$focus->linkWithTopic($topicuserids);

	$notifyuserids = $topicuserids;
}

if($notifyuserids && $SendMailNotification) {
	include_once dirname(__FILE__) . '/MessageMailer.php';
	Message_Mailer::send($focus, $current_user, $messagemode, $notifyuserids);
}
echo "OK";

?>
