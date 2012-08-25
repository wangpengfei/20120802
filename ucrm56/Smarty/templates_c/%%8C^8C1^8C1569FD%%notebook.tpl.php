<?php /* Smarty version 2.6.18, created on 2012-06-03 22:56:26
         compiled from Home/notebook.tpl */ ?>

<div style="width: 100%; overflow: auto; height:auto !important;min-height: 240px;height: 240px; padding-left: 2%; padding-right: 3%;" id="notebook_<?php echo $this->_tpl_vars['NOTEBOOKID']; ?>
" ondblclick="editContents(this, <?php echo $this->_tpl_vars['NOTEBOOKID']; ?>
)" title="<?php echo $this->_tpl_vars['MOD']['LBL_NOTEBOOK_TITLE']; ?>
">
	<span id="notebook_contents_<?php echo $this->_tpl_vars['NOTEBOOKID']; ?>
" width="100%"><?php echo $this->_tpl_vars['NOTEBOOK_CONTENTS']; ?>
</span>
</div>
<textarea id='notebook_textarea_<?php echo $this->_tpl_vars['NOTEBOOKID']; ?>
' onfocus='this.className="detailedViewTextBoxOn"' rows="18" onblur='saveContents(this, <?php echo $this->_tpl_vars['NOTEBOOKID']; ?>
)' style='display:none;width: 100%; overflow: auto; height:auto !important;min-height: 250px;height: 250px; padding-left: 2%; padding-right: 3%;' title="<?php echo $this->_tpl_vars['MOD']['LBL_NOTEBOOK_SAVE_TITLE']; ?>
"></textarea>
<span class="small" style="padding-left: 10px;display: block;" id="notebook_dbl_click_message">
	<font color="grey">
		<?php echo $this->_tpl_vars['MOD']['LBL_NOTEBOOK_TITLE']; ?>

	</font>
</span>
<span class="small" style="padding-left: 10px;display: none;" id="notebook_save_message">
	<font color="grey">
		<?php echo $this->_tpl_vars['MOD']['LBL_NOTEBOOK_SAVE_TITLE']; ?>

	</font>
</span>