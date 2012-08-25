<?php /* Smarty version 2.6.18, created on 2012-06-04 10:21:18
         compiled from UserListViewContents.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'UserListViewContents.tpl', 65, false),array('modifier', 'vtiger_imageurl', 'UserListViewContents.tpl', 66, false),array('modifier', 'strip_tags', 'UserListViewContents.tpl', 81, false),array('modifier', 'trim', 'UserListViewContents.tpl', 81, false),)), $this); ?>

<input name="selectedboxes" id="selectedboxes" type="hidden" value="<?php echo $this->_tpl_vars['SELECTEDIDS']; ?>
">
<input name="allselectedboxes" id="allselectedboxes" type="hidden" value="<?php echo $this->_tpl_vars['ALLSELECTEDIDS']; ?>
">
<input name="current_page_boxes" id="current_page_boxes" type="hidden" value="<?php echo $this->_tpl_vars['CURRENT_PAGE_BOXES']; ?>
">

<script language="JavaScript" type="text/javascript" src="include/js/ListView.js"></script>
<table border=0 cellspacing=0 cellpadding=5 width=100% class="tableHeading">
<tr>
	<td class="big"><strong><?php echo $this->_tpl_vars['MOD']['LBL_USERS_LIST']; ?>
</strong></td>
	<td class="small" align=right>&nbsp;</td>
</tr>
</table>
					
<table border=0 cellspacing=0 cellpadding=5 width=100% class="listTableTopButtons">
<tr>
	<td class="small" nowrap align="left">
<script type="text/javascript" src="modules/SMSNotifier/SMSNotifierCommon.js"></script>
<input class="crmbutton small edit" onclick="SMSNotifierCommon.displaySelectWizard(this, 'Users');" type="button" value="<?php echo $this->_tpl_vars['CMOD']['LBL_SEND_SMS_BUTTON_LABEL']; ?>
"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['recordListRange']; ?>

	</td>
	<!-- Page Navigation -->
	<td nowrap width="30%" align="center">
		<table border=0 cellspacing=0 cellpadding=0 class="small">
			<tr><?php echo $this->_tpl_vars['NAVIGATION']; ?>
</tr>
		</table>
    </td>
	<td class=small width="30%" align="right"><input title="<?php echo $this->_tpl_vars['CMOD']['LBL_NEW_USER_BUTTON_TITLE']; ?>
" accessyKey="<?php echo $this->_tpl_vars['CMOD']['LBL_NEW_USER_BUTTON_KEY']; ?>
" type="submit" name="button" value="<?php echo $this->_tpl_vars['CMOD']['LBL_NEW_USER_BUTTON_LABEL']; ?>
" class="crmButton create small"></td>
</tr>

<?php if ($this->_tpl_vars['ERROR_MSG'] != ''): ?>
<tr>
	<?php echo $this->_tpl_vars['ERROR_MSG']; ?>

</tr>
<?php endif; ?>
</table>
						
<table border=0 cellspacing=0 cellpadding=5 width=100% class="listTable">
<tr>
	<td class="colHeader small" width="27px" valign=top>
     <input name="selectall" onclick="toggleSelect_ListView(this.checked,'selected_id')" type="checkbox" value="on"/>
    </td>
	<td class="colHeader small" valign=top>#</td>
	<td class="colHeader small" valign=top><?php echo $this->_tpl_vars['APP']['Tools']; ?>
</td>
	<td class="colHeader small" valign=top><?php echo $this->_tpl_vars['LIST_HEADER']['3']; ?>
</td>
	<td class="colHeader small" valign=top><?php echo $this->_tpl_vars['LIST_HEADER']['5']; ?>
</td>
	<td class="colHeader small" valign=top><?php echo $this->_tpl_vars['LIST_HEADER']['7']; ?>
</td>
	<td class="colHeader small" valign=top><?php echo $this->_tpl_vars['LIST_HEADER']['6']; ?>
</td>
	<td class="colHeader small" valign=top><?php echo $this->_tpl_vars['LIST_HEADER']['4']; ?>
</td>
</tr>
	<?php $_from = $this->_tpl_vars['LIST_ENTRIES']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['userlist'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['userlist']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['userid'] => $this->_tpl_vars['listvalues']):
        $this->_foreach['userlist']['iteration']++;
?>
		<?php $this->assign('flag', 0); ?>
<tr>
	<td class="listTableRow small" valign=top>
     <input name="selected_id" id="<?php echo $this->_tpl_vars['userid']; ?>
" onclick="check_object(this)" type="checkbox" value="<?php echo $this->_tpl_vars['userid']; ?>
"/>
    </td>
	<td class="listTableRow small" valign=top><?php echo smarty_function_math(array('equation' => "x + y",'x' => $this->_foreach['userlist']['iteration'],'y' => $this->_tpl_vars['PAGE_START_RECORD']), $this);?>
</td>
	<td class="listTableRow small" nowrap valign=top><a href="index.php?action=EditView&return_action=ListView&return_module=Users&module=Users&parenttab=Settings&record=<?php echo $this->_tpl_vars['userid']; ?>
"><img src="<?php echo vtiger_imageurl('editfield.gif', $this->_tpl_vars['THEME']); ?>
" alt="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON']; ?>
" border="0"></a>
	<?php $_from = $this->_tpl_vars['USERNODELETE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
		<?php if ($this->_tpl_vars['userid'] == $this->_tpl_vars['id'] || $this->_tpl_vars['userid'] == $this->_tpl_vars['CURRENT_USERID']): ?>
			<?php $this->assign('flag', 1); ?>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php if ($this->_tpl_vars['flag'] == 0): ?>
		<img src="<?php echo vtiger_imageurl('delete.gif', $this->_tpl_vars['THEME']); ?>
" onclick="deleteUser(this,'<?php echo $this->_tpl_vars['userid']; ?>
')" border="0"  alt="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON']; ?>
" style="cursor:pointer;"/>
	<?php endif; ?>
	<a href="index.php?action=EditView&return_action=ListView&return_module=Users&module=Users&parenttab=Settings&record=<?php echo $this->_tpl_vars['userid']; ?>
&isDuplicate=true"><img src="<?php echo vtiger_imageurl('settingsActBtnDuplicate.gif', $this->_tpl_vars['THEME']); ?>
" alt="<?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON']; ?>
" border="0"></a>
</td>
	<td class="listTableRow small" valign=top><b><a href="index.php?module=Users&action=DetailView&parenttab=Settings&record=<?php echo $this->_tpl_vars['userid']; ?>
"> <?php echo $this->_tpl_vars['listvalues']['3']; ?>
 </a></b><br><a href="index.php?module=Users&action=DetailView&parenttab=Settings&record=<?php echo $this->_tpl_vars['userid']; ?>
"> <?php echo $this->_tpl_vars['listvalues']['1']; ?>
 <?php echo $this->_tpl_vars['listvalues']['0']; ?>
</a> (<?php echo $this->_tpl_vars['listvalues']['2']; ?>
)</td>
	<td class="listTableRow small" valign=top><?php echo $this->_tpl_vars['listvalues']['5']; ?>
&nbsp;</td>
	<td class="listTableRow small" valign=top><?php echo $this->_tpl_vars['listvalues']['7']; ?>
&nbsp;</td>
	<td class="listTableRow small" valign=top><?php echo $this->_tpl_vars['listvalues']['6']; ?>
&nbsp;</td>
	<?php if (trim(smarty_modifier_strip_tags($this->_tpl_vars['listvalues']['4'])) == 'Active'): ?>
	<td class="listTableRow small active" valign=top><?php echo $this->_tpl_vars['APP']['Active']; ?>
</td>
	<?php else: ?>
	<td class="listTableRow small inactive" valign=top><?php echo $this->_tpl_vars['APP']['Inactive']; ?>
</td>
	<?php endif; ?>	

</tr>
	<?php endforeach; else: ?>
	<tr>
		<td colspan="7">
			<table width="100%">
				<tr>
					<td rowspan="2" width="45%" align="right"><img src="<?php echo vtiger_imageurl('empty.jpg', $this->_tpl_vars['THEME']); ?>
" height="60" width="61"></td>
					<td nowrap="nowrap" width="65%" align="left">
						<span class="genHeaderSmall">
							<?php echo $this->_tpl_vars['APP']['LBL_NO']; ?>
 <?php echo $this->_tpl_vars['MOD']['LBL_USERS']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_FOUND']; ?>
 !
						</span>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<?php endif; unset($_from); ?>
</table>
<table border=0 cellspacing=0 cellpadding=5 width=100% >
	<tr><td class="small" nowrap align=right><a href="#top"><?php echo $this->_tpl_vars['MOD']['LBL_SCROLL']; ?>
</a></td></tr>
</table>
