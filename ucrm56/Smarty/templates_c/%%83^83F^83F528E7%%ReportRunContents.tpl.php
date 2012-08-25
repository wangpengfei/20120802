<?php /* Smarty version 2.6.18, created on 2012-06-04 12:52:39
         compiled from ReportRunContents.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'ReportRunContents.tpl', 28, false),)), $this); ?>


<br>
<table align="center" border="0" cellpadding="5" cellspacing="0" width="100%" class="mailSubHeader">
	<tbody><tr>
	<?php if ($this->_tpl_vars['EXPORT_PERMITTED'] == 'YES'): ?>
		<td align="left" nowrap ><input class="crmbutton small create" id="btnExport" name="btnExport" value="<?php echo $this->_tpl_vars['MOD']['LBL_EXPORTPDF_BUTTON']; ?>
" type="button" onClick="goToURL(CrearEnlace('CreatePDF',<?php echo $this->_tpl_vars['REPORTID']; ?>
));" title="<?php echo $this->_tpl_vars['MOD']['LBL_EXPORTPDF_BUTTON']; ?>
"></td>
		<td align="left" nowrap ><input class="crmbutton small create" id="btnExport" name="btnExport" value="<?php echo $this->_tpl_vars['MOD']['LBL_EXPORTXL_BUTTON']; ?>
" type="button" onClick="goToURL(CrearEnlace('CreateXL',<?php echo $this->_tpl_vars['REPORTID']; ?>
));" title="<?php echo $this->_tpl_vars['MOD']['LBL_EXPORTXL_BUTTON']; ?>
" ></td>
	<?php endif; ?>
	<td align="left" width="100%"><input name="PrintReport" value="<?php echo $this->_tpl_vars['MOD']['LBL_PRINT_REPORT']; ?>
" onClick="goToPrintReport(<?php echo $this->_tpl_vars['REPORTID']; ?>
);" class="crmbutton small create" type="button"></td>
	</tr>
	</tbody>
</table>

<table style="border: 1px solid rgb(0, 0, 0);" align="center" cellpadding="0" cellspacing="0" width="100%">
	<tbody><tr>
	<td style="background-repeat: repeat-y;" background="<?php echo vtiger_imageurl('report_btn.gif', $this->_tpl_vars['THEME']); ?>
" width="16"></td>

	<td style="padding: 5px;" valign="top">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tbody><tr>
		<td align="left" width="75%">
		<span class="genHeaderGray">
		<?php if ($this->_tpl_vars['MOD'][$this->_tpl_vars['REPORTNAME']] != ''): ?>
			<?php echo $this->_tpl_vars['MOD'][$this->_tpl_vars['REPORTNAME']]; ?>

		<?php else: ?>
			<?php echo $this->_tpl_vars['REPORTNAME']; ?>

		<?php endif; ?>
		</span><br>
		</td>
		<td align="right" width="25%">
		<span class="genHeaderGray"><?php echo $this->_tpl_vars['APP']['LBL_TOTAL']; ?>
 : <span id='_reportrun_total'><?php echo $this->_tpl_vars['REPORTHTML']['1']; ?>
</span>  <?php echo $this->_tpl_vars['APP']['LBL_RECORDS']; ?>
</span>
		</td>
		</tr>
		<tr><td id="report_info" align="left" colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
		<td colspan="2">
				<?php if ($this->_tpl_vars['DIRECT_OUTPUT'] == true): ?>		
			<?php if (isset ( $this->_tpl_vars['__REPORT_RUN_INSTANCE'] )): ?>
				<?php 
					$__oReportRun = $this->_tpl_vars['__REPORT_RUN_INSTANCE'];
					$__filterList = $this->_tpl_vars['__REPORT_RUN_FILTER_LIST'];
					$__oReportRunReturnValue = $__oReportRun->GenerateReport("HTML", $__filterList, true);
				 ?>
			<?php endif; ?>		
		<?php elseif ($this->_tpl_vars['ERROR_MSG'] == ''): ?>
			<?php echo $this->_tpl_vars['REPORTHTML']['0']; ?>

		<?php else: ?>
			<?php echo $this->_tpl_vars['ERROR_MSG']; ?>

		<?php endif; ?>
				</td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr><td colspan="2">
				<?php if ($this->_tpl_vars['DIRECT_OUTPUT'] == true): ?>
			<?php 
				if(is_array($__oReportRunReturnValue)) { $__oReportRun->GenerateReport("TOTALHTML", $__filterList, true); }
			 ?>
		<?php else: ?>			
			<?php echo $this->_tpl_vars['REPORTTOTHTML']; ?>

		<?php endif; ?>
				</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		</tbody>
	</table>
	</td>
	<td style="background-repeat: repeat-y;" background="<?php echo vtiger_imageurl('report_btn.gif', $this->_tpl_vars['THEME']); ?>
" width="16"></td>
	</tr>

	</tbody>
</table>
<?php if ($this->_tpl_vars['graph_param'] == 1): ?>
<table style="border: 1px solid rgb(0, 0, 0);" align="center" cellpadding="0" cellspacing="0" width="100%">
	<tbody><tr>
	<td style="background-repeat: repeat-y;" background="<?php echo vtiger_imageurl('report_btn.gif', $this->_tpl_vars['THEME']); ?>
" width="16"></td>

	<td style="padding: 5px;" valign="top">
	<table cellpadding="0" cellspacing="0" width="100%">
		<tbody><tr>
		<td align="left" width="75%">

		</td>
		<td align="right" width="25%">
		<span class="genHeaderGray">统计图表</span>
		</td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
		<td colspan="2">
		<span class="genHeaderGray">1、折线图：</span>
        <br /><img src="jpgraph/graph/line_chart.php?<?php echo $this->_tpl_vars['graph_param']; ?>
" /><br /><br /><br /></td></tr>
		<tr><td colspan="2">
		<span class="genHeaderGray">2、饼图：</span>
        <br /><img src="jpgraph/graph/pie_chart.php?<?php echo $this->_tpl_vars['graph_param']; ?>
" /><br /><br /><br /></td></tr>
		<tr><td colspan="2">
		<span class="genHeaderGray">3、柱图：</span>
		<br /><img src="jpgraph/graph/bar_chart.php?<?php echo $this->_tpl_vars['graph_param']; ?>
" /><br /><br /><br /></td></tr>
		<tr><td colspan="2">
		</td></tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		</tbody>
	</table>
	</td>
	<td style="background-repeat: repeat-y;" background="<?php echo vtiger_imageurl('report_btn.gif', $this->_tpl_vars['THEME']); ?>
" width="16"></td>
	</tr>

	</tbody>
</table>
<?php endif; ?>
<table align="center" border="0" cellpadding="5" cellspacing="0" width="100%" class="mailSubHeader">
	<tbody><tr>
	<td align="left" nowrap ><input class="crmbutton small create" id="btnExport" name="btnExport" value="<?php echo $this->_tpl_vars['MOD']['LBL_EXPORTPDF_BUTTON']; ?>
" type="button" onClick="goToURL(CrearEnlace('CreatePDF',<?php echo $this->_tpl_vars['REPORTID']; ?>
));" title="<?php echo $this->_tpl_vars['MOD']['LBL_EXPORTPDF_BUTTON']; ?>
"></td>
	<td align="left" nowrap ><input class="crmbutton small create" id="btnExport" name="btnExport" value="<?php echo $this->_tpl_vars['MOD']['LBL_EXPORTXL_BUTTON']; ?>
" type="button" onClick="goToURL(CrearEnlace('CreateXL',<?php echo $this->_tpl_vars['REPORTID']; ?>
));" title="<?php echo $this->_tpl_vars['MOD']['LBL_EXPORTXL_BUTTON']; ?>
" ></td>
	<td align="left" width=100% nowrap><input name="PrintReport" value="<?php echo $this->_tpl_vars['MOD']['LBL_PRINT_REPORT']; ?>
" class="crmbutton small create" onClick="goToPrintReport(<?php echo $this->_tpl_vars['REPORTID']; ?>
);" type="button"></td>
	</tr>
	</tbody>
</table>
