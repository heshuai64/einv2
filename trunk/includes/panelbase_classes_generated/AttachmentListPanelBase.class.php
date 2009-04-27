<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Attachment class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Attachment objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this AttachmentListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class AttachmentListPanelBase extends QPanel {
		public $dtgAttachment;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colAttachmentId;
		protected $colEntityQtypeId;
		protected $colEntityId;
		protected $colFilename;
		protected $colTmpFilename;
		protected $colFileType;
		protected $colPath;
		protected $colSize;
		protected $colCreatedBy;
		protected $colCreationDate;

		public function __construct($objParentObject, $strSetEditPanelMethod, $strCloseEditPanelMethod, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Record Method Callbacks
			$this->strSetEditPanelMethod = $strSetEditPanelMethod;
			$this->strCloseEditPanelMethod = $strCloseEditPanelMethod;

			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgAttachment_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colAttachmentId = new QDataGridColumn(QApplication::Translate('Attachment Id'), '<?= $_ITEM->AttachmentId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->AttachmentId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->AttachmentId, false)));
			$this->colEntityQtypeId = new QDataGridColumn(QApplication::Translate('Entity Qtype'), '<?= $_CONTROL->ParentControl->dtgAttachment_EntityQtypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->EntityQtypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->EntityQtypeId, false)));
			$this->colEntityId = new QDataGridColumn(QApplication::Translate('Entity Id'), '<?= $_ITEM->EntityId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->EntityId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->EntityId, false)));
			$this->colFilename = new QDataGridColumn(QApplication::Translate('Filename'), '<?= QString::Truncate($_ITEM->Filename, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->Filename), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->Filename, false)));
			$this->colTmpFilename = new QDataGridColumn(QApplication::Translate('Tmp Filename'), '<?= QString::Truncate($_ITEM->TmpFilename, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->TmpFilename), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->TmpFilename, false)));
			$this->colFileType = new QDataGridColumn(QApplication::Translate('File Type'), '<?= QString::Truncate($_ITEM->FileType, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->FileType), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->FileType, false)));
			$this->colPath = new QDataGridColumn(QApplication::Translate('Path'), '<?= QString::Truncate($_ITEM->Path, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->Path), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->Path, false)));
			$this->colSize = new QDataGridColumn(QApplication::Translate('Size'), '<?= $_ITEM->Size; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->Size), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->Size, false)));
			$this->colCreatedBy = new QDataGridColumn(QApplication::Translate('Created By'), '<?= $_CONTROL->ParentControl->dtgAttachment_CreatedByObject_Render($_ITEM); ?>');
			$this->colCreationDate = new QDataGridColumn(QApplication::Translate('Creation Date'), '<?= $_CONTROL->ParentControl->dtgAttachment_CreationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Attachment()->CreationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Attachment()->CreationDate, false)));

			// Setup DataGrid
			$this->dtgAttachment = new QDataGrid($this);
			$this->dtgAttachment->CellSpacing = 0;
			$this->dtgAttachment->CellPadding = 4;
			$this->dtgAttachment->BorderStyle = QBorderStyle::Solid;
			$this->dtgAttachment->BorderWidth = 1;
			$this->dtgAttachment->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgAttachment->Paginator = new QPaginator($this->dtgAttachment);
			$this->dtgAttachment->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgAttachment->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgAttachment->SetDataBinder('dtgAttachment_Bind', $this);

			$this->dtgAttachment->AddColumn($this->colEditLinkColumn);
			$this->dtgAttachment->AddColumn($this->colAttachmentId);
			$this->dtgAttachment->AddColumn($this->colEntityQtypeId);
			$this->dtgAttachment->AddColumn($this->colEntityId);
			$this->dtgAttachment->AddColumn($this->colFilename);
			$this->dtgAttachment->AddColumn($this->colTmpFilename);
			$this->dtgAttachment->AddColumn($this->colFileType);
			$this->dtgAttachment->AddColumn($this->colPath);
			$this->dtgAttachment->AddColumn($this->colSize);
			$this->dtgAttachment->AddColumn($this->colCreatedBy);
			$this->dtgAttachment->AddColumn($this->colCreationDate);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Attachment');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgAttachment_EditLinkColumn_Render(Attachment $objAttachment) {
			$strControlId = 'btnEdit' . $this->dtgAttachment->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgAttachment, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objAttachment->AttachmentId;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objAttachment = Attachment::Load($strParameterArray[0]);

			$objEditPanel = new AttachmentEditPanel($this, $this->strCloseEditPanelMethod, $objAttachment);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new AttachmentEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgAttachment_EntityQtypeId_Render(Attachment $objAttachment) {
			if (!is_null($objAttachment->EntityQtypeId))
				return EntityQtype::ToString($objAttachment->EntityQtypeId);
			else
				return null;
		}

		public function dtgAttachment_CreatedByObject_Render(Attachment $objAttachment) {
			if (!is_null($objAttachment->CreatedByObject))
				return $objAttachment->CreatedByObject->__toString();
			else
				return null;
		}

		public function dtgAttachment_CreationDate_Render(Attachment $objAttachment) {
			if (!is_null($objAttachment->CreationDate))
				return $objAttachment->CreationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}


		public function dtgAttachment_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgAttachment->TotalItemCount = Attachment::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgAttachment->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgAttachment->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgAttachment->DataSource = Attachment::LoadAll($objClauses);
		}
	}
?>