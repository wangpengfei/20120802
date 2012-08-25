<?php /* Smarty version 2.6.18, created on 2012-06-04 08:38:46
         compiled from ImportStep1.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'ImportStep1.tpl', 42, false),)), $this); ?>


<script type="text/javascript" language="Javascript">
function validateFile(form) 
	{

	if(!emptyCheck("userfile","File Location","any"))
		{
                
			form.userfile.focus();
		        return false;
		}


    	if(! upload_filter("userfile", "xls") )
		{
        
                	form.userfile.focus();
	                return false;
	
		}
	
		return true;
	}
</script>
<!-- header - level 2 tabs -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'Buttons_List1.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	

<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%" class="small">
   <tr>
	<td valign="top"><img src="<?php echo vtiger_imageurl('showPanelTopLeft.gif', $this->_tpl_vars['THEME']); ?>
"/></td>
	<td class="showPanelBg" valign="top" width="100%">

		<!-- Import UI Starts -->
		<table  cellpadding="0" cellspacing="0" width="100%" border=0>
		   <tr>
			<td width="75%" valign=top>
				<form enctype="multipart/form-data" name="Import" method="POST" action="index.php" onsubmit="VtigerJS_DialogBox.block();">
				<input type="hidden" name="module" value="<?php echo $this->_tpl_vars['MODULE']; ?>
">
				<input type="hidden" name="step" value="1">
				<input type="hidden" name="source" value="<?php echo $this->_tpl_vars['SOURCE']; ?>
">
				<input type="hidden" name="source_id" value="<?php echo $this->_tpl_vars['SOURCE_ID']; ?>
">
				<input type="hidden" name="action" value="Import">
				<input type="hidden" name="return_module" value="<?php echo $this->_tpl_vars['RETURN_MODULE']; ?>
">
				<input type="hidden" name="return_id" value="<?php echo $this->_tpl_vars['RETURN_ID']; ?>
">
				<input type="hidden" name="return_action" value="<?php echo $this->_tpl_vars['RETURN_ACTION']; ?>
">
				<input type="hidden" name="parenttab" value="<?php echo $this->_tpl_vars['CATEGORY']; ?>
">

				<!-- IMPORT LEADS STARTS HERE  -->
				<br />
				<table align="center" cellpadding="5" cellspacing="0" width="80%" class="mailClient importLeadUI small" border="0">
				   <tr>
					<td colspan="2" height="50" valign="middle" align="left" class="mailClientBg  genHeaderSmall"><?php echo $this->_tpl_vars['MOD']['LBL_MODULE_NAME']; ?>
 <?php echo $this->_tpl_vars['MODULELABEL']; ?>
</td>
				   </tr>
				   <tr >
					<td colspan="2" align="left" valign="top" style="padding-left:40px;">
					<br>
						<?php if ($this->_tpl_vars['MODULE'] == 'Accounts' || $this->_tpl_vars['MODULE'] == 'Contacts' || $this->_tpl_vars['MODULE'] == 'Leads' || $this->_tpl_vars['MODULE'] == 'Products' || $this->_tpl_vars['MODULE'] == 'Potentials' || $this->_tpl_vars['MODULE'] == 'HelpDesk' || $this->_tpl_vars['MODULE'] == 'Vendors'): ?>	
							<span class="genHeaderGray"><?php echo $this->_tpl_vars['MOD']['LBL_STEP_1_4']; ?>
</span>&nbsp; 
						<?php else: ?>
							<span class="genHeaderGray"><?php echo $this->_tpl_vars['MOD']['LBL_STEP_1']; ?>
</span>&nbsp;
						<?php endif; ?>
						<span class="genHeaderSmall"><?php echo $this->_tpl_vars['MOD']['LBL_STEP_1_TITLE']; ?>
</span> 
					</td>
				   </tr>
				   <tr >
					<td colspan="2" align="left" valign="top" style="padding-left:40px;">
						<?php echo $this->_tpl_vars['MOD']['LBL_STEP_1_TEXT']; ?>

					</td>
				   </tr>
				   <tr ><td align="left" valign="top" colspan="2">&nbsp;</td></tr>
				   <tr >
					<td align="right" valign="top" width="25%" class=small><b><?php echo $this->_tpl_vars['MOD']['LBL_FILE_LOCATION']; ?>
 </b></td>
					<td align="left" valign="top" width="75%">
						<input type="file" name="userfile" size="65" class=small onchange="validateFilename(this);" />&nbsp;
						<input type="hidden" name="userfile_hidden" value=""/><br />
						<br /><b><?php echo $this->_tpl_vars['MOD']['LBL_HAS_HEADER']; ?>
</b>&nbsp;<input type="checkbox" name="has_header"<?php echo $this->_tpl_vars['HAS_HEADER_CHECKED']; ?>
 />
						&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $this->_tpl_vars['MOD']['LBL_DELIMITER']; ?>
</b>&nbsp;
							<select name="delimiter" class="small" style="font-family:Times;">
								<option value=",">,</option>
								<option value=";">;</option>
							</select>
					  	&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $this->_tpl_vars['MOD']['LBL_FORMAT']; ?>
</b>&nbsp;
							<select name="format" class="small">
							<!-- value must be a known format for mb_convert_encoding() -->
					  			<option value="ISO-8859-1">ISO-8859-1</option>
					  			<option value="UTF-8">UTF-8</option>
					  		</select>
					</td>
				   </tr>
				   				   <tr ><td colspan="2" height="50">&nbsp;</td></tr>
				    <tr >
						<td colspan="2" align="right" style="padding-right:40px;" class="reportCreateBottom">
							<input title="<?php echo $this->_tpl_vars['MOD']['LBL_NEXT']; ?>
" accessKey="" class="crmButton small save" type="submit" name="button" value="  <?php echo $this->_tpl_vars['MOD']['LBL_NEXT']; ?>
 &rsaquo; "  onclick="this.form.action.value='Import';this.form.step.value='2'; return validateFile(this.form);">
						&nbsp;
 <input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
" accessKey="" class="crmButton small cancel" type="button" name="button" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
" onclick="window.history.back()">

						</td>
				   </tr>
				 </table>
				<br>
				</form>
				<!-- IMPORT LEADS ENDS HERE -->
			</td>
		   </tr>
		</table>

	</td>
	<td valign="top"><img src="<?php echo vtiger_imageurl('showPanelTopRight.gif', $this->_tpl_vars['THEME']); ?>
" /></td>
   </tr>
</table>
<br>