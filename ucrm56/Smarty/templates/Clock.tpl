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

{if $WORLD_CLOCK_DISPLAY eq 'true'}

<div id="wclock" style="z-index:10000001;" class="layerPopup">
	<table class="mailClientBg" align="center" border="0" cellpadding="5" cellspacing="0" width="100%">
	<tr style="cursor:move;" >
		<td style="text-align:left;" id="Handle"><b>{$APP.LBL_WORLD_CLOCK}</b></td>
		<td align="right">
			<a href="javascript:;">
				<img src="{'close.gif'|@vtiger_imageurl:$THEME}" border="0"  onClick="fninvsh('wclock')" hspace="5" align="absmiddle">
			</a>
		</td>
	</tr>
	</table>
	<table class="hdrNameBg" align="center" border="0" cellpadding="2" cellspacing="0" width="100%">
	<tr>
	<td nowrap="nowrap" colspan="2">
	<div style="background-image: url({$IMAGEPATH}clock_bg.gif); background-repeat: no-repeat; background-position: 4px 38px;" id="theClockLayer">
<div id="theCities" class="citystyle">
<form action="" name="frmtimezone">
<input name="PHPSESSID" value="162c0ab587f6c555aaaa30d681b61f7c" type="hidden">
<select name="clockcity" size="1" class="importBox small"   id="clockcity" style="width:125px;"  onchange="lcl(this.selectedIndex,this.options[0].selected)">
<option value="0" selected="selected">{$APP.Local_time}</option>
<option value="4.30">{$APP.Afghanistan}</option>
<option value="1">{$APP.Algeria}</option>
<option value="-3">{$APP.Argentina}</option>
<option value="9.30">{$APP.Australia_Adelaide}</option>
<option value="8">{$APP.Australia_Perth}</option>
<option value="10">{$APP.Australia_Sydney}</option>
<option value="1">{$APP.Austria}</option>
<option value="3">{$APP.Bahrain}</option>
<option value="6">{$APP.Bangladesh}</option>
<option value="1">{$APP.Belgium}</option>
<option value="-4">{$APP.Bolivia}</option>
<option value="-5">{$APP.Brazil_Andes}</option>
<option value="-3">{$APP.Brazil_East}</option>
<option value="-4">{$APP.Brazil_West}</option>
<option value="2">{$APP.Bulgaria}</option>
<option value="6.30">{$APP.Burma}</option>
<option value="-5">{$APP.Chile}</option>
<option value="-7">{$APP.Canada_Calgary}</option>
<option value="-3.30">{$APP.Canada_Newfoundland}</option>
<option value="-4">{$APP.Canada_Nova_Scotia}</option>
<option value="-5">{$APP.Canada_Toronto}</option>
<option value="-8">{$APP.Canada_Vancouver}</option>
<option value="-6">{$APP.Canada_Winnipeg}</option>
<option value="8">{$APP.China_Mainland}</option>
<option value="8">{$APP.China_Taiwan}</option>
<option value="-5">{$APP.Colombia}</option>
<option value="-5">{$APP.Cuba}</option>
<option value="1">{$APP.Denmark}</option>
<option value="-5">{$APP.Ecuador}</option>
<option value="2">{$APP.Egypt}</option>
<option value="12">{$APP.Fiji}</option>
<option value="2">{$APP.Finland}</option>
<option value="1">{$APP.France}</option>
<option value="1">{$APP.Germany}</option>
<option value="0">{$APP.Ghana}</option>
<option value="2">{$APP.Greece}</option>
<option value="-3">{$APP.Greenland}</option>
<option value="1">{$APP.Hungary}</option>
<option value="5.30">{$APP.India}</option>
<option value="8">{$APP.Indonesia_Bali_Borneo}</option>
<option value="9">{$APP.Indonesia_Irian_Jaya}</option>
<option value="7">{$APP.Indonesia_Sumatra_Java}</option>
<option value="3.30">{$APP.Iran}</option>
<option value="3">{$APP.Iraq}</option>
<option value="2">{$APP.Israel}</option>
<option value="1">{$APP.Italy}</option>
<option value="-5">{$APP.Jamaica}</option>
<option value="9">{$APP.Japan}</option>
<option value="3">{$APP.Kenya}</option>
<option value="9">{$APP.Korea (North &amp; South)}</option>
<option value="3">{$APP.Kuwait}</option>
<option value="1">{$APP.Libya}</option>
<option value="8">{$APP.Malaysia}</option>
<option value="5">{$APP.Maldives}</option>
<option value="1">{$APP.Mali}</option>
<option value="4">{$APP.Mauritius}</option>
<option value="-6">{$APP.Mexico}</option>
<option value="0">{$APP.Morocco}</option>
<option value="5.45">{$APP.Nepal}</option>
<option value="1">{$APP.Netherlands}</option>
<option value="12">{$APP.New_Zealand}</option>
<option value="1">{$APP.Nigeria}</option>
<option value="1">{$APP.Norway}</option>
<option value="4">{$APP.Oman}</option>
<option value="5">{$APP.Pakistan}</option>
<option value="-5">{$APP.Peru}</option>
<option value="8">{$APP.Philippines}</option>
<option value="1">{$APP.Poland}</option>
<option value="1">{$APP.Portugal}</option>
<option value="3">{$APP.Qatar}</option>
<option value="2">{$APP.Romania}</option>
<option value="11">{$APP.Russia_Kamchatka}</option>
<option value="3">{$APP.Russia_Moscow}</option>
<option value="9">{$APP.Russia_Vladivostok}</option>
<option value="4">{$APP.Seychelles}</option>
<option value="3">{$APP.Saudi_Arabia}</option>
<option value="8">{$APP.Singapore}</option>
<option value="2">{$APP.South_Africa}</option>
<option value="1">{$APP.Spain}</option>
<option value="3">{$APP.Syria}</option>
<option value="5.30">{$APP.Sri_Lanka}</option>
<option value="1">{$APP.Sweden}</option>
<option value="1">{$APP.Switzerland}</option>
<option value="7">{$APP.Thailand}</option>
<option value="12">{$APP.Tonga}</option>
<option value="2">{$APP.Turkey}</option>
<option value="3">{$APP.Ukraine}</option>
<option value="5">{$APP.Uzbekistan}</option>
<option value="7">{$APP.Vietnam}</option>
<option value="4">{$APP.UAE}</option>
<option value="0">{$APP.UK}</option>
<option value="-9">{$APP.USA_Alaska}</option>
<option value="-9">{$APP.USA_Arizona}</option>
<option value="-6">{$APP.USA_Central}</option>
<option value="-5">{$APP.USA_Eastern}</option>
<option value="-10">{$APP.USA_Hawaii}</option>
<option value="-5">{$APP.USA_Indiana_East}</option>
<option value="-7">{$APP.USA_Mountain}</option>
<option value="-8">{$APP.USA_Pacific}</option>
<option value="3">{$APP.Yemen}</option>
<option value="1">{$APP.Yugoslavia}</option>
<option value="2">{$APP.Zambia}</option>
<option value="2">{$APP.Zimbabwe}</option>
</select>
</form>
</div>
<script type="text/javascript">
        var theme = "{$THEME}";
