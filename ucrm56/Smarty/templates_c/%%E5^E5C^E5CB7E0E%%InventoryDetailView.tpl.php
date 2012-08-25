<?php /* Smarty version 2.6.18, created on 2012-06-05 07:32:12
         compiled from Inventory/InventoryDetailView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'Inventory/InventoryDetailView.tpl', 180, false),array('modifier', 'getTranslatedString', 'Inventory/InventoryDetailView.tpl', 192, false),array('modifier', 'replace', 'Inventory/InventoryDetailView.tpl', 285, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="include/js/dtlviewajax.js"></script>
<script src="include/scriptaculous/scriptaculous.js" type="text/javascript"></script>
<div id="convertleaddiv" style="display:block;position:absolute;left:225px;top:150px;"></div>
<span id="crmspanid" style="display:none;position:absolute;"  onmouseover="show('crmspanid');">
   <a class="link"  align="right" href="javascript:;"><?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON']; ?>
</a>
</span>
<?php if ($this->_tpl_vars['MODULE'] == 'SalesOrder'): ?>
	<div id="creategathersdiv" style="display:block;position:absolute;left:225px;top:150px;"></div>
	<script>
	<?php echo '
	function callCreateGathersDiv(id)
	{
		new Ajax.Request(
			\'index.php\',
			{queue: {position: \'end\', scope: \'command\'},
				method: \'post\',
				postBody: \'module=SalesOrder&action=SalesOrderAjax&file=CreateGathers&record=\'+id,
				onComplete: function(response) {
					if(response.responseText.indexOf(\'ERROR::\') != -1){
						alert(response.responseText.substr(7));
						return false;
					}
					$("creategathersdiv").innerHTML=response.responseText;
					eval($("addDefaultPlan").innerHTML);
					Drag.init(document.getElementById("gather_div_title"), document.getElementById("orgLay"));
				}
			}
		);
	}
	'; ?>

	</script>
<?php elseif ($this->_tpl_vars['MODULE'] == 'PurchaseOrder'): ?>
	<div id="createchargesdiv" style="display:block;position:absolute;left:225px;top:150px;"></div>
	<script>
	<?php echo '
	function callCreateChargesDiv(id)
	{
		new Ajax.Request(
			\'index.php\',
			{queue: {position: \'end\', scope: \'command\'},
				method: \'post\',
				postBody: \'module=PurchaseOrder&action=PurchaseOrderAjax&file=CreateCharges&record=\'+id,
				onComplete: function(response) {
					if(response.responseText.indexOf(\'ERROR::\') != -1){
						alert(response.responseText.substr(7));
						return false;
					}
					$("createchargesdiv").innerHTML=response.responseText;
					eval($("addDefaultPlan").innerHTML);
					Drag.init(document.getElementById("charge_div_title"), document.getElementById("orgLay"));
				}
			}
		);
	}
	'; ?>

	</script>
<?php endif; ?>
<script>
function tagvalidate()
{
	if(trim(document.getElementById('txtbox_tagfields').value) != '')
		SaveTag('txtbox_tagfields','<?php echo $this->_tpl_vars['ID']; ?>
','<?php echo $this->_tpl_vars['MODULE']; ?>
');	
	else
	{
		alert("<?php echo $this->_tpl_vars['APP']['PLEASE_ENTER_TAG']; ?>
");
		return false;
	}
}
function DeleteTag(id,recordid)
{
	$("vtbusy_info").style.display="inline";
	Effect.Fade('tag_'+id);
	new Ajax.Request(
		'index.php',
                {queue: {position: 'end', scope: 'command'},
                        method: 'post',
                        postBody: "file=TagCloud&module=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=<?php echo $this->_tpl_vars['MODULE']; ?>
Ajax&ajxaction=DELETETAG&recordid="+recordid+"&tagid=" +id,
                        onComplete: function(response) {
						getTagCloud();
						$("vtbusy_info").style.display="none";
                        }
                }
        );
}
<?php echo '
function showHideStatus(sId,anchorImgId,sImagePath)
{
	oObj = eval(document.getElementById(sId));
	if(oObj.style.display == \'block\')
	{
		oObj.style.display = \'none\';
		eval(document.getElementById(anchorImgId)).src =  \'themes/images/inactivate.gif\';
		eval(document.getElementById(anchorImgId)).alt = alert_arr.Display;
		eval(document.getElementById(anchorImgId)).title = alert_arr.Display;
	}
	else
	{
		oObj.style.display = \'block\';
		eval(document.getElementById(anchorImgId)).src =  \'themes/images/activate.gif\';
		eval(document.getElementById(anchorImgId)).alt = alert_arr.Hide;
		eval(document.getElementById(anchorImgId)).title = alert_arr.Hide;
	}
}
function setCoOrdinate(elemId)
{
	oBtnObj = document.getElementById(elemId);
	var tagName = document.getElementById(\'lstRecordLayout\');
	leftpos  = 0;
	toppos = 0;
	aTag = oBtnObj;
	do 
	{					  
	  leftpos  += aTag.offsetLeft;
	  toppos += aTag.offsetTop;
	} while(aTag = aTag.offsetParent);
	
	tagName.style.top= toppos + 20 + \'px\';
	tagName.style.left= leftpos - 276 + \'px\';
}

function getListOfRecords(obj, sModule, iId,sParentTab)
{
		new Ajax.Request(
		\'index.php\',
		{queue: {position: \'end\', scope: \'command\'},
			method: \'post\',
			postBody: \'module=Users&action=getListOfRecords&ajax=true&CurModule=\'+sModule+\'&CurRecordId=\'+iId+\'&CurParentTab=\'+sParentTab,
			onComplete: function(response) {
				sResponse = response.responseText;
				$("lstRecordLayout").innerHTML = sResponse;
				Lay = \'lstRecordLayout\';	
				var tagName = document.getElementById(Lay);
				var leftSide = findPosX(obj);
				var topSide = findPosY(obj);
				var maxW = tagName.style.width;
				var widthM = maxW.substring(0,maxW.length-2);
				var getVal = eval(leftSide) + eval(widthM);
				if(getVal  > document.body.clientWidth ){
					leftSide = eval(leftSide) - eval(widthM);
					tagName.style.left = leftSide + 230 + \'px\';
				}
				else
					tagName.style.left= leftSide + 388 + \'px\';
				
				setCoOrdinate(obj.id);
				
				tagName.style.display = \'block\';
				tagName.style.visibility = "visible";
			}
		}
	);
}
'; ?>


</script>

<div id="lstRecordLayout" class="layerPopup" style="display:none;width:325px;height:300px;"></div> <!-- Code added by SAKTI on 16th Jun, 2008 -->

<table width="100%" cellpadding="2" cellspacing="0" border="0">
   <tr>
	<td>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'Buttons_List1.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<!-- Contents -->
		<table border=0 cellspacing=0 cellpadding=0 width=98% align=center>
		   <tr>
			<td valign=top><img src="<?php echo vtiger_imageurl('showPanelTopLeft.gif', $this->_tpl_vars['THEME']); ?>
"></td>
			<td class="showPanelBg" valign=top width=100%>
			<!-- PUBLIC CONTENTS STARTS-->
			   <div class="small" style="padding:20px" >
		
				<table align="center" border="0" cellpadding="0" cellspacing="0" width="95%">
				   <tr>
					<td>
			         			         <?php $this->assign('USE_ID_VALUE', $this->_tpl_vars['MOD_SEQ_ID']); ?>
		  			 <?php if ($this->_tpl_vars['USE_ID_VALUE'] == ''): ?> <?php $this->assign('USE_ID_VALUE', $this->_tpl_vars['ID']); ?> <?php endif; ?>
		  			
						<span class="lvtHeaderText"><font color="purple">[ <?php echo $this->_tpl_vars['USE_ID_VALUE']; ?>
 ] </font><?php echo $this->_tpl_vars['NAME']; ?>
 -  <?php echo getTranslatedString($this->_tpl_vars['SINGLE_MOD'], $this->_tpl_vars['MODULE']); ?>
 <?php echo $this->_tpl_vars['APP']['LBL_INFORMATION']; ?>
</span>&nbsp;&nbsp;&nbsp;<span class="small"><?php echo $this->_tpl_vars['UPDATEINFO']; ?>
</span>&nbsp;<span id="vtbusy_info" style="display:none;" valign="bottom"><img src="<?php echo vtiger_imageurl('vtbusy.gif', $this->_tpl_vars['THEME']); ?>
" border="0"></span><span id="vtbusy_info" style="visibility:hidden;" valign="bottom"><img src="<?php echo vtiger_imageurl('vtbusy.gif', $this->_tpl_vars['THEME']); ?>
" border="0"></span>
					</td>
				   </tr>
				</table>
				<br>
						
				<!-- Entity and More information tabs -->
				<table border=0 cellspacing=0 cellpadding=0 width=95% align=center>
				   <tr>
					<td>						
   						<table border=0 cellspacing=0 cellpadding=3 width=100% class="small">
						   <tr>
								<td class="dvtTabCache" style="width:10px" nowrap>&nbsp;</td>
								
								<td class="dvtSelectedCell" align=center nowrap><?php echo getTranslatedString($this->_tpl_vars['SINGLE_MOD'], $this->_tpl_vars['MODULE']); ?>
 <?php echo $this->_tpl_vars['APP']['LBL_INFORMATION']; ?>
</td>	
								<td class="dvtTabCache" style="width:10px">&nbsp;</td>
								<?php if ($this->_tpl_vars['SinglePane_View'] == 'false' && $this->_tpl_vars['IS_REL_LIST'] != false): ?>
									<td class="dvtUnSelectedCell" onmouseout="fnHideDrop('More_Information_Modules_List');" onmouseover="fnDropDown(this,'More_Information_Modules_List');" align="center" nowrap>
										<a href="index.php?action=CallRelatedList&module=<?php echo $this->_tpl_vars['MODULE']; ?>
&record=<?php echo $this->_tpl_vars['ID']; ?>
&parenttab=<?php echo $this->_tpl_vars['CATEGORY']; ?>
"><?php echo $this->_tpl_vars['APP']['LBL_MORE']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_INFORMATION']; ?>
</a>
										<div onmouseover="fnShowDrop('More_Information_Modules_List')" onmouseout="fnHideDrop('More_Information_Modules_List')"
													 id="More_Information_Modules_List" class="drop_mnu" style="left: 502px; top: 76px; display: none;">
											<table border="0" cellpadding="0" cellspacing="0" width="100%">
											<?php $_from = $this->_tpl_vars['IS_REL_LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['_RELATION_ID'] => $this->_tpl_vars['_RELATED_MODULE']):
?>
												<tr><td><a class="drop_down" href="index.php?action=CallRelatedList&module=<?php echo $this->_tpl_vars['MODULE']; ?>
&record=<?php echo $this->_tpl_vars['ID']; ?>
&parenttab=<?php echo $this->_tpl_vars['CATEGORY']; ?>
&selected_header=<?php echo $this->_tpl_vars['_RELATED_MODULE']; ?>
&relation_id=<?php echo $this->_tpl_vars['_RELATION_ID']; ?>
"><?php echo getTranslatedString($this->_tpl_vars['_RELATED_MODULE'], $this->_tpl_vars['MODULE']); ?>
</a></td></tr>
											<?php endforeach; endif; unset($_from); ?>
											</table>
										</div>
									</td>
								<?php endif; ?>
								<td class="dvtTabCache" align="right" style="width:100%">
									<?php if ($this->_tpl_vars['EDIT_DUPLICATE'] == 'permitted'): ?>
									<input title="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_KEY']; ?>
" class="crmbutton small edit" onclick="DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; DetailView.return_action.value='DetailView'; DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
';DetailView.module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; submitFormForAction('DetailView','EditView');" type="button" name="Edit" value="&nbsp;<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_LABEL']; ?>
&nbsp;">&nbsp;
									<?php endif; ?>
									<?php if ($this->_tpl_vars['CREATE_DUPLICATE'] == 'permitted' && $this->_tpl_vars['MODULE'] != 'Documents'): ?>
									<input title="<?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON_KEY']; ?>
" class="crmbutton small create" onclick="DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; DetailView.return_action.value='DetailView'; DetailView.isDuplicate.value='true';DetailView.module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; submitFormForAction('DetailView','CreateView');" type="button" name="Duplicate" value="<?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON_LABEL']; ?>
">&nbsp;
									<?php endif; ?>
									<?php if ($this->_tpl_vars['DELETE'] == 'permitted'): ?>
									<input title="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_KEY']; ?>
" class="crmbutton small delete" onclick="DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; DetailView.return_action.value='index'; <?php if ($this->_tpl_vars['MODULE'] == 'Accounts'): ?> var confirmMsg = '<?php echo $this->_tpl_vars['APP']['NTC_ACCOUNT_DELETE_CONFIRMATION']; ?>
' <?php else: ?> var confirmMsg = '<?php echo $this->_tpl_vars['APP']['NTC_DELETE_CONFIRMATION']; ?>
' <?php endif; ?>; submitFormForActionWithConfirmation('DetailView', 'Delete', confirmMsg);" type="button" name="Delete" value="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_LABEL']; ?>
">&nbsp;
									<?php endif; ?>
								
									<?php if ($this->_tpl_vars['privrecord'] != ''): ?>
									<img align="absmiddle" title="<?php echo $this->_tpl_vars['APP']['LNK_LIST_PREVIOUS']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LNK_LIST_PREVIOUS']; ?>
" onclick="location.href='index.php?module=<?php echo $this->_tpl_vars['MODULE']; ?>
&viewtype=<?php echo $this->_tpl_vars['VIEWTYPE']; ?>
&action=DetailView&record=<?php echo $this->_tpl_vars['privrecord']; ?>
&parenttab=<?php echo $this->_tpl_vars['CATEGORY']; ?>
'" name="privrecord" value="<?php echo $this->_tpl_vars['APP']['LNK_LIST_PREVIOUS']; ?>
" src="<?php echo vtiger_imageurl('rec_prev.gif', $this->_tpl_vars['THEME']); ?>
">&nbsp;
									<?php else: ?>
									<img align="absmiddle" title="<?php echo $this->_tpl_vars['APP']['LNK_LIST_PREVIOUS']; ?>
" src="<?php echo vtiger_imageurl('rec_prev_disabled.gif', $this->_tpl_vars['THEME']); ?>
">
									<?php endif; ?>							
									<?php if ($this->_tpl_vars['privrecord'] != '' || $this->_tpl_vars['nextrecord'] != ''): ?>
									<img align="absmiddle" title="<?php echo $this->_tpl_vars['APP']['LBL_JUMP_BTN']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_JUMP_BTN']; ?>
" onclick="var obj = this;var lhref = getListOfRecords(obj, '<?php echo $this->_tpl_vars['MODULE']; ?>
',<?php echo $this->_tpl_vars['ID']; ?>
,'<?php echo $this->_tpl_vars['CATEGORY']; ?>
');" name="jumpBtnIdTop" id="jumpBtnIdTop" src="<?php echo vtiger_imageurl('rec_jump.gif', $this->_tpl_vars['THEME']); ?>
">&nbsp;
									<?php endif; ?>
									<?php if ($this->_tpl_vars['nextrecord'] != ''): ?>
									<img align="absmiddle" title="<?php echo $this->_tpl_vars['APP']['LNK_LIST_NEXT']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LNK_LIST_NEXT']; ?>
" onclick="location.href='index.php?module=<?php echo $this->_tpl_vars['MODULE']; ?>
&viewtype=<?php echo $this->_tpl_vars['VIEWTYPE']; ?>
&action=DetailView&record=<?php echo $this->_tpl_vars['nextrecord']; ?>
&parenttab=<?php echo $this->_tpl_vars['CATEGORY']; ?>
'" name="nextrecord" src="<?php echo vtiger_imageurl('rec_next.gif', $this->_tpl_vars['THEME']); ?>
">&nbsp;
									<?php else: ?>
									<img align="absmiddle" title="<?php echo $this->_tpl_vars['APP']['LNK_LIST_NEXT']; ?>
" src="<?php echo vtiger_imageurl('rec_next_disabled.gif', $this->_tpl_vars['THEME']); ?>
">&nbsp;
									<?php endif; ?>
								</td>
							</tr>
						</table>
					</td>
				   </tr>
				   <tr>
					<td valign=top align=left >
						<table border=0 cellspacing=0 cellpadding=3 width=100% class="dvtContentSpace" style="border-bottom:0px;">
						   <tr valign=top>

							<td align=left style="padding:10px;">
							<!-- content cache -->
								<form action="index.php" method="post" name="DetailView" id="form" onsubmit="VtigerJS_DialogBox.block();">
								<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'DetailViewHidden.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						
								<!-- Entity informations display - starts -->	
								<table border=0 cellspacing=0 cellpadding=0 width=100%>
			                			   <tr>
									<td style="padding:10px;border-right:1px dashed #CCCCCC;" width="80%">



<!-- The following table is used to display the buttons -->
<!-- Button displayed - finished-->
							 <?php require_once(SMARTY_CORE_DIR . 'core.smarty_include_php.php');
smarty_core_smarty_include_php(array('smarty_file' => "./include/DetailViewBlockStatus.php", 'smarty_assign' => '', 'smarty_once' => false, 'smarty_include_vars' => array()), $this); ?>


<!-- Entity information(blocks) display - start -->
<?php $_from = $this->_tpl_vars['BLOCKS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['header'] => $this->_tpl_vars['detail']):
?>
	<table border=0 cellspacing=0 cellpadding=0 width=100% class="small">
	   <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align=right>
		</td>
	   </tr>
	   <tr>
		<?php echo '<td colspan=4 class="dvInnerHeader" ><div style="float:left;font-weight:bold;"><div style="float:left;"><a href="javascript:showHideStatus(\'tbl'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['header'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '') : smarty_modifier_replace($_tmp, ' ', '')); ?><?php echo '\',\'aid'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['header'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '') : smarty_modifier_replace($_tmp, ' ', '')); ?><?php echo '\',\''; ?><?php echo $this->_tpl_vars['IMAGE_PATH']; ?><?php echo '\');">'; ?><?php if ($this->_tpl_vars['BLOCKINITIALSTATUS'][$this->_tpl_vars['header']] == 1): ?><?php echo '<img id="aid'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['header'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '') : smarty_modifier_replace($_tmp, ' ', '')); ?><?php echo '" src="'; ?><?php echo vtiger_imageurl('activate.gif', $this->_tpl_vars['THEME']); ?><?php echo '" style="border: 0px solid #000000;" alt="'; ?><?php echo $this->_tpl_vars['APP']['Hide']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['APP']['Hide']; ?><?php echo '"/>'; ?><?php else: ?><?php echo '<img id="aid'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['header'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '') : smarty_modifier_replace($_tmp, ' ', '')); ?><?php echo '" src="'; ?><?php echo vtiger_imageurl('inactivate.gif', $this->_tpl_vars['THEME']); ?><?php echo '" style="border: 0px solid #000000;" alt="'; ?><?php echo $this->_tpl_vars['APP']['Display']; ?><?php echo '" title="'; ?><?php echo $this->_tpl_vars['APP']['Display']; ?><?php echo '"/>'; ?><?php endif; ?><?php echo '</a></div><b>&nbsp;'; ?><?php echo $this->_tpl_vars['header']; ?><?php echo '</b></div></td>'; ?>

	   </tr>
							</table>
							<?php if ($this->_tpl_vars['BLOCKINITIALSTATUS'][$this->_tpl_vars['header']] == 1): ?>
							<div style="width:auto;display:block;" id="tbl<?php echo ((is_array($_tmp=$this->_tpl_vars['header'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '') : smarty_modifier_replace($_tmp, ' ', '')); ?>
" >
							<?php else: ?>
							<div style="width:auto;display:none;" id="tbl<?php echo ((is_array($_tmp=$this->_tpl_vars['header'])) ? $this->_run_mod_handler('replace', true, $_tmp, ' ', '') : smarty_modifier_replace($_tmp, ' ', '')); ?>
" >
							<?php endif; ?>
							<table border=0 cellspacing=0 cellpadding=0 width="100%" class="small">

	   <?php $_from = $this->_tpl_vars['detail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['detail']):
?>
	   <tr style="height:25px">
		<?php $_from = $this->_tpl_vars['detail']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['label'] => $this->_tpl_vars['data']):
?>
			<?php $this->assign('keyid', $this->_tpl_vars['data']['ui']); ?>
			<?php $this->assign('keyval', $this->_tpl_vars['data']['value']); ?>
			<?php $this->assign('keytblname', $this->_tpl_vars['data']['tablename']); ?>
			<?php $this->assign('keyfldname', $this->_tpl_vars['data']['fldname']); ?>
			<?php $this->assign('keyfldid', $this->_tpl_vars['data']['fldid']); ?>
			<?php $this->assign('keyoptions', $this->_tpl_vars['data']['options']); ?>
			<?php $this->assign('keysecid', $this->_tpl_vars['data']['secid']); ?>
			<?php $this->assign('keyseclink', $this->_tpl_vars['data']['link']); ?>
			<?php $this->assign('keycursymb', $this->_tpl_vars['data']['cursymb']); ?>
			<?php $this->assign('keysalut', $this->_tpl_vars['data']['salut']); ?>
			<?php $this->assign('keycntimage', $this->_tpl_vars['data']['cntimage']); ?>
			   <?php $this->assign('keyadmin', $this->_tpl_vars['data']['isadmin']); ?>
							   

				<?php if ($this->_tpl_vars['label'] != ''): ?>
					<?php if ($this->_tpl_vars['keycntimage'] != ''): ?>
						<td class="dvtCellLabel" align=right width=25%><input type="hidden" id="hdtxt_IsAdmin" value=<?php echo $this->_tpl_vars['keyadmin']; ?>
></input><?php echo $this->_tpl_vars['keycntimage']; ?>
</td>
					<?php elseif ($this->_tpl_vars['label'] != 'Tax Class'): ?><!-- Avoid to display the label Tax Class -->
						<?php if ($this->_tpl_vars['keyid'] == '71' || $this->_tpl_vars['keyid'] == '72'): ?>  <!--CurrencySymbol-->
							<td class="dvtCellLabel" align=right width=25%><input type="hidden" id="hdtxt_IsAdmin" value=<?php echo $this->_tpl_vars['keyadmin']; ?>
></input><?php echo $this->_tpl_vars['label']; ?>
 (<?php echo $this->_tpl_vars['keycursymb']; ?>
)</td>
						<?php else: ?>
							<td class="dvtCellLabel" align=right width=25%><input type="hidden" id="hdtxt_IsAdmin" value=<?php echo $this->_tpl_vars['keyadmin']; ?>
></input><?php echo $this->_tpl_vars['label']; ?>
</td>
						<?php endif; ?>
					<?php endif; ?>  
					<?php if ($this->_tpl_vars['EDIT_PERMISSION'] == 'yes' && $this->_tpl_vars['display_type'] != '2'): ?>
												<?php if (! empty ( $this->_tpl_vars['DETAILVIEW_AJAX_EDIT'] )): ?>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "DetailViewUI.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php else: ?>
							<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "DetailViewFields.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
						<?php endif; ?>
											<?php else: ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "DetailViewFields.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php endif; ?>
				<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
	   </tr>	
	   <?php endforeach; endif; unset($_from); ?>	
	</table>
							 </div> <!-- Line added by SAKTI on 10th Apr, 2008 -->
<?php endforeach; endif; unset($_from); ?>
 
<!-- Entity information(blocks) display - ends -->

<?php if ($this->_tpl_vars['CUSTOM_LINKS'] && ! empty ( $this->_tpl_vars['CUSTOM_LINKS']['DETAILVIEWWIDGET'] )): ?>
<?php $_from = $this->_tpl_vars['CUSTOM_LINKS']['DETAILVIEWWIDGET']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['CUSTOM_LINK_DETAILVIEWWIDGET']):
?>
	<?php if (preg_match ( "/^block:\/\/.*/" , $this->_tpl_vars['CUSTOM_LINK_DETAILVIEWWIDGET']->linkurl )): ?>
		<br>
		<?php 
			echo vtlib_process_widget($this->_tpl_vars['CUSTOM_LINK_DETAILVIEWWIDGET'], $this->_tpl_vars);
		 ?>
	<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
									<br>

										<!-- Product Details informations -->
										<?php echo $this->_tpl_vars['ASSOCIATED_PRODUCTS']; ?>

										</form>
									</td>
