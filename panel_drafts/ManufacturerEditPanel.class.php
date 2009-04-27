<?php
	// Include the classfile for ManufacturerEditPanelBase
	require(__PANELBASE_CLASSES__ . '/ManufacturerEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the Manufacturer class.  It extends from the code-generated
	 * abstract ManufacturerEditPanelBase class.
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
	class ManufacturerEditPanel extends ManufacturerEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/ManufacturerEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objManufacturer = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objManufacturer, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>