</script>
<script type="text/javascript">
        var language = "{php} echo 
$_SESSION['authenticated_user_language'];{/php}";
</script>
<script language="javascript" type="text/javascript" src="include/js/{php} echo 
$_SESSION['authenticated_user_language'];{/php}.lang.js"></script>

<script type="text/javascript" src="include/js/clock.js"></script>

<div id="theFace0" class="facestyle" style="color: rgb(0, 0, 0); top: 81px; left: 96px;">3</div>
<div id="theFace1" class="facestyle" style="color: rgb(0, 0, 0); top: 102px; left: 90.3731px;">4</div>
<div id="theFace2" class="facestyle" style="color: rgb(0, 0, 0); top: 117.373px; left: 75px;">5</div>
<div id="theFace3" class="facestyle" style="color: rgb(0, 0, 0); top: 123px; left: 54px;">6</div>
<div id="theFace4" class="facestyle" style="color: rgb(0, 0, 0); top: 117.373px; left: 33px;">7</div>
<div id="theFace5" class="facestyle" style="color: rgb(0, 0, 0); top: 102px; left: 17.6269px;">8</div>
<div id="theFace6" class="facestyle" style="color: rgb(0, 0, 0); top: 81px; left: 12px;">9</div>
<div id="theFace7" class="facestyle" style="color: rgb(0, 0, 0); top: 60px; left: 17.6269px;">10</div>
<div id="theFace8" class="facestyle" style="color: rgb(0, 0, 0); top: 44.6269px; left: 33px;">11</div>
<div id="theFace9" class="facestyle" style="color: rgb(0, 0, 0); top: 39px; left: 54px;">12</div>
<div id="theFace10" class="facestyle" style="color: rgb(0, 0, 0); top: 44.6269px; left: 75px;">1</div>
<div id="theFace11" class="facestyle" style="color: rgb(0, 0, 0); top: 60px; left: 90.3731px;">2</div>
</div></td>
</tr>
</tbody>
</table>
</div>
<script>
	var theHandle = document.getElementById("Handle");
	var theRoot   = document.getElementById("wclock");
	Drag.init(theHandle, theRoot);
</script>

{/if}