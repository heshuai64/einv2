<?php
	// This is the HTML template include file (.tpl.php) for the address_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.

	$strPageTitle = $this->strTitleVerb . ' Address';
	require(__INCLUDES__ . '/header.inc.php')
?>

	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _p($this->strTitleVerb); ?></div>
		<div class="title"><?php _t('Address')?></div>
		<br class="item_divider" />

		<?php $this->lblAddressId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstCompany->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtShortDescription->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstCountry->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtAddress1->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtAddress2->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtCity->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstStateProvince->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtPostalCode->RenderWithName(); ?>
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