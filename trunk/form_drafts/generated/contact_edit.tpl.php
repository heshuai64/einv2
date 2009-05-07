<?php
	// This is the HTML template include file (.tpl.php) for the contact_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.

	$strPageTitle = $this->strTitleVerb . ' Contact';
	require(__INCLUDES__ . '/header.inc.php')
?>

	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _p($this->strTitleVerb); ?></div>
		<div class="title"><?php _t('Contact')?></div>
		<br class="item_divider" />

		<?php $this->lblContactId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstCompany->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstAddress->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtFirstName->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtLastName->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtTitle->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtEmail->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtPhoneOffice->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtPhoneHome->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtPhoneMobile->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtFax->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtDescription->RenderWithName("Rows=10"); ?>
		<br class="item_divider" />

		<?php $this->lstCreatedByObject->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->calCreationDate->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstModifiedByObject->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lblModifiedDate->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $this->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $this->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $this->btnDelete->Render() ?>

	<?php $this->RenderEnd() ?>	

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>