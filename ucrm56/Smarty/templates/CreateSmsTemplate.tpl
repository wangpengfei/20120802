{*<!--
/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ("License"); You may not use this file except in compliance with the License
   * The Original Code is:  vtiger CRM Open Source
   * The Initial Developer of the Original Code is vtiger.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
  *
 ********************************************************************************/
-->*}

<script language="JAVASCRIPT" type="text/javascript" src="include/js/smoothscroll.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/menu.js"></script>
<script language="JavaScript" type="text/javascript" src="include/calculator/calc.js"></script>
<script language="JavaScript" type="text/javascript" src="modules/Calendar/script.js"></script>
<script type="text/javascript" src="jscalendar/calendar.js"></script>
<script type="text/javascript" src="jscalendar/calendar-setup.js"></script>
<script type="text/javascript" src="jscalendar/lang/calendar-en.js"></script>
<script src="include/js/calenderJS.js"></script>
        
<script language="JavaScript" type="text/javascript">
    var allOptions = null;

    function setAllOptions(inputOptions) 
    {ldelim}
        allOptions = inputOptions;
    {rdelim}

    function modifyMergeFieldSelect(cause, effect) 
    {ldelim}
        var selected = cause.options[cause.selectedIndex].value;  id="mergeFieldValue"
        var s = allOptions[cause.selectedIndex];
        effect.length = s;
        for (var i = 0; i < s; i++) 
	{ldelim}
            effect.options[i] = s[i];
        {rdelim}
        document.getElementById('mergeFieldValue').value = '';
    {rdelim}
{literal}
    function init() 
    {
        var blankOption = new Option('--None--', '--None--');
        var options = null;
{/literal}

		var allOpts = new Object({$ALL_VARIABLES|@count}+1);
		{assign var="alloptioncount" value="0"}
		{foreach key=index item=module from=$ALL_VARIABLES}
	    	options = new Object({$module|@count}+1);
	    	{assign var="optioncount" value="0"}
            options[{$optioncount}] = blankOption;
            {foreach key=header item=detail from=$module}
             {assign var="optioncount" value=$optioncount+1}
				options[{$optioncount}] = new Option('{$detail.0}', '{$detail.1}');
			{/foreach}      
			 {assign var="alloptioncount" value=$alloptioncount+1}     
             allOpts[{$alloptioncount}] = options;
	    {/foreach}
        setAllOptions(allOpts);	    
    }
	
	

	
{literal}
	function cancelForm(frm)
	{
		frm.action.value='detailviewsmstemplate';
		frm.parenttab.value='Settings';
		frm.submit();
	}
{/literal}
</script>

<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
<tbody><tr>
        <td valign="top"><img src="{'showPanelTopLeft.gif'|@vtiger_imageurl:$THEME}"></td>
        <td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">
