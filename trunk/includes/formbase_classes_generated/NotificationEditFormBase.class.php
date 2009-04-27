<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the Notification class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single Notification object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this NotificationEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class NotificationEditFormBase extends QForm {
		// General Form Variables
		protected $objNotification;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for Notification's Data Fields
		protected $lblNotificationId;
		protected $txtShortDescription;
		protected $txtLongDescription;
		protected $txtCriteria;
		protected $txtFrequency;
		protected $chkEnabledFlag;
		protected $lstCreatedByObject;
		protected $calCreationDate;
		protected $lstModifiedByObject;
		protected $lblModifiedDate;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupNotification() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intNotificationId = QApplication::QueryString('intNotificationId');
			if (($intNotificationId)) {
				$this->objNotification = Notification::Load(($intNotificationId));

				if (!$this->objNotification)
					throw new Exception('Could not find a Notification object with PK arguments: ' . $intNotificationId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objNotification = new Notification();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupNotification to either Load/Edit Existing or Create New
			$this->SetupNotification();

			// Create/Setup Controls for Notification's Data Fields
			$this->lblNotificationId_Create();
			$this->txtShortDescription_Create();
			$this->txtLongDescription_Create();
			$this->txtCriteria_Create();
			$this->txtFrequency_Create();
			$this->chkEnabledFlag_Create();
			$this->lstCreatedByObject_Create();
			$this->calCreationDate_Create();
			$this->lstModifiedByObject_Create();
			$this->lblModifiedDate_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblNotificationId
		protected function lblNotificationId_Create() {
			$this->lblNotificationId = new QLabel($this);
			$this->lblNotificationId->Name = QApplication::Translate('Notification Id');
			if ($this->blnEditMode)
				$this->lblNotificationId->Text = $this->objNotification->NotificationId;
			else
				$this->lblNotificationId->Text = 'N/A';
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objNotification->ShortDescription;
			$this->txtShortDescription->Required = true;
			$this->txtShortDescription->MaxLength = Notification::ShortDescriptionMaxLength;
		}

		// Create and Setup txtLongDescription
		protected function txtLongDescription_Create() {
			$this->txtLongDescription = new QTextBox($this);
			$this->txtLongDescription->Name = QApplication::Translate('Long Description');
			$this->txtLongDescription->Text = $this->objNotification->LongDescription;
			$this->txtLongDescription->TextMode = QTextMode::MultiLine;
		}

		// Create and Setup txtCriteria
		protected function txtCriteria_Create() {
			$this->txtCriteria = new QTextBox($this);
			$this->txtCriteria->Name = QApplication::Translate('Criteria');
			$this->txtCriteria->Text = $this->objNotification->Criteria;
			$this->txtCriteria->MaxLength = Notification::CriteriaMaxLength;
		}

		// Create and Setup txtFrequency
		protected function txtFrequency_Create() {
			$this->txtFrequency = new QTextBox($this);
			$this->txtFrequency->Name = QApplication::Translate('Frequency');
			$this->txtFrequency->Text = $this->objNotification->Frequency;
			$this->txtFrequency->Required = true;
		}

		// Create and Setup chkEnabledFlag
		protected function chkEnabledFlag_Create() {
			$this->chkEnabledFlag = new QCheckBox($this);
			$this->chkEnabledFlag->Name = QApplication::Translate('Enabled Flag');
			$this->chkEnabledFlag->Checked = $this->objNotification->EnabledFlag;
		}

		// Create and Setup lstCreatedByObject
		protected function lstCreatedByObject_Create() {
			$this->lstCreatedByObject = new QListBox($this);
			$this->lstCreatedByObject->Name = QApplication::Translate('Created By Object');
			$this->lstCreatedByObject->AddItem(QApplication::Translate('- Select One -'), null);
			$objCreatedByObjectArray = UserAccount::LoadAll();
			if ($objCreatedByObjectArray) foreach ($objCreatedByObjectArray as $objCreatedByObject) {
				$objListItem = new QListItem($objCreatedByObject->__toString(), $objCreatedByObject->UserAccountId);
				if (($this->objNotification->CreatedByObject) && ($this->objNotification->CreatedByObject->UserAccountId == $objCreatedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstCreatedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup calCreationDate
		protected function calCreationDate_Create() {
			$this->calCreationDate = new QDateTimePicker($this);
			$this->calCreationDate->Name = QApplication::Translate('Creation Date');
			$this->calCreationDate->DateTime = $this->objNotification->CreationDate;
			$this->calCreationDate->DateTimePickerType = QDateTimePickerType::DateTime;
		}

		// Create and Setup lstModifiedByObject
		protected function lstModifiedByObject_Create() {
			$this->lstModifiedByObject = new QListBox($this);
			$this->lstModifiedByObject->Name = QApplication::Translate('Modified By Object');
			$this->lstModifiedByObject->AddItem(QApplication::Translate('- Select One -'), null);
			$objModifiedByObjectArray = UserAccount::LoadAll();
			if ($objModifiedByObjectArray) foreach ($objModifiedByObjectArray as $objModifiedByObject) {
				$objListItem = new QListItem($objModifiedByObject->__toString(), $objModifiedByObject->UserAccountId);
				if (($this->objNotification->ModifiedByObject) && ($this->objNotification->ModifiedByObject->UserAccountId == $objModifiedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstModifiedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup lblModifiedDate
		protected function lblModifiedDate_Create() {
			$this->lblModifiedDate = new QLabel($this);
			$this->lblModifiedDate->Name = QApplication::Translate('Modified Date');
			if ($this->blnEditMode)
				$this->lblModifiedDate->Text = $this->objNotification->ModifiedDate;
			else
				$this->lblModifiedDate->Text = 'N/A';
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Notification')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateNotificationFields() {
			$this->objNotification->ShortDescription = $this->txtShortDescription->Text;
			$this->objNotification->LongDescription = $this->txtLongDescription->Text;
			$this->objNotification->Criteria = $this->txtCriteria->Text;
			$this->objNotification->Frequency = $this->txtFrequency->Text;
			$this->objNotification->EnabledFlag = $this->chkEnabledFlag->Checked;
			$this->objNotification->CreatedBy = $this->lstCreatedByObject->SelectedValue;
			$this->objNotification->CreationDate = $this->calCreationDate->DateTime;
			$this->objNotification->ModifiedBy = $this->lstModifiedByObject->SelectedValue;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateNotificationFields();
			$this->objNotification->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objNotification->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('notification_list.php');
		}
	}
?>