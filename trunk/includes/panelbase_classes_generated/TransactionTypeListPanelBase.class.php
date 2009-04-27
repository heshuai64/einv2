<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the TransactionType class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of TransactionType objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this TransactionTypeListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class TransactionTypeListPanelBase extends QPanel {
		public $dtgTransactionType;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colTransactionTypeId;
		protected $colShortDescription;
		protected $colAssetFlag;
		protected $colInventoryFlag;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgTransactionType_EditLinkColumn_Render($_ITEM) ?>');
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
			$this->dtgTransactionType->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgTransactionType->SetDataBinder('dtgTransactionType_Bind', $this);

			$this->dtgTransactionType->AddColumn($this->colEditLinkColumn);
			$this->dtgTransactionType->AddColumn($this->colTransactionTypeId);
			$this->dtgTransactionType->AddColumn($this->colShortDescription);
			$this->dtgTransactionType->AddColumn($this->colAssetFlag);
			$this->dtgTransactionType->AddColumn($this->colInventoryFlag);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('TransactionType');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgTransactionType_EditLinkColumn_Render(TransactionType $objTransactionType) {
			$strControlId = 'btnEdit' . $this->dtgTransactionType->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgTransactionType, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objTransactionType->TransactionTypeId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objTransactionType = TransactionType::Load($strParameterArray[0]);

			$objEditPanel = new TransactionTypeEditPanel($this, $this->strCloseEditPanelMethod, $objTransactionType);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new TransactionTypeEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}


		public function dtgTransactionType_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgTransactionType->TotalItemCount = TransactionType::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgTransactionType->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgTransactionType->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgTransactionType->DataSource = TransactionType::LoadAll($objClauses);
		}
	}
?>