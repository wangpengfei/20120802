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

'Adjustment' => '调整',
'Sub Total' => '小计',
'Tax Type' => '税种',
'Discount Percent' => '折价百分比',
'Discount Amount' => '折价金额',
'S&H Amount' => '总金额',
'Currency' => '货币',
'Conversion Rate' => '转换率',

'PurchaseOrder No' => '采购订单编号',
'LBL_MODULE_NAME' => '采购订单',
'LBL_RELATED_PRODUCTS' => '产品详情',
'LBL_MODULE_TITLE' => '采购订单：首页',
'LBL_SEARCH_FORM_TITLE' => '搜寻采购订单',
'LBL_LIST_FORM_TITLE' => '采购订单列表',
'LBL_NEW_FORM_TITLE' => '新增采购订单',
'LBL_MEMBER_ORG_FORM_TITLE' => '成员组织',

'LBL_LIST_ACCOUNT_NAME' => '客户名称',
'LBL_LIST_CITY' => '乡镇市区',
'LBL_LIST_WEBSITE' => '网站',
'LBL_LIST_STATE' => '省市',
'LBL_LIST_PHONE' => '电话',
'LBL_LIST_EMAIL_ADDRESS' => '电子邮件',
'LBL_LIST_CONTACT_NAME' => '联系人名称',

//DON'T CONVERT THESE THEY ARE MAPPINGS
'db_name' => 'LBL_LIST_ACCOUNT_NAME',
'db_website' => 'LBL_LIST_WEBSITE',
'db_billing_address_city' => 'LBL_LIST_CITY',

//END DON'T CONVERT

'LBL_ACCOUNT' => '客户：',
'LBL_ACCOUNT_NAME' => '客户名称：',
'LBL_PHONE' => '电话：',
'LBL_WEBSITE' => '网站：',
'LBL_FAX' => '传真：',
'LBL_TICKER_SYMBOL' => '传票符号：',
'LBL_OTHER_PHONE' => '其它电话：',
'LBL_ANY_PHONE' => '电话：',
'LBL_MEMBER_OF' => '群组：',
'LBL_EMAIL' => '电子信箱：',
'LBL_EMPLOYEES' => '员工人数：',
'LBL_OTHER_EMAIL_ADDRESS' => '其它电子信箱：',
'LBL_ANY_EMAIL' => '电子信箱：',
'LBL_OWNERSHIP' => '负责人：',
'LBL_RATING' => '评分：',
'LBL_INDUSTRY' => '行业类别：',
'LBL_SIC_CODE' => '标准行业分类编码：',
'LBL_TYPE' => '类型：',
'LBL_ANNUAL_REVENUE' => '年收入：',
'LBL_ADDRESS_INFORMATION' => '住址信息',
'LBL_Quote_INFORMATION' => '客户信息',
'LBL_CUSTOM_INFORMATION' => '自定义信息',
'LBL_BILLING_ADDRESS' => '发票住址：',
'LBL_SHIPPING_ADDRESS' => '送货住址：',
'LBL_ANY_ADDRESS' => '其它住址：',
'LBL_CITY' => '乡镇市区：',
'LBL_STATE' => '省市：',
'LBL_POSTAL_CODE' => '邮政编码：',
'LBL_COUNTRY' => '国家：',
'LBL_DESCRIPTION_INFORMATION' => '说明信息',
'LBL_TERMS_INFORMATION' => '期限与条件',
'LBL_DESCRIPTION' => '说明：',
'NTC_COPY_BILLING_ADDRESS' => '复制发票地址到送货地址',
'NTC_COPY_SHIPPING_ADDRESS' => '复制送货地址到送货发票地址',
'NTC_REMOVE_MEMBER_ORG_CONFIRMATION' => '您确定要删除这笔数据？',
'LBL_DUPLICATE' => '客户数据重复',
'MSG_DUPLICATE' => '建立这个客户数据可能与现有数据重复，您可以选择将数据归属于下面其中一个项目中，或是点选建立新客户来透过刚刚输入的数据建立新项目。',

'LBL_INVITEE' => '联系人',
'ERR_DELETE_RECORD' => '必须指定数据编号才能删除客户。',
'LBL_SELECT_ACCOUNT' => '选择客户',
'LBL_GENERAL_INFORMATION' => '一般信息',

