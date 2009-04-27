<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the CustomFieldValue class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single CustomFieldValue object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this CustomFieldValueEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class CustomFieldValueEditFormBase extends QForm {
		// General Form Variables
		protected $objCustomFieldValue;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for CustomFieldValue's Data Fields
		protected $lblCustomFieldValueId;
		protected $lstCustomField;
		protected $txtShortDescription;
		protected $lstCreatedByObject;
		protected $calCreationDate;
		protected $lstModifiedByObject;
		protected $lblModifiedDate;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupCustomFieldValue() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intCustomFieldValueId = QApplication::QueryString('intCustomFieldValueId');
			if (($intCustomFieldValueId)) {
				$this->objCustomFieldValue = CustomFieldValue::Load(($intCustomFieldValueId));

				if (!$this->objCustomFieldValue)
					throw new Exception('Could not find a CustomFieldValue object with PK arguments: ' . $intCustomFieldValueId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objCustomFieldValue = new CustomFieldValue();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupCustomFieldValue to either Load/Edit Existing or Create New
			$this->SetupCustomFieldValue();

			// Create/Setup Controls for CustomFieldValue's Data Fields
			$this->lblCustomFieldValueId_Create();
			$this->lstCustomField_Create();
			$this->txtShortDescription_Create();
			$this->lstCreatedByObject_Create();
			$this->calCreationDate_Create();
			$this->lstModifiedByObject_Create();
			$this->lblModifiedDate_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblCustomFieldValueId
		protected function lblCustomFieldValueId_Create() {
			$this->lblCustomFieldValueId = new QLabel($this);
			$this->lblCustomFieldValueId->Name = QApplication::Translate('Custom Field Value Id');
			if ($this->blnEditMode)
				$this->lblCustomFieldValueId->Text = $this->objCustomFieldValue->CustomFieldValueId;
			else
				$this->lblCustomFieldValueId->Text = 'N/A';
		}

		// Create and Setup lstCustomField
		protected function lstCustomField_Create() {
			$this->lstCustomField = new QListBox($this);
			$this->lstCustomField->Name = QApplication::Translate('Custom Field');
			$this->lstCustomField->Required = true;
			if (!$this->blnEditMode)
				$this->lstCustomField->AddItem(QApplication::Translate('- Select One -'), null);
			$objCustomFieldArray = CustomField::LoadAll();
			if ($objCustomFieldArray) foreach ($objCustomFieldArray as $objCustomField) {
				$objListItem = new QListItem($objCustomField->__toString(), $objCustomField->CustomFieldId);
				if (($this->objCustomFieldValue->CustomField) && ($this->objCustomFieldValue->CustomField->CustomFieldId == $objCustomField->CustomFieldId))
					$objListItem->Selected = true;
				$this->lstCustomField->AddItem($objListItem);
			}
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objCustomFieldValue->ShortDescription;
			$this->txtShortDescription->TextMode = QTextMode::MultiLine;
		}

		// Create and Setup lstCreatedByObject
		protected function lstCreatedByObject_Create() {
			$this->lstCreatedByObject = new QListBox($this);
			$this->lstCreatedByObject->Name = QApplication::Translate('Created By Object');
			$this->lstCreatedByObject->AddItem(QApplication::Translate('- Select One -'), null);
			$objCreatedByObjectArray = UserAccount::LoadAll();
			if ($objCreatedByObjectArray) foreach ($objCreatedByObjectArray as $objCreatedByObject) {
				$objListItem = new QListItem($objCreatedByObject->__toString(), $objCreatedByObject->UserAccountId);
				if (($this->objCustomFieldValue->CreatedByObject) && ($this->objCustomFieldValue->CreatedByObject->UserAccountId == $objCreatedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstCreatedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup calCreationDate
		protected function calCreationDate_Create() {
			$this->calCreationDate = new QDateTimePicker($this);
			$this->calCreationDate->Name = QApplication::Translate('Creation Date');
			$this->calCreationDate->DateTime = $this->objCustomFieldValue->CreationDate;
			$this->calCreationDate->DateTimePickerType = QDateTimePickerType::DateTime;
		}

		// Create and Setup lstModifiedByObject
		protected function lstModifiedByObject_Create() {
			$this->lstModifiedByObject = new QListBox($this);
			$this->lstModifiedByObject->Name = QApplication::Translate('Modified By Object');
			$this->lstModifiedByObject->AddItem(QApplication::Translate('- Select One -'), null);
			$objModifiedByObjectArray = UserAccount::LoadAll();
			if ($objModifiedByObjectArray) foreach ($objModifiedByObjectArray as $objModifiedByObject) {
				$objListItem = new QListItem($objModifiedByObject->__toString(), $objModifiedByObject->UserAccountId);
				if (($this->objCustomFieldValue->ModifiedByObject) && ($this->objCustomFieldValue->ModifiedByObject->UserAccountId == $objModifiedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstModifiedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup lblModifiedDate
		protected function lblModifiedDate_Create() {
			$this->lblModifiedDate = new QLabel($this);
			$this->lblModifiedDate->Name = QApplication::Translate('Modified Date');
			if ($this->blnEditMode)
				$this->lblModifiedDate->Text = $this->objCustomFieldValue->ModifiedDate;
			else
				$this->lblModifiedDate->Text = 'N/A';
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'CustomFieldValue')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateCustomFieldValueFields() {
			$this->objCustomFieldValue->CustomFieldId = $this->lstCustomField->SelectedValue;
			$this->objCustomFieldValue->ShortDescription = $this->txtShortDescription->Text;
			$this->objCustomFieldValue->CreatedBy = $this->lstCreatedByObject->SelectedValue;
			$this->objCustomFieldValue->CreationDate = $this->calCreationDate->DateTime;
			$this->objCustomFieldValue->ModifiedBy = $this->lstModifiedByObject->SelectedValue;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateCustomFieldValueFields();
			$this->objCustomFieldValue->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objCustomFieldValue->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('custom_field_value_list.php');
		}
	}
?>