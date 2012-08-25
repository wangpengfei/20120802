<?php /* Smarty version 2.6.18, created on 2012-06-04 12:56:35
         compiled from Rss.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'vtiger_imageurl', 'Rss.tpl', 101, false),)), $this); ?>
<script language="JavaScript" type="text/javascript" src="modules/Rss/Rss.js"></script>
<script src="include/scriptaculous/scriptaculous.js" type="text/javascript"></script>
<script>
<?php echo '

function GetRssFeedList(id)
{
	$("status").style.display="inline";
        new Ajax.Request(
                \'index.php\',
                {queue: {position: \'end\', scope: \'command\'},
                        method: \'post\',
                        postBody: \'module=Rss&action=RssAjax&file=ListView&directmode=ajax&record=\'+id,
                        onComplete: function(response) {
                                $("status").style.display="none";
				$("rssfeedscont").innerHTML=response.responseText;
                        }
                }
        );
}

function DeleteRssFeeds(id)
{
   if(id != \'\')	
   {
	'; ?>

        if(confirm('<?php echo $this->_tpl_vars['APP']['DELETE_RSSFEED_CONFIRMATION']; ?>
'))
        <?php echo '
	{	
		show(\'status\');	
		var feed = \'feed_\'+id;
		$(feed).parentNode.removeChild($(feed));
		new Ajax.Request(
                	\'index.php\',
        	        {queue: {position: \'end\', scope: \'command\'},
                        	method: \'post\',
	                        postBody: \'module=Rss&return_module=Rss&action=RssAjax&file=Delete&directmode=ajax&record=\'+id,
        	                onComplete: function(response) {
	        	                $("status").style.display="none";
                                	$("rssfeedscont").innerHTML=response.responseText;
					$("mysite").src = \'\';
					$("rsstitle").innerHTML = "&nbsp";
                        	}
                	}
        	);
	}
   }
   else
	alert(alert_arr.LBL_NO_FEEDS_SELECTED);	     	
}
function SaveRssFeeds()
{
	$("status").style.display="inline";
	var rssurl = $(\'rssurl\').value;
	rssurl = rssurl.replace(/&/gi,"##amp##");
	new Ajax.Request(
		\'index.php\',
		{queue: {position: \'end\', scope: \'command\'},
			method: \'post\',
			postBody:\'module=Rss&action=RssAjax&file=Popup&directmode=ajax&rssurl=\'+rssurl, 
			onComplete: function(response) {
	
                                        $("status").style.display="none";
					if(isNaN(parseInt(response.responseText)))
        				{
				               var rrt = response.responseText;
						$("temp_alert").innerHTML = rrt;
						removeHTMLTags();	
				                $(\'rssurl\').value = \'\';
					}
					else
        				{
				                GetRssFeedList(response.responseText);
				                getrssfolders();
				                $(\'rssurl\').value = \'\';
				                $(\'PopupLay\').hide();
        				}
                                }
                        }
                );
}
'; ?>

</script>

<!-- Contents -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "Buttons_List1.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="temp_alert" style="display:none"></div>
<table border=0 cellspacing=0 cellpadding=0 width=98% align=center>
<tr>
	<td valign=top align=right width=8><img src="<?php echo vtiger_imageurl('showPanelTopLeft.gif', $this->_tpl_vars['THEME']); ?>
"></td>
	<td class="showPanelBg" valign="top" width="100%" align=center >	
		
			<!-- RSS Reader UI Starts here--><br>
				<table width="100%"  border="0" cellspacing="0" cellpadding="5" class="mailClient mailClientBg">
				<tr>
					<td align=left>
					
						<table width="100%"  border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width=95% align=left><img src='<?php echo vtiger_imageurl('rssroot.gif', $this->_tpl_vars['THEME']); ?>
' align='absmiddle'/><a href="javascript:;" onClick="fnvshobj(this,'PopupLay');$('rssurl').focus();" title='<?php echo $this->_tpl_vars['APP']['LBL_ADD_RSS_FEEDS']; ?>
'><?php echo $this->_tpl_vars['MOD']['LBL_ADD_RSS_FEED']; ?>
</a></td>
							<td  class="componentName" nowrap><?php echo $this->_tpl_vars['MOD']['LBL_VTIGER_RSS_READER']; ?>
</td>
						</tr>
						<tr>
							<td colspan="2">
								<table border=0 cellspacing=0 cellpadding=2 width=100%>
								<tr>
									<td width=30% valign=top>
									<!-- Feed Folders -->
										<table border=0 cellspacing=0 cellpadding=0 width=100%>
										<tr><td class="small mailSubHeader" height="25"><b><?php echo $this->_tpl_vars['MOD']['LBL_FEED_SOURCES']; ?>
</b></td></tr>
										<tr><td class="hdrNameBg" bgcolor="#fff" height=225><div id="rssfolders" style="height:100%;overflow:auto;"><?php echo $this->_tpl_vars['RSSFEEDS']; ?>
</div></td></tr>
										</table>
									</td>
									<td width=1%>&nbsp;</td>
									<td width=69% valign=top>
									<!-- Feed Header List -->
										<table border=0 cellspacing=0 cellpadding=0 width=100%>
										<tr>
											<td><div id="rssfeedscont">
											<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'RssFeeds.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
											</div>
											</td>
										</tr>
										</table>
									</td>
								</tr>
								</table>
								
							</td>
						</tr>
						<tr>		
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td height="5"></td>
						</tr>
						<tr>
							
							<td colspan="3" class="mailSubHeader" id="rsstitle">&nbsp;</td>
						</tr>
						<tr>
							<!-- RSS Display -->
							<td colspan="3" style="padding:2px">
							<iframe width="100%" height="250" frameborder="0" id="mysite" scrolling="auto" marginheight="0" marginwidth="0" style="background-color:#FFFFFF;"></iframe>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			<!-- RSS Reader UI ends here -->
	</td>
	<td valign=top align=right width=8><img src="<?php echo vtiger_imageurl('showPanelTopRight.gif', $this->_tpl_vars['THEME']); ?>
"></td>			
	</tr>
	</table>
	
	
	
	<div id="PopupLay" class="layerPopup">
	<form onSubmit="SaveRssFeeds(); return false;">
	<table width="100%" border="0" cellpadding="5" cellspacing="0" class="layerHeadingULine">
	<tr>
	<td class="layerPopupHeading" align="left"><img src="<?php echo vtiger_imageurl('rssroot.gif', $this->_tpl_vars['THEME']); ?>
" width="24" height="22" align="absmiddle" />&nbsp;<?php echo $this->_tpl_vars['MOD']['LBL_ADD_RSS_FEED']; ?>
</td>
	<td align="right"><a href="javascript:fninvsh('PopupLay');"><img src="<?php echo vtiger_imageurl('close.gif', $this->_tpl_vars['THEME']); ?>
" border="0"  align="absmiddle" /></a></td>
	</tr>
	</table>
	<table border=0 cellspacing=0 cellpadding=5 width=95% align=center> 
	<tr>
		<td class=small >
		
			<!-- popup specific content fill in starts -->

			<table border=0 celspacing=0 cellpadding=5 width=100% align=center bgcolor=white>
				<tr>
					<td align="right" width="25%"><b><?php echo $this->_tpl_vars['MOD']['LBL_FEED']; ?>
</b></td>
					<td align="left" width="75%"><input type="text" id="rssurl" class="txtBox" value=""/></td>
				</tr>
			</table>
			<!-- popup specific content fill in ends -->
		
		</td>
	</tr>
	</table>
	<table border=0 cellspacing=0 cellpadding=5 width=100% class="layerPopupTransport">
	<tr>
	<td align="center">
	<input type="submit" name="save" value=" &nbsp;<?php echo $this->_tpl_vars['APP']['LBL_SAVE_BUTTON_LABEL']; ?>
&nbsp; " class="crmbutton small save"/>&nbsp;&nbsp;
	</td>
	</tr>
	</table>
	</form>
	</div>

<script type="text/javascript" language="Javascript">
function makedefaultRss(id)
{
	if(id != '')
	{
		$("status").style.display="inline";
		new Ajax.Request(
                	'index.php',
	                {queue: {position: 'end', scope: 'command'},
        	                method: 'post',
                	        postBody:'module=Rss&action=RssAjax&file=Popup&directmode=ajax&record='+id, 
                        	onComplete: function(response) {
                                	$("status").style.display="none";
        				getrssfolders();
        	               }
                	}
        	);
	}
}
function getrssfolders()
{
	new Ajax.Request(
        	'index.php',
                {queue: {position: 'end', scope: 'command'},
                	method: 'post',
                        postBody:'module=Rss&action=RssAjax&file=ListView&folders=true',
			onComplete: function(response) {
                        		$("status").style.display="none";
					$("rssfolders").innerHTML=response.responseText;
                               }
                        }
                );
}


function removeHTMLTags()
{
 	if(document.getElementById && document.getElementById("temp_alert"))
	{
 		var strInputCode = document.getElementById("temp_alert").innerHTML;
 		var strTagStrippedText = strInputCode.replace(/<\/?[^>]+(>|$)/g, "");
 		alert( strTagStrippedText);	
 	}	
}


</script>