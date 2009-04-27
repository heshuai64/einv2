<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the EntityQtypeCustomField class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of EntityQtypeCustomField objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this EntityQtypeCustomFieldListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class EntityQtypeCustomFieldListFormBase extends QForm {
		protected $dtgEntityQtypeCustomField;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colEntityQtypeCustomFieldId;
		protected $colEntityQtypeId;
		protected $colCustomFieldId;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgEntityQtypeCustomField_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colEntityQtypeCustomFieldId = new QDataGridColumn(QApplication::Translate('Entity Qtype Custom Field Id'), '<?= $_ITEM->EntityQtypeCustomFieldId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::EntityQtypeCustomField()->EntityQtypeCustomFieldId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::EntityQtypeCustomField()->EntityQtypeCustomFieldId, false)));
			$this->colEntityQtypeId = new QDataGridColumn(QApplication::Translate('Entity Qtype'), '<?= $_FORM->dtgEntityQtypeCustomField_EntityQtypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::EntityQtypeCustomField()->EntityQtypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::EntityQtypeCustomField()->EntityQtypeId, false)));
			$this->colCustomFieldId = new QDataGridColumn(QApplication::Translate('Custom Field Id'), '<?= $_FORM->dtgEntityQtypeCustomField_CustomField_Render($_ITEM); ?>');

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
			$this->dtgEntityQtypeCustomField->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgEntityQtypeCustomField->SetDataBinder('dtgEntityQtypeCustomField_Bind');

			$this->dtgEntityQtypeCustomField->AddColumn($this->colEditLinkColumn);
			$this->dtgEntityQtypeCustomField->AddColumn($this->colEntityQtypeCustomFieldId);
			$this->dtgEntityQtypeCustomField->AddColumn($this->colEntityQtypeId);
			$this->dtgEntityQtypeCustomField->AddColumn($this->colCustomFieldId);
		}
		
		public function dtgEntityQtypeCustomField_EditLinkColumn_Render(EntityQtypeCustomField $objEntityQtypeCustomField) {
			return sprintf('<a href="entity_qtype_custom_field_edit.php?intEntityQtypeCustomFieldId=%s">%s</a>',
				$objEntityQtypeCustomField->EntityQtypeCustomFieldId, 
				QApplication::Translate('Edit'));
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


		protected function dtgEntityQtypeCustomField_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgEntityQtypeCustomField->TotalItemCount = EntityQtypeCustomField::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgEntityQtypeCustomField->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgEntityQtypeCustomField->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all EntityQtypeCustomField objects, given the clauses above
			$this->dtgEntityQtypeCustomField->DataSource = EntityQtypeCustomField::LoadAll($objClauses);
		}
	}
?>