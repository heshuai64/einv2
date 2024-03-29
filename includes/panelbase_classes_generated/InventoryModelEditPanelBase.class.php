<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the InventoryModel class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single InventoryModel object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this InventoryModelEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class InventoryModelEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objInventoryModel;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for InventoryModel's Data Fields
		public $lblInventoryModelId;
		public $lstCategory;
		public $lstManufacturer;
		public $txtInventoryModelCode;
		public $txtShortDescription;
		public $txtLongDescription;
		public $txtImagePath;
		public $txtPrice;
		public $lstCreatedByObject;
		public $calCreationDate;
		public $lstModifiedByObject;
		public $lblModifiedDate;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupInventoryModel($objInventoryModel) {
			if ($objInventoryModel) {
				$this->objInventoryModel = $objInventoryModel;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objInventoryModel = new InventoryModel();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objInventoryModel = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupInventoryModel to either Load/Edit Existing or Create New
			$this->SetupInventoryModel($objInventoryModel);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for InventoryModel's Data Fields
			$this->lblInventoryModelId_Create();
			$this->lstCategory_Create();
			$this->lstManufacturer_Create();
			$this->txtInventoryModelCode_Create();
			$this->txtShortDescription_Create();
			$this->txtLongDescription_Create();
			$this->txtImagePath_Create();
			$this->txtPrice_Create();
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
		// Create and Setup lblInventoryModelId
		protected function lblInventoryModelId_Create() {
			$this->lblInventoryModelId = new QLabel($this);
			$this->lblInventoryModelId->Name = QApplication::Translate('Inventory Model Id');
			if ($this->blnEditMode)
				$this->lblInventoryModelId->Text = $this->objInventoryModel->InventoryModelId;
			else
				$this->lblInventoryModelId->Text = 'N/A';
		}

		// Create and Setup lstCategory
		protected function lstCategory_Create() {
			$this->lstCategory = new QListBox($this);
			$this->lstCategory->Name = QApplication::Translate('Category');
			$this->lstCategory->AddItem(QApplication::Translate('- Select One -'), null);
			$objCategoryArray = Category::LoadAll();
			if ($objCategoryArray) foreach ($objCategoryArray as $objCategory) {
				$objListItem = new QListItem($objCategory->__toString(), $objCategory->CategoryId);
				if (($this->objInventoryModel->Category) && ($this->objInventoryModel->Category->CategoryId == $objCategory->CategoryId))
					$objListItem->Selected = true;
				$this->lstCategory->AddItem($objListItem);
			}
		}

		// Create and Setup lstManufacturer
		protected function lstManufacturer_Create() {
			$this->lstManufacturer = new QListBox($this);
			$this->lstManufacturer->Name = QApplication::Translate('Manufacturer');
			$this->lstManufacturer->AddItem(QApplication::Translate('- Select One -'), null);
			$objManufacturerArray = Manufacturer::LoadAll();
			if ($objManufacturerArray) foreach ($objManufacturerArray as $objManufacturer) {
				$objListItem = new QListItem($objManufacturer->__toString(), $objManufacturer->ManufacturerId);
				if (($this->objInventoryModel->Manufacturer) && ($this->objInventoryModel->Manufacturer->ManufacturerId == $objManufacturer->ManufacturerId))
					$objListItem->Selected = true;
				$this->lstManufacturer->AddItem($objListItem);
			}
		}

		// Create and Setup txtInventoryModelCode
		protected function txtInventoryModelCode_Create() {
			$this->txtInventoryModelCode = new QTextBox($this);
			$this->txtInventoryModelCode->Name = QApplication::Translate('Inventory Model Code');
			$this->txtInventoryModelCode->Text = $this->objInventoryModel->InventoryModelCode;
			$this->txtInventoryModelCode->Required = true;
			$this->txtInventoryModelCode->MaxLength = InventoryModel::InventoryModelCodeMaxLength;
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objInventoryModel->ShortDescription;
			$this->txtShortDescription->Required = true;
			$this->txtShortDescription->MaxLength = InventoryModel::ShortDescriptionMaxLength;
		}

		// Create and Setup txtLongDescription
		protected function txtLongDescription_Create() {
			$this->txtLongDescription = new QTextBox($this);
			$this->txtLongDescription->Name = QApplication::Translate('Long Description');
			$this->txtLongDescription->Text = $this->objInventoryModel->LongDescription;
			$this->txtLongDescription->TextMode = QTextMode::MultiLine;
		}

		// Create and Setup txtImagePath
		protected function txtImagePath_Create() {
			$this->txtImagePath = new QTextBox($this);
			$this->txtImagePath->Name = QApplication::Translate('Image Path');
			$this->txtImagePath->Text = $this->objInventoryModel->ImagePath;
			$this->txtImagePath->MaxLength = InventoryModel::ImagePathMaxLength;
		}

		// Create and Setup txtPrice
		protected function txtPrice_Create() {
			$this->txtPrice = new QFloatTextBox($this);
			$this->txtPrice->Name = QApplication::Translate('Price');
			$this->txtPrice->Text = $this->objInventoryModel->Price;
		}

		// Create and Setup lstCreatedByObject
		protected function lstCreatedByObject_Create() {
			$this->lstCreatedByObject = new QListBox($this);
			$this->lstCreatedByObject->Name = QApplication::Translate('Created By Object');
			$this->lstCreatedByObject->AddItem(QApplication::Translate('- Select One -'), null);
			$objCreatedByObjectArray = UserAccount::LoadAll();
			if ($objCreatedByObjectArray) foreach ($objCreatedByObjectArray as $objCreatedByObject) {
				$objListItem = new QListItem($objCreatedByObject->__toString(), $objCreatedByObject->UserAccountId);
				if (($this->objInventoryModel->CreatedByObject) && ($this->objInventoryModel->CreatedByObject->UserAccountId == $objCreatedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstCreatedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup calCreationDate
		protected function calCreationDate_Create() {
			$this->calCreationDate = new QDateTimePicker($this);
			$this->calCreationDate->Name = QApplication::Translate('Creation Date');
			$this->calCreationDate->DateTime = $this->objInventoryModel->CreationDate;
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
				if (($this->objInventoryModel->ModifiedByObject) && ($this->objInventoryModel->ModifiedByObject->UserAccountId == $objModifiedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstModifiedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup lblModifiedDate
		protected function lblModifiedDate_Create() {
			$this->lblModifiedDate = new QLabel($this);
			$this->lblModifiedDate->Name = QApplication::Translate('Modified Date');
			if ($this->blnEditMode)
				$this->lblModifiedDate->Text = $this->objInventoryModel->ModifiedDate;
			else
				$this->lblModifiedDate->Text = 'N/A';
		}


		// Setup btnSave
		protected function btnSave_Create() {
			$this->btnSave = new QButton($this);
			$this->btnSave->Text = QApplication::Translate('Save');
			$this->btnSave->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnSave_Click'));
			$this->btnSave->PrimaryButton = true;
			$this->btnSave->CausesValidation = true;
		}

		// Setup btnCancel
		protected function btnCancel_Create() {
			$this->btnCancel = new QButton($this);
			$this->btnCancel->Text = QApplication::Translate('Cancel');
			$this->btnCancel->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCancel_Click'));
			$this->btnCancel->CausesValidation = false;
		}

		// Setup btnDelete
		protected function btnDelete_Create() {
			$this->btnDelete = new QButton($this);
			$this->btnDelete->Text = QApplication::Translate('Delete');
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'InventoryModel')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateInventoryModelFields() {
			$this->objInventoryModel->CategoryId = $this->lstCategory->SelectedValue;
			$this->objInventoryModel->ManufacturerId = $this->lstManufacturer->SelectedValue;
			$this->objInventoryModel->InventoryModelCode = $this->txtInventoryModelCode->Text;
			$this->objInventoryModel->ShortDescription = $this->txtShortDescription->Text;
			$this->objInventoryModel->LongDescription = $this->txtLongDescription->Text;
			$this->objInventoryModel->ImagePath = $this->txtImagePath->Text;
			$this->objInventoryModel->Price = $this->txtPrice->Text;
			$this->objInventoryModel->CreatedBy = $this->lstCreatedByObject->SelectedValue;
			$this->objInventoryModel->CreationDate = $this->calCreationDate->DateTime;
			$this->objInventoryModel->ModifiedBy = $this->lstModifiedByObject->SelectedValue;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateInventoryModelFields();
			$this->objInventoryModel->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objInventoryModel->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>