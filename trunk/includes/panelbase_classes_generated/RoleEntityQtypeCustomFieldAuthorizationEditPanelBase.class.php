<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the RoleEntityQtypeCustomFieldAuthorization class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single RoleEntityQtypeCustomFieldAuthorization object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this RoleEntityQtypeCustomFieldAuthorizationEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class RoleEntityQtypeCustomFieldAuthorizationEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objRoleEntityQtypeCustomFieldAuthorization;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for RoleEntityQtypeCustomFieldAuthorization's Data Fields
		public $lblRoleEntityQtypeCustomFieldAuthorizationId;
		public $lstRole;
		public $lstEntityQtypeCustomField;
		public $lstAuthorization;
		public $chkAuthorizedFlag;
		public $lstCreatedByObject;
		public $calCreationDate;
		public $lstModifiedByObject;
		public $lblModifiedDate;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupRoleEntityQtypeCustomFieldAuthorization($objRoleEntityQtypeCustomFieldAuthorization) {
			if ($objRoleEntityQtypeCustomFieldAuthorization) {
				$this->objRoleEntityQtypeCustomFieldAuthorization = $objRoleEntityQtypeCustomFieldAuthorization;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objRoleEntityQtypeCustomFieldAuthorization = new RoleEntityQtypeCustomFieldAuthorization();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objRoleEntityQtypeCustomFieldAuthorization = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupRoleEntityQtypeCustomFieldAuthorization to either Load/Edit Existing or Create New
			$this->SetupRoleEntityQtypeCustomFieldAuthorization($objRoleEntityQtypeCustomFieldAuthorization);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for RoleEntityQtypeCustomFieldAuthorization's Data Fields
			$this->lblRoleEntityQtypeCustomFieldAuthorizationId_Create();
			$this->lstRole_Create();
			$this->lstEntityQtypeCustomField_Create();
			$this->lstAuthorization_Create();
			$this->chkAuthorizedFlag_Create();
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
		// Create and Setup lblRoleEntityQtypeCustomFieldAuthorizationId
		protected function lblRoleEntityQtypeCustomFieldAuthorizationId_Create() {
			$this->lblRoleEntityQtypeCustomFieldAuthorizationId = new QLabel($this);
			$this->lblRoleEntityQtypeCustomFieldAuthorizationId->Name = QApplication::Translate('Role Entity Qtype Custom Field Authorization Id');
			if ($this->blnEditMode)
				$this->lblRoleEntityQtypeCustomFieldAuthorizationId->Text = $this->objRoleEntityQtypeCustomFieldAuthorization->RoleEntityQtypeCustomFieldAuthorizationId;
			else
				$this->lblRoleEntityQtypeCustomFieldAuthorizationId->Text = 'N/A';
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
				if (($this->objRoleEntityQtypeCustomFieldAuthorization->Role) && ($this->objRoleEntityQtypeCustomFieldAuthorization->Role->RoleId == $objRole->RoleId))
					$objListItem->Selected = true;
				$this->lstRole->AddItem($objListItem);
			}
		}

		// Create and Setup lstEntityQtypeCustomField
		protected function lstEntityQtypeCustomField_Create() {
			$this->lstEntityQtypeCustomField = new QListBox($this);
			$this->lstEntityQtypeCustomField->Name = QApplication::Translate('Entity Qtype Custom Field');
			$this->lstEntityQtypeCustomField->Required = true;
			if (!$this->blnEditMode)
				$this->lstEntityQtypeCustomField->AddItem(QApplication::Translate('- Select One -'), null);
			$objEntityQtypeCustomFieldArray = EntityQtypeCustomField::LoadAll();
			if ($objEntityQtypeCustomFieldArray) foreach ($objEntityQtypeCustomFieldArray as $objEntityQtypeCustomField) {
				$objListItem = new QListItem($objEntityQtypeCustomField->__toString(), $objEntityQtypeCustomField->EntityQtypeCustomFieldId);
				if (($this->objRoleEntityQtypeCustomFieldAuthorization->EntityQtypeCustomField) && ($this->objRoleEntityQtypeCustomFieldAuthorization->EntityQtypeCustomField->EntityQtypeCustomFieldId == $objEntityQtypeCustomField->EntityQtypeCustomFieldId))
					$objListItem->Selected = true;
				$this->lstEntityQtypeCustomField->AddItem($objListItem);
			}
		}

		// Create and Setup lstAuthorization
		protected function lstAuthorization_Create() {
			$this->lstAuthorization = new QListBox($this);
			$this->lstAuthorization->Name = QApplication::Translate('Authorization');
			$this->lstAuthorization->Required = true;
			if (!$this->blnEditMode)
				$this->lstAuthorization->AddItem(QApplication::Translate('- Select One -'), null);
			$objAuthorizationArray = Authorization::LoadAll();
			if ($objAuthorizationArray) foreach ($objAuthorizationArray as $objAuthorization) {
				$objListItem = new QListItem($objAuthorization->__toString(), $objAuthorization->AuthorizationId);
				if (($this->objRoleEntityQtypeCustomFieldAuthorization->Authorization) && ($this->objRoleEntityQtypeCustomFieldAuthorization->Authorization->AuthorizationId == $objAuthorization->AuthorizationId))
					$objListItem->Selected = true;
				$this->lstAuthorization->AddItem($objListItem);
			}
		}

		// Create and Setup chkAuthorizedFlag
		protected function chkAuthorizedFlag_Create() {
			$this->chkAuthorizedFlag = new QCheckBox($this);
			$this->chkAuthorizedFlag->Name = QApplication::Translate('Authorized Flag');
			$this->chkAuthorizedFlag->Checked = $this->objRoleEntityQtypeCustomFieldAuthorization->AuthorizedFlag;
		}

		// Create and Setup lstCreatedByObject
		protected function lstCreatedByObject_Create() {
			$this->lstCreatedByObject = new QListBox($this);
			$this->lstCreatedByObject->Name = QApplication::Translate('Created By Object');
			$this->lstCreatedByObject->AddItem(QApplication::Translate('- Select One -'), null);
			$objCreatedByObjectArray = UserAccount::LoadAll();
			if ($objCreatedByObjectArray) foreach ($objCreatedByObjectArray as $objCreatedByObject) {
				$objListItem = new QListItem($objCreatedByObject->__toString(), $objCreatedByObject->UserAccountId);
				if (($this->objRoleEntityQtypeCustomFieldAuthorization->CreatedByObject) && ($this->objRoleEntityQtypeCustomFieldAuthorization->CreatedByObject->UserAccountId == $objCreatedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstCreatedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup calCreationDate
		protected function calCreationDate_Create() {
			$this->calCreationDate = new QDateTimePicker($this);
			$this->calCreationDate->Name = QApplication::Translate('Creation Date');
			$this->calCreationDate->DateTime = $this->objRoleEntityQtypeCustomFieldAuthorization->CreationDate;
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
				if (($this->objRoleEntityQtypeCustomFieldAuthorization->ModifiedByObject) && ($this->objRoleEntityQtypeCustomFieldAuthorization->ModifiedByObject->UserAccountId == $objModifiedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstModifiedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup lblModifiedDate
		protected function lblModifiedDate_Create() {
			$this->lblModifiedDate = new QLabel($this);
			$this->lblModifiedDate->Name = QApplication::Translate('Modified Date');
			if ($this->blnEditMode)
				$this->lblModifiedDate->Text = $this->objRoleEntityQtypeCustomFieldAuthorization->ModifiedDate;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'RoleEntityQtypeCustomFieldAuthorization')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateRoleEntityQtypeCustomFieldAuthorizationFields() {
			$this->objRoleEntityQtypeCustomFieldAuthorization->RoleId = $this->lstRole->SelectedValue;
			$this->objRoleEntityQtypeCustomFieldAuthorization->EntityQtypeCustomFieldId = $this->lstEntityQtypeCustomField->SelectedValue;
			$this->objRoleEntityQtypeCustomFieldAuthorization->AuthorizationId = $this->lstAuthorization->SelectedValue;
			$this->objRoleEntityQtypeCustomFieldAuthorization->AuthorizedFlag = $this->chkAuthorizedFlag->Checked;
			$this->objRoleEntityQtypeCustomFieldAuthorization->CreatedBy = $this->lstCreatedByObject->SelectedValue;
			$this->objRoleEntityQtypeCustomFieldAuthorization->CreationDate = $this->calCreationDate->DateTime;
			$this->objRoleEntityQtypeCustomFieldAuthorization->ModifiedBy = $this->lstModifiedByObject->SelectedValue;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateRoleEntityQtypeCustomFieldAuthorizationFields();
			$this->objRoleEntityQtypeCustomFieldAuthorization->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objRoleEntityQtypeCustomFieldAuthorization->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>