<?php /* Smarty version 2.6.18, created on 2012-06-04 12:52:39
         compiled from ReportRun.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'ReportRun.tpl', 26, false),)), $this); ?>
<br>
<script language="JavaScript" type="text/javascript" src="modules/Reports/Reports.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="jscalendar/calendar-win2k-cold-1.css">
<script type="text/javascript" src="jscalendar/calendar.js"></script>
<script type="text/javascript" src="jscalendar/lang/calendar-zh.js"></script>
<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
<script language="JavaScript" type="text/javascript" src="include/calculator/calc.js"></script>
<?php echo $this->_tpl_vars['BLOCKJS']; ?>



<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
<tbody><tr>
    <td valign="top"><img src="<?php echo vtiger_imageurl('showPanelTopLeft.gif', $this->_tpl_vars['THEME']); ?>
"></td>
	<td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">
	
	
	
<table class="small reportGenHdr mailClient mailClientBg" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	<form name="NewReport" action="index.php" method="POST" onsubmit="VtigerJS_DialogBox.block();">
    <input type="hidden" name="booleanoperator" value="5"/>
    <input type="hidden" name="record" value="<?php echo $this->_tpl_vars['REPORTID']; ?>
"/>
    <input type="hidden" name="reload" value=""/>    
    <input type="hidden" name="module" value="Reports"/>
    <input type="hidden" name="action" value="SaveAndRun"/>
    <input type="hidden" name="dlgType" value="saveAs"/>
    <input type="hidden" name="reportName"/>
    <input type="hidden" name="folderid" value="<?php echo $this->_tpl_vars['FOLDERID']; ?>
"/>
    <input type="hidden" name="reportDesc"/>
    <input type="hidden" name="folder"/>

	<tbody>
	<tr>
	<td style="padding: 10px; text-align: left;" width="70%">
		<span class="moduleName">
		<?php if ($this->_tpl_vars['MOD'][$this->_tpl_vars['REPORTNAME']] != ''): ?>
			<?php echo $this->_tpl_vars['MOD'][$this->_tpl_vars['REPORTNAME']]; ?>

		<?php else: ?>
			<?php echo $this->_tpl_vars['REPORTNAME']; ?>

		<?php endif; ?>
		</span>&nbsp;&nbsp;
		<?php if ($this->_tpl_vars['IS_EDITABLE'] == 'true'): ?>
		<input type="button" name="custReport" value="<?php echo $this->_tpl_vars['MOD']['LBL_CUSTOMIZE_REPORT']; ?>
" class="crmButton small edit" onClick="editReport('<?php echo $this->_tpl_vars['REPORTID']; ?>
');">
		<?php endif; ?>
		<br>
		<a href="index.php?module=Reports&action=ListView" class="reportMnu" style="border-bottom: 0px solid rgb(0, 0, 0);">&lt;<?php echo $this->_tpl_vars['MOD']['LBL_BACK_TO_REPORTS']; ?>
</a>
	</td>
	<td style="border-left: 2px dotted rgb(109, 109, 109); padding: 10px;" width="30%">
		<b><?php echo $this->_tpl_vars['MOD']['LBL_SELECT_ANOTHER_REPORT']; ?>
 : </b><br>
		<select name="another_report" class="detailedViewTextBox" onChange="selectReport()">
		<?php $_from = $this->_tpl_vars['REPINFOLDER']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['report_in_fld_id'] => $this->_tpl_vars['report_in_fld_name']):
?>
		<?php if ($this->_tpl_vars['MOD'][$this->_tpl_vars['report_in_fld_name']] != ''): ?> 
			<?php if ($this->_tpl_vars['report_in_fld_id'] != $this->_tpl_vars['REPORTID']): ?>
				<option value=<?php echo $this->_tpl_vars['report_in_fld_id']; ?>
><?php echo $this->_tpl_vars['MOD'][$this->_tpl_vars['report_in_fld_name']]; ?>
</option>
			<?php else: ?>	
				<option value=<?php echo $this->_tpl_vars['report_in_fld_id']; ?>
 selected><?php echo $this->_tpl_vars['MOD'][$this->_tpl_vars['report_in_fld_name']]; ?>
</option>
			<?php endif; ?>
		<?php else: ?>
			<?php if ($this->_tpl_vars['report_in_fld_id'] != $this->_tpl_vars['REPORTID']): ?>
				<option value=<?php echo $this->_tpl_vars['report_in_fld_id']; ?>
><?php echo $this->_tpl_vars['report_in_fld_name']; ?>
</option>
			<?php else: ?>	
				<option value=<?php echo $this->_tpl_vars['report_in_fld_id']; ?>
 selected><?php echo $this->_tpl_vars['report_in_fld_name']; ?>
</option>
			<?php endif; ?>
		<?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
		</select>&nbsp;&nbsp;
	</td>
	</tr>
	</tbody>
</table>

<!-- Generate Report UI Filter -->
<table class="small reportGenerateTable" align="center" cellpadding="5" cellspacing="0" width="95%" border=0>
<tr>
	<td align=center class=small>
	
	<table border=0 cellspacing=0 cellpadding=0 width=80%>
		<tr>
			<td align=left class=small><b><?php echo $this->_tpl_vars['MOD']['LBL_SELECT_COLUMN']; ?>
 </b></td><td class=small>&nbsp;</td>
			<td align=left class=small><b><?php echo $this->_tpl_vars['MOD']['LBL_SELECT_TIME']; ?>
 </b></td><td class=small>&nbsp;</td>
			<td align=left class=small><b><?php echo $this->_tpl_vars['MOD']['LBL_SF_STARTDATE']; ?>
 </b></td><td class=small>&nbsp;</td>
			<td align=left class=small><b><?php echo $this->_tpl_vars['MOD']['LBL_SF_ENDDATE']; ?>
 </b>
		</tr>
		<tr>
			<td align="left" width="30%">
			<select name="stdDateFilterField" class="small" style="width:98%" onchange="standardFilterDisplay();">
			<?php echo $this->_tpl_vars['BLOCK1']; ?>

			</select>
			</td>
			<td class=small>&nbsp;</td>			
			<td align=left width="30%">
			<select name="stdDateFilter" class="small" onchange='showDateRange( this.options[ this.selectedIndex ].value )' style="width:98%">
			<?php echo $this->_tpl_vars['BLOCKCRITERIA']; ?>

			</select>
			</td>
			<td class=small>&nbsp;</td>
			<td align=left width="20%">
				<table border=0 cellspacing=0 cellpadding=2>
				<tr>
					<td align=left><input name="startdate" id="jscal_field_date_start" type="text" size="10" class="importBox" style="width:70px;" value="<?php echo $this->_tpl_vars['STARTDATE']; ?>
"></td>
					<td valign=absmiddle align=left><img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
btnL3Calendar.gif" id="jscal_trigger_date_start"><font size="1"><em old="(yyyy-mm-dd)">(<?php echo $this->_tpl_vars['DATEFORMAT']; ?>
)</em></font>
						<script type="text/javascript">
							Calendar.setup ({
							inputField : "jscal_field_date_start", ifFormat : "<?php echo $this->_tpl_vars['JS_DATEFORMAT']; ?>
", showsTime : false, button : "jscal_trigger_date_start", singleClick : true, step : 1
							});
						</script>

					</td>
				</tr>
				</table>
			</td>
			<td align=left class=small>&nbsp;</td>
			<td align=left width=20%>
				<table border=0 cellspacing=0 cellpadding=2>
				<tr>
					<td align=left><input name="enddate" id="jscal_field_date_end" type="text" size="10" class="importBox" style="width:70px;" value="<?php echo $this->_tpl_vars['ENDDATE']; ?>
"></td>
					<td valign=absmiddle align=left><img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
btnL3Calendar.gif" id="jscal_trigger_date_end"><font size="1"><em old="(yyyy-mm-dd)">(<?php echo $this->_tpl_vars['DATEFORMAT']; ?>
)</em></font>
						<script type="text/javascript">
							Calendar.setup ({
							inputField : "jscal_field_date_end", ifFormat : "<?php echo $this->_tpl_vars['JS_DATEFORMAT']; ?>
", showsTime : false, button : "jscal_trigger_date_end", singleClick : true, step : 1
							});
						</script>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center" colspan="8" style="padding:5px"><input name="generatenw" value=" <?php echo $this->_tpl_vars['MOD']['LBL_GENERATE_NOW']; ?>
 " class="crmbutton small create" type="button" onClick="generateReport(<?php echo $this->_tpl_vars['REPORTID']; ?>
);"></td>
		</tr>
	</table>
	
	</td>
</tr>
</table>


<div style="display: block;" id="Generate" align="center">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "ReportRunContents.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<br>

</td>
<td valign="top"><img src="<?php echo vtiger_imageurl('showPanelTopRight.gif', $this->_tpl_vars['THEME']); ?>
"></td>
</tr>
</table>



<?php echo '

<SCRIPT LANGUAGE=JavaScript>
function CrearEnlace(tipo,id){
	var stdDateFilterFieldvalue = \'\';
	if(document.NewReport.stdDateFilterField.selectedIndex != -1)
		stdDateFilterFieldvalue = document.NewReport.stdDateFilterField.options  [document.NewReport.stdDateFilterField.selectedIndex].value;

	var stdDateFiltervalue = \'\';
	if(document.NewReport.stdDateFilter.selectedIndex != -1)
		stdDateFiltervalue = document.NewReport.stdDateFilter.options[document.NewReport.stdDateFilter.selectedIndex].value;

	return "index.php?module=Reports&action="+tipo+"&record="+id+"&stdDateFilterField="+stdDateFilterFieldvalue+"&stdDateFilter="+stdDateFiltervalue+"&startdate="+document.NewReport.startdate.value+"&enddate="+document.NewReport.enddate.value;

}
function goToURL( url )
{
	document.location.href = url;
}
					
var filter = getObj(\'stdDateFilter\').options[document.NewReport.stdDateFilter.selectedIndex].value
    if( filter != "custom" )
    {
        showDateRange( filter );
    }

// If current user has no access to date fields, we should disable selection
// Fix for: #4670
standardFilterDisplay();

function generateReport(id)
{
	var stdDateFilterFieldvalue = \'\';
	if(document.NewReport.stdDateFilterField.selectedIndex != -1)
		stdDateFilterFieldvalue = document.NewReport.stdDateFilterField.options  [document.NewReport.stdDateFilterField.selectedIndex].value;

	var stdDateFiltervalue = \'\';
	if(document.NewReport.stdDateFilter.selectedIndex != -1)
		stdDateFiltervalue = document.NewReport.stdDateFilter.options[document.NewReport.stdDateFilter.selectedIndex].value;
	var startdatevalue = document.NewReport.startdate.value;
	var enddatevalue = document.NewReport.enddate.value;

	var date1=getObj("startdate")
        var date2=getObj("enddate")
	
if ((date1.value != \'\') || (date2.value != \'\'))
{

        if(!dateValidate("startdate","Start Date","D"))
                return false

        if(!dateValidate("enddate","End Date","D"))
                return false

	if(!dateComparison("startdate",\'Start Date\',"enddate",\'End Date\',\'LE\'))
                return false;
}


	new Ajax.Request(
                \'index.php\',
                {queue: {position: \'end\', scope: \'command\'},
                        method: \'post\',
                        postBody: \'action=ReportsAjax&file=SaveAndRun&mode=ajax&module=Reports&record=\'+id+\'&stdDateFilterField=\'+stdDateFilterFieldvalue+\'&stdDateFilter=\'+stdDateFiltervalue+\'&startdate=\'+startdatevalue+\'&enddate=\'+enddatevalue,
                        onComplete: function(response) {
				getObj(\'Generate\').innerHTML = response.responseText;
				// Performance Optimization: To update record count of the report result 
				var __reportrun_directoutput_recordcount_scriptnode = $(\'__reportrun_directoutput_recordcount_script\');
				if(__reportrun_directoutput_recordcount_scriptnode) { eval(__reportrun_directoutput_recordcount_scriptnode.innerHTML); }
				// END
				setTimeout("ReportInfor()",1);
                        }
                }
        );
}
function selectReport()
{
	var id = document.NewReport.another_report.options  [document.NewReport.another_report.selectedIndex].value;
	var folderid = getObj(\'folderid\').value;
	url =\'index.php?action=SaveAndRun&module=Reports&record=\'+id+\'&folderid=\'+folderid;
	goToURL(url);
}
function ReportInfor()
{
	var stdDateFilterFieldvalue = \'\';
	if(document.NewReport.stdDateFilterField.selectedIndex != -1)
		stdDateFilterFieldvalue = document.NewReport.stdDateFilterField.options  [document.NewReport.stdDateFilterField.selectedIndex].text;

	var stdDateFiltervalue = \'\';
	if(document.NewReport.stdDateFilter.selectedIndex != -1)
		stdDateFiltervalue = document.NewReport.stdDateFilter.options[document.NewReport.stdDateFilter.selectedIndex].text;

	var startdatevalue = document.NewReport.startdate.value;
	var enddatevalue = document.NewReport.enddate.value;

	if(startdatevalue != \'\' && enddatevalue==\'\')
	{
		var reportinfr = alert_arr.Condition + \'  "\'+stdDateFilterFieldvalue+\'"   (from  \'+startdatevalue+\' )\';
	}else if(startdatevalue == \'\' && enddatevalue !=\'\')
	{
		var reportinfr = alert_arr.Condition + \'  "\'+stdDateFilterFieldvalue+\'"   (  till  \'+enddatevalue+\')\';
	}else if(startdatevalue == \'\' && enddatevalue ==\'\')
	{
		'; ?>

                var reportinfr = "<?php echo $this->_tpl_vars['MOD']['NO_FILTER_SELECTED']; ?>
";
                <?php echo '
	}else if(startdatevalue != \'\' && enddatevalue !=\'\')
	{
	var reportinfr = alert_arr.Condition+\':  "\'+stdDateFilterFieldvalue+\'"  \'+alert_arr.EQUALS+\' "\'+stdDateFiltervalue+\'"  ( \'+startdatevalue+\'  \'+alert_arr.To+\'  \'+enddatevalue+\' )\';
	}
	getObj(\'report_info\').innerHTML = reportinfr;
}
ReportInfor();

'; ?>

function goToPrintReport(id) 
{
	var stdDateFilterFieldvalue = '';
	if(document.NewReport.stdDateFilterField.selectedIndex != -1)
	stdDateFilterFieldvalue = document.NewReport.stdDateFilterField.options  [document.NewReport.stdDateFilterField.selectedIndex].value;

	var stdDateFiltervalue = '';
if(document.NewReport.stdDateFilter.selectedIndex != -1)
	stdDateFiltervalue = document.NewReport.stdDateFilter.options[document.NewReport.stdDateFilter.selectedIndex].value;

	window.open("index.php?module=Reports&action=ReportsAjax&file=PrintReport&record="+id+"&stdDateFilterField="+stdDateFilterFieldvalue+"&stdDateFilter="+stdDateFiltervalue+"&startdate="+document.NewReport.startdate.value+"&enddate="+document.NewReport.enddate.value,"<?php echo $this->_tpl_vars['MOD']['LBL_Print_REPORT']; ?>
","width=800,height=650,resizable=1,scrollbars=1,left=100");

}
</SCRIPT>