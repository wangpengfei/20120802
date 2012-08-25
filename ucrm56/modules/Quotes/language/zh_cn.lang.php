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
* $Header$
* Description:  Defines the English language pack 
* Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
* All Rights Reserved.
* Contributor(s): ______________________________________..
********************************************************************************/

$mod_strings = Array(
'Qty'=>'数量',
'Net Total'=>'总净额',
'Grand Total : ( $)'=>'总计金额：(  $)',
'Grand Total : ( ￥)'=>'总计金额 : ( ￥)',
'Shipping & Handling Charges'=>'运费和手续费：',
'Shipping & Handling Tax:'=>'运费和手续费 税:',

'Quantity'=>'数量',
'Issued Date' => '填开日期',

'Quote No' => '报价编号',
'Adjustment' => '调整',
'Sub Total' => '小计',
'Tax Type' => '税种',
'Discount Percent' => '折价百分比',
'Discount Amount' => '折价金额',
'S&H Amount' => '总金额',
'Currency' => '货币',
'Conversion Rate' => '转换率',

'LBL_MODULE_NAME' => '报价单',
'LBL_MODULE_TITLE' => '报价单： 首页',
'LBL_SEARCH_FORM_TITLE' => '搜寻报价单',
'LBL_LIST_FORM_TITLE' => '报价单列表',
'LBL_NEW_FORM_TITLE' => '新增报价单',
'LBL_MEMBER_ORG_FORM_TITLE' => '会员所属单位',

'LBL_LIST_ACCOUNT_NAME' => '客户名称',
'LBL_RELATED_PRODUCTS' => '在线清单',
'LBL_LIST_CITY' => '乡镇市区',
'LBL_LIST_WEBSITE' => '网站',
'LBL_LIST_STATE' => '省市',
'LBL_LIST_PHONE' => '电话',
'LBL_LIST_EMAIL_ADDRESS' => '电子邮件地址',
'LBL_LIST_CONTACT_NAME' => '联系人名称',

//DON'T CONVERT THESE THEY ARE MAPPINGS
'db_name' => 'LBL_LIST_ACCOUNT_NAME',
'db_website' => 'LBL_LIST_WEBSITE',
'db_billing_address_city' => 'LBL_LIST_CITY',

//END DON'T CONVERT

'LBL_ACCOUNT'=>'客户:',
'LBL_PHONE'=>'电话:',
'LBL_WEBSITE'=>'网站:',
'LBL_FAX'=>'传真:',
'LBL_TICKER_SYMBOL' => '传票符号：',
'LBL_OTHER_PHONE' => '其它电话：',
'LBL_ANY_PHONE' => '电话：',
'LBL_MEMBER_OF' => '会员：',
'LBL_EMAIL' => '电子邮件：',
'LBL_EMPLOYEES' => '员工：',
'LBL_OTHER_EMAIL_ADDRESS' => '其它电子邮件：',
'LBL_ANY_EMAIL' => '电子邮件：',
'LBL_OWNERSHIP' => '负责人：',
'LBL_RATING' => '级别：',
'LBL_INDUSTRY' => '行业：',
'LBL_SIC_CODE' => '标准行业分类编码：',
'LBL_TYPE' => '类型：',
'LBL_ANNUAL_REVENUE' => '年收益：',
'LBL_ADDRESS_INFORMATION' => '地址信息',
'LBL_Quote_INFORMATION' => '客户信息',
'LBL_CUSTOM_INFORMATION' => '客制信息',
'LBL_BILLING_ADDRESS' => '发票地址：',
'LBL_SHIPPING_ADDRESS' => '送货地址：',
'LBL_ANY_ADDRESS' => '任一地址：',
'LBL_CITY' => '乡镇市区：',
'LBL_STATE' => '省市：',
'LBL_POSTAL_CODE' => '邮政编码：',
'LBL_COUNTRY' => '国家：',
'LBL_DESCRIPTION_INFORMATION' => '详情内容',
'LBL_DESCRIPTION' => '描述：',
'NTC_COPY_BILLING_ADDRESS' => '复制发票地址到送货地址',
'NTC_COPY_SHIPPING_ADDRESS' => '复制送货地址到发票地址',
'NTC_REMOVE_MEMBER_ORG_CONFIRMATION' => '你确定要移除这笔会员所属单位记录?',
'LBL_DUPLICATE' => '销售机会内容复制到客户',
'MSG_DUPLICATE' => '建立这笔客户数据来自于销售机会内容，您可以点选公司列表中的公司以复制建立新的公司，并且继承它的相关数据。',

'LBL_INVITEE' => '联系人',
'ERR_DELETE_RECORD' => '要删除账号你必须指定一笔记录编号.',

'LBL_SELECT_ACCOUNT' => '选择客户',
'LBL_GENERAL_INFORMATION' => '一般信息',

//for v4 release added
'LBL_NEW_POTENTIAL' => '新增销售机会',
'LBL_POTENTIAL_TITLE' => '销售机会',

'LBL_NEW_TASK' => '新增任务',
'LBL_TASK_TITLE' => '任务',
'LBL_NEW_CALL' => '新增电话记录',
'LBL_CALL_TITLE' => '电话记录',
'LBL_NEW_MEETING' => '新增会议记录',
'LBL_MEETING_TITLE' => '会议',
'LBL_NEW_EMAIL' => '新增电子邮件',
'LBL_EMAIL_TITLE' => '邮件',
'LBL_NEW_CONTACT' => '新增联系人',
'LBL_CONTACT_TITLE' => '联系人',

//Added vtiger_fields after RC1 - Release
'LBL_ALL' => '全部',
'LBL_PROSPECT' => '期望',
'LBL_INVESTOR' => '投资者',
'LBL_RESELLER' => '转售人',
'LBL_PARTNER' => '伙伴',

// Added for 4GA
'LBL_TOOL_FORM_TITLE' => '客户工具',
//Added for 4GA
'Subject' => '标题',
'Potential Name' => '销售机会名称',
'Quote Stage' => '报价单状态',
'Valid Till' => '有效期至',
'Team' => '团队',
'Contact Name' => '联系人名称',
'Currency' => '货币',
'Carrier' => '承运单位',
'Sub Total' => '小计',
'Shipping' => '运费',
'Inventory Manager' => '库存管理员',
'Type' => '类型',
'Tax' => '税',
'Total' => '总计',
'Product Name' => '商品名称',
'Assigned To' => '负责人',
'Billing Address' => '发票地址',
'Shipping Address' => '送货地址',
'Billing City' => '[发票地址]乡镇市区',
'Billing State' => '[发票地址]市（县）',
'Billing Code' => '[发票地址]邮政编码',
'Billing Country' => '[发票地址]省（市/自治区）',
'Billing Po Box' => '[发票地址]采购订单信箱',
'Shipping Po Box' => '[送货地址]采购订单信箱',
'Shipping City' => '[送货地址]乡镇市区',
'Shipping State' => '[送货地址]市（县）',
'Shipping Code' => '[送货地址]邮政编码',
'Shipping Country' => '[送货地址]省（市/自治区）',
'Created Time' => '创建时间',
'Modified Time' => '修改时间',
'Description' => '描述',
'Account Name' => '客户名称',
'Terms & Conditions' => '期限与条件',
//Quote Info
'LBL_QUOTE_INFORMATION' => '报价单信息',
'LBL_TERMS_INFORMATION' => '期限与条件',
'LBL_QUOTE' => '报价单：',

//Added during 4.2 release
'LBL_SUBJECT' => '主题：',
'LBL_POTENTIAL_NAME' => '销售机会名称：',
'LBL_QUOTE_STAGE' => '报价策略：',
'LBL_MY_TOP_QUOTE' => '我进行中的最佳报价单',
'Quote ID' => '报价单编号',
//'Quote ID'=>'Quote Id',
'Quote' => '报价单',

//Added for existing Picklist Entries

'Created' => '已建立',
'Delivered' => '已递送',
'Reviewed' => '已审阅',
'Accepted' => '已接受',
'Rejected' => '被拒绝',
'FedEx' => 'FedEx',
'UPS' => 'UPS',
'USPS' => 'USPS',
'DHL' => 'DHL',
'BlueDart' => 'BlueDart',
'Sales Tax'=>'销售税',                       


);

?>
