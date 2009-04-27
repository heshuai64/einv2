<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the EntityQtypeCustomField class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single EntityQtypeCustomField object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this EntityQtypeCustomFieldEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class EntityQtypeCustomFieldEditFormBase extends QForm {
		// General Form Variables
		protected $objEntityQtypeCustomField;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for EntityQtypeCustomField's Data Fields
		protected $lblEntityQtypeCustomFieldId;
		protected $lstEntityQtype;
		protected $lstCustomField;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupEntityQtypeCustomField() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intEntityQtypeCustomFieldId = QApplication::QueryString('intEntityQtypeCustomFieldId');
			if (($intEntityQtypeCustomFieldId)) {
				$this->objEntityQtypeCustomField = EntityQtypeCustomField::Load(($intEntityQtypeCustomFieldId));

				if (!$this->objEntityQtypeCustomField)
					throw new Exception('Could not find a EntityQtypeCustomField object with PK arguments: ' . $intEntityQtypeCustomFieldId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objEntityQtypeCustomField = new EntityQtypeCustomField();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupEntityQtypeCustomField to either Load/Edit Existing or Create New
			$this->SetupEntityQtypeCustomField();

			// Create/Setup Controls for EntityQtypeCustomField's Data Fields
			$this->lblEntityQtypeCustomFieldId_Create();
			$this->lstEntityQtype_Create();
			$this->lstCustomField_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblEntityQtypeCustomFieldId
		protected function lblEntityQtypeCustomFieldId_Create() {
			$this->lblEntityQtypeCustomFieldId = new QLabel($this);
			$this->lblEntityQtypeCustomFieldId->Name = QApplication::Translate('Entity Qtype Custom Field Id');
			if ($this->blnEditMode)
				$this->lblEntityQtypeCustomFieldId->Text = $this->objEntityQtypeCustomField->EntityQtypeCustomFieldId;
			else
				$this->lblEntityQtypeCustomFieldId->Text = 'N/A';
		}

		// Create and Setup lstEntityQtype
		protected function lstEntityQtype_Create() {
			$this->lstEntityQtype = new QListBox($this);
			$this->lstEntityQtype->Name = QApplication::Translate('Entity Qtype');
			$this->lstEntityQtype->Required = true;
			foreach (EntityQtype::$NameArray as $intId => $strValue)
				$this->lstEntityQtype->AddItem(new QListItem($strValue, $intId, $this->objEntityQtypeCustomField->EntityQtypeId == $intId));
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
				if (($this->objEntityQtypeCustomField->CustomField) && ($this->objEntityQtypeCustomField->CustomField->CustomFieldId == $objCustomField->CustomFieldId))
					$objListItem->Selected = true;
				$this->lstCustomField->AddItem($objListItem);
			}
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'EntityQtypeCustomField')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateEntityQtypeCustomFieldFields() {
			$this->objEntityQtypeCustomField->EntityQtypeId = $this->lstEntityQtype->SelectedValue;
			$this->objEntityQtypeCustomField->CustomFieldId = $this->lstCustomField->SelectedValue;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateEntityQtypeCustomFieldFields();
			$this->objEntityQtypeCustomField->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objEntityQtypeCustomField->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('entity_qtype_custom_field_list.php');
		}
	}
?>