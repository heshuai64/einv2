<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the DatagridColumnPreference class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single DatagridColumnPreference object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this DatagridColumnPreferenceEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class DatagridColumnPreferenceEditFormBase extends QForm {
		// General Form Variables
		protected $objDatagridColumnPreference;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for DatagridColumnPreference's Data Fields
		protected $lblDatagridColumnPreferenceId;
		protected $lstDatagrid;
		protected $txtColumnName;
		protected $lstUserAccount;
		protected $chkDisplayFlag;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupDatagridColumnPreference() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intDatagridColumnPreferenceId = QApplication::QueryString('intDatagridColumnPreferenceId');
			if (($intDatagridColumnPreferenceId)) {
				$this->objDatagridColumnPreference = DatagridColumnPreference::Load(($intDatagridColumnPreferenceId));

				if (!$this->objDatagridColumnPreference)
					throw new Exception('Could not find a DatagridColumnPreference object with PK arguments: ' . $intDatagridColumnPreferenceId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objDatagridColumnPreference = new DatagridColumnPreference();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupDatagridColumnPreference to either Load/Edit Existing or Create New
			$this->SetupDatagridColumnPreference();

			// Create/Setup Controls for DatagridColumnPreference's Data Fields
			$this->lblDatagridColumnPreferenceId_Create();
			$this->lstDatagrid_Create();
			$this->txtColumnName_Create();
			$this->lstUserAccount_Create();
			$this->chkDisplayFlag_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblDatagridColumnPreferenceId
		protected function lblDatagridColumnPreferenceId_Create() {
			$this->lblDatagridColumnPreferenceId = new QLabel($this);
			$this->lblDatagridColumnPreferenceId->Name = QApplication::Translate('Datagrid Column Preference Id');
			if ($this->blnEditMode)
				$this->lblDatagridColumnPreferenceId->Text = $this->objDatagridColumnPreference->DatagridColumnPreferenceId;
			else
				$this->lblDatagridColumnPreferenceId->Text = 'N/A';
		}

		// Create and Setup lstDatagrid
		protected function lstDatagrid_Create() {
			$this->lstDatagrid = new QListBox($this);
			$this->lstDatagrid->Name = QApplication::Translate('Datagrid');
			$this->lstDatagrid->Required = true;
			if (!$this->blnEditMode)
				$this->lstDatagrid->AddItem(QApplication::Translate('- Select One -'), null);
			$objDatagridArray = Datagrid::LoadAll();
			if ($objDatagridArray) foreach ($objDatagridArray as $objDatagrid) {
				$objListItem = new QListItem($objDatagrid->__toString(), $objDatagrid->DatagridId);
				if (($this->objDatagridColumnPreference->Datagrid) && ($this->objDatagridColumnPreference->Datagrid->DatagridId == $objDatagrid->DatagridId))
					$objListItem->Selected = true;
				$this->lstDatagrid->AddItem($objListItem);
			}
		}

		// Create and Setup txtColumnName
		protected function txtColumnName_Create() {
			$this->txtColumnName = new QTextBox($this);
			$this->txtColumnName->Name = QApplication::Translate('Column Name');
			$this->txtColumnName->Text = $this->objDatagridColumnPreference->ColumnName;
			$this->txtColumnName->Required = true;
			$this->txtColumnName->MaxLength = DatagridColumnPreference::ColumnNameMaxLength;
		}

		// Create and Setup lstUserAccount
		protected function lstUserAccount_Create() {
			$this->lstUserAccount = new QListBox($this);
			$this->lstUserAccount->Name = QApplication::Translate('User Account');
			$this->lstUserAccount->Required = true;
			if (!$this->blnEditMode)
				$this->lstUserAccount->AddItem(QApplication::Translate('- Select One -'), null);
			$objUserAccountArray = UserAccount::LoadAll();
			if ($objUserAccountArray) foreach ($objUserAccountArray as $objUserAccount) {
				$objListItem = new QListItem($objUserAccount->__toString(), $objUserAccount->UserAccountId);
				if (($this->objDatagridColumnPreference->UserAccount) && ($this->objDatagridColumnPreference->UserAccount->UserAccountId == $objUserAccount->UserAccountId))
					$objListItem->Selected = true;
				$this->lstUserAccount->AddItem($objListItem);
			}
		}

		// Create and Setup chkDisplayFlag
		protected function chkDisplayFlag_Create() {
			$this->chkDisplayFlag = new QCheckBox($this);
			$this->chkDisplayFlag->Name = QApplication::Translate('Display Flag');
			$this->chkDisplayFlag->Checked = $this->objDatagridColumnPreference->DisplayFlag;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'DatagridColumnPreference')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateDatagridColumnPreferenceFields() {
			$this->objDatagridColumnPreference->DatagridId = $this->lstDatagrid->SelectedValue;
			$this->objDatagridColumnPreference->ColumnName = $this->txtColumnName->Text;
			$this->objDatagridColumnPreference->UserAccountId = $this->lstUserAccount->SelectedValue;
			$this->objDatagridColumnPreference->DisplayFlag = $this->chkDisplayFlag->Checked;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateDatagridColumnPreferenceFields();
			$this->objDatagridColumnPreference->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objDatagridColumnPreference->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('datagrid_column_preference_list.php');
		}
	}
?>