<?php /* Smarty version 2.6.18, created on 2012-06-04 10:21:18
         compiled from UserListView.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'UserListView.tpl', 18, false),array('function', 'html_options', 'UserListView.tpl', 57, false),)), $this); ?>

<script language="JAVASCRIPT" type="text/javascript" src="include/js/smoothscroll.js"></script>

<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
<tbody><tr>
        <td valign="top"><img src="<?php echo vtiger_imageurl('showPanelTopLeft.gif', $this->_tpl_vars['THEME']); ?>
"></td>
        <td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">
<!--<form action="index.php" method="post" name="EditView" id="form" onsubmit="VtigerJS_DialogBox.block();">
<input type='hidden' name='module' value='Users'>
<input type='hidden' name='action' value='EditView'>
<input type='hidden' name='return_action' value='ListView'>
<input type='hidden' name='return_module' value='Users'>
<input type='hidden' name='parenttab' value='Settings'>
-->

        <br>

	<div align=center>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'SetMenu.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<!-- DISPLAY -->
				<table border=0 cellspacing=0 cellpadding=5 width=100% class="settingsSelUITopLine">
				<tr>
					<td width=50 rowspan=2 valign=top><img src="<?php echo vtiger_imageurl('ico-users.gif', $this->_tpl_vars['THEME']); ?>
" alt="<?php echo $this->_tpl_vars['MOD']['LBL_USERS']; ?>
" width="48" height="48" border=0 title="<?php echo $this->_tpl_vars['MOD']['LBL_USERS']; ?>
"></td>
					<td class=heading2 valign=bottom><b><a href="index.php?module=Settings&action=index&parenttab=Settings"><?php echo $this->_tpl_vars['MOD']['LBL_SETTINGS']; ?>
</a> > <?php echo $this->_tpl_vars['MOD']['LBL_USERS']; ?>
</b></td>
				</tr>
				<tr>
					<td valign=top class="small"><?php echo $this->_tpl_vars['MOD']['LBL_USER_DESCRIPTION']; ?>
</td>
				</tr>
				</table>
				
				<br>
<!--
<form name="basicSearch" method="post" action="index.php" onSubmit="return callSearch('Basic');">
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
                        <input type="hidden" name="module" value="Users">
                        <input type="hidden" name="parenttab" value="<?php echo $this->_tpl_vars['CATEGORY']; ?>
">
			<input type="hidden" name="action" value="ListView">
                        <input type="hidden" name="query" value="true">
			<input type="hidden" name="search_cnt">
		</td>
		<td class="small" nowrap width=40% >
			  <input name="submit" type="button" class="crmbutton small create" onClick="callSearch('Basic');" value=" <?php echo $this->_tpl_vars['APP']['LBL_SEARCH_NOW_BUTTON']; ?>
 ">&nbsp;
			  
		</td>
	</tr>
</table>
</form>
-->

<!-- SIMPLE SEARCH -->
<div id="searchAcc" style="display: block;position:relative;">
<form name="basicSearch" method="post" action="index.php" onSubmit="return callSearch('Basic');">
<table width="80%" cellpadding="5" cellspacing="0"  class="searchUIBasic small" align="center" border=0>
	<tr>
		<td class="searchUIName small" nowrap align="left">
		<span class="moduleName"><?php echo $this->_tpl_vars['APP']['LBL_SEARCH']; ?>
</span><br><span class="small"><a href="#" onClick="fnhide('searchAcc');show('advSearch');updatefOptions(document.getElementById('Fields0'), 'Condition0');document.basicSearch.searchtype.value='advance';"><?php echo $this->_tpl_vars['APP']['LBL_GO_TO']; ?>
 <?php echo $this->_tpl_vars['APP']['LNK_ADVANCED_SEARCH']; ?>
</a></span>
		<!-- <img src="themes/images/basicSearchLens.gif" align="absmiddle" alt="<?php echo $this->_tpl_vars['APP']['LNK_BASIC_SEARCH']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LNK_BASIC_SEARCH']; ?>
" border=0>&nbsp;&nbsp;-->
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
                        <input type="hidden" name="module" value="<?php echo $this->_tpl_vars['MODULE']; ?>
">
                        <input type="hidden" name="parenttab" value="<?php echo $this->_tpl_vars['CATEGORY']; ?>
">
			<input type="hidden" name="action" value="index">
                        <input type="hidden" name="query" value="true">
			<input type="hidden" name="search_cnt">
		</td>
		<td class="small" nowrap width=40% >
			  <input name="submit" type="button" class="crmbutton small create" onClick="callSearch('Basic');" value=" <?php echo $this->_tpl_vars['APP']['LBL_SEARCH_NOW_BUTTON']; ?>
 ">&nbsp;
			  
		</td>
	</tr>
    <!--
	<tr>
		<td colspan="7" align="center" class="small">
			<table border=0 cellspacing=0 cellpadding=0 width=100%>
				<tr>
                                                <?php echo $this->_tpl_vars['ALPHABETICAL']; ?>

                                </tr>
                        </table>
		</td>
	</tr>-->
</table>
</form>
</div>
<!-- ADVANCED SEARCH -->
<div id="advSearch" style="display:none;">
<form name="advSearch" method="post" action="index.php" onSubmit="totalnoofrows();return callSearch('Advanced');">
		<table  cellspacing=0 cellpadding=5 width=80% class="searchUIAdv1 small" align="center" border=0>
			<tr>
					<td class="searchUIName small" nowrap align="left"><span class="moduleName"><?php echo $this->_tpl_vars['APP']['LBL_SEARCH']; ?>
</span><br><span class="small"><a href="#" onClick="show('searchAcc');fnhide('advSearch')"><?php echo $this->_tpl_vars['APP']['LBL_GO_TO']; ?>
 <?php echo $this->_tpl_vars['APP']['LNK_BASIC_SEARCH']; ?>
</a></span></td>
					<td nowrap class="small"><b><input name="matchtype" type="radio" value="all">&nbsp;<?php echo $this->_tpl_vars['APP']['LBL_ADV_SEARCH_MSG_ALL']; ?>
</b></td>
					<td nowrap width=60% class="small" ><b><input name="matchtype" type="radio" value="any" checked>&nbsp;<?php echo $this->_tpl_vars['APP']['LBL_ADV_SEARCH_MSG_ANY']; ?>
</b></td>
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
						<tr  >
							<td width="31%"><select name="Fields0" id="Fields0" class="detailedViewTextBox" onchange="updatefOptions(this, 'Condition0')"><?php echo $this->_tpl_vars['FIELDNAMES']; ?>
</select>
							</td>
							<td width="32%"><select name="Condition0" id="Condition0" class="detailedViewTextBox"><?php echo $this->_tpl_vars['CRITERIA']; ?>
</select>
							</td>
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
						<input type="button" name="more" value=" <?php echo $this->_tpl_vars['APP']['LBL_MORE']; ?>
 " onClick="fnAddSrch('<?php echo $this->_tpl_vars['FIELDNAMES']; ?>
','<?php echo $this->_tpl_vars['CRITERIA']; ?>
')" class="crmbuttom small edit" >
						<input name="button" type="button" value=" <?php echo $this->_tpl_vars['APP']['LBL_FEWER_BUTTON']; ?>
 " onclick="delRow()" class="crmbuttom small edit" >
			</td>
			<td align=left class="small"><input type="button" class="crmbutton small create" value=" <?php echo $this->_tpl_vars['APP']['LBL_SEARCH_NOW_BUTTON']; ?>
 " onClick="totalnoofrows();callSearch('Advanced');">
			</td>
		</tr>
	</table>
</form>
</div>		









<form action="index.php" method="post" name="EditView" id="form" onsubmit="VtigerJS_DialogBox.block();">
<input type='hidden' name='module' value='Users'>
<input type='hidden' name='action' value='EditView'>
<input type='hidden' name='return_action' value='ListView'>
<input type='hidden' name='return_module' value='Users'>
<input type='hidden' name='parenttab' value='Settings'>

				<table border=0 cellspacing=0 cellpadding=10 width=100% >
				<tr>
				<td>
					<div id="ListViewContents">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "UserListViewContents.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>	
				</td>
				</tr>
				</table>
			
			
			
			</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
		
	</div>

</td>
        <td valign="top"><img src="<?php echo vtiger_imageurl('showPanelTopRight.gif', $this->_tpl_vars['THEME']); ?>
"></td>
   </tr>
</tbody>
</form>
</table>

<div id="tempdiv" style="display:block;position:absolute;left:350px;top:200px;"></div>
<?php echo '
<script>
function getListViewEntries_js(module,url)
{
	    var select_options  =  document.getElementsByName(\'selected_id\');
        var x = select_options.length;
        var viewid =getviewId();
        idstring = "";

        xx = 0;
        for(i = 0; i < x ; i++)
        {
                if(select_options[i].checked)
                {
                        idstring = select_options[i].value +";"+idstring
                        xx++
                }
        }
        var all_selected=document.getElementById(\'allselectedboxes\').value;

        $("status").style.display="inline";
		if(typeof $(\'search_url\') != \'undefined\' && $(\'search_url\').value!=\'\')
                urlstring = $(\'search_url\').value;
        else
                urlstring = \'\';
		gstart = url;
		
        new Ajax.Request(
                \'index.php\',
                {queue: {position: \'end\', scope: \'command\'},
                        method: \'post\',
                        postBody: "module=Users&action=UsersAjax&file=ListView&ajax=true&allselobjs="+all_selected+"&selobjs="+idstring+"&"+url+urlstring,
						onComplete: function(response) {
                        	$("status").style.display="none";
							$("ListViewContents").innerHTML= response.responseText;
							update_selected_checkbox();
                        }
                }
        );
}
function update_selected_checkbox()
{
        var all=document.getElementById(\'current_page_boxes\').value;
        var tocheck=document.getElementById(\'allselectedboxes\').value;
        var allsplit=new Array();
        allsplit=all.split(";");

        var selsplit=new Array();
        selsplit=tocheck.split(";");
        var n=selsplit.length;
        for(var i=0;i<n;i++)
        {
                if(allsplit.indexOf(selsplit[i]) != "-1"){
                        document.getElementById(selsplit[i]).checked=\'true\';
				}
        }
}
function deleteUser(obj,userid)
{
        $("status").style.display="inline";
        new Ajax.Request(
                \'index.php\',
                {queue: {position: \'end\', scope: \'command\'},
                        method: \'post\',
                        postBody: \'action=UsersAjax&file=UserDeleteStep1&return_action=ListView&return_module=Users&module=Users&parenttab=Settings&record=\'+userid,
                        onComplete: function(response) {
                                $("status").style.display="none";
                                $("tempdiv").innerHTML= response.responseText;
				fnvshobj(obj,"tempdiv");
                        }
                }
        );
}
function transferUser(del_userid)
{
        $("status").style.display="inline";
        $("DeleteLay").style.display="none";
        var trans_userid=$(\'transfer_user_id\').options[$(\'transfer_user_id\').options.selectedIndex].value;
        new Ajax.Request(
                \'index.php\',
                {queue: {position: \'end\', scope: \'command\'},
                        method: \'post\',
                        postBody: \'module=Users&action=UsersAjax&file=DeleteUser&ajax=true&delete_user_id=\'+del_userid+\'&transfer_user_id=\'+trans_userid,
                        onComplete: function(response) {
                                $("status").style.display="none";
                                $("ListViewContents").innerHTML= response.responseText;
                        }
                }
        );

}
</script>
'; ?>

<script language="javascript">
/*
function callSearch(searchtype)
{
	search_fld_val= $('bas_searchfield').options[$('bas_searchfield').selectedIndex].value;
	search_txt_val= encodeURIComponent(document.basicSearch.search_text.value);
        var urlstring = '';
        if(searchtype == 'Basic')
        {
        		var p_tab = document.getElementsByName("parenttab");
                urlstring = 'search_field='+search_fld_val+'&searchtype=BasicSearch&search_text='+search_txt_val+'&';
                urlstring = urlstring + 'parenttab='+p_tab[0].value+ '&';
        }
	$("status").style.display="inline";
	new Ajax.Request(
		'index.php',
		{queue: {position: 'end', scope: 'command'},
			method: 'post',
			postBody:urlstring +'query=true&file=ListView&module=Users&action=UsersAjax&ajax=true&search=true',
			onComplete: function(response) {
								$("status").style.display="none";
                                result = response.responseText.split('&#&#&#');
                                $("ListViewContents").innerHTML= result[0];
			}
	       }
        );
	return false
}
*/
</script>
<script language="javascript">
function checkgroup()
{
  if($("group_checkbox").checked)
  {
  document.change_ownerform_name.lead_group_owner.style.display = "block";
  document.change_ownerform_name.lead_owner.style.display = "none";
  }
  else
  {
  document.change_ownerform_name.lead_owner.style.display = "block";
  document.change_ownerform_name.lead_group_owner.style.display = "none";
  }    
  
}
function callSearch(searchtype)
{
/*	for(i=1;i<=26;i++)
    	{
        	var data_td_id = 'alpha_'+ eval(i);
        	getObj(data_td_id).className = 'searchAlph';
    	}*/
    	gPopupAlphaSearchUrl = '';
	search_fld_val= $('bas_searchfield').options[$('bas_searchfield').selectedIndex].value;
	search_txt_val= encodeURIComponent(document.basicSearch.search_text.value);
        var urlstring = '';
        if(searchtype == 'Basic')
        {
        		var p_tab = document.getElementsByName("parenttab");
                urlstring = 'search_field='+search_fld_val+'&searchtype=BasicSearch&search_text='+search_txt_val+'&';
                urlstring = urlstring + 'parenttab='+p_tab[0].value+ '&';
        }
        else if(searchtype == 'Advanced')
        {
                var no_rows = document.basicSearch.search_cnt.value;
                for(jj = 0 ; jj < no_rows; jj++)
                {
                        var sfld_name = getObj("Fields"+jj);
                        var scndn_name= getObj("Condition"+jj);
                        var srchvalue_name = getObj("Srch_value"+jj);
                        var p_tab = document.getElementsByName("parenttab");
                        urlstring = urlstring+'Fields'+jj+'='+sfld_name[sfld_name.selectedIndex].value+'&';
                        urlstring = urlstring+'Condition'+jj+'='+scndn_name[scndn_name.selectedIndex].value+'&';
			urlstring = urlstring+'Srch_value'+jj+'='+encodeURIComponent(srchvalue_name.value)+'&';
                        urlstring = urlstring + 'parenttab='+p_tab[0].value+ '&';
                }
                for (i=0;i<getObj("matchtype").length;i++){
                        if (getObj("matchtype")[i].checked==true)
                                urlstring += 'matchtype='+getObj("matchtype")[i].value+'&';
                }
                urlstring += 'search_cnt='+no_rows+'&';
                urlstring += 'searchtype=advance&'
        }
	$("status").style.display="inline";
	//alert(urlstring +'query=true&file=ListView&module=Users&action=UsersAjax&ajax=true&search=true');
	//return;
	new Ajax.Request(
		'index.php',
		{queue: {position: 'end', scope: 'command'},
			method: 'post',
			postBody:urlstring +'query=true&file=ListView&module=Users&action=UsersAjax&ajax=true&search=true',
			onComplete: function(response) {
/* 								$("status").style.display="none";
                               result = response.responseText.split('&#&#&#');
                                $("ListViewContents").innerHTML= result[2];
                                if(result[1] != '')
									alert(result[1]);*/
									
								$("status").style.display="none";
                                result = response.responseText.split('&#&#&#');
                                $("ListViewContents").innerHTML= result[0];
								
								$('basicsearchcolumns').innerHTML = '';
			}
	       }
        );
	return false
}
function alphabetic(module,url,dataid)
{
/*        for(i=1;i<=26;i++)
        {
                var data_td_id = 'alpha_'+ eval(i);
                getObj(data_td_id).className = 'searchAlph';

        }
        getObj(dataid).className = 'searchAlphselected';*/
	$("status").style.display="inline";
	new Ajax.Request(
		'index.php',
		{queue: {position: 'end', scope: 'command'},
			method: 'post',
			postBody: 'module='+module+'&action='+module+'Ajax&file=index&ajax=true&search=true&'+url,
			onComplete: function(response) {
/*				$("status").style.display="none";
				result = response.responseText.split('&#&#&#');
				$("ListViewContents").innerHTML= result[2];
				if(result[1] != '')
			                alert(result[1]);*/
							
				$("status").style.display="none";
				result = response.responseText.split('&#&#&#');
				$("ListViewContents").innerHTML= result[0];
				
				$('basicsearchcolumns').innerHTML = '';
			}
		}
	);
}


