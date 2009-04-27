<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the RoleModuleAuthorization class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single RoleModuleAuthorization object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this RoleModuleAuthorizationEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class RoleModuleAuthorizationEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objRoleModuleAuthorization;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for RoleModuleAuthorization's Data Fields
		public $lblRoleModuleAuthorizationId;
		public $lstRoleModule;
		public $lstAuthorization;
		public $lstAuthorizationLevel;
		public $lstCreatedByObject;
		public $calCreationDate;
		public $lstModifiedByObject;
		public $lblModifiedDate;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupRoleModuleAuthorization($objRoleModuleAuthorization) {
			if ($objRoleModuleAuthorization) {
				$this->objRoleModuleAuthorization = $objRoleModuleAuthorization;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objRoleModuleAuthorization = new RoleModuleAuthorization();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objRoleModuleAuthorization = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupRoleModuleAuthorization to either Load/Edit Existing or Create New
			$this->SetupRoleModuleAuthorization($objRoleModuleAuthorization);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for RoleModuleAuthorization's Data Fields
			$this->lblRoleModuleAuthorizationId_Create();
			$this->lstRoleModule_Create();
			$this->lstAuthorization_Create();
			$this->lstAuthorizationLevel_Create();
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
		// Create and Setup lblRoleModuleAuthorizationId
		protected function lblRoleModuleAuthorizationId_Create() {
			$this->lblRoleModuleAuthorizationId = new QLabel($this);
			$this->lblRoleModuleAuthorizationId->Name = QApplication::Translate('Role Module Authorization Id');
			if ($this->blnEditMode)
				$this->lblRoleModuleAuthorizationId->Text = $this->objRoleModuleAuthorization->RoleModuleAuthorizationId;
			else
				$this->lblRoleModuleAuthorizationId->Text = 'N/A';
		}

		// Create and Setup lstRoleModule
		protected function lstRoleModule_Create() {
			$this->lstRoleModule = new QListBox($this);
			$this->lstRoleModule->Name = QApplication::Translate('Role Module');
			$this->lstRoleModule->AddItem(QApplication::Translate('- Select One -'), null);
			$objRoleModuleArray = RoleModule::LoadAll();
			if ($objRoleModuleArray) foreach ($objRoleModuleArray as $objRoleModule) {
				$objListItem = new QListItem($objRoleModule->__toString(), $objRoleModule->RoleModuleId);
				if (($this->objRoleModuleAuthorization->RoleModule) && ($this->objRoleModuleAuthorization->RoleModule->RoleModuleId == $objRoleModule->RoleModuleId))
					$objListItem->Selected = true;
				$this->lstRoleModule->AddItem($objListItem);
			}
		}

		// Create and Setup lstAuthorization
		protected function lstAuthorization_Create() {
			$this->lstAuthorization = new QListBox($this);
			$this->lstAuthorization->Name = QApplication::Translate('Authorization');
			$this->lstAuthorization->AddItem(QApplication::Translate('- Select One -'), null);
			$objAuthorizationArray = Authorization::LoadAll();
			if ($objAuthorizationArray) foreach ($objAuthorizationArray as $objAuthorization) {
				$objListItem = new QListItem($objAuthorization->__toString(), $objAuthorization->AuthorizationId);
				if (($this->objRoleModuleAuthorization->Authorization) && ($this->objRoleModuleAuthorization->Authorization->AuthorizationId == $objAuthorization->AuthorizationId))
					$objListItem->Selected = true;
				$this->lstAuthorization->AddItem($objListItem);
			}
		}

		// Create and Setup lstAuthorizationLevel
		protected function lstAuthorizationLevel_Create() {
			$this->lstAuthorizationLevel = new QListBox($this);
			$this->lstAuthorizationLevel->Name = QApplication::Translate('Authorization Level');
			$this->lstAuthorizationLevel->AddItem(QApplication::Translate('- Select One -'), null);
			$objAuthorizationLevelArray = AuthorizationLevel::LoadAll();
			if ($objAuthorizationLevelArray) foreach ($objAuthorizationLevelArray as $objAuthorizationLevel) {
				$objListItem = new QListItem($objAuthorizationLevel->__toString(), $objAuthorizationLevel->AuthorizationLevelId);
				if (($this->objRoleModuleAuthorization->AuthorizationLevel) && ($this->objRoleModuleAuthorization->AuthorizationLevel->AuthorizationLevelId == $objAuthorizationLevel->AuthorizationLevelId))
					$objListItem->Selected = true;
				$this->lstAuthorizationLevel->AddItem($objListItem);
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
				if (($this->objRoleModuleAuthorization->CreatedByObject) && ($this->objRoleModuleAuthorization->CreatedByObject->UserAccountId == $objCreatedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstCreatedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup calCreationDate
		protected function calCreationDate_Create() {
			$this->calCreationDate = new QDateTimePicker($this);
			$this->calCreationDate->Name = QApplication::Translate('Creation Date');
			$this->calCreationDate->DateTime = $this->objRoleModuleAuthorization->CreationDate;
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
				if (($this->objRoleModuleAuthorization->ModifiedByObject) && ($this->objRoleModuleAuthorization->ModifiedByObject->UserAccountId == $objModifiedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstModifiedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup lblModifiedDate
		protected function lblModifiedDate_Create() {
			$this->lblModifiedDate = new QLabel($this);
			$this->lblModifiedDate->Name = QApplication::Translate('Modified Date');
			if ($this->blnEditMode)
				$this->lblModifiedDate->Text = $this->objRoleModuleAuthorization->ModifiedDate;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'RoleModuleAuthorization')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateRoleModuleAuthorizationFields() {
			$this->objRoleModuleAuthorization->RoleModuleId = $this->lstRoleModule->SelectedValue;
			$this->objRoleModuleAuthorization->AuthorizationId = $this->lstAuthorization->SelectedValue;
			$this->objRoleModuleAuthorization->AuthorizationLevelId = $this->lstAuthorizationLevel->SelectedValue;
			$this->objRoleModuleAuthorization->CreatedBy = $this->lstCreatedByObject->SelectedValue;
			$this->objRoleModuleAuthorization->CreationDate = $this->calCreationDate->DateTime;
			$this->objRoleModuleAuthorization->ModifiedBy = $this->lstModifiedByObject->SelectedValue;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateRoleModuleAuthorizationFields();
			$this->objRoleModuleAuthorization->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objRoleModuleAuthorization->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>