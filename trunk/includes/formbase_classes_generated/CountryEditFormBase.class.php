<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the Country class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single Country object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this CountryEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class CountryEditFormBase extends QForm {
		// General Form Variables
		protected $objCountry;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for Country's Data Fields
		protected $lblCountryId;
		protected $txtShortDescription;
		protected $txtAbbreviation;
		protected $chkStateFlag;
		protected $chkProvinceFlag;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupCountry() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intCountryId = QApplication::QueryString('intCountryId');
			if (($intCountryId)) {
				$this->objCountry = Country::Load(($intCountryId));

				if (!$this->objCountry)
					throw new Exception('Could not find a Country object with PK arguments: ' . $intCountryId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objCountry = new Country();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupCountry to either Load/Edit Existing or Create New
			$this->SetupCountry();

			// Create/Setup Controls for Country's Data Fields
			$this->lblCountryId_Create();
			$this->txtShortDescription_Create();
			$this->txtAbbreviation_Create();
			$this->chkStateFlag_Create();
			$this->chkProvinceFlag_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblCountryId
		protected function lblCountryId_Create() {
			$this->lblCountryId = new QLabel($this);
			$this->lblCountryId->Name = QApplication::Translate('Country Id');
			if ($this->blnEditMode)
				$this->lblCountryId->Text = $this->objCountry->CountryId;
			else
				$this->lblCountryId->Text = 'N/A';
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objCountry->ShortDescription;
			$this->txtShortDescription->Required = true;
			$this->txtShortDescription->MaxLength = Country::ShortDescriptionMaxLength;
		}

		// Create and Setup txtAbbreviation
		protected function txtAbbreviation_Create() {
			$this->txtAbbreviation = new QTextBox($this);
			$this->txtAbbreviation->Name = QApplication::Translate('Abbreviation');
			$this->txtAbbreviation->Text = $this->objCountry->Abbreviation;
			$this->txtAbbreviation->MaxLength = Country::AbbreviationMaxLength;
		}

		// Create and Setup chkStateFlag
		protected function chkStateFlag_Create() {
			$this->chkStateFlag = new QCheckBox($this);
			$this->chkStateFlag->Name = QApplication::Translate('State Flag');
			$this->chkStateFlag->Checked = $this->objCountry->StateFlag;
		}

		// Create and Setup chkProvinceFlag
		protected function chkProvinceFlag_Create() {
			$this->chkProvinceFlag = new QCheckBox($this);
			$this->chkProvinceFlag->Name = QApplication::Translate('Province Flag');
			$this->chkProvinceFlag->Checked = $this->objCountry->ProvinceFlag;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Country')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateCountryFields() {
			$this->objCountry->ShortDescription = $this->txtShortDescription->Text;
			$this->objCountry->Abbreviation = $this->txtAbbreviation->Text;
			$this->objCountry->StateFlag = $this->chkStateFlag->Checked;
			$this->objCountry->ProvinceFlag = $this->chkProvinceFlag->Checked;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateCountryFields();
			$this->objCountry->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objCountry->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('country_list.php');
		}
	}
?>