<?php
	// This is the HTML template include file (.tpl.php) for the audit_scan_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.

	$strPageTitle = $this->strTitleVerb . ' AuditScan';
	require(__INCLUDES__ . '/header.inc.php')
?>

	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _p($this->strTitleVerb); ?></div>
		<div class="title"><?php _t('AuditScan')?></div>
		<br class="item_divider" />

		<?php $this->lblAuditScanId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstAudit->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstLocation->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtEntityId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtCount->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtSystemCount->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $this->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $this->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $this->btnDelete->Render() ?>

	<?php $this->RenderEnd() ?>	

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>