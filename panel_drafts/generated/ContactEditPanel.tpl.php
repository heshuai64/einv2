<?php
	// This is the HTML template include file (.tpl.php) for the contact_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
		<?php $_CONTROL->lblContactId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstCompany->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstAddress->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtFirstName->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtLastName->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtTitle->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtEmail->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtPhoneOffice->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtPhoneHome->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtPhoneMobile->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtFax->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtDescription->RenderWithName("Rows=10"); ?>
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
