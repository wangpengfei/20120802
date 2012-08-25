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
* $Header: /advent/projects/wesat/vtiger_crm/sugarcrm/modules/Dashboard/language/en_us.lang.php,v 1.4 2005/01/25 06:01:38 jack Exp $
* Description:  Defines the English language pack for the Account module.
* Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
* All Rights Reserved.
* Contributor(s): ______________________________________..
********************************************************************************/

$mod_strings = Array(
	'accountstatistics' => '依照负责人显示客户',
	'leadsstatistics' => '依照负责人显示潜在客户',
'LBL_SALES_STAGE_FORM_TITLE' => '销售阶段统计',
'LBL_SALES_STAGE_FORM_DESC' => '显示选择的客服策略、用户累计客服数量在指定期间内预期要结案.',
'LBL_MONTH_BY_OUTCOME' => '月客服统计',
'LBL_MONTH_BY_OUTCOME_DESC' => '显示选取用户于指定期间的对外按月累计销售机会，对外指的是根据客服策略判断优劣.',
'LBL_LEAD_SOURCE_FORM_TITLE' => '经由接触来源的销售机会',
'LBL_LEAD_SOURCE_FORM_DESC' => '显示选取用户潜在客户来源的累计销售机会数量.',
'LBL_LEAD_SOURCE_BY_OUTCOME' => '按潜在客户来源显示销售机会',
'LBL_LEAD_SOURCE_BY_OUTCOME_DESC' => '显示累计销售机会金额，按选定潜在客户来源和结果，针对销售机会预期关闭日期在指定的日期范围内，结果是依据销售阶段是否处于签单、丢单或别的',
'LBL_PIPELINE_FORM_TITLE_DESC' => '显示预期在指定期间结案的销售阶段销售机会数量.',
'LBL_DATE_RANGE' => '日期范围从',
'LBL_DATE_RANGE_TO' => '到',
'ERR_NO_OPPS' => '请新增销售机会，然后才能看见销售机会图.',
'LBL_TOTAL_PIPELINE' => '总处理数 ',
'LBL_ALL_OPPORTUNITIES' => '销售机会总数',
'LBL_OPP_SIZE' => '预算在1万元以下的销售机会',
'LBL_OPP_SIZE_VALUE' => '1K',
'NTC_NO_LEGENDS' => '无',
'LBL_LEAD_SOURCE_OTHER' => '其它',
'LBL_EDIT' => '编辑',
'LBL_REFRESH' => '更新画面',
'LBL_CREATED_ON' => '最后执行 ',
'LBL_OPPS_IN_STAGE' => '销售机会的客服场地',
'LBL_OPPS_IN_LEAD_SOURCE' => '销售机会的接触来源',
'LBL_OPPS_OUTCOME' => '该销售机会的处理结果',
'LBL_USERS' => '用户：',
'LBL_SALES_STAGES' => '客服场地：',
'LBL_LEAD_SOURCES' => '接触来源：',
'LBL_DATE_START' => '开始日期：',
'LBL_DATE_END' => '结束日期：',
//Added for 5.0 
'LBL_NO_PERMISSION' => '您没有查看这个模块图形的权限',
'LBL_NO_PERMISSION_FIELD' => '您没有查看这个模块或字段图形的权限',

'leadsource' => '依照来源显示潜在客户',
'leadstatus' => '依照状态显示潜在客户',
'leadindustry' => '依照行业显示潜在客户',
'salesbyleadsource' => '依照潜在客户来源显示业绩',
'salesbyaccount' => '依照客户显示业绩',
'salesbyuser' => '依照业务显示业绩',
'salesbyteam' => '依照团队显示业绩',
'accountindustry' => '依照行业类别显示客户',
'productcategory' => '依照类别显示产品',
'productbyqtyinstock' => '依照库存数量显示产品',
'productbypo' => '依照采购订单显示产品',
'productbyquotes' => '依照报价单显示产品',
'productbyinvoice' => '依照发票显示产品',
'sobyaccounts' => '依照客户显示销售订单',
'sobystatus' => '依照状态显示销售订单',
'pobystatus' => '依照状态显示采购订单',
'quotesbyaccounts' => '依照客户显示报价单',
'quotesbystage' => '依照销售阶段显示报价单',
'invoicebyacnts' => '依照公司显示发票',
'invoicebystatus' => '依照状态显示发票',
'ticketsbystatus' => '依照状态显示问题单',
'ticketsbypriority' => '依照优先级显示问题单',
'ticketsbycategory' => '依照类别显示问题单',
'ticketsbyuser' => '依照业务显示问题单',
'ticketsbyteam' => '依照团队显示问题单',
'ticketsbyproduct' => '依照产品显示问题单',
'contactbycampaign' => '依照活动显示联系人',
'ticketsbyaccount' => '依照客户显示问题单',
'ticketsbycontact' => '依照联系人显示问题单',
'LBL_DASHBRD_HOME' => '仪表盘首页',
'LBL_HORZ_BAR_CHART' => '水平长条图',
'LBL_VERT_BAR_CHART' => '垂直长条图',
'LBL_PIE_CHART' => '圆饼图',
'LBL_NO_DATA' => '没有资料',
'DashboardHome' => '仪表盘首页',
'GRIDVIEW' => '格状视图',
'NORMALVIEW' => '一般视图',
'VIEWCHART' => '视图图表',

'LBL_DASHBOARD' => '仪表盘',
"Approved"=>"已审核",
"Created"=>"已提交",
"Cancelled"=>"已取消",
"Delivered"=>"已交付",
"Received Shipment"=>"被接受的发货",
"Sent"=>"发送",
"Credit Invoice"=>"信用发货票",
"Paid"=>"有偿",
"Un Assigned"=>"没有被分配",
"Cold Call"=>"备用电话",
"Existing Customer"=>"现有的客户",
"Self Generated"=>"自行联系的",
"Employee"=>"员工",
"Partner"=>"合作伙伴",
"Public Relations"=>"公共关系",
"Direct Mail"=>"直邮",
"Conference"=>"研讨会",
"Trade Show"=>"商业展览",
"Web Site"=>"网站",
"Word of mouth"=>"口传",
"Other"=>"其他",
"--None--"=>"无",
"Attempted to Contact"=>"偿试联系",
"Cold"=>"冷淡",
"Contact in Future"=>"以后联系",
"Contacted"=>"联系中",
"Hot"=>"关系火热",
"Junk Lead"=>"不好的潜在客户",
"Lost Lead"=>"丢失的潜在客户",
"Not Contacted"=>"没有联系",
"Pre Qualified"=>"资格预审",
"Qualified"=>"符合",
"Warm"=>"很好",
"Apparel"=>"服装",
"Banking"=>"银行业务",
"Biotechnology"=>"生物工艺",
"Chemicals"=>"化工制品",
"Communications"=>"通信",
"Construction"=>"建筑",
"Consulting"=>"咨询",
"Education"=>"教育",
"Electronics"=>"电子",
"Energy"=>"能源",
"Engineering"=>"工程",
"Entertainment"=>"娱乐",
"Environmental"=>"环保",
"Finance"=>"财务",
"Food Beverage"=>"食品、饮料",
"Government"=>"政府",
"Healthcare"=>"医疗保健",
"Hospitality"=>"医院",
"Insurance"=>"保险",
"Machinery"=>"机械",
"Manufacturing"=>"制造业",
"Media"=>"媒介",
"Not For Profit"=>"非盈利",
"Recreation"=>"休闲",
"Retail"=>"零售业",
"Shipping"=>"航运",
"Technology"=>"技术",
"Telecommunications"=>"电信",
"Transportation"=>"交通运输",
"Utilities"=>"公共事业",
"Hardware"=>"硬件",
"Software"=>"软件",
"CRM Applications"=>"CRM 应用",

"Open"=>"开启",
"In Progress"=>"处理中",
"Wait For Response"=>"等待回应",
"Closed"=>"关闭",

"Low"=>"低",
"Normal"=>"一般",
"High"=>"高",
"Urgent"=>"紧急",
"Big Problem"=>"大问题",
"Small Problem"=>"小问题",
"Other Problem"=>"其他问题",

"Accepted"=>"接受",
"Rejected"=>"拒绝",

'Prospecting' => '有意向',
'Qualification' => '预审合格',
'Needs Analysis' => '需求分析',
'Value Proposition' => '价格比较',
'Id. Decision Makers' => '决定决策者',
'Perception Analysis' => '品牌分析',
'Proposal/Price Quote' => '方案书/报价单',
'Negotiation/Review' => '谈判/审查',
'Closed Won' => '签单',
'Closed Lost' => '丢单',


'AutoCreated' => '自动建立',
'Created' => '已建立',
'Approved' => '已审核',
'Sent' => '已发送',
'Credit Invoice' => '贷方发票',
'Paid' => '已付款',
);

?>
