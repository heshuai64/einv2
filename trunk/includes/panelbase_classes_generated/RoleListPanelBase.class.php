<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Role class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Role objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this RoleListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class RoleListPanelBase extends QPanel {
		public $dtgRole;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colRoleId;
		protected $colShortDescription;
		protected $colLongDescription;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgRole_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colRoleId = new QDataGridColumn(QApplication::Translate('Role Id'), '<?= $_ITEM->RoleId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Role()->RoleId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Role()->RoleId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Role()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Role()->ShortDescription, false)));
			$this->colLongDescription = new QDataGridColumn(QApplication::Translate('Long Description'), '<?= QString::Truncate($_ITEM->LongDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Role()->LongDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Role()->LongDescription, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgRole_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgRole_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Role()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Role()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgRole_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Role()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Role()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgRole = new QDataGrid($this);
			$this->dtgRole->CellSpacing = 0;
			$this->dtgRole->CellPadding = 4;
			$this->dtgRole->BorderStyle = QBorderStyle::Solid;
			$this->dtgRole->BorderWidth = 1;
			$this->dtgRole->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgRole->Paginator = new QPaginator($this->dtgRole);
			$this->dtgRole->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgRole->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgRole->SetDataBinder('dtgRole_Bind', $this);

			$this->dtgRole->AddColumn($this->colEditLinkColumn);
			$this->dtgRole->AddColumn($this->colRoleId);
			$this->dtgRole->AddColumn($this->colShortDescription);
			$this->dtgRole->AddColumn($this->colLongDescription);
			$this->dtgRole->AddColumn($this->colCreatedBy);
			$this->dtgRole->AddColumn($this->colCreationDate);
			$this->dtgRole->AddColumn($this->colModifiedBy);
			$this->dtgRole->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Role');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgRole_EditLinkColumn_Render(Role $objRole) {
			$strControlId = 'btnEdit' . $this->dtgRole->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgRole, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objRole->RoleId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objRole = Role::Load($strParameterArray[0]);

			$objEditPanel = new RoleEditPanel($this, $this->strCloseEditPanelMethod, $objRole);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new RoleEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgRole_CreatedByObject_Render(Role $objRole) {
			if (!is_null($objRole->CreatedByObject))
				return $objRole->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgRole_CreationDate_Render(Role $objRole) {
			if (!is_null($objRole->CreationDate))
				return $objRole->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgRole_ModifiedByObject_Render(Role $objRole) {
			if (!is_null($objRole->ModifiedByObject))
				return $objRole->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgRole_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgRole->TotalItemCount = Role::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgRole->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgRole->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgRole->DataSource = Role::LoadAll($objClauses);
		}
	}
?>