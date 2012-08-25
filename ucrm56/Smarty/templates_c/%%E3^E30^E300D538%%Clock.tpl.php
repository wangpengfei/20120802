<?php /* Smarty version 2.6.18, created on 2012-06-03 22:56:21
         compiled from Clock.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'Clock.tpl', 21, false),)), $this); ?>

<?php if ($this->_tpl_vars['WORLD_CLOCK_DISPLAY'] == 'true'): ?>

<div id="wclock" style="z-index:10000001;" class="layerPopup">
	<table class="mailClientBg" align="center" border="0" cellpadding="5" cellspacing="0" width="100%">
	<tr style="cursor:move;" >
		<td style="text-align:left;" id="Handle"><b><?php echo $this->_tpl_vars['APP']['LBL_WORLD_CLOCK']; ?>
</b></td>
		<td align="right">
			<a href="javascript:;">
				<img src="<?php echo vtiger_imageurl('close.gif', $this->_tpl_vars['THEME']); ?>
" border="0"  onClick="fninvsh('wclock')" hspace="5" align="absmiddle">
			</a>
		</td>
	</tr>
	</table>
	<table class="hdrNameBg" align="center" border="0" cellpadding="2" cellspacing="0" width="100%">
	<tr>
	<td nowrap="nowrap" colspan="2">
	<div style="background-image: url(<?php echo $this->_tpl_vars['IMAGEPATH']; ?>
clock_bg.gif); background-repeat: no-repeat; background-position: 4px 38px;" id="theClockLayer">
<div id="theCities" class="citystyle">
<form action="" name="frmtimezone">
<input name="PHPSESSID" value="162c0ab587f6c555aaaa30d681b61f7c" type="hidden">
<select name="clockcity" size="1" class="importBox small"   id="clockcity" style="width:125px;"  onchange="lcl(this.selectedIndex,this.options[0].selected)">
<option value="0" selected="selected"><?php echo $this->_tpl_vars['APP']['Local_time']; ?>
</option>
<option value="4.30"><?php echo $this->_tpl_vars['APP']['Afghanistan']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Algeria']; ?>
</option>
<option value="-3"><?php echo $this->_tpl_vars['APP']['Argentina']; ?>
</option>
<option value="9.30"><?php echo $this->_tpl_vars['APP']['Australia_Adelaide']; ?>
</option>
<option value="8"><?php echo $this->_tpl_vars['APP']['Australia_Perth']; ?>
</option>
<option value="10"><?php echo $this->_tpl_vars['APP']['Australia_Sydney']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Austria']; ?>
</option>
<option value="3"><?php echo $this->_tpl_vars['APP']['Bahrain']; ?>
</option>
<option value="6"><?php echo $this->_tpl_vars['APP']['Bangladesh']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Belgium']; ?>
</option>
<option value="-4"><?php echo $this->_tpl_vars['APP']['Bolivia']; ?>
</option>
<option value="-5"><?php echo $this->_tpl_vars['APP']['Brazil_Andes']; ?>
</option>
<option value="-3"><?php echo $this->_tpl_vars['APP']['Brazil_East']; ?>
</option>
<option value="-4"><?php echo $this->_tpl_vars['APP']['Brazil_West']; ?>
</option>
<option value="2"><?php echo $this->_tpl_vars['APP']['Bulgaria']; ?>
</option>
<option value="6.30"><?php echo $this->_tpl_vars['APP']['Burma']; ?>
</option>
<option value="-5"><?php echo $this->_tpl_vars['APP']['Chile']; ?>
</option>
<option value="-7"><?php echo $this->_tpl_vars['APP']['Canada_Calgary']; ?>
</option>
<option value="-3.30"><?php echo $this->_tpl_vars['APP']['Canada_Newfoundland']; ?>
</option>
<option value="-4"><?php echo $this->_tpl_vars['APP']['Canada_Nova_Scotia']; ?>
</option>
<option value="-5"><?php echo $this->_tpl_vars['APP']['Canada_Toronto']; ?>
</option>
<option value="-8"><?php echo $this->_tpl_vars['APP']['Canada_Vancouver']; ?>
</option>
<option value="-6"><?php echo $this->_tpl_vars['APP']['Canada_Winnipeg']; ?>
</option>
<option value="8"><?php echo $this->_tpl_vars['APP']['China_Mainland']; ?>
</option>
<option value="8"><?php echo $this->_tpl_vars['APP']['China_Taiwan']; ?>
</option>
<option value="-5"><?php echo $this->_tpl_vars['APP']['Colombia']; ?>
</option>
<option value="-5"><?php echo $this->_tpl_vars['APP']['Cuba']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Denmark']; ?>
</option>
<option value="-5"><?php echo $this->_tpl_vars['APP']['Ecuador']; ?>
</option>
<option value="2"><?php echo $this->_tpl_vars['APP']['Egypt']; ?>
</option>
<option value="12"><?php echo $this->_tpl_vars['APP']['Fiji']; ?>
</option>
<option value="2"><?php echo $this->_tpl_vars['APP']['Finland']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['France']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Germany']; ?>
</option>
<option value="0"><?php echo $this->_tpl_vars['APP']['Ghana']; ?>
</option>
<option value="2"><?php echo $this->_tpl_vars['APP']['Greece']; ?>
</option>
<option value="-3"><?php echo $this->_tpl_vars['APP']['Greenland']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Hungary']; ?>
</option>
<option value="5.30"><?php echo $this->_tpl_vars['APP']['India']; ?>
</option>
<option value="8"><?php echo $this->_tpl_vars['APP']['Indonesia_Bali_Borneo']; ?>
</option>
<option value="9"><?php echo $this->_tpl_vars['APP']['Indonesia_Irian_Jaya']; ?>
</option>
<option value="7"><?php echo $this->_tpl_vars['APP']['Indonesia_Sumatra_Java']; ?>
</option>
<option value="3.30"><?php echo $this->_tpl_vars['APP']['Iran']; ?>
</option>
<option value="3"><?php echo $this->_tpl_vars['APP']['Iraq']; ?>
</option>
<option value="2"><?php echo $this->_tpl_vars['APP']['Israel']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Italy']; ?>
</option>
<option value="-5"><?php echo $this->_tpl_vars['APP']['Jamaica']; ?>
</option>
<option value="9"><?php echo $this->_tpl_vars['APP']['Japan']; ?>
</option>
<option value="3"><?php echo $this->_tpl_vars['APP']['Kenya']; ?>
</option>
<option value="9"><?php echo $this->_tpl_vars['APP']['Korea']; ?>
</option>
<option value="3"><?php echo $this->_tpl_vars['APP']['Kuwait']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Libya']; ?>
</option>
<option value="8"><?php echo $this->_tpl_vars['APP']['Malaysia']; ?>
</option>
<option value="5"><?php echo $this->_tpl_vars['APP']['Maldives']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Mali']; ?>
</option>
<option value="4"><?php echo $this->_tpl_vars['APP']['Mauritius']; ?>
</option>
<option value="-6"><?php echo $this->_tpl_vars['APP']['Mexico']; ?>
</option>
<option value="0"><?php echo $this->_tpl_vars['APP']['Morocco']; ?>
</option>
<option value="5.45"><?php echo $this->_tpl_vars['APP']['Nepal']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Netherlands']; ?>
</option>
<option value="12"><?php echo $this->_tpl_vars['APP']['New_Zealand']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Nigeria']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Norway']; ?>
</option>
<option value="4"><?php echo $this->_tpl_vars['APP']['Oman']; ?>
</option>
<option value="5"><?php echo $this->_tpl_vars['APP']['Pakistan']; ?>
</option>
<option value="-5"><?php echo $this->_tpl_vars['APP']['Peru']; ?>
</option>
<option value="8"><?php echo $this->_tpl_vars['APP']['Philippines']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Poland']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Portugal']; ?>
</option>
<option value="3"><?php echo $this->_tpl_vars['APP']['Qatar']; ?>
</option>
<option value="2"><?php echo $this->_tpl_vars['APP']['Romania']; ?>
</option>
<option value="11"><?php echo $this->_tpl_vars['APP']['Russia_Kamchatka']; ?>
</option>
<option value="3"><?php echo $this->_tpl_vars['APP']['Russia_Moscow']; ?>
</option>
<option value="9"><?php echo $this->_tpl_vars['APP']['Russia_Vladivostok']; ?>
</option>
<option value="4"><?php echo $this->_tpl_vars['APP']['Seychelles']; ?>
</option>
<option value="3"><?php echo $this->_tpl_vars['APP']['Saudi_Arabia']; ?>
</option>
<option value="8"><?php echo $this->_tpl_vars['APP']['Singapore']; ?>
</option>
<option value="2"><?php echo $this->_tpl_vars['APP']['South_Africa']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Spain']; ?>
</option>
<option value="3"><?php echo $this->_tpl_vars['APP']['Syria']; ?>
</option>
<option value="5.30"><?php echo $this->_tpl_vars['APP']['Sri_Lanka']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Sweden']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Switzerland']; ?>
</option>
<option value="7"><?php echo $this->_tpl_vars['APP']['Thailand']; ?>
</option>
<option value="12"><?php echo $this->_tpl_vars['APP']['Tonga']; ?>
</option>
<option value="2"><?php echo $this->_tpl_vars['APP']['Turkey']; ?>
</option>
<option value="3"><?php echo $this->_tpl_vars['APP']['Ukraine']; ?>
</option>
<option value="5"><?php echo $this->_tpl_vars['APP']['Uzbekistan']; ?>
</option>
<option value="7"><?php echo $this->_tpl_vars['APP']['Vietnam']; ?>
</option>
<option value="4"><?php echo $this->_tpl_vars['APP']['UAE']; ?>
</option>
<option value="0"><?php echo $this->_tpl_vars['APP']['UK']; ?>
</option>
<option value="-9"><?php echo $this->_tpl_vars['APP']['USA_Alaska']; ?>
</option>
<option value="-9"><?php echo $this->_tpl_vars['APP']['USA_Arizona']; ?>
</option>
<option value="-6"><?php echo $this->_tpl_vars['APP']['USA_Central']; ?>
</option>
<option value="-5"><?php echo $this->_tpl_vars['APP']['USA_Eastern']; ?>
</option>
<option value="-10"><?php echo $this->_tpl_vars['APP']['USA_Hawaii']; ?>
</option>
<option value="-5"><?php echo $this->_tpl_vars['APP']['USA_Indiana_East']; ?>
</option>
<option value="-7"><?php echo $this->_tpl_vars['APP']['USA_Mountain']; ?>
</option>
<option value="-8"><?php echo $this->_tpl_vars['APP']['USA_Pacific']; ?>
</option>
<option value="3"><?php echo $this->_tpl_vars['APP']['Yemen']; ?>
</option>
<option value="1"><?php echo $this->_tpl_vars['APP']['Yugoslavia']; ?>
</option>
<option value="2"><?php echo $this->_tpl_vars['APP']['Zambia']; ?>
</option>
<option value="2"><?php echo $this->_tpl_vars['APP']['Zimbabwe']; ?>
</option>
</select>
</form>
</div>
<script type="text/javascript">
        var theme = "<?php echo $this->_tpl_vars['THEME']; ?>
";
</script>
<script type="text/javascript">
        var language = "<?php  echo 
$_SESSION['authenticated_user_language']; ?>";
</script>
<script language="javascript" type="text/javascript" src="include/js/<?php  echo 
$_SESSION['authenticated_user_language']; ?>.lang.js"></script>

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

<?php endif; ?>