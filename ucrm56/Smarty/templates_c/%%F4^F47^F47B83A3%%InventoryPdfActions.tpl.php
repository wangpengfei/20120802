<?php /* Smarty version 2.6.18, created on 2012-06-04 09:57:32
         compiled from modules/PDFMaker/InventoryPdfActions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'sizeof', 'modules/PDFMaker/InventoryPdfActions.tpl', 20, false),array('modifier', 'vtiger_imageurl', 'modules/PDFMaker/InventoryPdfActions.tpl', 35, false),array('modifier', 'getTranslatedString', 'modules/PDFMaker/InventoryPdfActions.tpl', 36, false),array('function', 'html_options', 'modules/PDFMaker/InventoryPdfActions.tpl', 24, false),)), $this); ?>
<table border=0 cellspacing=0 cellpadding=0 style="width:100%;" class="rightMailMerge">
  <tr>
		<td class="rightMailMergeHeader" style="width:100%;"><b><?php echo $this->_tpl_vars['PDFMAKER_MOD']['SELECT_TEMPLATE']; ?>
</b></td>
	</tr>
  <?php if ($this->_tpl_vars['CRM_TEMPLATES_EXIST'] == '0'): ?>
        <tr>
  		<td class="rightMailMergeContent"  style="width:100%;">
  			<select name="use_common_template" id="use_common_template" class="detailedViewTextBox" multiple style="width:90%;" size="5">
          <?php $_from = ($this->_tpl_vars['CRM_TEMPLATES']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tplForeach'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tplForeach']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['templates_prefix'] => $this->_tpl_vars['templates_label']):
        $this->_foreach['tplForeach']['iteration']++;
?>
            <?php if (($this->_foreach['tplForeach']['iteration'] <= 1)): ?>
                <option value="<?php echo $this->_tpl_vars['templates_prefix']; ?>
" selected="selected"><?php echo $this->_tpl_vars['templates_label']; ?>
</option>
            <?php else: ?>
                <option value="<?php echo $this->_tpl_vars['templates_prefix']; ?>
"><?php echo $this->_tpl_vars['templates_label']; ?>
</option>
            <?php endif; ?>
          <?php endforeach; endif; unset($_from); ?>
        </select>        
  		</td>
		</tr>
		
		<?php if (sizeof($this->_tpl_vars['TEMPLATE_LANGUAGES']) > 1): ?>
        <tr>
    		<td class="rightMailMergeContent"  style="width:100%;">    	
            <select name="template_language" id="template_language" class="detailedViewTextBox" style="width:90%;" size="1">
    		  <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['TEMPLATE_LANGUAGES'],'selected' => $this->_tpl_vars['CURRENT_LANGUAGE']), $this);?>

            </select>
    		</td>
		</tr>
		<?php else: ?>
		  <?php $_from = ($this->_tpl_vars['TEMPLATE_LANGUAGES']); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['lang_key'] => $this->_tpl_vars['lang']):
?>
            <input type="hidden" name="template_language" id="template_language" value="<?php echo $this->_tpl_vars['lang_key']; ?>
"/>
          <?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
		<tr>
  		<td class="rightMailMergeContent"  style="width:100%;">   		    
            <a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('<?php echo $this->_tpl_vars['PDFMAKER_MOD']['SELECT_TEMPLATE']; ?>
'); else document.location.href='index.php?module=PDFMaker&relmodule=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=PrintFromTemplate&record=<?php echo $this->_tpl_vars['ID']; ?>
&commontemplateid='+getSelectedTemplates()+'&language='+document.getElementById('template_language').value;" class="webMnu"><img src="<?php echo vtiger_imageurl('print.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle" border="0"/></a>
            <a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('<?php echo $this->_tpl_vars['PDFMAKER_MOD']['SELECT_TEMPLATE']; ?>
'); else window.open('index.php?module=PDFMaker&relmodule=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=PrintFromTemplate&record=<?php echo $this->_tpl_vars['ID']; ?>
&commontemplateid='+getSelectedTemplates()+'&language='+document.getElementById('template_language').value)" class="webMnu"><?php echo ((is_array($_tmp='LBL_PRINT_EMAIL')) ? $this->_run_mod_handler('getTranslatedString', true, $_tmp, 'Emails') : getTranslatedString($_tmp, 'Emails')); ?>
</a>
        </td>
		</tr>
		<tr>
  		<td class="rightMailMergeContent"  style="width:100%;">   		    
            <a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('<?php echo $this->_tpl_vars['PDFMAKER_MOD']['SELECT_TEMPLATE']; ?>
'); else document.location.href='index.php?module=PDFMaker&relmodule=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=CreatePDFFromTemplate&record=<?php echo $this->_tpl_vars['ID']; ?>
&commontemplateid='+getSelectedTemplates()+'&language='+document.getElementById('template_language').value;" class="webMnu"><img src="<?php echo vtiger_imageurl('actionGeneratePDF.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle" border="0"/></a>
            <a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('<?php echo $this->_tpl_vars['PDFMAKER_MOD']['SELECT_TEMPLATE']; ?>
'); else document.location.href='index.php?module=PDFMaker&relmodule=<?php echo $this->_tpl_vars['MODULE']; ?>
&action=CreatePDFFromTemplate&record=<?php echo $this->_tpl_vars['ID']; ?>
&commontemplateid='+getSelectedTemplates()+'&language='+document.getElementById('template_language').value;" class="webMnu"><?php echo $this->_tpl_vars['APP']['LBL_EXPORT_TO_PDF']; ?>
</a>
        </td>
		</tr>
		<tr>
  		<td class="rightMailMergeContent"  style="width:100%;">  			
        
            <?php if ($this->_tpl_vars['MODULE'] == 'Leads' || $this->_tpl_vars['MODULE'] == 'Contacts' || $this->_tpl_vars['MODULE'] == 'Accounts'): ?>
    			<a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('<?php echo $this->_tpl_vars['PDFMAKER_MOD']['SELECT_TEMPLATE']; ?>
'); else {if(LTrim('<?php echo $this->_tpl_vars['EMAIL1']; ?>
') !='' || LTrim('<?php echo $this->_tpl_vars['EMAIL2']; ?>
') !=''){fnvshobj(this,'sendpdfmail_cont');sendPDFmail('<?php echo $this->_tpl_vars['MODULE']; ?>
','<?php echo $this->_tpl_vars['ID']; ?>
');}else{openPopUp('xComposeEmail',this,'index.php?module=Emails&action=EmailsAjax&file=EditView&pmodule=<?php echo $this->_tpl_vars['MODULE']; ?>
&pid=<?php echo $this->_tpl_vars['ID']; ?>
&commontemplateid='+getSelectedTemplates()+'&language='+document.getElementById('template_language').value+'&sendmail=true','createemailWin',820,689,'menubar=no,toolbar=no,location=no,status=no,resizable=no')}}" class="webMnu"><img src="<?php echo vtiger_imageurl('PDFMail.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle" border="0"/></a>
    	        <a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('<?php echo $this->_tpl_vars['PDFMAKER_MOD']['SELECT_TEMPLATE']; ?>
'); else {if(LTrim('<?php echo $this->_tpl_vars['EMAIL1']; ?>
') !='' || LTrim('<?php echo $this->_tpl_vars['EMAIL2']; ?>
') !=''){fnvshobj(this,'sendpdfmail_cont');sendPDFmail('<?php echo $this->_tpl_vars['MODULE']; ?>
','<?php echo $this->_tpl_vars['ID']; ?>
');}else{openPopUp('xComposeEmail',this,'index.php?module=Emails&action=EmailsAjax&file=EditView&pmodule=<?php echo $this->_tpl_vars['MODULE']; ?>
&pid=<?php echo $this->_tpl_vars['ID']; ?>
&commontemplateid='+getSelectedTemplates()+'&language='+document.getElementById('template_language').value+'&sendmail=true','createemailWin',820,689,'menubar=no,toolbar=no,location=no,status=no,resizable=no')}}" class="webMnu"><?php echo $this->_tpl_vars['APP']['LBL_SEND_EMAIL_PDF']; ?>
</a>  
    		<?php else: ?>
            	<a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('<?php echo $this->_tpl_vars['PDFMAKER_MOD']['SELECT_TEMPLATE']; ?>
'); else {fnvshobj(this,'sendpdfmail_cont');sendPDFmail('<?php echo $this->_tpl_vars['MODULE']; ?>
','<?php echo $this->_tpl_vars['ID']; ?>
');}" class="webMnu"><img src="<?php echo vtiger_imageurl('PDFMail.gif', $this->_tpl_vars['THEME']); ?>
" hspace="5" align="absmiddle" border="0"/></a>
    	        <a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('<?php echo $this->_tpl_vars['PDFMAKER_MOD']['SELECT_TEMPLATE']; ?>
'); else {fnvshobj(this,'sendpdfmail_cont');sendPDFmail('<?php echo $this->_tpl_vars['MODULE']; ?>
','<?php echo $this->_tpl_vars['ID']; ?>
');}" class="webMnu"><?php echo $this->_tpl_vars['APP']['LBL_SEND_EMAIL_PDF']; ?>
</a>  
            <?php endif; ?>            
            <div id="sendpdfmail_cont" style="z-index:100001;position:absolute;"></div>
             		    
        </td>
		</tr>
        
        <tr>
            <td class="rightMailMergeContent"  style="width:100%;">
                <a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('<?php echo $this->_tpl_vars['PDFMAKER_MOD']['SELECT_TEMPLATE']; ?>
'); else getPDFDocDivContent(this,'<?php echo $this->_tpl_vars['MODULE']; ?>
','<?php echo $this->_tpl_vars['ID']; ?>
');" class="webMnu"><img src="modules/PDFMaker/img/PDFDoc.png" hspace="5" align="absmiddle" border="0"/></a>
                <a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('<?php echo $this->_tpl_vars['PDFMAKER_MOD']['SELECT_TEMPLATE']; ?>
'); else getPDFDocDivContent(this,'<?php echo $this->_tpl_vars['MODULE']; ?>
','<?php echo $this->_tpl_vars['ID']; ?>
');" class="webMnu"><?php echo $this->_tpl_vars['PDFMAKER_MOD']['LBL_SAVEASDOC']; ?>
</a>
                
                <div id="PDFDocDiv" style="display:none; width:350px; position:absolute;" class="layerPopup"></div>
                
            </td>
        </tr>		
  <?php else: ?>
    <tr>
  		<td class="rightMailMergeContent">
  		  <?php echo $this->_tpl_vars['PDFMAKER_MOD']['CRM_TEMPLATES_DONT_EXIST']; ?>

    		<?php if ($this->_tpl_vars['IS_ADMIN'] == '1'): ?> 
    		  <?php echo $this->_tpl_vars['PDFMAKER_MOD']['CRM_TEMPLATES_ADMIN']; ?>
          
          <a href="index.php?module=PDFMaker&action=EditPDFTemplate&return_module=<?php echo $this->_tpl_vars['MODULE']; ?>
&return_id=<?php echo $this->_tpl_vars['ID']; ?>
&parenttab=Tools" class="webMnu"><?php echo $this->_tpl_vars['PDFMAKER_MOD']['TEMPLATE_CREATE_HERE']; ?>
</a>
        <?php endif; ?>
      </td>
		</tr>
  <?php endif; ?>
  
</table>
<br/>

<script>
<?php echo '
function getSelectedTemplates()
{
    var selectedColumnsObj=getObj("use_common_template");
    var selectedColStr = "";
    for (i=0;i<selectedColumnsObj.options.length;i++)
    {
    	 if(selectedColumnsObj.options[i].selected)
    	 {
             selectedColStr += selectedColumnsObj.options[i].value + ";";
         }
    }
    
    return selectedColStr;
}

function getPDFDocDivContent(rootElm,module,id)
{
    $("vtbusy_info").style.display="inline";
    new Ajax.Request(
            \'index.php\',
            {queue: {position: \'end\', scope: \'command\'},
                    method: \'post\',
                    postBody: "module=PDFMaker&return_module="+module+"&action=PDFMakerAjax&file=docSelect&return_id="+id,
                    onComplete: function(response) 
                    {
                      getObj(\'PDFDocDiv\').innerHTML=response.responseText;
                      fnvshobj(rootElm,\'PDFDocDiv\');
                      
                      var PDFDoc = document.getElementById(\'PDFDocDiv\');
                      var PDFDocHandle = document.getElementById(\'PDFDocDivHandle\');
                      Drag.init(PDFDocHandle,PDFDoc);
                      $("vtbusy_info").style.display="none";                         						  
                    }
            }
    );
}

function sendPDFmail(module,idstrings)
{
    $("vtbusy_info").style.display="inline";
    new Ajax.Request(
            \'index.php\',
            {queue: {position: \'end\', scope: \'command\'},
                    method: \'post\',
                    postBody: "module=PDFMaker&return_module="+module+"&action=PDFMakerAjax&file=mailSelect&idlist="+idstrings,
                    onComplete: function(response) 
                    {
                        if(response.responseText == "Mail Ids not permitted" || response.responseText == "No Mail Ids")
    					{
                            openPopUp(\'xComposeEmail\',this,\'index.php?module=Emails&action=EmailsAjax&file=EditView&pmodule=\'+module+\'&pid=\'+idstrings+\'&commontemplateid=\'+getSelectedTemplates()+\'&language=\'+document.getElementById(\'template_language\').value+\'&sendmail=true\',\'createemailWin\',820,689,\'menubar=no,toolbar=no,location=no,status=no,resizable=no\'); 
    					}	
    					else{
                            getObj(\'sendpdfmail_cont\').innerHTML=response.responseText;
                            var PDFMail = document.getElementById(\'sendpdfmail_cont\');
                            var PDFMailHandle = document.getElementById(\'sendpdfmail_cont_handle\');
                            Drag.init(PDFMailHandle,PDFMail);
                        }
                        $("vtbusy_info").style.display="none"; 						  
                    }
            }
    );
}

function validate_sendPDFmail(idlist,module)
{
	var j=0;
	var chk_emails = document.SendPDFMail.elements.length;
	var oFsendmail = document.SendPDFMail.elements
	email_type = new Array();
	for(var i=0 ;i < chk_emails ;i++)
	{
		if(oFsendmail[i].type != \'button\')
		{
			if(oFsendmail[i].checked != false)
			{
				email_type [j++]= oFsendmail[i].value;
			}
		}
	}
	if(email_type != \'\')
	{
		var field_lists = email_type.join(\':\');
		
		openPopUp(\'xComposeEmail\',this,\'index.php?module=Emails&action=EmailsAjax&file=EditView&pmodule=\'+module+\'&pid='; ?>
<?php echo $this->_tpl_vars['ID']; ?>
<?php echo '&commontemplateid=\'+getSelectedTemplates()+\'&language=\'+document.getElementById(\'template_language\').value+\'&sendmail=true&idlist=\'+idlist+\'&field_lists=\'+field_lists,\'createemailWin\',820,689,\'menubar=no,toolbar=no,location=no,status=no,resizable=no\'); 
        
        fninvsh(\'roleLay\');
		return true;
	}
	else
	{
		alert(alert_arr.SELECT_MAILID);
	}
}

function validatePDFDocForm()
{
    if(document.PDFDocForm.notes_title.value==\'\')
    {
        '; ?>

        alert('<?php echo $this->_tpl_vars['PDFMAKER_MOD']['ALERT_DOC_TITLE']; ?>
');
        <?php echo '
        return false;
    }
    else{
        document.PDFDocForm.template_ids.value=getSelectedTemplates();
        document.PDFDocForm.language.value=document.getElementById(\'template_language\').value;
        return true;
    }
    
}

'; ?>

</script>
