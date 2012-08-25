<?php
/*********************************************************************************
* The contents of this file are subject to the SugarCRM Public License Version 1.1.2
* ("License"); You may not use this file except in compliance with the
* License. You may obtain a copy of the License at http://www.sugarcrm.com/SPL
* Software distributed under the License is distributed on an  "AS IS"  basis,
* WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License for
* the specific language governing rights and limitations under the License.
* The Original Code is:  SugarCRM Open Source
* The Initial Developer of the Original Code is SugarCRM, Inc.
* Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.;
* All Rights Reserved.
* Contributor(s): ______________________________________.
********************************************************************************/
/*********************************************************************************
* $Header: /advent/projects/wesat/vtiger_crm/sugarcrm/modules/Users/Login.php,v 1.6 2005/01/08 13:15:03 jack Exp $
* Description: TODO:  To be written.
* Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
* All Rights Reserved.
* Contributor(s): ______________________________________..
********************************************************************************/
$theme_path = "themes/" . $theme . "/";
$image_path = "include/images/";

global $app_language,$adb;

$organization = $adb->pquery('select * from vtiger_organizationdetails',array());
$org_name = $organization->fields['organizationname'];

if($organization->fields['website']){
	$org_website = 'http://'.str_replace('http://','',$organization->fields['website']);
}else{
	//$org_website = 'javascript:void(0);';
}

//we don't want the parent module's string file, but rather the string file specifc to this subpanel
global $current_language;
$current_module_strings = return_module_language($current_language, 'Users');

define("IN_LOGIN", true);

include_once ('vtlib/Vtiger/Language.php');

// Retrieve username and password from the session if possible.
if (isset($_SESSION["login_user_name"])) {
    if (isset($_REQUEST['default_user_name']))
        $login_user_name = vtlib_purify($_REQUEST['default_user_name']);
    else
        $login_user_name = vtlib_purify($_SESSION['login_user_name']);
} else {
    if (isset($_REQUEST['default_user_name'])) {
        $login_user_name = vtlib_purify($_REQUEST['default_user_name']);
    } elseif (isset($_REQUEST['ck_login_id_vtiger'])) {
        $login_user_name = get_assigned_user_name($_REQUEST['ck_login_id_vtiger']);
    } else {
        $login_user_name = $default_user_name;
    }
    $_session['login_user_name'] = $login_user_name;
}

$current_module_strings['VLD_ERROR'] = base64_decode('UGxlYXNlIHJlcGxhY2UgdGhlIFN1Z2FyQ1JNIGxvZ29zLg==');

// Retrieve username and password from the session if possible.
if (isset($_SESSION["login_password"])) {
    $login_password = $_SESSION['login_password'];
} else {
    $login_password = $default_password;
    $_session['login_password'] = $login_password;
}

if (isset($_SESSION["login_error"])) {
    $login_error = $_SESSION['login_error'];
}
ob_end_clean();
?>
<HTML><HEAD><TITLE>友客crm v56</TITLE>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
<META content="友客crm v56 —— 友贝科技" name=title>
<META content="友客crm v56 友贝科技" name=description>
<META content="友客,crm,vtiger,友贝科技" name=keywords>
<!--Added to display the footer in the login page by Dina-->
<style type="text/css">@import url("themes/<?php echo $theme; ?>/style.css");
</style>
<STYLE type=text/css>
.word_10p {
	FONT-WEIGHT: bold; FONT-SIZE: 10pt; COLOR: #000000; FONT-FAMILY: "Verdana", "Arial", "Helvetica", "sans-serif"
}
.font_9p {
	FONT-SIZE: 9pt; COLOR: #000000; LINE-HEIGHT: 18px; FONT-FAMILY: "Verdana", "Arial", "Helvetica", "sans-serif"
}
.title {
	FONT-WEIGHT: bold; FONT-SIZE: 9pt; COLOR: #000000; LINE-HEIGHT: 20px; FONT-FAMILY: "Verdana", "Arial", "Helvetica", "sans-serif"
}
.inputbg1 {
 background-image:url(include/images/inputbg1.gif);
 background-position:bottom;
 background-repeat:no-repeat;
 }
