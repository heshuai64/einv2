<?php
	// Include the classfile for InventoryTransactionEditPanelBase
	require(__PANELBASE_CLASSES__ . '/InventoryTransactionEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the InventoryTransaction class.  It extends from the code-generated
	 * abstract InventoryTransactionEditPanelBase class.
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
	class InventoryTransactionEditPanel extends InventoryTransactionEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/InventoryTransactionEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objInventoryTransaction = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objInventoryTransaction, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>