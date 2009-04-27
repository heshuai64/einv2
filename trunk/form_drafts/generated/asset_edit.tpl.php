<?php
	// This is the HTML template include file (.tpl.php) for the asset_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.

	$strPageTitle = $this->strTitleVerb . ' Asset';
	require(__INCLUDES__ . '/header.inc.php')
?>

	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _p($this->strTitleVerb); ?></div>
		<div class="title"><?php _t('Asset')?></div>
		<br class="item_divider" />

		<?php $this->lblAssetId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstAssetModel->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstLocation->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtAssetCode->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtImagePath->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkCheckedOutFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkReservedFlag->RenderWithName(); ?>
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