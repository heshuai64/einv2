<?php
	// Include the classfile for EntityQtypeCustomFieldEditPanelBase
	require(__PANELBASE_CLASSES__ . '/EntityQtypeCustomFieldEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the EntityQtypeCustomField class.  It extends from the code-generated
	 * abstract EntityQtypeCustomFieldEditPanelBase class.
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
	class EntityQtypeCustomFieldEditPanel extends EntityQtypeCustomFieldEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/EntityQtypeCustomFieldEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objEntityQtypeCustomField = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objEntityQtypeCustomField, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>