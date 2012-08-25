<?php /* Smarty version 2.6.18, created on 2012-06-05 07:32:12
         compiled from Inventory/InventoryActions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'Inventory/InventoryActions.tpl', 44, false),array('modifier', 'getTranslatedString', 'Inventory/InventoryActions.tpl', 167, false),)), $this); ?>

<!-- Avoid this actions display for PriceBook module-->
<?php if ($this->_tpl_vars['MODULE'] != 'PriceBooks'): ?>


<!-- Added this file to display the Inventory Actions based on the Inventory Modules -->
<table width="100%" border="0" cellpadding="5" cellspacing="0">
   <tr>
	<td>&nbsp;</td>
   </tr>

   <!-- This if condition is added to avoid display Tools heading because now there is no options in Tools. -->
   <?php if ($this->_tpl_vars['MODULE'] != 'PurchaseOrder' && $this->_tpl_vars['MODULE'] != 'Invoice'): ?>
   <tr>
	<td align="left" class="genHeaderSmall"><?php echo $this->_tpl_vars['APP']['LBL_ACTIONS']; ?>
</td>
   </tr>
   <?php endif; ?>



	<!-- Module based actions starts -->
	<?php if ($this->_tpl_vars['MODULE'] == 'Products' || $this->_tpl_vars['MODULE'] == 'Services'): ?>
	   <!-- Product/Services Actions starts -->
		<?php if ($this->_tpl_vars['MODULE'] == 'Products'): ?>
			<?php $this->assign('module_id', 'product_id'); ?>
		<?php else: ?>
			<?php $this->assign('module_id', 'parent_id'); ?>
		<?php endif; ?>
	   <tr>
		<td align="left" style="padding-left:5px;">
	<a href="javascript: document.DetailView.module.value='Quotes'; document.DetailView.action.value='CreateView'; document.DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; document.DetailView.return_action.value='DetailView'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.parent_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.<?php echo $this->_tpl_vars['module_id']; ?>
.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.record.value=''; document.DetailView.submit();" class="webMnu"><img src="<?php echo vtiger_imageurl('actionGenerateQuote.gif', $this->_tpl_vars['THEME']); ?>
" hspace="2" align="absmiddle" border="0"/></a>
			<a href="javascript: document.DetailView.module.value='Quotes'; document.DetailView.action.value='CreateView'; document.DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; document.DetailView.return_action.value='DetailView'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.parent_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.<?php echo $this->_tpl_vars['module_id']; ?>
.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.record.value=''; document.DetailView.submit();" class="webMnu"><?php echo $this->_tpl_vars['APP']['LBL_CREATE_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['Quote']; ?>
</a> 
		</td>
	   </tr>
	   <tr>
		<td align="left" style="padding-left:5px;">
			<a href="javascript: document.DetailView.module.value='Invoice'; document.DetailView.action.value='CreateView'; document.DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; document.DetailView.return_action.value='DetailView'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.parent_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.<?php echo $this->_tpl_vars['module_id']; ?>
.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.record.value=''; document.DetailView.submit();" class="webMnu"><img src="<?php echo vtiger_imageurl('actionGenerateInvoice.gif', $this->_tpl_vars['THEME']); ?>
" hspace="2" align="absmiddle" border="0"/></a>
			<a href="javascript: document.DetailView.module.value='Invoice'; document.DetailView.action.value='CreateView'; document.DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; document.DetailView.return_action.value='DetailView'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.parent_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.<?php echo $this->_tpl_vars['module_id']; ?>
.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.record.value=''; document.DetailView.submit();" class="webMnu"><?php echo $this->_tpl_vars['APP']['LBL_CREATE_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['Invoice']; ?>
</a> 
		</td>
	   </tr>
	   <tr>
		<td align="left" style="padding-left:5px;">
<a href="javascript: document.DetailView.module.value='SalesOrder'; document.DetailView.action.value='CreateView'; document.DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; document.DetailView.return_action.value='DetailView'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.parent_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.<?php echo $this->_tpl_vars['module_id']; ?>
.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.record.value=''; document.DetailView.submit();" class="webMnu"><img src="<?php echo vtiger_imageurl('actionGenerateSalesOrder.gif', $this->_tpl_vars['THEME']); ?>
" hspace="2" align="absmiddle" border="0"/></a>
			<a href="javascript: document.DetailView.module.value='SalesOrder'; document.DetailView.action.value='CreateView'; document.DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; document.DetailView.return_action.value='DetailView'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.parent_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.<?php echo $this->_tpl_vars['module_id']; ?>
.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.record.value=''; document.DetailView.submit();" class="webMnu"><?php echo $this->_tpl_vars['APP']['LBL_CREATE_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['SalesOrder']; ?>
</a> 
		</td>
	   </tr>
	   <tr>
		<td align="left" style="padding-left:5px;">
			<a href="javascript: document.DetailView.module.value='PurchaseOrder'; document.DetailView.action.value='CreateView'; document.DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; document.DetailView.return_action.value='DetailView'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.parent_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.<?php echo $this->_tpl_vars['module_id']; ?>
.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.record.value=''; document.DetailView.submit();" class="webMnu"><img src="<?php echo vtiger_imageurl('actionGenPurchaseOrder.gif', $this->_tpl_vars['THEME']); ?>
" hspace="2" align="absmiddle" border="0"/></a>
			<a href="javascript: document.DetailView.module.value='PurchaseOrder'; document.DetailView.action.value='CreateView'; document.DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; document.DetailView.return_action.value='DetailView'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.parent_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.<?php echo $this->_tpl_vars['module_id']; ?>
.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.record.value=''; document.DetailView.submit();" class="webMnu"><?php echo $this->_tpl_vars['APP']['LBL_CREATE_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['PurchaseOrder']; ?>
</a> 
		</td>
	   </tr>

	<?php elseif ($this->_tpl_vars['MODULE'] == 'Vendors'): ?>
	   <!-- Vendors Actions starts -->
	   <tr>
		<td align="left" style="padding-left:10px;">
			<a href="javascript: document.DetailView.module.value='PurchaseOrder'; document.DetailView.action.value='CreateView'; document.DetailView.return_module.value='Vendors'; document.DetailView.return_action.value='DetailView'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.parent_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.vendor_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.record.value=''; document.DetailView.submit();" class="webMnu">	<img src="<?php echo vtiger_imageurl('actionGenPurchaseOrder.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle" border="0"/></a>
			<a href="javascript: document.DetailView.module.value='PurchaseOrder'; document.DetailView.action.value='CreateView'; document.DetailView.return_module.value='Vendors'; document.DetailView.return_action.value='DetailView'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.parent_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.vendor_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.record.value=''; document.DetailView.submit();" class="webMnu"><?php echo $this->_tpl_vars['APP']['LBL_CREATE_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['PurchaseOrder']; ?>
</a> 
		</td>
	   </tr>
	   <!--
	   <tr>
		<td align="left" style="padding-left:10px;">
			<img src="<?php echo vtiger_imageurl('pointer.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle"/>
			<a href="#" class="webMnu">List PurchaseOrders for this Vendor</a> 
		</td>
	   </tr>
	   -->
	   <!-- Vendors Actions ends -->

	<?php elseif ($this->_tpl_vars['MODULE'] == 'PurchaseOrder'): ?>
	   <!-- PO Actions starts -->
	   <!--
	   <tr>
		<td align="left" style="padding-left:10px;">
			<img src="<?php echo vtiger_imageurl('pointer.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle"/>
			<a href="#" class="webMnu">List Other PurchaseOrders to this Vendor</a> 
		</td>
	   </tr>
	   -->
	   <!-- PO Actions ends -->

	<?php elseif ($this->_tpl_vars['MODULE'] == 'SalesOrder'): ?>
	   <!-- SO Actions starts -->
	   <tr>
		<td align="left" style="padding-left:10px;">
			<a href="javascript: document.DetailView.module.value='Invoice'; document.DetailView.action.value='CreateView'; document.DetailView.return_module.value='SalesOrder'; document.DetailView.return_action.value='DetailView'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.record.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.convertmode.value='sotoinvoice'; document.DetailView.submit();" class="webMnu"><img src="<?php echo vtiger_imageurl('actionGenerateInvoice.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle" border="0"/></a>
			<a href="javascript: document.DetailView.module.value='Invoice'; document.DetailView.action.value='CreateView'; document.DetailView.return_module.value='SalesOrder'; document.DetailView.return_action.value='DetailView'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.record.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.convertmode.value='sotoinvoice'; document.DetailView.submit();" class="webMnu"><?php echo $this->_tpl_vars['APP']['LBL_CREATE_BUTTON_LABEL']; ?>
 <?php echo $this->_tpl_vars['APP']['Invoice']; ?>
</a> 
		</td>
	   </tr>
	   <!--
	   <tr>
		<td align="left" style="padding-left:10px;">
			<img src="<?php echo vtiger_imageurl('pointer.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle"/>
			<a href="#" class="webMnu">List Linked Quotes</a> 
		</td>
	   </tr>
	   <tr>
		<td align="left" style="padding-left:10px;">
			<img src="<?php echo vtiger_imageurl('pointer.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle"/>
			<a href="#" class="webMnu">List Linked Invoices</a> 
		</td>
	   </tr>
	   -->
	   <!-- SO Actions ends -->

	<?php elseif ($this->_tpl_vars['MODULE'] == 'Quotes'): ?>
	   <!-- Quotes Actions starts -->

	   <tr>
		<td align="left" style="padding-left:10px;border-bottom:1px dotted #CCCCCC;">
			<a href="javascript: document.DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; document.DetailView.return_action.value='DetailView'; document.DetailView.convertmode.value='quotetoso'; document.DetailView.module.value='SalesOrder'; document.DetailView.action.value='CreateView'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.submit();" class="webMnu"><img src="<?php echo vtiger_imageurl('actionGenerateSalesOrder.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle" border="0"/></a>
			<a href="javascript: document.DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; document.DetailView.return_action.value='DetailView'; document.DetailView.convertmode.value='quotetoso'; document.DetailView.module.value='SalesOrder'; document.DetailView.action.value='CreateView'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.submit();" class="webMnu"><?php echo $this->_tpl_vars['APP']['LBL_GENERATE']; ?>
 <?php echo $this->_tpl_vars['APP']['SalesOrder']; ?>
</a> 
		</td>
	   </tr>
	   <tr>
		<td align="left" style="padding-left:10px;">
<a href="javascript: document.DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; document.DetailView.return_action.value='DetailView'; document.DetailView.convertmode.value='<?php echo $this->_tpl_vars['CONVERTMODE']; ?>
'; document.DetailView.module.value='Invoice'; document.DetailView.action.value='CreateView'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.submit();" class="webMnu"><img src="<?php echo vtiger_imageurl('actionGenerateInvoice.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle" border="0"/></a> 
		<a href="javascript: document.DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; document.DetailView.return_action.value='DetailView'; document.DetailView.convertmode.value='<?php echo $this->_tpl_vars['CONVERTMODE']; ?>
'; document.DetailView.module.value='Invoice'; document.DetailView.action.value='CreateView'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.submit();" class="webMnu"><?php echo $this->_tpl_vars['APP']['LBL_GENERATE']; ?>
 <?php echo $this->_tpl_vars['APP']['Invoice']; ?>
</a> 
		</td>
	   </tr>
	   <!-- Quotes Actions ends -->

	<?php elseif ($this->_tpl_vars['MODULE'] == 'Invoice'): ?>
	   <!-- Invoice Actions starts -->
	   <!--
	   <tr>
		<td align="left" style="padding-left:10px;">
			<img src="<?php echo vtiger_imageurl('pointer.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle"/>
			<a href="#" class="webMnu">List Linked Quotes</a> 
		</td>
	   </tr>
	   -->
	   <!-- Invoice Actions ends -->

	<?php endif; ?>

	<!-- Module based actions ends -->
    
<?php if ($this->_tpl_vars['CUSTOM_LINKS'] && $this->_tpl_vars['CUSTOM_LINKS']['DETAILVIEWBASIC']): ?>
	
	<?php $_from = $this->_tpl_vars['CUSTOM_LINKS']['DETAILVIEWBASIC']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['CUSTOMLINK']):
?>
    <!--<table width="100%" border="0" cellpadding="5" cellspacing="0">-->
	<tr>
		<td align="left" style="padding-left:10px;">
			<?php $this->assign('customlink_href', $this->_tpl_vars['CUSTOMLINK']->linkurl); ?>
			<?php $this->assign('customlink_label', $this->_tpl_vars['CUSTOMLINK']->linklabel); ?>
			<?php if ($this->_tpl_vars['customlink_label'] == ''): ?>
				<?php $this->assign('customlink_label', $this->_tpl_vars['customlink_href']); ?>
			<?php else: ?>
								<?php $this->assign('customlink_label', getTranslatedString($this->_tpl_vars['customlink_label'], $this->_tpl_vars['CUSTOMLINK']->module())); ?>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['CUSTOMLINK']->linkicon): ?>
			<a class="webMnu" href="<?php echo $this->_tpl_vars['customlink_href']; ?>
"><img hspace=5 align="absmiddle" border=0 src="<?php echo $this->_tpl_vars['CUSTOMLINK']->linkicon; ?>
"></a>
			<?php endif; ?>
			<a class="webMnu" href="<?php echo $this->_tpl_vars['customlink_href']; ?>
"><?php echo $this->_tpl_vars['customlink_label']; ?>
</a>
		</td>
	</tr>
    <!--</table>-->
	<?php endforeach; endif; unset($_from); ?>
	
<?php endif; ?>

<?php if ($this->_tpl_vars['CUSTOM_LINKS']): ?>
	<br>
	<?php if (! empty ( $this->_tpl_vars['CUSTOM_LINKS']['DETAILVIEW'] )): ?>					
		<table width="100%" border="0" cellpadding="5" cellspacing="0">
			<tr><td align="left" class="dvtUnSelectedCell dvtCellLabel">
				<a href="javascript:;" onmouseover="fnvshobj(this,'vtlib_customLinksLay');" onclick="fnvshobj(this,'vtlib_customLinksLay');"><b><?php echo $this->_tpl_vars['APP']['LBL_MORE']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_ACTIONS']; ?>
 &#187;</b></a>
			</td></tr>
		</table>
		<br>
		<div style="display: none; left: 193px; top: 106px;width:155px; position:absolute;" id="vtlib_customLinksLay" 
			onmouseout="fninvsh('vtlib_customLinksLay')" onmouseover="fnvshNrm('vtlib_customLinksLay')">
			<table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr><td style="border-bottom: 1px solid rgb(204, 204, 204); padding: 5px;"><b><?php echo $this->_tpl_vars['APP']['LBL_MORE']; ?>
 <?php echo $this->_tpl_vars['APP']['LBL_ACTIONS']; ?>
 &#187;</b></td></tr>
			<tr>
				<td>
					<?php $_from = $this->_tpl_vars['CUSTOM_LINKS']['DETAILVIEW']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['CUSTOMLINK']):
?>
						<?php $this->assign('customlink_href', $this->_tpl_vars['CUSTOMLINK']->linkurl); ?>
						<?php $this->assign('customlink_label', $this->_tpl_vars['CUSTOMLINK']->linklabel); ?>
						<?php if ($this->_tpl_vars['customlink_label'] == ''): ?>
							<?php $this->assign('customlink_label', $this->_tpl_vars['customlink_href']); ?>
						<?php else: ?>
														<?php $this->assign('customlink_label', getTranslatedString($this->_tpl_vars['customlink_label'], $this->_tpl_vars['CUSTOMLINK']->module())); ?>
						<?php endif; ?>
						<a href="<?php echo $this->_tpl_vars['customlink_href']; ?>
" class="drop_down"><?php echo $this->_tpl_vars['customlink_label']; ?>
</a>
					<?php endforeach; endif; unset($_from); ?>
				</td>
			</tr>
			</table>
		</div>
	<?php endif; ?>
	
	<?php if (! empty ( $this->_tpl_vars['CUSTOM_LINKS']['DETAILVIEWWIDGET'] )): ?>
	<?php $_from = $this->_tpl_vars['CUSTOM_LINKS']['DETAILVIEWWIDGET']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['CUSTOMLINK_NO'] => $this->_tpl_vars['CUSTOMLINK']):
?>
		<?php $this->assign('customlink_href', $this->_tpl_vars['CUSTOMLINK']->linkurl); ?>
		<?php $this->assign('customlink_label', $this->_tpl_vars['CUSTOMLINK']->linklabel); ?>
				<?php if (! preg_match ( "/^block:\/\/.*/" , $this->_tpl_vars['customlink_href'] )): ?>
			<?php if ($this->_tpl_vars['customlink_label'] == ''): ?>
				<?php $this->assign('customlink_label', $this->_tpl_vars['customlink_href']); ?>
			<?php else: ?>
								<?php $this->assign('customlink_label', getTranslatedString($this->_tpl_vars['customlink_label'], $this->_tpl_vars['CUSTOMLINK']->module())); ?>
			<?php endif; ?>
			<br/>
			<table border=0 cellspacing=0 cellpadding=0 width=100% class="rightMailMerge">
  				<tr>
					<td class="rightMailMergeHeader">
						<b><?php echo $this->_tpl_vars['customlink_label']; ?>
