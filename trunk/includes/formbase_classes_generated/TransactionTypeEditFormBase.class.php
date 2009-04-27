<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the TransactionType class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single TransactionType object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this TransactionTypeEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class TransactionTypeEditFormBase extends QForm {
		// General Form Variables
		protected $objTransactionType;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for TransactionType's Data Fields
		protected $lblTransactionTypeId;
		protected $txtShortDescription;
		protected $chkAssetFlag;
		protected $chkInventoryFlag;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupTransactionType() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intTransactionTypeId = QApplication::QueryString('intTransactionTypeId');
			if (($intTransactionTypeId)) {
				$this->objTransactionType = TransactionType::Load(($intTransactionTypeId));

				if (!$this->objTransactionType)
					throw new Exception('Could not find a TransactionType object with PK arguments: ' . $intTransactionTypeId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objTransactionType = new TransactionType();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupTransactionType to either Load/Edit Existing or Create New
			$this->SetupTransactionType();

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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'TransactionType')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
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
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateTransactionTypeFields();
			$this->objTransactionType->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objTransactionType->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('transaction_type_list.php');
		}
	}
?>