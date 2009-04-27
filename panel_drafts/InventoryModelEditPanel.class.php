<?php
	// Include the classfile for InventoryModelEditPanelBase
	require(__PANELBASE_CLASSES__ . '/InventoryModelEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the InventoryModel class.  It extends from the code-generated
	 * abstract InventoryModelEditPanelBase class.
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
	class InventoryModelEditPanel extends InventoryModelEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/InventoryModelEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objInventoryModel = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objInventoryModel, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>