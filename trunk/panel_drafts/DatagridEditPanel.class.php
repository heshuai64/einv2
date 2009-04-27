<?php
	// Include the classfile for DatagridEditPanelBase
	require(__PANELBASE_CLASSES__ . '/DatagridEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the Datagrid class.  It extends from the code-generated
	 * abstract DatagridEditPanelBase class.
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
	class DatagridEditPanel extends DatagridEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/DatagridEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objDatagrid = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objDatagrid, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>