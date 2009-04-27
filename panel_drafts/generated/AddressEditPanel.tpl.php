<?php
	// This is the HTML template include file (.tpl.php) for the address_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
		<?php $_CONTROL->lblAddressId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstCompany->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtShortDescription->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstCountry->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtAddress1->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtAddress2->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtCity->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstStateProvince->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtPostalCode->RenderWithName(); ?>
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
