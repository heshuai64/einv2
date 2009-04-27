<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the RoleEntityQtypeCustomFieldAuthorization class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of RoleEntityQtypeCustomFieldAuthorization objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this RoleEntityQtypeCustomFieldAuthorizationListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class RoleEntityQtypeCustomFieldAuthorizationListPanelBase extends QPanel {
		public $dtgRoleEntityQtypeCustomFieldAuthorization;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colRoleEntityQtypeCustomFieldAuthorizationId;
		protected $colRoleId;
		protected $colEntityQtypeCustomFieldId;
		protected $colAuthorizationId;
		protected $colAuthorizedFlag;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgRoleEntityQtypeCustomFieldAuthorization_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colRoleEntityQtypeCustomFieldAuthorizationId = new QDataGridColumn(QApplication::Translate('Role Entity Qtype Custom Field Authorization Id'), '<?= $_ITEM->RoleEntityQtypeCustomFieldAuthorizationId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeCustomFieldAuthorization()->RoleEntityQtypeCustomFieldAuthorizationId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeCustomFieldAuthorization()->RoleEntityQtypeCustomFieldAuthorizationId, false)));
			$this->colRoleId = new QDataGridColumn(QApplication::Translate('Role Id'), '<?= $_CONTROL->ParentControl->dtgRoleEntityQtypeCustomFieldAuthorization_Role_Render($_ITEM); ?>');
			$this->colEntityQtypeCustomFieldId = new QDataGridColumn(QApplication::Translate('Entity Qtype Custom Field Id'), '<?= $_CONTROL->ParentControl->dtgRoleEntityQtypeCustomFieldAuthorization_EntityQtypeCustomField_Render($_ITEM); ?>');
			$this->colAuthorizationId = new QDataGridColumn(QApplication::Translate('Authorization Id'), '<?= $_CONTROL->ParentControl->dtgRoleEntityQtypeCustomFieldAuthorization_Authorization_Render($_ITEM); ?>');
			$this->colAuthorizedFlag = new QDataGridColumn(QApplication::Translate('Authorized Flag'), '<?= ($_ITEM->AuthorizedFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeCustomFieldAuthorization()->AuthorizedFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeCustomFieldAuthorization()->AuthorizedFlag, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgRoleEntityQtypeCustomFieldAuthorization_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgRoleEntityQtypeCustomFieldAuthorization_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeCustomFieldAuthorization()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeCustomFieldAuthorization()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgRoleEntityQtypeCustomFieldAuthorization_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeCustomFieldAuthorization()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeCustomFieldAuthorization()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgRoleEntityQtypeCustomFieldAuthorization = new QDataGrid($this);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->CellSpacing = 0;
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->CellPadding = 4;
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->BorderStyle = QBorderStyle::Solid;
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->BorderWidth = 1;
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->Paginator = new QPaginator($this->dtgRoleEntityQtypeCustomFieldAuthorization);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->SetDataBinder('dtgRoleEntityQtypeCustomFieldAuthorization_Bind', $this);

			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colEditLinkColumn);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colRoleEntityQtypeCustomFieldAuthorizationId);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colRoleId);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colEntityQtypeCustomFieldId);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colAuthorizationId);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colAuthorizedFlag);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colCreatedBy);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colCreationDate);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colModifiedBy);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('RoleEntityQtypeCustomFieldAuthorization');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgRoleEntityQtypeCustomFieldAuthorization_EditLinkColumn_Render(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			$strControlId = 'btnEdit' . $this->dtgRoleEntityQtypeCustomFieldAuthorization->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgRoleEntityQtypeCustomFieldAuthorization, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objRoleEntityQtypeCustomFieldAuthorization->RoleEntityQtypeCustomFieldAuthorizationId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objRoleEntityQtypeCustomFieldAuthorization = RoleEntityQtypeCustomFieldAuthorization::Load($strParameterArray[0]);

			$objEditPanel = new RoleEntityQtypeCustomFieldAuthorizationEditPanel($this, $this->strCloseEditPanelMethod, $objRoleEntityQtypeCustomFieldAuthorization);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new RoleEntityQtypeCustomFieldAuthorizationEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgRoleEntityQtypeCustomFieldAuthorization_Role_Render(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if (!is_null($objRoleEntityQtypeCustomFieldAuthorization->Role))
				return $objRoleEntityQtypeCustomFieldAuthorization->Role->__toString();
			else
				return null;
		}

		public function dtgRoleEntityQtypeCustomFieldAuthorization_EntityQtypeCustomField_Render(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if (!is_null($objRoleEntityQtypeCustomFieldAuthorization->EntityQtypeCustomField))
				return $objRoleEntityQtypeCustomFieldAuthorization->EntityQtypeCustomField->__toString();
			else
				return null;
		}

		public function dtgRoleEntityQtypeCustomFieldAuthorization_Authorization_Render(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if (!is_null($objRoleEntityQtypeCustomFieldAuthorization->Authorization))
				return $objRoleEntityQtypeCustomFieldAuthorization->Authorization->__toString();
			else
				return null;
		}

		public function dtgRoleEntityQtypeCustomFieldAuthorization_CreatedByObject_Render(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if (!is_null($objRoleEntityQtypeCustomFieldAuthorization->CreatedByObject))
				return $objRoleEntityQtypeCustomFieldAuthorization->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgRoleEntityQtypeCustomFieldAuthorization_CreationDate_Render(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if (!is_null($objRoleEntityQtypeCustomFieldAuthorization->CreationDate))
				return $objRoleEntityQtypeCustomFieldAuthorization->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgRoleEntityQtypeCustomFieldAuthorization_ModifiedByObject_Render(RoleEntityQtypeCustomFieldAuthorization $objRoleEntityQtypeCustomFieldAuthorization) {
			if (!is_null($objRoleEntityQtypeCustomFieldAuthorization->ModifiedByObject))
				return $objRoleEntityQtypeCustomFieldAuthorization->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgRoleEntityQtypeCustomFieldAuthorization_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->TotalItemCount = RoleEntityQtypeCustomFieldAuthorization::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgRoleEntityQtypeCustomFieldAuthorization->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgRoleEntityQtypeCustomFieldAuthorization->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgRoleEntityQtypeCustomFieldAuthorization->DataSource = RoleEntityQtypeCustomFieldAuthorization::LoadAll($objClauses);
		}
	}
?>