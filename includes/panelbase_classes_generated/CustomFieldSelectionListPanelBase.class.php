<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the CustomFieldSelection class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of CustomFieldSelection objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this CustomFieldSelectionListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class CustomFieldSelectionListPanelBase extends QPanel {
		public $dtgCustomFieldSelection;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colCustomFieldSelectionId;
		protected $colCustomFieldValueId;
		protected $colEntityQtypeId;
		protected $colEntityId;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgCustomFieldSelection_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colCustomFieldSelectionId = new QDataGridColumn(QApplication::Translate('Custom Field Selection Id'), '<?= $_ITEM->CustomFieldSelectionId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::CustomFieldSelection()->CustomFieldSelectionId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CustomFieldSelection()->CustomFieldSelectionId, false)));
			$this->colCustomFieldValueId = new QDataGridColumn(QApplication::Translate('Custom Field Value Id'), '<?= $_CONTROL->ParentControl->dtgCustomFieldSelection_CustomFieldValue_Render($_ITEM); ?>');
			$this->colEntityQtypeId = new QDataGridColumn(QApplication::Translate('Entity Qtype'), '<?= $_CONTROL->ParentControl->dtgCustomFieldSelection_EntityQtypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::CustomFieldSelection()->EntityQtypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CustomFieldSelection()->EntityQtypeId, false)));
			$this->colEntityId = new QDataGridColumn(QApplication::Translate('Entity Id'), '<?= $_ITEM->EntityId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::CustomFieldSelection()->EntityId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CustomFieldSelection()->EntityId, false)));

			// Setup DataGrid
			$this->dtgCustomFieldSelection = new QDataGrid($this);
			$this->dtgCustomFieldSelection->CellSpacing = 0;
			$this->dtgCustomFieldSelection->CellPadding = 4;
			$this->dtgCustomFieldSelection->BorderStyle = QBorderStyle::Solid;
			$this->dtgCustomFieldSelection->BorderWidth = 1;
			$this->dtgCustomFieldSelection->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgCustomFieldSelection->Paginator = new QPaginator($this->dtgCustomFieldSelection);
			$this->dtgCustomFieldSelection->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgCustomFieldSelection->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgCustomFieldSelection->SetDataBinder('dtgCustomFieldSelection_Bind', $this);

			$this->dtgCustomFieldSelection->AddColumn($this->colEditLinkColumn);
			$this->dtgCustomFieldSelection->AddColumn($this->colCustomFieldSelectionId);
			$this->dtgCustomFieldSelection->AddColumn($this->colCustomFieldValueId);
			$this->dtgCustomFieldSelection->AddColumn($this->colEntityQtypeId);
			$this->dtgCustomFieldSelection->AddColumn($this->colEntityId);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('CustomFieldSelection');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgCustomFieldSelection_EditLinkColumn_Render(CustomFieldSelection $objCustomFieldSelection) {
			$strControlId = 'btnEdit' . $this->dtgCustomFieldSelection->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgCustomFieldSelection, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objCustomFieldSelection->CustomFieldSelectionId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objCustomFieldSelection = CustomFieldSelection::Load($strParameterArray[0]);

			$objEditPanel = new CustomFieldSelectionEditPanel($this, $this->strCloseEditPanelMethod, $objCustomFieldSelection);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new CustomFieldSelectionEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgCustomFieldSelection_CustomFieldValue_Render(CustomFieldSelection $objCustomFieldSelection) {
			if (!is_null($objCustomFieldSelection->CustomFieldValue))
				return $objCustomFieldSelection->CustomFieldValue->__toString();
			else
				return null;
		}

		public function dtgCustomFieldSelection_EntityQtypeId_Render(CustomFieldSelection $objCustomFieldSelection) {
			if (!is_null($objCustomFieldSelection->EntityQtypeId))
				return EntityQtype::ToString($objCustomFieldSelection->EntityQtypeId);
			else
				return null;
		}


		public function dtgCustomFieldSelection_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgCustomFieldSelection->TotalItemCount = CustomFieldSelection::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgCustomFieldSelection->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgCustomFieldSelection->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgCustomFieldSelection->DataSource = CustomFieldSelection::LoadAll($objClauses);
		}
	}
?>