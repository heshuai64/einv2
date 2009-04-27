<?php
	// Include the classfile for ContactEditPanelBase
	require(__PANELBASE_CLASSES__ . '/ContactEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the Contact class.  It extends from the code-generated
	 * abstract ContactEditPanelBase class.
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
	class ContactEditPanel extends ContactEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/ContactEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objContact = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objContact, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>