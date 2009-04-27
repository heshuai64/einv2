<?php
	// This is the HTML template include file (.tpl.php) for the attachment_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
		<?php $_CONTROL->lblAttachmentId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstEntityQtype->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtEntityId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtFilename->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtTmpFilename->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtFileType->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtPath->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtSize->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstCreatedByObject->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->calCreationDate->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $_CONTROL->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnDelete->Render() ?>
