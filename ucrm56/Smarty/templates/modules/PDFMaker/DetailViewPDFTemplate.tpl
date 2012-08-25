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
{* ITS4YOU TT0093 VlMe N *}
<script language="JAVASCRIPT" type="text/javascript" src="include/js/smoothscroll.js"></script>
<br>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="98%">
<tbody><tr>
        {*<td valign="top"><img src="{'showPanelTopLeft.gif'|@vtiger_imageurl:$THEME}"></td>*}
        <td class="showPanelBg" style="padding: 10px;" valign="top" width="100%">

				<!-- DISPLAY -->
				<table border=0 cellspacing=0 cellpadding=5 width=100% class="settingsSelUITopLine">
		    	<form method="post" action="index.php" name="etemplatedetailview" onsubmit="VtigerJS_DialogBox.block();">  
				<input type="hidden" name="action" value="">
				<input type="hidden" name="module" value="PDFMaker">
				<input type="hidden" name="templateid" value="{$TEMPLATEID}">
				<input type="hidden" name="parenttab" value="{$PARENTTAB}">
				<input type="hidden" name="isDuplicate" value="false">
				<tr>
					{*<td width=50 rowspan=2 valign=top><img src="{'PDFTemplates.jpg'|@vtiger_imageurl:$THEME}" border=0 ></td>*}
					<td class=heading2 valign=bottom><b><a href="index.php?module=PDFMaker&action=ListPDFTemplates&parenttab=Tools">{$MOD.LBL_TEMPLATE_GENERATOR}</a> &gt; {$MOD.LBL_VIEWING} &quot;{$FILENAME}&quot; </b></td>
				</tr>
				<tr>
					<td valign=top class="small">{$MOD.LBL_TEMPLATE_GENERATOR_DESCRIPTION}</td>
				</tr>
				</table>
				
				<br>
				<table border=0 cellspacing=0 cellpadding=10 width=100% >
				<tr>
				<td>
				
					<table border=0 cellspacing=0 cellpadding=5 width=100% class="tableHeading">
					<tr>
						<td class="big"><strong>{$MOD.LBL_PROPERTIES} &quot;{$FILENAME}&quot; </strong></td>
						<td class="small" align=right>&nbsp;&nbsp;
						  <input class="crmButton edit small" type="submit" name="Button" value="{$APP.LBL_EDIT_BUTTON_LABEL}" onclick="this.form.action.value='EditPDFTemplate'; this.form.parenttab.value='Tools'">&nbsp;
						  <input class="crmbutton small create" type="submit" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON}" title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="U"  onclick="this.form.isDuplicate.value='true'; this.form.action.value='EditPDFTemplate';">&nbsp;&nbsp;
                        </td>
					</tr>
					</table>
					
					<table border=0 cellspacing=0 cellpadding=5 width=100% >
					<tr>
						<td width=20% class="small cellLabel"><strong>{$MOD.LBL_PDF_NAME}:</strong></td>
						<td width=80% class="small cellText"><strong>&nbsp;{$FILENAME}</strong></td>
					  </tr>
					<tr>
						<td valign=top class="small cellLabel"><strong>{$MOD.LBL_DESCRIPTION}:</strong></td>
						<td class="cellText small" valign=top>&nbsp;{$DESCRIPTION}</td>
					</tr>
                    {****************************************** pdf sorce module *********************************************}	
					<tr>
						<td valign=top class="small cellLabel"><strong>{$MOD.LBL_MODULENAMES}:</strong></td>
						<td class="cellText small" valign=top>&nbsp;{$MODULENAME}</td>
					</tr>
					{****************************************** pdf body *****************************************************}	
					<tr>
					  <td colspan="2" valign=top class="cellText small" style="padding:5px 0px 0px 0px;">
                      <table width="100%"  border="0" cellspacing="0" cellpadding="0" class="thickBorder">
                        <tr>
                          <td valign=top>
                          <table width="100%"  border="0" cellspacing="0" cellpadding="5" >
                              <tr>
                                <td colspan="2" valign="top" class="small" style="background-color:#cccccc"><strong>{$MOD.LBL_PDF_TEMPLATE}</strong></td>
                              </tr>
                              <tr>
                                <td valign="top" width="20%" class="cellLabel small">{$MOD.LBL_HEADER_TAB}</td>
                                <td class="cellText small" width="80%">&nbsp;{$HEADER}</td>
                              </tr>
                              
                              <tr>
                                <td valign="top" class="cellLabel small">{$MOD.LBL_BODY}</td>
                                <td class="cellText small">&nbsp;{$BODY}</td>
                              </tr>
                              
                              <tr>
                                <td valign="top" class="cellLabel small">{$MOD.LBL_FOOTER_TAB}</td>
                                <td class="cellText small">&nbsp;{$FOOTER}</td>
                              </tr>
                              
                          </table>
                          </td>                          
                        </tr>                        
                      </table>
                      </td>
					  </tr>
					  
					  
					</table> 					
				</td>
				</tr><tr><td align="center" class="small" style="color: rgb(153, 153, 153);">{$MOD.PDF_MAKER} {$VERSION} {$MOD.COPYRIGHT}</td></tr>
				</table>

			</td>
			</tr>
			</table>
		</td>
	</tr>
	</form>
	</table>
		


</td>
   </tr>   
</tbody>
</table>