var typeofdata = new Array();
typeofdata['E'] = ['e','n','s','ew','c','k'];
typeofdata['V'] = ['e','n','s','ew','c','k'];
typeofdata['N'] = ['e','n','l','g','m','h'];
typeofdata['NN'] = ['e','n','l','g','m','h'];
typeofdata['T'] = ['e','n','l','g','m','h'];
typeofdata['I'] = ['e','n','l','g','m','h'];
typeofdata['C'] = ['e','n'];
typeofdata['DT'] = ['e','n','l','g','m','h'];
typeofdata['D'] = ['e','n','l','g','m','h'];

var fLabels = new Array();
fLabels['e'] = "<?php echo $this->_tpl_vars['APP']['is']; ?>
";
fLabels['n'] = "<?php echo $this->_tpl_vars['APP']['is_not']; ?>
";
fLabels['s'] = "<?php echo $this->_tpl_vars['APP']['begins_with']; ?>
";
fLabels['ew'] = "<?php echo $this->_tpl_vars['APP']['ends_with']; ?>
";
fLabels['c'] = "<?php echo $this->_tpl_vars['APP']['contains']; ?>
";
fLabels['k'] = "<?php echo $this->_tpl_vars['APP']['does_not_contains']; ?>
";
fLabels['l'] = "<?php echo $this->_tpl_vars['APP']['less_than']; ?>
";
fLabels['g'] = "<?php echo $this->_tpl_vars['APP']['greater_than']; ?>
";
fLabels['m'] = "<?php echo $this->_tpl_vars['APP']['less_or_equal']; ?>
";
fLabels['h'] = "<?php echo $this->_tpl_vars['APP']['greater_or_equal']; ?>
";
var noneLabel;

