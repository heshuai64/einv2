<?php
	// This is the HTML template include file (.tpl.php) for the custom_field_value_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
		<?php $_CONTROL->lblCustomFieldValueId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstCustomField->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtShortDescription->RenderWithName("Rows=10"); ?>
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
