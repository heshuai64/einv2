<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the PackageType class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single PackageType object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this PackageTypeEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class PackageTypeEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objPackageType;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for PackageType's Data Fields
		public $lblPackageTypeId;
		public $txtShortDescription;
		public $lstCourier;
		public $txtValue;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupPackageType($objPackageType) {
			if ($objPackageType) {
				$this->objPackageType = $objPackageType;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objPackageType = new PackageType();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objPackageType = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupPackageType to either Load/Edit Existing or Create New
			$this->SetupPackageType($objPackageType);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for PackageType's Data Fields
			$this->lblPackageTypeId_Create();
			$this->txtShortDescription_Create();
			$this->lstCourier_Create();
			$this->txtValue_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblPackageTypeId
		protected function lblPackageTypeId_Create() {
			$this->lblPackageTypeId = new QLabel($this);
			$this->lblPackageTypeId->Name = QApplication::Translate('Package Type Id');
			if ($this->blnEditMode)
				$this->lblPackageTypeId->Text = $this->objPackageType->PackageTypeId;
			else
				$this->lblPackageTypeId->Text = 'N/A';
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objPackageType->ShortDescription;
			$this->txtShortDescription->Required = true;
			$this->txtShortDescription->MaxLength = PackageType::ShortDescriptionMaxLength;
		}

		// Create and Setup lstCourier
		protected function lstCourier_Create() {
			$this->lstCourier = new QListBox($this);
			$this->lstCourier->Name = QApplication::Translate('Courier');
			$this->lstCourier->Required = true;
			if (!$this->blnEditMode)
				$this->lstCourier->AddItem(QApplication::Translate('- Select One -'), null);
			$objCourierArray = Courier::LoadAll();
			if ($objCourierArray) foreach ($objCourierArray as $objCourier) {
				$objListItem = new QListItem($objCourier->__toString(), $objCourier->CourierId);
				if (($this->objPackageType->Courier) && ($this->objPackageType->Courier->CourierId == $objCourier->CourierId))
					$objListItem->Selected = true;
				$this->lstCourier->AddItem($objListItem);
			}
		}

		// Create and Setup txtValue
		protected function txtValue_Create() {
			$this->txtValue = new QTextBox($this);
			$this->txtValue->Name = QApplication::Translate('Value');
			$this->txtValue->Text = $this->objPackageType->Value;
			$this->txtValue->MaxLength = PackageType::ValueMaxLength;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'PackageType')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdatePackageTypeFields() {
			$this->objPackageType->ShortDescription = $this->txtShortDescription->Text;
			$this->objPackageType->CourierId = $this->lstCourier->SelectedValue;
			$this->objPackageType->Value = $this->txtValue->Text;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdatePackageTypeFields();
			$this->objPackageType->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objPackageType->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>