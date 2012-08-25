<?php /* Smarty version 2.6.18, created on 2012-06-04 13:01:30
         compiled from DefModuleView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'DefModuleView.tpl', 18, false),)), $this); ?>

<script language="JAVASCRIPT" type="text/javascript" src="include/js/smoothscroll.js"></script>

<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
<tbody><tr>
        <td valign="top"><img src="<?php echo vtiger_imageurl('showPanelTopLeft.gif', $this->_tpl_vars['THEME']); ?>
"></td>
        <td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">
<form action="index.php" method="post" id="form" onsubmit="VtigerJS_DialogBox.block();">
<input type='hidden' name='module' value='Users'>
<input type='hidden' name='action' value='DefModuleView'>
<input type='hidden' name='return_action' value='ListView'>
<input type='hidden' name='return_module' value='Users'>
<input type='hidden' name='parenttab' value='Settings'>

        <br>

	<div align=center>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'SetMenu.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<!-- DISPLAY -->
				<table border=0 cellspacing=0 cellpadding=5 width=100% class="settingsSelUITopLine">
				<tr>
					<td width=50 rowspan=2 valign=top><img src="<?php echo vtiger_imageurl('set-IcoTwoTabConfig.gif', $this->_tpl_vars['THEME']); ?>
" alt="<?php echo $this->_tpl_vars['MOD']['LBL_DEFAULT_MODULE_VIEW']; ?>
" width="48" height="48" border=0 title="<?php echo $this->_tpl_vars['MOD']['LBL_DEFAULT_MODULE_VIEW']; ?>
"></td>
					<td class=heading2 valign=bottom><b><a href="index.php?module=Settings&action=index&parenttab=Settings"><?php echo $this->_tpl_vars['MOD']['LBL_SETTINGS']; ?>
</a> > <?php echo $this->_tpl_vars['MOD']['LBL_DEFAULT_MODULE_VIEW']; ?>
</b></td>
				</tr>
				<tr>
					<td valign=top class="small"><?php echo $this->_tpl_vars['MOD']['LBL_DEFAULT_MODULE_VIEW_DESC']; ?>
</td>
				</tr>
				</table>
				
				<br>
				<table border=0 cellspacing=0 cellpadding=10 width=100% >
				<tr>
				<td>
				
				<table border=0 cellspacing=0 cellpadding=5 width=100% class="tableHeading">
				<tr>
				<td class="big" height="40px;" width="70%"><strong><?php echo $this->_tpl_vars['MOD']['LBL_DEFAULT_DETAIL_VIEW']; ?>
</strong></td>
				<td class="small" align="center" width="30%">&nbsp;
					<span id="view_info" class="crmButton small cancel" style="display:none;"></span>
				</td>
				</tr>
				</table>
			
							<table border=0 cellspacing=0 cellpadding=0 width=100% class="listRow">
			<tr>
	         	    <td class="small" valign=top ><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                        <tr>
                            <td width="20%" nowrap class="small cellLabel"><strong><?php echo $this->_tpl_vars['MOD']['LBL_ENABLE_SINGLEPANE_VIEW']; ?>
</strong></td>
                            <td width="80%" class="small cellText">
			<?php if ($this->_tpl_vars['ViewStatus'] == 'enabled'): ?>
				<input type="checkbox" checked name="enable_audit" onclick="viewenabled(this)"></input>
			<?php else: ?>
				<input type="checkbox" name="enable_audit" onclick="viewenabled(this)"></input>
			<?php endif; ?>
			</td>
                        </tr>
                        
                        
                        </table>
	    </td>
                        </tr>
                        </table>	
				<!--table border=0 cellspacing=0 cellpadding=5 width=100% >
				<tr>
					  <td class="small" nowrap align=right><a href="#top"><?php echo $this->_tpl_vars['MOD']['LBL_SCROLL']; ?>
</a></td>
				</tr>
				</table-->
	
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
</form>
</table>

<?php echo '
<script>

function viewenabled(ochkbox)
{
	if(ochkbox.checked == true)
	{
	     var status=\'enabled\';
	$(\'view_info\').innerHTML = alert_arr.MSG_ENABLE_SINGLEPANE_VIEW;
	     $(\'view_info\').style.display = \'block\';		
		
			
	}
	else
	{
	    var status = \'disabled\';	
	     $(\'view_info\').innerHTML = alert_arr.MSG_DISABLE_SINGLEPANE_VIEW;
	     $(\'view_info\').style.display = \'block\';		
	
	}
             $("status").style.display="block";
	     new Ajax.Request(
                \'index.php\',
                {queue: {position: \'end\', scope: \'command\'},
                        method: \'post\',
                        postBody: \'module=Users&action=UsersAjax&file=SaveDefModuleView&ajax=true&audit_trail=\'+status,
                        onComplete: function(response) {
                                $("status").style.display="none";
                        }
                }
        );
			
	setTimeout("hide(\'view_info\')",3000);
}

</script>
'; ?>