</b>
						<img id="detailview_block_<?php echo $this->_tpl_vars['CUSTOMLINK_NO']; ?>
_indicator" style="display:none;" src="<?php echo vtiger_imageurl('vtbusy.gif', $this->_tpl_vars['THEME']); ?>
" border="0" align="absmiddle" />
					</td>
  				</tr>
  				<tr style="height:25px">
					<td class="rightMailMergeContent"><div id="detailview_block_<?php echo $this->_tpl_vars['CUSTOMLINK_NO']; ?>
"></div></td>
  				</tr>
  				<script type="text/javascript">
  					vtlib_loadDetailViewWidget("<?php echo $this->_tpl_vars['customlink_href']; ?>
", "detailview_block_<?php echo $this->_tpl_vars['CUSTOMLINK_NO']; ?>
", "detailview_block_<?php echo $this->_tpl_vars['CUSTOMLINK_NO']; ?>
_indicator");
  				</script>
			</table>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	
<?php endif; ?>
<!-- Action links END -->



<!-- Following condition is added to avoid the Tools section in Products and Vendors because we are not providing the Print and Email Now links throughout all the modules. when we provide these links we will remove this if condition -->
<?php if ($this->_tpl_vars['MODULE'] != 'Products' && $this->_tpl_vars['MODULE'] != 'Services' && $this->_tpl_vars['MODULE'] != 'Vendors'): ?>

   <tr>
	<td align="left">
		<span class="genHeaderSmall"><?php echo $this->_tpl_vars['APP']['Tools']; ?>
</span><br /> 
	</td>
   </tr>




<!-- To display the Export To PDF link for PO, SO, Quotes and Invoice - starts -->
<?php if ($this->_tpl_vars['MODULE'] == 'PurchaseOrder' || $this->_tpl_vars['MODULE'] == 'SalesOrder' || $this->_tpl_vars['MODULE'] == 'Quotes' || $this->_tpl_vars['MODULE'] == 'Invoice'): ?>

	<?php if ($this->_tpl_vars['MODULE'] == 'SalesOrder'): ?>
		<?php $this->assign('export_pdf_action', 'CreateSOPDF'); ?>
	<?php else: ?>
		<?php $this->assign('export_pdf_action', 'CreatePDF'); ?>
	<?php endif; ?>

   <tr>
	<td align="left" style="padding-left:10px;">
		<a href="index.php?module=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=<?php echo $this->_tpl_vars['export_pdf_action']; ?>
&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
&return_action=DetailView&record=<?php echo $this->_tpl_vars['ID']; ?>
&return_id=<?php echo $this->_tpl_vars['ID']; ?>
" class="webMnu"><img src="<?php echo vtiger_imageurl('actionGeneratePDF.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle" border="0"/></a>
                <a href="index.php?module=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=<?php echo $this->_tpl_vars['export_pdf_action']; ?>
&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
&return_action=DetailView&record=<?php echo $this->_tpl_vars['ID']; ?>
&return_id=<?php echo $this->_tpl_vars['ID']; ?>
" class="webMnu"><?php echo $this->_tpl_vars['APP']['LBL_EXPORT_TO_PDF']; ?>
</a>
	</td>
   </tr>

<?php if ($this->_tpl_vars['MODULE'] == 'PurchaseOrder' || $this->_tpl_vars['MODULE'] == 'SalesOrder' || $this->_tpl_vars['MODULE'] == 'Quotes' || $this->_tpl_vars['MODULE'] == 'Invoice'): ?>
<!-- Added to give link to  send Invoice PDF through mail -->
 <tr>
	<td align="left" style="padding-left:10px;">
		<a href="javascript: document.DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; document.DetailView.return_action.value='DetailView'; document.DetailView.module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; document.DetailView.action.value='SendPDFMail'; document.DetailView.record.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; sendpdf_submit();" class="webMnu"><img src="<?php echo vtiger_imageurl('PDFMail.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle" border="0"/></a>
		<a href="javascript: document.DetailView.return_module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; document.DetailView.return_action.value='DetailView'; document.DetailView.module.value='<?php echo $this->_tpl_vars['MODULE']; ?>
'; document.DetailView.action.value='SendPDFMail'; document.DetailView.record.value='<?php echo $this->_tpl_vars['ID']; ?>
'; document.DetailView.return_id.value='<?php echo $this->_tpl_vars['ID']; ?>
'; sendpdf_submit();" class="webMnu"><?php echo $this->_tpl_vars['APP']['LBL_SEND_EMAIL_PDF']; ?>
</a> 
	</td>
   </tr>
<?php endif; ?>
<?php endif; ?>
<!-- To display the Export To PDF link for PO, SO, Quotes and Invoice - ends -->



   <!-- The following links are common to all the inventory modules -->
<!--   <tr>
	<td align="left" style="padding-left:10px;">
		<img src="<?php echo vtiger_imageurl('pointer.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle"/>
		<a href="#" class="webMnu">Print</a> 
	</td>
   </tr>
   <tr>
	<td align="left" style="padding-left:10px;">
		<img src="<?php echo vtiger_imageurl('pointer.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle"/>
		<a href="#" class="webMnu">Email Now </a> 
	</td>
   </tr>
-->

<?php endif; ?>
<!-- Above if condition is added to avoid the Tools section in Products and Vendors because we are not providing the Print and Email Now links throughout all the modules. when we provide these links we will remove this if condition -->


    
        <tr><td>
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "modules/PDFMaker/InventoryPdfActions.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </td></tr>
     



</table>

<?php echo '
<script type=\'text/javascript\'>
function sendpdf_submit()
{
	// Submit the form to get the attachment ready for submission
	document.DetailView.submit();
'; ?>


	<?php if ($this->_tpl_vars['MODULE'] == 'Invoice'): ?>
		OpenCompose('<?php echo $this->_tpl_vars['ID']; ?>
','Invoice');
	<?php elseif ($this->_tpl_vars['MODULE'] == 'Quotes'): ?>
		OpenCompose('<?php echo $this->_tpl_vars['ID']; ?>
','Quote');
	<?php elseif ($this->_tpl_vars['MODULE'] == 'PurchaseOrder'): ?>
		OpenCompose('<?php echo $this->_tpl_vars['ID']; ?>
','PurchaseOrder');
	<?php elseif ($this->_tpl_vars['MODULE'] == 'SalesOrder'): ?>
		OpenCompose('<?php echo $this->_tpl_vars['ID']; ?>
','SalesOrder');
	<?php endif; ?>
<?php echo '
}
</script>
'; ?>


<?php endif; ?>