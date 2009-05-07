<?php
	// This is the HTML template include file (.tpl.php) for the shipment_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.

	$strPageTitle = $this->strTitleVerb . ' Shipment';
	require(__INCLUDES__ . '/header.inc.php')
?>

	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _p($this->strTitleVerb); ?></div>
		<div class="title"><?php _t('Shipment')?></div>
		<br class="item_divider" />

		<?php $this->lblShipmentId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtShipmentNumber->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstTransaction->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstFromCompany->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstFromContact->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstFromAddress->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstToCompany->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstToContact->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstToAddress->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstCourier->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtTrackingNumber->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->calShipDate->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkShippedFlag->RenderWithName(); ?>
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