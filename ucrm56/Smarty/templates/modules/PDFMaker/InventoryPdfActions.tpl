<table border=0 cellspacing=0 cellpadding=0 style="width:100%;" class="rightMailMerge">
  <tr>
		<td class="rightMailMergeHeader" style="width:100%;"><b>{$PDFMAKER_MOD.SELECT_TEMPLATE}</b></td>
	</tr>
  {if $CRM_TEMPLATES_EXIST eq '0'}
        <tr>
  		<td class="rightMailMergeContent"  style="width:100%;">
  			<select name="use_common_template" id="use_common_template" class="detailedViewTextBox" multiple style="width:90%;" size="5">
          {foreach name="tplForeach" from="$CRM_TEMPLATES" item="templates_label" key="templates_prefix"}
            {if $smarty.foreach.tplForeach.first}
                <option value="{$templates_prefix}" selected="selected">{$templates_label}</option>
            {else}
                <option value="{$templates_prefix}">{$templates_label}</option>
            {/if}
          {/foreach}
        </select>        
  		</td>
		</tr>
		
		{if $TEMPLATE_LANGUAGES|@sizeof > 1}
        <tr>
    		<td class="rightMailMergeContent"  style="width:100%;">    	
            <select name="template_language" id="template_language" class="detailedViewTextBox" style="width:90%;" size="1">
    		  {html_options  options=$TEMPLATE_LANGUAGES selected=$CURRENT_LANGUAGE}
            </select>
    		</td>
		</tr>
		{else}
		  {foreach from="$TEMPLATE_LANGUAGES" item="lang" key="lang_key"}
            <input type="hidden" name="template_language" id="template_language" value="{$lang_key}"/>
          {/foreach}
		{/if}
		<tr>
  		<td class="rightMailMergeContent"  style="width:100%;">   		    
            <a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('{$PDFMAKER_MOD.SELECT_TEMPLATE}'); else document.location.href='index.php?module=PDFMaker&relmodule={$MODULE}&action=PrintFromTemplate&record={$ID}&commontemplateid='+getSelectedTemplates()+'&language='+document.getElementById('template_language').value;" class="webMnu"><img src="{'print.gif'|@vtiger_imageurl:$THEME}" hspace="5" align="absmiddle" border="0"/></a>
            <a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('{$PDFMAKER_MOD.SELECT_TEMPLATE}'); else window.open('index.php?module=PDFMaker&relmodule={$MODULE}&action=PrintFromTemplate&record={$ID}&commontemplateid='+getSelectedTemplates()+'&language='+document.getElementById('template_language').value)" class="webMnu">{'LBL_PRINT_EMAIL'|getTranslatedString:'Emails'}</a>
        </td>
		</tr>
		<tr>
  		<td class="rightMailMergeContent"  style="width:100%;">   		    
            <a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('{$PDFMAKER_MOD.SELECT_TEMPLATE}'); else document.location.href='index.php?module=PDFMaker&relmodule={$MODULE}&action=CreatePDFFromTemplate&record={$ID}&commontemplateid='+getSelectedTemplates()+'&language='+document.getElementById('template_language').value;" class="webMnu"><img src="{'actionGeneratePDF.gif'|@vtiger_imageurl:$THEME}" hspace="5" align="absmiddle" border="0"/></a>
            <a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('{$PDFMAKER_MOD.SELECT_TEMPLATE}'); else document.location.href='index.php?module=PDFMaker&relmodule={$MODULE}&action=CreatePDFFromTemplate&record={$ID}&commontemplateid='+getSelectedTemplates()+'&language='+document.getElementById('template_language').value;" class="webMnu">{$APP.LBL_EXPORT_TO_PDF}</a>
        </td>
		</tr>
		<tr>
  		<td class="rightMailMergeContent"  style="width:100%;">  			
        
            {if $MODULE eq 'Leads' || $MODULE eq 'Contacts' || $MODULE eq 'Accounts'}
    			<a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('{$PDFMAKER_MOD.SELECT_TEMPLATE}'); else {ldelim}if(LTrim('{$EMAIL1}') !='' || LTrim('{$EMAIL2}') !=''){ldelim}fnvshobj(this,'sendpdfmail_cont');sendPDFmail('{$MODULE}','{$ID}');{rdelim}else{ldelim}openPopUp('xComposeEmail',this,'index.php?module=Emails&action=EmailsAjax&file=EditView&pmodule={$MODULE}&pid={$ID}&commontemplateid='+getSelectedTemplates()+'&language='+document.getElementById('template_language').value+'&sendmail=true','createemailWin',820,689,'menubar=no,toolbar=no,location=no,status=no,resizable=no'){rdelim}{rdelim}" class="webMnu"><img src="{'PDFMail.gif'|@vtiger_imageurl:$THEME}" hspace="5" align="absmiddle" border="0"/></a>
    	        <a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('{$PDFMAKER_MOD.SELECT_TEMPLATE}'); else {ldelim}if(LTrim('{$EMAIL1}') !='' || LTrim('{$EMAIL2}') !=''){ldelim}fnvshobj(this,'sendpdfmail_cont');sendPDFmail('{$MODULE}','{$ID}');{rdelim}else{ldelim}openPopUp('xComposeEmail',this,'index.php?module=Emails&action=EmailsAjax&file=EditView&pmodule={$MODULE}&pid={$ID}&commontemplateid='+getSelectedTemplates()+'&language='+document.getElementById('template_language').value+'&sendmail=true','createemailWin',820,689,'menubar=no,toolbar=no,location=no,status=no,resizable=no'){rdelim}{rdelim}" class="webMnu">{$APP.LBL_SEND_EMAIL_PDF}</a>  
    		{else}
            	<a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('{$PDFMAKER_MOD.SELECT_TEMPLATE}'); else {ldelim}fnvshobj(this,'sendpdfmail_cont');sendPDFmail('{$MODULE}','{$ID}');{rdelim}" class="webMnu"><img src="{'PDFMail.gif'|@vtiger_imageurl:$THEME}" hspace="5" align="absmiddle" border="0"/></a>
    	        <a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('{$PDFMAKER_MOD.SELECT_TEMPLATE}'); else {ldelim}fnvshobj(this,'sendpdfmail_cont');sendPDFmail('{$MODULE}','{$ID}');{rdelim}" class="webMnu">{$APP.LBL_SEND_EMAIL_PDF}</a>  
            {/if}            
            <div id="sendpdfmail_cont" style="z-index:100001;position:absolute;"></div>
            {* <a href="javascript:;" onclick="openPopUp('xComposeEmail',this,'index.php?module=Emails&action=EmailsAjax&file=EditView&pmodule={$MODULE}&pid={$ID}&commontemplateid='+getSelectedTemplates()+'&language='+document.getElementById('template_language').value+'&EditView&sendmail=true','createemailWin',820,689,'menubar=no,toolbar=no,location=no,status=no,resizable=no'); return false;" class="webMnu"><img src="{'PDFMail.gif'|@vtiger_imageurl:$THEME}" hspace="5" align="absmiddle" border="0"/></a>
	     	<a href="javascript:;" onclick="openPopUp('xComposeEmail',this,'index.php?module=Emails&action=EmailsAjax&file=EditView&pmodule={$MODULE}&pid={$ID}&commontemplateid='+getSelectedTemplates()+'&language='+document.getElementById('template_language').value+'&EditView&sendmail=true','createemailWin',820,689,'menubar=no,toolbar=no,location=no,status=no,resizable=no'); return false;" class="webMnu">{$APP.LBL_SEND_EMAIL_PDF}</a> *} 		    
        </td>
		</tr>
        
        <tr>
            <td class="rightMailMergeContent"  style="width:100%;">
                <a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('{$PDFMAKER_MOD.SELECT_TEMPLATE}'); else getPDFDocDivContent(this,'{$MODULE}','{$ID}');" class="webMnu"><img src="modules/PDFMaker/img/PDFDoc.png" hspace="5" align="absmiddle" border="0"/></a>
                <a href="javascript:;" onclick="if(getSelectedTemplates()=='') alert('{$PDFMAKER_MOD.SELECT_TEMPLATE}'); else getPDFDocDivContent(this,'{$MODULE}','{$ID}');" class="webMnu">{$PDFMAKER_MOD.LBL_SAVEASDOC}</a>
                
                <div id="PDFDocDiv" style="display:none; width:350px; position:absolute;" class="layerPopup"></div>
                
            </td>
        </tr>		
  {else}
    <tr>
  		<td class="rightMailMergeContent">
  		  {$PDFMAKER_MOD.CRM_TEMPLATES_DONT_EXIST}
    		{if $IS_ADMIN eq '1'} 
    		  {$PDFMAKER_MOD.CRM_TEMPLATES_ADMIN}          
          <a href="index.php?module=PDFMaker&action=EditPDFTemplate&return_module={$MODULE}&return_id={$ID}&parenttab=Tools" class="webMnu">{$PDFMAKER_MOD.TEMPLATE_CREATE_HERE}</a>
        {/if}
      </td>
		</tr>
  {/if}
  