<!-- The following table is used to display the buttons -->
								<table border=0 cellspacing=0 cellpadding=0 width=100%>
			                			   <tr>
									<td style="padding:10px;border-right:1px dashed #CCCCCC;" width="80%">

		<table border=0 cellspacing=0 cellpadding=0 width=100%>
		  <tr>
			<td style="border-right:1px dashed #CCCCCC;" width="100%">
			<?php if ($this->_tpl_vars['SinglePane_View'] == 'true'): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'RelatedListNew.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		</td></tr></table>
</td></tr></table>
									<!-- Inventory Actions - ends -->	
									<td width=22% valign=top style="padding:10px;">
										<!-- right side InventoryActions -->
										<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "Inventory/InventoryActions.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

										<br>
										<!-- To display the Tag Clouds -->
										<div>
										      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "TagCloudDisplay.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
										</div>
									</td>
								   </tr>
								   
								</table>
							</td>
						   </tr>
						    <tr>
					<td>						
   						<table border=0 cellspacing=0 cellpadding=3 width=100% class="small">
						   <tr>
								<td class="dvtTabCacheBottom" style="width:10px" nowrap>&nbsp;</td>
								
								<td class="dvtSelectedCellBottom" align=center nowrap><?php echo getTranslatedString($this->_tpl_vars['SINGLE_MOD'], $this->_tpl_vars['MODULE']); ?>
 <?php echo $this->_tpl_vars['APP']['LBL_INFORMATION']; ?>
