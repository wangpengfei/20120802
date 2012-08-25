<?php /* Smarty version 2.6.18, created on 2012-06-04 09:53:04
         compiled from Webmails.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'Webmails.tpl', 17, false),array('modifier', 'my_translate', 'Webmails.tpl', 113, false),)), $this); ?>
<!--  USER  SETTINGS PAGE STARTS HERE -->
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'Buttons_List1.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
<link rel="stylesheet" type="text/css" href="themes/<?php echo $this->_tpl_vars['THEME']; ?>
/webmail.css">
<table width="100%" border="0" cellpadding="0" cellspacing="0" height="100%">
   <tr>
	<td valign=top align=right><img src="<?php echo vtiger_imageurl('showPanelTopLeft.gif', $this->_tpl_vars['THEME']); ?>
"></td>
	<td class="showPanelBg" valign="top" width="95%"  style="padding-left:20px; ">
	<br>
	<!-- module Select Table -->
		<table class="settingsUI" width="100%"  border="0" cellspacing="0" cellpadding="0">
		   <tr>
			<td class="mailClientBg" width="7">&nbsp;</td>
			<td class="mailClientBg">

				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                		   <tr>
					<td colspan="3" style="padding:10px;vertical-align:middle;height:2px;">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
						   <tr>
							<td width="10%">
								<img src="<?php echo vtiger_imageurl('check_mail.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" />
								&nbsp;<a href="javascript:;" class="webMnu" onclick="check_for_new_mail('<?php echo $this->_tpl_vars['MAILBOX']; ?>
');" ><?php echo $this->_tpl_vars['MOD']['LBL_CHK_MAIL']; ?>
</a>
							</td>
							<td width="10%">
								<img src="<?php echo vtiger_imageurl('compose.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" />
								&nbsp;<a href="javascript:;" onclick="OpenComposer('','create');" class="webMnu"><?php echo $this->_tpl_vars['MOD']['LBL_COMPOSE']; ?>
</a>
							</td>
							<td width="20%" nowrap>
								<img src="<?php echo vtiger_imageurl('webmail_settings.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" />
								&nbsp;<a href="index.php?module=Users&action=AddMailAccount&record=<?php echo $this->_tpl_vars['USERID']; ?>
&return_module=Webmails&return_action=index" class="webMnu"><?php echo $this->_tpl_vars['MOD']['LBL_SETTINGS']; ?>
</a>
							</td>
							<td width="30%">
								<!--<img src="themes/images/webmail_settings.gif" align="absmiddle" />
								&nbsp;<a href="javascript:;" onclick="runEmailCommand('expunge','0');" class="webMnu"><?php echo $this->_tpl_vars['MOD']['LBL_EXPUNGE_MAILBOX']; ?>
</a>-->
							</td>
							<td>&nbsp;</td>
						   </tr>
						</table>
					</td>
				   </tr>
				   <tr>
					<td colspan=2> 
						<table border=0 width="100%" cellspacing=0 cellspacing=0>
						<tr>
						<td rowspan=6 valign=top class="MatrixLayer1">
							<table  border=0 width="100%" cellspacing=0 cellspacing=0>
							<tr>	
							<td width="20%"  class="big mailSubHeader"><b><?php echo $this->_tpl_vars['MOD']['LBL_EMAIL_FOLDERS']; ?>
</b></td>
							</tr>
							<tr>
							<td>
								<img src="<?php echo vtiger_imageurl('mymail.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" />&nbsp;<span ><b class="txtGreen"><?php echo $this->_tpl_vars['MOD']['LBL_MY_MAILS']; ?>
</b>&nbsp;&nbsp;<span id="folderOpts" style="position:absolute;display:none"><?php echo $this->_tpl_vars['MOD']['ADD_FOLDER']; ?>
</span></span>
								<div id="box_list">
								<ul style="list-style-type:none;">

							<?php $_from = $this->_tpl_vars['BOXLIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
								<?php $_from = $this->_tpl_vars['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row_values']):
?>
									<?php echo $this->_tpl_vars['row_values']; ?>

								<?php endforeach; endif; unset($_from); ?>
							<?php endforeach; endif; unset($_from); ?>
							</ul></div> <br />

						<img src="<?php echo vtiger_imageurl('sentmail.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" />&nbsp;<b class="txtGreen"><?php echo $this->_tpl_vars['MOD']['LBL_SENT_MAILS']; ?>
</b>
						<ul style="list-style-type:none;">
							<li >
								<img src="<?php echo vtiger_imageurl('opened_folder.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" />&nbsp;&nbsp;
								<a href="index.php?module=Emails&action=ListView&parenttab=My Home Page&folderid=1&parenttab=My Home Page" class="small"><?php echo $this->_tpl_vars['MOD']['LBL_ALLMAILS']; ?>
</a>&nbsp;<b></b>
							</li>
							<li >
								<img src="<?php echo vtiger_imageurl('opened_folder.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" />&nbsp;&nbsp;
								<a href="index.php?module=Emails&action=ListView&folderid=2&parenttab=My Home Page" class="small"><?php echo $this->_tpl_vars['MOD']['LBL_TO_CONTACTS']; ?>
</a>&nbsp;<b></b>
							</li>
							<li >
								<img src="<?php echo vtiger_imageurl('opened_folder.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" />&nbsp;&nbsp;
								<a href="index.php?module=Emails&action=ListView&folderid=3&parenttab=My Home Page" class="small"><?php echo $this->_tpl_vars['MOD']['LBL_TO_ACCOUNTS']; ?>
</a>&nbsp;
							</li>	
							<li >
								<img src="<?php echo vtiger_imageurl('opened_folder.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" />&nbsp;&nbsp;
								<a href="index.php?module=Emails&action=ListView&folderid=4&parenttab=My Home Page" class="small"><?php echo $this->_tpl_vars['MOD']['LBL_TO_LEADS']; ?>
</a>&nbsp;
							</li>
							<li >
								<img src="<?php echo vtiger_imageurl('opened_folder.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" />&nbsp;&nbsp;
								<a href="index.php?module=Emails&action=ListView&folderid=5&parenttab=My Home Page" class="small"><?php echo $this->_tpl_vars['MOD']['LBL_TO_USERS']; ?>
</a>&nbsp;
							</li>
						</ul><br />
						<!--<img src="themes/images/webmail_trash.gif" align="absmiddle" />&nbsp;<b class="txtGreen"><?php echo $this->_tpl_vars['MOD']['LBL_TRASH']; ?>
</b>
						<ul style="list-style-type:none;">
							<li>
								<img src="themes/images/folder.gif" align="absmiddle" />&nbsp;&nbsp;
								<a href="#" class="small"><?php echo $this->_tpl_vars['MOD']['LBL_JUNK_MAILS']; ?>
</a>&nbsp;<b></b>
							</li>
						</ul>-->

						</td>
						</tr>
						</table>
						</td>	
						<td width="1%">&nbsp;</td>
					        <td rowspan=3 valign="top">
						 <table border=0 width="100%" cellspacing=0 cellspacing=0 class="MatrixLayer1">
					 	 <tr>
			<td width="79%" class="big mailSubHeader"><div id="nav"><span style="float:left"><?php echo $this->_tpl_vars['ACCOUNT']; ?>
 &gt; <?php echo ((is_array($_tmp=$this->_tpl_vars['MAILBOX'])) ? $this->_run_mod_handler('my_translate', true, $_tmp) : my_translate($_tmp)); ?>

                             <?php if ($this->_tpl_vars['NUM_EMAILS'] != 0): ?>
						 <?php if ($this->_tpl_vars['NUM_EMAILS'] != 1): ?>
							(<?php echo $this->_tpl_vars['NUM_EMAILS']; ?>
 <?php echo $this->_tpl_vars['MOD']['LBL_MESSAGES']; ?>
)
						 <?php else: ?>
							(<?php echo $this->_tpl_vars['NUM_EMAILS']; ?>
 <?php echo $this->_tpl_vars['MOD']['LBL_MESSAGE']; ?>
)
						 <?php endif; ?>
					 <?php endif; ?>
						</span> <span style="float:right"><?php echo $this->_tpl_vars['NAVIGATION']; ?>
</span></div></td>
						 </tr>
						 <tr>	
							<td class="hdrNameBg" style="height:30px;">
							<!-- Table to display Delete, Move To and Search buttons and options - Starts -->
							<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				                	   <tr>
                				        	<td width="45%" id="move_pane">
								<input type="button" name="mass_del" value=" <?php echo $this->_tpl_vars['MOD']['LBL_DELETE']; ?>
 "  class="crmbutton small delete" onclick="mass_delete();"/>
								<?php echo $this->_tpl_vars['FOLDER_SELECT']; ?>

				                        	</td>
								<?php if ($this->_tpl_vars['DEGRADED_SERVICE'] == 'false'): ?>
			        	                		<td width="50%" align="right" nowrap>
									<font color=red><?php echo $this->_tpl_vars['MOD']['JUST_IMAP2']; ?>
</font><font color="#000000"><?php echo $this->_tpl_vars['APP']['LBL_SEARCH']; ?>
</font>&nbsp;
									<input type="text" name="srch" class="importBox" id="search_input"  value="<?php echo $this->_tpl_vars['SEARCH_VALUE']; ?>
"/>&nbsp;
									<?php echo $this->_tpl_vars['SEARCH_HTML']; ?>
&nbsp;
									</td>
									<td width="5%">
									<input type="button" name="find" value=" <?php echo $this->_tpl_vars['APP']['LBL_FIND_BUTTON']; ?>
 " class="crmbutton small create" onclick="search_emails();" />
									</td>
								<?php endif; ?>
                	   				   </tr>
                					</table>
							</td>
						 </tr>
						 <tr>
							<td  align="left" valign="top" style="height:150px;">
							<div id="rssScroll" style="height:220px;">
							<!--div added to show info while moving mails-->
							<div id="show_msg" class="layerPopup" align="center" style="padding: 5px;font-weight:bold;width: 400px;display:none;z-index:10000"></div>
							<!-- Table to display the mails list -	Starts -->
							<form name="massdelete" method="post" onsubmit="VtigerJS_DialogBox.block();">
							<table cellspacing="1" cellpadding="3" border="0" width="100%" id="message_table">
							   <tr>
								<th class='tableHeadBg'><input type="checkbox" name="select_all" value="checkbox"  onclick="toggleSelect(this.checked,'selected_id');"/></th>
								<?php $_from = $this->_tpl_vars['LISTHEADER']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['element']):
?>
									<?php echo $this->_tpl_vars['element']; ?>

								<?php endforeach; endif; unset($_from); ?>
							   </tr>	
								<?php $_from = $this->_tpl_vars['LISTENTITY']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
									<?php $_from = $this->_tpl_vars['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row_values']):
?>
                				        			<?php echo $this->_tpl_vars['row_values']; ?>

									<?php endforeach; endif; unset($_from); ?>
								<?php endforeach; endif; unset($_from); ?>
							</table>
						 </form>
						 </div>
						 </td>

						 </tr>

						</table>
						</td>
						<td rowspan=9>&nbsp;
							
						</td>
				   		</tr>
				   		<tr>
					<td width="1%">&nbsp;</td>
					</tr>
				   <tr>
					<!-- td style="padding:1px;" align="left" -->
					<td width="1%">&nbsp;</td>
									   </tr>
				   <tr><td colspan="2" style="height:10px;">&nbsp;</td></tr>
				   <tr id="preview1" style="visibility:hidden" class="previewWindow">
					<td width="1%">&nbsp;</td>
					<!--td class="forwardBg"-->
					<td class="forwardBg">
					<!-- Table to display the Qualify, Reply, Forward, etc buttons - Starts -->
			   		<table width="100%"  border="0" cellspacing="0" cellpadding="0">
					   <tr>
						<td width="75%" nowrap>
							&nbsp;<span id="qualify_button"><input type="button" name="Qualify2" value=" <?php echo $this->_tpl_vars['MOD']['LBL_QUALIFY_BUTTON']; ?>
 " class="buttonok" /></span>&nbsp;
							<span id="reply_button"><input type="button" name="reply" value=" <?php echo $this->_tpl_vars['MOD']['LBL_REPLY_TO_SENDER']; ?>
 " class="crmbutton small edit" /></span>&nbsp;
							<span id="reply_button_all"><input type="button" name="reply" value=" <?php echo $this->_tpl_vars['MOD']['LBL_REPLY_ALL']; ?>
 " class="crmbutton small edit" /></span>&nbsp;
							<span id="forward_button"><input type="button" name="forward" value=" <?php echo $this->_tpl_vars['MOD']['LBL_FORWARD_BUTTON']; ?>
 " class="crmbutton small edit" /></span>&nbsp;
							<span id="download_attach_button"><input type="button" name="download" value=" <?php echo $this->_tpl_vars['MOD']['LBL_DOWNLOAD_ATTCH_BUTTON']; ?>
 " class="crmbutton small save" /></span>&nbsp;
							<span id="print_email_button"><input type="button" name="print" value=" <?php echo $this->_tpl_vars['MOD']['LBL_PRINT_EMAIL']; ?>
 "class="crmbutton small edit" /></span>
						</td>
						<td width="25%" align="right"><span id="delete_button"><input type="button" name="Button" value=" <?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON']; ?>
 "  class="crmbutton small delete" /></span>&nbsp;</td>
					   </tr>
					</table>
					<!-- Table to display the Qualify, Reply, Forward, etc buttons - Ends -->
					</td>
				   </tr>
				   <tr style="visibility:hidden" class="previewWindow">
					<td width="1%">&nbsp;</td>
					<td height="300">
			   		<table width="100%" class="MatrixLayer1" border="0" cellpadding="0" cellspacing="0">
					<tr>
					<td bgcolor="#FFFFFF" valign="top">
					<div id="preview2">
					   <span id="body_area" style="width:95%">
						<iframe id="email_description" width="100%" height="500" scrolling="no" frameBorder="0"></iframe>
					   </span>
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
			</td>
			</tr>
			</tr>
			<td colspan=4>&nbsp;
				
			</td>
		   	</tr>
		</table>
		<br />
	</td>
	<td valign=top><img src="<?php echo vtiger_imageurl('showPanelTopRight.gif', $this->_tpl_vars['THEME']); ?>
"></td>
   </tr>
</table>

<!-- END -->