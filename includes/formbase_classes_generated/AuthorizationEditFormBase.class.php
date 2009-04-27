<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the Authorization class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single Authorization object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this AuthorizationEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class AuthorizationEditFormBase extends QForm {
		// General Form Variables
		protected $objAuthorization;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for Authorization's Data Fields
		protected $lblAuthorizationId;
		protected $txtShortDescription;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupAuthorization() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intAuthorizationId = QApplication::QueryString('intAuthorizationId');
			if (($intAuthorizationId)) {
				$this->objAuthorization = Authorization::Load(($intAuthorizationId));

				if (!$this->objAuthorization)
					throw new Exception('Could not find a Authorization object with PK arguments: ' . $intAuthorizationId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objAuthorization = new Authorization();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupAuthorization to either Load/Edit Existing or Create New
			$this->SetupAuthorization();

			// Create/Setup Controls for Authorization's Data Fields
			$this->lblAuthorizationId_Create();
			$this->txtShortDescription_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblAuthorizationId
		protected function lblAuthorizationId_Create() {
			$this->lblAuthorizationId = new QLabel($this);
			$this->lblAuthorizationId->Name = QApplication::Translate('Authorization Id');
			if ($this->blnEditMode)
				$this->lblAuthorizationId->Text = $this->objAuthorization->AuthorizationId;
			else
				$this->lblAuthorizationId->Text = 'N/A';
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objAuthorization->ShortDescription;
			$this->txtShortDescription->MaxLength = Authorization::ShortDescriptionMaxLength;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Authorization')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateAuthorizationFields() {
			$this->objAuthorization->ShortDescription = $this->txtShortDescription->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateAuthorizationFields();
			$this->objAuthorization->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objAuthorization->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('authorization_list.php');
		}
	}
?>