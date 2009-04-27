<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the WeightUnit class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single WeightUnit object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this WeightUnitEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class WeightUnitEditFormBase extends QForm {
		// General Form Variables
		protected $objWeightUnit;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for WeightUnit's Data Fields
		protected $lblWeightUnitId;
		protected $txtShortDescription;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupWeightUnit() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intWeightUnitId = QApplication::QueryString('intWeightUnitId');
			if (($intWeightUnitId)) {
				$this->objWeightUnit = WeightUnit::Load(($intWeightUnitId));

				if (!$this->objWeightUnit)
					throw new Exception('Could not find a WeightUnit object with PK arguments: ' . $intWeightUnitId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objWeightUnit = new WeightUnit();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupWeightUnit to either Load/Edit Existing or Create New
			$this->SetupWeightUnit();

			// Create/Setup Controls for WeightUnit's Data Fields
			$this->lblWeightUnitId_Create();
			$this->txtShortDescription_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblWeightUnitId
		protected function lblWeightUnitId_Create() {
			$this->lblWeightUnitId = new QLabel($this);
			$this->lblWeightUnitId->Name = QApplication::Translate('Weight Unit Id');
			if ($this->blnEditMode)
				$this->lblWeightUnitId->Text = $this->objWeightUnit->WeightUnitId;
			else
				$this->lblWeightUnitId->Text = 'N/A';
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objWeightUnit->ShortDescription;
			$this->txtShortDescription->MaxLength = WeightUnit::ShortDescriptionMaxLength;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'WeightUnit')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateWeightUnitFields() {
			$this->objWeightUnit->ShortDescription = $this->txtShortDescription->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateWeightUnitFields();
			$this->objWeightUnit->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objWeightUnit->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('weight_unit_list.php');
		}
	}
?>