</td>	
								<td class="dvtTabCacheBottom" style="width:10px">&nbsp;</td>
								<?php if ($this->_tpl_vars['SinglePane_View'] == 'false'): ?>
								<td class="dvtUnSelectedCell" align=center nowrap><a href="index.php?action=CallRelatedList&module=<?php echo $this->_tpl_vars['MODULE']; ?>
&record=<?php echo $this->_tpl_vars['ID']; ?>
&parenttab=<?php echo $this->_tpl_vars['CATEGORY']; ?>
"><?php echo $this->_tpl_vars['APP']['LBL_MORE']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_INFORMATION']; ?>
</a></td>
								<?php endif; ?>
								<td class="dvtTabCacheBottom" align="right" style="width:100%">
									<?php if ($this->_tpl_vars['EDIT_DUPLICATE'] == 'permitted'): ?>
									<input title="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_KEY']; ?>
" class="crmbutton small edit" onclick="DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; DetailView.return_action.value='DetailView'; DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
';DetailView.module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; submitFormForAction('DetailView','EditView');" type="button" name="Edit" value="&nbsp;<?php echo $this->_tpl_vars['APP']['LBL_EDIT_BUTTON_LABEL']; ?>
&nbsp;">&nbsp;
									<?php endif; ?>
									<?php if ($this->_tpl_vars['CREATE_DUPLICATE'] == 'permitted' && $this->_tpl_vars['MODULE'] != 'Documents'): ?>
									<input title="<?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON_KEY']; ?>
