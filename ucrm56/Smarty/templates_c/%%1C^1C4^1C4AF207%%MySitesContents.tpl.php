<?php /* Smarty version 2.6.18, created on 2012-06-04 12:56:40
         compiled from MySitesContents.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'MySitesContents.tpl', 18, false),)), $this); ?>
<!-- BEGIN: main -->
<table class="small" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td colwidth=90% align=left class=small>
		<table border=0 cellspacing=0 cellpadding=5>
		<tr>
			<td align=left><a href="#" onclick="fetchContents('manage');"><img src="<?php echo vtiger_imageurl('webmail_settings.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" border=0 /></a></td>
			<td class=small align=left><a href="#" onclick="fetchContents('manage');"><?php echo $this->_tpl_vars['MOD']['LBL_MANAGE_SITES']; ?>
</a>			     </td>
			<td align="right"><input type="button" name="setdefault" value=" <?php echo $this->_tpl_vars['MOD']['LBL_SET_DEFAULT_BUTTON']; ?>
  " class="crmbutton small create" onClick="defaultMysites(this);"/>
		</tr>
		</table>
			
	</td>
	<td align=right width=10%>
		<table border=0 cellspacing=0 cellpadding=0>
		<tr><td nowrap class="componentName"><?php echo $this->_tpl_vars['MOD']['LBL_MY_SITES']; ?>
</td></tr>
		</table>
	</td>
</tr>
</table>

<table border=0 cellspacing=0 cellpadding=5 width=100% class="mailSubHeader">
<tr>
<td nowrap align=left><?php echo $this->_tpl_vars['MOD']['LBL_BOOKMARK_LIST']; ?>
 : </span></td>
<td align=left width=90% >
	<select id="urllist" name="urllist" style="width: 99%;" class="small" onChange="setSite(this);">
	<?php $_from = $this->_tpl_vars['PORTALS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['sno'] => $this->_tpl_vars['portaldetails']):
?>
	<?php if ($this->_tpl_vars['portaldetails']['set_def'] == 1): ?>
		<option selected value="<?php echo $this->_tpl_vars['portaldetails']['portalid']; ?>
"><?php echo $this->_tpl_vars['portaldetails']['portalname']; ?>
</option>
	<?php else: ?>
		<option value="<?php echo $this->_tpl_vars['portaldetails']['portalid']; ?>
"><?php echo $this->_tpl_vars['portaldetails']['portalname']; ?>
</option>
	<?php endif; ?>
	<!--<option value="<?php echo $this->_tpl_vars['portaldetails']['portalurl']; ?>
"><?php echo $this->_tpl_vars['portaldetails']['portalname']; ?>
</option>-->
	<?php endforeach; endif; unset($_from); ?>
	</select>	
</td>
</tr>
<tr>
	<td bgcolor="#ffffff" colspan=2>
		<iframe id="locatesite" src="<?php echo $this->_tpl_vars['DEFAULT_URL']; ?>
" frameborder="0" height="1100" scrolling="auto" width="100%"></iframe>
	</td>
</tr>
</table>
