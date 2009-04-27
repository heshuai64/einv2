<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the StateProvince class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single StateProvince object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this StateProvinceEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class StateProvinceEditFormBase extends QForm {
		// General Form Variables
		protected $objStateProvince;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for StateProvince's Data Fields
		protected $lblStateProvinceId;
		protected $lstCountry;
		protected $txtShortDescription;
		protected $txtAbbreviation;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupStateProvince() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intStateProvinceId = QApplication::QueryString('intStateProvinceId');
			if (($intStateProvinceId)) {
				$this->objStateProvince = StateProvince::Load(($intStateProvinceId));

				if (!$this->objStateProvince)
					throw new Exception('Could not find a StateProvince object with PK arguments: ' . $intStateProvinceId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objStateProvince = new StateProvince();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupStateProvince to either Load/Edit Existing or Create New
			$this->SetupStateProvince();

			// Create/Setup Controls for StateProvince's Data Fields
			$this->lblStateProvinceId_Create();
			$this->lstCountry_Create();
			$this->txtShortDescription_Create();
			$this->txtAbbreviation_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblStateProvinceId
		protected function lblStateProvinceId_Create() {
			$this->lblStateProvinceId = new QLabel($this);
			$this->lblStateProvinceId->Name = QApplication::Translate('State Province Id');
			if ($this->blnEditMode)
				$this->lblStateProvinceId->Text = $this->objStateProvince->StateProvinceId;
			else
				$this->lblStateProvinceId->Text = 'N/A';
		}

		// Create and Setup lstCountry
		protected function lstCountry_Create() {
			$this->lstCountry = new QListBox($this);
			$this->lstCountry->Name = QApplication::Translate('Country');
			$this->lstCountry->AddItem(QApplication::Translate('- Select One -'), null);
			$objCountryArray = Country::LoadAll();
			if ($objCountryArray) foreach ($objCountryArray as $objCountry) {
				$objListItem = new QListItem($objCountry->__toString(), $objCountry->CountryId);
				if (($this->objStateProvince->Country) && ($this->objStateProvince->Country->CountryId == $objCountry->CountryId))
					$objListItem->Selected = true;
				$this->lstCountry->AddItem($objListItem);
			}
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objStateProvince->ShortDescription;
			$this->txtShortDescription->MaxLength = StateProvince::ShortDescriptionMaxLength;
		}

		// Create and Setup txtAbbreviation
		protected function txtAbbreviation_Create() {
			$this->txtAbbreviation = new QTextBox($this);
			$this->txtAbbreviation->Name = QApplication::Translate('Abbreviation');
			$this->txtAbbreviation->Text = $this->objStateProvince->Abbreviation;
			$this->txtAbbreviation->MaxLength = StateProvince::AbbreviationMaxLength;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'StateProvince')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateStateProvinceFields() {
			$this->objStateProvince->CountryId = $this->lstCountry->SelectedValue;
			$this->objStateProvince->ShortDescription = $this->txtShortDescription->Text;
			$this->objStateProvince->Abbreviation = $this->txtAbbreviation->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateStateProvinceFields();
			$this->objStateProvince->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objStateProvince->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('state_province_list.php');
		}
	}
?>