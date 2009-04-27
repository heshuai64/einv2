<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the RoleModuleAuthorization class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of RoleModuleAuthorization objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this RoleModuleAuthorizationListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class RoleModuleAuthorizationListPanelBase extends QPanel {
		public $dtgRoleModuleAuthorization;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colRoleModuleAuthorizationId;
		protected $colRoleModuleId;
		protected $colAuthorizationId;
		protected $colAuthorizationLevelId;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgRoleModuleAuthorization_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colRoleModuleAuthorizationId = new QDataGridColumn(QApplication::Translate('Role Module Authorization Id'), '<?= $_ITEM->RoleModuleAuthorizationId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleModuleAuthorization()->RoleModuleAuthorizationId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleModuleAuthorization()->RoleModuleAuthorizationId, false)));
			$this->colRoleModuleId = new QDataGridColumn(QApplication::Translate('Role Module Id'), '<?= $_CONTROL->ParentControl->dtgRoleModuleAuthorization_RoleModule_Render($_ITEM); ?>');
			$this->colAuthorizationId = new QDataGridColumn(QApplication::Translate('Authorization Id'), '<?= $_CONTROL->ParentControl->dtgRoleModuleAuthorization_Authorization_Render($_ITEM); ?>');
			$this->colAuthorizationLevelId = new QDataGridColumn(QApplication::Translate('Authorization Level Id'), '<?= $_CONTROL->ParentControl->dtgRoleModuleAuthorization_AuthorizationLevel_Render($_ITEM); ?>');
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgRoleModuleAuthorization_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgRoleModuleAuthorization_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleModuleAuthorization()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleModuleAuthorization()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgRoleModuleAuthorization_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleModuleAuthorization()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleModuleAuthorization()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgRoleModuleAuthorization = new QDataGrid($this);
			$this->dtgRoleModuleAuthorization->CellSpacing = 0;
			$this->dtgRoleModuleAuthorization->CellPadding = 4;
			$this->dtgRoleModuleAuthorization->BorderStyle = QBorderStyle::Solid;
			$this->dtgRoleModuleAuthorization->BorderWidth = 1;
			$this->dtgRoleModuleAuthorization->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgRoleModuleAuthorization->Paginator = new QPaginator($this->dtgRoleModuleAuthorization);
			$this->dtgRoleModuleAuthorization->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgRoleModuleAuthorization->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgRoleModuleAuthorization->SetDataBinder('dtgRoleModuleAuthorization_Bind', $this);

			$this->dtgRoleModuleAuthorization->AddColumn($this->colEditLinkColumn);
			$this->dtgRoleModuleAuthorization->AddColumn($this->colRoleModuleAuthorizationId);
			$this->dtgRoleModuleAuthorization->AddColumn($this->colRoleModuleId);
			$this->dtgRoleModuleAuthorization->AddColumn($this->colAuthorizationId);
			$this->dtgRoleModuleAuthorization->AddColumn($this->colAuthorizationLevelId);
			$this->dtgRoleModuleAuthorization->AddColumn($this->colCreatedBy);
			$this->dtgRoleModuleAuthorization->AddColumn($this->colCreationDate);
			$this->dtgRoleModuleAuthorization->AddColumn($this->colModifiedBy);
			$this->dtgRoleModuleAuthorization->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('RoleModuleAuthorization');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgRoleModuleAuthorization_EditLinkColumn_Render(RoleModuleAuthorization $objRoleModuleAuthorization) {
			$strControlId = 'btnEdit' . $this->dtgRoleModuleAuthorization->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgRoleModuleAuthorization, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objRoleModuleAuthorization->RoleModuleAuthorizationId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objRoleModuleAuthorization = RoleModuleAuthorization::Load($strParameterArray[0]);

			$objEditPanel = new RoleModuleAuthorizationEditPanel($this, $this->strCloseEditPanelMethod, $objRoleModuleAuthorization);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new RoleModuleAuthorizationEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgRoleModuleAuthorization_RoleModule_Render(RoleModuleAuthorization $objRoleModuleAuthorization) {
			if (!is_null($objRoleModuleAuthorization->RoleModule))
				return $objRoleModuleAuthorization->RoleModule->__toString();
			else
				return null;
		}

		public function dtgRoleModuleAuthorization_Authorization_Render(RoleModuleAuthorization $objRoleModuleAuthorization) {
			if (!is_null($objRoleModuleAuthorization->Authorization))
				return $objRoleModuleAuthorization->Authorization->__toString();
			else
				return null;
		}

		public function dtgRoleModuleAuthorization_AuthorizationLevel_Render(RoleModuleAuthorization $objRoleModuleAuthorization) {
			if (!is_null($objRoleModuleAuthorization->AuthorizationLevel))
				return $objRoleModuleAuthorization->AuthorizationLevel->__toString();
			else
				return null;
		}

		public function dtgRoleModuleAuthorization_CreatedByObject_Render(RoleModuleAuthorization $objRoleModuleAuthorization) {
			if (!is_null($objRoleModuleAuthorization->CreatedByObject))
				return $objRoleModuleAuthorization->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgRoleModuleAuthorization_CreationDate_Render(RoleModuleAuthorization $objRoleModuleAuthorization) {
			if (!is_null($objRoleModuleAuthorization->CreationDate))
				return $objRoleModuleAuthorization->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgRoleModuleAuthorization_ModifiedByObject_Render(RoleModuleAuthorization $objRoleModuleAuthorization) {
			if (!is_null($objRoleModuleAuthorization->ModifiedByObject))
				return $objRoleModuleAuthorization->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgRoleModuleAuthorization_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgRoleModuleAuthorization->TotalItemCount = RoleModuleAuthorization::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgRoleModuleAuthorization->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgRoleModuleAuthorization->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgRoleModuleAuthorization->DataSource = RoleModuleAuthorization::LoadAll($objClauses);
		}
	}
?>