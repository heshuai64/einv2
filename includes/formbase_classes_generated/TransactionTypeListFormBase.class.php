<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the TransactionType class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of TransactionType objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this TransactionTypeListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class TransactionTypeListFormBase extends QForm {
		protected $dtgTransactionType;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colTransactionTypeId;
		protected $colShortDescription;
		protected $colAssetFlag;
		protected $colInventoryFlag;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgTransactionType_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colTransactionTypeId = new QDataGridColumn(QApplication::Translate('Transaction Type Id'), '<?= $_ITEM->TransactionTypeId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::TransactionType()->TransactionTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TransactionType()->TransactionTypeId, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::TransactionType()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TransactionType()->ShortDescription, false)));
			$this->colAssetFlag = new QDataGridColumn(QApplication::Translate('Asset Flag'), '<?= ($_ITEM->AssetFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::TransactionType()->AssetFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TransactionType()->AssetFlag, false)));
			$this->colInventoryFlag = new QDataGridColumn(QApplication::Translate('Inventory Flag'), '<?= ($_ITEM->InventoryFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::TransactionType()->InventoryFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::TransactionType()->InventoryFlag, false)));

			// Setup DataGrid
			$this->dtgTransactionType = new QDataGrid($this);
			$this->dtgTransactionType->CellSpacing = 0;
			$this->dtgTransactionType->CellPadding = 4;
			$this->dtgTransactionType->BorderStyle = QBorderStyle::Solid;
			$this->dtgTransactionType->BorderWidth = 1;
			$this->dtgTransactionType->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgTransactionType->Paginator = new QPaginator($this->dtgTransactionType);
			$this->dtgTransactionType->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgTransactionType->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgTransactionType->SetDataBinder('dtgTransactionType_Bind');

			$this->dtgTransactionType->AddColumn($this->colEditLinkColumn);
			$this->dtgTransactionType->AddColumn($this->colTransactionTypeId);
			$this->dtgTransactionType->AddColumn($this->colShortDescription);
			$this->dtgTransactionType->AddColumn($this->colAssetFlag);
			$this->dtgTransactionType->AddColumn($this->colInventoryFlag);
		}
		
		public function dtgTransactionType_EditLinkColumn_Render(TransactionType $objTransactionType) {
			return sprintf('<a href="transaction_type_edit.php?intTransactionTypeId=%s">%s</a>',
				$objTransactionType->TransactionTypeId, 
				QApplication::Translate('Edit'));
		}


		protected function dtgTransactionType_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgTransactionType->TotalItemCount = TransactionType::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgTransactionType->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgTransactionType->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all TransactionType objects, given the clauses above
			$this->dtgTransactionType->DataSource = TransactionType::LoadAll($objClauses);
		}
	}
?>