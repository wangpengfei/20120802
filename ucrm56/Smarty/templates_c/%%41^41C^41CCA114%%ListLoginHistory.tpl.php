<?php /* Smarty version 2.6.18, created on 2012-06-04 13:01:12
         compiled from ListLoginHistory.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'ListLoginHistory.tpl', 23, false),)), $this); ?>

<script language="JAVASCRIPT" type="text/javascript" src="include/js/smoothscroll.js"></script>
<script src="include/scriptaculous/prototype.js" type="text/javascript"></script>
<script src="include/scriptaculous/scriptaculous.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript" src="include/js/general.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/dtlviewajax.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/menu.js"></script>

<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
<tbody><tr>
        <td valign="top"><img src="<?php echo vtiger_imageurl('showPanelTopLeft.gif', $this->_tpl_vars['THEME']); ?>
"></td>
        <td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">
<form action="index.php" method="post" name="ListLoginHistory" id="form" onsubmit="VtigerJS_DialogBox.block();">
<input type='hidden' name='module' value='Users'>
<input type='hidden' name='action' value='ListLoginHistory'>
<input type='hidden' name='record' id='record' value="<?php echo $this->_tpl_vars['ID']; ?>
">
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
					<td width=50 rowspan=2 valign=top><img src="<?php echo vtiger_imageurl('set-IcoLoginHistory.gif', $this->_tpl_vars['THEME']); ?>
" alt="<?php echo $this->_tpl_vars['MOD']['LBL_AUDIT_TRAIL']; ?>
" width="48" height="48" border=0 title="<?php echo $this->_tpl_vars['MOD']['LBL_LOGIN_HISTORY_DETAILS']; ?>
"></td>
					<td class=heading2 valign=bottom><b><a href="index.php?module=Settings&action=index&parenttab=Settings"><?php echo $this->_tpl_vars['MOD']['LBL_SETTINGS']; ?>
</a> > <?php echo $this->_tpl_vars['MOD']['LBL_LOGIN_HISTORY_DETAILS']; ?>
</b></td>
				</tr>
				<tr>
					<td valign=top class="small"><?php echo $this->_tpl_vars['MOD']['LBL_LOGIN_HISTORY_DESCRIPTION']; ?>
</td>
				</tr>
				</table>
				
				<br>
				<table border=0 cellspacing=0 cellpadding=10 width=100% >
				<tr>
				<td>
				
				<table border=0 cellspacing=0 cellpadding=5 width=100% class="tableHeading">
				<tr>
				<td class="big" height="30px;"><strong><?php echo $this->_tpl_vars['MOD']['LBL_LOGIN_HISTORY_DETAILS']; ?>
</strong></td>
				<td class="small" align="left">&nbsp;</td>
				</tr>
				</table>
			
							<table border=0 cellspacing=0 cellpadding=0 width=100% class="listRow">
			<tr>
	         	    <td class="small" valign=top ><table width="100%"  border="0" cellspacing="0" cellpadding="5">
                       
                        <tr valign="top">
                            <td nowrap width="18%" class="small cellLabel"><strong><?php echo $this->_tpl_vars['MOD']['LBL_USER_AUDIT']; ?>
</strong></td>
                            <td class="small cellText">
				<select name="user_list" id="user_list" onchange="fetchlogin_js(<?php echo $this->_tpl_vars['ID']; ?>
);">
				<option value="none" selected="true"><?php echo $this->_tpl_vars['APP']['LBL_NONE']; ?>
</option>
				<?php echo $this->_tpl_vars['USERLIST']; ?>

				</select>	
			    </td>
			    
                        </tr>
                        
                        </table>
	    </td>
                        </tr>
			    <table class="tableHeading" border="0" cellpadding="5" cellspacing="0" width="100%">
			    	<tr>
				     <td class="big">	
					<strong><?php echo $this->_tpl_vars['CMOD']['LBL_LOGIN_HISTORY']; ?>
</strong>
				     </td>
			        </tr>
			    </table>
			    <table border="0" cellpadding="5" cellspacing="0" width="100%">
				<tr><td align="left"><div id="login_history_cont" style="display:none;"></div></td><td></td></tr>	
			    </table>	
			    <br>	
                        </table>	
				<table border=0 cellspacing=0 cellpadding=5 width=100% >
				<tr>
					  <td class="small" nowrap align=right><a href="#top"><?php echo $this->_tpl_vars['MOD']['LBL_SCROLL']; ?>
</a></td>
				</tr>
				</table>
	
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
function fetchlogin_js(id)
{
	fetchLoginHistory(id);
}
function fetchLoginHistory(id)
{
	var oUser_combo = $(\'user_list\');
	var id = oUser_combo.options[oUser_combo.selectedIndex].value;
	if ( id == \'none\')
	{
		Effect.Fade(\'login_history_cont\');
	}
	else
	{
        	$("status").style.display="inline";
	        new Ajax.Request(
        	        \'index.php\',
                	{queue: {position: \'end\', scope: \'command\'},
                        	method: \'post\',
                       		postBody: \'module=Users&action=UsersAjax&file=ShowHistory&ajax=true&record=\'+id,
	                        onComplete: function(response) {
        	                        $("status").style.display="none";
                	                $("login_history_cont").innerHTML= response.responseText;
					Effect.Appear(\'login_history_cont\');
                       		}
               		}
        		);
	}
}
</script>
'; ?>

<script>
function getListViewEntries_js(module,url)
{
	var oUser_combo = $('user_list');
	var id = oUser_combo.options[oUser_combo.selectedIndex].value;
	$("status").style.display="inline";
        new Ajax.Request(
        	'index.php',
                {queue: {position: 'end', scope: 'command'},
                	method: 'post',
                        postBody:"module="+module+"&action="+module+"Ajax&file=ShowHistory&record="+id+"&ajax=true&"+url,
			onComplete: function(response) {
                        	$("status").style.display="none";
                                $("login_history_cont").innerHTML= response.responseText;
                  	}
                }
        );
}
</script>
