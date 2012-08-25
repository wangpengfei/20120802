<?php /* Smarty version 2.6.18, created on 2012-06-04 13:02:57
         compiled from modules/Tooltip/Quickview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'modules/Tooltip/Quickview.tpl', 5, false),array('modifier', 'getTranslatedString', 'modules/Tooltip/Quickview.tpl', 17, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="modules/Tooltip/TooltipSettings.js"></script>
<br />
<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
<tbody><tr>
	<td valign="top"><img src="<?php echo vtiger_imageurl('showPanelTopLeft.gif', $this->_tpl_vars['THEME']); ?>
"></td>
	<td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">
	<br>

	<div align=center>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'SetMenu.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<table class="settingsSelUITopLine" border="0" cellpadding="5" cellspacing="0" width="100%">
		<tbody>
			<tr>
				<td rowspan="2" valign="top" width="50"><img src="<?php echo vtiger_imageurl('quickview.png', $this->_tpl_vars['THEME']); ?>
" alt="<?php echo $this->_tpl_vars['MOD']['LBL_USERS']; ?>
" title="<?php echo $this->_tpl_vars['MOD']['LBL_USERS']; ?>
" border="0" height="48" width="48"></td>
				<td class="heading2" valign="bottom">
				
				<b><a href="index.php?module=Settings&action=ModuleManager&parenttab=Settings"><?php echo getTranslatedString('VTLIB_LBL_MODULE_MANAGER', 'Settings'); ?>
</a> > 
			<a href="index.php?module=Settings&action=ModuleManager&module_settings=true&formodule=<?php echo $this->_tpl_vars['FORMODULE']; ?>
&parenttab=Settings"><?php echo getTranslatedString($this->_tpl_vars['FORMODULE'], $this->_tpl_vars['FORMODULE']); ?>
</a> > 
				<?php echo $this->_tpl_vars['MOD']['LBL_TOOLTIP_MANAGEMENT']; ?>
			
			</tr>
	
			<tr>
				<td class="small" valign="top"><?php echo $this->_tpl_vars['MOD']['LBL_TOOLTIP_MANAGEMENT_DESCRIPTION']; ?>
</td>
			</tr>
		</tbody>
		</table>
		
		<br>
		<input type="hidden" id="pick_module" value="<?php echo $this->_tpl_vars['MODULE']; ?>
">
		<table border="0" cellpadding="10" cellspacing="0" width="100%">
		<tbody>
			<tr>
			<td>	
			<table class="tableHeading" border="0" cellpadding="5" cellspacing="0" width="100%">
			<tbody><tr>
				<td width='20%'>
					<strong><span id="field_info"><?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
 <?php echo $this->_tpl_vars['MOD']['LBL_FIELD']; ?>
: </span></strong>
				</td>
				<td id='pick_field_list'>
					<?php echo $this->_tpl_vars['FIELDNAMES']; ?>

				</td>
				</tr>
			</tbody>
			</table>
			
			
			<div id="fieldList">
		    </div>	
			</td>
			</tr>
			</table>
		</td>
        </tr>
        </table>
    </td>
    </tr>
    </table>
    </div>
	</td>
    <td valign="top"><img src="<?php echo vtiger_imageurl('showPanelTopRight.gif', $this->_tpl_vars['THEME']); ?>
"></td>
    </tr>
</tbody>
</table>
<br>