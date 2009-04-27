<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the InventoryLocation class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single InventoryLocation object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this InventoryLocationEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class InventoryLocationEditFormBase extends QForm {
		// General Form Variables
		protected $objInventoryLocation;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for InventoryLocation's Data Fields
		protected $lblInventoryLocationId;
		protected $lstInventoryModel;
		protected $lstLocation;
		protected $txtQuantity;
		protected $lstCreatedByObject;
		protected $calCreationDate;
		protected $lstModifiedByObject;
		protected $lblModifiedDate;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupInventoryLocation() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intInventoryLocationId = QApplication::QueryString('intInventoryLocationId');
			if (($intInventoryLocationId)) {
				$this->objInventoryLocation = InventoryLocation::Load(($intInventoryLocationId));

				if (!$this->objInventoryLocation)
					throw new Exception('Could not find a InventoryLocation object with PK arguments: ' . $intInventoryLocationId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objInventoryLocation = new InventoryLocation();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupInventoryLocation to either Load/Edit Existing or Create New
			$this->SetupInventoryLocation();

			// Create/Setup Controls for InventoryLocation's Data Fields
			$this->lblInventoryLocationId_Create();
			$this->lstInventoryModel_Create();
			$this->lstLocation_Create();
			$this->txtQuantity_Create();
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
		// Create and Setup lblInventoryLocationId
		protected function lblInventoryLocationId_Create() {
			$this->lblInventoryLocationId = new QLabel($this);
			$this->lblInventoryLocationId->Name = QApplication::Translate('Inventory Location Id');
			if ($this->blnEditMode)
				$this->lblInventoryLocationId->Text = $this->objInventoryLocation->InventoryLocationId;
			else
				$this->lblInventoryLocationId->Text = 'N/A';
		}

		// Create and Setup lstInventoryModel
		protected function lstInventoryModel_Create() {
			$this->lstInventoryModel = new QListBox($this);
			$this->lstInventoryModel->Name = QApplication::Translate('Inventory Model');
			$this->lstInventoryModel->Required = true;
			if (!$this->blnEditMode)
				$this->lstInventoryModel->AddItem(QApplication::Translate('- Select One -'), null);
			$objInventoryModelArray = InventoryModel::LoadAll();
			if ($objInventoryModelArray) foreach ($objInventoryModelArray as $objInventoryModel) {
				$objListItem = new QListItem($objInventoryModel->__toString(), $objInventoryModel->InventoryModelId);
				if (($this->objInventoryLocation->InventoryModel) && ($this->objInventoryLocation->InventoryModel->InventoryModelId == $objInventoryModel->InventoryModelId))
					$objListItem->Selected = true;
				$this->lstInventoryModel->AddItem($objListItem);
			}
		}

		// Create and Setup lstLocation
		protected function lstLocation_Create() {
			$this->lstLocation = new QListBox($this);
			$this->lstLocation->Name = QApplication::Translate('Location');
			$this->lstLocation->Required = true;
			if (!$this->blnEditMode)
				$this->lstLocation->AddItem(QApplication::Translate('- Select One -'), null);
			$objLocationArray = Location::LoadAll();
			if ($objLocationArray) foreach ($objLocationArray as $objLocation) {
				$objListItem = new QListItem($objLocation->__toString(), $objLocation->LocationId);
				if (($this->objInventoryLocation->Location) && ($this->objInventoryLocation->Location->LocationId == $objLocation->LocationId))
					$objListItem->Selected = true;
				$this->lstLocation->AddItem($objListItem);
			}
		}

		// Create and Setup txtQuantity
		protected function txtQuantity_Create() {
			$this->txtQuantity = new QIntegerTextBox($this);
			$this->txtQuantity->Name = QApplication::Translate('Quantity');
			$this->txtQuantity->Text = $this->objInventoryLocation->Quantity;
			$this->txtQuantity->Required = true;
		}

		// Create and Setup lstCreatedByObject
		protected function lstCreatedByObject_Create() {
			$this->lstCreatedByObject = new QListBox($this);
			$this->lstCreatedByObject->Name = QApplication::Translate('Created By Object');
			$this->lstCreatedByObject->AddItem(QApplication::Translate('- Select One -'), null);
			$objCreatedByObjectArray = UserAccount::LoadAll();
			if ($objCreatedByObjectArray) foreach ($objCreatedByObjectArray as $objCreatedByObject) {
				$objListItem = new QListItem($objCreatedByObject->__toString(), $objCreatedByObject->UserAccountId);
				if (($this->objInventoryLocation->CreatedByObject) && ($this->objInventoryLocation->CreatedByObject->UserAccountId == $objCreatedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstCreatedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup calCreationDate
		protected function calCreationDate_Create() {
			$this->calCreationDate = new QDateTimePicker($this);
			$this->calCreationDate->Name = QApplication::Translate('Creation Date');
			$this->calCreationDate->DateTime = $this->objInventoryLocation->CreationDate;
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
				if (($this->objInventoryLocation->ModifiedByObject) && ($this->objInventoryLocation->ModifiedByObject->UserAccountId == $objModifiedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstModifiedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup lblModifiedDate
		protected function lblModifiedDate_Create() {
			$this->lblModifiedDate = new QLabel($this);
			$this->lblModifiedDate->Name = QApplication::Translate('Modified Date');
			if ($this->blnEditMode)
				$this->lblModifiedDate->Text = $this->objInventoryLocation->ModifiedDate;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'InventoryLocation')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateInventoryLocationFields() {
			$this->objInventoryLocation->InventoryModelId = $this->lstInventoryModel->SelectedValue;
			$this->objInventoryLocation->LocationId = $this->lstLocation->SelectedValue;
			$this->objInventoryLocation->Quantity = $this->txtQuantity->Text;
			$this->objInventoryLocation->CreatedBy = $this->lstCreatedByObject->SelectedValue;
			$this->objInventoryLocation->CreationDate = $this->calCreationDate->DateTime;
			$this->objInventoryLocation->ModifiedBy = $this->lstModifiedByObject->SelectedValue;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateInventoryLocationFields();
			$this->objInventoryLocation->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objInventoryLocation->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('inventory_location_list.php');
		}
	}
?>