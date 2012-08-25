<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/

$__DART_CONFIG = array(
	
	/** Configuration for mailing, make sure Outgoing Server is setup */
	'mail.subject' => '[ubiwire CRM] Activity update for $date$',
	'mail.subject.noactivity' => '[ubiwire CRM] No activity detected for $date$',
	//'mail.from'    => 'noreply@company.com',
	'mail.fromname'=> 'ubiwire 工作日报表',

	'mail.to'      => array( 'manager@company.com' ),
	
	//'mail.cc'      => array( 'services@company.com' ),
	//'mail.replyto' => 'replyto@company.com',
	
	// Is outgoing server setup with sendmail?
	'mail.sendmail' => false,
);

?>