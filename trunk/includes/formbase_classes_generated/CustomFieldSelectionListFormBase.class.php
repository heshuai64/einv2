<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the CustomFieldSelection class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of CustomFieldSelection objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this CustomFieldSelectionListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class CustomFieldSelectionListFormBase extends QForm {
		protected $dtgCustomFieldSelection;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colCustomFieldSelectionId;
		protected $colCustomFieldValueId;
		protected $colEntityQtypeId;
		protected $colEntityId;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgCustomFieldSelection_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colCustomFieldSelectionId = new QDataGridColumn(QApplication::Translate('Custom Field Selection Id'), '<?= $_ITEM->CustomFieldSelectionId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::CustomFieldSelection()->CustomFieldSelectionId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CustomFieldSelection()->CustomFieldSelectionId, false)));
			$this->colCustomFieldValueId = new QDataGridColumn(QApplication::Translate('Custom Field Value Id'), '<?= $_FORM->dtgCustomFieldSelection_CustomFieldValue_Render($_ITEM); ?>');
			$this->colEntityQtypeId = new QDataGridColumn(QApplication::Translate('Entity Qtype'), '<?= $_FORM->dtgCustomFieldSelection_EntityQtypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::CustomFieldSelection()->EntityQtypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CustomFieldSelection()->EntityQtypeId, false)));
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
			$this->dtgCustomFieldSelection->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgCustomFieldSelection->SetDataBinder('dtgCustomFieldSelection_Bind');

			$this->dtgCustomFieldSelection->AddColumn($this->colEditLinkColumn);
			$this->dtgCustomFieldSelection->AddColumn($this->colCustomFieldSelectionId);
			$this->dtgCustomFieldSelection->AddColumn($this->colCustomFieldValueId);
			$this->dtgCustomFieldSelection->AddColumn($this->colEntityQtypeId);
			$this->dtgCustomFieldSelection->AddColumn($this->colEntityId);
		}
		
		public function dtgCustomFieldSelection_EditLinkColumn_Render(CustomFieldSelection $objCustomFieldSelection) {
			return sprintf('<a href="custom_field_selection_edit.php?intCustomFieldSelectionId=%s">%s</a>',
				$objCustomFieldSelection->CustomFieldSelectionId, 
				QApplication::Translate('Edit'));
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


		protected function dtgCustomFieldSelection_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgCustomFieldSelection->TotalItemCount = CustomFieldSelection::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgCustomFieldSelection->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgCustomFieldSelection->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all CustomFieldSelection objects, given the clauses above
			$this->dtgCustomFieldSelection->DataSource = CustomFieldSelection::LoadAll($objClauses);
		}
	}
?>