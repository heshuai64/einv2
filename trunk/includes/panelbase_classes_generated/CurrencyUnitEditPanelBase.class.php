<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the CurrencyUnit class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single CurrencyUnit object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this CurrencyUnitEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class CurrencyUnitEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objCurrencyUnit;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for CurrencyUnit's Data Fields
		public $lblCurrencyUnitId;
		public $txtShortDescription;
		public $txtSymbol;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupCurrencyUnit($objCurrencyUnit) {
			if ($objCurrencyUnit) {
				$this->objCurrencyUnit = $objCurrencyUnit;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objCurrencyUnit = new CurrencyUnit();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objCurrencyUnit = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupCurrencyUnit to either Load/Edit Existing or Create New
			$this->SetupCurrencyUnit($objCurrencyUnit);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for CurrencyUnit's Data Fields
			$this->lblCurrencyUnitId_Create();
			$this->txtShortDescription_Create();
			$this->txtSymbol_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblCurrencyUnitId
		protected function lblCurrencyUnitId_Create() {
			$this->lblCurrencyUnitId = new QLabel($this);
			$this->lblCurrencyUnitId->Name = QApplication::Translate('Currency Unit Id');
			if ($this->blnEditMode)
				$this->lblCurrencyUnitId->Text = $this->objCurrencyUnit->CurrencyUnitId;
			else
				$this->lblCurrencyUnitId->Text = 'N/A';
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objCurrencyUnit->ShortDescription;
			$this->txtShortDescription->MaxLength = CurrencyUnit::ShortDescriptionMaxLength;
		}

		// Create and Setup txtSymbol
		protected function txtSymbol_Create() {
			$this->txtSymbol = new QTextBox($this);
			$this->txtSymbol->Name = QApplication::Translate('Symbol');
			$this->txtSymbol->Text = $this->objCurrencyUnit->Symbol;
			$this->txtSymbol->MaxLength = CurrencyUnit::SymbolMaxLength;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'CurrencyUnit')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateCurrencyUnitFields() {
			$this->objCurrencyUnit->ShortDescription = $this->txtShortDescription->Text;
			$this->objCurrencyUnit->Symbol = $this->txtSymbol->Text;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateCurrencyUnitFields();
			$this->objCurrencyUnit->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objCurrencyUnit->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>