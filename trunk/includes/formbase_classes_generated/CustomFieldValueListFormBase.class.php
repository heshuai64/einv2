<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the CustomFieldValue class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of CustomFieldValue objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this CustomFieldValueListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class CustomFieldValueListFormBase extends QForm {
		protected $dtgCustomFieldValue;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colCustomFieldValueId;
		protected $colCustomFieldId;
		protected $colShortDescription;
		protected $colCreatedBy;
		protected $colCreationDate;
		protected $colModifiedBy;
		protected $colModifiedDate;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgCustomFieldValue_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colCustomFieldValueId = new QDataGridColumn(QApplication::Translate('Custom Field Value Id'), '<?= $_ITEM->CustomFieldValueId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::CustomFieldValue()->CustomFieldValueId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CustomFieldValue()->CustomFieldValueId, false)));
			$this->colCustomFieldId = new QDataGridColumn(QApplication::Translate('Custom Field Id'), '<?= $_FORM->dtgCustomFieldValue_CustomField_Render($_ITEM); ?>');
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::CustomFieldValue()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CustomFieldValue()->ShortDescription, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_FORM->dtgCustomFieldValue_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_FORM->dtgCustomFieldValue_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::CustomFieldValue()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::CustomFieldValue()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_FORM->dtgCustomFieldValue_ModifiedByObject_Render($_ITEM); ?>');
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
			$this->dtgCustomFieldValue->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgCustomFieldValue->SetDataBinder('dtgCustomFieldValue_Bind');

			$this->dtgCustomFieldValue->AddColumn($this->colEditLinkColumn);
			$this->dtgCustomFieldValue->AddColumn($this->colCustomFieldValueId);
			$this->dtgCustomFieldValue->AddColumn($this->colCustomFieldId);
			$this->dtgCustomFieldValue->AddColumn($this->colShortDescription);
			$this->dtgCustomFieldValue->AddColumn($this->colCreatedBy);
			$this->dtgCustomFieldValue->AddColumn($this->colCreationDate);
			$this->dtgCustomFieldValue->AddColumn($this->colModifiedBy);
			$this->dtgCustomFieldValue->AddColumn($this->colModifiedDate);
		}
		
		public function dtgCustomFieldValue_EditLinkColumn_Render(CustomFieldValue $objCustomFieldValue) {
			return sprintf('<a href="custom_field_value_edit.php?intCustomFieldValueId=%s">%s</a>',
				$objCustomFieldValue->CustomFieldValueId, 
				QApplication::Translate('Edit'));
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


		protected function dtgCustomFieldValue_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgCustomFieldValue->TotalItemCount = CustomFieldValue::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgCustomFieldValue->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgCustomFieldValue->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all CustomFieldValue objects, given the clauses above
			$this->dtgCustomFieldValue->DataSource = CustomFieldValue::LoadAll($objClauses);
		}
	}
?>