<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the CustomFieldSelection class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single CustomFieldSelection object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this CustomFieldSelectionEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class CustomFieldSelectionEditFormBase extends QForm {
		// General Form Variables
		protected $objCustomFieldSelection;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for CustomFieldSelection's Data Fields
		protected $lblCustomFieldSelectionId;
		protected $lstCustomFieldValue;
		protected $lstEntityQtype;
		protected $txtEntityId;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupCustomFieldSelection() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intCustomFieldSelectionId = QApplication::QueryString('intCustomFieldSelectionId');
			if (($intCustomFieldSelectionId)) {
				$this->objCustomFieldSelection = CustomFieldSelection::Load(($intCustomFieldSelectionId));

				if (!$this->objCustomFieldSelection)
					throw new Exception('Could not find a CustomFieldSelection object with PK arguments: ' . $intCustomFieldSelectionId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objCustomFieldSelection = new CustomFieldSelection();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupCustomFieldSelection to either Load/Edit Existing or Create New
			$this->SetupCustomFieldSelection();

			// Create/Setup Controls for CustomFieldSelection's Data Fields
			$this->lblCustomFieldSelectionId_Create();
			$this->lstCustomFieldValue_Create();
			$this->lstEntityQtype_Create();
			$this->txtEntityId_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblCustomFieldSelectionId
		protected function lblCustomFieldSelectionId_Create() {
			$this->lblCustomFieldSelectionId = new QLabel($this);
			$this->lblCustomFieldSelectionId->Name = QApplication::Translate('Custom Field Selection Id');
			if ($this->blnEditMode)
				$this->lblCustomFieldSelectionId->Text = $this->objCustomFieldSelection->CustomFieldSelectionId;
			else
				$this->lblCustomFieldSelectionId->Text = 'N/A';
		}

		// Create and Setup lstCustomFieldValue
		protected function lstCustomFieldValue_Create() {
			$this->lstCustomFieldValue = new QListBox($this);
			$this->lstCustomFieldValue->Name = QApplication::Translate('Custom Field Value');
			$this->lstCustomFieldValue->Required = true;
			if (!$this->blnEditMode)
				$this->lstCustomFieldValue->AddItem(QApplication::Translate('- Select One -'), null);
			$objCustomFieldValueArray = CustomFieldValue::LoadAll();
			if ($objCustomFieldValueArray) foreach ($objCustomFieldValueArray as $objCustomFieldValue) {
				$objListItem = new QListItem($objCustomFieldValue->__toString(), $objCustomFieldValue->CustomFieldValueId);
				if (($this->objCustomFieldSelection->CustomFieldValue) && ($this->objCustomFieldSelection->CustomFieldValue->CustomFieldValueId == $objCustomFieldValue->CustomFieldValueId))
					$objListItem->Selected = true;
				$this->lstCustomFieldValue->AddItem($objListItem);
			}
		}

		// Create and Setup lstEntityQtype
		protected function lstEntityQtype_Create() {
			$this->lstEntityQtype = new QListBox($this);
			$this->lstEntityQtype->Name = QApplication::Translate('Entity Qtype');
			$this->lstEntityQtype->Required = true;
			foreach (EntityQtype::$NameArray as $intId => $strValue)
				$this->lstEntityQtype->AddItem(new QListItem($strValue, $intId, $this->objCustomFieldSelection->EntityQtypeId == $intId));
		}

		// Create and Setup txtEntityId
		protected function txtEntityId_Create() {
			$this->txtEntityId = new QIntegerTextBox($this);
			$this->txtEntityId->Name = QApplication::Translate('Entity Id');
			$this->txtEntityId->Text = $this->objCustomFieldSelection->EntityId;
			$this->txtEntityId->Required = true;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'CustomFieldSelection')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateCustomFieldSelectionFields() {
			$this->objCustomFieldSelection->CustomFieldValueId = $this->lstCustomFieldValue->SelectedValue;
			$this->objCustomFieldSelection->EntityQtypeId = $this->lstEntityQtype->SelectedValue;
			$this->objCustomFieldSelection->EntityId = $this->txtEntityId->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateCustomFieldSelectionFields();
			$this->objCustomFieldSelection->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objCustomFieldSelection->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('custom_field_selection_list.php');
		}
	}
?>