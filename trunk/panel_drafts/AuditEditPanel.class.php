<?php
	// Include the classfile for AuditEditPanelBase
	require(__PANELBASE_CLASSES__ . '/AuditEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the Audit class.  It extends from the code-generated
	 * abstract AuditEditPanelBase class.
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
	class AuditEditPanel extends AuditEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/AuditEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objAudit = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objAudit, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>