" class="crmbutton small create" onclick="DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; DetailView.return_action.value='DetailView'; DetailView.isDuplicate.value='true';DetailView.module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; submitFormForAction('DetailView','CreateView');" type="button" name="Duplicate" value="<?php echo $this->_tpl_vars['APP']['LBL_DUPLICATE_BUTTON_LABEL']; ?>
">&nbsp;
									<?php endif; ?>
									<?php if ($this->_tpl_vars['DELETE'] == 'permitted'): ?>
									<input title="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_KEY']; ?>
" class="crmbutton small delete" onclick="DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; DetailView.return_action.value='index'; <?php if ($this->_tpl_vars['MODULE'] == 'Accounts'): ?> var confirmMsg = '<?php echo $this->_tpl_vars['APP']['NTC_ACCOUNT_DELETE_CONFIRMATION']; ?>
' <?php else: ?> var confirmMsg = '<?php echo $this->_tpl_vars['APP']['NTC_DELETE_CONFIRMATION']; ?>
' <?php endif; ?>; submitFormForActionWithConfirmation('DetailView', 'Delete', confirmMsg);" type="button" name="Delete" value="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON_LABEL']; ?>
">&nbsp;
									<?php endif; ?>
								
									<?php if ($this->_tpl_vars['privrecord'] != ''): ?>
									<img align="absmiddle" title="<?php echo $this->_tpl_vars['APP']['LNK_LIST_PREVIOUS']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LNK_LIST_PREVIOUS']; ?>
