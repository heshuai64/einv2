<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the NotificationUserAccount class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single NotificationUserAccount object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this NotificationUserAccountEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class NotificationUserAccountEditFormBase extends QForm {
		// General Form Variables
		protected $objNotificationUserAccount;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for NotificationUserAccount's Data Fields
		protected $lblNotificationUserAccountId;
		protected $lstUserAccount;
		protected $lstNotification;
		protected $txtLevel;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupNotificationUserAccount() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intNotificationUserAccountId = QApplication::QueryString('intNotificationUserAccountId');
			if (($intNotificationUserAccountId)) {
				$this->objNotificationUserAccount = NotificationUserAccount::Load(($intNotificationUserAccountId));

				if (!$this->objNotificationUserAccount)
					throw new Exception('Could not find a NotificationUserAccount object with PK arguments: ' . $intNotificationUserAccountId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objNotificationUserAccount = new NotificationUserAccount();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupNotificationUserAccount to either Load/Edit Existing or Create New
			$this->SetupNotificationUserAccount();

			// Create/Setup Controls for NotificationUserAccount's Data Fields
			$this->lblNotificationUserAccountId_Create();
			$this->lstUserAccount_Create();
			$this->lstNotification_Create();
			$this->txtLevel_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblNotificationUserAccountId
		protected function lblNotificationUserAccountId_Create() {
			$this->lblNotificationUserAccountId = new QLabel($this);
			$this->lblNotificationUserAccountId->Name = QApplication::Translate('Notification User Account Id');
			if ($this->blnEditMode)
				$this->lblNotificationUserAccountId->Text = $this->objNotificationUserAccount->NotificationUserAccountId;
			else
				$this->lblNotificationUserAccountId->Text = 'N/A';
		}

		// Create and Setup lstUserAccount
		protected function lstUserAccount_Create() {
			$this->lstUserAccount = new QListBox($this);
			$this->lstUserAccount->Name = QApplication::Translate('User Account');
			$this->lstUserAccount->Required = true;
			if (!$this->blnEditMode)
				$this->lstUserAccount->AddItem(QApplication::Translate('- Select One -'), null);
			$objUserAccountArray = UserAccount::LoadAll();
			if ($objUserAccountArray) foreach ($objUserAccountArray as $objUserAccount) {
				$objListItem = new QListItem($objUserAccount->__toString(), $objUserAccount->UserAccountId);
				if (($this->objNotificationUserAccount->UserAccount) && ($this->objNotificationUserAccount->UserAccount->UserAccountId == $objUserAccount->UserAccountId))
					$objListItem->Selected = true;
				$this->lstUserAccount->AddItem($objListItem);
			}
		}

		// Create and Setup lstNotification
		protected function lstNotification_Create() {
			$this->lstNotification = new QListBox($this);
			$this->lstNotification->Name = QApplication::Translate('Notification');
			$this->lstNotification->Required = true;
			if (!$this->blnEditMode)
				$this->lstNotification->AddItem(QApplication::Translate('- Select One -'), null);
			$objNotificationArray = Notification::LoadAll();
			if ($objNotificationArray) foreach ($objNotificationArray as $objNotification) {
				$objListItem = new QListItem($objNotification->__toString(), $objNotification->NotificationId);
				if (($this->objNotificationUserAccount->Notification) && ($this->objNotificationUserAccount->Notification->NotificationId == $objNotification->NotificationId))
					$objListItem->Selected = true;
				$this->lstNotification->AddItem($objListItem);
			}
		}

		// Create and Setup txtLevel
		protected function txtLevel_Create() {
			$this->txtLevel = new QTextBox($this);
			$this->txtLevel->Name = QApplication::Translate('Level');
			$this->txtLevel->Text = $this->objNotificationUserAccount->Level;
		}


		// Setup btnSave
		protected function btnSave_Create() {
			$this->btnSave = new QButton($this);
			$this->btnSave->Text = QApplication::Translate('Save');
			$this->btnSave->AddAction(new QClickEvent(), new QServerAction('btnSave_Click'));
			$this->btnSave->PrimaryButton = true;
			$this->btnSave->CausesValidation = true;
		}

		// Setup btnCancel
		protected function btnCancel_Create() {
			$this->btnCancel = new QButton($this);
			$this->btnCancel->Text = QApplication::Translate('Cancel');
			$this->btnCancel->AddAction(new QClickEvent(), new QServerAction('btnCancel_Click'));
			$this->btnCancel->CausesValidation = false;
		}

		// Setup btnDelete
		protected function btnDelete_Create() {
			$this->btnDelete = new QButton($this);
			$this->btnDelete->Text = QApplication::Translate('Delete');
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'NotificationUserAccount')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateNotificationUserAccountFields() {
			$this->objNotificationUserAccount->UserAccountId = $this->lstUserAccount->SelectedValue;
			$this->objNotificationUserAccount->NotificationId = $this->lstNotification->SelectedValue;
			$this->objNotificationUserAccount->Level = $this->txtLevel->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateNotificationUserAccountFields();
			$this->objNotificationUserAccount->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objNotificationUserAccount->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('notification_user_account_list.php');
		}
	}
?>