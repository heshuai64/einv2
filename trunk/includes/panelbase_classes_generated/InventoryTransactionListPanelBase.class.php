<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the InventoryTransaction class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of InventoryTransaction objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this InventoryTransactionListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class InventoryTransactionListPanelBase extends QPanel {
		public $dtgInventoryTransaction;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgInventoryTransaction_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colInventoryTransactionId = new QDataGridColumn(QApplication::Translate('Inventory Transaction Id'), '<?= $_ITEM->InventoryTransactionId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::InventoryTransaction()->InventoryTransactionId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::InventoryTransaction()->InventoryTransactionId, false)));
			$this->colInventoryLocationId = new QDataGridColumn(QApplication::Translate('Inventory Location Id'), '<?= $_CONTROL->ParentControl->dtgInventoryTransaction_InventoryLocation_Render($_ITEM); ?>');
			$this->colTransactionId = new QDataGridColumn(QApplication::Translate('Transaction Id'), '<?= $_CONTROL->ParentControl->dtgInventoryTransaction_Transaction_Render($_ITEM); ?>');
			$this->colQuantity = new QDataGridColumn(QApplication::Translate('Quantity'), '<?= $_ITEM->Quantity; ?>', array('OrderByClause' => QQ::OrderBy(QQN::InventoryTransaction()->Quantity), 'ReverseOrderByClause' => QQ::OrderBy(QQN::InventoryTransaction()->Quantity, false)));
			$this->colSourceLocationId = new QDataGridColumn(QApplication::Translate('Source Location Id'), '<?= $_CONTROL->ParentControl->dtgInventoryTransaction_SourceLocation_Render($_ITEM); ?>');
			$this->colDestinationLocationId = new QDataGridColumn(QApplication::Translate('Destination Location Id'), '<?= $_CONTROL->ParentControl->dtgInventoryTransaction_DestinationLocation_Render($_ITEM); ?>');
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgInventoryTransaction_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgInventoryTransaction_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::InventoryTransaction()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::InventoryTransaction()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgInventoryTransaction_ModifiedByObject_Render($_ITEM); ?>');
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
			$this->dtgInventoryTransaction->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgInventoryTransaction->SetDataBinder('dtgInventoryTransaction_Bind', $this);

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

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('InventoryTransaction');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgInventoryTransaction_EditLinkColumn_Render(InventoryTransaction $objInventoryTransaction) {
			$strControlId = 'btnEdit' . $this->dtgInventoryTransaction->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgInventoryTransaction, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objInventoryTransaction->InventoryTransactionId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objInventoryTransaction = InventoryTransaction::Load($strParameterArray[0]);

			$objEditPanel = new InventoryTransactionEditPanel($this, $this->strCloseEditPanelMethod, $objInventoryTransaction);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new InventoryTransactionEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
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


		public function dtgInventoryTransaction_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgInventoryTransaction->TotalItemCount = InventoryTransaction::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgInventoryTransaction->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgInventoryTransaction->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgInventoryTransaction->DataSource = InventoryTransaction::LoadAll($objClauses);
		}
	}
?>