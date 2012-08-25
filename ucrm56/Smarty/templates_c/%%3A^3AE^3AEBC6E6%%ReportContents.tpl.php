<?php /* Smarty version 2.6.18, created on 2012-06-04 12:52:35
         compiled from ReportContents.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'ReportContents.tpl', 14, false),)), $this); ?>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="99%"  class="showPanelBg">
	<tbody><tr>
	<td valign=top><img src="<?php echo vtiger_imageurl('showPanelTopLeft.gif', $this->_tpl_vars['THEME']); ?>
"></td>
	<td valign="top" width="50%" style="padding: 10px;border-right:1px dashed #CCCCCC">
	<!-- Reports Table Starts Here  -->
	<?php $_from = $this->_tpl_vars['REPT_FLDR']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['reportfolder']):
?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" class="reportsListTable">
		<tr>
		<td class="mailSubHeader"><b>
		
		<?php if ($this->_tpl_vars['MOD'][$this->_tpl_vars['reportfolder']['name']] != ''): ?>
			<?php echo $this->_tpl_vars['MOD'][$this->_tpl_vars['reportfolder']['name']]; ?>

		<?php else: ?>
			<?php echo $this->_tpl_vars['reportfolder']['name']; ?>

		<?php endif; ?>
		</b>
		<i><font color='#C0C0C0'>
			<?php if ($this->_tpl_vars['MOD'][$this->_tpl_vars['reportfolder']['description']] != ''): ?>
				 - <?php echo $this->_tpl_vars['MOD'][$this->_tpl_vars['reportfolder']['description']]; ?>

			<?php else: ?>
				 - <?php echo $this->_tpl_vars['reportfolder']['description']; ?>

			<?php endif; ?>
		</font></i>
		</td>
		</tr>
		<tr>
		<td>
		<table  class="small" border="0" cellpadding="5" cellspacing="1" width="100%">
			<tbody>
			<tr>
			<td class="lvtCol" width="5%">#</td>
			<td class="lvtCol" width="35%"><?php echo $this->_tpl_vars['MOD']['LBL_REPORT_NAME']; ?>
</td>
			<td class="lvtCol" width="50%"><?php echo $this->_tpl_vars['MOD']['LBL_DESCRIPTION']; ?>
</td>
			<td class="lvtCol" width="10%"><?php echo $this->_tpl_vars['MOD']['LBL_TOOLS']; ?>
</td>
			</tr>
			<?php $_from = $this->_tpl_vars['reportfolder']['details']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['reportdtls'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['reportdtls']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['reportdetails']):
        $this->_foreach['reportdtls']['iteration']++;
?>
				<tr class="lvtColData" onmouseover="this.className='lvtColDataHover'" onmouseout="this.className='lvtColData'" bgcolor="white">
				<td><?php echo $this->_foreach['reportdtls']['iteration']; ?>
</td>
				<?php if ($this->_tpl_vars['MOD'][$this->_tpl_vars['reportdetails']['reportname']] != ''): ?>
					<td><a href="index.php?module=Reports&action=SaveAndRun&record=<?php echo $this->_tpl_vars['reportdetails']['reportid']; ?>
&folderid=<?php echo $this->_tpl_vars['reportfolder']['id']; ?>
"><?php echo $this->_tpl_vars['MOD'][$this->_tpl_vars['reportdetails']['reportname']]; ?>
</a>
					<?php if ($this->_tpl_vars['reportdetails']['sharingtype'] == 'Shared'): ?>
						<img src="<?php echo vtiger_imageurl('Meetings.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" border=0 height=12 width=12 /> 
					<?php endif; ?>
					</td>
				<?php else: ?>
					<td><a href="index.php?module=Reports&action=SaveAndRun&record=<?php echo $this->_tpl_vars['reportdetails']['reportid']; ?>
&folderid=<?php echo $this->_tpl_vars['reportfolder']['id']; ?>
"><?php echo $this->_tpl_vars['reportdetails']['reportname']; ?>
</a>
					<?php if ($this->_tpl_vars['reportdetails']['sharingtype'] == 'Shared'): ?>
						<img src="<?php echo vtiger_imageurl('Meetings.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" border=0 height=12 width=12 /> 
					<?php endif; ?>
					</td>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['MOD'][$this->_tpl_vars['reportdetails']['description']] != ''): ?>
					<td><?php echo $this->_tpl_vars['MOD'][$this->_tpl_vars['reportdetails']['description']]; ?>
</td>
				<?php else: ?>
					<td><?php echo $this->_tpl_vars['reportdetails']['description']; ?>
</td>
				<?php endif; ?>
				<td align="center" nowrap>
					<?php if ($this->_tpl_vars['reportdetails']['customizable'] == '1' && $this->_tpl_vars['reportdetails']['editable'] == 'true'): ?>
						<a href="javascript:;" onClick="editReport('<?php echo $this->_tpl_vars['reportdetails']['reportid']; ?>
');"><img src="<?php echo vtiger_imageurl('editfield.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" title="<?php echo $this->_tpl_vars['MOD']['LBL_CUSTOMIZE_BUTTON']; ?>
..." border="0"></a>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['reportdetails']['state'] != 'SAVED' && $this->_tpl_vars['reportdetails']['editable'] == 'true'): ?>
						&nbsp;| &nbsp;<a href="javascript:;" onclick="DeleteReport('<?php echo $this->_tpl_vars['reportdetails']['reportid']; ?>
');"><img src="<?php echo vtiger_imageurl('delete.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" title="<?php echo $this->_tpl_vars['MOD']['LBL_DELETE']; ?>
..." border="0"></a>
					<?php endif; ?>
				</td>
				</tr>
			<?php endforeach; endif; unset($_from); ?>

			</tbody>
		</table>
		</td>
		</tr>
	</table>
	<br />
	<?php endforeach; endif; unset($_from); ?>
	<!-- Reports Table Ends Here  -->
	</td>
	<td style="padding:10px;" valign="top" align="center" width="50%">
	<div id="customizedrep">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "ReportsCustomize.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
	</div>
	</td>
	<td valign=top><img src="<?php echo vtiger_imageurl('showPanelTopRight.gif', $this->_tpl_vars['THEME']); ?>
"></td>
	</tr>
	<tr>
	<td colspan="2" align="center">&nbsp;</td>
	</tr>
	</tbody>
</table>
