<?php /* Smarty version 2.6.18, created on 2012-06-04 12:56:35
         compiled from RssFeeds.tpl */ ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" >
	<tr><td colspan="2" class="mailSubHeader" height=25><b><?php echo $this->_tpl_vars['MOD']['LBL_FEEDS_LIST']; ?>
 <?php echo $this->_tpl_vars['TITLE']; ?>
</b></td></tr>
	<tr class="hdrNameBg">
		<td valign=top height=25><input type="button" name="delete" value=" <?php echo $this->_tpl_vars['MOD']['LBL_DELETE_BUTTON']; ?>
 " class="crmbutton small delete" onClick="DeleteRssFeeds('<?php echo $this->_tpl_vars['ID']; ?>
');"/></td>
		<td align="right"><input type="button" name="setdefault" value=" <?php echo $this->_tpl_vars['MOD']['LBL_SET_DEFAULT_BUTTON']; ?>
  " class="crmbutton small create" onClick="makedefaultRss('<?php echo $this->_tpl_vars['ID']; ?>
');"/>
		</td>
	</tr>
	<tr><td colspan="2" align="left"><div id="rssScroll"><?php echo $this->_tpl_vars['RSSDETAILS']; ?>
</div></td></tr>
</table>