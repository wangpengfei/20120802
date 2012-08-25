<?php
/*********************************************************************************
** The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
*
 ********************************************************************************/

require_once("PortalConfig.php");
require_once("language/$default_language.lang.php");
include("version.php");
include_once('include/utils/utils.php');

@session_start();
if(isset($_SESSION['customer_id']) && isset($_SESSION['customer_name']))
{
	header("Location: index.php?action=index&module=.'$module'");
	exit;
}
if($_REQUEST['close_window'] == 'true')
{
   ?>
	<script language="javascript">
        	window.close();
	</script>
   <?php
}
global $default_charset;
header('Content-Type: text/html; charset='.$default_charset);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ubiCRM  - 客户自助服务门户</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
	<table cellspacing="0" cellpadding="0" class="outerTab">
	   <tr>
		<td width="15%"><br><br><br></td>
		<td width="70%"></td>
		<td width="15%">&nbsp;</td>
	   </tr>
	   <tr>
		<td>&nbsp;</td>
		<td>
			<table class="innerTab"  cellspacing="0" cellpadding="0">
			   <tr>
				<th align="left"><img src="images/loginVtigerCRM.gif" width="169" height="49"></th>
				<th>&nbsp;</th>
				<th align="right">&nbsp;</th>
			   </tr>
			   <tr class="tableTop"><td colspan="3"></td></tr>
			   <tr>
				<td colspan="3" class="tableMidone">
				<table class="loginTab"  cellspacing="0" cellpadding="0" align="center">
					   <tr>
						<td width="6" height="5"><img src="images/loginSITopLeft.gif"></td>
						<td bgcolor="#FFFFFF"></td>
						<td width="6" height="5"><img src="images/loginSITopRight.gif"></td>
					   </tr>
					   <tr bgcolor="#FFFFFF">
						<td height="150">&nbsp;</td>
						<td valign="top">

						<table width="100%"  border="0" cellspacing="0" cellpadding="3">
						<form name="login" action="CustomerRegister.php" method="post">
							   <tr>
								<?php
								   //Display the login error message 
			if($_REQUEST['signup_error'] == 1)
									echo "<font color=red size=1px;> ".getTranslatedString('LBL_CANNOT_SIGNUP')."</font><br>"; 
			if($_REQUEST['signup_sucess'] == 1)
									echo "<font color=green size=1px;> ".getTranslatedString('LBL_SIGNUP_SUCESS').$_REQUEST['contactid']."</font><br>"; 
								?>
							   </tr>
							   <tr>
							  <tr>
						   <td colspan="2" class="detailedViewHeader"><b><?php echo getTranslatedString('customerportal');echo " ".$version; ?></b></td>
							   </tr>
							   <tr>
								<td class="dvtCellLabel"  align="right" width="50%">
								<?php echo getTranslatedString('LBL_EMAILID');?></td>
								<td class="dvtCellInfo"><input type="text" id="email" name="email" class="detailedViewTextBox">&nbsp;<font color="#FF0000">*</font></td>
							   </tr>
							   <tr>
								<td class="dvtCellLabel" align="right">
								
								<?php echo getTranslatedString('Last Name');?></td>
								<td class="dvtCellInfo"><input type="text" id="lastname" name="lastname" class="detailedViewTextBox">&nbsp;<font color="#FF0000">*</font></td>
							   </tr>
								<tr>
								<td class="dvtCellLabel" align="right">
								
								<?php echo getTranslatedString('Phone');?></td>
								<td class="dvtCellInfo"><input type="text" id="phone" name="phone" class="detailedViewTextBox">&nbsp;<font color="#FF0000">*</font></td>
							   </tr>

								<tr>
								<td class="dvtCellLabel"  align="right" width="50%">
								
								<?php echo getTranslatedString('Company');?></td>
								<td class="dvtCellInfo"><input type="text" id="company" name="company" class="detailedViewTextBox">&nbsp;<font color="#FF0000">*</font></td>
							   </tr>
								<tr>
								<td class="dvtCellLabel"  align="right" width="50%"><?php echo getTranslatedString('Description');?></td>
								<td class="dvtCellInfo"><textarea cols="30" rows="5" id="description" name="description"></textarea>
						
								</td>
							   </tr>
							      <tr>
								<td colspan="2" align="center"><input type="image" src="images/BtnSignup.gif" onclick="return validateLoginDetails();"></td>
							   </tr>
<tr><td colspan="2" align="right">
							   <a href="login.php"><?php echo getTranslatedString('LBL_LOGIN');?></a></td>
							    </tr>
							   <tr>
								<td class="dvtCellInfo" colspan="2"></td>
							   </tr>
							   <tr>
							   <td class="dvtCellInfo" colspan="2" ><font color="gray" size="1"><?php  echo getTranslatedString('LBL_SIGNUP_NOTE');?></font></td>
							   </tr>
							   </table>

<script>
function validateLoginDetails(){
	var email = document.getElementById('email');
	var lastname = document.getElementById('lastname');
	var phone = document.getElementById('phone');
	var company = document.getElementById('company');
	if(email.value == ''){
		alert('邮件不能为空');
		email.focus();
		return false;
	}else{
		var re=new RegExp(/^[a-zA-Z0-9]+([\_\-\.]*[a-zA-Z0-9]+[\_\-]?)*@[a-zA-Z0-9]+([\_\-]?[a-zA-Z0-9]+)*\.+([\-\_]?[a-zA-Z0-9])+(\.?[a-zA-Z0-9]+)*$/);
		if (!re.test(email.value)) {
			alert('邮件格式有误');
			email.value = '';
			email.focus();
			return false;
		}
	}
	if(lastname.value == ''){
		alert('姓名不能为空');
		lastname.focus();
		return false;
	}
	if(phone.value == ''){
		alert('电话不能为空');
		phone.focus();
		return false;
	}
	if(company.value == ''){
		alert('公司不能为空');
		company.focus();
		return false;
	}
}
</script>





						</td>
						<td>&nbsp;</td>
					   </tr>



						<tr>
						<td width="6" height="6"><img src="images/loginSIBottomLeft.gif"></td>
						<td bgcolor="#FFFFFF"></td>
						<td width="6" height="6"><img src="images/loginSIBottomRight.gif"></td>
					   </tr>
					</table>
					</form>
				</td>
			   </tr>
			  <tr>
			    <td colspan="3" class="tableBtm">&nbsp;</td>
		      </tr>
			</table>

		</td>
		<td>&nbsp;</td>
	   </tr>
	   <tr>
		<td>&nbsp;</td>
		<td align="left"><img src="images/loginBottomURL.gif" width="100" height="21"></td>
		<td>&nbsp;</td>
	   </tr>
	  </table>

</body>
</html>

<script language="javascript">
</script>

<?php
?>
