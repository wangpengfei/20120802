<?php /* Smarty version 2.6.18, created on 2012-06-03 22:56:39
         compiled from Home/TagCloud.tpl */ ?>
<div id="tagcloud" style="overflow: auto; width: 100%; padding-left: 2%; padding-right: 3%; min-height: 250px;" >
	<img src='<?php echo $this->_tpl_vars['IMAGE_PATH']; ?>
/tagCloudName_<?php echo $_SESSION['authenticated_user_language'] ?>.gif' style="display: block; width: 100%;"/>
	<br>
	<span id="tagfields"><?php echo $this->_tpl_vars['ALL_TAG']; ?>
</span>
</div>