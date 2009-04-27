<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the Datagrid class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single Datagrid object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this DatagridEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class DatagridEditFormBase extends QForm {
		// General Form Variables
		protected $objDatagrid;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for Datagrid's Data Fields
		protected $lblDatagridId;
		protected $txtShortDescription;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupDatagrid() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intDatagridId = QApplication::QueryString('intDatagridId');
			if (($intDatagridId)) {
				$this->objDatagrid = Datagrid::Load(($intDatagridId));

				if (!$this->objDatagrid)
					throw new Exception('Could not find a Datagrid object with PK arguments: ' . $intDatagridId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objDatagrid = new Datagrid();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupDatagrid to either Load/Edit Existing or Create New
			$this->SetupDatagrid();

			// Create/Setup Controls for Datagrid's Data Fields
			$this->lblDatagridId_Create();
			$this->txtShortDescription_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblDatagridId
		protected function lblDatagridId_Create() {
			$this->lblDatagridId = new QLabel($this);
			$this->lblDatagridId->Name = QApplication::Translate('Datagrid Id');
			if ($this->blnEditMode)
				$this->lblDatagridId->Text = $this->objDatagrid->DatagridId;
			else
				$this->lblDatagridId->Text = 'N/A';
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objDatagrid->ShortDescription;
			$this->txtShortDescription->Required = true;
			$this->txtShortDescription->MaxLength = Datagrid::ShortDescriptionMaxLength;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Datagrid')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateDatagridFields() {
			$this->objDatagrid->ShortDescription = $this->txtShortDescription->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateDatagridFields();
			$this->objDatagrid->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objDatagrid->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('datagrid_list.php');
		}
	}
?>