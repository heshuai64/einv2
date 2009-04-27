<?php
	// Include the classfile for RoleEntityQtypeBuiltInAuthorizationEditPanelBase
	require(__PANELBASE_CLASSES__ . '/RoleEntityQtypeBuiltInAuthorizationEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the RoleEntityQtypeBuiltInAuthorization class.  It extends from the code-generated
	 * abstract RoleEntityQtypeBuiltInAuthorizationEditPanelBase class.
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
	class RoleEntityQtypeBuiltInAuthorizationEditPanel extends RoleEntityQtypeBuiltInAuthorizationEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/RoleEntityQtypeBuiltInAuthorizationEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objRoleEntityQtypeBuiltInAuthorization = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objRoleEntityQtypeBuiltInAuthorization, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>