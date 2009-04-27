<?php
	// Include the classfile for RoleEntityQtypeCustomFieldAuthorizationEditPanelBase
	require(__PANELBASE_CLASSES__ . '/RoleEntityQtypeCustomFieldAuthorizationEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the RoleEntityQtypeCustomFieldAuthorization class.  It extends from the code-generated
	 * abstract RoleEntityQtypeCustomFieldAuthorizationEditPanelBase class.
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
	class RoleEntityQtypeCustomFieldAuthorizationEditPanel extends RoleEntityQtypeCustomFieldAuthorizationEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/RoleEntityQtypeCustomFieldAuthorizationEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objRoleEntityQtypeCustomFieldAuthorization = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objRoleEntityQtypeCustomFieldAuthorization, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>