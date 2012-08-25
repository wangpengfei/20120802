<?php /* Smarty version 2.6.18, created on 2012-06-04 09:57:32
         compiled from modules/ModApprovals/widgets/DetailViewBlockApprovalItem.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'nl2br', 'modules/ModApprovals/widgets/DetailViewBlockApprovalItem.tpl', 11, false),)), $this); ?>
<div class="dataField" style="width: 98%; margin-top:2px;padding: 5px; background-color: rgb(236, 237, 232);" valign="top"  >
	<font color="darkred" ><b>
	<?php echo smarty_modifier_nl2br($this->_tpl_vars['APPROVALMODEL']->content()); ?>
   
	</b></font>
</div>
<div class="dataLabel" style="border-bottom: 1px dotted rgb(204, 204, 204); width: 99%; padding-bottom: 5px;" valign="top">
	<font color="gray"><em>
		<?php echo $this->_tpl_vars['MOD']['LBL_AUTHOR']; ?>
: <u> <?php echo $this->_tpl_vars['APPROVALMODEL']->author(); ?>
 </u>  &nbsp;<?php echo $this->_tpl_vars['MOD']['LBL_ON']; ?>
&nbsp; <u> <?php echo $this->_tpl_vars['APPROVALMODEL']->timestamp(); ?>
  </u>   &nbsp;&nbsp;&nbsp;  <span align='right'><?php echo $this->_tpl_vars['MOD']['NextApprover']; ?>
 <u>  <?php if ($this->_tpl_vars['APPROVALMODEL']->reports_to_name() != ''): ?> <?php echo $this->_tpl_vars['APPROVALMODEL']->reports_to_name(); ?>
&nbsp;&nbsp; <img src="themes/images/arrownext.jpg"  border=0 align="absmiddle" ><?php else: ?><?php echo $this->_tpl_vars['MOD']['LBL_ENDAPPROVAL']; ?>
&nbsp;&nbsp;<img src="themes/images/approval.gif" border=0 align="absmiddle"><hr><?php endif; ?></u> </span>
	</em></font>
</div>