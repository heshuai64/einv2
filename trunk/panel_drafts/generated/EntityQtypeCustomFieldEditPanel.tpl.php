<?php
	// This is the HTML template include file (.tpl.php) for the entity_qtype_custom_field_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
		<?php $_CONTROL->lblEntityQtypeCustomFieldId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstEntityQtype->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstCustomField->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $_CONTROL->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnDelete->Render() ?>
