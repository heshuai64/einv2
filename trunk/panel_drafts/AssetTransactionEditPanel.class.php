<?php
	// Include the classfile for AssetTransactionEditPanelBase
	require(__PANELBASE_CLASSES__ . '/AssetTransactionEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the AssetTransaction class.  It extends from the code-generated
	 * abstract AssetTransactionEditPanelBase class.
	 *
	 * Any display customizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 *
	 * Additional qform control objects can also be defined and used here, as well.
	 * 
	 * @package My Application
	 * @subpackage PanelDraftObjects
	 * 
	 */
	class AssetTransactionEditPanel extends AssetTransactionEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/AssetTransactionEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objAssetTransaction = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objAssetTransaction, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>