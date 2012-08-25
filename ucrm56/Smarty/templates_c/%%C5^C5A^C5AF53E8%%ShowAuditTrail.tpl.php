<?php /* Smarty version 2.6.18, created on 2012-06-04 13:01:05
         compiled from ShowAuditTrail.tpl */ ?>
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['THEME_PATH']; ?>
style.css">
<script language="javascript" type="text/javascript" src="include/scriptaculous/prototype.js"></script>
<body class="small" marginwidth=0 marginheight=0 leftmargin=0 topmargin=0 bottommargin=0 rigthmargin=0>

<form action="index.php" method="post" id="form" onsubmit="VtigerJS_DialogBox.block();">
<input type='hidden' name='module' value='Settings'>
<input type='hidden' id='userid' name='userid' value='<?php echo $this->_tpl_vars['USERID']; ?>
'>

<table  width="100%" border="0" cellspacing="0" cellpadding="0" class="mailClient mailClientBg">
	<tr>
		<td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td class="moduleName" width="80%" style="padding-left:10px;"><?php echo $this->_tpl_vars['MOD']['LBL_AUDIT_TRAIL']; ?>
</td>
					<td  width=30% nowrap class="componentName" align=right><?php echo $this->_tpl_vars['APP']['VTIGER']; ?>
</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="hdrNameBg small">
			<div id="AuditTrailContents">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "ShowAuditTrailContents.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
		</td>
	</tr>
	<tr>
    <td align="center" style="padding:10px;" class="reportCreateBottom" >&nbsp;</td>
  </tr>
</table>
</form>
</body>
<?php echo '
<script>
function getListViewEntries_js(module,url)
{
	var userid = document.getElementById(\'userid\').value;
        new Ajax.Request(
                \'index.php\',
                {queue: {position: \'end\', scope: \'command\'},
                        method: \'post\',
                        postBody: \'module=Settings&action=SettingsAjax&file=ShowAuditTrail&ajax=true&\'+url+\'&userid=\'+userid,
                        onComplete: function(response) {
                                $("AuditTrailContents").innerHTML= response.responseText;
                        }
                }
        );
}
</script>
'; ?>
