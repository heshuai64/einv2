<?php
	// This is the HTML template include file (.tpl.php) for the fedex_shipment_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.

	$strPageTitle = $this->strTitleVerb . ' FedexShipment';
	require(__INCLUDES__ . '/header.inc.php')
?>

	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _p($this->strTitleVerb); ?></div>
		<div class="title"><?php _t('FedexShipment')?></div>
		<br class="item_divider" />

		<?php $this->lblFedexShipmentId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstShipment->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstPackageType->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstShippingAccount->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstFedexServiceType->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstCurrencyUnit->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstWeightUnit->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstLengthUnit->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtToPhone->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtPayType->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtPayerAccountNumber->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtPackageWeight->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtPackageLength->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtPackageWidth->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtPackageHeight->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtDeclaredValue->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtReference->RenderWithName("Rows=10"); ?>
		<br class="item_divider" />

		<?php $this->chkSaturdayDeliveryFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtNotifySenderEmail->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkNotifySenderShipFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkNotifySenderExceptionFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkNotifySenderDeliveryFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtNotifyRecipientEmail->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkNotifyRecipientShipFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkNotifyRecipientExceptionFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkNotifyRecipientDeliveryFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtNotifyOtherEmail->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkNotifyOtherShipFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkNotifyOtherExceptionFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkNotifyOtherDeliveryFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkHoldAtLocationFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtHoldAtLocationAddress->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtHoldAtLocationCity->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstHoldAtLocationStateObject->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtHoldAtLocationPostalCode->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $this->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $this->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $this->btnDelete->Render() ?>

	<?php $this->RenderEnd() ?>	

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>