<?php
	// This is the HTML template include file (.tpl.php) for the inventory_model_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.

	$strPageTitle = $this->strTitleVerb . ' InventoryModel';
	require(__INCLUDES__ . '/header.inc.php')
?>

	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _p($this->strTitleVerb); ?></div>
		<div class="title"><?php _t('InventoryModel')?></div>
		<br class="item_divider" />

		<?php $this->lblInventoryModelId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstCategory->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstManufacturer->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtInventoryModelCode->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtShortDescription->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtLongDescription->RenderWithName("Rows=10"); ?>
		<br class="item_divider" />

		<?php $this->txtImagePath->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtPrice->RenderWithName(); ?>
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