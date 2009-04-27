<?php
	// This is the HTML template include file (.tpl.php) for the shortcut_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
		<?php $_CONTROL->lblShortcutId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstModule->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstAuthorization->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtShortDescription->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtLink->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtImagePath->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstEntityQtype->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkCreateFlag->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $_CONTROL->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnDelete->Render() ?>