<?php echo '

function trimfValues(value)
{
    var string_array;
    string_array = value.split(":");
    return string_array[4];
}
function updatefOptions(sel, opSelName) {
    var selObj = document.getElementById(opSelName);
    var fieldtype = null ;

    var currOption = selObj.options[selObj.selectedIndex];
    var currField = sel.options[sel.selectedIndex];
    
    var fld = currField.value.split(":");
    var tod = fld[4];
    if(currField.value != null && currField.value.length != 0)
    {
	fieldtype = trimfValues(currField.value);
	fieldtype = fieldtype.replace(/\\\\\'/g,\'\');
	ops = typeofdata[fieldtype];
	var off = 0;
	if(ops != null)
	{

		var nMaxVal = selObj.length;
		for(nLoop = 0; nLoop < nMaxVal; nLoop++)
		{
			selObj.remove(0);
		}
		for (var i = 0; i < ops.length; i++)
		{
			var label = fLabels[ops[i]];
			if (label == null) continue;
			var option = new Option (fLabels[ops[i]], ops[i]);
			selObj.options[i] = option;
			if (currOption != null && currOption.value == option.value)
			{
				option.selected = true;
			}
		}
	}
    }else
    {
	var nMaxVal = selObj.length;
	for(nLoop = 0; nLoop < nMaxVal; nLoop++)
	{
		selObj.remove(0);
	}
	selObj.options[0] = new Option (\'None\', \'\');
	if (currField.value == \'\') {
		selObj.options[0].selected = true;
	}
    }

}
'; ?>

</script>