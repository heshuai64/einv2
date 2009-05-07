<?php
	// This is the HTML template include file (.tpl.php) for the fedex_shipment_list.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.

	$strPageTitle = QApplication::Translate('List All') . ' FedexShipments';
	require(__INCLUDES__ . '/header.inc.php')
?>

	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _t('List All'); ?></div>
		<div class="title"><?php _t('FedexShipments'); ?></div>
		<br class="item_divider" />

		<?php $this->dtgFedexShipment->Render() ?>
		<br />
		<a href="fedex_shipment_edit.php"><?php _t('Create a New'); ?> <?php _t('FedexShipment');?></a>
		 &nbsp;|&nbsp;
		<a href="<?php _p(__VIRTUAL_DIRECTORY__ . __FORM_DRAFTS__) ?>/index.php"><?php _t('Go to "Form Drafts"'); ?></a>

	<?php $this->RenderEnd() ?>
	
<?php require(__INCLUDES__ . '/footer.inc.php'); ?>