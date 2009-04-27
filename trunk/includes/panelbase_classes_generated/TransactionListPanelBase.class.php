<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Transaction class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Transaction objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this TransactionListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class TransactionListPanelBase extends QPanel {
		public $dtgTransaction;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgTransaction_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colTransactionId = new QDataGridColumn(QApplication::Translate('Transaction Id'), '<?= $_ITEM->TransactionId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Transaction()->TransactionId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Transaction()->TransactionId, false)));
			$this->colEntityQtypeId = new QDataGridColumn(QApplication::Translate('Entity Qtype'), '<?= $_CONTROL->ParentControl->dtgTransaction_EntityQtypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Transaction()->EntityQtypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Transaction()->EntityQtypeId, false)));
			$this->colTransactionTypeId = new QDataGridColumn(QApplication::Translate('Transaction Type Id'), '<?= $_CONTROL->ParentControl->dtgTransaction_TransactionType_Render($_ITEM); ?>');
			$this->colNote = new QDataGridColumn(QApplication::Translate('Note'), '<?= QString::Truncate($_ITEM->Note, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Transaction()->Note), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Transaction()->Note, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgTransaction_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgTransaction_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Transaction()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Transaction()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgTransaction_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Transaction()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Transaction()->ModifiedDate, false)));
			$this->colReceipt = new QDataGridColumn(QApplication::Translate('Receipt'), '<?= $_CONTROL->ParentControl->dtgTransaction_Receipt_Render($_ITEM); ?>');
			$this->colShipment = new QDataGridColumn(QApplication::Translate('Shipment'), '<?= $_CONTROL->ParentControl->dtgTransaction_Shipment_Render($_ITEM); ?>');

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
			$this->dtgTransaction->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgTransaction->SetDataBinder('dtgTransaction_Bind', $this);

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

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Transaction');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgTransaction_EditLinkColumn_Render(Transaction $objTransaction) {
			$strControlId = 'btnEdit' . $this->dtgTransaction->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgTransaction, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objTransaction->TransactionId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objTransaction = Transaction::Load($strParameterArray[0]);

			$objEditPanel = new TransactionEditPanel($this, $this->strCloseEditPanelMethod, $objTransaction);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new TransactionEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
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


		public function dtgTransaction_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgTransaction->TotalItemCount = Transaction::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgTransaction->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgTransaction->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgTransaction->DataSource = Transaction::LoadAll($objClauses);
		}
	}
?>