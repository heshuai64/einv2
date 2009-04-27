<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the AuditScan class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single AuditScan object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this AuditScanEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class AuditScanEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objAuditScan;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for AuditScan's Data Fields
		public $lblAuditScanId;
		public $lstAudit;
		public $lstLocation;
		public $txtEntityId;
		public $txtCount;
		public $txtSystemCount;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupAuditScan($objAuditScan) {
			if ($objAuditScan) {
				$this->objAuditScan = $objAuditScan;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objAuditScan = new AuditScan();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objAuditScan = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupAuditScan to either Load/Edit Existing or Create New
			$this->SetupAuditScan($objAuditScan);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for AuditScan's Data Fields
			$this->lblAuditScanId_Create();
			$this->lstAudit_Create();
			$this->lstLocation_Create();
			$this->txtEntityId_Create();
			$this->txtCount_Create();
			$this->txtSystemCount_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblAuditScanId
		protected function lblAuditScanId_Create() {
			$this->lblAuditScanId = new QLabel($this);
			$this->lblAuditScanId->Name = QApplication::Translate('Audit Scan Id');
			if ($this->blnEditMode)
				$this->lblAuditScanId->Text = $this->objAuditScan->AuditScanId;
			else
				$this->lblAuditScanId->Text = 'N/A';
		}

		// Create and Setup lstAudit
		protected function lstAudit_Create() {
			$this->lstAudit = new QListBox($this);
			$this->lstAudit->Name = QApplication::Translate('Audit');
			$this->lstAudit->Required = true;
			if (!$this->blnEditMode)
				$this->lstAudit->AddItem(QApplication::Translate('- Select One -'), null);
			$objAuditArray = Audit::LoadAll();
			if ($objAuditArray) foreach ($objAuditArray as $objAudit) {
				$objListItem = new QListItem($objAudit->__toString(), $objAudit->AuditId);
				if (($this->objAuditScan->Audit) && ($this->objAuditScan->Audit->AuditId == $objAudit->AuditId))
					$objListItem->Selected = true;
				$this->lstAudit->AddItem($objListItem);
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
				if (($this->objAuditScan->Location) && ($this->objAuditScan->Location->LocationId == $objLocation->LocationId))
					$objListItem->Selected = true;
				$this->lstLocation->AddItem($objListItem);
			}
		}

		// Create and Setup txtEntityId
		protected function txtEntityId_Create() {
			$this->txtEntityId = new QIntegerTextBox($this);
			$this->txtEntityId->Name = QApplication::Translate('Entity Id');
			$this->txtEntityId->Text = $this->objAuditScan->EntityId;
		}

		// Create and Setup txtCount
		protected function txtCount_Create() {
			$this->txtCount = new QIntegerTextBox($this);
			$this->txtCount->Name = QApplication::Translate('Count');
			$this->txtCount->Text = $this->objAuditScan->Count;
		}

		// Create and Setup txtSystemCount
		protected function txtSystemCount_Create() {
			$this->txtSystemCount = new QIntegerTextBox($this);
			$this->txtSystemCount->Name = QApplication::Translate('System Count');
			$this->txtSystemCount->Text = $this->objAuditScan->SystemCount;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'AuditScan')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateAuditScanFields() {
			$this->objAuditScan->AuditId = $this->lstAudit->SelectedValue;
			$this->objAuditScan->LocationId = $this->lstLocation->SelectedValue;
			$this->objAuditScan->EntityId = $this->txtEntityId->Text;
			$this->objAuditScan->Count = $this->txtCount->Text;
			$this->objAuditScan->SystemCount = $this->txtSystemCount->Text;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateAuditScanFields();
			$this->objAuditScan->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objAuditScan->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>