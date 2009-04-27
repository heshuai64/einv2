<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the ShippingAccount class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of ShippingAccount objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this ShippingAccountListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class ShippingAccountListPanelBase extends QPanel {
		public $dtgShippingAccount;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colShippingAccountId;
		protected $colCourierId;
		protected $colShortDescription;
		protected $colAccessId;
		protected $colAccessCode;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgShippingAccount_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colShippingAccountId = new QDataGridColumn(QApplication::Translate('Shipping Account Id'), '<?= $_ITEM->ShippingAccountId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::ShippingAccount()->ShippingAccountId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ShippingAccount()->ShippingAccountId, false)));
			$this->colCourierId = new QDataGridColumn(QApplication::Translate('Courier Id'), '<?= $_CONTROL->ParentControl->dtgShippingAccount_Courier_Render($_ITEM); ?>');
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::ShippingAccount()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ShippingAccount()->ShortDescription, false)));
			$this->colAccessId = new QDataGridColumn(QApplication::Translate('Access Id'), '<?= QString::Truncate($_ITEM->AccessId, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::ShippingAccount()->AccessId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ShippingAccount()->AccessId, false)));
			$this->colAccessCode = new QDataGridColumn(QApplication::Translate('Access Code'), '<?= QString::Truncate($_ITEM->AccessCode, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::ShippingAccount()->AccessCode), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ShippingAccount()->AccessCode, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgShippingAccount_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgShippingAccount_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::ShippingAccount()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ShippingAccount()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgShippingAccount_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::ShippingAccount()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ShippingAccount()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgShippingAccount = new QDataGrid($this);
			$this->dtgShippingAccount->CellSpacing = 0;
			$this->dtgShippingAccount->CellPadding = 4;
			$this->dtgShippingAccount->BorderStyle = QBorderStyle::Solid;
			$this->dtgShippingAccount->BorderWidth = 1;
			$this->dtgShippingAccount->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgShippingAccount->Paginator = new QPaginator($this->dtgShippingAccount);
			$this->dtgShippingAccount->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgShippingAccount->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgShippingAccount->SetDataBinder('dtgShippingAccount_Bind', $this);

			$this->dtgShippingAccount->AddColumn($this->colEditLinkColumn);
			$this->dtgShippingAccount->AddColumn($this->colShippingAccountId);
			$this->dtgShippingAccount->AddColumn($this->colCourierId);
			$this->dtgShippingAccount->AddColumn($this->colShortDescription);
			$this->dtgShippingAccount->AddColumn($this->colAccessId);
			$this->dtgShippingAccount->AddColumn($this->colAccessCode);
			$this->dtgShippingAccount->AddColumn($this->colCreatedBy);
			$this->dtgShippingAccount->AddColumn($this->colCreationDate);
			$this->dtgShippingAccount->AddColumn($this->colModifiedBy);
			$this->dtgShippingAccount->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('ShippingAccount');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgShippingAccount_EditLinkColumn_Render(ShippingAccount $objShippingAccount) {
			$strControlId = 'btnEdit' . $this->dtgShippingAccount->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgShippingAccount, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objShippingAccount->ShippingAccountId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objShippingAccount = ShippingAccount::Load($strParameterArray[0]);

			$objEditPanel = new ShippingAccountEditPanel($this, $this->strCloseEditPanelMethod, $objShippingAccount);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new ShippingAccountEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgShippingAccount_Courier_Render(ShippingAccount $objShippingAccount) {
			if (!is_null($objShippingAccount->Courier))
				return $objShippingAccount->Courier->__toString();
			else
				return null;
		}

		public function dtgShippingAccount_CreatedByObject_Render(ShippingAccount $objShippingAccount) {
			if (!is_null($objShippingAccount->CreatedByObject))
				return $objShippingAccount->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgShippingAccount_CreationDate_Render(ShippingAccount $objShippingAccount) {
			if (!is_null($objShippingAccount->CreationDate))
				return $objShippingAccount->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgShippingAccount_ModifiedByObject_Render(ShippingAccount $objShippingAccount) {
			if (!is_null($objShippingAccount->ModifiedByObject))
				return $objShippingAccount->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgShippingAccount_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgShippingAccount->TotalItemCount = ShippingAccount::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgShippingAccount->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgShippingAccount->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgShippingAccount->DataSource = ShippingAccount::LoadAll($objClauses);
		}
	}
?>