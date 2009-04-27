<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the NotificationUserAccount class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of NotificationUserAccount objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this NotificationUserAccountListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class NotificationUserAccountListFormBase extends QForm {
		protected $dtgNotificationUserAccount;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colNotificationUserAccountId;
		protected $colUserAccountId;
		protected $colNotificationId;
		protected $colLevel;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgNotificationUserAccount_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colNotificationUserAccountId = new QDataGridColumn(QApplication::Translate('Notification User Account Id'), '<?= $_ITEM->NotificationUserAccountId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::NotificationUserAccount()->NotificationUserAccountId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::NotificationUserAccount()->NotificationUserAccountId, false)));
			$this->colUserAccountId = new QDataGridColumn(QApplication::Translate('User Account Id'), '<?= $_FORM->dtgNotificationUserAccount_UserAccount_Render($_ITEM); ?>');
			$this->colNotificationId = new QDataGridColumn(QApplication::Translate('Notification Id'), '<?= $_FORM->dtgNotificationUserAccount_Notification_Render($_ITEM); ?>');
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
			$this->dtgNotificationUserAccount->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgNotificationUserAccount->SetDataBinder('dtgNotificationUserAccount_Bind');

			$this->dtgNotificationUserAccount->AddColumn($this->colEditLinkColumn);
			$this->dtgNotificationUserAccount->AddColumn($this->colNotificationUserAccountId);
			$this->dtgNotificationUserAccount->AddColumn($this->colUserAccountId);
			$this->dtgNotificationUserAccount->AddColumn($this->colNotificationId);
			$this->dtgNotificationUserAccount->AddColumn($this->colLevel);
		}
		
		public function dtgNotificationUserAccount_EditLinkColumn_Render(NotificationUserAccount $objNotificationUserAccount) {
			return sprintf('<a href="notification_user_account_edit.php?intNotificationUserAccountId=%s">%s</a>',
				$objNotificationUserAccount->NotificationUserAccountId, 
				QApplication::Translate('Edit'));
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


		protected function dtgNotificationUserAccount_Bind() {
			// Because we want to enable pagination AND sorting, we need to setup the $objClauses array to send to LoadAll()

			// Remember!  We need to first set the TotalItemCount, which will affect the calcuation of LimitClause below
			$this->dtgNotificationUserAccount->TotalItemCount = NotificationUserAccount::CountAll();

			// Setup the $objClauses Array
			$objClauses = array();

			// If a column is selected to be sorted, and if that column has a OrderByClause set on it, then let's add
			// the OrderByClause to the $objClauses array
			if ($objClause = $this->dtgNotificationUserAccount->OrderByClause)
				array_push($objClauses, $objClause);

			// Add the LimitClause information, as well
			if ($objClause = $this->dtgNotificationUserAccount->LimitClause)
				array_push($objClauses, $objClause);

			// Set the DataSource to be the array of all NotificationUserAccount objects, given the clauses above
			$this->dtgNotificationUserAccount->DataSource = NotificationUserAccount::LoadAll($objClauses);
		}
	}
?>