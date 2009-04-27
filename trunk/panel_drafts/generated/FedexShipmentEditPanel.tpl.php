<?php
	// This is the HTML template include file (.tpl.php) for the fedex_shipment_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
		<?php $_CONTROL->lblFedexShipmentId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstShipment->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstPackageType->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstShippingAccount->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstFedexServiceType->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstCurrencyUnit->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstWeightUnit->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstLengthUnit->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtToPhone->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtPayType->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtPayerAccountNumber->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtPackageWeight->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtPackageLength->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtPackageWidth->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtPackageHeight->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtDeclaredValue->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtReference->RenderWithName("Rows=10"); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkSaturdayDeliveryFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtNotifySenderEmail->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkNotifySenderShipFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkNotifySenderExceptionFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkNotifySenderDeliveryFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtNotifyRecipientEmail->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkNotifyRecipientShipFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkNotifyRecipientExceptionFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkNotifyRecipientDeliveryFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtNotifyOtherEmail->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkNotifyOtherShipFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkNotifyOtherExceptionFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkNotifyOtherDeliveryFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkHoldAtLocationFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtHoldAtLocationAddress->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtHoldAtLocationCity->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstHoldAtLocationStateObject->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtHoldAtLocationPostalCode->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $_CONTROL->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnDelete->Render() ?>
