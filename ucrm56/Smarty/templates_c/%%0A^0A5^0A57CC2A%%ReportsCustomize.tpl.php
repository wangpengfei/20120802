<?php /* Smarty version 2.6.18, created on 2012-06-04 12:52:35
         compiled from ReportsCustomize.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'ReportsCustomize.tpl', 69, false),)), $this); ?>
<!-- Customized Reports Table Starts Here  -->
	<form>
	<?php if ($this->_tpl_vars['DEL_DENIED'] != ""): ?>
	<span id="action_msg_status" class="small" align="left"><font color=red><b><?php echo $this->_tpl_vars['MOD']['LBL_PERM_DENIED']; ?>
 <?php echo $this->_tpl_vars['DEL_DENIED']; ?>
</b> </font></span>
	<?php endif; ?>
	<input id="folder_ids" name="folderId" type="hidden" value='<?php echo $this->_tpl_vars['FOLDE_IDS']; ?>
'>
	<?php $this->assign('poscount', 0); ?>
	<?php $_from = $this->_tpl_vars['REPT_CUSFLDR']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['reportfolder']):
?>	
	<?php $this->assign('poscount', $this->_tpl_vars['poscount']+1); ?>
		<table class="reportsListTable" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">		
		<tr>
		<td class="mailSubHeader" align="left" colspan="3" style="font-weight:bold;">
		<span id='folder<?php echo $this->_tpl_vars['reportfolder']['id']; ?>
'> <?php echo $this->_tpl_vars['reportfolder']['name']; ?>
</span>
		<i><font color='#C0C0C0'>
			<?php if ($this->_tpl_vars['reportfolder']['description'] != ''): ?>
				 - <?php echo $this->_tpl_vars['reportfolder']['description']; ?>

			<?php endif; ?>
		</font></i>
		
		</td>
		</tr>
		<tr>
			<td  class="hdrNameBg" colspan="3" style="padding: 5px;" align="right" >
				<!-- Custom Report Group's Buttons -->
				<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr>
		<td  id="repposition<?php echo $this->_tpl_vars['poscount']; ?>
" width="5%" align="right"><input name="newReportInThisModule" value="<?php echo $this->_tpl_vars['MOD']['LBL_CREATE_REPORT']; ?>
..." class="crmButton small create" onclick="gcurrepfolderid=<?php echo $this->_tpl_vars['reportfolder']['id']; ?>
;fnvshobj(this,'reportLay')" type="button"></td>
			<td  width="75%" align="right">
					<input type="button" name="Edit" value=" <?php echo $this->_tpl_vars['MOD']['LBL_RENAME_FOLDER']; ?>
 " class="crmbutton small edit" onClick='EditFolder("<?php echo $this->_tpl_vars['reportfolder']['id']; ?>
","<?php echo $this->_tpl_vars['reportfolder']['fname']; ?>
","<?php echo $this->_tpl_vars['reportfolder']['fdescription']; ?>
"),fnvshobj(this,"orgLay");'>&nbsp;
			</td>
			<td align="right">
					<input type="button" name="delete" value=" <?php echo $this->_tpl_vars['MOD']['LBL_DELETE_FOLDER']; ?>
 " class="crmbutton small delete" onClick="DeleteFolder('<?php echo $this->_tpl_vars['reportfolder']['id']; ?>
');">
			</td>
		</tr>
		</table>
			</td>
			</tr>
		<tr>
		<td colspan="3">
		<table  border="0" cellpadding="3" cellspacing="1" width="100%">
			<tbody>
			<tr>
			<td class="lvtCol" width="5%">
				<input type="checkbox" name="selectall" onclick='toggleSelect(this.checked,"selected_id<?php echo $this->_tpl_vars['reportfolder']['id']; ?>
")' value="checkbox" />
			</td>
			<td class="lvtCol" align="left" width="35%"><?php echo $this->_tpl_vars['MOD']['LBL_REPORT_NAME']; ?>
</td>
			<td class="lvtCol" align="left" width="50%"><?php echo $this->_tpl_vars['MOD']['LBL_DESCRIPTION']; ?>
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
			<td>
				<?php if ($this->_tpl_vars['reportdetails']['customizable'] == '1' && $this->_tpl_vars['reportdetails']['editable'] == 'true'): ?>
					<input name="selected_id<?php echo $this->_tpl_vars['reportfolder']['id']; ?>
" value="<?php echo $this->_tpl_vars['reportdetails']['reportid']; ?>
" onclick='toggleSelectAll(this.name,"selectall")' type="checkbox">
				<?php endif; ?>
			</td>
			<td align="left"><a href="index.php?module=Reports&action=SaveAndRun&record=<?php echo $this->_tpl_vars['reportdetails']['reportid']; ?>
&folderid=<?php echo $this->_tpl_vars['reportfolder']['id']; ?>
"><?php echo $this->_tpl_vars['reportdetails']['reportname']; ?>
</a>
			<?php if ($this->_tpl_vars['reportdetails']['sharingtype'] == 'Shared'): ?>
				<img src="<?php echo vtiger_imageurl('Meetings.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" border=0 height=12 width=12 /> 
			<?php endif; ?>
			</td>
			<td align="left"><?php echo $this->_tpl_vars['reportdetails']['description']; ?>
</td>
			<td align="right" nowrap>
			<?php if ($this->_tpl_vars['reportdetails']['customizable'] == '1' && $this->_tpl_vars['reportdetails']['editable'] == 'true'): ?>
				<a href="javascript:;" onClick="editReport('<?php echo $this->_tpl_vars['reportdetails']['reportid']; ?>
');"><img src="<?php echo vtiger_imageurl('editfield.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" title="Customize..." border="0"></a>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['reportdetails']['state'] != 'SAVED' && $this->_tpl_vars['reportdetails']['editable'] == 'true'): ?>
			&nbsp;| &nbsp;<a href="javascript:;" onClick="DeleteReport('<?php echo $this->_tpl_vars['reportdetails']['reportid']; ?>
');"><img src="<?php echo vtiger_imageurl('delete.gif', $this->_tpl_vars['THEME']); ?>
" align="absmiddle" title="Delete..." border="0"></a>
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
	<?php endforeach; else: ?>
	<div align="center" style="position:relative;width:50%;height:30px;border:1px dashed #CCCCCC;background-color:#FFFFCC;padding:10px;">
	<a href="javascript:;" onclick="fnvshobj(this,'orgLay');"><?php echo $this->_tpl_vars['MOD']['LBL_CLICK_HERE']; ?>
</a>&nbsp;<?php echo $this->_tpl_vars['MOD']['LBL_TO_ADD_NEW_GROUP']; ?>

	</div>
	<?php endif; unset($_from); ?>
	</form>
	<!-- Customized Reports Table Ends Here  -->

<div style="display: none;left:193px;top:106px;width:155px;" id="folderLay" onmouseout="fninvsh('folderLay')" onmouseover="fnvshNrm('folderLay')">
<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr><td style="border-bottom: 1px solid rgb(204, 204, 204); padding: 5px;" align="left"><b><?php echo $this->_tpl_vars['MOD']['LBL_MOVE_TO']; ?>
 :</b></td></tr>
	<tr>
	<td align="left">
	<?php $_from = $this->_tpl_vars['REPT_FOLDERS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['folder']):
?>
	<a href="javascript:;" onClick='MoveReport("<?php echo $this->_tpl_vars['folder']['id']; ?>
","<?php echo $this->_tpl_vars['folder']['fname']; ?>
");' class="drop_down">- <?php echo $this->_tpl_vars['folder']['name']; ?>
</a>
	<?php endforeach; endif; unset($_from); ?>
	</td>
	</tr>
</table>
</div>