<?php
	// Include the classfile for RoleModuleAuthorizationEditPanelBase
	require(__PANELBASE_CLASSES__ . '/RoleModuleAuthorizationEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the RoleModuleAuthorization class.  It extends from the code-generated
	 * abstract RoleModuleAuthorizationEditPanelBase class.
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
	class RoleModuleAuthorizationEditPanel extends RoleModuleAuthorizationEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/RoleModuleAuthorizationEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objRoleModuleAuthorization = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objRoleModuleAuthorization, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>