" onclick="location.href='index.php?module=<?php echo $this->_tpl_vars['MODULE']; ?>
&viewtype=<?php echo $this->_tpl_vars['VIEWTYPE']; ?>
&action=DetailView&record=<?php echo $this->_tpl_vars['privrecord']; ?>
&parenttab=<?php echo $this->_tpl_vars['CATEGORY']; ?>
'" name="privrecord" value="<?php echo $this->_tpl_vars['APP']['LNK_LIST_PREVIOUS']; ?>
" src="<?php echo vtiger_imageurl('rec_prev.gif', $this->_tpl_vars['THEME']); ?>
">&nbsp;
									<?php else: ?>
									<img align="absmiddle" title="<?php echo $this->_tpl_vars['APP']['LNK_LIST_PREVIOUS']; ?>
" src="<?php echo vtiger_imageurl('rec_prev_disabled.gif', $this->_tpl_vars['THEME']); ?>
">
									<?php endif; ?>							
									<?php if ($this->_tpl_vars['privrecord'] != '' || $this->_tpl_vars['nextrecord'] != ''): ?>
									<img align="absmiddle" title="<?php echo $this->_tpl_vars['APP']['LBL_JUMP_BTN']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_JUMP_BTN']; ?>
" onclick="var obj = this;var lhref = getListOfRecords(obj, '<?php echo $this->_tpl_vars['MODULE']; ?>
',<?php echo $this->_tpl_vars['ID']; ?>
,'<?php echo $this->_tpl_vars['CATEGORY']; ?>
');" name="jumpBtnIdBottom" id="jumpBtnIdBottom" src="<?php echo vtiger_imageurl('rec_jump.gif', $this->_tpl_vars['THEME']); ?>
">&nbsp;
									<?php endif; ?>
									<?php if ($this->_tpl_vars['nextrecord'] != ''): ?>
									<img align="absmiddle" title="<?php echo $this->_tpl_vars['APP']['LNK_LIST_NEXT']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LNK_LIST_NEXT']; ?>
" onclick="location.href='index.php?module=<?php echo $this->_tpl_vars['MODULE']; ?>
&viewtype=<?php echo $this->_tpl_vars['VIEWTYPE']; ?>
&action=DetailView&record=<?php echo $this->_tpl_vars['nextrecord']; ?>
&parenttab=<?php echo $this->_tpl_vars['CATEGORY']; ?>
'" name="nextrecord" src="<?php echo vtiger_imageurl('rec_next.gif', $this->_tpl_vars['THEME']); ?>
">&nbsp;
									<?php else: ?>
									<img align="absmiddle" title="<?php echo $this->_tpl_vars['APP']['LNK_LIST_NEXT']; ?>
" src="<?php echo vtiger_imageurl('rec_next_disabled.gif', $this->_tpl_vars['THEME']); ?>
">&nbsp;
									<?php endif; ?>
								</td>
							</tr>
						</table>
					</td>
				   </tr>
						</table>
					<!-- PUBLIC CONTENTS STOPS-->
					</td>
					<td align=right valign=top>
						<img src="<?php echo vtiger_imageurl('showPanelTopRight.gif', $this->_tpl_vars['THEME']); ?>
">
					</td>
				   </tr>
				</table>
			   </div>
			</td>
		   </tr>
		</table>
		<!-- Contents - end -->

<script>
function getTagCloud()
{
new Ajax.Request(
        'index.php',
        {queue: {position: 'end', scope: 'command'},
        method: 'post',
        postBody: 'module=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=<?php echo $this->_tpl_vars['MODULE']; ?>
Ajax&file=TagCloud&ajxaction=GETTAGCLOUD&recordid=<?php echo $this->_tpl_vars['ID']; ?>
',
        onComplete: function(response) {
                                $("tagfields").innerHTML=response.responseText;
                                $("txtbox_tagfields").value ='';
                        }
        }
);
}
getTagCloud();
</script>

	</td>
   </tr>
</table>
<script language="javascript">
  var fieldname = new Array(<?php echo $this->_tpl_vars['VALIDATION_DATA_FIELDNAME']; ?>
);
  var fieldlabel = new Array(<?php echo $this->_tpl_vars['VALIDATION_DATA_FIELDLABEL']; ?>
);
  var fielddatatype = new Array(<?php echo $this->_tpl_vars['VALIDATION_DATA_FIELDDATATYPE']; ?>
);
</script>


<script language="javascript">
<?php echo '
function ChangeStatus(statusname)
{
	var idstring = document.getElementById(\'idlist\').value;	

	fninvsh(\'changestatus\');

	var urlstring ="module=SalesOrder&action=MassEditSave&parenttab=Sales&massedit_module=SalesOrder&massedit_recordids="+idstring+\'&sostatus=\'+document.getElementById(\'lead_status\').options[document.getElementById(\'lead_status\').options.selectedIndex].value+\'&sostatus_mass_edit_check=on\';

	new Ajax.Request(
                \'index.php\',
                {queue: {position: \'end\', scope: \'command\'},
                        method: \'post\',
                        postBody: urlstring,
                        onComplete: function(response) {
                                window.location.reload();
                        }
                }
        );
	
}

</script>
'; ?>

<div id="changestatus" class="statechange">
<table width="100%" border="0" cellpadding="3" cellspacing="0">
<tr>
	<td class="genHeaderSmall" align="left" style="border-bottom:1px solid #CCCCCC;" width="60%"><?php echo $this->_tpl_vars['APP']['LBL_APPROVAL']; ?>
</td>
	<td align="right" style="border-bottom:1px solid #CCCCCC;" width="40%"><a href="javascript:fninvsh('changestatus')"><?php echo $this->_tpl_vars['APP']['LBL_CLOSE']; ?>
</a></td>
</tr>
<tr>
	<td ><b><?php echo $this->_tpl_vars['APP']['LBL_APPROVAL']; ?>
 :</b></td>
	<td >
			<select name="lead_status" id="lead_status" class="detailedViewTextBox">
				<?php echo $this->_tpl_vars['LEAD_STATUS']; ?>

			</select>
	</td>
</tr>
<tr><td colspan="3" style="border-bottom:1px dashed #CCCCCC;">&nbsp;</td></tr>
<tr>
	<td colspan="3" align="center">
	&nbsp;&nbsp;
	<input type="button" name="button" class="crmbutton small edit" value="<?php echo $this->_tpl_vars['APP']['LBL_APPROVAL']; ?>
" onClick="ChangeStatus('changestatus')">
	<input type="button" name="button" class="crmbutton small cancel" value="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
" onClick="fninvsh('changestatus')">
</td>
</tr>
</table>
</div>