<br>
	<div align=center>
	
			{include file='SetMenu.tpl'}
				<!-- DISPLAY -->
				<table border=0 cellspacing=0 cellpadding=5 width=100% class="settingsSelUITopLine">
				{literal}
				<form action="index.php" method="post" name="templatecreate" onsubmit="if(check4null(templatecreate)) { VtigerJS_DialogBox.block(); } else { return false; }">
				{/literal}
				<input type="hidden" name="action">
				<input type="hidden" name="mode" value="{$EMODE}">
				<input type="hidden" name="module" value="Settings">
				<input type="hidden" name="templateid" value="{$TEMPLATEID}">
				<input type="hidden" name="parenttab" value="{$PARENTTAB}">
				<tr>
					<td width=50 rowspan=2 valign=top><img src="{'ViewTemplate.gif'|@vtiger_imageurl:$THEME}" alt="{$MOD.LBL_MODULE_NAME}" width="45" height="60" border=0 title="{$MOD.LBL_MODULE_NAME}"></td>
				{if $EMODE eq 'edit'}
					<td class=heading2 valign=bottom><b><a href="index.php?module=Settings&action=index&parenttab=Settings">{$MOD.LBL_SETTINGS}</a> > <a href="index.php?module=Settings&action=listsmstemplates&parenttab=Settings">{$UMOD.LBL_SMS_TEMPLATES}</a> &gt; {$MOD.LBL_EDIT} &quot;{$TEMPLATENAME}&quot; </b></td>
				{else}
					<td class=heading2 valign=bottom><b><a href="index.php?module=Settings&action=index&parenttab=Settings">{$MOD.LBL_SETTINGS}</a> > <a href="index.php?module=Settings&action=listsmstemplates&parenttab=Settings">{$UMOD.LBL_SMS_TEMPLATES}</a> &gt; {$MOD.LBL_CREATE_SMS_TEMPLATES} </b></td>
				{/if}
					
				</tr>
				<tr>
					<td valign=top class="small">{$UMOD.LBL_SMS_TEMPLATE_DESC}</td>
				</tr>
				</table>
				
				<br>
				<table border=0 cellspacing=0 cellpadding=10 width=100% >
				<tr>
				<td>
				
					<table border=0 cellspacing=0 cellpadding=5 width=100% class="tableHeading">
					<tr>
						{if $EMODE eq 'edit'}
						<td class="big"><strong>{$UMOD.LBL_PROPERTIES} &quot;{$TEMPLATENAME}&quot; </strong></td>
						{else}
						<td class="big"><strong>{$MOD.LBL_CREATE_SMS_TEMPLATES}</strong></td>
						{/if}
						<td class="small" align=center>
							<input type="submit" value="{$APP.LBL_SAVE_BUTTON_LABEL}" class="crmButton small save" onclick="this.form.action.value='savesmstemplate'; this.form.parenttab.value='Settings'" >&nbsp;&nbsp;
			{if $EMODE eq 'edit'}
				<input type="submit" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" class="crmButton small cancel" onclick="cancelForm(this.form)" />
			{else}
				<input type="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" class="crmButton small cancel" onclick="window.history.back()" >
			{/if}
						</td>
					</tr>
					</table>
					
					<table border=0 cellspacing=0 cellpadding=5 width=100% >
					
					<tr>
					  <td colspan="2" valign=top class="cellText small"><table width="100%"  border="0" cellspacing="0" cellpadding="0" class="thickBorder">
                        <tr>
                          <td valign=top><table width="100%"  border="0" cellspacing="0" cellpadding="5" >
                              <tr>
                                <td colspan="3" valign="top" class="small" style="background-color:#cccccc"><strong>{$UMOD.LBL_SMS_TEMPLATE}</strong></td>
                                </tr>
                              <tr>
                                <td width="15%" valign="top" class="cellLabel small"><font color='red'>*</font>{$UMOD.LBL_SUBJECT}</td>
                                <td width="85%" colspan="2" class="cellText small"><span class="small cellText">
                                  <input name="subject" type="text" value="{$SUBJECT}" class="detailedViewTextBox" tabindex="4">
                                </span></td>
                              </tr>
                              <tr>
                                <td valign="top" width=10% class="cellLabel small"><font color='red'>*</font>{$UMOD.LBL_MESSAGE}</td>
                                 <td valign="top" colspan="2" width=60% class="cellText small">
								<p><textarea name="body" style="width:90%;height:200px" class=small tabindex="5">{$BODY}</textarea></p>
								
                              </tr>
                          </table></td>
                          
                        </tr>
                      </table></td>
					  </tr>
					</table>
					<br>
					<table border=0 cellspacing=0 cellpadding=5 width=100% >
					<tr>
					  <td class="small" nowrap align=right><a href="#top">{$MOD.LBL_SCROLL}</a></td>
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
	</form>
	</table>
		
	</div>

</td>
        <td valign="top"><img src="{'showPanelTopRight.gif'|@vtiger_imageurl:$THEME}"></td>
   </tr>
</tbody>
</table>

<script>

function check4null(form)
{ldelim}

        var isError = false;
        var errorMessage = "";

        if (trim(form.subject.value) =='') {ldelim}
                isError = true;
                errorMessage += "\n {$MOD.SMS_TP_SUBJECT}";
                form.subject.focus();
        {rdelim}

        if (trim(form.body.value) =='') {ldelim}
                isError = true;
                errorMessage += "\n {$MOD.SMS_TP_CONTENT}";
                form.subject.focus();
        {rdelim}

        // Here we decide whether to submit the form.
        if (isError == true) {ldelim}
                alert(alert_arr.MISSING_FIELDS + errorMessage);
                return false;
        {rdelim}
 return true;

{rdelim}

init();

</script>
