<?php /* Smarty version 2.6.18, created on 2012-06-03 22:56:39
         compiled from ApprovalReminderCallback.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'ApprovalReminderCallback.tpl', 20, false),)), $this); ?>

<div id="<?php echo $this->_tpl_vars['popupid']; ?>
" style="float: right; border-style: solid; border-color: rgb(141, 141, 141); border-width: 1px 3px 3px 1px; overflow: hidden; padding-left: 5px; padding-right: 5px; padding-top: 5px; padding-bottom: 10px; margin-left: 2px; font-weight: normal; height: 75px;">

<table border='0' cellpadding='2' cellspacing='0'>
	<tr>
		<td align='left'><b>
		 <?php echo $this->_tpl_vars['TITLE']; ?>
 </b> </td>
		<td align='right'></td>
		<td align='right'><a style='padding-left: 10px;' href="javascript:;" onclick="ActivityReminderRemovePopupDOM('<?php echo $this->_tpl_vars['popupid']; ?>
');"><img src='<?php echo vtiger_imageurl('close.gif', $this->_tpl_vars['THEME']); ?>
' align='absmiddle' border='0'></a></td>
	</tr>

	<tr>
		<td colspan='3'><hr></td>
	</tr>
<?php $_from = $this->_tpl_vars['Pend_Approval']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['approval']):
?>
	<tr>
		<td colspan='3' align='left'><b>
        <a style='padding: 2px;' href='index.php?action=DetailView&module=<?php echo $this->_tpl_vars['approval']['remodule']; ?>
&record=<?php echo $this->_tpl_vars['approval']['related_to']; ?>
'><?php echo $this->_tpl_vars['approval']['approvalcont']; ?>
</a>
        </b>
        </td>
	</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

</div>