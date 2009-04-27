<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the TransactionType class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single TransactionType object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this TransactionTypeEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class TransactionTypeEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objTransactionType;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for TransactionType's Data Fields
		public $lblTransactionTypeId;
		public $txtShortDescription;
		public $chkAssetFlag;
		public $chkInventoryFlag;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupTransactionType($objTransactionType) {
			if ($objTransactionType) {
				$this->objTransactionType = $objTransactionType;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objTransactionType = new TransactionType();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objTransactionType = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupTransactionType to either Load/Edit Existing or Create New
			$this->SetupTransactionType($objTransactionType);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for TransactionType's Data Fields
			$this->lblTransactionTypeId_Create();
			$this->txtShortDescription_Create();
			$this->chkAssetFlag_Create();
			$this->chkInventoryFlag_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblTransactionTypeId
		protected function lblTransactionTypeId_Create() {
			$this->lblTransactionTypeId = new QLabel($this);
			$this->lblTransactionTypeId->Name = QApplication::Translate('Transaction Type Id');
			if ($this->blnEditMode)
				$this->lblTransactionTypeId->Text = $this->objTransactionType->TransactionTypeId;
			else
				$this->lblTransactionTypeId->Text = 'N/A';
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objTransactionType->ShortDescription;
			$this->txtShortDescription->Required = true;
			$this->txtShortDescription->MaxLength = TransactionType::ShortDescriptionMaxLength;
		}

		// Create and Setup chkAssetFlag
		protected function chkAssetFlag_Create() {
			$this->chkAssetFlag = new QCheckBox($this);
			$this->chkAssetFlag->Name = QApplication::Translate('Asset Flag');
			$this->chkAssetFlag->Checked = $this->objTransactionType->AssetFlag;
		}

		// Create and Setup chkInventoryFlag
		protected function chkInventoryFlag_Create() {
			$this->chkInventoryFlag = new QCheckBox($this);
			$this->chkInventoryFlag->Name = QApplication::Translate('Inventory Flag');
			$this->chkInventoryFlag->Checked = $this->objTransactionType->InventoryFlag;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'TransactionType')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateTransactionTypeFields() {
			$this->objTransactionType->ShortDescription = $this->txtShortDescription->Text;
			$this->objTransactionType->AssetFlag = $this->chkAssetFlag->Checked;
			$this->objTransactionType->InventoryFlag = $this->chkInventoryFlag->Checked;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateTransactionTypeFields();
			$this->objTransactionType->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objTransactionType->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>