<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the Attachment class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single Attachment object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this AttachmentEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class AttachmentEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objAttachment;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for Attachment's Data Fields
		public $lblAttachmentId;
		public $lstEntityQtype;
		public $txtEntityId;
		public $txtFilename;
		public $txtTmpFilename;
		public $txtFileType;
		public $txtPath;
		public $txtSize;
		public $lstCreatedByObject;
		public $calCreationDate;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupAttachment($objAttachment) {
			if ($objAttachment) {
				$this->objAttachment = $objAttachment;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objAttachment = new Attachment();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objAttachment = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupAttachment to either Load/Edit Existing or Create New
			$this->SetupAttachment($objAttachment);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for Attachment's Data Fields
			$this->lblAttachmentId_Create();
			$this->lstEntityQtype_Create();
			$this->txtEntityId_Create();
			$this->txtFilename_Create();
			$this->txtTmpFilename_Create();
			$this->txtFileType_Create();
			$this->txtPath_Create();
			$this->txtSize_Create();
			$this->lstCreatedByObject_Create();
			$this->calCreationDate_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblAttachmentId
		protected function lblAttachmentId_Create() {
			$this->lblAttachmentId = new QLabel($this);
			$this->lblAttachmentId->Name = QApplication::Translate('Attachment Id');
			if ($this->blnEditMode)
				$this->lblAttachmentId->Text = $this->objAttachment->AttachmentId;
			else
				$this->lblAttachmentId->Text = 'N/A';
		}

		// Create and Setup lstEntityQtype
		protected function lstEntityQtype_Create() {
			$this->lstEntityQtype = new QListBox($this);
			$this->lstEntityQtype->Name = QApplication::Translate('Entity Qtype');
			$this->lstEntityQtype->Required = true;
			foreach (EntityQtype::$NameArray as $intId => $strValue)
				$this->lstEntityQtype->AddItem(new QListItem($strValue, $intId, $this->objAttachment->EntityQtypeId == $intId));
		}

		// Create and Setup txtEntityId
		protected function txtEntityId_Create() {
			$this->txtEntityId = new QIntegerTextBox($this);
			$this->txtEntityId->Name = QApplication::Translate('Entity Id');
			$this->txtEntityId->Text = $this->objAttachment->EntityId;
			$this->txtEntityId->Required = true;
		}

		// Create and Setup txtFilename
		protected function txtFilename_Create() {
			$this->txtFilename = new QTextBox($this);
			$this->txtFilename->Name = QApplication::Translate('Filename');
			$this->txtFilename->Text = $this->objAttachment->Filename;
			$this->txtFilename->Required = true;
			$this->txtFilename->MaxLength = Attachment::FilenameMaxLength;
		}

		// Create and Setup txtTmpFilename
		protected function txtTmpFilename_Create() {
			$this->txtTmpFilename = new QTextBox($this);
			$this->txtTmpFilename->Name = QApplication::Translate('Tmp Filename');
			$this->txtTmpFilename->Text = $this->objAttachment->TmpFilename;
			$this->txtTmpFilename->MaxLength = Attachment::TmpFilenameMaxLength;
		}

		// Create and Setup txtFileType
		protected function txtFileType_Create() {
			$this->txtFileType = new QTextBox($this);
			$this->txtFileType->Name = QApplication::Translate('File Type');
			$this->txtFileType->Text = $this->objAttachment->FileType;
			$this->txtFileType->MaxLength = Attachment::FileTypeMaxLength;
		}

		// Create and Setup txtPath
		protected function txtPath_Create() {
			$this->txtPath = new QTextBox($this);
			$this->txtPath->Name = QApplication::Translate('Path');
			$this->txtPath->Text = $this->objAttachment->Path;
			$this->txtPath->MaxLength = Attachment::PathMaxLength;
		}

		// Create and Setup txtSize
		protected function txtSize_Create() {
			$this->txtSize = new QIntegerTextBox($this);
			$this->txtSize->Name = QApplication::Translate('Size');
			$this->txtSize->Text = $this->objAttachment->Size;
		}

		// Create and Setup lstCreatedByObject
		protected function lstCreatedByObject_Create() {
			$this->lstCreatedByObject = new QListBox($this);
			$this->lstCreatedByObject->Name = QApplication::Translate('Created By Object');
			$this->lstCreatedByObject->Required = true;
			if (!$this->blnEditMode)
				$this->lstCreatedByObject->AddItem(QApplication::Translate('- Select One -'), null);
			$objCreatedByObjectArray = UserAccount::LoadAll();
			if ($objCreatedByObjectArray) foreach ($objCreatedByObjectArray as $objCreatedByObject) {
				$objListItem = new QListItem($objCreatedByObject->__toString(), $objCreatedByObject->UserAccountId);
				if (($this->objAttachment->CreatedByObject) && ($this->objAttachment->CreatedByObject->UserAccountId == $objCreatedByObject->UserAccountId))
					$objListItem->Selected = true;
				$this->lstCreatedByObject->AddItem($objListItem);
			}
		}

		// Create and Setup calCreationDate
		protected function calCreationDate_Create() {
			$this->calCreationDate = new QDateTimePicker($this);
			$this->calCreationDate->Name = QApplication::Translate('Creation Date');
			$this->calCreationDate->DateTime = $this->objAttachment->CreationDate;
			$this->calCreationDate->DateTimePickerType = QDateTimePickerType::DateTime;
			$this->calCreationDate->Required = true;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Attachment')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateAttachmentFields() {
			$this->objAttachment->EntityQtypeId = $this->lstEntityQtype->SelectedValue;
			$this->objAttachment->EntityId = $this->txtEntityId->Text;
			$this->objAttachment->Filename = $this->txtFilename->Text;
			$this->objAttachment->TmpFilename = $this->txtTmpFilename->Text;
			$this->objAttachment->FileType = $this->txtFileType->Text;
			$this->objAttachment->Path = $this->txtPath->Text;
			$this->objAttachment->Size = $this->txtSize->Text;
			$this->objAttachment->CreatedBy = $this->lstCreatedByObject->SelectedValue;
			$this->objAttachment->CreationDate = $this->calCreationDate->DateTime;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateAttachmentFields();
			$this->objAttachment->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objAttachment->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>