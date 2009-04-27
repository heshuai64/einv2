<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the Module class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single Module object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this ModuleEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class ModuleEditFormBase extends QForm {
		// General Form Variables
		protected $objModule;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for Module's Data Fields
		protected $lblModuleId;
		protected $txtShortDescription;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupModule() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intModuleId = QApplication::QueryString('intModuleId');
			if (($intModuleId)) {
				$this->objModule = Module::Load(($intModuleId));

				if (!$this->objModule)
					throw new Exception('Could not find a Module object with PK arguments: ' . $intModuleId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objModule = new Module();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupModule to either Load/Edit Existing or Create New
			$this->SetupModule();

			// Create/Setup Controls for Module's Data Fields
			$this->lblModuleId_Create();
			$this->txtShortDescription_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblModuleId
		protected function lblModuleId_Create() {
			$this->lblModuleId = new QLabel($this);
			$this->lblModuleId->Name = QApplication::Translate('Module Id');
			if ($this->blnEditMode)
				$this->lblModuleId->Text = $this->objModule->ModuleId;
			else
				$this->lblModuleId->Text = 'N/A';
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objModule->ShortDescription;
			$this->txtShortDescription->MaxLength = Module::ShortDescriptionMaxLength;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Module')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateModuleFields() {
			$this->objModule->ShortDescription = $this->txtShortDescription->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateModuleFields();
			$this->objModule->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objModule->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('module_list.php');
		}
	}
?>