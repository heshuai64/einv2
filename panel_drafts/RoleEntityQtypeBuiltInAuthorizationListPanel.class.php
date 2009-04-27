<?php
	// Include the classfile for RoleEntityQtypeBuiltInAuthorizationListPanelBase
	require(__PANELBASE_CLASSES__ . '/RoleEntityQtypeBuiltInAuthorizationListPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do the List All functionality
	 * of the RoleEntityQtypeBuiltInAuthorization class.  It extends from the code-generated
	 * abstract RoleEntityQtypeBuiltInAuthorizationListPanelBase class.
	 *
	 * Any display customizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 *
	 * Additional qpanel control objects can also be defined and used here, as well.
	 * 
	 * @package My Application
	 * @subpackage PanelDraftObjects
	 * 
	 */
	class RoleEntityQtypeBuiltInAuthorizationListPanel extends RoleEntityQtypeBuiltInAuthorizationListPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/RoleEntityQtypeBuiltInAuthorizationListPanel.tpl.php';

		// Override Control methods as Needed
/*
		public function __construct($objParentObject, $strSetEditPanelMethod, $strCloseEditPanelMethod, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strSetEditPanelMethod, $strCloseEditPanelMethod, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>