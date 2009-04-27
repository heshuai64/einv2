<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the CustomFieldValue class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of CustomFieldValue objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this CustomFieldValueListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class CustomFieldValueListPanelBase extends QPanel {
		public $dtgCustomFieldValue;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colCustomFieldValueId;
		protected $colCustomFieldId;
		protected $colShortDescription;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgCustomFieldValue_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colCustomFieldValueId = new QDataGridColumn(QApplication::Translate('Custom Field Value Id'), '<?= $_ITEM->CustomFieldValueId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::CustomFieldValue()->CustomFieldValueId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CustomFieldValue()->CustomFieldValueId, false)));
			$this->colCustomFieldId = new QDataGridColumn(QApplication::Translate('Custom Field Id'), '<?= $_CONTROL->ParentControl->dtgCustomFieldValue_CustomField_Render($_ITEM); ?>');
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::CustomFieldValue()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CustomFieldValue()->ShortDescription, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgCustomFieldValue_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgCustomFieldValue_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::CustomFieldValue()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CustomFieldValue()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgCustomFieldValue_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::CustomFieldValue()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CustomFieldValue()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgCustomFieldValue = new QDataGrid($this);
			$this->dtgCustomFieldValue->CellSpacing = 0;
			$this->dtgCustomFieldValue->CellPadding = 4;
			$this->dtgCustomFieldValue->BorderStyle = QBorderStyle::Solid;
			$this->dtgCustomFieldValue->BorderWidth = 1;
			$this->dtgCustomFieldValue->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgCustomFieldValue->Paginator = new QPaginator($this->dtgCustomFieldValue);
			$this->dtgCustomFieldValue->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgCustomFieldValue->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgCustomFieldValue->SetDataBinder('dtgCustomFieldValue_Bind', $this);

			$this->dtgCustomFieldValue->AddColumn($this->colEditLinkColumn);
			$this->dtgCustomFieldValue->AddColumn($this->colCustomFieldValueId);
			$this->dtgCustomFieldValue->AddColumn($this->colCustomFieldId);
			$this->dtgCustomFieldValue->AddColumn($this->colShortDescription);
			$this->dtgCustomFieldValue->AddColumn($this->colCreatedBy);
			$this->dtgCustomFieldValue->AddColumn($this->colCreationDate);
			$this->dtgCustomFieldValue->AddColumn($this->colModifiedBy);
			$this->dtgCustomFieldValue->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('CustomFieldValue');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgCustomFieldValue_EditLinkColumn_Render(CustomFieldValue $objCustomFieldValue) {
			$strControlId = 'btnEdit' . $this->dtgCustomFieldValue->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgCustomFieldValue, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objCustomFieldValue->CustomFieldValueId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objCustomFieldValue = CustomFieldValue::Load($strParameterArray[0]);

			$objEditPanel = new CustomFieldValueEditPanel($this, $this->strCloseEditPanelMethod, $objCustomFieldValue);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new CustomFieldValueEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgCustomFieldValue_CustomField_Render(CustomFieldValue $objCustomFieldValue) {
			if (!is_null($objCustomFieldValue->CustomField))
				return $objCustomFieldValue->CustomField->__toString();
			else
				return null;
		}

		public function dtgCustomFieldValue_CreatedByObject_Render(CustomFieldValue $objCustomFieldValue) {
			if (!is_null($objCustomFieldValue->CreatedByObject))
				return $objCustomFieldValue->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgCustomFieldValue_CreationDate_Render(CustomFieldValue $objCustomFieldValue) {
			if (!is_null($objCustomFieldValue->CreationDate))
				return $objCustomFieldValue->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgCustomFieldValue_ModifiedByObject_Render(CustomFieldValue $objCustomFieldValue) {
			if (!is_null($objCustomFieldValue->ModifiedByObject))
				return $objCustomFieldValue->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgCustomFieldValue_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgCustomFieldValue->TotalItemCount = CustomFieldValue::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgCustomFieldValue->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgCustomFieldValue->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgCustomFieldValue->DataSource = CustomFieldValue::LoadAll($objClauses);
		}
	}
?>