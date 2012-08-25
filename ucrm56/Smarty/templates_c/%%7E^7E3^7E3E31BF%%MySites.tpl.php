<?php /* Smarty version 2.6.18, created on 2012-06-04 12:56:40
         compiled from MySites.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'MySites.tpl', 22, false),)), $this); ?>

<script src="include/scriptaculous/scriptaculous.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript" src="modules/Portal/Portal.js"></script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "Buttons_List1.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table border=0 cellspacing=0 cellpadding=0 width=98% align=center>
<tr>
	<td valign=top align=right width=8><img src="<?php echo vtiger_imageurl('showPanelTopLeft.gif', $this->_tpl_vars['THEME']); ?>
"></td>
	<td class="showPanelBg" valign="top" width="100%" align=center >	

	<!-- MySites UI Starts -->
	<br>
	<table border="0" cellpadding="0" cellspacing="0" width="98%" align="center" class="mailClient mailClientBg">
	<tbody>
	
	<tr>
	<td colspan="4">
	
	
	<!-- BOOKMARK PAGE -->
	<div id="portalcont" style="padding:0px 10px 10px 10px; overflow: hidden; width: 98%;">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "MySitesContents.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	
	
	</td>
	</tr>
	</tbody></table>
	<br><br>
	<div id="editportal_cont" style="z-index:100001;position:absolute;width:510px;"></div>
	
	</td>
	<td valign=top align=right width=8><img src="<?php echo vtiger_imageurl('showPanelTopRight.gif', $this->_tpl_vars['THEME']); ?>
"></td>			
	</tr>
	</table>