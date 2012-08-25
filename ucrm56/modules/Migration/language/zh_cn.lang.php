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


$mod_strings = Array(
'LBL_MIGRATE_INFO' => '输入升级数据，从 <b><i> 来源版本 </i></b> 升级到 <b><i> 最新版本的vtigerCRM </i></b>',
'LBL_CURRENT_VT_MYSQL_EXIST' => '目前 vtiger 的数据库存在于',
'LBL_THIS_MACHINE' => '这台机器',
'LBL_DIFFERENT_MACHINE' => '不同机器',
'LBL_CURRENT_VT_MYSQL_PATH' => '目前 vtiger 的数据库路径',
'LBL_SOURCE_VT_MYSQL_DUMPFILE' => 'vtiger <b>来源版本</b> 导出资料的文件名称',
'LBL_NOTE_TITLE' => '备注：',
'LBL_NOTES_LIST1' => '如果目前的数据库是在同一台机器，输入数据库路径（或）输入导出数据的文件名称。',
'LBL_NOTES_LIST2' => '如果目前的数据库存在于不同机器，输入（来源）导出数据的文件名称与完整路径。',
'LBL_NOTES_DUMP_PROCESS' => '要将数据库导出，请参考下面指令：<br><b>mysqldump --user="mysql_username"  --password="mysql-password" -h "hostname"  --port="mysql_port" "database_name" > dump_filename</b><br>新增 <b>SET_FOREIGN_KEY_CHECKS = 0;</b> -- 到档案开始的地方<br>新增 <b>SET_FOREIGN_KEY_CHECKS = 1;</b> -- 到档案结束的地方',
'LBL_NOTES_LIST3' => '提供数据库的路径，像是 <b>/home/crm/vtigerCRM4_5/mysql</b>',
'LBL_NOTES_LIST4' => '提供导出数据的档案路径，像是 <b>/home/fullpath/4_2_dump.txt</b>',

'LBL_CURRENT_MYSQL_PATH_FOUND' => '找到目前版本的数据库路径。',
'LBL_SOURCE_HOST_NAME' => '来源主机名称：',
'LBL_SOURCE_MYSQL_PORT_NO' => '来源数据库连接端口：',
'LBL_SOURCE_MYSQL_USER_NAME' => '来源数据库账号：',
'LBL_SOURCE_MYSQL_PASSWORD' => '来源数据库密码：',
'LBL_SOURCE_DB_NAME' => '来源数据库名称：',
'LBL_MIGRATE' => '升级到最新版本',
//Added after 5 Beta 
'LBL_UPGRADE_VTIGER' => '升级 vtiger CRM 数据库',
'LBL_UPGRADE_FROM_VTIGER_423' => '将数据库从 vtiger CRM 4.2.3 升级到 5.0.0',
'LBL_SETTINGS' => '设定',
'LBL_STEP' => '步骤',
'LBL_SELECT_SOURCE' => '选择来源',
'LBL_STEP1_DESC' => '要开始数据库移转，您必须指定旧有数据的格式',
'LBL_RADIO_BUTTON1_TEXT' => '我有 vtiger CRM 数据库系统的权限',
'LBL_RADIO_BUTTON1_DESC' => '这个选项需要主机（数据库所在）地址与数据库权限详情，这个方法同时支持本地与远程系统，详情请参考文件说明。',
'LBL_RADIO_BUTTON2_TEXT' => '我有 vtiger CRM 数据库备份',
'LBL_RADIO_BUTTON2_DESC' => '这个选项需要有数据库备份文件在同一台机器来进行升级，您无法存取不同主机（远程数据库服务器）的备份数据，详情请参考文件说明。',
'LBL_RADIO_BUTTON3_TEXT' => '我有新的数据库包含 4.2.3 数据',
'LBL_RADIO_BUTTON3_DESC' => '这个选项需要 vtiger CRM 4.2.3 数据库系统详情，包含服务器编号、账号与密码，您无法存取不同主机（远程数据库服务器）的备份数据。',

'LBL_HOST_DB_ACCESS_DETAILS' => '主机数据库存取权限',
'LBL_MYSQL_HOST_NAME_IP' => 'MySQL 主机名称或IP地址：',
'LBL_MYSQL_PORT' => 'MySQL 连接埠编号：',
'LBL_MYSQL_USER_NAME' => 'MySql 账号：',
'LBL_MYSQL_PASSWORD' => 'MySql 密码：',
'LBL_DB_NAME' => '数据库名称：',

'LBL_LOCATE_DB_DUMP_FILE' => '数据库备份文件',
'LBL_DUMP_FILE_LOCATION' => '备份文件位置：',

'LBL_RADIO_BUTTON3_PROCESS'=>'<font color="red">Please do not specify the 4.2.3 database details. This option will alter the given database directly.</font>
<br>It is strongly recommended that to do the following.
<br>1. Take a dump of your 4.2.3 database
<br>2. Create new database (Better is to create a database in the server where your vtiger 5.0 Database is running.)
<br>3. Apply this 4.2.3 dump to this new database.
<br>Now give this new database access details. This migration will modify this Database to fit with the 5.0 Schema.
Then you can give this Database name in config.inc.php file to use this Database ie., $dbconfig[\'db_name\'] = \'new db name\';',
'LBL_ENTER_MYSQL_SERVER_PATH' => '输入 MySQL 服务器路径',
'LBL_SERVER_PATH_DESC' => 'MySQL 在服务器的路径，像是 <b>/home/5beta/vtigerCRM5_beta/mysql/bin</b> 或 <b>c:\Program Files\mysql\bin</b>',
'LBL_MYSQL_SERVER_PATH' => 'MySQL 服务器路径：',
'LBL_MIGRATE_BUTTON' => '转换',
'LBL_CANCEL_BUTTON' => '取消',
'LBL_UPGRADE_FROM_VTIGER_5X' => '升级 vtiger CRM 5.x 数据库到下一个版本',
'LBL_PATCH_OR_MIGRATION' => '您必须指定来源数据库的版本（修补程序更新或是转换）',
//Added for java script alerts
'ENTER_SOURCE_HOST' => '请输入源主机名称',
'ENTER_SOURCE_MYSQL_PORT' => '请输入源主机MYSQL名称',
'ENTER_SOURCE_MYSQL_USER' => '请输入mysql的用户名',
'ENTER_SOURCE_DATABASE' => '请输入数据库密码',
'ENTER_SOURCE_MYSQL_DUMP' => '请输入有效的mysql转储文件',
'ENTER_HOST' => '请输入主机名称',
'ENTER_MYSQL_PORT' => '请输入mysql的端口号',
'ENTER_MYSQL_USER' => '请输入mysql的用户名',
'ENTER_DATABASE' => '请输入数据库名',
'SELECT_ANYONE_OPTION' => '请选择其中的任何一个选项',
'ENTER_CORRECT_MYSQL_PATH' => '请输入正确的mysql路径',

);






?>
