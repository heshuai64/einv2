<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the RoleModule class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single RoleModule object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this RoleModuleEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class RoleModuleEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objRoleModule;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for RoleModule's Data Fields
		public $lblRoleModuleId;
		public $lstRole;
		public $lstModule;
		public $chkAccessFlag;
		public $lstCreatedByObject;
		public $calCreationDate;
		public $lstModifiedByObject;
		public $lblModifiedDate;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupRoleModule($objRoleModule) {
			if ($objRoleModule) {
				$this->objRoleModule = $objRoleModule;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objRoleModule = new RoleModule();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objRoleModule = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupRoleModule to either Load/Edit Existing or Create New
			$this->SetupRoleModule($objRoleModule);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for RoleModule's Data Fields
			$this->lblRoleModuleId_Create();
			$this->lstRole_Create();
			$this->lstModule_Create();
			$this->chkAccessFlag_Create();
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
		// Create and Setup lblRoleModuleId
		protected function lblRoleModuleId_Create() {
			$this->lblRoleModuleId = new QLabel($this);
			$this->lblRoleModuleId->Name = QApplication::Translate('Role Module Id');
			if ($this->blnEditMode)
				$this->lblRoleModuleId->Text = $this->objRoleModule->RoleModuleId;
			else
				$this->lblRoleModuleId->Text = 'N/A';
		}

		// Create and Setup lstRole
		protected function lstRole_Create() {
			$this->lstRole = new QListBox($this);
			$this->lstRole->Name = QApplication::Translate('Role');
			$this->lstRole->Required = true;
			if (!$this->blnEditMode)
				$this->lstRole->AddItem(QApplication::Translate('- Select One -'), null);
			$objRoleArray = Role::LoadAll();
			if ($objRoleArray) foreach ($objRoleArray as $objRole) {
				$objListItem = new QListItem($objRole->__toString(), $objRole->RoleId);
				if (($this->objRoleModule->Role) && ($this->objRoleModule->Role->RoleId == $objRole->RoleId))
					$objListItem->Selected = true;
				$this->lstRole->AddItem($objListItem);
			}
		}

		// Create and Setup lstModule
		protected function lstModule_Create() {
			$this->lstModule = new QListBox($this);
			$this->lstModule->Name = QApplication::Translate('Module');
			$this->lstModule->Required = true;
			if (!$this->blnEditMode)
				$this->lstModule->AddItem(QApplication::Translate('- Select One -'), null);
			$objModuleArray = Module::LoadAll();
			if ($objModuleArray) foreach ($objModuleArray as $objModule) {
				$objListItem = new QListItem($objModule->__toString(), $objModule->ModuleId);
				if (($this->objRoleModule->Module) && ($this->objRoleModule->Module->ModuleId == $objModule->ModuleId))
					$objListItem->Selected = true;
				$this->lstModule->AddItem($objListItem);
			}
		}

		// Create and Setup chkAccessFlag
		protected function chkAccessFlag_Create() {
			$this->chkAccessFlag = new QCheckBox($this);
			$this->chkAccessFlag->Name = QApplication::Translate('Access Flag');
			$this->chkAccessFlag->Checked = $this->objRoleModule->AccessFlag;
		}

		// Create and Setup lstCreatedByObject
		protected function lstCreatedByObject_Create() {
			$this->lstCreatedByObject = new QListBox($this);
			$this->lstCreatedByObject->Name = QApplication::Translate('Created By Object');
			$this->lstCreatedByObject->AddItem(QApplication::Translate('- Select One -'), null);
			$objCreatedByObjectArray = UserAccount::LoadAll();
			if ($objCreatedByObjectArray) foreach ($objCreatedByObjectArray as $objCreatedByObject) {
				$objListItem = new QListItem($objCreatedByObject->__toString(), $objCreatedByObject->UserAccountId);
				if (($this->objRoleModule->CreatedByObject) && ($this->objRoleModule->CreatedByObject->UserAccountId == $objCreatedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstCreatedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup calCreationDate
		protected function calCreationDate_Create() {
			$this->calCreationDate = new QDateTimePicker($this);
			$this->calCreationDate->Name = QApplication::Translate('Creation Date');
			$this->calCreationDate->DateTime = $this->objRoleModule->CreationDate;
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
				if (($this->objRoleModule->ModifiedByObject) && ($this->objRoleModule->ModifiedByObject->UserAccountId == $objModifiedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstModifiedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup lblModifiedDate
		protected function lblModifiedDate_Create() {
			$this->lblModifiedDate = new QLabel($this);
			$this->lblModifiedDate->Name = QApplication::Translate('Modified Date');
			if ($this->blnEditMode)
				$this->lblModifiedDate->Text = $this->objRoleModule->ModifiedDate;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'RoleModule')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateRoleModuleFields() {
			$this->objRoleModule->RoleId = $this->lstRole->SelectedValue;
			$this->objRoleModule->ModuleId = $this->lstModule->SelectedValue;
			$this->objRoleModule->AccessFlag = $this->chkAccessFlag->Checked;
			$this->objRoleModule->CreatedBy = $this->lstCreatedByObject->SelectedValue;
			$this->objRoleModule->CreationDate = $this->calCreationDate->DateTime;
			$this->objRoleModule->ModifiedBy = $this->lstModifiedByObject->SelectedValue;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateRoleModuleFields();
			$this->objRoleModule->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objRoleModule->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>