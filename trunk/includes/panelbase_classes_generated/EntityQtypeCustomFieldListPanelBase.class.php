<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the EntityQtypeCustomField class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of EntityQtypeCustomField objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this EntityQtypeCustomFieldListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class EntityQtypeCustomFieldListPanelBase extends QPanel {
		public $dtgEntityQtypeCustomField;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colEntityQtypeCustomFieldId;
		protected $colEntityQtypeId;
		protected $colCustomFieldId;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgEntityQtypeCustomField_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colEntityQtypeCustomFieldId = new QDataGridColumn(QApplication::Translate('Entity Qtype Custom Field Id'), '<?= $_ITEM->EntityQtypeCustomFieldId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::EntityQtypeCustomField()->EntityQtypeCustomFieldId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::EntityQtypeCustomField()->EntityQtypeCustomFieldId, false)));
			$this->colEntityQtypeId = new QDataGridColumn(QApplication::Translate('Entity Qtype'), '<?= $_CONTROL->ParentControl->dtgEntityQtypeCustomField_EntityQtypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::EntityQtypeCustomField()->EntityQtypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::EntityQtypeCustomField()->EntityQtypeId, false)));
			$this->colCustomFieldId = new QDataGridColumn(QApplication::Translate('Custom Field Id'), '<?= $_CONTROL->ParentControl->dtgEntityQtypeCustomField_CustomField_Render($_ITEM); ?>');

			// Setup DataGrid
			$this->dtgEntityQtypeCustomField = new QDataGrid($this);
			$this->dtgEntityQtypeCustomField->CellSpacing = 0;
			$this->dtgEntityQtypeCustomField->CellPadding = 4;
			$this->dtgEntityQtypeCustomField->BorderStyle = QBorderStyle::Solid;
			$this->dtgEntityQtypeCustomField->BorderWidth = 1;
			$this->dtgEntityQtypeCustomField->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgEntityQtypeCustomField->Paginator = new QPaginator($this->dtgEntityQtypeCustomField);
			$this->dtgEntityQtypeCustomField->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgEntityQtypeCustomField->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgEntityQtypeCustomField->SetDataBinder('dtgEntityQtypeCustomField_Bind', $this);

			$this->dtgEntityQtypeCustomField->AddColumn($this->colEditLinkColumn);
			$this->dtgEntityQtypeCustomField->AddColumn($this->colEntityQtypeCustomFieldId);
			$this->dtgEntityQtypeCustomField->AddColumn($this->colEntityQtypeId);
			$this->dtgEntityQtypeCustomField->AddColumn($this->colCustomFieldId);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('EntityQtypeCustomField');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgEntityQtypeCustomField_EditLinkColumn_Render(EntityQtypeCustomField $objEntityQtypeCustomField) {
			$strControlId = 'btnEdit' . $this->dtgEntityQtypeCustomField->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgEntityQtypeCustomField, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objEntityQtypeCustomField->EntityQtypeCustomFieldId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objEntityQtypeCustomField = EntityQtypeCustomField::Load($strParameterArray[0]);

			$objEditPanel = new EntityQtypeCustomFieldEditPanel($this, $this->strCloseEditPanelMethod, $objEntityQtypeCustomField);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new EntityQtypeCustomFieldEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgEntityQtypeCustomField_EntityQtypeId_Render(EntityQtypeCustomField $objEntityQtypeCustomField) {
			if (!is_null($objEntityQtypeCustomField->EntityQtypeId))
				return EntityQtype::ToString($objEntityQtypeCustomField->EntityQtypeId);
			else
				return null;
		}

		public function dtgEntityQtypeCustomField_CustomField_Render(EntityQtypeCustomField $objEntityQtypeCustomField) {
			if (!is_null($objEntityQtypeCustomField->CustomField))
				return $objEntityQtypeCustomField->CustomField->__toString();
			else
				return null;
		}


		public function dtgEntityQtypeCustomField_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgEntityQtypeCustomField->TotalItemCount = EntityQtypeCustomField::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgEntityQtypeCustomField->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgEntityQtypeCustomField->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgEntityQtypeCustomField->DataSource = EntityQtypeCustomField::LoadAll($objClauses);
		}
	}
?>