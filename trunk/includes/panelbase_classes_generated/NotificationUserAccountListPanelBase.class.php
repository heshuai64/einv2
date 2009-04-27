<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the NotificationUserAccount class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of NotificationUserAccount objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this NotificationUserAccountListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class NotificationUserAccountListPanelBase extends QPanel {
		public $dtgNotificationUserAccount;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colNotificationUserAccountId;
		protected $colUserAccountId;
		protected $colNotificationId;
		protected $colLevel;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgNotificationUserAccount_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colNotificationUserAccountId = new QDataGridColumn(QApplication::Translate('Notification User Account Id'), '<?= $_ITEM->NotificationUserAccountId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::NotificationUserAccount()->NotificationUserAccountId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::NotificationUserAccount()->NotificationUserAccountId, false)));
			$this->colUserAccountId = new QDataGridColumn(QApplication::Translate('User Account Id'), '<?= $_CONTROL->ParentControl->dtgNotificationUserAccount_UserAccount_Render($_ITEM); ?>');
			$this->colNotificationId = new QDataGridColumn(QApplication::Translate('Notification Id'), '<?= $_CONTROL->ParentControl->dtgNotificationUserAccount_Notification_Render($_ITEM); ?>');
			$this->colLevel = new QDataGridColumn(QApplication::Translate('Level'), '<?= QString::Truncate($_ITEM->Level, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::NotificationUserAccount()->Level), 'ReverseOrderByClause' => QQ::OrderBy(QQN::NotificationUserAccount()->Level, false)));

			// Setup DataGrid
			$this->dtgNotificationUserAccount = new QDataGrid($this);
			$this->dtgNotificationUserAccount->CellSpacing = 0;
			$this->dtgNotificationUserAccount->CellPadding = 4;
			$this->dtgNotificationUserAccount->BorderStyle = QBorderStyle::Solid;
			$this->dtgNotificationUserAccount->BorderWidth = 1;
			$this->dtgNotificationUserAccount->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgNotificationUserAccount->Paginator = new QPaginator($this->dtgNotificationUserAccount);
			$this->dtgNotificationUserAccount->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgNotificationUserAccount->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgNotificationUserAccount->SetDataBinder('dtgNotificationUserAccount_Bind', $this);

			$this->dtgNotificationUserAccount->AddColumn($this->colEditLinkColumn);
			$this->dtgNotificationUserAccount->AddColumn($this->colNotificationUserAccountId);
			$this->dtgNotificationUserAccount->AddColumn($this->colUserAccountId);
			$this->dtgNotificationUserAccount->AddColumn($this->colNotificationId);
			$this->dtgNotificationUserAccount->AddColumn($this->colLevel);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('NotificationUserAccount');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgNotificationUserAccount_EditLinkColumn_Render(NotificationUserAccount $objNotificationUserAccount) {
			$strControlId = 'btnEdit' . $this->dtgNotificationUserAccount->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgNotificationUserAccount, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objNotificationUserAccount->NotificationUserAccountId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objNotificationUserAccount = NotificationUserAccount::Load($strParameterArray[0]);

			$objEditPanel = new NotificationUserAccountEditPanel($this, $this->strCloseEditPanelMethod, $objNotificationUserAccount);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new NotificationUserAccountEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgNotificationUserAccount_UserAccount_Render(NotificationUserAccount $objNotificationUserAccount) {
			if (!is_null($objNotificationUserAccount->UserAccount))
				return $objNotificationUserAccount->UserAccount->__toString();
			else
				return null;
		}

		public function dtgNotificationUserAccount_Notification_Render(NotificationUserAccount $objNotificationUserAccount) {
			if (!is_null($objNotificationUserAccount->Notification))
				return $objNotificationUserAccount->Notification->__toString();
			else
				return null;
		}


		public function dtgNotificationUserAccount_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgNotificationUserAccount->TotalItemCount = NotificationUserAccount::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgNotificationUserAccount->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgNotificationUserAccount->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgNotificationUserAccount->DataSource = NotificationUserAccount::LoadAll($objClauses);
		}
	}
?>