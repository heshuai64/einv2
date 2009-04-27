<?php
	// This is the HTML template include file (.tpl.php) for the inventory_model_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
		<?php $_CONTROL->lblInventoryModelId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstCategory->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstManufacturer->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtInventoryModelCode->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtShortDescription->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtLongDescription->RenderWithName("Rows=10"); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtImagePath->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtPrice->RenderWithName(); ?>
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
