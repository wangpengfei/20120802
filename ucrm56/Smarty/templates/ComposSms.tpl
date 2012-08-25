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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset={$APP.LBL_CHARSET}">
<title>{$MOD.TITLE_COMPOSE_SMS}</title>
<link REL="SHORTCUT ICON" HREF="include/images/vtigercrm_icon.ico">	
<style type="text/css">@import url("themes/{$THEME}/style.css");</style>
<script language="javascript" type="text/javascript" src="include/scriptaculous/prototype.js"></script>
<script src="include/scriptaculous/scriptaculous.js" type="text/javascript"></script>
<script src="include/js/general.js" type="text/javascript"></script>
<script type="text/javascript" src="include/js/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="include/js/{php} echo $_SESSION['authenticated_user_language'];{/php}.lang.js?{php} echo $_SESSION['vtiger_version'];{/php}"></script>
<script type="text/javascript" src="include/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="modules/Products/multifile.js"></script>
<script type="text/javascript" src="modules/SMSNotifier/SendSms.js"></script>
{$SCRIPT}
</head>
<bodymarginheight="0" marginwidth="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" style="font-size:14px;">
<form name="frm" action="#" method="get">
<table   cellspacing="0" cellpadding="0" border="0" width="100%" class="mailClientWriteEmailHeader">
	<tbody><tr>
		<td>{$MOD.SENDSMS}</td>
	</tr>
	</tbody>
	</table>
<table width="100%"  border="0">
  <tr>
    <td align="right" class="mailSubHeader"  width="70">{$MOD.SMSSENDUSER}</td>
    <td class="mailSubHeader" ><label for="idlist"></label>
      <input type="hidden"  class="txtBox" name="phonestring" id="phonestring"  readonly="true" value='{$PHONE}'/>
	  <textarea readonly="true"  style="width:800px; height:100px;overflow-y:auto"/>{$PHONE}</textarea> 
	  <input type="hidden"  class="txtBox" name="idstring" id="idstring"  value='{$IDSTRING}'/></td>
  </tr>
  <tr>
    <td align="right" class="mailSubHeader">&nbsp;</td>
    <td class="mailSubHeader">
	{if $SELECT neq ''}
	{$MOD.LBL_MOBAN_LABEL}  
	<select name="moban"  onchange="change(this)">  
	<option value="">{$MOD.LBL_PLEASESELECT_LABEL}  </option>  
	{foreach key=key item=item from=$SELECT}
		<option value="{$key}">{$item}</option>  
	{/foreach}
	</select>  
	{/if}
      <input type="button" class="crmbutton small save" name="button3" id="button3" value="{$MOD.SMSSENDMSG}" onclick='sendsms(this.form)' />
      <input type="button" class="crmbutton small save" name="button6" id="button8" value="{$MOD.SMSSENDCANCEL}"  onclick='cencel()' />
	  
	{if $SELECTDEP neq ''}
	{$MOD.LBL_DEP_LABEL}
	<select name="dep"  id="dep"  onChange="getProject(this)" style="width:130px;">  
	<option value="">{$MOD.LBL_PLEASESELECT_LABEL}  </option>  
	{foreach key=key item=item from=$SELECTDEP}
		<option value="{$key}">{$item}</option>  
	{/foreach}
	</select>  
	{/if}
	{if $SELECTPRO neq ''}
	{$MOD.LBL_PRO_LABEL}
	<select name="pro"  id="pro"  onChange="getCourse(this)"  style="width:130px;">  
	{foreach key=key item=item from=$SELECTPRO}
		<option value="{$key}">{$item}</option>  
	{/foreach}
	</select>  
	{/if}
	{if $SELECTCOU neq ''}
	{$MOD.LBL_COU_LABEL}
	<select name="cou"  id="cou" style="width:130px;">  
	{foreach key=key item=item from=$SELECTCOU}
		<option value="{$key}">{$item}</option>  
	{/foreach}
	</select>  
	{/if}
	{if $SELECTPARTY neq ''}
	{$MOD.LBL_PARTY_LABEL}
	<select name="par"  id="par" style="width:130px;">  
	{foreach key=key item=item from=$SELECTPARTY}
		<option value="{$key}">{$item}</option>  
	{/foreach}
	</select>  
	{/if}
	<font style="font-size:12px">{$NOTICE}</font>
 </td>
  </tr>
  <tr>
    <td align="right" class="mailSubHeader">&nbsp;</td>
    <td class="mailSubHeader"><textarea name="sendmsg" id="sendmsg" style="width:800px; height:100px;overflow-y:auto" onKeyup='showcharnum()'></textarea></td>
  </tr>
  <tr>
    <td align="right" class="mailSubHeader">&nbsp;</td>
    <td class="mailSubHeader">
	<div style="float:left;width:350px;">
	{if $SELECT neq ''}
	{$MOD.LBL_MOBAN_LABEL}  
	<select name="moban"  onchange="change(this)">  
	<option value="">{$MOD.LBL_PLEASESELECT_LABEL}  </option>  
	{foreach key=key item=item from=$SELECT}
		<option value="{$key}">{$item}</option>  
	{/foreach}
	</select>  
	{/if}
      <input type="button" class="crmbutton small save" name="button4" id="button6" value="{$MOD.SMSSENDMSG}" onclick='sendsms(this.form)' />
      <input type="button" class="crmbutton small save" name="button5" id="button7" value="{$MOD.SMSSENDCANCEL}"   onclick='cencel()'/>
	  </div>
	  <div style="float:left;width:300px;color:#959595">
	  <span id="showchars"></span>
	  </div>
	  <span id="returnmsg"></span>
	  </td>
  </tr>
</table>
</form>



