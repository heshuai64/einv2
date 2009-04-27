<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the RoleEntityQtypeBuiltInAuthorization class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of RoleEntityQtypeBuiltInAuthorization objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this RoleEntityQtypeBuiltInAuthorizationListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class RoleEntityQtypeBuiltInAuthorizationListPanelBase extends QPanel {
		public $dtgRoleEntityQtypeBuiltInAuthorization;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colRoleEntityBuiltInId;
		protected $colRoleId;
		protected $colEntityQtypeId;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgRoleEntityQtypeBuiltInAuthorization_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colRoleEntityBuiltInId = new QDataGridColumn(QApplication::Translate('Role Entity Built In Id'), '<?= $_ITEM->RoleEntityBuiltInId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->RoleEntityBuiltInId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->RoleEntityBuiltInId, false)));
			$this->colRoleId = new QDataGridColumn(QApplication::Translate('Role Id'), '<?= $_CONTROL->ParentControl->dtgRoleEntityQtypeBuiltInAuthorization_Role_Render($_ITEM); ?>');
			$this->colEntityQtypeId = new QDataGridColumn(QApplication::Translate('Entity Qtype'), '<?= $_CONTROL->ParentControl->dtgRoleEntityQtypeBuiltInAuthorization_EntityQtypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->EntityQtypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->EntityQtypeId, false)));
			$this->colAuthorizationId = new QDataGridColumn(QApplication::Translate('Authorization Id'), '<?= $_CONTROL->ParentControl->dtgRoleEntityQtypeBuiltInAuthorization_Authorization_Render($_ITEM); ?>');
			$this->colAuthorizedFlag = new QDataGridColumn(QApplication::Translate('Authorized Flag'), '<?= ($_ITEM->AuthorizedFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->AuthorizedFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->AuthorizedFlag, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgRoleEntityQtypeBuiltInAuthorization_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgRoleEntityQtypeBuiltInAuthorization_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgRoleEntityQtypeBuiltInAuthorization_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::RoleEntityQtypeBuiltInAuthorization()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgRoleEntityQtypeBuiltInAuthorization = new QDataGrid($this);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->CellSpacing = 0;
			$this->dtgRoleEntityQtypeBuiltInAuthorization->CellPadding = 4;
			$this->dtgRoleEntityQtypeBuiltInAuthorization->BorderStyle = QBorderStyle::Solid;
			$this->dtgRoleEntityQtypeBuiltInAuthorization->BorderWidth = 1;
			$this->dtgRoleEntityQtypeBuiltInAuthorization->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgRoleEntityQtypeBuiltInAuthorization->Paginator = new QPaginator($this->dtgRoleEntityQtypeBuiltInAuthorization);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgRoleEntityQtypeBuiltInAuthorization->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgRoleEntityQtypeBuiltInAuthorization->SetDataBinder('dtgRoleEntityQtypeBuiltInAuthorization_Bind', $this);

			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colEditLinkColumn);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colRoleEntityBuiltInId);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colRoleId);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colEntityQtypeId);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colAuthorizationId);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colAuthorizedFlag);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colCreatedBy);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colCreationDate);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colModifiedBy);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('RoleEntityQtypeBuiltInAuthorization');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgRoleEntityQtypeBuiltInAuthorization_EditLinkColumn_Render(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			$strControlId = 'btnEdit' . $this->dtgRoleEntityQtypeBuiltInAuthorization->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgRoleEntityQtypeBuiltInAuthorization, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objRoleEntityQtypeBuiltInAuthorization->RoleEntityBuiltInId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objRoleEntityQtypeBuiltInAuthorization = RoleEntityQtypeBuiltInAuthorization::Load($strParameterArray[0]);

			$objEditPanel = new RoleEntityQtypeBuiltInAuthorizationEditPanel($this, $this->strCloseEditPanelMethod, $objRoleEntityQtypeBuiltInAuthorization);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new RoleEntityQtypeBuiltInAuthorizationEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgRoleEntityQtypeBuiltInAuthorization_Role_Render(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			if (!is_null($objRoleEntityQtypeBuiltInAuthorization->Role))
				return $objRoleEntityQtypeBuiltInAuthorization->Role->__toString();
			else
				return null;
		}

		public function dtgRoleEntityQtypeBuiltInAuthorization_EntityQtypeId_Render(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			if (!is_null($objRoleEntityQtypeBuiltInAuthorization->EntityQtypeId))
				return EntityQtype::ToString($objRoleEntityQtypeBuiltInAuthorization->EntityQtypeId);
			else
				return null;
		}

		public function dtgRoleEntityQtypeBuiltInAuthorization_Authorization_Render(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			if (!is_null($objRoleEntityQtypeBuiltInAuthorization->Authorization))
				return $objRoleEntityQtypeBuiltInAuthorization->Authorization->__toString();
			else
				return null;
		}

		public function dtgRoleEntityQtypeBuiltInAuthorization_CreatedByObject_Render(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			if (!is_null($objRoleEntityQtypeBuiltInAuthorization->CreatedByObject))
				return $objRoleEntityQtypeBuiltInAuthorization->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgRoleEntityQtypeBuiltInAuthorization_CreationDate_Render(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			if (!is_null($objRoleEntityQtypeBuiltInAuthorization->CreationDate))
				return $objRoleEntityQtypeBuiltInAuthorization->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgRoleEntityQtypeBuiltInAuthorization_ModifiedByObject_Render(RoleEntityQtypeBuiltInAuthorization $objRoleEntityQtypeBuiltInAuthorization) {
			if (!is_null($objRoleEntityQtypeBuiltInAuthorization->ModifiedByObject))
				return $objRoleEntityQtypeBuiltInAuthorization->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgRoleEntityQtypeBuiltInAuthorization_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgRoleEntityQtypeBuiltInAuthorization->TotalItemCount = RoleEntityQtypeBuiltInAuthorization::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgRoleEntityQtypeBuiltInAuthorization->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgRoleEntityQtypeBuiltInAuthorization->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgRoleEntityQtypeBuiltInAuthorization->DataSource = RoleEntityQtypeBuiltInAuthorization::LoadAll($objClauses);
		}
	}
?>