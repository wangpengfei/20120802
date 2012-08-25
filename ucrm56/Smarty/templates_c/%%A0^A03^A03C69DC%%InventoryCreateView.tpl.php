<?php /* Smarty version 2.6.18, created on 2012-06-05 07:26:33
         compiled from Inventory/InventoryCreateView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'Inventory/InventoryCreateView.tpl', 55, false),array('modifier', 'getTranslatedString', 'Inventory/InventoryCreateView.tpl', 64, false),)), $this); ?>


<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-cold-1.css">
<script type="text/javascript" src="jscalendar/calendar.js"></script>
<script type="text/javascript" src="jscalendar/lang/calendar-<?php echo $this->_tpl_vars['CALENDAR_LANG']; ?>
.js"></script>
<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
<script type="text/javascript" src="include/js/Inventory.js"></script>
<script type="text/javascript" src="modules/Services/Services.js"></script>

<script type="text/javascript">

function sensex_info()
{
        var Ticker = $('tickersymbol').value;
        if(Ticker!='')
        {
		$("vtbusy_info").style.display="inline";
		new Ajax.Request(
          	      'index.php',
                      {queue: {position: 'end', scope: 'command'},
                      		method: 'post',
                        	postBody: 'module=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=Tickerdetail&tickersymbol='+Ticker,
	                        onComplete: function(response) {
					$('autocom').innerHTML = response.responseText;
				        $('autocom').style.display="block";
        	                        $("vtbusy_info").style.display="none";
                	        }
                	}
        	);
        }
}

</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'Buttons_List1.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<table border=0 cellspacing=0 cellpadding=0 width=98% align=center>
   <tr>
	<td valign=top>
		<img src="<?php echo vtiger_imageurl('showPanelTopLeft.gif', $this->_tpl_vars['THEME']); ?>
">
	</td>

	<td class="showPanelBg" valign=top width=100%>
	     		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'EditViewHidden.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	     <div class="small" style="padding:20px">
		
		 <?php if ($this->_tpl_vars['OP_MODE'] == 'edit_view'): ?>   
			 <span class="lvtHeaderText"><font color="purple">[ <?php echo $this->_tpl_vars['ID']; ?>
 ] </font><?php echo $this->_tpl_vars['NAME']; ?>
 -  <?php echo $this->_tpl_vars['APP']['LBL_EDITING']; ?>
 <?php echo getTranslatedString($this->_tpl_vars['SINGLE_MOD'], $this->_tpl_vars['MODULE']); ?>
 <?php echo $this->_tpl_vars['APP']['LBL_INFORMATION']; ?>
</span> <br>
			<?php echo $this->_tpl_vars['UPDATEINFO']; ?>
	 
		 <?php endif; ?>
		 <?php if ($this->_tpl_vars['OP_MODE'] == 'create_view'): ?>
			<?php if ($this->_tpl_vars['DUPLICATE'] != 'true'): ?>
			<span class="lvtHeaderText"><?php echo $this->_tpl_vars['APP']['LBL_CREATING']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_NEW']; ?>
 <?php echo getTranslatedString($this->_tpl_vars['SINGLE_MOD'], $this->_tpl_vars['MODULE']); ?>
</span> <br>
			<?php else: ?>
			<span class="lvtHeaderText"><?php echo $this->_tpl_vars['APP']['LBL_DUPLICATING']; ?>
 "<?php echo $this->_tpl_vars['NAME']; ?>
" </span> <br>
			<?php endif; ?>
		 <?php endif; ?>

		 <hr noshade size=1>
		 <br> 
		
		

				<table border=0 cellspacing=0 cellpadding=0 width=95% align=center>
		   <tr>
			<td>
				<table border=0 cellspacing=0 cellpadding=3 width=100% class="small">
				   <tr>
					<td class="dvtTabCache" style="width:10px" nowrap>&nbsp;</td>

					<?php if ($this->_tpl_vars['BLOCKS_COUNT'] == 2): ?>	
						<td width=75 style="width:15%" align="center" nowrap class="dvtSelectedCell" id="bi" onclick="fnLoadValues('bi','mi','basicTab','moreTab','inventory','<?php echo $this->_tpl_vars['MODULE']; ?>
')"><b><?php echo $this->_tpl_vars['APP']['LBL_BASIC']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_INFORMATION']; ?>
</b></td>
                    				<td class="dvtUnSelectedCell" style="width: 100px;" align="center" nowrap id="mi" onclick="fnLoadValues('mi','bi','moreTab','basicTab','inventory','<?php echo $this->_tpl_vars['MODULE']; ?>
')"><b><?php echo $this->_tpl_vars['APP']['LBL_MORE']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_INFORMATION']; ?>
 </b></td>
                   				<td class="dvtTabCache" style="width:65%" nowrap>&nbsp;</td>
					<?php else: ?>
						<td class="dvtSelectedCell" align=center nowrap><?php echo $this->_tpl_vars['APP']['LBL_BASIC']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_INFORMATION']; ?>
</td>
	                                        <td class="dvtTabCache" style="width:65%">&nbsp;</td>
					<?php endif; ?>
				   <tr>
				</table>
			</td>
		   </tr>
		   <tr>
			<td valign=top align=left >

			    <?php $_from = $this->_tpl_vars['BLOCKS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['divName'] => $this->_tpl_vars['blockInfo']):
?>
			    <!-- Basic and More Information Tab Opened -->
			    <div id="<?php echo $this->_tpl_vars['divName']; ?>
">

				<table border=0 cellspacing=0 cellpadding=3 width=100% class="dvtContentSpace">
				   <tr>
					<!--this td is to display the entity details -->
					<td align=left>
					<!-- content cache -->

						<table border=0 cellspacing=0 cellpadding=0 width=100%>
						   <tr>
							<td id ="autocom"></td>
						   </tr>
						   <tr>
							<td style="padding:10px">
							<!-- General details -->
								<table border=0 cellspacing=0 cellpadding=0 width=100% class="small">
								   <tr>
									<td  colspan=4 style="padding:5px">
									   <div align="center">
										<input title="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_KEY']; ?>
" class="crmbutton small save" onclick="this.form.action.value='Save';  return validateInventory('<?php echo $this->_tpl_vars['MODULE']; ?>
')" type="submit" name="button" value="  <?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
  " style="width:70px" >
                                                                 		<input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="crmbutton small cancel" onclick="window.history.back()" type="button" name="button" value="  <?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
  " style="width:70px">
									   </div>
									</td>
								   </tr>

								   <?php $_from = $this->_tpl_vars['blockInfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['header'] => $this->_tpl_vars['data']):
?>
								   <tr>
									<?php if ($this->_tpl_vars['header'] == $this->_tpl_vars['MOD']['LBL_ADDRESS_INFORMATION'] && ( $this->_tpl_vars['MODULE'] == 'Accounts' || $this->_tpl_vars['MODULE'] == 'Contacts' || $this->_tpl_vars['MODULE'] == 'Quotes' || $this->_tpl_vars['MODULE'] == 'PurchaseOrder' || $this->_tpl_vars['MODULE'] == 'SalesOrder' || $this->_tpl_vars['MODULE'] == 'Invoice' )): ?>
                                                                        <td colspan=2 class="detailedViewHeader">
                                                                        <b><?php echo $this->_tpl_vars['header']; ?>
</b></td>
                                                                        <td class="detailedViewHeader">
                                                                        <input name="cpy" onclick="return copyAddressLeft(EditView)" type="radio"><b><?php echo $this->_tpl_vars['APP']['LBL_RCPY_ADDRESS']; ?>
</b></td>
                                                                        <td class="detailedViewHeader">
                                                                        <input name="cpy" onclick="return copyAddressRight(EditView)" type="radio"><b><?php echo $this->_tpl_vars['APP']['LBL_LCPY_ADDRESS']; ?>
</b></td>
                                                                        <?php else: ?>
						         		<td colspan=4 class="detailedViewHeader">
                                                	        		<b><?php echo $this->_tpl_vars['header']; ?>
</b>
									<?php endif; ?>
									</td>
								   </tr>

								   <!-- Here we should include the uitype handlings-->
								   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "DisplayFields.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

								   <tr style="height:25px"><td>&nbsp;</td></tr>
								   <?php endforeach; endif; unset($_from); ?>

								   <!-- This if is added to restrict display in more tab-->
								   <?php if ($this->_tpl_vars['divName'] == 'basicTab'): ?>
								   <?php if ($this->_tpl_vars['MODULE'] == 'PurchaseOrder' || $this->_tpl_vars['MODULE'] == 'SalesOrder' || $this->_tpl_vars['MODULE'] == 'Quotes' || $this->_tpl_vars['MODULE'] == 'Invoice'): ?>
								   	<!-- Added to display the product details -->
									<!-- This if is added when we want to populate product details from the related entity  for ex. populate product details in new SO page when select Quote -->
									<?php if ($this->_tpl_vars['AVAILABLE_PRODUCTS'] == true): ?>
										<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "Inventory/ProductDetailsEditView.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
									<?php else: ?>
										<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "Inventory/ProductDetails.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
									<?php endif; ?>

								   <?php endif; ?>
								   <?php endif; ?>

								   <tr>
									<td  colspan=4 style="padding:5px">
									   <div align="center">
										<input title="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_KEY']; ?>
" class="crmbutton small save" onclick="this.form.action.value='Save'; return validateInventory('<?php echo $this->_tpl_vars['MODULE']; ?>
')" type="submit" name="button" value="  <?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
  " style="width:70px" >
										<input title="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" class="crmbutton small cancel" onclick="window.history.back()" type="button" name="button" value="  <?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
  " style="width:70px">
										<input type="hidden" name="convert_from" value="<?php echo $this->_tpl_vars['CONVERT_MODE']; ?>
">
                                                                                <input type="hidden" name="duplicate_from" value="<?php echo $this->_tpl_vars['DUPLICATE_FROM']; ?>
">
									   </div>
									</td>
								   </tr>
								</table>
								<!-- General details - end -->
							</td>
						   </tr>
						</table>
					</td>
				   </tr>
				</table>
							
			    </div>
			    <?php endforeach; endif; unset($_from); ?>
			</td>
		   </tr>
		</table>
	 </div>
	</td>
	<td align=right valign=top><img src="<?php echo vtiger_imageurl('showPanelTopRight.gif', $this->_tpl_vars['THEME']); ?>
"></td>
   </tr>
</table>
</form>

<!-- This div is added to get the left and top values to show the tax details-->
<div id="tax_container" style="display:none; position:absolute; z-index:1px;"></div>

<script>



        var fieldname = new Array(<?php echo $this->_tpl_vars['VALIDATION_DATA_FIELDNAME']; ?>
)

        var fieldlabel = new Array(<?php echo $this->_tpl_vars['VALIDATION_DATA_FIELDLABEL']; ?>
)

        var fielddatatype = new Array(<?php echo $this->_tpl_vars['VALIDATION_DATA_FIELDDATATYPE']; ?>
)

	var product_labelarr = {CLEAR_COMMENT:'<?php echo $this->_tpl_vars['APP']['LBL_CLEAR_COMMENT']; ?>
',
                                DISCOUNT:'<?php echo $this->_tpl_vars['APP']['LBL_DISCOUNT']; ?>
',
                                TOTAL_AFTER_DISCOUNT:'<?php echo $this->_tpl_vars['APP']['LBL_TOTAL_AFTER_DISCOUNT']; ?>
',
                                TAX:'<?php echo $this->_tpl_vars['APP']['LBL_TAX']; ?>
',
                                ZERO_DISCOUNT:'<?php echo $this->_tpl_vars['APP']['LBL_ZERO_DISCOUNT']; ?>
',
                                PERCENT_OF_PRICE:'<?php echo $this->_tpl_vars['APP']['LBL_OF_PRICE']; ?>
',
                                DIRECT_PRICE_REDUCTION:'<?php echo $this->_tpl_vars['APP']['LBL_DIRECT_PRICE_REDUCTION']; ?>
'};

</script>

<!-- vtlib customization: Help information assocaited with the fields -->
<?php if ($this->_tpl_vars['FIELDHELPINFO']): ?>
<script type='text/javascript'>
<?php echo 'var fieldhelpinfo = {}; '; ?>

<?php $_from = $this->_tpl_vars['FIELDHELPINFO']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['FIELDHELPKEY'] => $this->_tpl_vars['FIELDHELPVAL']):
?>
	fieldhelpinfo["<?php echo $this->_tpl_vars['FIELDHELPKEY']; ?>
"] = "<?php echo $this->_tpl_vars['FIELDHELPVAL']; ?>
";
<?php endforeach; endif; unset($_from); ?>
</script>
<?php endif; ?>
<!-- END -->