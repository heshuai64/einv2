<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the UserAccount class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of UserAccount objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this UserAccountListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class UserAccountListPanelBase extends QPanel {
		public $dtgUserAccount;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colUserAccountId;
		protected $colFirstName;
		protected $colLastName;
		protected $colUsername;
		protected $colPasswordHash;
		protected $colEmailAddress;
		protected $colActiveFlag;
		protected $colAdminFlag;
		protected $colPortableAccessFlag;
		protected $colPortableUserPin;
		protected $colRoleId;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgUserAccount_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colUserAccountId = new QDataGridColumn(QApplication::Translate('User Account Id'), '<?= $_ITEM->UserAccountId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserAccount()->UserAccountId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserAccount()->UserAccountId, false)));
			$this->colFirstName = new QDataGridColumn(QApplication::Translate('First Name'), '<?= QString::Truncate($_ITEM->FirstName, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserAccount()->FirstName), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserAccount()->FirstName, false)));
			$this->colLastName = new QDataGridColumn(QApplication::Translate('Last Name'), '<?= QString::Truncate($_ITEM->LastName, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserAccount()->LastName), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserAccount()->LastName, false)));
			$this->colUsername = new QDataGridColumn(QApplication::Translate('Username'), '<?= QString::Truncate($_ITEM->Username, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserAccount()->Username), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserAccount()->Username, false)));
			$this->colPasswordHash = new QDataGridColumn(QApplication::Translate('Password Hash'), '<?= QString::Truncate($_ITEM->PasswordHash, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserAccount()->PasswordHash), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserAccount()->PasswordHash, false)));
			$this->colEmailAddress = new QDataGridColumn(QApplication::Translate('Email Address'), '<?= QString::Truncate($_ITEM->EmailAddress, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserAccount()->EmailAddress), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserAccount()->EmailAddress, false)));
			$this->colActiveFlag = new QDataGridColumn(QApplication::Translate('Active Flag'), '<?= ($_ITEM->ActiveFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserAccount()->ActiveFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserAccount()->ActiveFlag, false)));
			$this->colAdminFlag = new QDataGridColumn(QApplication::Translate('Admin Flag'), '<?= ($_ITEM->AdminFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserAccount()->AdminFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserAccount()->AdminFlag, false)));
			$this->colPortableAccessFlag = new QDataGridColumn(QApplication::Translate('Portable Access Flag'), '<?= ($_ITEM->PortableAccessFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserAccount()->PortableAccessFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserAccount()->PortableAccessFlag, false)));
			$this->colPortableUserPin = new QDataGridColumn(QApplication::Translate('Portable User Pin'), '<?= $_ITEM->PortableUserPin; ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserAccount()->PortableUserPin), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserAccount()->PortableUserPin, false)));
			$this->colRoleId = new QDataGridColumn(QApplication::Translate('Role Id'), '<?= $_CONTROL->ParentControl->dtgUserAccount_Role_Render($_ITEM); ?>');
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgUserAccount_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgUserAccount_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserAccount()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserAccount()->CreationDate, false)));
			$this->colModifiedBy = new QDataGridColumn(QApplication::Translate('Modified By'), '<?= $_CONTROL->ParentControl->dtgUserAccount_ModifiedByObject_Render($_ITEM); ?>');
			$this->colModifiedDate = new QDataGridColumn(QApplication::Translate('Modified Date'), '<?= QString::Truncate($_ITEM->ModifiedDate, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::UserAccount()->ModifiedDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::UserAccount()->ModifiedDate, false)));

			// Setup DataGrid
			$this->dtgUserAccount = new QDataGrid($this);
			$this->dtgUserAccount->CellSpacing = 0;
			$this->dtgUserAccount->CellPadding = 4;
			$this->dtgUserAccount->BorderStyle = QBorderStyle::Solid;
			$this->dtgUserAccount->BorderWidth = 1;
			$this->dtgUserAccount->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgUserAccount->Paginator = new QPaginator($this->dtgUserAccount);
			$this->dtgUserAccount->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgUserAccount->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgUserAccount->SetDataBinder('dtgUserAccount_Bind', $this);

			$this->dtgUserAccount->AddColumn($this->colEditLinkColumn);
			$this->dtgUserAccount->AddColumn($this->colUserAccountId);
			$this->dtgUserAccount->AddColumn($this->colFirstName);
			$this->dtgUserAccount->AddColumn($this->colLastName);
			$this->dtgUserAccount->AddColumn($this->colUsername);
			$this->dtgUserAccount->AddColumn($this->colPasswordHash);
			$this->dtgUserAccount->AddColumn($this->colEmailAddress);
			$this->dtgUserAccount->AddColumn($this->colActiveFlag);
			$this->dtgUserAccount->AddColumn($this->colAdminFlag);
			$this->dtgUserAccount->AddColumn($this->colPortableAccessFlag);
			$this->dtgUserAccount->AddColumn($this->colPortableUserPin);
			$this->dtgUserAccount->AddColumn($this->colRoleId);
			$this->dtgUserAccount->AddColumn($this->colCreatedBy);
			$this->dtgUserAccount->AddColumn($this->colCreationDate);
			$this->dtgUserAccount->AddColumn($this->colModifiedBy);
			$this->dtgUserAccount->AddColumn($this->colModifiedDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('UserAccount');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgUserAccount_EditLinkColumn_Render(UserAccount $objUserAccount) {
			$strControlId = 'btnEdit' . $this->dtgUserAccount->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgUserAccount, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objUserAccount->UserAccountId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objUserAccount = UserAccount::Load($strParameterArray[0]);

			$objEditPanel = new UserAccountEditPanel($this, $this->strCloseEditPanelMethod, $objUserAccount);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new UserAccountEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgUserAccount_Role_Render(UserAccount $objUserAccount) {
			if (!is_null($objUserAccount->Role))
				return $objUserAccount->Role->__toString();
			else
				return null;
		}

		public function dtgUserAccount_CreatedByObject_Render(UserAccount $objUserAccount) {
			if (!is_null($objUserAccount->CreatedByObject))
				return $objUserAccount->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgUserAccount_CreationDate_Render(UserAccount $objUserAccount) {
			if (!is_null($objUserAccount->CreationDate))
				return $objUserAccount->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}

		public function dtgUserAccount_ModifiedByObject_Render(UserAccount $objUserAccount) {
			if (!is_null($objUserAccount->ModifiedByObject))
				return $objUserAccount->ModifiedByObject->__toString();
			else
				return null;
		}


		public function dtgUserAccount_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgUserAccount->TotalItemCount = UserAccount::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgUserAccount->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgUserAccount->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgUserAccount->DataSource = UserAccount::LoadAll($objClauses);
		}
	}
?>