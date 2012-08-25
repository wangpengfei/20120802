<?php /* Smarty version 2.6.18, created on 2012-06-04 12:56:54
         compiled from modules/RecycleBin/RecycleBin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'modules/RecycleBin/RecycleBin.tpl', 23, false),array('function', 'html_options', 'modules/RecycleBin/RecycleBin.tpl', 56, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="include/js/search.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/ListView.js"></script>
<script type='text/javascript' src="modules/RecycleBin/language/<?php  echo $_SESSION['authenticated_user_language']; ?>.lang.js"></script>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'Buttons_List.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                                <div id="searchingUI" style="display:none;">
                                        <table border=0 cellspacing=0 cellpadding=0 width=100%>
                                        <tr>
                                                <td align=center>
                                                <img src="<?php echo vtiger_imageurl('searching.gif', $this->_tpl_vars['THEME']); ?>
" alt="<?php echo $this->_tpl_vars['APP']['LBL_SEARCHING']; ?>
"  title="<?php echo $this->_tpl_vars['APP']['LBL_SEARCHING']; ?>
">
                                                </td>
                                        </tr>
                                        </table>

                                </div>
                        </td>
                </tr>
                </table>
        </td>
</tr>
</table>


<table border=0  cellspacing=0 cellpadding=0 width=98% align=center>

<tr><td valign=top><img src="<?php echo vtiger_imageurl('showPanelTopLeft.gif', $this->_tpl_vars['THEME']); ?>
"></td>
	<td class="showPanelBg" valign="top" width=100% style="padding:10px;">

		<form name="basicSearch" action="index.php" onsubmit="return false;">
		<div id="searchAcc" style="display: none;position:relative;">
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
		</div>
		</form>


	  <div id="modules_datas" class="small" style="width:100%;">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/".($this->_tpl_vars['MODULE'])."/RecycleBinContents.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
</tr></td>


</div>
</td>
</tr>
</table>
</td>
</tr>
</table>

	</td>
        <td valign="top"><img src="<?php echo vtiger_imageurl('showPanelTopRight.gif', $this->_tpl_vars['THEME']); ?>
"></td>
   </tr>
</tbody>
</table>

<div style="display: none;" class="veil_new small" id="rb_delete_conf_id">
	<table cellspacing="0" cellpadding="18" border="0" class="options small">
	<tbody>
		<tr>
			<td nowrap="" align="center" style="color: rgb(255, 255, 255); font-size: 15px;">
				<b><?php echo $this->_tpl_vars['MOD']['MSG_DELETE_RB_CONFIRMATION']; ?>
</b>
			</td>
		</tr>
		<tr>
			<td align="center">
				<input type="button" onclick="return deleteRecyclebin('rb_delete_conf_id');" value="<?php echo $this->_tpl_vars['APP']['LBL_YES']; ?>
"/>  
				<input type="button" onclick="$('rb_delete_conf_id').style.display='none';" value="<?php echo $this->_tpl_vars['APP']['LBL_NO']; ?>
"/>
			</td>
		</tr>
	</tbody>
	</table>
</div>

<div style="display: none;" class="veil_new small" id="rb_empty_conf_id">
	<table cellspacing="0" cellpadding="18" border="0" class="options small">
	<tbody>
		<tr>
			<td nowrap="" align="center" style="color: rgb(255, 255, 255); font-size: 15px;">
				<b><?php echo $this->_tpl_vars['MOD']['MSG_EMPTY_RB_CONFIRMATION']; ?>
</b>
			</td>
		</tr>
		<tr>
			<td align="center">
				<input type="button" onclick="return emptyRecyclebin('rb_empty_conf_id');" value="<?php echo $this->_tpl_vars['APP']['LBL_YES']; ?>
"/>  
				<input type="button" onclick="$('rb_empty_conf_id').style.display='none';" value="<?php echo $this->_tpl_vars['APP']['LBL_NO']; ?>
"/>
			</td>
		</tr>
	</tbody>
	</table>
</div>