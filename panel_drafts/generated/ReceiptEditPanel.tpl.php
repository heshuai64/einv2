<?php
	// This is the HTML template include file (.tpl.php) for the receipt_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
		<?php $_CONTROL->lblReceiptId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstTransaction->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstFromCompany->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstFromContact->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstToContact->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstToAddress->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtReceiptNumber->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->calDueDate->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->calReceiptDate->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkReceivedFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstCreatedByObject->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->calCreationDate->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstModifiedByObject->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lblModifiedDate->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $_CONTROL->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnDelete->Render() ?>
