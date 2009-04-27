<?php
	// Include the classfile for RoleModuleEditPanelBase
	require(__PANELBASE_CLASSES__ . '/RoleModuleEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the RoleModule class.  It extends from the code-generated
	 * abstract RoleModuleEditPanelBase class.
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
	class RoleModuleEditPanel extends RoleModuleEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/RoleModuleEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objRoleModule = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objRoleModule, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>