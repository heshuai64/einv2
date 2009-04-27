<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the LengthUnit class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single LengthUnit object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this LengthUnitEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class LengthUnitEditFormBase extends QForm {
		// General Form Variables
		protected $objLengthUnit;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for LengthUnit's Data Fields
		protected $lblLengthUnitId;
		protected $txtShortDescription;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupLengthUnit() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intLengthUnitId = QApplication::QueryString('intLengthUnitId');
			if (($intLengthUnitId)) {
				$this->objLengthUnit = LengthUnit::Load(($intLengthUnitId));

				if (!$this->objLengthUnit)
					throw new Exception('Could not find a LengthUnit object with PK arguments: ' . $intLengthUnitId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objLengthUnit = new LengthUnit();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupLengthUnit to either Load/Edit Existing or Create New
			$this->SetupLengthUnit();

			// Create/Setup Controls for LengthUnit's Data Fields
			$this->lblLengthUnitId_Create();
			$this->txtShortDescription_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblLengthUnitId
		protected function lblLengthUnitId_Create() {
			$this->lblLengthUnitId = new QLabel($this);
			$this->lblLengthUnitId->Name = QApplication::Translate('Length Unit Id');
			if ($this->blnEditMode)
				$this->lblLengthUnitId->Text = $this->objLengthUnit->LengthUnitId;
			else
				$this->lblLengthUnitId->Text = 'N/A';
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objLengthUnit->ShortDescription;
			$this->txtShortDescription->MaxLength = LengthUnit::ShortDescriptionMaxLength;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'LengthUnit')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateLengthUnitFields() {
			$this->objLengthUnit->ShortDescription = $this->txtShortDescription->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateLengthUnitFields();
			$this->objLengthUnit->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objLengthUnit->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('length_unit_list.php');
		}
	}
?>