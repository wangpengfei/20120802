/*********************************************************************************

** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ********************************************************************************/

	var alert_arr = {
	CHARGE_TOTAL_EQUAL_PO_TOTAL:"应付款总额已经等于总金额！",
	CHARGE_IS_NULL:"应付款不能为空或0！",
	CHARGE_TIMES_IS_NULL:"期次不能为空或0！",
	CHARGE_DATE_IS_NULL:"应付日期不能为空！",
	CHARGE_DATE:"应付日期",
	CHARGE_TIMES:"期次",
	CHARGE:"应付款",
	CHARGE_TOTAL_NOT_EQUAL_PO_TOTAL:"应付款和总金额不符！",
	COLLECTION_TOTAL_EQUAL_SALESORDER_TOTAL:"应收款总额已经等于总金额！",
	COLLECTION_IS_NULL:"应收款不能为空或0！",
	COLLECTION_TIMES_IS_NULL:"期次不能为空或0！",
	COLLECTION_DATE_IS_NULL:"应收日期不能为空！",
	COLLECTION_DATE:"应收日期",
	COLLECTION_TIMES:"期次",
	COLLECTION:"应收款",
	COLLECTION_TOTAL_NOT_EQUAL_SALESORDER_TOTAL:"应收款和总金额不符！",
	Merged_Contacts:'模板文档合并选定联系人数据',
	Need_ActiveX:'需要安装ActiveX插件支持，请确认您管理员权限！',
	Cannot_Get_Template:'无法获取邮件合并模板',
	Error_Merge_Operation:'处理邮件合并过程中发生错误',
	Return_Previous_Page:'返回到前一页',
	Here:'这里',
	Click:'点击',
	Higher_Brower:'这个功能只能支持IE5.5或更高的IE版本浏览器。',
	Failed_Becasuse:'保存失败原因：',
	MORE_THAN_100:'一次最多只能选择100个手机号',
	MORE_THAN_60:'一次最多只能发送60个字',
	EMPTY_TEMPLATE:'没有模板被发现，请先添加！',
	Number:'数字',
	Email:'电子邮箱',
	Integer:'整数',
	Time:'时间',
	User_Date_Fomart:'用户日期格式',
	Column:' 字段 ',
	Option:' 选项 ',
	To:'到',
	Condition:'条件',
	Display:'显示',
	Hide:'隐藏',
	Support_Start_Date:'支持开始日期',
	Start_Date:'开始日期',
	End_Date:'开始日期',
	Followup_Date:'跟踪日期',
    END_TIME : '结束时间',
	
	EMPTY_WIN_TITLE:'请输入窗口标题',
	EMPTY_RSS_URL:'请输入RSS URL',
	EMPTY_URL:'请输入URL',
	SELECT_TWO_FIELDS:'最多只能选两个字段',
	UNABLE_ADD_HOMESTUFF:'无法创建工作台',
	ERROR_DELETE:'删除失败，请重试',
	
		EMPTY_FOLDER:'空文档夹',
		EMPTY_MODULE_VIEW:'显示模块不能为空',
		CURRENT_DATE:'当前日期',
		CURRENT_TIME:'当前时间',
		CURRENT_DATE_TIME:'当前日期与时间',
		END_APPROVAL_CONFIRM:'下一审批人为空，你要结束该审批流程吗？',
		 DELETE:'确定要删除所选项目: ',
                                RECORDS:' 条记录?',
                                SELECT:'请至少选择一项',
                                DELETE_ACCOUNT:'删除客户信息会连带删除与其关联的潜在案件&报价。您确定要删除所选记录？ ',
                                DELETE_VENDOR:'删除此供应商将取消其相关的采购订单。您是否确实要删除所选 ',
                                SELECT_MAILID:'请选择一个邮件帐号',
                                OVERWRITE_EXISTING_ACCOUNT1:'覆盖现有的帐户(',
                                OVERWRITE_EXISTING_ACCOUNT2:')?',
				                OVERWRITE_EXISTING_CONTACT1:'覆盖所选择的地址？(',
                                OVERWRITE_EXISTING_CONTACT2:') 详细地址?',
                                MISSING_FIELDS:'所需字段缺失:',
                                NOT_ALLOWED_TO_EDIT:'您不可以编辑该字段',
                                NOT_ALLOWED_TO_EDIT_FIELDS:'您未被允许编辑该字段',
                                COLUMNS_CANNOT_BE_EMPTY:'所选栏不能为空',
                                CANNOT_BE_EMPTY:' 不能为空',
                                CANNOT_BE_NONE:' 不能为空',
                                ENTER_VALID:'请输入一个有效的 ',
                                SHOULDBE_LESS:' 应小于 ',
                                SHOULDBE_LESS_EQUAL:' 应小于或等于 ',
                                SHOULDBE_EQUAL:' 应等于',
                                SHOULDBE_GREATER:' 应大于 ',
                                SHOULDBE_GREATER_EQUAL:' 应大于或等于 ',
                                INVALID:'无效 ',
                                EXCEEDS_MAX:' 超出最大限制  ',
                                OUT_OF_RANGE:' 超出范围',
                                SHOULDNOTBE_EQUAL:' 不应等于 ',
                                PORTAL_PROVIDE_EMAILID:'门户用户应提供登录Email地址',
                                ADD_CONFIRMATION:'您确定要添加所选 ',
                                ACCOUNTNAME_CANNOT_EMPTY:'客户名称不能为空',
                                MOBILE_CANNOT_EMPTY:'手机不能为空',
                                CANT_SELECT_CONTACTS:"您不可以从潜在客户选择相关联系人",
                                LBL_THIS:'该 ',
                                DOESNOT_HAVE_MAILIDS:" 不具备任何邮件ID",
                                ARE_YOU_SURE:'你确定要删除吗?',
                                DOESNOT_HAVE_AN_MAILID:'" '+"不具备电子邮件",
                                MISSING_REQUIRED_FIELDS:'所需字段缺失: ',
                                READONLY:"只读",
				SELECT_ATLEAST_ONE_USER:'请至少选择一个用户',
                                DISABLE_SHARING_CONFIRMATION:'您确定要屏蔽对所选项目的共享',
                                USERS:' 用户?',
                                ENDTIME_GREATER_THAN_STARTTIME:'结束时间应大于开始时间 ',
                                FOLLOWUPTIME_GREATER_THAN_STARTTIME:'跟进时间应大于结束时间 ',
                                MISSING_EVENT_NAME:'事件名称丢失',
                                EVENT_TYPE_NOT_SELECTED:'事件类型未选',
                                CLOSEDATE_CANNOT_BE_EMPTY:'结束日期字段不能为空',
                                SITEURL_CANNOT_BE_EMPTY:'网站URL不能为空',
                                SITENAME_CANNOT_BE_EMPTY:'网站名称不能为空',
                                LISTPRICE_CANNOT_BE_EMPTY:'列表价格不能为空',
                                INVALID_LIST_PRICE:'无效列表价格',
                                PROBLEM_ACCESSSING_URL:'访问问题URL： ',
                                CODE:' 编码: ',
                                WISH_TO_QUALIFY_MAIL_AS_CONTACT:'您确定要将该邮件发送者转入联系人?',
                                SELECT_ATLEAST_ONEMSG_TO_DEL:'请至少选择一条要删除信息',
                                ERROR:'出错啦',
                                FIELD_TYPE_NOT_SELECTED:'字段类型未选择',
                                SPECIAL_CHARACTERS_NOT_ALLOWED:'标签字段不支持特殊字符',
				SPECIAL_CHARACTERS:'特殊字符',
                                NOT_ALLOWED:'不允许.请尝试其它数值',
                                PICKLIST_CANNOT_BE_EMPTY:'下拉菜单的项目不能为空',
                                DUPLICATE_VALUES_FOUND:'数值重复',
                                DUPLICATE_MAPPING_ACCOUNTS:'重复的客户映射!!',
                                DUPLICATE_MAPPING_CONTACTS:'重复的联系人映射!!',
                                DUPLICATE_MAPPING_POTENTIAL:'重复的潜在案例映射!!',
                                ERROR_WHILE_EDITING:'编辑时出错',
                                CURRENCY_CHANGE_INFO:'货币更改成功',
                                CURRENCY_CONVERSION_INFO:'您正在使用美元$作为交易货币? \点击 确定 保留为 $, 取消 更改货币兑换率.',
                                THE_EMAILID: "电子邮件Id  \'",
                                EMAIL_FIELD_INVALID:"\' 无效的Email地址",
                                MISSING_REPORT_NAME:'报表名称丢失',
                                REPORT_NAME_EXISTS:'报表名已存在，重试..',
                                WANT_TO_CHANGE_CONTACT_ADDR:'您要更改该客户的联系人地址吗?',
                                SURE_TO_DELETE:'您确定要删除?',
				NO_PRODUCT_SELECTED:'未选择任何产品。请至少选择一种产品。',
                                VALID_FINAL_PERCENT:'输入有效的最终折扣比例',
                                VALID_FINAL_AMOUNT:'输入有效的最终折扣数额',
                                VALID_SHIPPING_CHARGE:'输入有效的货运&处理费',
                                VALID_ADJUSTMENT:'输入有效的调整数额',
                                WANT_TO_CONTINUE:'继续?',
                                ENTER_VALID_TAX:'请输入有效的税额',
                                VALID_TAX_NAME:'请输入有效的税项名称',
                                CORRECT_TAX_VALUE:'请输入正确的税额',
                                ENTER_POSITIVE_VALUE:'请输入正数',
                                LABEL_SHOULDNOT_EMPTY:'税项标签不应为空',
                                NOT_VALID_ENTRY:'输入无效。请输入有效值。',
                                VALID_DISCOUNT_PERCENT:'请输入有效的折扣比例',
                                VALID_DISCOUNT_AMOUNT:'请输入有效的折扣额',
                                SELECT_TEMPLATE_TO_MERGE:'请选择一个合并模板',
				SELECTED_MORE_THAN_ONCE:'您已多次选择了以下产品.',
				YES:'是',
                                NO:'否',
                                MAIL:'邮件',
				EQUALS:'等于',
				NOT_EQUALS_TO:'不等于',
				STARTS_WITH:'开始是',
				CONTAINS:'包含',	
				DOES_NOT_CONTAINS:'不包含',
				LESS_THAN:'小于',
				GREATER_THAN:'大于',
				LESS_OR_EQUALS:'小于或等于',
				GREATER_OR_EQUALS:'大于或等于',

				NO_SPECIAL_CHARS:'发票标题不支持该特殊字符',
				PLS_SELECT_VALID_FILE:'请选择一个带有以下扩展名的文件:\n',
                                NO_SPECIAL:'不支持特殊字符',
				IN_PROFILENAME:' 配置文件名称',
				IN_GROUPNAME:' 群组名称',
				IN_ROLENAME:' 角色名称',
                                VALID_TAX_PERCENT:'请输入有效的税收比例',
                                VALID_SH_TAX:'请输入有效的货运&处理费税',
				ROLE_DRAG_ERR_MSG:'不可以将父节点移至子节点下',
				LBL_DEL:'删除',
				VALID_DATA :' 请输入有效日期 ,重试... ',
                                 STDFILTER : '标准筛选器',
                                STARTDATE : '开始日期',
                                ENDDATE : '结束日期',
                                START_DATE_TIME : '开始日期 & 时间',
                                START_TIME : '开始时间',
                                DATE_SHOULDNOT_PAST :'当前已计划活动的日期 & 时间',
                                TIME_SHOULDNOT_PAST :'当前已计划活动的时间',
				LBL_AND : '与',
				LBL_ENTER_VALID_PORT: '请输入有效的端口号',
				IN_USERNAME :' 用户名 ',
				LBL_ENTER_VALID_NO: '请输入有效数字',
				LBL_PROVIDE_YES_NO: ' 无效数值.\n 请选择 是 或 否',
				LBL_SELECT_CRITERIA: ' 无效条件.\n 请选择条件',
				// Added/Updated for Klant CRM 5.0.4
				OPPORTUNITYNAME_CANNOT_BE_EMPTY:'潜在案件字段不能为空',
                		OVERWRITE_EXISTING_ACCOUNT1:'确定选择客户(',
                		NAME_DESC:' 文件夹名称 & 描述',
                		ENDS_WITH:'结尾',
                		SHARED_EVENT_DEL_MSG:'该用户不具备编辑/删除共享事件的权限.',

				LBL_WRONG_IMAGE_TYPE: '支持联系人照片文件的类型包括：jpeg, png, jpg, pjpeg, x-png or gif',
				SELECT_MAIL_MOVE: '请先选择邮件，再移动.',

				LBL_NOTSEARCH_WITHSEARCH_ALL:'未使用搜索。所有记录将导出，从 ',
				LBL_NOTSEARCH_WITHSEARCH_CURRENTPAGE:'您没有使用搜索。但是选择了 搜索&当前页 项。因而当前页面的记录将被导出 ',
				LBL_NO_DATA_SELECTED:'未选择任何记录. 请至少选择一项导出记录',
				LBL_SEARCH_WITHOUTSEARCH_ALL:'您已使用搜索功能，但是没有选择 不用搜索 & 所有 选项.\n你可以点击[确定]导出所有数据或点击[取消]，尝试其它导出条件。',
				STOCK_IS_NOT_ENOUGH : '库存不足',
				INVALID_QTY : '无效的数量',
				LBL_SEARCH_WITHOUTSEARCH_CURRENTPAGE:'您已使用搜索功能，但是没有选择 不用搜索 & 当前页 选项.\n你可以点击[确定]导出当前页数据或点击[取消]，尝试其它导出条件。',
				LBL_SELECT_COLUMN: ' 无效栏.\n 请选择栏',
				LBL_NOT_ACCESSIBLE : '不可访问',
				LBL_FILENAME_LENGTH_EXCEED_ERR: '文件名不能超过255个字符',
				LBL_DONT_HAVE_EMAIL_PERMISSION : "您未具备使用Email字段权限，因而不能选择Email ID",
				LBL_NO_FEEDS_SELECTED: '未选择任何反馈',
				LBL_SELECT_PICKLIST:'请至少选择一条要删除的项',
				LBL_CANT_REMOVE:'您不可以删除所有项',

				// Added after 5.0.4 GA
				
				/*For global add/delete in picklist*/
				LBL_GIVE_PICKLIST_VALUE:'请提供一些价格为选定的挑选名单来取代',
				LBL_SELECT_ROLE:'请选择至少一个角色，而新添加新的价格',
				LBL_ADD_PICKLIST_VALUE:'至少选择一个新的价格增加',
				LBL_NO_VALUES_TO_DELETE: "没有价格删除",

                /* For Duplicate merging feature */
				SAME_GROUPS: '你必须选择记录在同一组的合并',
				ATLEAST_TWO: '选择至少两个记录合并',
				MAX_THREE: '您可以选择最多三个记录',
				//PARENT_RECORD: 'Select a record as parent record',  MergeFields.tpl Line:59
				MAX_RECORDS: '您可以选择最多四个记录',
				CON_MANDATORY: '选择范围内的名字',
				LE_MANDATORY: '选择必填姓名和公司',
				ACC_MANDATORY: '选择范围内的帐户名称',
				PRO_MANDATORY: '选择范围内的产品名称',
				TIC_MANDATORY: '选择范围内的票据标题',
				POTEN_MANDATORY: '选择范围内的名称',
				VEN_MANDATORY: '选择范围内的区域名称',
				DEL_MANDATORY: '您不可以删除范围',
				
				/* For Multi-Currency Support */
				MSG_CHANGE_CURRENCY_REVISE_UNIT_PRICE: '基于选取的货币，所有货币的单位价格将被修订。您确定?',
				
				Select_one_record_as_parent_record : '选择一个记录作为一个父记录',
				RECURRING_FREQUENCY_NOT_PROVIDED : '无效循环周期',
				RECURRING_FREQNECY_NOT_ENABLED : '有效循环周期, 该循环被禁用',
				/* Added for Documents module */
				NO_SPECIAL_CHARS_DOCS:'不允许的特殊字符：引号，反斜线， +符号％和？',
				FOLDER_NAME_TOO_LONG:'文件夹名称太长。再试一次!',
				FOLDERNAME_EMPTY:'文件夹名称不能为空',
				DUPLICATE_FOLDER_NAME:'已经存在该文件夹名称。请稍后再试!',
				FOLDER_DESCRIPTION_TOO_LONG:'文件夹说明太长。再试一次!',
				NOT_PERMITTED:"您无权执行此操作.",		
				
				ALL_FILTER_CREATION_DENIED:'不能使用“all”',
				OPERATION_DENIED:'你不允许执行此项操作',
				EMAIL_CHECK_MSG: '禁止用户保存空白email',
				IS_PARENT : '已经有此产品了，请换一个产品',
				
				/*global actions on picklist*/
				PICKLIST_CANNOT_BE_EMPTY: '下拉选单列表不能为空',
				DUPLICATE_VALUES_FOUND: '没有发现价格',
				LBL_NO_ROLES_SELECTED: '你没有选择角色，是否继续?',
				LBL_DUPLICATE_FOUND: '该值已有重复的记录了 ',
				LBL_CANNOT_HAVE_EMPTY_VALUE: '不能用空白值替换.',
				LBL_DUPLICATE_VALUE_EXISTS: '不存在',
				LBL_WANT_TO_DELETE: "删除选定值，是否继续? ",
				LBL_DELETE_ALL_WARNING: "至少选择一个值",
				LBL_PLEASE_CHANGE_REPLACEMENT: "删除项中包含替换值，请重新选择",
				
				/*layout Editor changes*/
				BLOCK_NAME_CANNOT_BE_BLANK : '名称不能为空',
				ARE_YOU_SURE_YOU_WANT_TO_DELETE : '确定删除?',
				PLEASE_MOVE_THE_FIELDS_TO_ANOTHER_BLOCK : '请移动到另一区域',
				ARE_YOU_SURE_YOU_WANT_TO_DELETE_BLOCK : '确定删除?',
				LABEL_CANNOT_NOT_EMPTY : '标签不能为空',
				LBL_TYPEALERT_1 : '对不起，你不能',
				LBL_WITH : '用',
				LBL_TYPEALERT_2 : '请使用相同的数据类型.',
				LBL_LENGTHALERT : '对不起, 你不可以给字段分配不同的字符尺寸，请分配一个同样的或更多字符尺寸.',
				LBL_DECIMALALERT : '很抱歉，您不能用不同的小数位匹配字段。请匹配相同或更多小数位的数据。',
				FIELD_IS_MANDATORY : '必须填写',
				FIELD_IS_ACTIVE : '字段可用',
				FIELD_IN_QCREATE : '快速创建',
				FIELD_IS_MASSEDITABLE : '用来编辑',	
					
				IS_MANDATORY_FIELD : '范围',
				CLOSEDATE_CANNOT_BE_EMPTY : '时间不能为空',
				AMOUNT_CANNOT_BE_EMPTY : '不能为空',
				ARE_YOU_SURE : '确定删除?',
				LABEL_ALREADY_EXISTS : '已经存在。请指定一个不同的标签',
				LENGTH_OUT_OF_RANGE : '长度应小于50个字符',
				LBL_SELECT_ONE_FILE : '请选择至少一个文件',
				LBL_UNABLE_TO_ADD_FOLDER : '无法添加文件夹。请稍后再试.',
				LBL_ARE_YOU_SURE_YOU_WANT_TO_DELETE_FOLDER : '你确定要删除的文件夹?',
				LBL_ERROR_WHILE_DELETING_FOLDER : '错误，请稍后再试.',
				LBL_FILE_CAN_BE_DOWNLOAD : '文件可供下载',
				LBL_DOCUMENT_LOST_INTEGRITY:'这份文件是不可用的。它会被标记为无效',
				LBL_DOCUMENT_NOT_AVAILABLE : '这份文件是不提供下载',
				LBL_FOLDER_SHOULD_BE_EMPTY : '文件夹为空!',
				
				LBL_PLEASE_SELECT_FILE_TO_UPLOAD : '请选择要上传的文件.',
				LBL_ARE_YOU_SURE_TO_MOVE_TO : '确定要移动这个文件？ ',
				LBL_FOLDER : ' 文件夹',
				LBL_UNABLE_TO_UPDATE : '无法更新！请再重试一次。',
				LBL_BLANK_REPLACEMENT: "不能用空白值替换",
				
				LBL_IMAGE_DELETED : '删除图片',
				
				/* Tooltip management */
				ERR_FIELD_SELECTION : '有错误',
				
				/* Inventory validation strings */
				NO_LINE_ITEM_SELECTED : '没有项目被选中。请至少选择一个项目.',
				LINE_ITEM : '条目名称',
					Qty : '数量',
				LIST_PRICE: '订价',
				
				/* Webmails */
				LBL_PRINT_EMAIL : '打印', 
				LBL_DELETE_EMAIL : '删除', 
				LBL_DOWNLOAD_ATTACHMENTS : '下载附件', 
				LBL_QUALIFY_EMAIL : '设为联系人', 
				LBL_FORWARD_EMAIL : '转发', 
				LBL_REPLY_TO_SENDER : '回复发件人', 
				LBL_REPLY_TO_ALL : '全部回复',
				
				LBL_WIDGET_HIDDEN : '隐藏窗口',
				LBL_RESTORE_FROM_PREFERENCES : '设置您偏好',
				ERR_HIDING : '错误',
				MSG_TRY_AGAIN : '再试一次',
				
				MSG_ENABLE_SINGLEPANE_VIEW : '查看',
				MSG_DISABLE_SINGLEPANE_VIEW : '查看',
				
				MSG_FTP_BACKUP_DISABLED : 'FTP备份',
				MSG_LOCAL_BACKUP_DISABLED : '本地备份',
				MSG_FTP_BACKUP_ENABLED : '启用FTP备份',
				MSG_LOCAL_BACKUP_ENABLED : '启用本地备份',
				MSG_CONFIRM_PATH : '确认路径',
				MSG_CONFIRM_FTP_DETAILS : '确认路径',
				
				START_PERIOD_END_PERIOD_CANNOT_BE_EMPTY : '启动期间或结束期间不能为空',
				
				/* added to fix i18n issues with home page*/
				LBL_ADD: '增加 ',
				Module: '模块',
				DashBoard: '仪表盘',
				RSS: 'RSS',
				Default: '默认',
				Notebook: '记事本',
				SPECIAL_CHARS:'\\ / < > + \' " ',
				
  				JANUARY: '1',
				FEBRUARY: '2',
				MARCH: '3',
				APRIL: '4',
				MAY: '5',
				JUNE: '6',
				JULY: '7',
				AUGUST: '8',
				SEPTEMBER: '9',
				OCTOBER: '10',
				NOVEMBER: '11',
				DECEMBER: '12',
				AM: '上午',
				PM: '下午',
				MON: '月',
				DAY: '日',
				YEAR: '年',
				Widget_deleted_sucessfully:'模块显示已成功删除'
			};
