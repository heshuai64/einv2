<?php
	// This is the HTML template include file (.tpl.php) for the audit_scan_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
		<?php $_CONTROL->lblAuditScanId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstAudit->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstLocation->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtEntityId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtCount->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtSystemCount->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $_CONTROL->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnDelete->Render() ?>
