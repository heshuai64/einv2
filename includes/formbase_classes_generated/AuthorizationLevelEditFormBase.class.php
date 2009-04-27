<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the AuthorizationLevel class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single AuthorizationLevel object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this AuthorizationLevelEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class AuthorizationLevelEditFormBase extends QForm {
		// General Form Variables
		protected $objAuthorizationLevel;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for AuthorizationLevel's Data Fields
		protected $lblAuthorizationLevelId;
		protected $txtShortDescription;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupAuthorizationLevel() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intAuthorizationLevelId = QApplication::QueryString('intAuthorizationLevelId');
			if (($intAuthorizationLevelId)) {
				$this->objAuthorizationLevel = AuthorizationLevel::Load(($intAuthorizationLevelId));

				if (!$this->objAuthorizationLevel)
					throw new Exception('Could not find a AuthorizationLevel object with PK arguments: ' . $intAuthorizationLevelId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objAuthorizationLevel = new AuthorizationLevel();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupAuthorizationLevel to either Load/Edit Existing or Create New
			$this->SetupAuthorizationLevel();

			// Create/Setup Controls for AuthorizationLevel's Data Fields
			$this->lblAuthorizationLevelId_Create();
			$this->txtShortDescription_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblAuthorizationLevelId
		protected function lblAuthorizationLevelId_Create() {
			$this->lblAuthorizationLevelId = new QLabel($this);
			$this->lblAuthorizationLevelId->Name = QApplication::Translate('Authorization Level Id');
			if ($this->blnEditMode)
				$this->lblAuthorizationLevelId->Text = $this->objAuthorizationLevel->AuthorizationLevelId;
			else
				$this->lblAuthorizationLevelId->Text = 'N/A';
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objAuthorizationLevel->ShortDescription;
			$this->txtShortDescription->MaxLength = AuthorizationLevel::ShortDescriptionMaxLength;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'AuthorizationLevel')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateAuthorizationLevelFields() {
			$this->objAuthorizationLevel->ShortDescription = $this->txtShortDescription->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateAuthorizationLevelFields();
			$this->objAuthorizationLevel->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objAuthorizationLevel->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('authorization_level_list.php');
		}
	}
?>