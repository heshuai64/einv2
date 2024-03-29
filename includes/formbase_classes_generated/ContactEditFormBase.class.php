<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the Contact class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single Contact object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this ContactEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class ContactEditFormBase extends QForm {
		// General Form Variables
		protected $objContact;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for Contact's Data Fields
		protected $lblContactId;
		protected $lstCompany;
		protected $lstAddress;
		protected $txtFirstName;
		protected $txtLastName;
		protected $txtTitle;
		protected $txtEmail;
		protected $txtPhoneOffice;
		protected $txtPhoneHome;
		protected $txtPhoneMobile;
		protected $txtFax;
		protected $txtDescription;
		protected $lstCreatedByObject;
		protected $calCreationDate;
		protected $lstModifiedByObject;
		protected $lblModifiedDate;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupContact() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intContactId = QApplication::QueryString('intContactId');
			if (($intContactId)) {
				$this->objContact = Contact::Load(($intContactId));

				if (!$this->objContact)
					throw new Exception('Could not find a Contact object with PK arguments: ' . $intContactId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objContact = new Contact();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupContact to either Load/Edit Existing or Create New
			$this->SetupContact();

			// Create/Setup Controls for Contact's Data Fields
			$this->lblContactId_Create();
			$this->lstCompany_Create();
			$this->lstAddress_Create();
			$this->txtFirstName_Create();
			$this->txtLastName_Create();
			$this->txtTitle_Create();
			$this->txtEmail_Create();
			$this->txtPhoneOffice_Create();
			$this->txtPhoneHome_Create();
			$this->txtPhoneMobile_Create();
			$this->txtFax_Create();
			$this->txtDescription_Create();
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
		// Create and Setup lblContactId
		protected function lblContactId_Create() {
			$this->lblContactId = new QLabel($this);
			$this->lblContactId->Name = QApplication::Translate('Contact Id');
			if ($this->blnEditMode)
				$this->lblContactId->Text = $this->objContact->ContactId;
			else
				$this->lblContactId->Text = 'N/A';
		}

		// Create and Setup lstCompany
		protected function lstCompany_Create() {
			$this->lstCompany = new QListBox($this);
			$this->lstCompany->Name = QApplication::Translate('Company');
			$this->lstCompany->Required = true;
			if (!$this->blnEditMode)
				$this->lstCompany->AddItem(QApplication::Translate('- Select One -'), null);
			$objCompanyArray = Company::LoadAll();
			if ($objCompanyArray) foreach ($objCompanyArray as $objCompany) {
				$objListItem = new QListItem($objCompany->__toString(), $objCompany->CompanyId);
				if (($this->objContact->Company) && ($this->objContact->Company->CompanyId == $objCompany->CompanyId))
					$objListItem->Selected = true;
				$this->lstCompany->AddItem($objListItem);
			}
		}

		// Create and Setup lstAddress
		protected function lstAddress_Create() {
			$this->lstAddress = new QListBox($this);
			$this->lstAddress->Name = QApplication::Translate('Address');
			$this->lstAddress->AddItem(QApplication::Translate('- Select One -'), null);
			$objAddressArray = Address::LoadAll();
			if ($objAddressArray) foreach ($objAddressArray as $objAddress) {
				$objListItem = new QListItem($objAddress->__toString(), $objAddress->AddressId);
				if (($this->objContact->Address) && ($this->objContact->Address->AddressId == $objAddress->AddressId))
					$objListItem->Selected = true;
				$this->lstAddress->AddItem($objListItem);
			}
		}

		// Create and Setup txtFirstName
		protected function txtFirstName_Create() {
			$this->txtFirstName = new QTextBox($this);
			$this->txtFirstName->Name = QApplication::Translate('First Name');
			$this->txtFirstName->Text = $this->objContact->FirstName;
			$this->txtFirstName->MaxLength = Contact::FirstNameMaxLength;
		}

		// Create and Setup txtLastName
		protected function txtLastName_Create() {
			$this->txtLastName = new QTextBox($this);
			$this->txtLastName->Name = QApplication::Translate('Last Name');
			$this->txtLastName->Text = $this->objContact->LastName;
			$this->txtLastName->Required = true;
			$this->txtLastName->MaxLength = Contact::LastNameMaxLength;
		}

		// Create and Setup txtTitle
		protected function txtTitle_Create() {
			$this->txtTitle = new QTextBox($this);
			$this->txtTitle->Name = QApplication::Translate('Title');
			$this->txtTitle->Text = $this->objContact->Title;
			$this->txtTitle->MaxLength = Contact::TitleMaxLength;
		}

		// Create and Setup txtEmail
		protected function txtEmail_Create() {
			$this->txtEmail = new QTextBox($this);
			$this->txtEmail->Name = QApplication::Translate('Email');
			$this->txtEmail->Text = $this->objContact->Email;
			$this->txtEmail->MaxLength = Contact::EmailMaxLength;
		}

		// Create and Setup txtPhoneOffice
		protected function txtPhoneOffice_Create() {
			$this->txtPhoneOffice = new QTextBox($this);
			$this->txtPhoneOffice->Name = QApplication::Translate('Phone Office');
			$this->txtPhoneOffice->Text = $this->objContact->PhoneOffice;
			$this->txtPhoneOffice->MaxLength = Contact::PhoneOfficeMaxLength;
		}

		// Create and Setup txtPhoneHome
		protected function txtPhoneHome_Create() {
			$this->txtPhoneHome = new QTextBox($this);
			$this->txtPhoneHome->Name = QApplication::Translate('Phone Home');
			$this->txtPhoneHome->Text = $this->objContact->PhoneHome;
			$this->txtPhoneHome->MaxLength = Contact::PhoneHomeMaxLength;
		}

		// Create and Setup txtPhoneMobile
		protected function txtPhoneMobile_Create() {
			$this->txtPhoneMobile = new QTextBox($this);
			$this->txtPhoneMobile->Name = QApplication::Translate('Phone Mobile');
			$this->txtPhoneMobile->Text = $this->objContact->PhoneMobile;
			$this->txtPhoneMobile->MaxLength = Contact::PhoneMobileMaxLength;
		}

		// Create and Setup txtFax
		protected function txtFax_Create() {
			$this->txtFax = new QTextBox($this);
			$this->txtFax->Name = QApplication::Translate('Fax');
			$this->txtFax->Text = $this->objContact->Fax;
			$this->txtFax->MaxLength = Contact::FaxMaxLength;
		}

		// Create and Setup txtDescription
		protected function txtDescription_Create() {
			$this->txtDescription = new QTextBox($this);
			$this->txtDescription->Name = QApplication::Translate('Description');
			$this->txtDescription->Text = $this->objContact->Description;
			$this->txtDescription->TextMode = QTextMode::MultiLine;
		}

		// Create and Setup lstCreatedByObject
		protected function lstCreatedByObject_Create() {
			$this->lstCreatedByObject = new QListBox($this);
			$this->lstCreatedByObject->Name = QApplication::Translate('Created By Object');
			$this->lstCreatedByObject->AddItem(QApplication::Translate('- Select One -'), null);
			$objCreatedByObjectArray = UserAccount::LoadAll();
			if ($objCreatedByObjectArray) foreach ($objCreatedByObjectArray as $objCreatedByObject) {
				$objListItem = new QListItem($objCreatedByObject->__toString(), $objCreatedByObject->UserAccountId);
				if (($this->objContact->CreatedByObject) && ($this->objContact->CreatedByObject->UserAccountId == $objCreatedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstCreatedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup calCreationDate
		protected function calCreationDate_Create() {
			$this->calCreationDate = new QDateTimePicker($this);
			$this->calCreationDate->Name = QApplication::Translate('Creation Date');
			$this->calCreationDate->DateTime = $this->objContact->CreationDate;
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
				if (($this->objContact->ModifiedByObject) && ($this->objContact->ModifiedByObject->UserAccountId == $objModifiedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstModifiedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup lblModifiedDate
		protected function lblModifiedDate_Create() {
			$this->lblModifiedDate = new QLabel($this);
			$this->lblModifiedDate->Name = QApplication::Translate('Modified Date');
			if ($this->blnEditMode)
				$this->lblModifiedDate->Text = $this->objContact->ModifiedDate;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Contact')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateContactFields() {
			$this->objContact->CompanyId = $this->lstCompany->SelectedValue;
			$this->objContact->AddressId = $this->lstAddress->SelectedValue;
			$this->objContact->FirstName = $this->txtFirstName->Text;
			$this->objContact->LastName = $this->txtLastName->Text;
			$this->objContact->Title = $this->txtTitle->Text;
			$this->objContact->Email = $this->txtEmail->Text;
			$this->objContact->PhoneOffice = $this->txtPhoneOffice->Text;
			$this->objContact->PhoneHome = $this->txtPhoneHome->Text;
			$this->objContact->PhoneMobile = $this->txtPhoneMobile->Text;
			$this->objContact->Fax = $this->txtFax->Text;
			$this->objContact->Description = $this->txtDescription->Text;
			$this->objContact->CreatedBy = $this->lstCreatedByObject->SelectedValue;
			$this->objContact->CreationDate = $this->calCreationDate->DateTime;
			$this->objContact->ModifiedBy = $this->lstModifiedByObject->SelectedValue;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateContactFields();
			$this->objContact->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objContact->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('contact_list.php');
		}
	}
?>