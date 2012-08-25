<?php /* Smarty version 2.6.18, created on 2012-06-05 07:26:33
         compiled from Inventory/ProductDetails.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'getTranslatedCurrencyString', 'Inventory/ProductDetails.tpl', 120, false),array('modifier', 'vtiger_imageurl', 'Inventory/ProductDetails.tpl', 172, false),)), $this); ?>

<script type="text/javascript" src="include/js/Inventory.js"></script>
<script type="text/javascript" src="modules/Services/Services.js"></script>
<script>
if(!e)
	window.captureEvents(Event.MOUSEMOVE);

//  window.onmousemove= displayCoords;
//  window.onclick = fnRevert;
  
function displayCoords(currObj,obj,mode,curr_row) 
{
	if(mode != 'discount_final' && mode != 'sh_tax_div_title' && mode != 'group_tax_div_title')
	{
		var curr_productid = document.getElementById("hdnProductId"+curr_row).value;
		if(curr_productid == '')
		{
			alert("<?php echo $this->_tpl_vars['APP']['PLEASE_SELECT_LINE_ITEM']; ?>
");
			return false;
		}

		var curr_quantity = document.getElementById("qty"+curr_row).value;
		if(curr_quantity == '')
		{
			alert("<?php echo $this->_tpl_vars['APP']['PLEASE_FILL_QUANTITY']; ?>
");
			return false;
		}
	}

	//Set the Header value for Discount
	if(mode == 'discount')
	{
		document.getElementById("discount_div_title"+curr_row).innerHTML = '<b><?php echo $this->_tpl_vars['APP']['LABEL_SET_DISCOUNT_FOR_COLON']; ?>
 '+document.getElementById("productTotal"+curr_row).innerHTML+'</b>';
	}
	else if(mode == 'tax')
	{
		document.getElementById("tax_div_title"+curr_row).innerHTML = "<b><?php echo $this->_tpl_vars['APP']['LABEL_SET_TAX_FOR']; ?>
 "+document.getElementById("totalAfterDiscount"+curr_row).innerHTML+'</b>';
	}
	else if(mode == 'discount_final')
	{
		document.getElementById("discount_div_title_final").innerHTML = '<b><?php echo $this->_tpl_vars['APP']['LABEL_SET_DISCOUNT_FOR']; ?>
 '+document.getElementById("netTotal").innerHTML+'</b>';
	}
	else if(mode == 'sh_tax_div_title')
	{
		document.getElementById("sh_tax_div_title").innerHTML = '<b><?php echo $this->_tpl_vars['APP']['LABEL_SET_SH_TAX_FOR_COLON']; ?>
 '+document.getElementById("shipping_handling_charge").value+'</b>';
	}
	else if(mode == 'group_tax_div_title')
	{
		var net_total_after_discount = eval(document.getElementById("netTotal").innerHTML)-eval(document.getElementById("discountTotal_final").innerHTML);
		document.getElementById("group_tax_div_title").innerHTML = '<b><?php echo $this->_tpl_vars['APP']['LABEL_SET_GROUP_TAX_FOR_COLON']; ?>
 '+net_total_after_discount+'</b>';
	}

	fnvshobj(currObj,'tax_container');
	if(document.all)
	{
		var divleft = document.getElementById("tax_container").style.left;
		var divabsleft = divleft.substring(0,divleft.length-2);
		document.getElementById(obj).style.left = eval(divabsleft) - 120;

		var divtop = document.getElementById("tax_container").style.top;
		var divabstop =  divtop.substring(0,divtop.length-2);
		document.getElementById(obj).style.top = eval(divabstop) - 200;
	}else
	{
		document.getElementById(obj).style.left =  document.getElementById("tax_container").left;
		document.getElementById(obj).style.top = document.getElementById("tax_container").top;
	}
	document.getElementById(obj).style.display = "block";

}
  
	function doNothing(){
	}
	
	function fnHidePopDiv(obj){
		document.getElementById(obj).style.display = 'none';
	}
</script>

<!-- Added this file to display and hanld the Product Details in Inventory module  -->

   <tr>
	<td colspan="4" align="left">



<table width="100%"  border="0" align="center" cellpadding="5" cellspacing="0" class="crmTable" id="proTab">
   <tr>
   	<?php if ($this->_tpl_vars['MODULE'] != 'PurchaseOrder'): ?>
			<td colspan="3" class="dvInnerHeader">
	<?php else: ?>
			<td colspan="2" class="dvInnerHeader">
	<?php endif; ?>
		<b><?php echo $this->_tpl_vars['APP']['LBL_ITEM_DETAILS']; ?>
</b>
	</td>
	
	<td class="dvInnerHeader" align="center" colspan="2">
		<input type="hidden" value="<?php echo $this->_tpl_vars['INV_CURRENCY_ID']; ?>
" id="prev_selected_currency_id" />
		<b><?php echo $this->_tpl_vars['APP']['LBL_CURRENCY']; ?>
</b>&nbsp;&nbsp;
		<select class="small" id="inventory_currency" name="inventory_currency" onchange="updatePrices();">
		<?php $_from = $this->_tpl_vars['CURRENCIES_LIST']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['count'] => $this->_tpl_vars['currency_details']):
?>
			<?php if ($this->_tpl_vars['currency_details']['curid'] == $this->_tpl_vars['INV_CURRENCY_ID']): ?>
				<?php $this->assign('currency_selected', 'selected'); ?>
			<?php else: ?>
				<?php $this->assign('currency_selected', ""); ?>
			<?php endif; ?>
			<OPTION value="<?php echo $this->_tpl_vars['currency_details']['curid']; ?>
" <?php echo $this->_tpl_vars['currency_selected']; ?>
><?php echo getTranslatedCurrencyString($this->_tpl_vars['currency_details']['currencylabel']); ?>
 (<?php echo $this->_tpl_vars['currency_details']['currencysymbol']; ?>
)</OPTION>
		<?php endforeach; endif; unset($_from); ?>
		</select>
	</td>
	
	<td class="dvInnerHeader" align="center" colspan="2">
		<b><?php echo $this->_tpl_vars['APP']['LBL_TAX_MODE']; ?>
</b>&nbsp;&nbsp;
		<select id="taxtype" name="taxtype" onchange="decideTaxDiv(); calcTotal();">
			<OPTION value="individual" selected><?php echo $this->_tpl_vars['APP']['LBL_INDIVIDUAL']; ?>
</OPTION>
			<OPTION value="group"><?php echo $this->_tpl_vars['APP']['LBL_GROUP']; ?>
</OPTION>
		</select>
	</td>
   </tr>


   <!-- Header for the Product Details -->
   <tr valign="top">
	<td width=5% valign="top" class="lvtCol" align="right"><b><?php echo $this->_tpl_vars['APP']['LBL_TOOLS']; ?>
</b></td>
	<td width=40% class="lvtCol"><font color='red'>*</font><b><?php echo $this->_tpl_vars['APP']['LBL_ITEM_NAME']; ?>
</b></td>
	<?php if ($this->_tpl_vars['MODULE'] != 'PurchaseOrder'): ?>
		<td width=10% class="lvtCol"><b><?php echo $this->_tpl_vars['APP']['LBL_QTY_IN_STOCK']; ?>
</b></td>
	<?php endif; ?>
	<td width=10% class="lvtCol"><b><?php echo $this->_tpl_vars['APP']['LBL_QTY']; ?>
</b></td>
	<td width=10% class="lvtCol" align="right"><b><?php echo $this->_tpl_vars['APP']['LBL_LIST_PRICE']; ?>
</b></td>
	<td width=12% nowrap class="lvtCol" align="right"><b><?php echo $this->_tpl_vars['APP']['LBL_TOTAL']; ?>
</b></td>
	<td width=13% valign="top" class="lvtCol" align="right"><b><?php echo $this->_tpl_vars['APP']['LBL_NET_PRICE']; ?>
</b></td>
   </tr>






<!-- Following code is added for form the first row. Based on these we should form additional rows using script -->

   <!-- Product Details First row - Starts -->
   <tr valign="top" id="row1">

	<!-- column 1 - delete link - starts -->
	<td  class="crmTableRow small lineOnTop">&nbsp;
		<input type="hidden" id="deleted1" name="deleted1" value="0">
	</td>
	<!-- column 1 - delete link - ends -->

	<!-- column 2 - Product Name - starts -->
	<td class="crmTableRow small lineOnTop">
		<table width="100%"  border="0" cellspacing="0" cellpadding="1">
		   <tr>
			<td class="small">
				<input type="text" id="productName1" name="productName1" class="small" style="width:70%" value="<?php echo $this->_tpl_vars['PRODUCT_NAME']; ?>
" readonly />
				<input type="hidden" id="hdnProductId1" name="hdnProductId1" value="<?php echo $this->_tpl_vars['PRODUCT_ID']; ?>
" />
				<input type="hidden" id="lineItemType1" name="lineItemType1" value="Products" />
				&nbsp;<img id="searchIcon1" title="Products" src="<?php echo vtiger_imageurl('products.gif', $this->_tpl_vars['THEME']); ?>
" style="cursor: pointer;" align="absmiddle" onclick="productPickList(this,'<?php echo $this->_tpl_vars['MODULE']; ?>
',1)" />
			</td>
		</tr>
		<tr>
			<td class="small">
				<input type="hidden" value="" id="subproduct_ids1" name="subproduct_ids1" />
				<span id="subprod_names1" name="subprod_names1" style="color:#C0C0C0;font-style:italic;"> </span>
			</td>
		   </tr>
		   <tr valign="bottom">
			<td class="small" id="setComment">
				<textarea id="comment1" name="comment1" class=small style="width:70%;height:40px"></textarea>
				<img src="<?php echo vtiger_imageurl('clear_field.gif', $this->_tpl_vars['THEME']); ?>
" onClick="<?php echo '$'; ?>
('comment1').value=''"; style="cursor:pointer;" />
			</td>
		   </tr>
		</table>
	</td>
	<!-- column 2 - Product Name - ends -->

	<!-- column 3 - Quantity in Stock - starts -->
	<?php if ($this->_tpl_vars['MODULE'] != 'PurchaseOrder'): ?>
		<td class="crmTableRow small lineOnTop" ><span id="qtyInStock1"><?php echo $this->_tpl_vars['QTY_IN_STOCK']; ?>
</span></td>
	<?php endif; ?>
	<!-- column 3 - Quantity in Stock - ends -->


	<!-- column 4 - Quantity - starts -->
	<td class="crmTableRow small lineOnTop">
		<input id="qty1" name="qty1" type="text" class="small " style="width:50px" onfocus="this.className='detailedViewTextBoxOn'" onBlur="settotalnoofrows();calcTotal(); loadTaxes_Ajax(1); setDiscount(this,'1'); calcTotal();<?php if ($this->_tpl_vars['MODULE'] == 'Invoice'): ?>stock_alert(1);<?php endif; ?>" value=""/><br><span id="stock_alert1"></span>
	</td>
	<!-- column 4 - Quantity - ends -->


	<!-- column 5 - List Price with Discount, Total After Discount and Tax as table - starts -->
	<td class="crmTableRow small lineOnTop" align="right">
		<table width="100%" cellpadding="0" cellspacing="0">
		   <tr>
			<td align="right">
				<input id="listPrice1" name="listPrice1" value="<?php echo $this->_tpl_vars['UNIT_PRICE']; ?>
" type="text" class="small " style="width:70px" onBlur="calcTotal();setDiscount(this,'1'); callTaxCalc(1);calcTotal();"/>&nbsp;<img src="<?php echo vtiger_imageurl('pricebook.gif', $this->_tpl_vars['THEME']); ?>
" onclick="priceBookPickList(this,1)">
			</td>
		   </tr>
		   <tr>
			<td align="right" style="padding:5px;" nowrap>
				(-)&nbsp;<b><a href="javascript:doNothing();" onClick="displayCoords(this,'discount_div1','discount','1')" ><?php echo $this->_tpl_vars['APP']['LBL_DISCOUNT']; ?>
</a> : </b>
				<div class="discountUI" id="discount_div1">
					<input type="hidden" id="discount_type1" name="discount_type1" value="">
					<table width="100%" border="0" cellpadding="5" cellspacing="0" class="small">
					   <tr>
						<td id="discount_div_title1" nowrap align="left" ></td>
						<td align="right"><img src="<?php echo vtiger_imageurl('close.gif', $this->_tpl_vars['THEME']); ?>
" border="0" onClick="fnHidePopDiv('discount_div1')" style="cursor:pointer;"></td>
					   </tr>
					   <tr>
						<td align="left" class="lineOnTop"><input type="radio" name="discount1" checked onclick="setDiscount(this,1); callTaxCalc(1);calcTotal();">&nbsp; <?php echo $this->_tpl_vars['APP']['LBL_ZERO_DISCOUNT']; ?>
</td>
						<td class="lineOnTop">&nbsp;</td>
					   </tr>
					   <tr>
						<td align="left"><input type="radio" name="discount1" onclick="setDiscount(this,1); callTaxCalc(1);calcTotal();">&nbsp; % <?php echo $this->_tpl_vars['APP']['LBL_OF_PRICE']; ?>
</td>
						<td align="right"><input type="text" class="small" size="5" id="discount_percentage1" name="discount_percentage1" value="0" style="visibility:hidden" onBlur="setDiscount(this,1); callTaxCalc(1);calcTotal();">&nbsp;%</td>
					   </tr>
					   <tr>
						<td align="left" nowrap><input type="radio" name="discount1" onclick="setDiscount(this,1); callTaxCalc(1);calcTotal();">&nbsp;<?php echo $this->_tpl_vars['APP']['LBL_DIRECT_PRICE_REDUCTION']; ?>
</td>
						<td align="right"><input type="text" id="discount_amount1" name="discount_amount1" size="5" value="0" style="visibility:hidden" onBlur="setDiscount(this,1); callTaxCalc(1);calcTotal();"></td>
					   </tr>
					</table>
				</div>
			</td>
		   </tr>
		   <tr>
			<td align="right" style="padding:5px;" nowrap>
				<b><?php echo $this->_tpl_vars['APP']['LBL_TOTAL_AFTER_DISCOUNT']; ?>
 :</b>
			</td>
		   </tr>
		   <tr id="individual_tax_row1" class="TaxShow">
			<td align="right" style="padding:5px;" nowrap>
				(+)&nbsp;<b><a href="javascript:doNothing();" onClick="displayCoords(this,'tax_div1','tax','1')" ><?php echo $this->_tpl_vars['APP']['LBL_TAX']; ?>
 </a> : </b>
				<div class="discountUI" id="tax_div1">
				</div>
			</td>
		   </tr>
		</table> 
	</td>
	<!-- column 5 - List Price with Discount, Total After Discount and Tax as table - ends -->


	<!-- column 6 - Product Total - starts -->
	<td class="crmTableRow small lineOnTop" align="right">
		<table width="100%" cellpadding="5" cellspacing="0">
		   <tr>
			<td id="productTotal1" align="right">&nbsp;</td>
		   </tr>
		   <tr>
			<td id="discountTotal1" align="right">0.00</td>
		   </tr>
		   <tr>
			<td id="totalAfterDiscount1" align="right">&nbsp;</td>
		   </tr>
		   <tr>
			<td id="taxTotal1" align="right">0.00</td>
		   </tr>
		</table>
	</td>
	<!-- column 6 - Product Total - ends -->


	<!-- column 7 - Net Price - starts -->
	<td valign="bottom" class="crmTableRow small lineOnTop" align="right"><span id="netPrice1"><b>&nbsp;</b></span></td>
	<!-- column 7 - Net Price - ends -->

   </tr>
   <!-- Product Details First row - Ends -->
</table>
<!-- Upto this has been added for form the first row. Based on these above we should form additional rows using script -->










<table width="100%"  border="0" align="center" cellpadding="5" cellspacing="0" class="crmTable">
   <!-- Add Product Button -->
   <tr>
	<td colspan="3">
			<input type="button" name="Button" class="crmbutton small create" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_PRODUCT']; ?>
" onclick="fnAddProductRow('<?php echo $this->_tpl_vars['MODULE']; ?>
','<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
');" />
			&nbsp;&nbsp;
			<input type="button" name="Button" class="crmbutton small create" value="<?php echo $this->_tpl_vars['APP']['LBL_ADD_SERVICE']; ?>
" onclick="fnAddServiceRow('<?php echo $this->_tpl_vars['MODULE']; ?>
','<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
');" />
	</td>
   </tr>




   <!-- Product Details Final Total Discount, Tax and Shipping&Hanling  - Starts -->
   <tr valign="top">
	<td width="88%" colspan="2" class="crmTableRow small lineOnTop" align="right"><b><?php echo $this->_tpl_vars['APP']['LBL_NET_TOTAL']; ?>
</b></td>
	<td width="12%" id="netTotal" class="crmTableRow small lineOnTop" align="right">0.00</td>
   </tr>

   <tr valign="top">
	<td class="crmTableRow small lineOnTop" width="60%" style="border-right:1px #dadada;">&nbsp;</td>
	<td class="crmTableRow small lineOnTop" align="right">
		(-)&nbsp;<b><a href="javascript:doNothing();" onClick="displayCoords(this,'discount_div_final','discount_final','1')"><?php echo $this->_tpl_vars['APP']['LBL_DISCOUNT']; ?>
</a>
		<!-- Popup Discount DIV -->
		<div class="discountUI" id="discount_div_final">
			<input type="hidden" id="discount_type_final" name="discount_type_final" value="">
			<table width="100%" border="0" cellpadding="5" cellspacing="0" class="small">
			   <tr>
				<td id="discount_div_title_final" nowrap align="left" ></td>
				<td align="right"><img src="<?php echo vtiger_imageurl('close.gif', $this->_tpl_vars['THEME']); ?>
" border="0" onClick="fnHidePopDiv('discount_div_final')" style="cursor:pointer;"></td>
			   </tr>
			   <tr>
				<td align="left" class="lineOnTop"><input type="radio" name="discount_final" checked onclick="setDiscount(this,'_final'); calcGroupTax();calcTotal();">&nbsp; <?php echo $this->_tpl_vars['APP']['LBL_ZERO_DISCOUNT']; ?>
</td>
				<td class="lineOnTop">&nbsp;</td>
			   </tr>
			   <tr>
				<td align="left"><input type="radio" name="discount_final" onclick="setDiscount(this,'_final'); calcGroupTax();calcTotal();">&nbsp; % <?php echo $this->_tpl_vars['APP']['LBL_OF_PRICE']; ?>
</td>
				<td align="right"><input type="text" class="small" size="5" id="discount_percentage_final" name="discount_percentage_final" value="0" style="visibility:hidden" onBlur="setDiscount(this,'_final'); calcGroupTax();calcTotal();">&nbsp;%</td>
			   </tr>
			   <tr>
				<td align="left" nowrap><input type="radio" name="discount_final" onclick="setDiscount(this,'_final'); calcGroupTax();calcTotal();">&nbsp;<?php echo $this->_tpl_vars['APP']['LBL_DIRECT_PRICE_REDUCTION']; ?>
</td>
				<td align="right"><input type="text" id="discount_amount_final" name="discount_amount_final" size="5" value="0" style="visibility:hidden" onBlur="setDiscount(this,'_final'); calcGroupTax();calcTotal();"></td>
			   </tr>
			</table>
		</div>
		<!-- End Div -->
	</td>
	<td id="discountTotal_final" class="crmTableRow small lineOnTop" align="right">0.00</td>
   </tr>


   <!-- Group Tax - starts -->
   <tr id="group_tax_row" valign="top" class="TaxHide">
	<td class="crmTableRow small lineOnTop" style="border-right:1px #dadada;">&nbsp;</td>
	<td class="crmTableRow small lineOnTop" align="right">
		(+)&nbsp;<b><a href="javascript:doNothing();" onClick="displayCoords(this,'group_tax_div','group_tax_div_title',''); calcGroupTax();" ><?php echo $this->_tpl_vars['APP']['LBL_TAX']; ?>
</a></b>
				<!-- Pop Div For Group TAX -->
				<div class="discountUI" id="group_tax_div">
					<table width="100%" border="0" cellpadding="5" cellspacing="0" class="small">
					   <tr>
						<td id="group_tax_div_title" colspan="2" nowrap align="left" ></td>
						<td align="right"><img src="<?php echo vtiger_imageurl('close.gif', $this->_tpl_vars['THEME']); ?>
" border="0" onClick="fnHidePopDiv('group_tax_div')" style="cursor:pointer;"></td>
					   </tr>

					<?php $_from = $this->_tpl_vars['GROUP_TAXES']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['group_tax_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['group_tax_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['loop_count'] => $this->_tpl_vars['tax_detail']):
        $this->_foreach['group_tax_loop']['iteration']++;
?>

					   <tr>
						<td align="left" class="lineOnTop">
							<input type="text" class="small" size="5" name="<?php echo $this->_tpl_vars['tax_detail']['taxname']; ?>
_group_percentage" id="group_tax_percentage<?php echo $this->_foreach['group_tax_loop']['iteration']; ?>
" value="<?php echo $this->_tpl_vars['tax_detail']['percentage']; ?>
" onBlur="calcTotal()">&nbsp;%
						</td>
						<td align="center" class="lineOnTop"><?php echo $this->_tpl_vars['tax_detail']['taxlabel']; ?>
</td>
						<td align="right" class="lineOnTop">
							<input type="text" class="small" size="6" name="<?php echo $this->_tpl_vars['tax_detail']['taxname']; ?>
_group_amount" id="group_tax_amount<?php echo $this->_foreach['group_tax_loop']['iteration']; ?>
" style="cursor:pointer;" value="0.00" readonly>
						</td>
					   </tr>

					<?php endforeach; endif; unset($_from); ?>
					<input type="hidden" id="group_tax_count" value="<?php echo $this->_foreach['group_tax_loop']['iteration']; ?>
">

					</table>

				</div>
				<!-- End Popup Div Group Tax -->

	</td>
	<td id="tax_final" class="crmTableRow small lineOnTop" align="right">0.00</td>
   </tr>
   <!-- Group Tax - ends -->


   <tr valign="top">
	<td class="crmTableRow small" style="border-right:1px #dadada;">&nbsp;</td>
	<td class="crmTableRow small" align="right">
		(+)&nbsp;<b><?php echo $this->_tpl_vars['APP']['LBL_SHIPPING_AND_HANDLING_CHARGES']; ?>
 </b>
	</td>
	<td class="crmTableRow small" align="right">
		<input id="shipping_handling_charge" name="shipping_handling_charge" type="text" class="small" style="width:40px" align="right" value="0.00" onBlur="calcSHTax();">
	</td>
   </tr>

   <tr valign="top">
	<td class="crmTableRow small" style="border-right:1px #dadada;">&nbsp;</td>
	<td class="crmTableRow small" align="right">
		(+)&nbsp;<b><a href="javascript:doNothing();" onClick="displayCoords(this,'shipping_handling_div','sh_tax_div_title',''); calcSHTax();" ><?php echo $this->_tpl_vars['APP']['LBL_TAX_FOR_SHIPPING_AND_HANDLING']; ?>
 </a></b>

				<!-- Pop Div For Shipping and Handlin TAX -->
				<div class="discountUI" id="shipping_handling_div">
					<table width="100%" border="0" cellpadding="5" cellspacing="0" class="small">
					   <tr>
						<td id="sh_tax_div_title" colspan="2" nowrap align="left" ></td>
						<td align="right"><img src="<?php echo vtiger_imageurl('close.gif', $this->_tpl_vars['THEME']); ?>
" border="0" onClick="fnHidePopDiv('shipping_handling_div')" style="cursor:pointer;"></td>
					   </tr>

					<?php $_from = $this->_tpl_vars['SH_TAXES']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sh_loop'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sh_loop']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['loop_count'] => $this->_tpl_vars['tax_detail']):
        $this->_foreach['sh_loop']['iteration']++;
?>

					   <tr>
						<td align="left" class="lineOnTop">
							<input type="text" class="small" size="3" name="<?php echo $this->_tpl_vars['tax_detail']['taxname']; ?>
_sh_percent" id="sh_tax_percentage<?php echo $this->_foreach['sh_loop']['iteration']; ?>
" value="<?php echo $this->_tpl_vars['tax_detail']['percentage']; ?>
" onBlur="calcSHTax()">&nbsp;%
						</td>
						<td align="center" class="lineOnTop"><?php echo $this->_tpl_vars['tax_detail']['taxlabel']; ?>
</td>
						<td align="right" class="lineOnTop">
							<input type="text" class="small" size="4" name="<?php echo $this->_tpl_vars['tax_detail']['taxname']; ?>
_sh_amount" id="sh_tax_amount<?php echo $this->_foreach['sh_loop']['iteration']; ?>
" style="cursor:pointer;" value="0.00" readonly>
						</td>
					   </tr>

					<?php endforeach; endif; unset($_from); ?>
					<input type="hidden" id="sh_tax_count" value="<?php echo $this->_foreach['sh_loop']['iteration']; ?>
">

					</table>
				</div>
				<!-- End Popup Div for Shipping and Handling TAX -->

	</td>
	<td id="shipping_handling_tax" class="crmTableRow small" align="right">0.00</td>
   </tr>
   <tr valign="top">
	<td class="crmTableRow small" style="border-right:1px #dadada;">&nbsp;</td>
	<td class="crmTableRow small" align="right">
		<?php echo $this->_tpl_vars['APP']['LBL_ADJUSTMENT']; ?>

		<select id="adjustmentType" name="adjustmentType" class=small onchange="calcTotal();">
			<option value="+"><?php echo $this->_tpl_vars['APP']['LBL_ADD_ITEM']; ?>
</option>
			<option value="-"><?php echo $this->_tpl_vars['APP']['LBL_DEDUCT']; ?>
</option>
		</select>
	</td>
	<td class="crmTableRow small" align="right">
		<input id="adjustment" name="adjustment" type="text" class="small" style="width:40px" align="right" value="0.00" onBlur="calcTotal();">
	</td>
   </tr>
   <tr valign="top">
	<td class="crmTableRow big lineOnTop" style="border-right:1px #dadada;">&nbsp;</td>
	<td class="crmTableRow big lineOnTop" align="right"><b><?php echo $this->_tpl_vars['APP']['LBL_GRAND_TOTAL']; ?>
</b></td>
	<td id="grandTotal" name="grandTotal" class="crmTableRow big lineOnTop" align="right">&nbsp;</td>
   </tr>
</table>
		<input type="hidden" name="totalProductCount" id="totalProductCount" value="">
		<input type="hidden" name="subtotal" id="subtotal" value="">
		<input type="hidden" name="total" id="total" value="">




	</td>
   </tr>



