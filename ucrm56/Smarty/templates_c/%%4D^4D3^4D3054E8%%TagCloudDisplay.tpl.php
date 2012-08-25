<?php /* Smarty version 2.6.18, created on 2012-06-05 07:32:12
         compiled from TagCloudDisplay.tpl */ ?>

<?php if ($this->_tpl_vars['TAG_CLOUD_DISPLAY'] == 'true'): ?>
<!-- Tag cloud display -->
	<table border=0 cellspacing=0 cellpadding=0 width=100% class="tagCloud">
	<tr>
		<td class="tagCloudTopBg"><img src="<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
tagCloudName_<?php echo $_SESSION['authenticated_user_language'] ?>.gif" border=0></td>
	</tr>
	<tr>
                      	<td><div id="tagdiv" style="display:visible;"><form method="POST" action="javascript:void(0);" onsubmit="return tagvalidate();"><input class="textbox"  type="text" id="txtbox_tagfields" name="textbox_First Name" value="" style="width:100px;margin-left:5px;"></input>&nbsp;&nbsp;<input name="button_tagfileds" type="submit" class="crmbutton small save" value="<?php echo $this->_tpl_vars['APP']['LBL_TAG_IT']; ?>
"/></form></div></td>
        </tr>
	<tr>
		<td class="tagCloudDisplay" valign=top> <span id="tagfields"><?php echo $this->_tpl_vars['ALL_TAG']; ?>
</span></td>
	</tr>
	</table>
<!-- End Tag cloud display -->
<?php endif; ?>