.inputbg2 {
 background-image:url(include/images/inputbg2.gif);
 background-position:bottom;
 background-repeat:no-repeat;
 }
.inputbg3 {
 background-image:url(include/images/inputbg3.gif);
 background-position:bottom;
 background-repeat:no-repeat;
 }
.inputbg {
 background-image:url(include/images/inputbg.gif);
 background-position:bottom;
 background-repeat:no-repeat;
 }
 
 
 body{margin:0; padding:0}
.top{ height:133px; width:100%;border:0;margin:0; padding:0}
.div1{ height:133px; width:32px; background-image:url(include/images/head_left.gif)}
.div2{ height:133px;  background-image:url(include/images/head_b.gif);}
.div3{ height:133px; width:36px; background-image:url(include/images/head_right.gif)}
.div4{ height:66px; margin-top:10px;background-image:url(include/images/qin_log.gif);background-repeat: no-repeat;  }
.div5{ height:22px;  }
.div6{ height:400px; width:996px; background-image:url(include/images/body_bg.gif);background-repeat: no-repeat; }

.qq {position:absolute;z-index:200;left:10px;top:150px;width:60px;height:350px}
.divHelp {position:absolute;z-index:200;left:900px;top:150px;border:1px #3881E2 solid; background:RBG(178,218,255);width:260px;height:350px}
.divAbout {position:absolute;z-index:200;left:900px;top:150px;border:1px #3881E2 solid; background:RBG(178,218,255);width:260px;height:150px}
.divServer {position:absolute;z-index:200;left:900px;top:150px;border:1px #3881E2 solid; background:RBG(178,218,255);width:260px;height:150px}
</STYLE>
<script type="text/javascript" language="JavaScript">
<!-- Begin -->
function set_focus() {
	if (document.DetailView.user_name.value != '') {
		document.DetailView.user_password.focus();
		document.DetailView.user_password.select();
	}
	else document.DetailView.user_name.focus();
}

<!-- End -->

//<!--function showDiv(){
//	document.getElementById("divHelp").style.display='';
//}
//
//-->

function $(){return document.getElementById?document.getElementById(arguments[0]):eval(arguments[0]);}
var OverH,OverW,ChangeDesc,ChangeH=50,ChangeW=50;


function OpenDiv(value) {
	document.getElementById('divHelp').style.display="none";
	document.getElementById('divAbout').style.display="none";
	document.getElementById('divServer').style.display="none";
	$(value).style.display='';


}

function closeDiv(value){
		document.getElementById(value).style.display="none";
	
}

</script>


<BODY>

<div id="divHelp" class="divHelp" style="display:none; " onDblClick="this.style.display='none'">
<table border="0" cellspacing="5" width="250" class="pubtable" cellpadding="5">
  <tr class="small" style="color:#3881E2">
    <td ><strong>帮助指引</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="right"><a href="javascript:closeDiv('divHelp')" style="color:#3881E2">[关闭]</a></td>
  </tr>
  <tr class="tableline1 small" style="color:#3881E2">
    <td colspan="2" ><table border="0" width="100%" cellpadding="5" cellspacing="1" class="pubtable">
      <tr class="tableline2 small"  style="color:#3881E2">
        <td rowspan="2" width="2%" valign='top'>&nbsp;</td>
        <td><strong>首页设置－添加首页模块 </strong></td>
      </tr>
      <tr class="tableline2 small" style="color:#3881E2">
        <td width="98%"><span >进入工作台首页，鼠标点击+号按钮，根据用户习惯自己设置显示模块。</span></td>
      </tr>
      <tr class="tableline2 small" style="color:#3881E2">
        <td rowspan="2" width="2%" valign='top'>&nbsp;</td>
        <td><strong>修改密码</strong></td>
      </tr>
      <tr class="tableline1 small" style="color:#3881E2">
        <td width="98%"><span>进入系统后，点击右上角“我的设定”修改个人密码。</span></td>
      </tr>
      <tr class="tableline2 small" style="color:#3881E2">
        <td rowspan="2" width="2%" valign='top'>&nbsp;</td>
        <td><strong>邮件发送设置</strong></td>
      </tr>
      <tr class="tableline2 small" style="color:#3881E2">
        <td width="98%"><span>进入系统后，点击右上角“我的设定”修改个人邮箱。</span></td>
      </tr>
      <tr class="tableline2 small" style="color:#3881E2">
        <td rowspan="2" width="2%" valign='top'>&nbsp;</td>
        <td>
        <a href="http://www.ucrm.net/faq/index.php" title="http://www.ucrm.net/faq/index.php" target="_blank" style="color:#3881E2;text-decoration:none;"><strong>更多...</strong></a></td>
      </tr>
    </table></td>
  </tr>
</table>
</div>

<div id="divAbout" class="divAbout" style="display:none"  onDblClick="this.style.display='none'">
<table border="0" cellspacing="5" width="250" class="pubtable" cellpadding="5">
  <tr class="small" style="color:#3881E2">
    <td > <strong>关于友客CRM</strong></td>
    <td align="right">&nbsp;<a href="javascript:closeDiv('divAbout')" style="color:#3881E2">[关闭]</a></td>
  </tr>
  <tr class="small" style="color:#3881E2">
    <td colspan="2" class="tableline1"><span style="line-height:25px;"><strong>版本</strong>：<a href="http://www.ucrm.net" target="_blank" style="color:#3881E2">友客CRM系统 V56版</a><br />
      <strong>版权所有</strong>：<a href="http://www.ubiwire.com" target="_blank" style="color:#3881E2">深圳市友贝科技有限公司</a></span></td>
  </tr>
</table>
</div>

<div id="divServer" class="divServer" style="display:none"  onDblClick="this.style.display='none'">
<table border="0" cellspacing="5" width="250" class="pubtable" cellpadding="5">
  <tr class="small" style="color:#3881E2">
    <td ><strong>联系客服</strong></td>
    <td align="right" ><a href="javascript:closeDiv('divServer')" style="color:#3881E2">[关闭]</a></td>
  </tr>
  
  <tr class="small" style="color:#3881E2">
    <td >联系人</td>
    <td > 王小姐</td>
  </tr>
  <tr class="tableline1 small" style="color:#3881E2">
    <td>电话(24小时)</td>
    <td nowrap>0755-26895119</td>
  </tr>
  <tr class="tableline1 small" style="color:#3881E2">
    <td >QQ</td>
    <td nowrap>283088686
    <a href="http://wpa.qq.com/msgrd?V=1&Uin=283088686@qq.com&Site=ioshenmue&Menu=yes" target="_blank">
    <IMG border=0 align=absMiddle src="http://wpa.qq.com/pa?p=2:283088686@qq.com:16">
    </a>
    </td>
  </tr>
</table>
</div>

<table width="100%" border="0"cellpadding="0" cellspacing="0" align="center">
<tr>
<td class="div1">&nbsp;</td>
<td class="div2">
<table width="100%" height="133" border="0"cellpadding="0" cellspacing="0">
<tr>
<td align="bottom">
<div class="div4" align="right" >
<div style="height:66px; padding-top:45px">
<a href="<?php echo $org_website;?>" title="<?php echo $org_website;?>" target="_blank" style="font-family:SimSun; color:#FFF; font-size:24px; text-decoration:none;">
<strong><?php echo $org_name;?></strong>
</a>
</div>
</div></td>
</tr>

<tr>
<td><div class="div5" align="right">
<a href="javascript:OpenDiv('divHelp')"><img alt="" border="0" src="include/images/help.gif" /></a>&nbsp;&nbsp;
<a href="javascript:OpenDiv('divAbout')"><img alt="" border="0" src="include/images/about.gif" /></a>&nbsp;&nbsp;
<a href="javascript:OpenDiv('divServer')"><img alt="" border="0" src="include/images/server.gif" /></a>&nbsp;&nbsp;
</div></td>
</tr>
</table>

</td>
<td class="div3">&nbsp;</td>
</tr>
</table>
<table width="100%" border="0"cellpadding="0" cellspacing="0" align="center">
<tr>
<td   align="center" valign="middle" >
<div class="div6" >

<table>
<tr>
<td height="79">&nbsp;</td>
</tr>
<tr>
<td>


 <form action="index.php" method="post" name="DetailView" id="DetailView" >
<input type="hidden" name="module" value="Users">
<input type="hidden" name="action" value="Authenticate">
<input type="hidden" name="return_module" value="Users">
<input type="hidden" name="return_action" value="Login">

<table width="200" height="238" border="0" cellpadding="0" cellspacing="0" align="center">
<INPUT 	type=hidden name=returnURL> 
  <TBODY>
    <tr>
      <td colspan="3" height="56"><img alt="" src="include/images/login_top.gif"/></td>
      </tr>
    <tr>
      <td width="15" height="142"><img alt="" src="include/images/login_left.gif" /></td>
      <td width="380" background="include/images/login_bg.gif"><div class="div">
	  
	  
      <table>
      <tr class="small" align="left">
      <td>&nbsp;&nbsp;&nbsp;<?php echo $current_module_strings['LBL_USER_NAME'] ?></td>
      <td>&nbsp;<input type="text"  name="user_name" value="<?php echo $login_user_name ?>" style="width:230px"/></td>
      </tr>
      <tr class="small" align="left">
      <td>&nbsp;&nbsp;&nbsp;<?php echo $current_module_strings['LBL_PASSWORD'] ?></td>
      <td>&nbsp;<input type="password" name="user_password" value="<?php echo $login_password ?>"  style="width:230px" />
      
      </td>
      </tr>
     <!--- <tr align="left">
      <td >&nbsp;&nbsp;&nbsp;<?php echo $current_module_strings['LBL_CODE'] ?></td>
      <td>&nbsp;<input type="text" value=""  name="user_code" size="15" />
       &nbsp;&nbsp;<img src="modules/Users/getcode.php" >
				 <input type="hidden" name="authnum" value="<?php echo $randtext; ?>">
      </td>-->
      </tr>
      <tr >
        <td class="small" >&nbsp;&nbsp;&nbsp;<?php echo $current_module_strings['LBL_LANGUAGE'] ?></td>
        <td class="small" >&nbsp;<select class="small" name='login_language' style="width:70%" tabindex="4">
            <!-- vtlib Customization -->
            <?php echo get_select_options_with_id(get_languages(), $display_language) ?>
        </select></td>		
    </tr>
       <input type="hidden" name="login_theme" value="softed">
		<!--<input type="hidden" name="login_language" value="zh_cn">-->
      <tr>
      <td colspan="2" align="center" style="padding-left:3px"><input type="submit" style="background:url(include/images/login_but.gif); width:315px; height:27px; border:0px" value="" tilte="¼˼CRMϵͳ" /><br />
     <!-- <img alt="" src="images/login_but.gif" /></td>-->
     
     <?php
if (isset($_SESSION['validation'])) {
?>
					<font color="Red">  </font>
				<?php
} else
    if (isset($login_error) && $login_error != "") {
?>
					<b ><font color="Brown" >
					<?php echo $login_error ?>
					</font>
					</b>
				<?php
    }
?>
      </tr>
      </table>
     
      
      </div></td>
      <td width="12" align="right"><img alt="" src="include/images/login_right.gif" /></td>
    </tr>
    <tr>
      <td colspan="3" height="40" ><img src="include/images/login_foot.gif" /></td>
    </tr>
  </table>
   </form>
</td>
</tr>
</table>


</div>
&nbsp;
</td>
</tr>
</table>
</BODY></HTML>