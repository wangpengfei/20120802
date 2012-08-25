<?php /* Smarty version 2.6.18, created on 2012-06-05 07:26:20
         compiled from RelatedListDataContents.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'RelatedListDataContents.tpl', 16, false),array('modifier', 'getTranslatedString', 'RelatedListDataContents.tpl', 59, false),)), $this); ?>
<table border=0 cellspacing=0 cellpadding=0 width=100% class="small" 
	style="border-bottom:1px solid #999999;padding:5px; background-color: #eeeeff;">
	<tr>
		<td align="left">
			<?php echo $this->_tpl_vars['RELATEDLISTDATA']['navigation']['0']; ?>

			<?php if ($this->_tpl_vars['MODULE'] == 'Campaigns' && ( $this->_tpl_vars['RELATED_MODULE'] == 'Contacts' || $this->_tpl_vars['RELATED_MODULE'] == 'Leads' || $this->_tpl_vars['RELATED_MODULE'] == 'Accounts' ) && count($this->_tpl_vars['RELATEDLISTDATA']['entries']) > 0): ?>
				<br><?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
: <a href="javascript:void(0);"
					onclick="clear_checked_all('<?php echo $this->_tpl_vars['RELATED_MODULE']; ?>
');"><?php echo $this->_tpl_vars['APP']['LBL_NONE_NO_LINE']; ?>
</a>
			<?php endif; ?>
		</td>
		<td align="center"><?php echo $this->_tpl_vars['RELATEDLISTDATA']['navigation']['1']; ?>
 </td>
		<td align="right">
			<?php echo $this->_tpl_vars['RELATEDLISTDATA']['CUSTOM_BUTTON']; ?>


			<?php if ($this->_tpl_vars['HEADER'] == 'Contacts' && $this->_tpl_vars['MODULE'] != 'Campaigns' && $this->_tpl_vars['MODULE'] != 'Accounts' && $this->_tpl_vars['MODULE'] != 'Potentials' && $this->_tpl_vars['MODULE'] != 'Products' && $this->_tpl_vars['MODULE'] != 'Vendors'): ?>
				<?php if ($this->_tpl_vars['MODULE'] == 'Calendar'): ?>
					<input alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_CONTACT_BUTTON_LABEL']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_CONTACT_BUTTON_LABEL']; ?>
" accessKey="" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['Contacts']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module=Contacts&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=Popup&popuptype=detailview&select=enable&form=EditView&form_submit=false&recordid=<?php echo $this->_tpl_vars['ID']; ?>
<?php echo $this->_tpl_vars['search_string']; ?>
","test","width=640,height=602,resizable=0,scrollbars=0");' type="button"  name="button"></td>
				<?php elseif ($this->_tpl_vars['MODULE'] != 'Services'): ?>
					<input title="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Contact']; ?>
" accessyKey="F" class="crmbutton small create" onclick="this.form.action.value='EditView';this.form.module.value='Contacts'" type="submit" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_NEW']; ?>
 <?php echo $this->_tpl_vars['APP']['Contact']; ?>
"></td>
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['HEADER'] == 'Users' && $this->_tpl_vars['MODULE'] == 'Calendar'): ?>
				<input title="Change" accessKey="" tabindex="2" type="button" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_SELECT_USER_BUTTON_LABEL']; ?>
" name="button" LANGUAGE=javascript onclick='return window.open("index.php?module=Users&return_module=Calendar&return_action=<?php echo $this->_tpl_vars['return_modname']; ?>
&activity_mode=Events&action=Popup&popuptype=detailview&form=EditView&form_submit=true&select=enable&return_id=<?php echo $this->_tpl_vars['ID']; ?>
&recordid=<?php echo $this->_tpl_vars['ID']; ?>
","test","width=640,height=525,resizable=0,scrollbars=0")';>
            <?php endif; ?>
            
		</td>
	</tr>
</table>

<table border=0 cellspacing=1 cellpadding=3 width=100% style="background-color:#eaeaea;" class="small">
	<tr style="height:25px" bgcolor=white>
        <?php if ($this->_tpl_vars['MODULE'] == 'Campaigns' && ( $this->_tpl_vars['RELATED_MODULE'] == 'Contacts' || $this->_tpl_vars['RELATED_MODULE'] == 'Leads' || $this->_tpl_vars['RELATED_MODULE'] == 'Accounts' ) && count($this->_tpl_vars['RELATEDLISTDATA']['entries']) > 0): ?>
		<td class="lvtCol">
			<input name ="<?php echo $this->_tpl_vars['RELATED_MODULE']; ?>
_selectall" onclick="rel_toggleSelect(this.checked,'<?php echo $this->_tpl_vars['RELATED_MODULE']; ?>
_selected_id','<?php echo $this->_tpl_vars['RELATED_MODULE']; ?>
');"  type="checkbox">
		</td>
        <?php endif; ?>
		<?php $_from = $this->_tpl_vars['RELATEDLISTDATA']['header']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['_HEADER_FIELD']):
?>
		<td class="lvtCol"><?php echo $this->_tpl_vars['_HEADER_FIELD']; ?>
</td>
		<?php endforeach; endif; unset($_from); ?>
	</tr>
	<?php $_from = $this->_tpl_vars['RELATEDLISTDATA']['entries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_RECORD_ID'] => $this->_tpl_vars['_RECORD']):
?>
		<tr bgcolor=white>
        	<?php if ($this->_tpl_vars['MODULE'] == 'Campaigns' && ( $this->_tpl_vars['RELATED_MODULE'] == 'Contacts' || $this->_tpl_vars['RELATED_MODULE'] == 'Leads' || $this->_tpl_vars['RELATED_MODULE'] == 'Accounts' )): ?>
			<td><input name="<?php echo $this->_tpl_vars['RELATED_MODULE']; ?>
_selected_id" id="<?php echo $this->_tpl_vars['_RECORD_ID']; ?>
" value="<?php echo $this->_tpl_vars['_RECORD_ID']; ?>
" onclick="rel_check_object(this,'<?php echo $this->_tpl_vars['RELATED_MODULE']; ?>
');" type="checkbox"  <?php echo $this->_tpl_vars['RELATEDLISTDATA']['checked'][$this->_tpl_vars['_RECORD_ID']]; ?>
></td>
        	<?php endif; ?>
			<?php $_from = $this->_tpl_vars['_RECORD']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['index'] => $this->_tpl_vars['_RECORD_DATA']):
?>
				                  <td onmouseover="vtlib_listview.trigger('cell.onmouseover', $(this))" onmouseout="vtlib_listview.trigger('cell.onmouseout', $(this))"> <?php echo getTranslatedString($this->_tpl_vars['_RECORD_DATA'], $this->_tpl_vars['_RECORD_DATA']); ?>
</td>
                 			<?php endforeach; endif; unset($_from); ?>
		</tr>
	<?php endforeach; else: ?>
		<tr style="height: 25px;" bgcolor="white"><td><i><?php echo $this->_tpl_vars['APP']['LBL_NONE_INCLUDED']; ?>
</i></td></tr>
	<?php endif; unset($_from); ?>
</table>