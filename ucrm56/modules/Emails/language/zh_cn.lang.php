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
* $Header: /advent/projects/wesat/vtiger_crm/sugarcrm/modules/Emails/language/en_us.lang.php,v 1.17 2005/03/28 06:31:38 rank Exp $
* Description:  Defines the English language pack for the Account module.
********************************************************************************/

$mod_strings = Array(
// Mike Crowe Mod --------------------------------------------------------added for general search
'No_Email_Title_Msg'=>'您没有指定此电子邮件的标题。如果你想提供，请输入',
'No_Email_Title'=>'( 标题 )',
'LBL_DELETE'=>'删除',
'LBL_GENERAL_INFORMATION' => '一般信息',
'Activtiy Type' => '发送类型',
'Access Count' => '允许数量',
'From' => '发件人',
'To' => '收件人',
'BCC' => '密送',
'CC' => '抄送',
'Email Flag' => '邮件标志',
'Parent ID' => '上级编号',
'LBL_MODULE_NAME' => '邮件',
'LBL_MODULE_TITLE' => '邮件： 首页',
'LBL_SEARCH_FORM_TITLE' => '搜寻邮件',
'LBL_LIST_FORM_TITLE' => '邮件列表',
'LBL_NEW_FORM_TITLE' => '追踪邮件',

'LBL_LIST_SUBJECT' => '标题',
'LBL_LIST_CONTACT' => '联系人',
'LBL_LIST_RELATED_TO' => '相关人事',
'LBL_LIST_DATE' => '发送日期',
'LBL_LIST_TIME' => '发送时间',

'ERR_DELETE_RECORD' => '必须有记录编号才能删除该笔账号.',
'LBL_DATE_SENT' => '发送日期：',
'LBL_DATE_AND_TIME' => '发送日期 & 时间：',
'LBL_DATE' => '发送日期：',
'LBL_TIME' => '发送时间：',
'LBL_SUBJECT' => '标题：',
'LBL_BODY' => '邮件内容：',
'LBL_CONTACT_NAME' => '联系人名称： ',
'LBL_EMAIL' => '邮件：',
'LBL_DETAILVIEW_EMAIL'=>'邮件', 
'LBL_COLON'=>':',
'LBL_CHK_MAIL'=>'查收邮件',
'LBL_COMPOSE'=>'撰写邮件',
//Single change for 5.0.3
'LBL_SETTINGS'=>'邮件服务器设置',
'LBL_EMAIL_FOLDERS'=>'邮件目录',
'LBL_INBOX' => '收件箱',
'LBL_SENT_MAILS'=>'邮件备份',
'LBL_TRASH' => '回收站',
'LBL_JUNK_MAILS' => '广告邮件',
'LBL_TO_LEADS' => '发至潜在客户',
'LBL_TO_CONTACTS' => '发至联系人',
'LBL_TO_ACCOUNTS' => '发至客户',
'LBL_MY_MAILS' => '我的邮件',
'LBL_QUAL_CONTACT' => '已转换邮件（转为联系人）',
'LBL_MAILS' => '邮件',
'LBL_QUALIFY_BUTTON' => '转换',
'LBL_REPLY_BUTTON' => '回复',
'LBL_FORWARD_BUTTON' => '转发',
'LBL_DOWNLOAD_ATTCH_BUTTON' => '下载附件文档',
'LBL_FROM' => '发件人：',
'LBL_CC' => '抄送：',
'LBL_BCC' => '密送：',

'NTC_REMOVE_INVITEE' => '您确定要移除这封来信？',
'LBL_INVITEE'=>'接收者',

// Added Fields
// Contacts-SubPanelViewContactsAndUsers.php
'LBL_BULK_MAILS' => '大量寄信',
'LBL_ATTACHMENT' => '附件',
'LBL_UPLOAD' => '上传',
'LBL_FILE_NAME' => '文件名称',
'LBL_SEND' => '发送',

'LBL_EMAIL_TEMPLATES' => '邮件样版',
'LBL_TEMPLATE_NAME' => '样版名称',
'LBL_DESCRIPTION' => '描述',
'LBL_EMAIL_TEMPLATES_LIST' => '邮件样版列表',
'LBL_EMAIL_INFORMATION' => '邮件信息',




//for v4 release added
'LBL_NEW_LEAD' => '新增潜在客户',
'LBL_LEAD_TITLE' => '潜在客户',

'LBL_NEW_PRODUCT' => '新增商品',
'LBL_PRODUCT_TITLE' => '商品',
'LBL_NEW_CONTACT' => '新增联系人',
'LBL_CONTACT_TITLE' => '联系人',
'LBL_NEW_ACCOUNT' => '新增公司',
'LBL_ACCOUNT_TITLE' => '公司',

// Added vtiger_fields after vtiger4 - Beta
'LBL_USER_TITLE' => '用户',
'LBL_NEW_USER' => '新增用户',

// Added for 4 GA
'LBL_TOOL_FORM_TITLE' => '邮件编辑器',
//Added for 4GA
'Date & Time Sent' => '发送日期 & 时间',
'Sales Enity Module' => '客服模块',

'Related To' => '相关人事',
'Assigned To' => '负责人',
'Subject' => '标题',
'Attachment' => '附件',
'Description' => '描述',
'Time Start' => '开始时间',
'Created Time' => '创建时间',
'Modified Time' => '修改时间',

'MESSAGE_CHECK_MAIL_SERVER_NAME' => '请检查电子邮件服务器名称...',
'MESSAGE_CHECK_MAIL_ID' => '请检查负责人的信箱编号...',
'MESSAGE_MAIL_HAS_SENT_TO_USERS' => '邮件将会发送给指定的用户：',
'MESSAGE_MAIL_HAS_SENT_TO_CONTACTS' => '邮件将会发送给指定的联系人：',
'MESSAGE_MAIL_ID_IS_INCORRECT' => '邮件格式不正确. 请检查这封邮件的Id...',
'MESSAGE_ADD_USER_OR_CONTACT' => '请新增其它位用户或联系人...',
'MESSAGE_MAIL_SENT_SUCCESSFULLY' => ' 邮件已顺利发送!',

// Added for web mail post 4.0.1 release
'LBL_FETCH_WEBMAIL' => '获取Web邮件',
//Added for 4.2 Release -- CustomView
'LBL_ALL' => '全部',
'MESSAGE_CONTACT_NOT_WANT_MAIL' => '这个联系人不希望收到邮件打扰',
'LBL_WEBMAILS_TITLE' => 'Web邮件标题',
'LBL_EMAILS_TITLE' => 'CRM邮件',
'LBL_MAIL_CONNECT_ERROR_INFO' => '联机到邮件服务器时发生错误，检查我的账号=>邮件服务器列表=>邮件账号',
'LBL_ALLMAILS' => '所有邮件',
'LBL_TO_USERS' => '发至用户',
'LBL_TO' => '收件人：',
'LBL_IN_SUBJECT' => '主题',
'LBL_IN_SENDER' => '发件人',
'LBL_IN_SUBJECT_OR_SENDER' => '主题 或发件人',
'SELECT_EMAIL' => '选择邮件字段',
'Sender' => '发件人',
'LBL_CONFIGURE_MAIL_SETTINGS' => '您的收件邮件服务器还没设定',
'LBL_MAILSELECT_INFO' => '有下面相关邮件字段，请选择要发送的邮件字段',
'LBL_MAILSELECT_INFO1' => '下面的邮件字段与选择的项目有关',
'LBL_MAILSELECT_INFO2' => '选择要发送的邮件字段类型',
'LBL_MULTIPLE' => '多选',
'LBL_COMPOSE_EMAIL' => '发送邮件',
'LBL_VTIGER_EMAIL_CLIENT'=>'CRM Webmail 客户端',

//Added for 5.0.3
'TITLE_VTIGERCRM_MAIL'=>'ubiCRM 邮件',
'TITLE_COMPOSE_MAIL'=>'撰写邮件',

'MESSAGE_MAIL_COULD_NOT_BE_SEND'=>'邮件不能发送到被分配的用户.',
'MESSAGE_PLEASE_CHECK_ASSIGNED_USER_EMAILID'=>'请检查被分配的用户电子邮件id...',
'MESSAGE_PLEASE_CHECK_THE_FROM_MAILID'=>'请检查电子邮件id',
'MESSAGE_MAIL_COULD_NOT_BE_SEND_TO_THIS_EMAILID'=>'邮件不能发送到这电子邮件id',
'PLEASE_CHECK_THIS_EMAILID'=>'请检查这邮件id...',
'LBL_CC_EMAIL_ERROR'=>'您的CC邮件ID不是适当的',
'LBL_BCC_EMAIL_ERROR'=>'您的BCC邮件ID不是适当的',
'LBL_NO_RCPTS_EMAIL_ERROR'=>'没有指定邮件接收人',
'LBL_CONF_MAILSERVER_ERROR'=>'请设置您外部的邮件服务器 ---> 外出的服务器链接',
'LBL_VTIGER_EMAIL_CLIENT'=>'外发邮件客户端',
'LBL_MAILSELECT_INFO3'=>'您不能查看选择记录的邮件ID.',
'LBL_NO_RECORDS' => '这个文件夹没有记录',
//Added  for script alerts
'FEATURE_AVAILABLE_INFO' => '这个功能目前只支持Microsoft Internet Explorer 5.5+或更高!',
'DOWNLOAD_CONFIRAMATION' => '您想要下载文件 ?',
'LBL_PLEASE_ATTACH' => '请再尝试附上一个合法的文件',
'LBL_KINDLY_UPLOAD' => '请配置 <font color="red">upload_tmp_dir</font> variable in php.ini file.',
'LBL_EXCEED_MAX' => '抱歉, 上传的文件超出最大值极限。请尝试一个小文件 ',
'LBL_BYTES' => ' 字节',
'LBL_CHECK_USER_MAILID' => '请检查当前用户的电邮ID是否正确',

// Added/Updated for vtiger CRM 5.0.4
'Activity Type'=>'任务类型',
'LBL_MAILSELECT_INFO'=>'有如下邮件格式的ID，请选一个您要发送的的邮件的邮箱',
'LBL_NO_RECORDS' => '没有邮件记录',
'LBL_PRINT_EMAIL'=> '打印',
);

?>