//for v4 release added
'LBL_NEW_POTENTIAL' => '新销售机会',
'LBL_POTENTIAL_TITLE' => '销售机会',
'LBL_NEW_TASK' => '新任务',
'LBL_TASK_TITLE' => '任务',
'LBL_NEW_CALL' => ' 安排电话联系',
'LBL_CALL_TITLE' => '电话联系',
'LBL_NEW_MEETING' => '新增会议',
'LBL_MEETING_TITLE' => '会议',
'LBL_NEW_EMAIL' => '发送电子邮件',
'LBL_EMAIL_TITLE' => '电子邮件',
'LBL_NEW_CONTACT' => '新增联系人',
'LBL_CONTACT_TITLE' => '联系人',

//Added vtiger_fields after RC1 - Release
'LBL_ALL' => '全部',
'LBL_PROSPECT' => '预期',
'LBL_INVESTOR' => '投资者',
'LBL_RESELLER' => '经销商',
'LBL_PARTNER' => '合作伙伴',

// Added for 4GA
'LBL_TOOL_FORM_TITLE' => '客户管理工具',
//Added for 4GA
'Subject' => '主题',
'Quote Name' => '报价单名称',
'Vendor Name' => '厂商名称',
'Requisition No' => '申请书编号',
'Tracking Number' => '追踪编号',
'Contact Name' => '联系人名称',
'Due Date' => '到期日',
'Carrier' => '货运商',
'Type' => '类型',
'Sales Tax' => '销售税额',
'Sales Commission' => '销售佣金',
'Excise Duty' => '消费税',
'Total' => '总计',
'Product Name' => '产品名称',
'Assigned To' => '负责人',
'Billing Address' => '付款住址',
'Shipping Address' => '送货住址',
'Billing City' => '[付款住址]乡镇市区',
'Billing State' => '[付款住址]省市',
'Billing Code' => '[付款住址]邮政编码',
'Billing Country' => '[付款住址]国家',
'Billing Po Box' => '[付款住址]采购订单信箱',
'Shipping Po Box' => '[送货住址]采购订单信箱',
'Shipping City' => '[送货住址]乡镇市区',
'Shipping State' => '[送货住址]省市',
'Shipping Code' => '[送货住址]邮政编码',
'Shipping Country' => '[送货住址]国家',
'City' => '乡镇市区',
'State' => '省市',
'Code' => '邮政编码',
'Country' => '国家',
'Created Time' => '创建时间',
'Modified Time' => '修改时间',
'Description' => '说明',
'Potential Name' => '销售机会名称',
'Customer No' => '客户编号',
'Purchase Order' => '采购订单',
'Vendor Terms' => '厂商条件',
'Pending' => '待定',
'Account Name' => '客户名称',
'Terms & Conditions' => '期限与条件',
//Quote Info
'LBL_PO_INFORMATION' => '采购订单信息',
'LBL_PO' => '采购订单：',

//Added for 4.2 GA
'LBL_SO_FORM_TITLE' => '业务',
'LBL_PO_FORM_TITLE' => '采购',
'LBL_SUBJECT_TITLE' => '主题',
'LBL_VENDOR_NAME_TITLE' => '厂商名称',
'LBL_TRACKING_NO_TITLE' => '追踪编号',
'LBL_PO_SEARCH_TITLE' => '搜寻采购订单',
'LBL_SO_SEARCH_TITLE' => '搜寻销售订单',
'LBL_QUOTE_NAME_TITLE' => '报价单名称',
'Order Id' => '订单编号',
'Status' => '状态',
'PurchaseOrder' => '采购订单',
'LBL_MY_TOP_PO' => '进行中的最佳采购订单',

//Added for existing Picklist Entries

'FedEx'=>'FedEx',
'UPS'=>'UPS',
'USPS'=>'USPS',
'DHL'=>'DHL',
'BlueDart'=>'BlueDart',

'Created' => '已创建',
'Approved' => '已审核',
'Delivered' => '已递送',
'Cancelled' => '已取消',
'Received Shipment' => '收到发货',
);

?>
