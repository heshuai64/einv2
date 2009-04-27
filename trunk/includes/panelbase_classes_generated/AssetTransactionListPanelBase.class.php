<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the AssetTransaction class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of AssetTransaction objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this AssetTransactionListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class AssetTransactionListPanelBase extends QPanel {
		public $dtgAssetTransaction;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgAssetTransaction_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colAssetTransactionId = new QDataGridColumn(QApplication::Translate('Asset Transaction Id'), '<?= $_ITEM->AssetTransactionId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->AssetTransactionId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->AssetTransactionId, false)));
			$this->colAssetId = new QDataGridColumn(QApplication::Translate('Asset Id'), '<?= $_CONTROL->ParentControl->dtgAssetTransaction_Asset_Render($_ITEM); ?>');
			$this->colTransactionId = new QDataGridColumn(QApplication::Translate('Transaction Id'), '<?= $_CONTROL->ParentControl->dtgAssetTransaction_Transaction_Render($_ITEM); ?>');
			$this->colParentAssetTransactionId = new QDataGridColumn(QApplication::Translate('Parent Asset Transaction Id'), '<?= $_CONTROL->ParentControl->dtgAssetTransaction_ParentAssetTransaction_Render($_ITEM); ?>');
			$this->colSourceLocationId = new QDataGridColumn(QApplication::Translate('Source Location Id'), '<?= $_CONTROL->ParentControl->dtgAssetTransaction_SourceLocation_Render($_ITEM); ?>');
			$this->colDestinationLocationId = new QDataGridColumn(QApplication::Translate('Destination Location Id'), '<?= $_CONTROL->ParentControl->dtgAssetTransaction_DestinationLocation_Render($_ITEM); ?>');
			$this->colNewAssetFlag = new QDataGridColumn(QApplication::Translate('New Asset Flag'), '<?= ($_ITEM->NewAssetFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->NewAssetFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->NewAssetFlag, false)));
			$this->colNewAssetId = new QDataGridColumn(QApplication::Translate('New Asset Id'), '<?= $_CONTROL->ParentControl->dtgAssetTransaction_NewAsset_Render($_ITEM); ?>');
			$this->colScheduleReceiptFlag = new QDataGridColumn(QApplication::Translate('Schedule Receipt Flag'), '<?= ($_ITEM->ScheduleReceiptFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->ScheduleReceiptFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->ScheduleReceiptFlag, false)));
			$this->colScheduleReceiptDueDate = new QDataGridColumn(QApplication::Translate('Schedule Receipt Due Date'), '<?= $_CONTROL->ParentControl->dtgAssetTransaction_ScheduleReceiptDueDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->ScheduleReceiptDueDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->ScheduleReceiptDueDate, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgAssetTransaction_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgAssetTransaction_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::AssetTransaction()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgAssetTransaction_ModifiedByObject_Render($_ITEM); ?>');
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
			$this->dtgAssetTransaction->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgAssetTransaction->SetDataBinder('dtgAssetTransaction_Bind', $this);

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

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('AssetTransaction');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgAssetTransaction_EditLinkColumn_Render(AssetTransaction $objAssetTransaction) {
			$strControlId = 'btnEdit' . $this->dtgAssetTransaction->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgAssetTransaction, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objAssetTransaction->AssetTransactionId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objAssetTransaction = AssetTransaction::Load($strParameterArray[0]);

			$objEditPanel = new AssetTransactionEditPanel($this, $this->strCloseEditPanelMethod, $objAssetTransaction);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new AssetTransactionEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
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


		public function dtgAssetTransaction_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgAssetTransaction->TotalItemCount = AssetTransaction::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgAssetTransaction->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgAssetTransaction->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgAssetTransaction->DataSource = AssetTransaction::LoadAll($objClauses);
		}
	}
?>