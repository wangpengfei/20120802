<?php /* Smarty version 2.6.18, created on 2012-06-04 13:48:13
         compiled from ComposeEmail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'ComposeEmail.tpl', 82, false),array('modifier', 'emails_checkFieldVisiblityPermission', 'ComposeEmail.tpl', 88, false),array('modifier', 'vtlib_purify', 'ComposeEmail.tpl', 136, false),)), $this); ?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['APP']['LBL_CHARSET']; ?>
">
<title><?php echo $this->_tpl_vars['MOD']['TITLE_COMPOSE_MAIL']; ?>
</title>
<link REL="SHORTCUT ICON" HREF="include/images/ubicrm_icon.ico">	
<style type="text/css">@import url("themes/<?php echo $this->_tpl_vars['THEME']; ?>
/style.css");</style>
<script language="javascript" type="text/javascript" src="include/scriptaculous/prototype.js"></script>
<script src="include/scriptaculous/scriptaculous.js" type="text/javascript"></script>
<script src="include/js/general.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript" src="include/js/<?php  echo $_SESSION['authenticated_user_language']; ?>.lang.js?<?php  echo $_SESSION['vtiger_version']; ?>"></script>
<script type="text/javascript" src="include/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="modules/Products/multifile.js"></script>
</head>
<body marginheight="0" marginwidth="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<?php echo '
<form name="EditView" method="POST" ENCTYPE="multipart/form-data" action="index.php" onSubmit="if(email_validate(this.form,\'\')) { VtigerJS_DialogBox.block();} else { return false; }">
'; ?>

<input type="hidden" name="send_mail" >
<input type="hidden" name="contact_id" value="<?php echo $this->_tpl_vars['CONTACT_ID']; ?>
">
<input type="hidden" name="user_id" value="<?php echo $this->_tpl_vars['USER_ID']; ?>
">
<input type="hidden" name="filename" value="<?php echo $this->_tpl_vars['FILENAME']; ?>
">
<input type="hidden" name="old_id" value="<?php echo $this->_tpl_vars['OLD_ID']; ?>
">
<input type="hidden" name="module" value="<?php echo $this->_tpl_vars['MODULE']; ?>
">
<input type="hidden" name="record" value="<?php echo $this->_tpl_vars['ID']; ?>
">
<input type="hidden" name="mode" value="<?php echo $this->_tpl_vars['MODE']; ?>
">
<input type="hidden" name="action">
<input type="hidden" name="popupaction" value="create">
<input type="hidden" name="hidden_toid" id="hidden_toid">
<table class="small mailClient" border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody>
   
   <tr>
	<td colspan=3 >
	<!-- Email Header -->
	<table border=0 cellspacing=0 cellpadding=0 width=100% class="mailClientWriteEmailHeader">
	<tr>
		<td ><?php echo $this->_tpl_vars['MOD']['LBL_COMPOSE_EMAIL']; ?>
</td>
	</tr>
	</table>
	
	
	</td>
</tr>
	<?php $_from = $this->_tpl_vars['BLOCKS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
	<?php $_from = $this->_tpl_vars['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['elements']):
?>
	<?php if ($this->_tpl_vars['elements']['2']['0'] == 'parent_id'): ?>
   <tr>
	<td class="mailSubHeader" align="right"><font color="red">*</font><b><?php echo $this->_tpl_vars['MOD']['LBL_TO']; ?>
</b></td>
	<td class="cellText" style="padding: 5px;">
 		<input name="<?php echo $this->_tpl_vars['elements']['2']['0']; ?>
" id="<?php echo $this->_tpl_vars['elements']['2']['0']; ?>
" type="hidden" value="<?php echo $this->_tpl_vars['IDLISTS']; ?>
">
		<input type="hidden" name="saved_toid" id="saved_toid" value="<?php echo $this->_tpl_vars['TO_MAIL']; ?>
">
		<input id="parent_name" name="parent_name" readonly class="txtBox" type="text" value="<?php echo $this->_tpl_vars['TO_MAIL']; ?>
" style="width: 550px;">&nbsp;
	</td>
	<td class="cellText" style="padding: 5px;" align="left" nowrap>
		<select name="parent_type">
			<?php $_from = $this->_tpl_vars['elements']['1']['0']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['labelval'] => $this->_tpl_vars['selectval']):
?>
				<?php if ($this->_tpl_vars['selectval'] == selected): ?>
					<?php $this->assign('selectmodule', 'selected'); ?>
				<?php else: ?>
					<?php $this->assign('selectmodule', ""); ?>
				<?php endif; ?>
				<option value="<?php echo $this->_tpl_vars['labelval']; ?>
" <?php echo $this->_tpl_vars['selectmodule']; ?>
><?php echo $this->_tpl_vars['APP'][$this->_tpl_vars['labelval']]; ?>
</option>
			<?php endforeach; endif; unset($_from); ?>
		</select>
		&nbsp;
		<span  class="mailClientCSSButton">
		<img src="<?php echo vtiger_imageurl('select.gif', $this->_tpl_vars['THEME']); ?>
" alt="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_SELECT']; ?>
" LANGUAGE=javascript onclick='return window.open("index.php?module="+ document.EditView.parent_type.value +"&action=Popup&html=Popup_picker&form=HelpDeskEditView&popuptype=set_return_emails","test","width=640,height=602,resizable=0,scrollbars=0,top=150,left=200");' align="absmiddle" style='cursor:hand;cursor:pointer'>&nbsp;
		</span><span class="mailClientCSSButton" ><img src="<?php echo vtiger_imageurl('clear_field.gif', $this->_tpl_vars['THEME']); ?>
" alt="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_CLEAR']; ?>
" LANGUAGE=javascript onClick="$('parent_id').value='';$('saved_toid').value=''; $('hidden_toid').value='';$('parent_name').value=''; return false;" align="absmiddle" style='cursor:hand;cursor:pointer'>
		</span>
	</td>
   </tr>
	<tr>
	<?php if (emails_checkFieldVisiblityPermission('ccmail') == '0'): ?>   
   	<td class="mailSubHeader" style="padding: 5px;" align="right"><?php echo $this->_tpl_vars['MOD']['LBL_CC']; ?>
</td>
	<td class="cellText" style="padding: 5px;">
		<input name="ccmail" id ="cc_name" class="txtBox" type="text" value="<?php echo $this->_tpl_vars['CC_MAIL']; ?>
" style="width:99%">&nbsp;
	</td>
	<?php else: ?>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	<?php endif; ?>
   <td valign="top" class="cellLabel" rowspan="4"><div id="attach_cont" class="addEventInnerBox" style="overflow:auto;height:100px;width:100%;position:relative;left:0px;top:0px;"></div>
   	</tr>
   <?php if (emails_checkFieldVisiblityPermission('bccmail') == '0'): ?>   
   	<tr>
	<td class="mailSubHeader" style="padding: 5px;" align="right"><?php echo $this->_tpl_vars['MOD']['LBL_BCC']; ?>
</td>
	<td class="cellText" style="padding: 5px;">
		<input name="bccmail" id="bcc_name" class="txtBox" type="text" value="<?php echo $this->_tpl_vars['BCC_MAIL']; ?>
" style="width:99%">&nbsp;
	</td>
   	</tr>
   	<?php endif; ?>
	<?php elseif ($this->_tpl_vars['elements']['2']['0'] == 'subject'): ?>
   <tr>
	<td class="mailSubHeader" style="padding: 5px;" align="right" nowrap><font color="red">*</font><?php echo $this->_tpl_vars['elements']['1']['0']; ?>
  :</td>
        <?php if ($this->_tpl_vars['WEBMAIL'] == 'true' || $this->_tpl_vars['RET_ERROR'] == 1): ?>
                <td class="cellText" style="padding: 5px;"><input type="text" class="txtBox" name="<?php echo $this->_tpl_vars['elements']['2']['0']; ?>
" value="<?php echo $this->_tpl_vars['SUBJECT']; ?>
" id="<?php echo $this->_tpl_vars['elements']['2']['0']; ?>
" style="width:99%"></td>
        <?php else: ?>
                <td class="cellText" style="padding: 5px;"><input type="text" class="txtBox" name="<?php echo $this->_tpl_vars['elements']['2']['0']; ?>
" value="<?php echo $this->_tpl_vars['elements']['3']['0']; ?>
" id="<?php echo $this->_tpl_vars['elements']['2']['0']; ?>
" style="width:99%"></td>
        <?php endif; ?>
   </tr>
	<?php elseif ($this->_tpl_vars['elements']['2']['0'] == 'filename'): ?>

   <tr>
	<td class="mailSubHeader" style="padding: 5px;" align="right" nowrap><?php echo $this->_tpl_vars['elements']['1']['0']; ?>
  :</td>
	<td class="cellText" style="padding: 5px;">
		<!--<input name="<?php echo $this->_tpl_vars['elements']['2']['0']; ?>
"  type="file" class="small txtBox" value="" size="78"/>-->
		<input name="del_file_list" type="hidden" value="">
					<div id="files_list" style="border: 1px solid grey; width: 500px; padding: 5px; background: rgb(255, 255, 255) none repeat scroll 0%; -moz-background-clip: initial; -moz-background-origin: initial; -moz-background-inline-policy: initial; font-size: x-small"><?php echo $this->_tpl_vars['APP']['Files_Maximum_6']; ?>

						<input id="my_file_element" type="file" name="<?php echo $this->_tpl_vars['elements']['2']['0']; ?>
" tabindex="7" onchange="validateFilename(this);">
						<input type="hidden" name="<?php echo $this->_tpl_vars['elements']['2']['0']; ?>
_hidden" value="" />
																	</div>
					<script>
						var multi_selector = new MultiSelector( document.getElementById( 'files_list' ), 6 );
						multi_selector.count = 0
						multi_selector.addElement( document.getElementById( 'my_file_element' ) );
					</script>
		<div id="attach_temp_cont" style="display:none;">
		<table class="small" width="100% ">
		
	<?php if ($_REQUEST['attachment'] != ''): ?>
                <tr><td width="100%" colspan="2"><?php echo vtlib_purify($_REQUEST['attachment']); ?>
<input type="hidden" value="<?php echo vtlib_purify($_REQUEST['attachment']); ?>
" name="pdf_attachment"></td></tr>
    
        <?php elseif ($this->_tpl_vars['COMMON_TEMPLATE_NAME'] != ''): ?>
        <tr>
          <td width="100%" colspan="2"><?php echo $this->_tpl_vars['COMMON_TEMPLATE_NAME']; ?>
.pdf 
            <input type="hidden" value="<?php echo $this->_tpl_vars['COMMON_TEMPLATE_ID']; ?>
" name="commontemplateid"/>
            <input type="hidden" value="<?php echo $_REQUEST['pmodule']; ?>
" name="relmodule"/>
            <input type="hidden" value="<?php echo $_REQUEST['pid']; ?>
" name="pid"/>
            <input type="hidden" value="<?php echo $_REQUEST['language']; ?>
" name="language"/>
          </td>
        </tr>
        
    <?php else: ?>   

		<?php $_from = $this->_tpl_vars['elements']['3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attach_id'] => $this->_tpl_vars['attach_files']):
?>	
			<tr id="row_<?php echo $this->_tpl_vars['attach_id']; ?>
"><td width="90%"><?php echo $this->_tpl_vars['attach_files']; ?>
</td><td><img src="<?php echo vtiger_imageurl('no.gif', $this->_tpl_vars['THEME']); ?>
" onClick="delAttachments(<?php echo $this->_tpl_vars['attach_id']; ?>
)" alt="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON']; ?>
" title="<?php echo $this->_tpl_vars['APP']['LBL_DELETE_BUTTON']; ?>
" style="cursor:pointer;"></td></tr>	
		<?php endforeach; endif; unset($_from); ?>
		<input type='hidden' name='att_id_list' value='<?php echo $this->_tpl_vars['ATT_ID_LIST']; ?>
' />
	<?php endif; ?>

		<?php if ($this->_tpl_vars['WEBMAIL'] == 'true'): ?>
		<?php $_from = $this->_tpl_vars['webmail_attachments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attach_files']):
?>
                <tr ><td width="90%"><?php echo $this->_tpl_vars['attach_files']; ?>
</td></tr>
        <?php endforeach; endif; unset($_from); ?>	
		<?php endif; ?>
		</table>	
		</div>	
		<?php echo $this->_tpl_vars['elements']['3']['0']; ?>

	</td>
   </tr>
   <tr>
	<td colspan="3" class="mailSubHeader" style="padding: 5px;" align="center">
		 <input title="<?php echo $this->_tpl_vars['APP']['LBL_SELECTEMAILTEMPLATE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SELECTEMAILTEMPLATE_BUTTON_KEY']; ?>
" class="crmbutton small edit" onclick="window.open('index.php?module=Users&action=lookupemailtemplates','emailtemplate','top=100,left=200,height=400,width=500,resizable=yes,scrollbars=yes,menubar=no,addressbar=no,status=yes')" type="button" name="button" value=" <?php echo $this->_tpl_vars['APP']['LBL_SELECTEMAILTEMPLATE_BUTTON_LABEL']; ?>
  ">
		<input title="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_KEY']; ?>
" class="crmbutton small save" onclick="return email_validate(this.form,'save');" type="button" name="button" value="  <?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
 " >&nbsp;
		<input name="<?php echo $this->_tpl_vars['MOD']['LBL_SEND']; ?>
" value=" <?php echo $this->_tpl_vars['APP']['LBL_SEND']; ?>
 " class="crmbutton small save" type="button" onclick="return email_validate(this.form,'send');">&nbsp;
		<input name="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" value=" <?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
 " class="crmbutton small cancel" type="button" onClick="window.close()">
	</td>
    </tr>
	<?php elseif ($this->_tpl_vars['elements']['2']['0'] == 'description'): ?>
   <tr>
	<td colspan="3" align="center" valign="top" height="320">
        <?php if ($this->_tpl_vars['WEBMAIL'] == 'true' || $this->_tpl_vars['RET_ERROR'] == 1): ?>
		<input type="hidden" name="from_add" value="<?php echo $this->_tpl_vars['from_add']; ?>
">
		<input type="hidden" name="att_module" value="Webmails">
		<input type="hidden" name="mailid" value="<?php echo $this->_tpl_vars['mailid']; ?>
">
		<input type="hidden" name="mailbox" value="<?php echo $this->_tpl_vars['mailbox']; ?>
">
                <textarea style="display: none;" class="detailedViewTextBox" id="description" name="description" cols="90" rows="8"><?php echo $this->_tpl_vars['DESCRIPTION']; ?>
</textarea>
        <?php else: ?>
                <textarea style="display: none;" class="detailedViewTextBox" id="description" name="description" cols="90" rows="16"><?php echo $this->_tpl_vars['elements']['3']['0']; ?>
</textarea>        <?php endif; ?>
	</td>
   </tr>
	<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	<?php endforeach; endif; unset($_from); ?>

   <tr>
	<td colspan="3" class="mailSubHeader" style="padding: 5px;" align="center">
		 <input title="<?php echo $this->_tpl_vars['APP']['LBL_SELECTEMAILTEMPLATE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SELECTEMAILTEMPLATE_BUTTON_KEY']; ?>
" class="crmbutton small edit" onclick="window.open('index.php?module=Users&action=lookupemailtemplates','emailtemplate','top=100,left=200,height=400,width=500,menubar=no,addressbar=no,status=yes')" type="button" name="button" value=" <?php echo $this->_tpl_vars['APP']['LBL_SELECTEMAILTEMPLATE_BUTTON_LABEL']; ?>
  ">
		<input title="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_KEY']; ?>
" class="crmbutton small save" onclick="return email_validate(this.form,'save');" type="button" name="button" value="  <?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
 " >&nbsp;
		<input name="<?php echo $this->_tpl_vars['MOD']['LBL_SEND']; ?>
" value=" <?php echo $this->_tpl_vars['APP']['LBL_SEND']; ?>
 " class="crmbutton small save" type="button" onclick="return email_validate(this.form,'send');">&nbsp;
		<input name="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_TITLE']; ?>
" accessKey="<?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_KEY']; ?>
" value=" <?php echo $this->_tpl_vars['APP']['LBL_CANCEL_BUTTON_LABEL']; ?>
 " class="crmbutton small cancel" type="button" onClick="window.close()">
	</td>
   </tr>
</tbody>
</table>
</form>
</body>
<script>
var cc_err_msg = '<?php echo $this->_tpl_vars['MOD']['LBL_CC_EMAIL_ERROR']; ?>
';
var no_rcpts_err_msg = '<?php echo $this->_tpl_vars['MOD']['LBL_NO_RCPTS_EMAIL_ERROR']; ?>
';
var bcc_err_msg = '<?php echo $this->_tpl_vars['MOD']['LBL_BCC_EMAIL_ERROR']; ?>
';
var conf_mail_srvr_err_msg = '<?php echo $this->_tpl_vars['MOD']['LBL_CONF_MAILSERVER_ERROR']; ?>
';

var no_email_title_msg = '<?php echo $this->_tpl_vars['MOD']['No_Email_Title_Msg']; ?>
';
var no_email_title = '<?php echo $this->_tpl_vars['MOD']['No_Email_Title']; ?>
';

<?php echo '
function email_validate(oform,mode)
{
	if(trim(mode) == \'\')
	{
		return false;
	}
	if(oform.parent_name.value.replace(/^\\s+/g, \'\').replace(/\\s+$/g, \'\').length==0)
	{
		//alert(\'No recipients were specified\');
		alert(no_rcpts_err_msg);
		return false;
	}
	//Changes made to fix tickets #4633, # 5111 to accomodate all possible email formats
	var email_regex = /^[a-zA-Z0-9]+([\\_\\-\\.]*[a-zA-Z0-9]+[\\_\\-]?)*@[a-zA-Z0-9]+([\\_\\-]?[a-zA-Z0-9]+)*\\.+([\\_\\-]?[a-zA-Z0-9])+(\\.?[a-zA-Z0-9]+)*$/;
	
	if(document.EditView.ccmail != null){
		if(document.EditView.ccmail.value.length >= 1){
			var str = document.EditView.ccmail.value;
            arr = new Array();
            arr = str.split(",");
            var tmp;
	    	for(var i=0; i<=arr.length-1; i++){
	            tmp = arr[i];
	            if(tmp.match(\'<\') && tmp.match(\'>\')) {
                    if(!findAngleBracket(arr[i])) {
                        alert(cc_err_msg+": "+arr[i]);
                        return false;
                    }
            	}
				else if(trim(arr[i]) != "" && !(email_regex.test(trim(arr[i]))))
	            {
	                    alert(cc_err_msg+": "+arr[i]);
	                    return false;
	            }
			}
		}
	}	
	if(document.EditView.bccmail != null){
		if(document.EditView.bccmail.value.length >= 1){
			var str = document.EditView.bccmail.value;
			arr = new Array();
			arr = str.split(",");
			var tmp;
			for(var i=0; i<=arr.length-1; i++){
				tmp = arr[i];
				if(tmp.match(\'<\') && tmp.match(\'>\')) {
                    if(!findAngleBracket(arr[i])) {
                        alert(bcc_err_msg+": "+arr[i]);
                        return false;
                    }
            	} 
            	else if(trim(arr[i]) != "" && !(email_regex.test(trim(arr[i])))){
					alert(bcc_err_msg+": "+arr[i]);
					return false;	
				}
			}	
		}
	}	
	if(oform.subject.value.replace(/^\\s+/g, \'\').replace(/\\s+$/g, \'\').length==0)
	{
		if(email_sub = prompt(no_email_title_msg, no_email_title))
		{
			oform.subject.value = email_sub;
		}else
		{
			return false;
		}
	}
	if(mode == \'send\')
	{
		server_check()	
	}else if(mode == \'save\')
	{
		oform.action.value=\'Save\';
		oform.submit();
	}else
	{
		return false;
	}
}
//function to extract the mailaddress inside < > symbols.......for the bug fix #3752
function findAngleBracket(mailadd)
{
        var strlen = mailadd.length;
        var success = 0;
        var gt = 0;
        var lt = 0;
        var ret = \'\';
        for(i=0;i<strlen;i++){
                if(mailadd.charAt(i) == \'<\' && gt == 0){
                        lt = 1;
                }
                if(mailadd.charAt(i) == \'>\' && lt == 1){
                        gt = 1;
                }
                if(mailadd.charAt(i) != \'<\' && lt == 1 && gt == 0)
                        ret = ret + mailadd.charAt(i);

        }
        if(/^[a-z0-9]([a-z0-9_\\-\\.]*)@([a-z0-9_\\-\\.]*)(\\.[a-z]{2,3}(\\.[a-z]{2}){0,2})$/.test(ret)){
                return true;
        }
        else
                return false;

}
function server_check()
{
	var oform = window.document.EditView;
        new Ajax.Request(
        	\'index.php\',
                {queue: {position: \'end\', scope: \'command\'},
                	method: \'post\',
                        postBody:"module=Emails&action=EmailsAjax&file=Save&ajax=true&server_check=true",
			onComplete: function(response) {
			if(response.responseText.indexOf(\'SUCCESS\') > -1)
			{
				oform.send_mail.value=\'true\';
				oform.action.value=\'Save\';
				oform.submit();
			}else
			{
				//alert(\'Please Configure Your Mail Server\');
				alert(conf_mail_srvr_err_msg);
				return false;
			}
               	    }
                }
        );
}
$(\'attach_cont\').innerHTML = $(\'attach_temp_cont\').innerHTML;
function delAttachments(id)
{
    new Ajax.Request(
        \'index.php\',
        {queue: {position: \'end\', scope: \'command\'},
            method: \'post\',
            postBody: \'module=Contacts&action=ContactsAjax&file=DelImage&attachmodule=Emails&recordid=\'+id,
            onComplete: function(response)
            {
		Effect.Fade(\'row_\'+id);	                
            }
        }
    );

}
'; ?>

</script>
<script type="text/javascript" defer="1">
	var textAreaName = 'description';
	CKEDITOR.replace( textAreaName,	{
		extraPlugins : 'uicolor',
		uiColor: '#dfdff1'
	} ) ;
	var oCKeditor = CKEDITOR.instances[textAreaName];
</script>
</html>