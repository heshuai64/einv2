<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the AssetTransaction class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single AssetTransaction object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this AssetTransactionEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class AssetTransactionEditFormBase extends QForm {
		// General Form Variables
		protected $objAssetTransaction;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for AssetTransaction's Data Fields
		protected $lblAssetTransactionId;
		protected $lstAsset;
		protected $lstTransaction;
		protected $lstParentAssetTransaction;
		protected $lstSourceLocation;
		protected $lstDestinationLocation;
		protected $chkNewAssetFlag;
		protected $lstNewAsset;
		protected $chkScheduleReceiptFlag;
		protected $calScheduleReceiptDueDate;
		protected $lstCreatedByObject;
		protected $calCreationDate;
		protected $lstModifiedByObject;
		protected $lblModifiedDate;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupAssetTransaction() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intAssetTransactionId = QApplication::QueryString('intAssetTransactionId');
			if (($intAssetTransactionId)) {
				$this->objAssetTransaction = AssetTransaction::Load(($intAssetTransactionId));

				if (!$this->objAssetTransaction)
					throw new Exception('Could not find a AssetTransaction object with PK arguments: ' . $intAssetTransactionId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objAssetTransaction = new AssetTransaction();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupAssetTransaction to either Load/Edit Existing or Create New
			$this->SetupAssetTransaction();

			// Create/Setup Controls for AssetTransaction's Data Fields
			$this->lblAssetTransactionId_Create();
			$this->lstAsset_Create();
			$this->lstTransaction_Create();
			$this->lstParentAssetTransaction_Create();
			$this->lstSourceLocation_Create();
			$this->lstDestinationLocation_Create();
			$this->chkNewAssetFlag_Create();
			$this->lstNewAsset_Create();
			$this->chkScheduleReceiptFlag_Create();
			$this->calScheduleReceiptDueDate_Create();
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
		// Create and Setup lblAssetTransactionId
		protected function lblAssetTransactionId_Create() {
			$this->lblAssetTransactionId = new QLabel($this);
			$this->lblAssetTransactionId->Name = QApplication::Translate('Asset Transaction Id');
			if ($this->blnEditMode)
				$this->lblAssetTransactionId->Text = $this->objAssetTransaction->AssetTransactionId;
			else
				$this->lblAssetTransactionId->Text = 'N/A';
		}

		// Create and Setup lstAsset
		protected function lstAsset_Create() {
			$this->lstAsset = new QListBox($this);
			$this->lstAsset->Name = QApplication::Translate('Asset');
			$this->lstAsset->Required = true;
			if (!$this->blnEditMode)
				$this->lstAsset->AddItem(QApplication::Translate('- Select One -'), null);
			$objAssetArray = Asset::LoadAll();
			if ($objAssetArray) foreach ($objAssetArray as $objAsset) {
				$objListItem = new QListItem($objAsset->__toString(), $objAsset->AssetId);
				if (($this->objAssetTransaction->Asset) && ($this->objAssetTransaction->Asset->AssetId == $objAsset->AssetId))
					$objListItem->Selected = true;
				$this->lstAsset->AddItem($objListItem);
			}
		}

		// Create and Setup lstTransaction
		protected function lstTransaction_Create() {
			$this->lstTransaction = new QListBox($this);
			$this->lstTransaction->Name = QApplication::Translate('Transaction');
			$this->lstTransaction->Required = true;
			if (!$this->blnEditMode)
				$this->lstTransaction->AddItem(QApplication::Translate('- Select One -'), null);
			$objTransactionArray = Transaction::LoadAll();
			if ($objTransactionArray) foreach ($objTransactionArray as $objTransaction) {
				$objListItem = new QListItem($objTransaction->__toString(), $objTransaction->TransactionId);
				if (($this->objAssetTransaction->Transaction) && ($this->objAssetTransaction->Transaction->TransactionId == $objTransaction->TransactionId))
					$objListItem->Selected = true;
				$this->lstTransaction->AddItem($objListItem);
			}
		}

		// Create and Setup lstParentAssetTransaction
		protected function lstParentAssetTransaction_Create() {
			$this->lstParentAssetTransaction = new QListBox($this);
			$this->lstParentAssetTransaction->Name = QApplication::Translate('Parent Asset Transaction');
			$this->lstParentAssetTransaction->AddItem(QApplication::Translate('- Select One -'), null);
			$objParentAssetTransactionArray = AssetTransaction::LoadAll();
			if ($objParentAssetTransactionArray) foreach ($objParentAssetTransactionArray as $objParentAssetTransaction) {
				$objListItem = new QListItem($objParentAssetTransaction->__toString(), $objParentAssetTransaction->AssetTransactionId);
				if (($this->objAssetTransaction->ParentAssetTransaction) && ($this->objAssetTransaction->ParentAssetTransaction->AssetTransactionId == $objParentAssetTransaction->AssetTransactionId))
					$objListItem->Selected = true;
				$this->lstParentAssetTransaction->AddItem($objListItem);
			}
		}

		// Create and Setup lstSourceLocation
		protected function lstSourceLocation_Create() {
			$this->lstSourceLocation = new QListBox($this);
			$this->lstSourceLocation->Name = QApplication::Translate('Source Location');
			$this->lstSourceLocation->AddItem(QApplication::Translate('- Select One -'), null);
			$objSourceLocationArray = Location::LoadAll();
			if ($objSourceLocationArray) foreach ($objSourceLocationArray as $objSourceLocation) {
				$objListItem = new QListItem($objSourceLocation->__toString(), $objSourceLocation->LocationId);
				if (($this->objAssetTransaction->SourceLocation) && ($this->objAssetTransaction->SourceLocation->LocationId == $objSourceLocation->LocationId))
					$objListItem->Selected = true;
				$this->lstSourceLocation->AddItem($objListItem);
			}
		}

		// Create and Setup lstDestinationLocation
		protected function lstDestinationLocation_Create() {
			$this->lstDestinationLocation = new QListBox($this);
			$this->lstDestinationLocation->Name = QApplication::Translate('Destination Location');
			$this->lstDestinationLocation->AddItem(QApplication::Translate('- Select One -'), null);
			$objDestinationLocationArray = Location::LoadAll();
			if ($objDestinationLocationArray) foreach ($objDestinationLocationArray as $objDestinationLocation) {
				$objListItem = new QListItem($objDestinationLocation->__toString(), $objDestinationLocation->LocationId);
				if (($this->objAssetTransaction->DestinationLocation) && ($this->objAssetTransaction->DestinationLocation->LocationId == $objDestinationLocation->LocationId))
					$objListItem->Selected = true;
				$this->lstDestinationLocation->AddItem($objListItem);
			}
		}

		// Create and Setup chkNewAssetFlag
		protected function chkNewAssetFlag_Create() {
			$this->chkNewAssetFlag = new QCheckBox($this);
			$this->chkNewAssetFlag->Name = QApplication::Translate('New Asset Flag');
			$this->chkNewAssetFlag->Checked = $this->objAssetTransaction->NewAssetFlag;
		}

		// Create and Setup lstNewAsset
		protected function lstNewAsset_Create() {
			$this->lstNewAsset = new QListBox($this);
			$this->lstNewAsset->Name = QApplication::Translate('New Asset');
			$this->lstNewAsset->AddItem(QApplication::Translate('- Select One -'), null);
			$objNewAssetArray = Asset::LoadAll();
			if ($objNewAssetArray) foreach ($objNewAssetArray as $objNewAsset) {
				$objListItem = new QListItem($objNewAsset->__toString(), $objNewAsset->AssetId);
				if (($this->objAssetTransaction->NewAsset) && ($this->objAssetTransaction->NewAsset->AssetId == $objNewAsset->AssetId))
					$objListItem->Selected = true;
				$this->lstNewAsset->AddItem($objListItem);
			}
		}

		// Create and Setup chkScheduleReceiptFlag
		protected function chkScheduleReceiptFlag_Create() {
			$this->chkScheduleReceiptFlag = new QCheckBox($this);
			$this->chkScheduleReceiptFlag->Name = QApplication::Translate('Schedule Receipt Flag');
			$this->chkScheduleReceiptFlag->Checked = $this->objAssetTransaction->ScheduleReceiptFlag;
		}

		// Create and Setup calScheduleReceiptDueDate
		protected function calScheduleReceiptDueDate_Create() {
			$this->calScheduleReceiptDueDate = new QDateTimePicker($this);
			$this->calScheduleReceiptDueDate->Name = QApplication::Translate('Schedule Receipt Due Date');
			$this->calScheduleReceiptDueDate->DateTime = $this->objAssetTransaction->ScheduleReceiptDueDate;
			$this->calScheduleReceiptDueDate->DateTimePickerType = QDateTimePickerType::Date;
		}

		// Create and Setup lstCreatedByObject
		protected function lstCreatedByObject_Create() {
			$this->lstCreatedByObject = new QListBox($this);
			$this->lstCreatedByObject->Name = QApplication::Translate('Created By Object');
			$this->lstCreatedByObject->AddItem(QApplication::Translate('- Select One -'), null);
			$objCreatedByObjectArray = UserAccount::LoadAll();
			if ($objCreatedByObjectArray) foreach ($objCreatedByObjectArray as $objCreatedByObject) {
				$objListItem = new QListItem($objCreatedByObject->__toString(), $objCreatedByObject->UserAccountId);
				if (($this->objAssetTransaction->CreatedByObject) && ($this->objAssetTransaction->CreatedByObject->UserAccountId == $objCreatedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstCreatedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup calCreationDate
		protected function calCreationDate_Create() {
			$this->calCreationDate = new QDateTimePicker($this);
			$this->calCreationDate->Name = QApplication::Translate('Creation Date');
			$this->calCreationDate->DateTime = $this->objAssetTransaction->CreationDate;
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
				if (($this->objAssetTransaction->ModifiedByObject) && ($this->objAssetTransaction->ModifiedByObject->UserAccountId == $objModifiedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstModifiedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup lblModifiedDate
		protected function lblModifiedDate_Create() {
			$this->lblModifiedDate = new QLabel($this);
			$this->lblModifiedDate->Name = QApplication::Translate('Modified Date');
			if ($this->blnEditMode)
				$this->lblModifiedDate->Text = $this->objAssetTransaction->ModifiedDate;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'AssetTransaction')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateAssetTransactionFields() {
			$this->objAssetTransaction->AssetId = $this->lstAsset->SelectedValue;
			$this->objAssetTransaction->TransactionId = $this->lstTransaction->SelectedValue;
			$this->objAssetTransaction->ParentAssetTransactionId = $this->lstParentAssetTransaction->SelectedValue;
			$this->objAssetTransaction->SourceLocationId = $this->lstSourceLocation->SelectedValue;
			$this->objAssetTransaction->DestinationLocationId = $this->lstDestinationLocation->SelectedValue;
			$this->objAssetTransaction->NewAssetFlag = $this->chkNewAssetFlag->Checked;
			$this->objAssetTransaction->NewAssetId = $this->lstNewAsset->SelectedValue;
			$this->objAssetTransaction->ScheduleReceiptFlag = $this->chkScheduleReceiptFlag->Checked;
			$this->objAssetTransaction->ScheduleReceiptDueDate = $this->calScheduleReceiptDueDate->DateTime;
			$this->objAssetTransaction->CreatedBy = $this->lstCreatedByObject->SelectedValue;
			$this->objAssetTransaction->CreationDate = $this->calCreationDate->DateTime;
			$this->objAssetTransaction->ModifiedBy = $this->lstModifiedByObject->SelectedValue;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateAssetTransactionFields();
			$this->objAssetTransaction->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objAssetTransaction->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('asset_transaction_list.php');
		}
	}
?>