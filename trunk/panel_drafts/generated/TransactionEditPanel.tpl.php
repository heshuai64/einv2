<?php
	// This is the HTML template include file (.tpl.php) for the transaction_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
		<?php $_CONTROL->lblTransactionId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstEntityQtype->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstTransactionType->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtNote->RenderWithName("Rows=10"); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstCreatedByObject->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->calCreationDate->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstModifiedByObject->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lblModifiedDate->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstReceipt->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstShipment->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $_CONTROL->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnDelete->Render() ?>
