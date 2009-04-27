<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the Shortcut class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single Shortcut object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this ShortcutEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class ShortcutEditFormBase extends QForm {
		// General Form Variables
		protected $objShortcut;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for Shortcut's Data Fields
		protected $lblShortcutId;
		protected $lstModule;
		protected $lstAuthorization;
		protected $txtShortDescription;
		protected $txtLink;
		protected $txtImagePath;
		protected $lstEntityQtype;
		protected $chkCreateFlag;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupShortcut() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intShortcutId = QApplication::QueryString('intShortcutId');
			if (($intShortcutId)) {
				$this->objShortcut = Shortcut::Load(($intShortcutId));

				if (!$this->objShortcut)
					throw new Exception('Could not find a Shortcut object with PK arguments: ' . $intShortcutId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objShortcut = new Shortcut();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupShortcut to either Load/Edit Existing or Create New
			$this->SetupShortcut();

			// Create/Setup Controls for Shortcut's Data Fields
			$this->lblShortcutId_Create();
			$this->lstModule_Create();
			$this->lstAuthorization_Create();
			$this->txtShortDescription_Create();
			$this->txtLink_Create();
			$this->txtImagePath_Create();
			$this->lstEntityQtype_Create();
			$this->chkCreateFlag_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblShortcutId
		protected function lblShortcutId_Create() {
			$this->lblShortcutId = new QLabel($this);
			$this->lblShortcutId->Name = QApplication::Translate('Shortcut Id');
			if ($this->blnEditMode)
				$this->lblShortcutId->Text = $this->objShortcut->ShortcutId;
			else
				$this->lblShortcutId->Text = 'N/A';
		}

		// Create and Setup lstModule
		protected function lstModule_Create() {
			$this->lstModule = new QListBox($this);
			$this->lstModule->Name = QApplication::Translate('Module');
			$this->lstModule->Required = true;
			if (!$this->blnEditMode)
				$this->lstModule->AddItem(QApplication::Translate('- Select One -'), null);
			$objModuleArray = Module::LoadAll();
			if ($objModuleArray) foreach ($objModuleArray as $objModule) {
				$objListItem = new QListItem($objModule->__toString(), $objModule->ModuleId);
				if (($this->objShortcut->Module) && ($this->objShortcut->Module->ModuleId == $objModule->ModuleId))
					$objListItem->Selected = true;
				$this->lstModule->AddItem($objListItem);
			}
		}

		// Create and Setup lstAuthorization
		protected function lstAuthorization_Create() {
			$this->lstAuthorization = new QListBox($this);
			$this->lstAuthorization->Name = QApplication::Translate('Authorization');
			$this->lstAuthorization->AddItem(QApplication::Translate('- Select One -'), null);
			$objAuthorizationArray = Authorization::LoadAll();
			if ($objAuthorizationArray) foreach ($objAuthorizationArray as $objAuthorization) {
				$objListItem = new QListItem($objAuthorization->__toString(), $objAuthorization->AuthorizationId);
				if (($this->objShortcut->Authorization) && ($this->objShortcut->Authorization->AuthorizationId == $objAuthorization->AuthorizationId))
					$objListItem->Selected = true;
				$this->lstAuthorization->AddItem($objListItem);
			}
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objShortcut->ShortDescription;
			$this->txtShortDescription->Required = true;
			$this->txtShortDescription->MaxLength = Shortcut::ShortDescriptionMaxLength;
		}

		// Create and Setup txtLink
		protected function txtLink_Create() {
			$this->txtLink = new QTextBox($this);
			$this->txtLink->Name = QApplication::Translate('Link');
			$this->txtLink->Text = $this->objShortcut->Link;
			$this->txtLink->Required = true;
			$this->txtLink->MaxLength = Shortcut::LinkMaxLength;
		}

		// Create and Setup txtImagePath
		protected function txtImagePath_Create() {
			$this->txtImagePath = new QTextBox($this);
			$this->txtImagePath->Name = QApplication::Translate('Image Path');
			$this->txtImagePath->Text = $this->objShortcut->ImagePath;
			$this->txtImagePath->MaxLength = Shortcut::ImagePathMaxLength;
		}

		// Create and Setup lstEntityQtype
		protected function lstEntityQtype_Create() {
			$this->lstEntityQtype = new QListBox($this);
			$this->lstEntityQtype->Name = QApplication::Translate('Entity Qtype');
			$this->lstEntityQtype->Required = true;
			foreach (EntityQtype::$NameArray as $intId => $strValue)
				$this->lstEntityQtype->AddItem(new QListItem($strValue, $intId, $this->objShortcut->EntityQtypeId == $intId));
		}

		// Create and Setup chkCreateFlag
		protected function chkCreateFlag_Create() {
			$this->chkCreateFlag = new QCheckBox($this);
			$this->chkCreateFlag->Name = QApplication::Translate('Create Flag');
			$this->chkCreateFlag->Checked = $this->objShortcut->CreateFlag;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Shortcut')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateShortcutFields() {
			$this->objShortcut->ModuleId = $this->lstModule->SelectedValue;
			$this->objShortcut->AuthorizationId = $this->lstAuthorization->SelectedValue;
			$this->objShortcut->ShortDescription = $this->txtShortDescription->Text;
			$this->objShortcut->Link = $this->txtLink->Text;
			$this->objShortcut->ImagePath = $this->txtImagePath->Text;
			$this->objShortcut->EntityQtypeId = $this->lstEntityQtype->SelectedValue;
			$this->objShortcut->CreateFlag = $this->chkCreateFlag->Checked;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateShortcutFields();
			$this->objShortcut->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objShortcut->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('shortcut_list.php');
		}
	}
?>