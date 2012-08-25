{*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************}
<div class="dataField" style="width: 98%; margin-top:2px;padding: 5px; background-color: rgb(236, 237, 232);" valign="top"  >
	<font color="darkred" ><b>
	{$APPROVALMODEL->content()|@nl2br}   
	</b></font>
</div>
<div class="dataLabel" style="border-bottom: 1px dotted rgb(204, 204, 204); width: 99%; padding-bottom: 5px;" valign="top">
	<font color="gray"><em>
		{$MOD.LBL_AUTHOR}: <u> {$APPROVALMODEL->author()} </u>  &nbsp;{$MOD.LBL_ON}&nbsp; <u> {$APPROVALMODEL->timestamp()}  </u>   &nbsp;&nbsp;&nbsp;  <span align='right'>{$MOD.NextApprover} <u>  {if $APPROVALMODEL->reports_to_name() neq ''} {$APPROVALMODEL->reports_to_name()}&nbsp;&nbsp; <img src="themes/images/arrownext.jpg"  border=0 align="absmiddle" >{else}{$MOD.LBL_ENDAPPROVAL}&nbsp;&nbsp;<img src="themes/images/approval.gif" border=0 align="absmiddle"><hr>{/if}</u> </span>
	</em></font>
</div>