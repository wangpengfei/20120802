<?php /* Smarty version 2.6.18, created on 2012-06-05 07:35:33
         compiled from MassEditForm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'MassEditForm.tpl', 41, false),)), $this); ?>

<table border=0 cellspacing=0 cellpadding=5 width=100% align=center> 
	<tr>
		<td class=small >		
			<!-- popup specific content fill in starts -->
	      <form name="EditView" id="massedit_form" action="index.php" onsubmit="VtigerJS_DialogBox.block();">
				<input id="idstring" value="<?php echo $this->_tpl_vars['IDS']; ?>
" type="hidden" />
				<table border=0 cellspacing=0 cellpadding=0 width=100% align=center bgcolor=white>
				<tr>
					<td colspan=4 valign="top">
						<div style='padding: 5px 0;'>
							<span class="helpmessagebox"><?php echo $this->_tpl_vars['APP']['LBL_SELECT_FIELDS_TO_UDPATE_WITH_NEW_VALUE']; ?>
</span>
						</div>
						<!-- Hidden Fields -->
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'EditViewHidden.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<input type="hidden" name="massedit_recordids">
						<input type="hidden" name="massedit_module">
						<input type="hidden" name="module" value="<?php echo $this->_tpl_vars['MODULE']; ?>
">
						<input type="hidden" name="action" value="MassEditSave">
					</td>
				</tr>
					<tr>
						<td colspan=4>
							<table class="small" border="0" cellpadding="3" cellspacing="0" width="100%">
								<tbody><tr>
									<td class="dvtTabCache" style="width: 10px;" nowrap>&nbsp;</td>
									
									<?php $_from = $this->_tpl_vars['BLOCKS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['header'] => $this->_tpl_vars['data']):
        $this->_foreach['block']['iteration']++;
?>
									    <?php if (($this->_foreach['block']['iteration']-1) == 0): ?>
										    <td nowrap class="dvtSelectedCell" id="tab<?php echo ($this->_foreach['block']['iteration']-1); ?>
" onclick="massedit_togglediv(<?php echo ($this->_foreach['block']['iteration']-1); ?>
,<?php echo count($this->_tpl_vars['BLOCKS']); ?>
);">
										     <b><?php echo $this->_tpl_vars['header']; ?>
</b>
										    </td>
									    <?php else: ?>
										    <td nowrap class="dvtUnSelectedCell" id="tab<?php echo ($this->_foreach['block']['iteration']-1); ?>
" onclick="massedit_togglediv(<?php echo ($this->_foreach['block']['iteration']-1); ?>
,<?php echo count($this->_tpl_vars['BLOCKS']); ?>
);">
										     <b><?php echo $this->_tpl_vars['header']; ?>
</b>
										    </td>
									    <?php endif; ?>
									<?php endforeach; endif; unset($_from); ?>
						    		<td class="dvtTabCache" nowrap style="width:55%;">&nbsp;</td>
							    </tr>
								</tbody>
						    </table>		
						</td>
					</tr>
					<tr>
						<td colspan=4>
							<?php $_from = $this->_tpl_vars['BLOCKS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['block'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['block']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['header'] => $this->_tpl_vars['data']):
        $this->_foreach['block']['iteration']++;
?>
							    <?php if (($this->_foreach['block']['iteration']-1) == 0): ?>
								    <div id="massedit_div<?php echo ($this->_foreach['block']['iteration']-1); ?>
" style='display:block;'>
									<table border=0 cellspacing=0 cellpadding=5 width=100% align=center bgcolor=white>
										<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "DisplayFields.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
									</table>
									</div>
							    <?php else: ?>
								    <div id="massedit_div<?php echo ($this->_foreach['block']['iteration']-1); ?>
" style='display:none;'>
									<table border=0 cellspacing=0 cellpadding=5 width=100% align=center bgcolor=white>
										<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "DisplayFields.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
									</table>
									</div>
							    <?php endif; ?>
							<?php endforeach; endif; unset($_from); ?>
						</td>
					</tr>
			</table>
			<table border=0 cellspacing=0 cellpadding=5 width=100% class="layerPopupTransport">
				<tr>
					<td align="center">
							<!--input type="submit" name="save" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_LABEL']; ?>
">
							<input type="button" name="button" class="crmbutton small cancel" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
" onClick="fninvsh('massedit')"-->
  				                     <input title="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_KEY']; ?>
" class="crmbutton small save" onclick="this.form.action.value='MassEditSave';  return massEditFormValidate()" type="submit" name="button" value="  <?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
  " style="width:70px" >
                                   	 <input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="crmbutton small cancel" onclick="fninvsh('massedit')" type="button" name="button" value="  <?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
  " style="width:70px">

					</td>
				</tr>
			</table>			
			</form>
		</td>
	</tr>
</table>

<script type="text/javascript" id="massedit_javascript">

        var mass_fieldname = new Array(<?php echo $this->_tpl_vars['VALIDATION_DATA_FIELDNAME']; ?>
);

        var mass_fieldlabel = new Array(<?php echo $this->_tpl_vars['VALIDATION_DATA_FIELDLABEL']; ?>
);

        var mass_fielddatatype = new Array(<?php echo $this->_tpl_vars['VALIDATION_DATA_FIELDDATATYPE']; ?>
);

		var mass_count=0;
	
		massedit_initOnChangeHandlers(); 
		


</script>