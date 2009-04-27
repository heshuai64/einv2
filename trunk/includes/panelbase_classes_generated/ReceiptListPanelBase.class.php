<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Receipt class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Receipt objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this ReceiptListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class ReceiptListPanelBase extends QPanel {
		public $dtgReceipt;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colReceiptId;
		protected $colTransactionId;
		protected $colFromCompanyId;
		protected $colFromContactId;
		protected $colToContactId;
		protected $colToAddressId;
		protected $colReceiptNumber;
		protected $colDueDate;
		protected $colReceiptDate;
		protected $colReceivedFlag;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgReceipt_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colReceiptId = new QDataGridColumn(QApplication::Translate('Receipt Id'), '<?= $_ITEM->ReceiptId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Receipt()->ReceiptId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Receipt()->ReceiptId, false)));
			$this->colTransactionId = new QDataGridColumn(QApplication::Translate('Transaction Id'), '<?= $_CONTROL->ParentControl->dtgReceipt_Transaction_Render($_ITEM); ?>');
			$this->colFromCompanyId = new QDataGridColumn(QApplication::Translate('From Company Id'), '<?= $_CONTROL->ParentControl->dtgReceipt_FromCompany_Render($_ITEM); ?>');
			$this->colFromContactId = new QDataGridColumn(QApplication::Translate('From Contact Id'), '<?= $_CONTROL->ParentControl->dtgReceipt_FromContact_Render($_ITEM); ?>');
			$this->colToContactId = new QDataGridColumn(QApplication::Translate('To Contact Id'), '<?= $_CONTROL->ParentControl->dtgReceipt_ToContact_Render($_ITEM); ?>');
			$this->colToAddressId = new QDataGridColumn(QApplication::Translate('To Address Id'), '<?= $_CONTROL->ParentControl->dtgReceipt_ToAddress_Render($_ITEM); ?>');
			$this->colReceiptNumber = new QDataGridColumn(QApplication::Translate('Receipt Number'), '<?= QString::Truncate($_ITEM->ReceiptNumber, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Receipt()->ReceiptNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Receipt()->ReceiptNumber, false)));
			$this->colDueDate = new QDataGridColumn(QApplication::Translate('Due Date'), '<?= $_CONTROL->ParentControl->dtgReceipt_DueDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Receipt()->DueDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Receipt()->DueDate, false)));
			$this->colReceiptDate = new QDataGridColumn(QApplication::Translate('Receipt Date'), '<?= $_CONTROL->ParentControl->dtgReceipt_ReceiptDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Receipt()->ReceiptDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Receipt()->ReceiptDate, false)));
			$this->colReceivedFlag = new QDataGridColumn(QApplication::Translate('Received Flag'), '<?= ($_ITEM->ReceivedFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Receipt()->ReceivedFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Receipt()->ReceivedFlag, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgReceipt_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgReceipt_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Receipt()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Receipt()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgReceipt_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Receipt()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Receipt()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgReceipt = new QDataGrid($this);
			$this->dtgReceipt->CellSpacing = 0;
			$this->dtgReceipt->CellPadding = 4;
			$this->dtgReceipt->BorderStyle = QBorderStyle::Solid;
			$this->dtgReceipt->BorderWidth = 1;
			$this->dtgReceipt->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgReceipt->Paginator = new QPaginator($this->dtgReceipt);
			$this->dtgReceipt->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgReceipt->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgReceipt->SetDataBinder('dtgReceipt_Bind', $this);

			$this->dtgReceipt->AddColumn($this->colEditLinkColumn);
			$this->dtgReceipt->AddColumn($this->colReceiptId);
			$this->dtgReceipt->AddColumn($this->colTransactionId);
			$this->dtgReceipt->AddColumn($this->colFromCompanyId);
			$this->dtgReceipt->AddColumn($this->colFromContactId);
			$this->dtgReceipt->AddColumn($this->colToContactId);
			$this->dtgReceipt->AddColumn($this->colToAddressId);
			$this->dtgReceipt->AddColumn($this->colReceiptNumber);
			$this->dtgReceipt->AddColumn($this->colDueDate);
			$this->dtgReceipt->AddColumn($this->colReceiptDate);
			$this->dtgReceipt->AddColumn($this->colReceivedFlag);
			$this->dtgReceipt->AddColumn($this->colCreatedBy);
			$this->dtgReceipt->AddColumn($this->colCreationDate);
			$this->dtgReceipt->AddColumn($this->colModifiedBy);
			$this->dtgReceipt->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Receipt');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgReceipt_EditLinkColumn_Render(Receipt $objReceipt) {
			$strControlId = 'btnEdit' . $this->dtgReceipt->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgReceipt, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objReceipt->ReceiptId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objReceipt = Receipt::Load($strParameterArray[0]);

			$objEditPanel = new ReceiptEditPanel($this, $this->strCloseEditPanelMethod, $objReceipt);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new ReceiptEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgReceipt_Transaction_Render(Receipt $objReceipt) {
			if (!is_null($objReceipt->Transaction))
				return $objReceipt->Transaction->__toString();
			else
				return null;
		}

		public function dtgReceipt_FromCompany_Render(Receipt $objReceipt) {
			if (!is_null($objReceipt->FromCompany))
				return $objReceipt->FromCompany->__toString();
			else
				return null;
		}

		public function dtgReceipt_FromContact_Render(Receipt $objReceipt) {
			if (!is_null($objReceipt->FromContact))
				return $objReceipt->FromContact->__toString();
			else
				return null;
		}

		public function dtgReceipt_ToContact_Render(Receipt $objReceipt) {
			if (!is_null($objReceipt->ToContact))
				return $objReceipt->ToContact->__toString();
			else
				return null;
		}

		public function dtgReceipt_ToAddress_Render(Receipt $objReceipt) {
			if (!is_null($objReceipt->ToAddress))
				return $objReceipt->ToAddress->__toString();
			else
				return null;
		}

		public function dtgReceipt_DueDate_Render(Receipt $objReceipt) {
			if (!is_null($objReceipt->DueDate))
				return $objReceipt->DueDate->__toString(QDateTime::FormatDisplayDate);
			else
				return null;
		}

		public function dtgReceipt_ReceiptDate_Render(Receipt $objReceipt) {
			if (!is_null($objReceipt->ReceiptDate))
				return $objReceipt->ReceiptDate->__toString(QDateTime::FormatDisplayDate);
			else
				return null;
		}

		public function dtgReceipt_CreatedByObject_Render(Receipt $objReceipt) {
			if (!is_null($objReceipt->CreatedByObject))
				return $objReceipt->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgReceipt_CreationDate_Render(Receipt $objReceipt) {
			if (!is_null($objReceipt->CreationDate))
				return $objReceipt->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgReceipt_ModifiedByObject_Render(Receipt $objReceipt) {
			if (!is_null($objReceipt->ModifiedByObject))
				return $objReceipt->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgReceipt_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgReceipt->TotalItemCount = Receipt::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgReceipt->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgReceipt->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgReceipt->DataSource = Receipt::LoadAll($objClauses);
		}
	}
?>