<?php /* Smarty version 2.6.18, created on 2012-06-04 13:01:05
         compiled from ShowAuditTrailContents.tpl */ ?>

<table width="100%" border="0">
	<tr class="small">
		<td align="left" >
		<?php if ($this->_tpl_vars['LIST_ENTRIES'] != ''): ?>
			<?php echo $this->_tpl_vars['RECORD_COUNTS']; ?>

		<?php endif; ?>
		</td>
			<?php echo $this->_tpl_vars['NAVIGATION']; ?>

	</tr>
</table>

<table border=0 cellspacing=1 cellpadding=5 width=100% style="background-color:#cccccc;" class="small">
	<tr style="background-color:#efefef">
	<?php $_from = $this->_tpl_vars['LIST_HEADER']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['header']):
?>
  		<td class="lvtCol"><?php echo $this->_tpl_vars['header']; ?>
</td>
	<?php endforeach; endif; unset($_from); ?>
	</tr>
	<?php $_from = $this->_tpl_vars['LIST_ENTRIES']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entity_id'] => $this->_tpl_vars['entity']):
?>
	<tr bgcolor=white onMouseOver="this.className='lvtColDataHover'" onMouseOut="this.className='lvtColData'"  >
		 <?php $_from = $this->_tpl_vars['entity']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['data']):
?>	
			 <td><?php echo $this->_tpl_vars['data']; ?>
</td>
		 <?php endforeach; endif; unset($_from); ?>
	</tr>
	<?php endforeach; else: ?>
	<tr bgcolor=white>
	<td colspan="4" height="300px" align="center"><b><font size="6px"><?php echo $this->_tpl_vars['MOD']['LBL_NO_DATA']; ?>
</font></b>
	</td>
	</tr>
	<?php endif; unset($_from); ?>
</table>
