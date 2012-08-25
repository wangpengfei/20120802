<?php /* Smarty version 2.6.18, created on 2012-06-04 09:57:31
         compiled from modules/ModApprovals/widgets/DetailViewBlockApproval.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'modules/ModApprovals/widgets/DetailViewBlockApproval.tpl', 16, false),)), $this); ?>
 
<?php if (empty ( $_REQUEST['ajax'] )): ?>
<table class="small" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td colspan="4" class="dvInnerHeader">
	<div style="float: left; font-weight: bold;">
	<div style="float: left;">
	<a href="javascript:showHideStatus('tbl<?php echo $this->_tpl_vars['UIKEY']; ?>
','aid<?php echo $this->_tpl_vars['UIKEY']; ?>
','$IMAGE_PATH');"><img id="aid<?php echo $this->_tpl_vars['UIKEY']; ?>
" src="<?php echo vtiger_imageurl('inactivate.gif', $this->_tpl_vars['THEME']); ?>
" style="border: 0px solid rgb(0, 0, 0);" alt="<?php echo $this->_tpl_vars['APP']['Hide']; ?>
" title="<?php echo $this->_tpl_vars['APP']['Hide']; ?>
"></a>
	</div><b>&nbsp;<?php echo $this->_tpl_vars['WIDGET_TITLE']; ?>
</b></div>
	<!--span style="float: right;">
		<img src="themes/images/vtbusy.gif" border=0 id="indicator<?php echo $this->_tpl_vars['UIKEY']; ?>
" style="display:none;">
		<?php echo $this->_tpl_vars['APP']['LBL_SHOW']; ?>
 <select class="small" onchange="ModApprovalsCommon.reloadContentWithFiltering('<?php echo $this->_tpl_vars['WIDGET_NAME']; ?>
', '<?php echo $this->_tpl_vars['ID']; ?>
', this.value, 'tbl<?php echo $this->_tpl_vars['UIKEY']; ?>
', 'indicator<?php echo $this->_tpl_vars['UIKEY']; ?>
');">
			<option value="All" <?php if ($this->_tpl_vars['CRITERIA'] == 'All'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['APP']['LBL_ALL']; ?>
</option>
			<option value="Last5" <?php if ($this->_tpl_vars['CRITERIA'] == 'Last5'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_LAST5']; ?>
</option>
			<option value="Mine" <?php if ($this->_tpl_vars['CRITERIA'] == 'Mine'): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['MOD']['LBL_MINE']; ?>
</option>
		</select>
	</span-->
	</td>
</tr>
</table>
<?php endif; ?>

<div id="tbl<?php echo $this->_tpl_vars['UIKEY']; ?>
" style="display:none">
	
	<table class="small" border="0" cellpadding="0" cellspacing="0" width="100%">
	
	<tr style="height: 25px;">
		<td colspan="4" align="left" class="dvtCellInfo" >
		<div id="contentwrap_<?php echo $this->_tpl_vars['UIKEY']; ?>
" style="overflow: auto; margin-top: 5px; height: 250px; width: 100%;">
			<?php $_from = $this->_tpl_vars['APPROVALS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['APPROVALMODEL']):
?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/ModApprovals/widgets/DetailViewBlockApprovalItem.tpl", 'smarty_include_vars' => array('APPROVALMODEL' => $this->_tpl_vars['APPROVALMODEL'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endforeach; endif; unset($_from); ?>
		</div>
		</td>
	</tr>
	<?php if ($this->_tpl_vars['ADDAPPROVALS_FLAG'] == 'newadd' || $this->_tpl_vars['ADDAPPROVALS_FLAG'] == 'add'): ?> 
	<tr style="height: 25px;">
	<td class="dvtCellLabel" align="right">
		<?php echo $this->_tpl_vars['MOD']['LBL_ADD_APPROVAL']; ?>

	
	</td>
	<td width="100%" colspan="3" class="dvtCellInfo" align="left" id="mouseArea_<?php echo $this->_tpl_vars['UIKEY']; ?>
" onmouseover="hndMouseOver(19,'<?php echo $this->_tpl_vars['UIKEY']; ?>
');" onmouseout="fnhide('crmspanid');">
		<span id="dtlview_<?php echo $this->_tpl_vars['UIKEY']; ?>
"></span>
		
		
		<div id="editarea_<?php echo $this->_tpl_vars['UIKEY']; ?>
" style="display:block;">
                  <table>
		  <tr><td><?php echo $this->_tpl_vars['MOD']['LBL_MODAPPROVALS_INFORMATION']; ?>
</td><td><textarea id="txtbox_<?php echo $this->_tpl_vars['UIKEY']; ?>
" class="detailedViewTextBox" onFocus="this.className='detailedViewTextBoxOn'" onBlur="this.className='detailedViewTextBox'" cols="90" rows="8"></textarea>
		  </td></tr> 
			<tr><td>
			<?php echo $this->_tpl_vars['MOD']['NextApprover']; ?>
</td><td><input readonly name='reports_to_name' id="reports_to_name_<?php echo $this->_tpl_vars['UIKEY']; ?>
" class="small" type="text" value=''  >
			<input name='reports_to_id'   id="reports_to_id_<?php echo $this->_tpl_vars['UIKEY']; ?>
"  type="hidden" value=''>&nbsp;
<img  src="<?php echo vtiger_imageurl('select.gif', $this->_tpl_vars['THEME']); ?>
" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Users&action=Popup&form=UsersEditView&form_submit=false&fromlink=<?php echo $this->_tpl_vars['fromlink']; ?>
&recordid=<?php echo $this->_tpl_vars['ID']; ?>
&domkeyid=<?php echo $this->_tpl_vars['UIKEY']; ?>
","test","width=640,height=603,resizable=0,scrollbars=0");'align="absmiddle" style='cursor:hand;cursor:pointer'>

	            	&nbsp;<input type="image" src="<?php echo vtiger_imageurl('clear_field.gif', $this->_tpl_vars['THEME']); ?>
" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR']; ?>
" LANGUAGE=javascript onClick="reports_to_id.value=''; reports_to_name.value=''; return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
                        &nbsp;  <font color="gray" ><em>  <?php echo $this->_tpl_vars['MOD']['LBL_MODAPPROVALS_NOTES']; ?>
    </em></font>
			</td></tr>
			<tr><td colspan="2" align="center"><input type="button" class="crmbutton small save" value="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_LABEL']; ?>
" onclick="ModApprovalsCommon.addApproval('<?php echo $this->_tpl_vars['UIKEY']; ?>
', '<?php echo $this->_tpl_vars['ID']; ?>
','<?php echo $this->_tpl_vars['CUID']; ?>
','<?php echo $this->_tpl_vars['PRE_APPROVALS_ID']; ?>
');fnhide('crmspanid');"/> <?php echo $this->_tpl_vars['APP']['LBL_OR']; ?>

			<a href="javascript:;" onclick="hndCancel('dtlview_<?php echo $this->_tpl_vars['UIKEY']; ?>
','editarea_<?php echo $this->_tpl_vars['UIKEY']; ?>
','<?php echo $this->_tpl_vars['UIKEY']; ?>
')" class="link"><?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
</a>
			</td></tr></table>

			
		</div>
		
	</td>							
	</tr>
	
	<?php endif; ?>
	</table>
</div>