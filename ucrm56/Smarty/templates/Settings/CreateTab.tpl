{*
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
 ********************************************************************************/ *}
<script language="JavaScript" type="text/javascript" src="include/js/customview.js"></script>
<script language="javascript">
{literal}
function deleteTab(id)
{
        if(confirm(alert_arr.SURE_TO_DELETE))
        {
                document.form.action="index.php?module=Settings&action=DeleteTab&id="+id;
                document.form.submit();
        }
}

function getCreateTabForm(id)
{
	new Ajax.Request(
		'index.php',
		{queue: {position: 'end', scope: 'command'},
			method: 'post',
			postBody: 'module=Settings&action=SettingsAjax&file=CreateTab&id='+id+'&parenttab=Settings&ajax=true',
			onComplete: function(response) {
				$("createtab").innerHTML=response.responseText;
				execJS($('tabLayer'));
				execJS($('tabchooser'));
				
			}
		}
	);

}
function isChar(str) {
	var re= new RegExp(/[a-zA-Z0-9_]/);
	//var re = /^[a-zA-Z\d\_]+$/i;
	if (!re.test(str)) {
		return false;
	}
	else {
		return true;
	}
}
function validate_tab() {
		if(document.addtodb.parenttab_label.value == "") {
			alert(alert_arr.PARENTTAB_KEY_IS_NULL);
			document.addtodb.parenttab_label.focus();
			return false;
		} else {
		        var str = document.addtodb.parenttab_label.value;
			if(!isChar(str)) {
				alert(alert_arr.INPUT_VALID_CHARACTER);
				document.addtodb.parenttab_label.focus();
				return false;
			}
		}
		if(document.addtodb.parenttab_label_cn.value == "") {
			alert(alert_arr.PARENTTAB_LABEL_IS_NULL);
			document.addtodb.parenttab_label_cn.focus();
			return false;
		}
		
		if(document.addtodb.sequence.value == "") {
			alert(alert_arr.DISPLAY_ORDER_IS_NULL);
			document.addtodb.sequence.focus();
			return false;
		} else {
			if(isNaN(trim(document.addtodb.sequence.value))) {
				alert(alert_arr.LBL_ENTER_VALID_NO);
				document.addtodb.sequence.focus();
				return false;
			}
		}
		return true;
}
function set_chooser()
{
	if(object_refs['display_tabs'].options.length == 0 && document.addtodb.id.value != 8){
		alert(alert_arr.EMPTY_MODULE_VIEW);
		return false;
	}
var display_tabs_def = '';
for(i=0; i < object_refs['display_tabs'].options.length ;i++)
{
         display_tabs_def += "display_tabs[]="+object_refs['display_tabs'].options[i].value+"&";
}
document.addtodb.display_tabs_def.value = display_tabs_def;
}
{/literal}
</script>
<div id="createtab" style="display:block;position:absolute;width:400px;"></div>
<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
<tbody><tr>
     	<td valign="top"><img src="{'showPanelTopLeft.gif'|@vtiger_imageurl:$THEME}"></td>
        <td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">
        <br>

	<div align=center>
			{include file='SetMenu.tpl'}
			<!-- DISPLAY -->
			{if $MODE neq 'edit'}
			<b><font color=red>{$DUPLICATE_ERROR} </font></b>
			{/if}
			
				<table class="settingsSelUITopLine" border="0" cellpadding="5" cellspacing="0" width="100%">
				<tbody><tr>
					<td rowspan="2" valign="top" width="50"><img src="{'customtab.gif'|@vtiger_imageurl:$THEME}" alt="{$MOD.LBL_USERS}" title="{$MOD.LBL_USERS}" border="0" height="48" width="48"></td>
					 
					<td class="heading2" valign="bottom"><b><a href="index.php?module=Settings&action=index&parenttab=Settings">{$MOD.LBL_SETTINGS}</a> &gt; {$MOD.LBL_TAB_EDITOR}</b></td>
				</tr>

				<tr>
					<td class="small" valign="top">{$MOD.LBL_CUSTOMTABLIST_DESCRIPTION}</td>
				</tr>
				</tbody></table>
				
				<br>
				<table border="0" cellpadding="10" cellspacing="0" width="100%">
				<tbody><tr>
				<td align="left">
				{$OUTPUT}
				
			</td>
			</tr>
			</table>
		<!-- End of Display -->
		
		</td>
        </tr>
        </table>
        </td>
        </tr>
        </table>
        </div>

        </td>
        <td valign="top"><img src="{'showPanelTopRight.gif'|@vtiger_imageurl:$THEME}"></td>
        </tr>
</tbody>
</table>
<br>
