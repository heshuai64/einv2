<?php
	// Include the classfile for AuthorizationLevelEditPanelBase
	require(__PANELBASE_CLASSES__ . '/AuthorizationLevelEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the AuthorizationLevel class.  It extends from the code-generated
	 * abstract AuthorizationLevelEditPanelBase class.
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
	class AuthorizationLevelEditPanel extends AuthorizationLevelEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/AuthorizationLevelEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objAuthorizationLevel = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objAuthorizationLevel, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>