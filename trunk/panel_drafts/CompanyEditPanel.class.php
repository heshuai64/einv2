<?php
	// Include the classfile for CompanyEditPanelBase
	require(__PANELBASE_CLASSES__ . '/CompanyEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the Company class.  It extends from the code-generated
	 * abstract CompanyEditPanelBase class.
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
	class CompanyEditPanel extends CompanyEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/CompanyEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objCompany = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objCompany, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>