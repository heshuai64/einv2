<?php
	// This is the HTML template include file (.tpl.php) for the asset_transaction_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.

	$strPageTitle = $this->strTitleVerb . ' AssetTransaction';
	require(__INCLUDES__ . '/header.inc.php')
?>

	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _p($this->strTitleVerb); ?></div>
		<div class="title"><?php _t('AssetTransaction')?></div>
		<br class="item_divider" />

		<?php $this->lblAssetTransactionId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstAsset->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstTransaction->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstParentAssetTransaction->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstSourceLocation->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstDestinationLocation->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkNewAssetFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstNewAsset->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkScheduleReceiptFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->calScheduleReceiptDueDate->RenderWithName(); ?>
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