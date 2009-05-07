<?php
	// This is the HTML template include file (.tpl.php) for the shipping_account_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.

	$strPageTitle = $this->strTitleVerb . ' ShippingAccount';
	require(__INCLUDES__ . '/header.inc.php')
?>

	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _p($this->strTitleVerb); ?></div>
		<div class="title"><?php _t('ShippingAccount')?></div>
		<br class="item_divider" />

		<?php $this->lblShippingAccountId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstCourier->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtShortDescription->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtAccessId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtAccessCode->RenderWithName(); ?>
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