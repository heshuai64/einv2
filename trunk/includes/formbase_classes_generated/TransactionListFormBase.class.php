<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Transaction class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Transaction objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this TransactionListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class TransactionListFormBase extends QForm {
		protected $dtgTransaction;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colTransactionId;
		protected $colEntityQtypeId;
		protected $colTransactionTypeId;
		protected $colNote;
		protected $colCreatedBy;
		protected $colCreationDate;
		protected $colModifiedBy;
		protected $colModifiedDate;
		protected $colReceipt;
		protected $colShipment;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgTransaction_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colTransactionId = new QDataGridColumn(QApplication::Translate('Transaction Id'), '<?= $_ITEM->TransactionId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Transaction()->TransactionId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Transaction()->TransactionId, false)));
			$this->colEntityQtypeId = new QDataGridColumn(QApplication::Translate('Entity Qtype'), '<?= $_FORM->dtgTransaction_EntityQtypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Transaction()->EntityQtypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Transaction()->EntityQtypeId, false)));
			$this->colTransactionTypeId = new QDataGridColumn(QApplication::Translate('Transaction Type Id'), '<?= $_FORM->dtgTransaction_TransactionType_Render($_ITEM); ?>');
			$this->colNote = new QDataGridColumn(QApplication::Translate('Note'), '<?= QString::Truncate($_ITEM->Note, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Transaction()->Note), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Transaction()->Note, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_FORM->dtgTransaction_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_FORM->dtgTransaction_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Transaction()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Transaction()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_FORM->dtgTransaction_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Transaction()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Transaction()->ModifiedDate, false)));
			$this->colReceipt = new QDataGridColumn(QApplication::Translate('Receipt'), '<?= $_FORM->dtgTransaction_Receipt_Render($_ITEM); ?>');
			$this->colShipment = new QDataGridColumn(QApplication::Translate('Shipment'), '<?= $_FORM->dtgTransaction_Shipment_Render($_ITEM); ?>');

			// Setup DataGrid
			$this->dtgTransaction = new QDataGrid($this);
			$this->dtgTransaction->CellSpacing = 0;
			$this->dtgTransaction->CellPadding = 4;
			$this->dtgTransaction->BorderStyle = QBorderStyle::Solid;
			$this->dtgTransaction->BorderWidth = 1;
			$this->dtgTransaction->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgTransaction->Paginator = new QPaginator($this->dtgTransaction);
			$this->dtgTransaction->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgTransaction->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgTransaction->SetDataBinder('dtgTransaction_Bind');

			$this->dtgTransaction->AddColumn($this->colEditLinkColumn);
			$this->dtgTransaction->AddColumn($this->colTransactionId);
			$this->dtgTransaction->AddColumn($this->colEntityQtypeId);
			$this->dtgTransaction->AddColumn($this->colTransactionTypeId);
			$this->dtgTransaction->AddColumn($this->colNote);
			$this->dtgTransaction->AddColumn($this->colCreatedBy);
			$this->dtgTransaction->AddColumn($this->colCreationDate);
			$this->dtgTransaction->AddColumn($this->colModifiedBy);
			$this->dtgTransaction->AddColumn($this->colModifiedDate);
			$this->dtgTransaction->AddColumn($this->colReceipt);
			$this->dtgTransaction->AddColumn($this->colShipment);
		}
		
		public function dtgTransaction_EditLinkColumn_Render(Transaction $objTransaction) {
			return sprintf('<a href="transaction_edit.php?intTransactionId=%s">%s</a>',
				$objTransaction->TransactionId, 
				QApplication::Translate('Edit'));
		}

		public function dtgTransaction_EntityQtypeId_Render(Transaction $objTransaction) {
			if (!is_null($objTransaction->EntityQtypeId))
				return EntityQtype::ToString($objTransaction->EntityQtypeId);
			else
				return null;
		}

		public function dtgTransaction_TransactionType_Render(Transaction $objTransaction) {
			if (!is_null($objTransaction->TransactionType))
				return $objTransaction->TransactionType->__toString();
			else
				return null;
		}

		public function dtgTransaction_CreatedByObject_Render(Transaction $objTransaction) {
			if (!is_null($objTransaction->CreatedByObject))
				return $objTransaction->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgTransaction_CreationDate_Render(Transaction $objTransaction) {
			if (!is_null($objTransaction->CreationDate))
				return $objTransaction->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgTransaction_ModifiedByObject_Render(Transaction $objTransaction) {
			if (!is_null($objTransaction->ModifiedByObject))
				return $objTransaction->ModifiedByObject->__toString();
			else
				return null;
		}

		public function dtgTransaction_Receipt_Render(Transaction $objTransaction) {
			if (!is_null($objTransaction->Receipt))
				return $objTransaction->Receipt->__toString();
			else
				return null;
		}

		public function dtgTransaction_Shipment_Render(Transaction $objTransaction) {
			if (!is_null($objTransaction->Shipment))
				return $objTransaction->Shipment->__toString();
			else
				return null;
		}


		protected function dtgTransaction_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgTransaction->TotalItemCount = Transaction::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgTransaction->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgTransaction->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all Transaction objects, given the clauses above
			$this->dtgTransaction->DataSource = Transaction::LoadAll($objClauses);
		}
	}
?>