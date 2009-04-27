<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the FedexServiceType class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single FedexServiceType object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this FedexServiceTypeEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class FedexServiceTypeEditFormBase extends QForm {
		// General Form Variables
		protected $objFedexServiceType;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for FedexServiceType's Data Fields
		protected $lblFedexServiceTypeId;
		protected $txtShortDescription;
		protected $txtValue;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupFedexServiceType() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intFedexServiceTypeId = QApplication::QueryString('intFedexServiceTypeId');
			if (($intFedexServiceTypeId)) {
				$this->objFedexServiceType = FedexServiceType::Load(($intFedexServiceTypeId));

				if (!$this->objFedexServiceType)
					throw new Exception('Could not find a FedexServiceType object with PK arguments: ' . $intFedexServiceTypeId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objFedexServiceType = new FedexServiceType();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupFedexServiceType to either Load/Edit Existing or Create New
			$this->SetupFedexServiceType();

			// Create/Setup Controls for FedexServiceType's Data Fields
			$this->lblFedexServiceTypeId_Create();
			$this->txtShortDescription_Create();
			$this->txtValue_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblFedexServiceTypeId
		protected function lblFedexServiceTypeId_Create() {
			$this->lblFedexServiceTypeId = new QLabel($this);
			$this->lblFedexServiceTypeId->Name = QApplication::Translate('Fedex Service Type Id');
			if ($this->blnEditMode)
				$this->lblFedexServiceTypeId->Text = $this->objFedexServiceType->FedexServiceTypeId;
			else
				$this->lblFedexServiceTypeId->Text = 'N/A';
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objFedexServiceType->ShortDescription;
			$this->txtShortDescription->Required = true;
			$this->txtShortDescription->MaxLength = FedexServiceType::ShortDescriptionMaxLength;
		}

		// Create and Setup txtValue
		protected function txtValue_Create() {
			$this->txtValue = new QTextBox($this);
			$this->txtValue->Name = QApplication::Translate('Value');
			$this->txtValue->Text = $this->objFedexServiceType->Value;
			$this->txtValue->Required = true;
			$this->txtValue->MaxLength = FedexServiceType::ValueMaxLength;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'FedexServiceType')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateFedexServiceTypeFields() {
			$this->objFedexServiceType->ShortDescription = $this->txtShortDescription->Text;
			$this->objFedexServiceType->Value = $this->txtValue->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateFedexServiceTypeFields();
			$this->objFedexServiceType->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objFedexServiceType->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('fedex_service_type_list.php');
		}
	}
?>