<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the InventoryLocation class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of InventoryLocation objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this InventoryLocationListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class InventoryLocationListFormBase extends QForm {
		protected $dtgInventoryLocation;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colInventoryLocationId;
		protected $colInventoryModelId;
		protected $colLocationId;
		protected $colQuantity;
		protected $colCreatedBy;
		protected $colCreationDate;
		protected $colModifiedBy;
		protected $colModifiedDate;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgInventoryLocation_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colInventoryLocationId = new QDataGridColumn(QApplication::Translate('Inventory Location Id'), '<?= $_ITEM->InventoryLocationId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::InventoryLocation()->InventoryLocationId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::InventoryLocation()->InventoryLocationId, false)));
			$this->colInventoryModelId = new QDataGridColumn(QApplication::Translate('Inventory Model Id'), '<?= $_FORM->dtgInventoryLocation_InventoryModel_Render($_ITEM); ?>');
			$this->colLocationId = new QDataGridColumn(QApplication::Translate('Location Id'), '<?= $_FORM->dtgInventoryLocation_Location_Render($_ITEM); ?>');
			$this->colQuantity = new QDataGridColumn(QApplication::Translate('Quantity'), '<?= $_ITEM->Quantity; ?>', array('OrderByClause' => QQ::OrderBy(QQN::InventoryLocation()->Quantity), 'ReverseOrderByClause' => QQ::OrderBy(QQN::InventoryLocation()->Quantity, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_FORM->dtgInventoryLocation_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_FORM->dtgInventoryLocation_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::InventoryLocation()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::InventoryLocation()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_FORM->dtgInventoryLocation_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::InventoryLocation()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::InventoryLocation()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgInventoryLocation = new QDataGrid($this);
			$this->dtgInventoryLocation->CellSpacing = 0;
			$this->dtgInventoryLocation->CellPadding = 4;
			$this->dtgInventoryLocation->BorderStyle = QBorderStyle::Solid;
			$this->dtgInventoryLocation->BorderWidth = 1;
			$this->dtgInventoryLocation->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgInventoryLocation->Paginator = new QPaginator($this->dtgInventoryLocation);
			$this->dtgInventoryLocation->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgInventoryLocation->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgInventoryLocation->SetDataBinder('dtgInventoryLocation_Bind');

			$this->dtgInventoryLocation->AddColumn($this->colEditLinkColumn);
			$this->dtgInventoryLocation->AddColumn($this->colInventoryLocationId);
			$this->dtgInventoryLocation->AddColumn($this->colInventoryModelId);
			$this->dtgInventoryLocation->AddColumn($this->colLocationId);
			$this->dtgInventoryLocation->AddColumn($this->colQuantity);
			$this->dtgInventoryLocation->AddColumn($this->colCreatedBy);
			$this->dtgInventoryLocation->AddColumn($this->colCreationDate);
			$this->dtgInventoryLocation->AddColumn($this->colModifiedBy);
			$this->dtgInventoryLocation->AddColumn($this->colModifiedDate);
		}
		
		public function dtgInventoryLocation_EditLinkColumn_Render(InventoryLocation $objInventoryLocation) {
			return sprintf('<a href="inventory_location_edit.php?intInventoryLocationId=%s">%s</a>',
				$objInventoryLocation->InventoryLocationId, 
				QApplication::Translate('Edit'));
		}

		public function dtgInventoryLocation_InventoryModel_Render(InventoryLocation $objInventoryLocation) {
			if (!is_null($objInventoryLocation->InventoryModel))
				return $objInventoryLocation->InventoryModel->__toString();
			else
				return null;
		}

		public function dtgInventoryLocation_Location_Render(InventoryLocation $objInventoryLocation) {
			if (!is_null($objInventoryLocation->Location))
				return $objInventoryLocation->Location->__toString();
			else
				return null;
		}

		public function dtgInventoryLocation_CreatedByObject_Render(InventoryLocation $objInventoryLocation) {
			if (!is_null($objInventoryLocation->CreatedByObject))
				return $objInventoryLocation->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgInventoryLocation_CreationDate_Render(InventoryLocation $objInventoryLocation) {
			if (!is_null($objInventoryLocation->CreationDate))
				return $objInventoryLocation->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgInventoryLocation_ModifiedByObject_Render(InventoryLocation $objInventoryLocation) {
			if (!is_null($objInventoryLocation->ModifiedByObject))
				return $objInventoryLocation->ModifiedByObject->__toString();
			else
				return null;
		}


		protected function dtgInventoryLocation_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgInventoryLocation->TotalItemCount = InventoryLocation::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgInventoryLocation->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgInventoryLocation->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all InventoryLocation objects, given the clauses above
			$this->dtgInventoryLocation->DataSource = InventoryLocation::LoadAll($objClauses);
		}
	}
?>