<?php /* Smarty version 2.6.18, created on 2012-06-04 12:56:54
         compiled from modules/RecycleBin/RecycleBinContents.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'getTranslatedString', 'modules/RecycleBin/RecycleBinContents.tpl', 43, false),array('modifier', 'vtiger_imageurl', 'modules/RecycleBin/RecycleBinContents.tpl', 83, false),array('function', 'html_options', 'modules/RecycleBin/RecycleBinContents.tpl', 156, false),)), $this); ?>
<script type='text/javascript' src="modules/RecycleBin/language/<?php  echo $_SESSION['authenticated_user_language']; ?>.lang.js"></script>

<form>
<table border=0 cellspacing=1 cellpadding=0 width=100%>
<tr><td>
	<!-- List View's Buttons and Filters starts -->
	<table border=0 cellspacing=0 cellpadding=2 width=100% class="small">
        <tr>
	<!-- Buttons -->
    		<td style="padding-right:20px" nowrap>
				<input type="hidden" id="search_url" value="<?php echo $this->_tpl_vars['SEARCH_URL']; ?>
">
				<input type="hidden" name="idlist" id="idlist">
				<input type="hidden" id="allselectedboxes" name="allselectedboxes">
				<input type="hidden" name="selected_module" id="selected_module" value="<?php echo $this->_tpl_vars['SELECTED_MODULE']; ?>
">
		        <input class="crmbutton small edit" type="button" onclick ="massRestore();" value="<?php echo $this->_tpl_vars['MOD']['LBL_MASS_RESTORE']; ?>
">
		        <input class="crmbutton small delete" type="button" onclick ="callDeleteRecyclebin();" value="<?php echo $this->_tpl_vars['MOD']['LBL_DELETE_RECYCLEBIN']; ?>
">
		        <?php if ($this->_tpl_vars['IS_ADMIN'] == 'true'): ?>
		        <input class="crmbutton small delete" type="button" onclick ="callEmptyRecyclebin();" value="<?php echo $this->_tpl_vars['MOD']['LBL_EMPTY_RECYCLEBIN']; ?>
">
		        <?php endif; ?>
          	</td>
				<!-- Record Counts -->
			<td style="padding-right:20px" class="small" nowrap><?php echo $this->_tpl_vars['RECORD_COUNTS']; ?>
</td>
			<!-- Page Navigation -->		 			 	
			<td nowrap width="30%" align="center">
				<table border=0 cellspacing=0 cellpadding=0 class="small">
					<tr><?php echo $this->_tpl_vars['NAVIGATION']; ?>
</tr>
				</table>
            </td>
			<td width=100% align="right">
				<b><?php echo $this->_tpl_vars['MOD']['LBL_SELECT_MODULE']; ?>
 : </b> 
				<select id="select_module" onChange="changeModule(this);" class="small">
				<?php $_from = $this->_tpl_vars['MODULE_NAME']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mod_name'] => $this->_tpl_vars['module']):
?>
				<?php $this->assign('modulelabel', getTranslatedString($this->_tpl_vars['module'], $this->_tpl_vars['module'])); ?>
				<?php if ($this->_tpl_vars['module'] == $this->_tpl_vars['SELECTED_MODULE']): ?>
	                	<option value="<?php echo $this->_tpl_vars['module']; ?>
" selected><?php echo $this->_tpl_vars['modulelabel']; ?>
</option>
				<?php else: ?>
						<option value="<?php echo $this->_tpl_vars['module']; ?>
"><?php echo $this->_tpl_vars['modulelabel']; ?>
</option>
				<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
	        	</select>
			</td>
		</tr>
	</table>
	<!-- List View's Buttons and Filters ends -->
			
	
	<table border=0 cellspacing=1 cellpadding=3 width=100% class="lvt small">
	<!-- Table Headers -->
	<tr>
          <td class="lvtCol" width=2%><input type="checkbox" onclick='toggleSelect_ListView(this.checked,"selected_id")'  name="selectall" ></td>
	<?php $_from = $this->_tpl_vars['MODULE_DATA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['listviewforeach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['listviewforeach']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['mod_data'] => $this->_tpl_vars['moddata']):
        $this->_foreach['listviewforeach']['iteration']++;
?>
        	<td class="lvtCol" ><?php echo $this->_tpl_vars['moddata']; ?>
</td>
	<?php endforeach; endif; unset($_from); ?>
		<td class="lvtCol" ><?php echo $this->_tpl_vars['APP']['LBL_ACTION']; ?>
</td>
	</tr>
	<?php $_from = $this->_tpl_vars['lvEntries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['entity_id'] => $this->_tpl_vars['lvdata']):
?>
	<tr bgcolor=white onMouseOver="this.className='lvtColDataHover'" onMouseOut="this.className='lvtColData'" id="row_<?php echo $this->_tpl_vars['entity_id']; ?>
">
        <td  width=2%><input type="checkbox" name="selected_id"  onclick='check_object(this)' value="<?php echo $this->_tpl_vars['entity_id']; ?>
"></td>
		<?php $_from = $this->_tpl_vars['lvdata']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['data']):
?>
        <td ><?php echo $this->_tpl_vars['data']; ?>
</td>
		<?php endforeach; endif; unset($_from); ?>
		<td class="samll"> <a href="javascript:;" onclick='restore(<?php echo $this->_tpl_vars['entity_id']; ?>
,"<?php echo $this->_tpl_vars['SELECTED_MODULE']; ?>
");'><?php echo $this->_tpl_vars['MOD']['LNK_RESTORE']; ?>
</a></td>
	</tr>
	<?php endforeach; else: ?>
	<tr>
		<td style="background-color:#efefef;height:340px" align="center" colspan="<?php echo $this->_foreach['listviewforeach']['iteration']+2; ?>
">
			<table width=100% height="400px" align="center">
			<tr>
				<td align="center">
					<div style="border: 3px solid rgb(153, 153, 153); background-color: rgb(255, 255, 255);width:90%;">	
					<table cellspacing=0 cellpadding=5 width=98%  border=0 align=center>
						<tr>
							<td rowspan="2" width="30%" align='right'><img src="<?php echo vtiger_imageurl('empty.jpg', $this->_tpl_vars['THEME']); ?>
" height="60"></td>	
							<td style="border-bottom: 1 px solid rgb(204, 204, 204);" nowrap="nowrap" width="75%"><span class="genHeaderSmall"><?php echo $this->_tpl_vars['MOD']['LBL_EMPTY_MODULE']; ?>
 <?php echo getTranslatedString($this->_tpl_vars['SELECTED_MODULE'], $this->_tpl_vars['SELECTED_MODULE']); ?>
</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
		</table>
	</td>
	</tr>
	<?php endif; unset($_from); ?>
       	 </table>
   </td>
   </tr>
<tr><td>
	<table border=0 cellspacing=0 cellpadding=2 width=100% class="small">
		<tr>
			<!-- Buttons -->
    		<td style="padding-right:20px" nowrap>
				<input type="hidden" name="idlist" id="idlist">
				<input type="hidden" name="selected_module" id="selected_module" value="<?php echo $this->_tpl_vars['SELECTED_MODULE']; ?>
">
	        	<input class="crmbutton small edit" type="button" onclick ="massRestore();" value="<?php echo $this->_tpl_vars['MOD']['LBL_MASS_RESTORE']; ?>
">
		        <input class="crmbutton small delete" type="button" onclick ="callDeleteRecyclebin();" value="<?php echo $this->_tpl_vars['MOD']['LBL_DELETE_RECYCLEBIN']; ?>
">
	        	<?php if ($this->_tpl_vars['IS_ADMIN'] == 'true'): ?>
	        		<input class="crmbutton small delete" type="button" onclick ="callEmptyRecyclebin();" value="<?php echo $this->_tpl_vars['MOD']['LBL_EMPTY_RECYCLEBIN']; ?>
">
	        	<?php endif; ?>
          	</td>
			<!-- Record Counts -->
			<td style="padding-right:20px" class="small" nowrap><?php echo $this->_tpl_vars['RECORD_COUNTS']; ?>
</td>
			<!-- Page Navigation -->		 	
			<td nowrap width="30%" align="center">
				<table border=0 cellspacing=0 cellpadding=0 class="small">
					<tr><?php echo $this->_tpl_vars['NAVIGATION']; ?>
</tr>
				</table>
            </td>
			<td width=100% align="right">&nbsp;</td>
		</tr>
	</table>
</td></tr>		
<!--tr><td>
		<br>
		<table width=100% border=0 cellspacing=0 cellpadding=0>
			<tr><td class="small"><font size=5 color="red">*</font></td><td class="small">Has to be restored manually before restoring the record</td></tr>
			<tr><td class="small"><font size=5 color="green">*</font></td><td class="small">Already exist in the CRM</td></tr>
			<tr><td class="small"><font size=5 color="blue">*</font></td><td class="small">Will be automatically restored when the record is restored.</td></tr>
		</table>
	</td></tr>

	</table>
</td>
<td>

</td>
</tr-->
   </table>


</div>


<?php if ($_REQUEST['mode'] == 'ajax'): ?>
	<div id="search_ajax" style="display:none;">
	<table width="80%" cellpadding="5" cellspacing="0"  class="searchUIBasic small" align="center" border=0>
	<tr>
		<td class="searchUIName small" nowrap align="left">
			<span class="moduleName"><?php echo $this->_tpl_vars['APP']['LBL_SEARCH']; ?>
</span><br>
		</td>
		<td class="small" nowrap align=right><b><?php echo $this->_tpl_vars['APP']['LBL_SEARCH_FOR']; ?>
</b></td>
		<td class="small"><input type="text"  class="txtBox" style="width:120px" name="search_text"></td>
		<td class="small" nowrap><b><?php echo $this->_tpl_vars['APP']['LBL_IN']; ?>
</b>&nbsp;</td>
		<td class="small" nowrap>
			<div id="basicsearchcolumns_real">
				<select name="search_field" id="bas_searchfield" class="txtBox" style="width:150px">
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['SEARCHLISTHEADER']), $this);?>

				</select>
			</div>
			<input type="hidden" name="searchtype" value="BasicSearch">
			<input type="hidden" name="module" value="<?php echo $this->_tpl_vars['SELECTED_MODULE']; ?>
">
			<input type="hidden" name="parenttab" value="<?php echo $this->_tpl_vars['CATEGORY']; ?>
">
			<input type="hidden" name="action" value="index">
			<input type="hidden" name="query" value="true">
			<input type="hidden" name="search_cnt">
		</td>
		<td class="small" nowrap>
			<input name="submit" type="button" class="crmbutton small create" onClick="callRBSearch('Basic');" value=" <?php echo $this->_tpl_vars['APP']['LBL_SEARCH_NOW_BUTTON']; ?>
 ">&nbsp;
		</td>
		<td class="small" valign="top" onMouseOver="this.style.cursor='pointer';" onclick="moveMe('searchAcc');searchshowhide('searchAcc','')">[x]</td>
	</tr>
	<tr>
		<td colspan="7" align="center" class="small">
			<table border=0 cellspacing=0 cellpadding=0 width=100%>
				<tr>
					<?php echo $this->_tpl_vars['ALPHABETICAL']; ?>

				</tr>
			</table>
		</td>
	</tr>
	</table>
<?php endif; ?>

</form>