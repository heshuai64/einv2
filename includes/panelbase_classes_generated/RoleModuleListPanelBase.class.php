<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the RoleModule class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of RoleModule objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this RoleModuleListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class RoleModuleListPanelBase extends QPanel {
		public $dtgRoleModule;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colRoleModuleId;
		protected $colRoleId;
		protected $colModuleId;
		protected $colAccessFlag;
		protected $colCreatedBy;
		protected $colCreationDate;
		protected $colModifiedBy;
		protected $colModifiedDate;

		public function __construct($objParentObject, $strSetEditPanelMethod, $strCloseEditPanelMethod, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Record Method Callbacks
			$this->strSetEditPanelMethod = $strSetEditPanelMethod;
			$this->strCloseEditPanelMethod = $strCloseEditPanelMethod;

			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgRoleModule_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colRoleModuleId = new QDataGridColumn(QApplication::Translate('Role Module Id'), '<?= $_ITEM->RoleModuleId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleModule()->RoleModuleId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleModule()->RoleModuleId, false)));
			$this->colRoleId = new QDataGridColumn(QApplication::Translate('Role Id'), '<?= $_CONTROL->ParentControl->dtgRoleModule_Role_Render($_ITEM); ?>');
			$this->colModuleId = new QDataGridColumn(QApplication::Translate('Module Id'), '<?= $_CONTROL->ParentControl->dtgRoleModule_Module_Render($_ITEM); ?>');
			$this->colAccessFlag = new QDataGridColumn(QApplication::Translate('Access Flag'), '<?= ($_ITEM->AccessFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleModule()->AccessFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleModule()->AccessFlag, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgRoleModule_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgRoleModule_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleModule()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleModule()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgRoleModule_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleModule()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleModule()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgRoleModule = new QDataGrid($this);
			$this->dtgRoleModule->CellSpacing = 0;
			$this->dtgRoleModule->CellPadding = 4;
			$this->dtgRoleModule->BorderStyle = QBorderStyle::Solid;
			$this->dtgRoleModule->BorderWidth = 1;
			$this->dtgRoleModule->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgRoleModule->Paginator = new QPaginator($this->dtgRoleModule);
			$this->dtgRoleModule->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgRoleModule->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgRoleModule->SetDataBinder('dtgRoleModule_Bind', $this);

			$this->dtgRoleModule->AddColumn($this->colEditLinkColumn);
			$this->dtgRoleModule->AddColumn($this->colRoleModuleId);
			$this->dtgRoleModule->AddColumn($this->colRoleId);
			$this->dtgRoleModule->AddColumn($this->colModuleId);
			$this->dtgRoleModule->AddColumn($this->colAccessFlag);
			$this->dtgRoleModule->AddColumn($this->colCreatedBy);
			$this->dtgRoleModule->AddColumn($this->colCreationDate);
			$this->dtgRoleModule->AddColumn($this->colModifiedBy);
			$this->dtgRoleModule->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('RoleModule');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgRoleModule_EditLinkColumn_Render(RoleModule $objRoleModule) {
			$strControlId = 'btnEdit' . $this->dtgRoleModule->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgRoleModule, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objRoleModule->RoleModuleId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objRoleModule = RoleModule::Load($strParameterArray[0]);

			$objEditPanel = new RoleModuleEditPanel($this, $this->strCloseEditPanelMethod, $objRoleModule);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new RoleModuleEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgRoleModule_Role_Render(RoleModule $objRoleModule) {
			if (!is_null($objRoleModule->Role))
				return $objRoleModule->Role->__toString();
			else
				return null;
		}

		public function dtgRoleModule_Module_Render(RoleModule $objRoleModule) {
			if (!is_null($objRoleModule->Module))
				return $objRoleModule->Module->__toString();
			else
				return null;
		}

		public function dtgRoleModule_CreatedByObject_Render(RoleModule $objRoleModule) {
			if (!is_null($objRoleModule->CreatedByObject))
				return $objRoleModule->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgRoleModule_CreationDate_Render(RoleModule $objRoleModule) {
			if (!is_null($objRoleModule->CreationDate))
				return $objRoleModule->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgRoleModule_ModifiedByObject_Render(RoleModule $objRoleModule) {
			if (!is_null($objRoleModule->ModifiedByObject))
				return $objRoleModule->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgRoleModule_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgRoleModule->TotalItemCount = RoleModule::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgRoleModule->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgRoleModule->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgRoleModule->DataSource = RoleModule::LoadAll($objClauses);
		}
	}
?>