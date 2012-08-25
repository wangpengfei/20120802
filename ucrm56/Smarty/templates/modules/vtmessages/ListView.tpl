{*<!--
/*********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 *
 ********************************************************************************/
-->*}
<script language="JavaScript" type="text/javascript" src="include/js/ListView.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/search.js"></script>
<script language="javascript" type="text/javascript">
	var typeofdata = new Array();
	typeofdata['E'] = ['is','isn','bwt','ewt','cts','dcts'];
	typeofdata['V'] = ['is','isn','bwt','ewt','cts','dcts'];
	typeofdata['N'] = ['is','isn','lst','grt','lsteq','grteq'];
	typeofdata['NN'] = ['is','isn','lst','grt','lsteq','grteq'];
	typeofdata['T'] = ['is','isn','lst','grt','lsteq','grteq'];
	typeofdata['I'] = ['is','isn','lst','grt','lsteq','grteq'];
	typeofdata['C'] = ['is','isn'];
	typeofdata['DT'] = ['is','isn','lst','grt','lsteq','grteq'];
	typeofdata['D'] = ['is','isn','lst','grt','lsteq','grteq'];
	var fLabels = new Array();
	fLabels['is'] = "{$APP.is}";
	fLabels['isn'] = "{$APP.is_not}";
	fLabels['bwt'] = "{$APP.begins_with}";
	fLabels['ewt'] = "{$APP.ends_with}";
	fLabels['cts'] = "{$APP.contains}";
	fLabels['dcts'] = "{$APP.does_not_contains}";
	fLabels['lst'] = "{$APP.less_than}";
	fLabels['grt'] = "{$APP.greater_than}";
	fLabels['lsteq'] = "{$APP.less_or_equal}";
	fLabels['grteq'] = "{$APP.greater_or_equal}";
	var noneLabel;
	{literal}
	function trimfValues(value)
	{
    	var string_array = value.split(":");
    	return string_array[4];
	}

	function updatefOptions(sel, opSelName) {
    	var selObj = document.getElementById(opSelName);
	    var fieldtype = null ;

    	var currOption = selObj.options[selObj.selectedIndex];
	    var currField = sel.options[sel.selectedIndex];
    
    	var fld = currField.value.split(":");
	    var tod = fld[4];
  		if(currField.value != null && currField.value.length != 0) {
			fieldtype = trimfValues(currField.value);
			fieldtype = fieldtype.replace(/\\'/g,'');
			ops = typeofdata[fieldtype];
			var off = 0;
			if(ops != null) {
				var nMaxVal = selObj.length;
				for(nLoop = 0; nLoop < nMaxVal; nLoop++) {
					selObj.remove(0);
				}
				for (var i = 0; i < ops.length; i++) {
					var label = fLabels[ops[i]];
					if (label == null) continue;
					var option = new Option (fLabels[ops[i]], ops[i]);
					selObj.options[i] = option;
					if (currOption != null && currOption.value == option.value) {
						option.selected = true;
					}
				}
			}
    	} else {
			var nMaxVal = selObj.length;
			for(nLoop = 0; nLoop < nMaxVal; nLoop++) {
				selObj.remove(0);
			}
			selObj.options[0] = new Option ('None', '');
			if (currField.value == '') {
				selObj.options[0].selected = true;
			}
    	}
	}
{/literal}
</script>
<script language="JavaScript" type="text/javascript" src="modules/{$MODULE}/{$MODULE}.js"></script>
<script language="javascript">
{literal}
	function checkgroup() {
		if($("group_checkbox").checked) {
			document.change_ownerform_name.lead_group_owner.style.display = "block";
			document.change_ownerform_name.lead_owner.style.display = "none";
		} else {
			document.change_ownerform_name.lead_owner.style.display = "block";
			document.change_ownerform_name.lead_group_owner.style.display = "none";
		}
	}
	function callSearch(searchtype) {
		for(i=1;i<=26;i++) {
        	var data_td_id = 'alpha_'+ eval(i);
        	getObj(data_td_id).className = 'searchAlph';
		}
    	gPopupAlphaSearchUrl = '';
		search_fld_val= $('bas_searchfield').options[$('bas_searchfield').selectedIndex].value;
		search_txt_val= encodeURIComponent(document.basicSearch.search_text.value);
        var urlstring = '';
        if(searchtype == 'Basic') {
			var p_tab = document.getElementsByName("parenttab");
            urlstring = 'search_field='+search_fld_val+'&searchtype=BasicSearch&search_text='+search_txt_val+'&';
            urlstring = urlstring + 'parenttab='+p_tab[0].value+ '&';
		} else if(searchtype == 'Advanced') {
			var no_rows = document.basicSearch.search_cnt.value;
            for(jj = 0 ; jj < no_rows; jj++) {
				var sfld_name = getObj("Fields"+jj);
                var scndn_name= getObj("Condition"+jj);
                var srchvalue_name = getObj("Srch_value"+jj);
                var p_tab = document.getElementsByName("parenttab");
                urlstring = urlstring+'Fields'+jj+'='+sfld_name[sfld_name.selectedIndex].value+'&';
                urlstring = urlstring+'Condition'+jj+'='+scndn_name[scndn_name.selectedIndex].value+'&';
				urlstring = urlstring+'Srch_value'+jj+'='+encodeURIComponent(srchvalue_name.value)+'&';
                urlstring = urlstring + 'parenttab='+p_tab[0].value+ '&';
            }
            for (i=0;i<getObj("matchtype").length;i++) {
				if (getObj("matchtype")[i].checked==true)
                	urlstring += 'matchtype='+getObj("matchtype")[i].value+'&';
                }
                urlstring += 'search_cnt='+no_rows+'&';
                urlstring += 'searchtype=advance&'
        	}
			new Ajax.Request(
				'index.php',
				{queue: {position: 'end', scope: 'command'},
				method: 'post',{/literal}
				postBody:urlstring +'query=true&file=index&module={$MODULE}&action={$MODULE}Ajax&ajax=true&search=true',
				{literal}
				onComplete: function(response) {
					$("status").style.display="none";
					result = response.responseText.split('&#&#&#');
					$("ListViewContents").innerHTML= result[2];
                    if(result[1] != '')
                    alert(result[1]);
					$('basicsearchcolumns').innerHTML = '';
				}}
        	);
		return false
	}
	function alphabetic(module,url,dataid) {
        for(i=1;i<=26;i++) {
			var data_td_id = 'alpha_'+ eval(i);
            getObj(data_td_id).className = 'searchAlph';
		}
        getObj(dataid).className = 'searchAlphselected';
		$("status").style.display="inline";
		new Ajax.Request(
			'index.php',
			{queue: {position: 'end', scope: 'command'},
			method: 'post',
			postBody: 'module='+module+'&action='+module+'Ajax&file=index&ajax=true&search=true&'+url,
			onComplete: function(response) {
				$("status").style.display="none";
				result = response.responseText.split('&#&#&#');
				$("ListViewContents").innerHTML= result[2];
				if(result[1] != '')
	                alert(result[1]);
				$('basicsearchcolumns').innerHTML = '';
			}
		}
	);
}
{/literal}
</script>
	{include file='Buttons_List.tpl'}
    	<div id="searchingUI" style="display:none;">
        <table border=0 cellspacing=0 cellpadding=0 width=100%>
        <tr>
        	<td align=center>
            	<img src="{'searching.gif'|@vtiger_imageurl:$THEME}" alt="{$APP.LBL_SEARCHING}"  title="{$APP.LBL_SEARCHING}">
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

{*<!-- Contents -->*}
<table border=0 cellspacing=0 cellpadding=0 width=98% align=center>
     <tr>
        <td valign=top>&nbsp;</td>
		<td class="showPanelBg" valign="top" width=100% style="padding:10px;">
			<!-- SIMPLE SEARCH -->
			<div id="searchAcc" style="z-index:1;display:none;position:relative;">
				<form name="basicSearch" method="post" action="index.php" onSubmit="return callSearch('Basic');">
				<table width="80%" cellpadding="5" cellspacing="0"  class="searchUIBasic small" align="center" border=0>
				<tr>
					<td class="searchUIName small" nowrap align="left">
						<span class="moduleName">{$APP.LBL_SEARCH}</span><br><span class="small"><a href="#" onClick="fnhide('searchAcc');show('advSearch');updatefOptions(document.getElementById('Fields0'), 'Condition0');document.basicSearch.searchtype.value='advance';">{$APP.LBL_GO_TO} {$APP.LNK_ADVANCED_SEARCH}</a></span></td>
					<td class="small" nowrap align=right><b>{$APP.LBL_SEARCH_FOR}</b></td>
					<td class="small"><input type="text"  class="txtBox" style="width:120px" name="search_text"></td>
					<td class="small" nowrap><b>{$APP.LBL_IN}</b>&nbsp;</td>
					<td class="small" nowrap>
						<div id="basicsearchcolumns_real">
							<select name="search_field" id="bas_searchfield" class="txtBox" style="width:150px">
								 {html_options  options=$SEARCHLISTHEADER }
							</select>
						</div>
                        <input type="hidden" name="searchtype" value="BasicSearch">
                        <input type="hidden" name="module" value="{$MODULE}">
                        <input type="hidden" name="parenttab" value="{$CATEGORY}">
						<input type="hidden" name="action" value="index">
                        <input type="hidden" name="query" value="true">
						<input type="hidden" name="search_cnt">
					</td>
					<td class="small" nowrap width=40% >
						<input name="submit" type="button" class="crmbutton small create" onClick="callSearch('Basic');" value=" {$APP.LBL_SEARCH_NOW_BUTTON} ">&nbsp;
			  
					</td>
					<td class="small" valign="top" onMouseOver="this.style.cursor='pointer';" onclick="moveMe('searchAcc');searchshowhide('searchAcc','advSearch')">[x]</td>
				</tr>
				<tr>
					<td colspan="7" align="center" class="small">
						<table border=0 cellspacing=0 cellpadding=0 width=100%>
						<tr>
            				{$ALPHABETICAL}
	                    </tr>
    	                </table>
					</td>
				</tr>
				</table>
			</form>
		</div>
		<!-- ADVANCED SEARCH -->
		<div id="advSearch" style="display:none;">
			<form name="advSearch" method="post" action="index.php" onSubmit="totalnoofrows();return callSearch('Advanced');">
				<table cellspacing=0 cellpadding=5 width=80% class="searchUIAdv1 small" align="center" border=0>
				<tr>
					<td class="searchUIName small" nowrap align="left"><span class="moduleName">{$APP.LBL_SEARCH}</span><br><span class="small"><a href="#" onClick="show('searchAcc');fnhide('advSearch')">{$APP.LBL_GO_TO} {$APP.LNK_BASIC_SEARCH}</a></span></td>
					<td nowrap class="small"><b><input name="matchtype" type="radio" value="all">&nbsp;{$APP.LBL_ADV_SEARCH_MSG_ALL}</b></td>
					<td nowrap width=60% class="small" ><b><input name="matchtype" type="radio" value="any" checked>&nbsp;{$APP.LBL_ADV_SEARCH_MSG_ANY}</b></td>
					<td class="small" valign="top" onMouseOver="this.style.cursor='pointer';" onclick="moveMe('searchAcc');searchshowhide('searchAcc','advSearch')">[x]</td>
				</tr>
				</table>
				<table cellpadding="2" cellspacing="0" width="80%" align="center" class="searchUIAdv2 small" border=0>
				<tr>
					<td align="center" class="small" width=90%>
						<div id="fixed" style="position:relative;width:95%;height:80px;padding:0px; overflow:auto;border:1px solid #CCCCCC;background-color:#ffffff" class="small">
							<table border=0 width=95%>
							<tr>
								<td align=left>
									<table width="100%"  border="0" cellpadding="2" cellspacing="0" id="adSrc" align="left">
									<tr>
										<td width="31%"><select name="Fields0" id="Fields0" class="detailedViewTextBox" onchange="updatefOptions(this, 'Condition0')">{$FIELDNAMES}</select></td>
										<td width="32%"><select name="Condition0" id="Condition0" class="detailedViewTextBox">{$CRITERIA}</select></td>
										<td width="32%"><input type="text" name="Srch_value0" class="detailedViewTextBox"></td>
									</tr>
									</table>
								</td>
							</tr>
							</table>
						</div>	
					</td>
				</tr>
				</table>
			
				<table border=0 cellspacing=0 cellpadding=5 width=80% class="searchUIAdv3 small" align="center">
				<tr>
					<td align=left width=40%>
						<input type="button" name="more" value=" {$APP.LBL_MORE} " onClick="fnAddSrch('{$FIELDNAMES}','{$CRITERIA}')" class="crmbuttom small edit" >
						<input name="button" type="button" value=" {$APP.LBL_FEWER_BUTTON} " onclick="delRow()" class="crmbuttom small edit" >
					</td>
					<td align=left class="small"><input type="button" class="crmbutton small create" value=" {$APP.LBL_SEARCH_NOW_BUTTON} " onClick="totalnoofrows();callSearch('Advanced');">
					</td>
				</tr>
			</table>
		</form>
		</div>		
		{*<!-- Searching UI -->*}
	 
		<!-- PUBLIC CONTENTS STARTS-->
		<table width="100%" cellpadding=2 cellspacing=2 border=0>
		<tr valign=top>
			<td>
				<div id="ListViewContents" class="small" style="width:100%">
				{include file="modules/vtmessages/ListViewEntries.tpl"}
				</div>
			</td>
			<td width="15%">
				<form name="vtmessages_users_form" method="POST" action="javascript:void(0);">
				<div class='dvtSelectedCell' style='padding: 2px'>{$MOD.LBL_MESSAGENOW_TO}</div>
				{if count($USERLIST)}
				<img src="{'ico-groups.gif'|@vtiger_imageurl:$THEME}" border=0 width='25px' align='absmiddle'> <a href='javascript:void(0);' onclick="vtmessages.scrapnew_toselected(this, document.forms['vtmessages_users_form'], '{$MOD.LBL_SELECTED_USERS}', '{$MOD.LBL_ATLEAST_SELECTONE_USER}');">{$MOD.LBL_SELECTED_USERS}</a>
				{/if}

				{foreach item=USRNAME key=USRID from=$USERLIST}
				{if $CURRENT_USER_NAME neq $USRNAME}
				<div style='padding: 0 0 5px 0;'>
					<input type='checkbox' name='userid' value='{$USRID}' style='width: 10px; padding: 0; margin: 0 0 0 10px;'> <img src="{'ico-users.gif'|@vtiger_imageurl:$THEME}" border=0 width='20px' align='absmiddle'> <a href='javascript:void(0);' onclick="vtmessages.scrapnew(this, '{$USRNAME}', {$USRID});">{$USRNAME}</a>
				</div>
				{/if}
				{/foreach}
				</form>
			</td>
		</tr>
		</table>

	</td>
	<td valign=top>&nbsp;</td>
</tr>
</table>

{include file='modules/vtmessages/MetaInfo.tpl'}

