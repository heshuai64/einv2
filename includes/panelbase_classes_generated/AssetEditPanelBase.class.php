<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the Asset class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single Asset object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this AssetEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class AssetEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objAsset;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for Asset's Data Fields
		public $lblAssetId;
		public $lstAssetModel;
		public $lstLocation;
		public $txtAssetCode;
		public $txtImagePath;
		public $chkCheckedOutFlag;
		public $chkReservedFlag;
		public $lstCreatedByObject;
		public $calCreationDate;
		public $lstModifiedByObject;
		public $lblModifiedDate;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupAsset($objAsset) {
			if ($objAsset) {
				$this->objAsset = $objAsset;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objAsset = new Asset();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objAsset = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupAsset to either Load/Edit Existing or Create New
			$this->SetupAsset($objAsset);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for Asset's Data Fields
			$this->lblAssetId_Create();
			$this->lstAssetModel_Create();
			$this->lstLocation_Create();
			$this->txtAssetCode_Create();
			$this->txtImagePath_Create();
			$this->chkCheckedOutFlag_Create();
			$this->chkReservedFlag_Create();
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
		// Create and Setup lblAssetId
		protected function lblAssetId_Create() {
			$this->lblAssetId = new QLabel($this);
			$this->lblAssetId->Name = QApplication::Translate('Asset Id');
			if ($this->blnEditMode)
				$this->lblAssetId->Text = $this->objAsset->AssetId;
			else
				$this->lblAssetId->Text = 'N/A';
		}

		// Create and Setup lstAssetModel
		protected function lstAssetModel_Create() {
			$this->lstAssetModel = new QListBox($this);
			$this->lstAssetModel->Name = QApplication::Translate('Asset Model');
			$this->lstAssetModel->Required = true;
			if (!$this->blnEditMode)
				$this->lstAssetModel->AddItem(QApplication::Translate('- Select One -'), null);
			$objAssetModelArray = AssetModel::LoadAll();
			if ($objAssetModelArray) foreach ($objAssetModelArray as $objAssetModel) {
				$objListItem = new QListItem($objAssetModel->__toString(), $objAssetModel->AssetModelId);
				if (($this->objAsset->AssetModel) && ($this->objAsset->AssetModel->AssetModelId == $objAssetModel->AssetModelId))
					$objListItem->Selected = true;
				$this->lstAssetModel->AddItem($objListItem);
			}
		}

		// Create and Setup lstLocation
		protected function lstLocation_Create() {
			$this->lstLocation = new QListBox($this);
			$this->lstLocation->Name = QApplication::Translate('Location');
			$this->lstLocation->AddItem(QApplication::Translate('- Select One -'), null);
			$objLocationArray = Location::LoadAll();
			if ($objLocationArray) foreach ($objLocationArray as $objLocation) {
				$objListItem = new QListItem($objLocation->__toString(), $objLocation->LocationId);
				if (($this->objAsset->Location) && ($this->objAsset->Location->LocationId == $objLocation->LocationId))
					$objListItem->Selected = true;
				$this->lstLocation->AddItem($objListItem);
			}
		}

		// Create and Setup txtAssetCode
		protected function txtAssetCode_Create() {
			$this->txtAssetCode = new QTextBox($this);
			$this->txtAssetCode->Name = QApplication::Translate('Asset Code');
			$this->txtAssetCode->Text = $this->objAsset->AssetCode;
			$this->txtAssetCode->Required = true;
			$this->txtAssetCode->MaxLength = Asset::AssetCodeMaxLength;
		}

		// Create and Setup txtImagePath
		protected function txtImagePath_Create() {
			$this->txtImagePath = new QTextBox($this);
			$this->txtImagePath->Name = QApplication::Translate('Image Path');
			$this->txtImagePath->Text = $this->objAsset->ImagePath;
			$this->txtImagePath->MaxLength = Asset::ImagePathMaxLength;
		}

		// Create and Setup chkCheckedOutFlag
		protected function chkCheckedOutFlag_Create() {
			$this->chkCheckedOutFlag = new QCheckBox($this);
			$this->chkCheckedOutFlag->Name = QApplication::Translate('Checked Out Flag');
			$this->chkCheckedOutFlag->Checked = $this->objAsset->CheckedOutFlag;
		}

		// Create and Setup chkReservedFlag
		protected function chkReservedFlag_Create() {
			$this->chkReservedFlag = new QCheckBox($this);
			$this->chkReservedFlag->Name = QApplication::Translate('Reserved Flag');
			$this->chkReservedFlag->Checked = $this->objAsset->ReservedFlag;
		}

		// Create and Setup lstCreatedByObject
		protected function lstCreatedByObject_Create() {
			$this->lstCreatedByObject = new QListBox($this);
			$this->lstCreatedByObject->Name = QApplication::Translate('Created By Object');
			$this->lstCreatedByObject->AddItem(QApplication::Translate('- Select One -'), null);
			$objCreatedByObjectArray = UserAccount::LoadAll();
			if ($objCreatedByObjectArray) foreach ($objCreatedByObjectArray as $objCreatedByObject) {
				$objListItem = new QListItem($objCreatedByObject->__toString(), $objCreatedByObject->UserAccountId);
				if (($this->objAsset->CreatedByObject) && ($this->objAsset->CreatedByObject->UserAccountId == $objCreatedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstCreatedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup calCreationDate
		protected function calCreationDate_Create() {
			$this->calCreationDate = new QDateTimePicker($this);
			$this->calCreationDate->Name = QApplication::Translate('Creation Date');
			$this->calCreationDate->DateTime = $this->objAsset->CreationDate;
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
				if (($this->objAsset->ModifiedByObject) && ($this->objAsset->ModifiedByObject->UserAccountId == $objModifiedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstModifiedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup lblModifiedDate
		protected function lblModifiedDate_Create() {
			$this->lblModifiedDate = new QLabel($this);
			$this->lblModifiedDate->Name = QApplication::Translate('Modified Date');
			if ($this->blnEditMode)
				$this->lblModifiedDate->Text = $this->objAsset->ModifiedDate;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Asset')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateAssetFields() {
			$this->objAsset->AssetModelId = $this->lstAssetModel->SelectedValue;
			$this->objAsset->LocationId = $this->lstLocation->SelectedValue;
			$this->objAsset->AssetCode = $this->txtAssetCode->Text;
			$this->objAsset->ImagePath = $this->txtImagePath->Text;
			$this->objAsset->CheckedOutFlag = $this->chkCheckedOutFlag->Checked;
			$this->objAsset->ReservedFlag = $this->chkReservedFlag->Checked;
			$this->objAsset->CreatedBy = $this->lstCreatedByObject->SelectedValue;
			$this->objAsset->CreationDate = $this->calCreationDate->DateTime;
			$this->objAsset->ModifiedBy = $this->lstModifiedByObject->SelectedValue;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateAssetFields();
			$this->objAsset->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objAsset->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>