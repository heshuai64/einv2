<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the AdminSetting class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single AdminSetting object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this AdminSettingEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class AdminSettingEditFormBase extends QForm {
		// General Form Variables
		protected $objAdminSetting;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for AdminSetting's Data Fields
		protected $lblSettingId;
		protected $txtShortDescription;
		protected $txtValue;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupAdminSetting() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intSettingId = QApplication::QueryString('intSettingId');
			if (($intSettingId)) {
				$this->objAdminSetting = AdminSetting::Load(($intSettingId));

				if (!$this->objAdminSetting)
					throw new Exception('Could not find a AdminSetting object with PK arguments: ' . $intSettingId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objAdminSetting = new AdminSetting();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupAdminSetting to either Load/Edit Existing or Create New
			$this->SetupAdminSetting();

			// Create/Setup Controls for AdminSetting's Data Fields
			$this->lblSettingId_Create();
			$this->txtShortDescription_Create();
			$this->txtValue_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblSettingId
		protected function lblSettingId_Create() {
			$this->lblSettingId = new QLabel($this);
			$this->lblSettingId->Name = QApplication::Translate('Setting Id');
			if ($this->blnEditMode)
				$this->lblSettingId->Text = $this->objAdminSetting->SettingId;
			else
				$this->lblSettingId->Text = 'N/A';
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objAdminSetting->ShortDescription;
			$this->txtShortDescription->Required = true;
			$this->txtShortDescription->MaxLength = AdminSetting::ShortDescriptionMaxLength;
		}

		// Create and Setup txtValue
		protected function txtValue_Create() {
			$this->txtValue = new QTextBox($this);
			$this->txtValue->Name = QApplication::Translate('Value');
			$this->txtValue->Text = $this->objAdminSetting->Value;
			$this->txtValue->TextMode = QTextMode::MultiLine;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'AdminSetting')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateAdminSettingFields() {
			$this->objAdminSetting->ShortDescription = $this->txtShortDescription->Text;
			$this->objAdminSetting->Value = $this->txtValue->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateAdminSettingFields();
			$this->objAdminSetting->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objAdminSetting->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('admin_setting_list.php');
		}
	}
?>