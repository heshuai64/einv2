<?php
	// This is the HTML template include file (.tpl.php) for the asset_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
		<?php $_CONTROL->lblAssetId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstAssetModel->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstLocation->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtAssetCode->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtImagePath->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkCheckedOutFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkReservedFlag->RenderWithName(); ?>
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
