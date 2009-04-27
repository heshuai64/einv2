<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the InventoryTransaction class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of InventoryTransaction objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this InventoryTransactionListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class InventoryTransactionListFormBase extends QForm {
		protected $dtgInventoryTransaction;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colInventoryTransactionId;
		protected $colInventoryLocationId;
		protected $colTransactionId;
		protected $colQuantity;
		protected $colSourceLocationId;
		protected $colDestinationLocationId;
		protected $colCreatedBy;
		protected $colCreationDate;
		protected $colModifiedBy;
		protected $colModifiedDate;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgInventoryTransaction_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colInventoryTransactionId = new QDataGridColumn(QApplication::Translate('Inventory Transaction Id'), '<?= $_ITEM->InventoryTransactionId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::InventoryTransaction()->InventoryTransactionId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::InventoryTransaction()->InventoryTransactionId, false)));
			$this->colInventoryLocationId = new QDataGridColumn(QApplication::Translate('Inventory Location Id'), '<?= $_FORM->dtgInventoryTransaction_InventoryLocation_Render($_ITEM); ?>');
			$this->colTransactionId = new QDataGridColumn(QApplication::Translate('Transaction Id'), '<?= $_FORM->dtgInventoryTransaction_Transaction_Render($_ITEM); ?>');
			$this->colQuantity = new QDataGridColumn(QApplication::Translate('Quantity'), '<?= $_ITEM->Quantity; ?>', array('OrderByClause' => QQ::OrderBy(QQN::InventoryTransaction()->Quantity), 'ReverseOrderByClause' => QQ::OrderBy(QQN::InventoryTransaction()->Quantity, false)));
			$this->colSourceLocationId = new QDataGridColumn(QApplication::Translate('Source Location Id'), '<?= $_FORM->dtgInventoryTransaction_SourceLocation_Render($_ITEM); ?>');
			$this->colDestinationLocationId = new QDataGridColumn(QApplication::Translate('Destination Location Id'), '<?= $_FORM->dtgInventoryTransaction_DestinationLocation_Render($_ITEM); ?>');
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_FORM->dtgInventoryTransaction_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_FORM->dtgInventoryTransaction_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::InventoryTransaction()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::InventoryTransaction()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_FORM->dtgInventoryTransaction_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::InventoryTransaction()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::InventoryTransaction()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgInventoryTransaction = new QDataGrid($this);
			$this->dtgInventoryTransaction->CellSpacing = 0;
			$this->dtgInventoryTransaction->CellPadding = 4;
			$this->dtgInventoryTransaction->BorderStyle = QBorderStyle::Solid;
			$this->dtgInventoryTransaction->BorderWidth = 1;
			$this->dtgInventoryTransaction->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgInventoryTransaction->Paginator = new QPaginator($this->dtgInventoryTransaction);
			$this->dtgInventoryTransaction->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgInventoryTransaction->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgInventoryTransaction->SetDataBinder('dtgInventoryTransaction_Bind');

			$this->dtgInventoryTransaction->AddColumn($this->colEditLinkColumn);
			$this->dtgInventoryTransaction->AddColumn($this->colInventoryTransactionId);
			$this->dtgInventoryTransaction->AddColumn($this->colInventoryLocationId);
			$this->dtgInventoryTransaction->AddColumn($this->colTransactionId);
			$this->dtgInventoryTransaction->AddColumn($this->colQuantity);
			$this->dtgInventoryTransaction->AddColumn($this->colSourceLocationId);
			$this->dtgInventoryTransaction->AddColumn($this->colDestinationLocationId);
			$this->dtgInventoryTransaction->AddColumn($this->colCreatedBy);
			$this->dtgInventoryTransaction->AddColumn($this->colCreationDate);
			$this->dtgInventoryTransaction->AddColumn($this->colModifiedBy);
			$this->dtgInventoryTransaction->AddColumn($this->colModifiedDate);
		}
		
		public function dtgInventoryTransaction_EditLinkColumn_Render(InventoryTransaction $objInventoryTransaction) {
			return sprintf('<a href="inventory_transaction_edit.php?intInventoryTransactionId=%s">%s</a>',
				$objInventoryTransaction->InventoryTransactionId, 
				QApplication::Translate('Edit'));
		}

		public function dtgInventoryTransaction_InventoryLocation_Render(InventoryTransaction $objInventoryTransaction) {
			if (!is_null($objInventoryTransaction->InventoryLocation))
				return $objInventoryTransaction->InventoryLocation->__toString();
			else
				return null;
		}

		public function dtgInventoryTransaction_Transaction_Render(InventoryTransaction $objInventoryTransaction) {
			if (!is_null($objInventoryTransaction->Transaction))
				return $objInventoryTransaction->Transaction->__toString();
			else
				return null;
		}

		public function dtgInventoryTransaction_SourceLocation_Render(InventoryTransaction $objInventoryTransaction) {
			if (!is_null($objInventoryTransaction->SourceLocation))
				return $objInventoryTransaction->SourceLocation->__toString();
			else
				return null;
		}

		public function dtgInventoryTransaction_DestinationLocation_Render(InventoryTransaction $objInventoryTransaction) {
			if (!is_null($objInventoryTransaction->DestinationLocation))
				return $objInventoryTransaction->DestinationLocation->__toString();
			else
				return null;
		}

		public function dtgInventoryTransaction_CreatedByObject_Render(InventoryTransaction $objInventoryTransaction) {
			if (!is_null($objInventoryTransaction->CreatedByObject))
				return $objInventoryTransaction->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgInventoryTransaction_CreationDate_Render(InventoryTransaction $objInventoryTransaction) {
			if (!is_null($objInventoryTransaction->CreationDate))
				return $objInventoryTransaction->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgInventoryTransaction_ModifiedByObject_Render(InventoryTransaction $objInventoryTransaction) {
			if (!is_null($objInventoryTransaction->ModifiedByObject))
				return $objInventoryTransaction->ModifiedByObject->__toString();
			else
				return null;
		}


		protected function dtgInventoryTransaction_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgInventoryTransaction->TotalItemCount = InventoryTransaction::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgInventoryTransaction->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgInventoryTransaction->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all InventoryTransaction objects, given the clauses above
			$this->dtgInventoryTransaction->DataSource = InventoryTransaction::LoadAll($objClauses);
		}
	}
?>