</table>
<br/>

<script>
{literal}
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
            'index.php',
            {queue: {position: 'end', scope: 'command'},
                    method: 'post',
                    postBody: "module=PDFMaker&return_module="+module+"&action=PDFMakerAjax&file=docSelect&return_id="+id,
                    onComplete: function(response) 
                    {
                      getObj('PDFDocDiv').innerHTML=response.responseText;
                      fnvshobj(rootElm,'PDFDocDiv');
                      
                      var PDFDoc = document.getElementById('PDFDocDiv');
                      var PDFDocHandle = document.getElementById('PDFDocDivHandle');
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
            'index.php',
            {queue: {position: 'end', scope: 'command'},
                    method: 'post',
                    postBody: "module=PDFMaker&return_module="+module+"&action=PDFMakerAjax&file=mailSelect&idlist="+idstrings,
                    onComplete: function(response) 
                    {
                        if(response.responseText == "Mail Ids not permitted" || response.responseText == "No Mail Ids")
    					{
                            openPopUp('xComposeEmail',this,'index.php?module=Emails&action=EmailsAjax&file=EditView&pmodule='+module+'&pid='+idstrings+'&commontemplateid='+getSelectedTemplates()+'&language='+document.getElementById('template_language').value+'&sendmail=true','createemailWin',820,689,'menubar=no,toolbar=no,location=no,status=no,resizable=no'); 
    					}	
    					else{
                            getObj('sendpdfmail_cont').innerHTML=response.responseText;
                            var PDFMail = document.getElementById('sendpdfmail_cont');
                            var PDFMailHandle = document.getElementById('sendpdfmail_cont_handle');
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
		if(oFsendmail[i].type != 'button')
		{
			if(oFsendmail[i].checked != false)
			{
				email_type [j++]= oFsendmail[i].value;
			}
		}
	}
	if(email_type != '')
	{
		var field_lists = email_type.join(':');
		
		openPopUp('xComposeEmail',this,'index.php?module=Emails&action=EmailsAjax&file=EditView&pmodule='+module+'&pid={/literal}{$ID}{literal}&commontemplateid='+getSelectedTemplates()+'&language='+document.getElementById('template_language').value+'&sendmail=true&idlist='+idlist+'&field_lists='+field_lists,'createemailWin',820,689,'menubar=no,toolbar=no,location=no,status=no,resizable=no'); 
        
        fninvsh('roleLay');
		return true;
	}
	else
	{
		alert(alert_arr.SELECT_MAILID);
	}
}

function validatePDFDocForm()
{
    if(document.PDFDocForm.notes_title.value=='')
    {
        {/literal}
        alert('{$PDFMAKER_MOD.ALERT_DOC_TITLE}');
        {literal}
        return false;
    }
    else{
        document.PDFDocForm.template_ids.value=getSelectedTemplates();
        document.PDFDocForm.language.value=document.getElementById('template_language').value;
        return true;
    }
    
}

{/literal}
</script>

