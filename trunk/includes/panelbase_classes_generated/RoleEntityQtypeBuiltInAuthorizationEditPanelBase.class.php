<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the RoleEntityQtypeBuiltInAuthorization class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single RoleEntityQtypeBuiltInAuthorization object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this RoleEntityQtypeBuiltInAuthorizationEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class RoleEntityQtypeBuiltInAuthorizationEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objRoleEntityQtypeBuiltInAuthorization;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for RoleEntityQtypeBuiltInAuthorization's Data Fields
		public $lblRoleEntityBuiltInId;
		public $lstRole;
		public $lstEntityQtype;
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

		protected function SetupRoleEntityQtypeBuiltInAuthorization($objRoleEntityQtypeBuiltInAuthorization) {
			if ($objRoleEntityQtypeBuiltInAuthorization) {
				$this->objRoleEntityQtypeBuiltInAuthorization = $objRoleEntityQtypeBuiltInAuthorization;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objRoleEntityQtypeBuiltInAuthorization = new RoleEntityQtypeBuiltInAuthorization();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objRoleEntityQtypeBuiltInAuthorization = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupRoleEntityQtypeBuiltInAuthorization to either Load/Edit Existing or Create New
			$this->SetupRoleEntityQtypeBuiltInAuthorization($objRoleEntityQtypeBuiltInAuthorization);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for RoleEntityQtypeBuiltInAuthorization's Data Fields
			$this->lblRoleEntityBuiltInId_Create();
			$this->lstRole_Create();
			$this->lstEntityQtype_Create();
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
		// Create and Setup lblRoleEntityBuiltInId
		protected function lblRoleEntityBuiltInId_Create() {
			$this->lblRoleEntityBuiltInId = new QLabel($this);
			$this->lblRoleEntityBuiltInId->Name = QApplication::Translate('Role Entity Built In Id');
			if ($this->blnEditMode)
				$this->lblRoleEntityBuiltInId->Text = $this->objRoleEntityQtypeBuiltInAuthorization->RoleEntityBuiltInId;
			else
				$this->lblRoleEntityBuiltInId->Text = 'N/A';
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
				if (($this->objRoleEntityQtypeBuiltInAuthorization->Role) && ($this->objRoleEntityQtypeBuiltInAuthorization->Role->RoleId == $objRole->RoleId))
					$objListItem->Selected = true;
				$this->lstRole->AddItem($objListItem);
			}
		}

		// Create and Setup lstEntityQtype
		protected function lstEntityQtype_Create() {
			$this->lstEntityQtype = new QListBox($this);
			$this->lstEntityQtype->Name = QApplication::Translate('Entity Qtype');
			$this->lstEntityQtype->Required = true;
			foreach (EntityQtype::$NameArray as $intId => $strValue)
				$this->lstEntityQtype->AddItem(new QListItem($strValue, $intId, $this->objRoleEntityQtypeBuiltInAuthorization->EntityQtypeId == $intId));
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
				if (($this->objRoleEntityQtypeBuiltInAuthorization->Authorization) && ($this->objRoleEntityQtypeBuiltInAuthorization->Authorization->AuthorizationId == $objAuthorization->AuthorizationId))
					$objListItem->Selected = true;
				$this->lstAuthorization->AddItem($objListItem);
			}
		}

		// Create and Setup chkAuthorizedFlag
		protected function chkAuthorizedFlag_Create() {
			$this->chkAuthorizedFlag = new QCheckBox($this);
			$this->chkAuthorizedFlag->Name = QApplication::Translate('Authorized Flag');
			$this->chkAuthorizedFlag->Checked = $this->objRoleEntityQtypeBuiltInAuthorization->AuthorizedFlag;
		}

		// Create and Setup lstCreatedByObject
		protected function lstCreatedByObject_Create() {
			$this->lstCreatedByObject = new QListBox($this);
			$this->lstCreatedByObject->Name = QApplication::Translate('Created By Object');
			$this->lstCreatedByObject->AddItem(QApplication::Translate('- Select One -'), null);
			$objCreatedByObjectArray = UserAccount::LoadAll();
			if ($objCreatedByObjectArray) foreach ($objCreatedByObjectArray as $objCreatedByObject) {
				$objListItem = new QListItem($objCreatedByObject->__toString(), $objCreatedByObject->UserAccountId);
				if (($this->objRoleEntityQtypeBuiltInAuthorization->CreatedByObject) && ($this->objRoleEntityQtypeBuiltInAuthorization->CreatedByObject->UserAccountId == $objCreatedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstCreatedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup calCreationDate
		protected function calCreationDate_Create() {
			$this->calCreationDate = new QDateTimePicker($this);
			$this->calCreationDate->Name = QApplication::Translate('Creation Date');
			$this->calCreationDate->DateTime = $this->objRoleEntityQtypeBuiltInAuthorization->CreationDate;
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
				if (($this->objRoleEntityQtypeBuiltInAuthorization->ModifiedByObject) && ($this->objRoleEntityQtypeBuiltInAuthorization->ModifiedByObject->UserAccountId == $objModifiedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstModifiedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup lblModifiedDate
		protected function lblModifiedDate_Create() {
			$this->lblModifiedDate = new QLabel($this);
			$this->lblModifiedDate->Name = QApplication::Translate('Modified Date');
			if ($this->blnEditMode)
				$this->lblModifiedDate->Text = $this->objRoleEntityQtypeBuiltInAuthorization->ModifiedDate;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'RoleEntityQtypeBuiltInAuthorization')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateRoleEntityQtypeBuiltInAuthorizationFields() {
			$this->objRoleEntityQtypeBuiltInAuthorization->RoleId = $this->lstRole->SelectedValue;
			$this->objRoleEntityQtypeBuiltInAuthorization->EntityQtypeId = $this->lstEntityQtype->SelectedValue;
			$this->objRoleEntityQtypeBuiltInAuthorization->AuthorizationId = $this->lstAuthorization->SelectedValue;
			$this->objRoleEntityQtypeBuiltInAuthorization->AuthorizedFlag = $this->chkAuthorizedFlag->Checked;
			$this->objRoleEntityQtypeBuiltInAuthorization->CreatedBy = $this->lstCreatedByObject->SelectedValue;
			$this->objRoleEntityQtypeBuiltInAuthorization->CreationDate = $this->calCreationDate->DateTime;
			$this->objRoleEntityQtypeBuiltInAuthorization->ModifiedBy = $this->lstModifiedByObject->SelectedValue;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateRoleEntityQtypeBuiltInAuthorizationFields();
			$this->objRoleEntityQtypeBuiltInAuthorization->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objRoleEntityQtypeBuiltInAuthorization->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>