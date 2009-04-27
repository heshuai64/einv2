<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the AssetTransaction class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of AssetTransaction objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this AssetTransactionListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class AssetTransactionListFormBase extends QForm {
		protected $dtgAssetTransaction;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colAssetTransactionId;
		protected $colAssetId;
		protected $colTransactionId;
		protected $colParentAssetTransactionId;
		protected $colSourceLocationId;
		protected $colDestinationLocationId;
		protected $colNewAssetFlag;
		protected $colNewAssetId;
		protected $colScheduleReceiptFlag;
		protected $colScheduleReceiptDueDate;
		protected $colCreatedBy;
		protected $colCreationDate;
		protected $colModifiedBy;
		protected $colModifiedDate;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgAssetTransaction_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colAssetTransactionId = new QDataGridColumn(QApplication::Translate('Asset Transaction Id'), '<?= $_ITEM->AssetTransactionId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->AssetTransactionId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->AssetTransactionId, false)));
			$this->colAssetId = new QDataGridColumn(QApplication::Translate('Asset Id'), '<?= $_FORM->dtgAssetTransaction_Asset_Render($_ITEM); ?>');
			$this->colTransactionId = new QDataGridColumn(QApplication::Translate('Transaction Id'), '<?= $_FORM->dtgAssetTransaction_Transaction_Render($_ITEM); ?>');
			$this->colParentAssetTransactionId = new QDataGridColumn(QApplication::Translate('Parent Asset Transaction Id'), '<?= $_FORM->dtgAssetTransaction_ParentAssetTransaction_Render($_ITEM); ?>');
			$this->colSourceLocationId = new QDataGridColumn(QApplication::Translate('Source Location Id'), '<?= $_FORM->dtgAssetTransaction_SourceLocation_Render($_ITEM); ?>');
			$this->colDestinationLocationId = new QDataGridColumn(QApplication::Translate('Destination Location Id'), '<?= $_FORM->dtgAssetTransaction_DestinationLocation_Render($_ITEM); ?>');
			$this->colNewAssetFlag = new QDataGridColumn(QApplication::Translate('New Asset Flag'), '<?= ($_ITEM->NewAssetFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->NewAssetFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->NewAssetFlag, false)));
			$this->colNewAssetId = new QDataGridColumn(QApplication::Translate('New Asset Id'), '<?= $_FORM->dtgAssetTransaction_NewAsset_Render($_ITEM); ?>');
			$this->colScheduleReceiptFlag = new QDataGridColumn(QApplication::Translate('Schedule Receipt Flag'), '<?= ($_ITEM->ScheduleReceiptFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->ScheduleReceiptFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->ScheduleReceiptFlag, false)));
			$this->colScheduleReceiptDueDate = new QDataGridColumn(QApplication::Translate('Schedule Receipt Due Date'), '<?= $_FORM->dtgAssetTransaction_ScheduleReceiptDueDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->ScheduleReceiptDueDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->ScheduleReceiptDueDate, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_FORM->dtgAssetTransaction_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_FORM->dtgAssetTransaction_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_FORM->dtgAssetTransaction_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgAssetTransaction = new QDataGrid($this);
			$this->dtgAssetTransaction->CellSpacing = 0;
			$this->dtgAssetTransaction->CellPadding = 4;
			$this->dtgAssetTransaction->BorderStyle = QBorderStyle::Solid;
			$this->dtgAssetTransaction->BorderWidth = 1;
			$this->dtgAssetTransaction->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgAssetTransaction->Paginator = new QPaginator($this->dtgAssetTransaction);
			$this->dtgAssetTransaction->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgAssetTransaction->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgAssetTransaction->SetDataBinder('dtgAssetTransaction_Bind');

			$this->dtgAssetTransaction->AddColumn($this->colEditLinkColumn);
			$this->dtgAssetTransaction->AddColumn($this->colAssetTransactionId);
			$this->dtgAssetTransaction->AddColumn($this->colAssetId);
			$this->dtgAssetTransaction->AddColumn($this->colTransactionId);
			$this->dtgAssetTransaction->AddColumn($this->colParentAssetTransactionId);
			$this->dtgAssetTransaction->AddColumn($this->colSourceLocationId);
			$this->dtgAssetTransaction->AddColumn($this->colDestinationLocationId);
			$this->dtgAssetTransaction->AddColumn($this->colNewAssetFlag);
			$this->dtgAssetTransaction->AddColumn($this->colNewAssetId);
			$this->dtgAssetTransaction->AddColumn($this->colScheduleReceiptFlag);
			$this->dtgAssetTransaction->AddColumn($this->colScheduleReceiptDueDate);
			$this->dtgAssetTransaction->AddColumn($this->colCreatedBy);
			$this->dtgAssetTransaction->AddColumn($this->colCreationDate);
			$this->dtgAssetTransaction->AddColumn($this->colModifiedBy);
			$this->dtgAssetTransaction->AddColumn($this->colModifiedDate);
		}
		
		public function dtgAssetTransaction_EditLinkColumn_Render(AssetTransaction $objAssetTransaction) {
			return sprintf('<a href="asset_transaction_edit.php?intAssetTransactionId=%s">%s</a>',
				$objAssetTransaction->AssetTransactionId, 
				QApplication::Translate('Edit'));
		}

		public function dtgAssetTransaction_Asset_Render(AssetTransaction $objAssetTransaction) {
			if (!is_null($objAssetTransaction->Asset))
				return $objAssetTransaction->Asset->__toString();
			else
				return null;
		}

		public function dtgAssetTransaction_Transaction_Render(AssetTransaction $objAssetTransaction) {
			if (!is_null($objAssetTransaction->Transaction))
				return $objAssetTransaction->Transaction->__toString();
			else
				return null;
		}

		public function dtgAssetTransaction_ParentAssetTransaction_Render(AssetTransaction $objAssetTransaction) {
			if (!is_null($objAssetTransaction->ParentAssetTransaction))
				return $objAssetTransaction->ParentAssetTransaction->__toString();
			else
				return null;
		}

		public function dtgAssetTransaction_SourceLocation_Render(AssetTransaction $objAssetTransaction) {
			if (!is_null($objAssetTransaction->SourceLocation))
				return $objAssetTransaction->SourceLocation->__toString();
			else
				return null;
		}

		public function dtgAssetTransaction_DestinationLocation_Render(AssetTransaction $objAssetTransaction) {
			if (!is_null($objAssetTransaction->DestinationLocation))
				return $objAssetTransaction->DestinationLocation->__toString();
			else
				return null;
		}

		public function dtgAssetTransaction_NewAsset_Render(AssetTransaction $objAssetTransaction) {
			if (!is_null($objAssetTransaction->NewAsset))
				return $objAssetTransaction->NewAsset->__toString();
			else
				return null;
		}

		public function dtgAssetTransaction_ScheduleReceiptDueDate_Render(AssetTransaction $objAssetTransaction) {
			if (!is_null($objAssetTransaction->ScheduleReceiptDueDate))
				return $objAssetTransaction->ScheduleReceiptDueDate->__toString(QDateTime::FormatDisplayDate);
			else
				return null;
		}

		public function dtgAssetTransaction_CreatedByObject_Render(AssetTransaction $objAssetTransaction) {
			if (!is_null($objAssetTransaction->CreatedByObject))
				return $objAssetTransaction->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgAssetTransaction_CreationDate_Render(AssetTransaction $objAssetTransaction) {
			if (!is_null($objAssetTransaction->CreationDate))
				return $objAssetTransaction->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgAssetTransaction_ModifiedByObject_Render(AssetTransaction $objAssetTransaction) {
			if (!is_null($objAssetTransaction->ModifiedByObject))
				return $objAssetTransaction->ModifiedByObject->__toString();
			else
				return null;
		}


		protected function dtgAssetTransaction_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgAssetTransaction->TotalItemCount = AssetTransaction::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgAssetTransaction->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgAssetTransaction->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all AssetTransaction objects, given the clauses above
			$this->dtgAssetTransaction->DataSource = AssetTransaction::LoadAll($objClauses);
		}
	}
?>