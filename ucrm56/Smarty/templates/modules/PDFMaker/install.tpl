<br/>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>   		
   		<td class="showPanelBg" valign="top" width="100%">
   			<table  cellpadding="0" cellspacing="0" width="100%" border=0>
  				<tr>
				<td width="50%" valign=top>
					<form name="install"  method="POST" action="index.php">
						<input type="hidden" name="module" value="PDFMaker"/>
						<input type="hidden" name="action" value="install"/>
						<table align="center" cellpadding="15" cellspacing="0" width="85%" class="mailClient importLeadUI small" border="0">
							<tr>
								<td colspan="2" valign="middle" align="left" class="mailClientBg genHeaderSmall">{$MOD.LBL_MODULE_NAME} {$MOD.LBL_INSTALL} {if $STEP neq 'error'}>> {$STEPNAME} >> {$STEP+1}/<span id="total_steps">{if $STEP neq '3'}3{else}4{/if}</span>{/if}</td>
								<br/>
							</tr>
							{if $STEP eq "0"}
							<tr>
    							<td border="0" cellpadding="5" cellspacing="0" width="70%">
    							<table width="100%">
    							     <tr>
                                       <td align="left" valign="top" style="padding-left:40px;">
                                       <input type="hidden" name="installtype" value="validate"/>                                       
                                       <span class="genHeaderSmall">{$MOD.LBL_WELCOME}</span>
  									   </td>
     								 </tr>
                                     <tr>
     								   <td align="left" valign="top" class="small" style="padding-left:40px;color:black;">
     								   {$MOD.LBL_WELCOME_DESC}
                                       </td>  
     								 </tr>
     								  <tr>
     								   <td align="left" valign="top" class="small" style="padding-left:40px;color:black;">
     								   {$MOD.LBL_WELCOME_FINISH}
                                       </td>  
     								 </tr>
                                     
                                     <tr><td align="left" valign="top" class="small">&nbsp;</td></tr>
                                       
                                     <tr>
                                       <td align="left" valign="top" style="padding-left:40px;">
                                       <input type="hidden" name="installtype" value="validate"/>                                       
                                       <strong>{$MOD.LBL_INSERT_KEY}</strong>
  									   </td>
     								 </tr>
                                     <tr>
     								   <td align="left" valign="top" class="small" style="padding-left:40px;color:red;">
     								   {$MOD.LBL_ONLINE_ASSURE}
                                       </td>  
     								 </tr>   								
     								 <tr>
     								   <td align="left" valign="top" class="small" style="padding-left:40px;padding-top:10px;">
     								   <input type="text" class="small detailedViewTextBox" name="key" value="" style="width:200px;font-size:13px;"/>
                                       </td>  
     								 </tr>
    							</table>    							
    						    </td>
    						    <td border="0" cellpadding="5" cellspacing="0" width="30%">
    							&nbsp;
    							</td>
 							</tr>
 							{elseif $STEP eq "1"}
                            <tr>
    							<td border="0" cellpadding="5" cellspacing="0" width="70%">
    							<table width="100%">
    							     <tr>
                                       <td align="left" valign="top" style="padding-left:40px;">
                                       <input type="hidden" name="installtype" value="download_src"/>                                       
                                       <span class="genHeaderSmall">{$MOD.LBL_DOWNLOAD_SRC}</span>
  									   </td>
     								 </tr>
                                     <tr>
     								   <td align="left" valign="top" class="small" style="padding-left:40px;">
     								   {$MOD.LBL_DOWNLOAD_SRC_DESC}
                                       </td>                                         
     								 </tr>
     								 {if $MB_STRING_EXISTS eq 'false'}
                                       <tr>
                                        <td align="left" valign="top" class="small" style="padding-left:40px;color:red;">
                                        {$MOD.LBL_MB_STRING_ERROR}
                                        </td>                                       
                                       </tr>
                                     {/if}
    							</table>    							
    						    </td>
    						    <td border="0" cellpadding="5" cellspacing="0" width="30%">
    							&nbsp;
    							</td>
 							</tr>
							{elseif $STEP eq "2"}
                            <tr>
    							<td border="0" cellpadding="5" cellspacing="0" width="50%">
    							<table width="100%">
    							     <tr>
                                       <td align="left" valign="top" style="padding-left:40px;">
                                       <input type="radio" name="installtype" id="installexpress" value="express" checked="checked" onclick="changeInstallType(this.value);"/>
                                       <span class="genHeaderSmall">{$MOD.LBL_EXPRESS} {$MOD.LBL_INSTALL}</span>
  									   </td>
     								 </tr>
     								 <tr>
     								   <td align="left" valign="top" class="small" style="padding-left:65px;">
     								   {$MOD.LBL_EXPRESS_DESC}
                                       
                                       <div id="list_permissions">{$LIST_PERMISSIONS}</div>
                                       {if $P_ERRORS neq '0'}<input type="button" id="btn_control_permissions" value="{$MOD.LBL_TRY_AGAIN}" onClick="controlPermissions();" class="crmbutton small create">{/if}
                                       </td>  
     								 </tr>
     								 <tr>
                                       <td align="left" valign="top" style="padding-left:40px;padding-top:20px;">
                                       <input type="radio" name="installtype" value="custom" onclick="changeInstallType(this.value);"/>
                                       <span class="genHeaderSmall">{$MOD.LBL_CUSTOM} {$MOD.LBL_INSTALL}</span>
  									   </td>
     								 </tr>
     								 <tr>
     								 <td align="left" valign="top" class="small" style="padding-left:65px;">
     								   {$MOD.LBL_CUSTOM_DESC}
                                     </td>
                                     </tr>
    							</table>    							
    						    </td>
    						    <td border="0" cellpadding="5" cellspacing="0" width="50%">
    							&nbsp;
    							</td>
 							</tr>
 							{elseif $STEP eq '3'}
 							<tr>
    							<td border="0" cellpadding="5" cellspacing="0" width="50%">
    							<input type="hidden" name="installtype" value="customFinal"/>
    							<table width="100%">
    							     <tr>
                                       <td align="left" valign="top" style="padding-left:40px;">                                       
                                       <span class="genHeaderSmall">{$MOD.LBL_INSTRUCTIONS}</span>
  									   </td>
     								 </tr>
     								 <tr>
     								   <td align="left" valign="top" class="small" style="padding-left:65px;">
   								       
                                        <p>
                                        {$MOD.LBL_FILE}: <strong>/index.php</strong><br/>
  							            {$MOD.LBL_AROUND_LINE} 130 {$MOD.LBL_BEFORE}
                                        <pre>{literal}
                                        $default_config_values = Array(...{/literal}</pre>
                                          							            {$MOD.LBL_ADD_FOLLOWING}
                                        <pre>{literal}
                                        $is_detail_view = false;
                                        if(isset($_REQUEST['action']) && $_REQUEST['action']=='DetailView'){
                                          $is_detail_view = true;
                                          
                                          $temp_sql = "SELECT templateid, filename AS templatename
                                                       FROM vtiger_pdfmaker
                                                       WHERE module = '".$_REQUEST['module']."'";
                                              
                                          $temp_result = $adb->query($temp_sql);
                                          if($adb->num_rows($temp_result)>0)
                                            $no_templates_exist = 0;
                                          else 
                                            $no_templates_exist = 1;
                                          
                                          while($temp_row = $adb->fetchByAssoc($temp_result)){
                                            $use_template[$temp_row['templateid']] = $temp_row['templatename'];
                                          }
                                          
                                          if(!isset($_SESSION["template_languages"]) || $_SESSION["template_languages"]=="") {
                                            $temp_res = $adb->query("SELECT label, prefix FROM vtiger_language WHERE active=1");
                                            while($temp_row = $adb->fetchByAssoc($temp_res)) {
                                              $template_languages[$temp_row["prefix"]]=$temp_row["label"];
                                            }
                                            $_SESSION["template_languages"]=$template_languages;
                                          }   
                                        }{/literal}</pre>                                        
     								    </p>
                                              								    
     								    <p style="border-top:3px dotted grey">&nbsp;</p>
                                              								    
     								    <p>
     								    {$MOD.LBL_FILE}: <strong>/Smarty_setup.php</strong><br/>
  							            {$MOD.LBL_AROUND_LINE} 50 {$MOD.LBL_AFTER}
<pre>{literal}
if(isset($_REQUEST) && $_REQUEST['action'] == 'DetailView') {
	//Added to provide User based Tagcloud
        $this->assign('TAG_CLOUD_DISPLAY', self::lookupTagCloudView($current_user->id) );
}{/literal}</pre>
  							            {$MOD.LBL_ADD_FOLLOWING}
<pre>{literal}
global $is_detail_view;
if($is_detail_view == true){
  global $use_template, $no_templates_exist,$current_language;
  $this->assign('CRM_TEMPLATES',$use_template);
  $this->assign('CRM_TEMPLATES_EXIST',$no_templates_exist);
  $this->assign('PDFMAKER_MOD',return_module_language($current_language,"PDFMaker"));
  
  $this->assign('TEMPLATE_LANGUAGES',$_SESSION["template_languages"]);
  $this->assign('CURRENT_LANGUAGE',$current_language);
}
if(is_admin($current_user)){
  $this->assign('IS_ADMIN','1');
}{/literal}</pre>
     								    </p>
     								    
     								    <p style="border-top:3px dotted grey">&nbsp;</p>     								    
     								    
                                         <p>
     								    {$MOD.LBL_FILE}: <strong>/modules/Emails/EditView.php</strong><br/>
  							            {$MOD.LBL_AROUND_LINE} 240 {$MOD.LBL_BEFORE}
<pre>{literal}
global $theme;
$theme_path="themes/".$theme."/";{/literal}</pre>
  							            {$MOD.LBL_ADD_FOLLOWING}
<pre>{literal}
if(isset($_REQUEST['commontemplateid']) && $_REQUEST['commontemplateid']!='')
{ 
  require_once("modules/PDFMaker/InventoryPDF.php");  
  
  $tempmodule = getSalesEntityType($_REQUEST['pid']); 
  $tempFocus = CRMEntity::getInstance($tempmodule);
  $tempFocus->id = $_REQUEST['pid'];
  $tempFocus->retrieve_entity_info($_REQUEST['pid'],$tempmodule);  
  
  $result=$adb->query("SELECT fieldname FROM vtiger_field WHERE uitype=4 AND tabid=".getTabId($tempmodule));
  $fieldname=$adb->query_result($result,0,"fieldname");
  if(isset($tempFocus->column_fields[$fieldname]) && $tempFocus->column_fields[$fieldname]!="")
    $name=generate_cool_uri($tempFocus->column_fields[$fieldname]);
  else
    $name=$_REQUEST["commontemplateid"].$_REQUEST["pid"].date("ymdHi");
  
  $smarty->assign("COMMON_TEMPLATE_NAME",$name);
  $smarty->assign("COMMON_TEMPLATE_ID",$_REQUEST['commontemplateid']);
}{/literal}</pre>
     								    </p>
     								    
     								    <p style="border-top:3px dotted grey">&nbsp;</p>     								    
     								    
                                         <p>
     								    {$MOD.LBL_FILE}: <strong>/modules/Emails/Save.php</strong><br/>
  							            {$MOD.LBL_AROUND_LINE} 162 {$MOD.LBL_BEFORE}
<pre>{literal}
require_once("modules/Emails/mail.php");{/literal}</pre>
  							            {$MOD.LBL_ADD_FOLLOWING}
<pre>{literal}
if(isset($_REQUEST['commontemplateid']) && $_REQUEST['commontemplateid']!='')
{ 
  require_once("modules/PDFMaker/checkMail.php");    
}{/literal}</pre>
     								    </p>
     								    
     								    <p style="border-top:3px dotted grey">&nbsp;</p>     								    
     								    
                                         <p>
     								    {$MOD.LBL_FILE}: <strong>/Smarty/templates/DetailView.tpl</strong><br/>
  							            {$MOD.LBL_AROUND_LINE} 590 {$MOD.LBL_BEFORE}
<pre>{literal}
{if $TAG_CLOUD_DISPLAY eq 'true'}{/literal}</pre>
  							            {$MOD.LBL_ADD_FOLLOWING}
<pre>{literal}
{include file="modules/PDFMaker/InventoryPdfActions.tpl"}{/literal}</pre>
     								    </p>
     								    
     								    <p style="border-top:3px dotted grey">&nbsp;</p>     								    
     								    
                                         <p>
     								    {$MOD.LBL_FILE}: <strong>/Smarty/templates/ComposeEmail.tpl</strong><br/>
  							            {$MOD.LBL_AROUND_LINE} 138 {$MOD.LBL_BEFORE}
<pre>{literal}
{else}   
  {foreach item="attach_files" key="attach_id" from=$elements.3}{/literal}</pre>
  							            {$MOD.LBL_ADD_FOLLOWING}
<pre>{php}
echo htmlentities('{elseif $COMMON_TEMPLATE_NAME neq \'\'}
  <tr>
    <td width="100%" colspan="2">{$COMMON_TEMPLATE_NAME}.pdf 
      <input type="hidden" value="{$COMMON_TEMPLATE_ID}" name="commontemplateid"/>
      <input type="hidden" value="{$smarty.request.pmodule}" name="relmodule"/>
      <input type="hidden" value="{$smarty.request.pid}" name="pid"/>
      <input type="hidden" value="{$smarty.request.language}" name="language"/>
    </td>
  </tr>');{/php}</pre>
     								    </p>
     								    
     								    <p style="border-top:3px dotted grey">&nbsp;</p>     								    
     								    
                                         <p>
     								    {$MOD.LBL_FILE}: <strong>/Smarty/templates/Inventory/InventoryActions.tpl</strong><br/>
  							            {$MOD.LBL_AROUND_LINE} 153 {$MOD.LBL_AFTER}
<pre>{php}
echo htmlentities('<!-- Module based actions ends -->');{/php}</pre>
  							            {$MOD.LBL_ADD_FOLLOWING}
<pre>{literal}
&lt;tr&gt;&lt;td&gt;
{include file="modules/PDFMaker/InventoryPdfActions.tpl"}
&lt;/td&gt;&lt;/tr&gt;{/literal}</pre>
     								    </p>
     								    
                                       </td>  
     								 </tr>     								 
    							</table> 						
    						    </td>
    						    <td border="0" cellpadding="5" cellspacing="0" width="50%">
    							&nbsp;
    							</td>
 							</tr>
 							{elseif $STEP eq 'error'}
 							<tr>
    							<td border="0" cellpadding="5" cellspacing="0" width="50%">
    							<table width="100%">
    							     <tr>
                                       <td align="left" valign="top" style="padding-left:40px;">                                       
                                       <span class="genHeaderSmall">{$MOD.LBL_INSTAL_ERROR}</span>
  									   </td>
     								 </tr>
                                     <tr>
     								   <td align="left" valign="top" class="small" style="padding-left:40px;">
     								    {if $INVALID neq "true"}
                                            {$MOD.LBL_ERROR_TBL}:<br/>
                                        {/if}
     								   {foreach item=tbl from=$ERROR_TBL}
     								   <pre>{$tbl}</pre></br>
     								   {/foreach}
                                       </td>  
     								 </tr>     								 
    							</table>    							
    						    </td>
    						    <td border="0" cellpadding="5" cellspacing="0" width="50%">
    							&nbsp;
    							</td>
 							</tr>
 							{/if}
 							<tr>
								<td align="center" colspan="2" border=0 cellspacing=0 cellpadding=5 width=98% class="layerPopupTransport">	
									{if $STEP eq '0'}
                                        <input type="submit" id="validate_button" value="{$MOD.LBL_VALIDATE}" class="crmbutton small create"/>&nbsp;&nbsp;
                                        <input type="button" id="order_button" value="{$MOD.LBL_ORDER_NOW}" class="crmbutton small cancel" onclick="window.location.href='http://www.vtiger.sk/purchase-order'"/>
              						{elseif $STEP eq '1'}
              						    <input type="submit" id="download_button" value="{$MOD.LBL_DOWNLOAD}" class="crmbutton small create"/>&nbsp;&nbsp;
                                    {elseif $STEP eq '2' || $STEP eq '3'}
                                        <input type="submit" id="next_button" value="{$MOD.LBL_FINISH}" class="crmbutton small create" {if $STEP eq '2' && $P_ERRORS neq '0'}style="display:none;"{/if} />&nbsp;&nbsp;
                                    {elseif $STEP eq '3'}
              						    <input type="submit" id="next_button" value="{$MOD.LBL_FINISH}" class="crmbutton small create"/>&nbsp;&nbsp;
                                    {elseif $STEP eq "error" && $INVALID neq "true"}
              						    <input type="button" id="refresh_button" value="{$MOD.LBL_RELOAD}" class="crmbutton small create" onclick="window.location.reload();"/>&nbsp;&nbsp;
                                    {/if} 
                                                 						
                                    {if $STEP eq '2'}
                                       <input type="button" name="{$APP.LBL_CANCEL_BUTTON_LABEL}" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" class="crmbutton small cancel" onclick="window.history.back()" />              						   
              						{elseif $STEP eq '3'}
              						   <input type="button" name="{$APP.LBL_BACK}" value="{$APP.LBL_BACK}" class="crmbutton small cancel" onclick="window.history.back()" />                                       
                                    {*{elseif $STEP eq 'error' || $STEP eq '1'}*}
                                    {elseif $STEP eq 'error'}
                                       {if $INVALID eq "true"}
                                        <input type="button" name="{$APP.LBL_BACK}" value="{$APP.LBL_BACK}" class="crmbutton small create" onclick="window.history.back()" />
                                       {/if}
                                       <input type="button" name="{$APP.LBL_CANCEL_BUTTON_LABEL}" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" class="crmbutton small cancel" onclick="window.location.href='index.php?module=Home&action=index&parenttab=My Home Page'" />
                                    {/if} 
								</td>
							</tr>
 						</table>
 					</form>
 				</td>
 				</tr>
 			</table>
 		</td>
 	</tr>
</table>

<script>
function changeInstallType(type)
{ldelim}

   document.getElementById('next_button').disabled = false;
   document.getElementById('next_button').style.display = "inline";
    
   if (type == "express")
   {ldelim}
        bad_files_count = document.getElementById('bad_files').value;
        
        if (bad_files_count != "0") 
        {ldelim}
           document.getElementById('next_button').disabled = true;
           document.getElementById('next_button').style.display = "none";
        {rdelim}
           
        document.getElementById('next_button').value='{$MOD.LBL_FINISH}';
        document.getElementById('total_steps').innerHTML='3';
   {rdelim}
   else if (type == "custom")
   {ldelim}
        document.getElementById('next_button').value='{$MOD.LBL_NEXT}';
        document.getElementById('total_steps').innerHTML='4';
   {rdelim}
{rdelim}

{literal}    
function controlPermissions()
{
    
    
    var url = "module=PDFMaker&action=PDFMakerAjax&file=controlPermissions";
    new Ajax.Request(
                    'index.php',
                      {queue: {position: 'end', scope: 'command'},
                              method: 'post',
                              postBody:url,
                              onComplete: function(response) {
                                      document.getElementById('list_permissions').innerHTML = response.responseText;
                                      
                                      bad_files_count = document.getElementById('bad_files').value;
                                      
                                      type = document.getElementById('installexpress').checked;
                                      
                                      if (type == true && bad_files_count == "0")
                                      {
                                          document.getElementById('next_button').disabled = false;
                                          document.getElementById('next_button').style.display = "inline";
                                          
                                          document.getElementById('btn_control_permissions').style.display = "none"; 
                                      }
                              }
                      }
                      );
                  
}
{/literal}    
</script>
