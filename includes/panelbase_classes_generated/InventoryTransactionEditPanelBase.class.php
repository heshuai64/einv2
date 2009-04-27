<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the InventoryTransaction class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single InventoryTransaction object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this InventoryTransactionEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class InventoryTransactionEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objInventoryTransaction;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for InventoryTransaction's Data Fields
		public $lblInventoryTransactionId;
		public $lstInventoryLocation;
		public $lstTransaction;
		public $txtQuantity;
		public $lstSourceLocation;
		public $lstDestinationLocation;
		public $lstCreatedByObject;
		public $calCreationDate;
		public $lstModifiedByObject;
		public $lblModifiedDate;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupInventoryTransaction($objInventoryTransaction) {
			if ($objInventoryTransaction) {
				$this->objInventoryTransaction = $objInventoryTransaction;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objInventoryTransaction = new InventoryTransaction();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objInventoryTransaction = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupInventoryTransaction to either Load/Edit Existing or Create New
			$this->SetupInventoryTransaction($objInventoryTransaction);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for InventoryTransaction's Data Fields
			$this->lblInventoryTransactionId_Create();
			$this->lstInventoryLocation_Create();
			$this->lstTransaction_Create();
			$this->txtQuantity_Create();
			$this->lstSourceLocation_Create();
			$this->lstDestinationLocation_Create();
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
		// Create and Setup lblInventoryTransactionId
		protected function lblInventoryTransactionId_Create() {
			$this->lblInventoryTransactionId = new QLabel($this);
			$this->lblInventoryTransactionId->Name = QApplication::Translate('Inventory Transaction Id');
			if ($this->blnEditMode)
				$this->lblInventoryTransactionId->Text = $this->objInventoryTransaction->InventoryTransactionId;
			else
				$this->lblInventoryTransactionId->Text = 'N/A';
		}

		// Create and Setup lstInventoryLocation
		protected function lstInventoryLocation_Create() {
			$this->lstInventoryLocation = new QListBox($this);
			$this->lstInventoryLocation->Name = QApplication::Translate('Inventory Location');
			$this->lstInventoryLocation->Required = true;
			if (!$this->blnEditMode)
				$this->lstInventoryLocation->AddItem(QApplication::Translate('- Select One -'), null);
			$objInventoryLocationArray = InventoryLocation::LoadAll();
			if ($objInventoryLocationArray) foreach ($objInventoryLocationArray as $objInventoryLocation) {
				$objListItem = new QListItem($objInventoryLocation->__toString(), $objInventoryLocation->InventoryLocationId);
				if (($this->objInventoryTransaction->InventoryLocation) && ($this->objInventoryTransaction->InventoryLocation->InventoryLocationId == $objInventoryLocation->InventoryLocationId))
					$objListItem->Selected = true;
				$this->lstInventoryLocation->AddItem($objListItem);
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
				if (($this->objInventoryTransaction->Transaction) && ($this->objInventoryTransaction->Transaction->TransactionId == $objTransaction->TransactionId))
					$objListItem->Selected = true;
				$this->lstTransaction->AddItem($objListItem);
			}
		}

		// Create and Setup txtQuantity
		protected function txtQuantity_Create() {
			$this->txtQuantity = new QIntegerTextBox($this);
			$this->txtQuantity->Name = QApplication::Translate('Quantity');
			$this->txtQuantity->Text = $this->objInventoryTransaction->Quantity;
			$this->txtQuantity->Required = true;
		}

		// Create and Setup lstSourceLocation
		protected function lstSourceLocation_Create() {
			$this->lstSourceLocation = new QListBox($this);
			$this->lstSourceLocation->Name = QApplication::Translate('Source Location');
			$this->lstSourceLocation->AddItem(QApplication::Translate('- Select One -'), null);
			$objSourceLocationArray = Location::LoadAll();
			if ($objSourceLocationArray) foreach ($objSourceLocationArray as $objSourceLocation) {
				$objListItem = new QListItem($objSourceLocation->__toString(), $objSourceLocation->LocationId);
				if (($this->objInventoryTransaction->SourceLocation) && ($this->objInventoryTransaction->SourceLocation->LocationId == $objSourceLocation->LocationId))
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
				if (($this->objInventoryTransaction->DestinationLocation) && ($this->objInventoryTransaction->DestinationLocation->LocationId == $objDestinationLocation->LocationId))
					$objListItem->Selected = true;
				$this->lstDestinationLocation->AddItem($objListItem);
			}
		}

		// Create and Setup lstCreatedByObject
		protected function lstCreatedByObject_Create() {
			$this->lstCreatedByObject = new QListBox($this);
			$this->lstCreatedByObject->Name = QApplication::Translate('Created By Object');
			$this->lstCreatedByObject->AddItem(QApplication::Translate('- Select One -'), null);
			$objCreatedByObjectArray = UserAccount::LoadAll();
			if ($objCreatedByObjectArray) foreach ($objCreatedByObjectArray as $objCreatedByObject) {
				$objListItem = new QListItem($objCreatedByObject->__toString(), $objCreatedByObject->UserAccountId);
				if (($this->objInventoryTransaction->CreatedByObject) && ($this->objInventoryTransaction->CreatedByObject->UserAccountId == $objCreatedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstCreatedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup calCreationDate
		protected function calCreationDate_Create() {
			$this->calCreationDate = new QDateTimePicker($this);
			$this->calCreationDate->Name = QApplication::Translate('Creation Date');
			$this->calCreationDate->DateTime = $this->objInventoryTransaction->CreationDate;
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
				if (($this->objInventoryTransaction->ModifiedByObject) && ($this->objInventoryTransaction->ModifiedByObject->UserAccountId == $objModifiedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstModifiedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup lblModifiedDate
		protected function lblModifiedDate_Create() {
			$this->lblModifiedDate = new QLabel($this);
			$this->lblModifiedDate->Name = QApplication::Translate('Modified Date');
			if ($this->blnEditMode)
				$this->lblModifiedDate->Text = $this->objInventoryTransaction->ModifiedDate;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'InventoryTransaction')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateInventoryTransactionFields() {
			$this->objInventoryTransaction->InventoryLocationId = $this->lstInventoryLocation->SelectedValue;
			$this->objInventoryTransaction->TransactionId = $this->lstTransaction->SelectedValue;
			$this->objInventoryTransaction->Quantity = $this->txtQuantity->Text;
			$this->objInventoryTransaction->SourceLocationId = $this->lstSourceLocation->SelectedValue;
			$this->objInventoryTransaction->DestinationLocationId = $this->lstDestinationLocation->SelectedValue;
			$this->objInventoryTransaction->CreatedBy = $this->lstCreatedByObject->SelectedValue;
			$this->objInventoryTransaction->CreationDate = $this->calCreationDate->DateTime;
			$this->objInventoryTransaction->ModifiedBy = $this->lstModifiedByObject->SelectedValue;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateInventoryTransactionFields();
			$this->objInventoryTransaction->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objInventoryTransaction->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>