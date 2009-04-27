<?php
	// Include the classfile for RoleEditPanelBase
	require(__PANELBASE_CLASSES__ . '/RoleEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the Role class.  It extends from the code-generated
	 * abstract RoleEditPanelBase class.
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
	class RoleEditPanel extends RoleEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/RoleEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objRole = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objRole, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>