<?php
	// This is the HTML template include file (.tpl.php) for the datagrid_column_preference_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.

	$strPageTitle = $this->strTitleVerb . ' DatagridColumnPreference';
	require(__INCLUDES__ . '/header.inc.php')
?>

	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _p($this->strTitleVerb); ?></div>
		<div class="title"><?php _t('DatagridColumnPreference')?></div>
		<br class="item_divider" />

		<?php $this->lblDatagridColumnPreferenceId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstDatagrid->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtColumnName->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstUserAccount->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkDisplayFlag->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $this->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $this->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $this->btnDelete->Render() ?>

	<?php $this->RenderEnd() ?>	

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>